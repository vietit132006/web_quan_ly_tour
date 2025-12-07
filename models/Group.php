<?php
class GroupModel extends DB
{
    // Lấy danh sách tour group
    public function all()
    {
        return $this->query("
            SELECT 
                g.*,
                t.name AS tour_name,
                DATEDIFF(g.end_date, g.start_date) + 1 AS so_ngay,
                DATEDIFF(g.end_date, g.start_date) AS so_dem,
                GROUP_CONCAT(s.name SEPARATOR ', ') AS service_list,
                u.full_name AS guide_name
            FROM tour_group g
            LEFT JOIN tours t ON g.tour_id = t.id
            LEFT JOIN tour_group_service tgs ON g.id = tgs.tour_group_id
            LEFT JOIN service s ON tgs.service_id = s.id
            LEFT JOIN tour_guides tg ON g.guide_id = tg.id
            LEFT JOIN users u ON tg.user_id = u.id
            GROUP BY g.id
        ")->fetchAll();
    }


    // Thêm mới tour group + dịch vụ
    public function insert($data)
    {
        // 1. Insert tour_group
        $sql = "INSERT INTO tour_group (tour_id, start_date, end_date, number_guests, total_days, guide_id, departure_time)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
        DB::query($sql, [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['number_guests'],
            $data['total_days'],
            $data['guide_id'],
            $data['departure_time'],
        ]);

        $tour_group_id = DB::lastInsertId();

        // 2. Insert dịch vụ chỉ khi hợp lệ
        if (!empty($data['services'])) {
            foreach ($data['services'] as $service_id) {
                if ($service_id <= 0) continue; // bỏ qua rỗng, 0
                DB::query(
                    "INSERT INTO tour_group_service (tour_group_id, service_id, status) VALUES (?, ?, 1)",
                    [$tour_group_id, $service_id]
                );
            }
        }


        return $tour_group_id;
    }
    // Lấy chi tiết 1 tour group
    public function find($id)
    {
        return $this->query("
        SELECT * FROM tour_group WHERE tour_group.id = ?
        ", [$id])->fetch();
    }

    // Lấy dịch vụ của 1 tour group
    public function getServices($tour_group_id)
    {
        return $this->query("
        SELECT service_id FROM tour_group_service WHERE tour_group_id = ?
        ", [$tour_group_id])->fetchAll(PDO::FETCH_COLUMN);
    }
    public function delete($id)
    {
        // 1. Xóa dịch vụ khỏi tour_group_service
        $this->query("DELETE FROM tour_group_service WHERE tour_group_id = ?", [$id]);

        // 2. Xóa assigned_tour liên quan
        $this->query("DELETE FROM assigned_tour WHERE group_id = ?", [$id]);

        // 3. Xóa tour_group
        $this->query("DELETE FROM tour_group WHERE id = ?", [$id]);
    }




    // Cập nhật tour group + dịch vụ
    public function update($id, $data)
    {
        // 1. Update tour_group
        $sql = "UPDATE tour_group 
                SET tour_id=?, start_date=?, end_date=?, number_guests=?, total_days=?, guide_id=?, departure_time=? 
                WHERE id=?";
        DB::query($sql, [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['number_guests'],
            $data['total_days'],
            $data['guide_id'],
            $data['departure_time'],
            $id
        ]);

        // 2. Xóa dịch vụ cũ
        DB::query("DELETE FROM tour_group_service WHERE tour_group_id=?", [$id]);

        // 3. Insert dịch vụ mới
        if (!empty($data['services'])) {
            foreach ($data['services'] as $service_id) {
                $service_id = (int) $service_id;
                if ($service_id <= 0) continue;
                DB::query(
                    "INSERT INTO tour_group_service (tour_group_id, service_id, status) VALUES (?, ?, 1)",
                    [$id, $service_id]
                );
            }
        }
    }
}
