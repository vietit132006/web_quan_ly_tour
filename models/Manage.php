    <?php
if (empty($data['service_id'])) {
    throw new Exception("Service ID is required.");
}

    class Manage extends DB
    {
        public function insertGroup($data)
        {
            $sql = "INSERT INTO tour_group (tour_id, start_date, end_date, departure_time, total_days, number_guests, guide_name, tour_group_service_id) 
                    VALUES (:tour_id, :start_date, :end_date, :departure_time, :total_days, :number_guests, :guide_name, :tour_group_service_id)";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ':tour_id' => $data['tour_id'],
                ':start_date' => $data['start_date'],
                ':end_date' => $data['end_date'],
                ':departure_time' => $data['departure_time'],
                ':total_days' => $data['total_days'],
                ':number_guests' => $data['number_guests'],
                ':guide_name' => $data['guide_name'],
                ':tour_group_service_id' => $data['service_id'],
            ]);
        }

        public function insertGroupService($data)
        {
            $sql = "INSERT INTO tour_group_service (service_id, status) 
                    VALUES (:service_id, :status)";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ':service_id' => $data['service_id'],
                ':status' => $data['status'],
            ]);
        }

        public function insertGuide($data)
        {
            $sql = "INSERT INTO tour_guides (full_name, user_id, status) 
                    VALUES (:full_name, :user_id, :status)";

            $stmt = $this->pdo->prepare($sql);

            return $stmt->execute([
                ':full_name' => $data['full_name'],
                ':user_id' => $data['user_id'],
                ':status' => $data['status'],
            ]);
        }
        
    }
