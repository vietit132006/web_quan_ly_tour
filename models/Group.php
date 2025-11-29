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
        // Tính số ngày
        $start = strtotime($data['start_date']);
        $end   = strtotime($data['end_date']);
        $total_days = ($end - $start) / 86400 + 1;

        // Thêm tour_group
        $sql = "INSERT INTO tour_group 
                (tour_id, start_date, end_date, total_days, departure_time, number_guests, guide_id)
                VALUES (?,?,?,?,?,?,?,?)";

        $this->query($sql, [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $total_days,
            $data['departure_time'],
            $data['number_guests'],
            $data['guide_id']
        ]);

        // Lấy ID vừa tạo
        $groupId = $this->lastInsertId();

        // Nếu có dịch vụ thì thêm vào bảng trung gian
        if (!empty($data['services'])) {
            foreach ($data['services'] as $serviceId) {
                $this->query("
                    INSERT INTO tour_group_service (tour_group_id, service_id, quantity, price, status)
                    VALUES (?,?,?,?,?)
                ", [
                    $groupId,
                    $serviceId,
                    1,      // quantity default
                    0,      // price default
                    1       // status default (active)
                ]);
            }
        }

        return $groupId;
    }
}
