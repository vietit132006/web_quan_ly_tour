<?php

class Manage extends DB
{
    public function insertGroup($data)
    {
        $sql = "INSERT INTO tour_group (tour_name, start_date, end_date, departure_time, number_guests, guide_name, service_list) 
                VALUES (:tour_name, :start_date, :end_date, :departure_time, :number_guests, :guide_name, :service_list)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':tour_name' => $data['tour_name'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':departure_time' => $data['departure_time'],
            ':number_guests' => $data['number_guests'],
            ':guide_name' => $data['guide_name'],
            ':service_list' => $data['service_list'],

        ]);
    }
}
