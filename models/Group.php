<?php

class GroupModel extends DB
{
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

   public function insert($data)
{
    $sql = "INSERT INTO tour_group 
            (tour_name, start_date, end_date, number_guests, guide_name, service_list) 
            VALUES (?,?,?,?,?,?,?,?,?)";

    $this->query($sql, [
        $data['tour_name'],
        $data['start_date'],
        $data['end_date'],
        $data['number_guests'],
        $data['guide_name'],
        $data['service_list']
    ]);

    return $this->lastInsertId();
}

}
