<?php

class Manage extends DB
{
    public function getTourGroups()
    {
        return $this->query("SELECT g.*, s.name AS service_name, u.full_name AS guide_name FROM tour_group g LEFT JOIN service s ON 
        g.service_id = s.id LEFT JOIN tour_guides tg ON g.guide_id = tg.id LEFT JOIN users u ON tg.user_id = u.id;")->fetchAll();
    }

    public function insertGroup($data)
    {
        $sql = "INSERT INTO tour_group (tour_id, start_date, end_date, total_days, departure_time, number_guests, guide_id) 
                VALUES (?,?,?,?,?,?,?)";

        $this->query($sql, [
            $data['tour_id'],
            $data['start_date'],
            $data['end_date'],
            $data['total_days'],
            $data['departure_time'],
            $data['number_guests'],
            $data['guide_id']
        ]);

        return $this->lastInsertId();
    }
}
