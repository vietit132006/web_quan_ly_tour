<?php 
class GroupModel extends DB
{
    // Lấy danh sách tất cả tour group
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

    // Thêm mới tour group
    public function insert($data)
    {
        DB::query("
            INSERT INTO tour_group (tour_id, start_date, end_date, number_guests, total_days, guide_id, departure_time)
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ", [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['number_guests'],
            $data['total_days'],
            $data['guide_id'],
            $data['departure_time']
        ]);

        $id = DB::lastInsertId();

        // thêm dịch vụ nếu có
        if (!empty($data['services'])) {
            $this->updateServices($id, $data['services']);
        }

        return $id;
    }

    // Lấy 1 group theo ID
    public function find($id)
    {
        return $this->query("SELECT * FROM tour_group WHERE id = ?", [$id])->fetch();
    }

    // Lấy danh sách service_id thuộc group
    public function getServices($group_id)
    {
        return $this->query("
            SELECT service_id 
            FROM tour_group_service 
            WHERE tour_group_id = ?
        ", [$group_id])->fetchAll(PDO::FETCH_COLUMN);
    }

    // Xóa tất cả dịch vụ của group
    public function deleteServices($group_id)
    {
        $this->query("DELETE FROM tour_group_service WHERE tour_group_id = ?", [$group_id]);
    }

    // Cập nhật lại danh sách dịch vụ
    public function updateServices($group_id, $services)
    {
        // Xóa cũ trước
        $this->deleteServices($group_id);

        if (!is_array($services)) return;

        foreach ($services as $service_id) {
            $service_id = (int)$service_id;
            if ($service_id <= 0) continue;

            $this->query("
                INSERT INTO tour_group_service (tour_group_id, service_id, status)
                VALUES (?, ?, 1)
            ", [$group_id, $service_id]);
        }
    }

    // Update thông tin group
    public function update($id, $data)
    {
        DB::query("
            UPDATE tour_group
            SET tour_id=?, start_date=?, end_date=?, number_guests=?, total_days=?, guide_id=?, departure_time=?
            WHERE id=?
        ", [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['number_guests'],
            $data['total_days'],
            $data['guide_id'],
            $data['departure_time'],
            $id
        ]);

        // Update services
        if (isset($data['services'])) {
            $this->updateServices($id, $data['services']);
        }
    }

    // Xóa group
    public function delete($id)
    {
        $this->deleteServices($id);
        $this->query("DELETE FROM tour_group WHERE id=?", [$id]);
    }
}
