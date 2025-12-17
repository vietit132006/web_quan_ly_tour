<?php

class GroupModel extends DB
{
    protected $table = 'tour_group';
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
        $sql = "INSERT INTO tour_group 
            (tour_id, start_date, end_date, number_guests, total_days, guide_id, departure_time)
            VALUES (?, ?, ?, ?, ?, ?, ?)";

        $this->query($sql, [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['number_guests'],
            $data['total_days'],
            $data['guide_id'],
            $data['departure_time'],
        ]);

        $tour_group_id = $this->lastInsertId();

        // 2. Insert dịch vụ
        if (!empty($data['services'])) {
            foreach ($data['services'] as $service_id) {
                $service_id = (int) $service_id;
                if ($service_id <= 0) continue;

                $this->query(
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
            SELECT * FROM tour_group WHERE id = ?
        ", [$id])->fetch();
    }

    // Lấy danh sách service id của 1 tour group
    public function getServices($tour_group_id)
    {
        return $this->query("
            SELECT service_id 
            FROM tour_group_service 
            WHERE tour_group_id = ?
        ", [$tour_group_id])->fetchAll(PDO::FETCH_COLUMN);
    }

    // Xóa tour group
    public function delete($id)
    {
        // 1. Xóa dịch vụ
        $this->query("DELETE FROM tour_group_service WHERE tour_group_id = ?", [$id]);

        // 2. Xóa bảng liên quan (nếu có)
        $this->query("DELETE FROM assigned_tour WHERE group_id = ?", [$id]);

        // 3. Xóa tour group
        $this->query("DELETE FROM tour_group WHERE id = ?", [$id]);
    }

    // Cập nhật tour group + dịch vụ
    public function update($id, $data)
    {
        // 1. Update tour_group
        $sql = "UPDATE tour_group 
                SET tour_id = ?, 
                    start_date = ?, 
                    end_date = ?, 
                    number_guests = ?, 
                    total_days = ?, 
                    guide_id = ?, 
                    departure_time = ? 
                WHERE id = ?";

        $this->query($sql, [
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
        $this->query("DELETE FROM tour_group_service WHERE tour_group_id = ?", [$id]);

        // 3. Insert dịch vụ mới
        if (!empty($data['services'])) {
            foreach ($data['services'] as $service_id) {
                $service_id = (int) $service_id;
                if ($service_id <= 0) continue;

                $this->query(
                    "INSERT INTO tour_group_service (tour_group_id, service_id, status) VALUES (?, ?, 1)",
                    [$id, $service_id]
                );
            }
        }
    }
    public function create($data)
    {
        $sql = "
            INSERT INTO tour_group
            (booking_id, tour_id, guide_id, start_date, end_date, departure_time, total_days, address, note, status)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        return $this->execute($sql, [
            $data['booking_id'],
            $data['tour_id'],
            $data['guide_id'],
            $data['start_date'],
            $data['end_date'],
            $data['departure_time'],
            $data['total_days'],
            $data['address'],
            $data['note'],
            'confirmed'
        ]);
    }

    public function findByBooking($bookingId)
    {
        $sql = "SELECT * FROM tour_group WHERE booking_id = ?";
        return $this->query($sql, [$bookingId])->fetch();
    }
}
