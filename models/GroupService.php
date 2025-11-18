<?php
require_once __DIR__ . '/../configs/database.php';


class GroupService {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function addService($group_id, $service_id, $quantity, $date_use) {
        // Lấy giá dịch vụ
        $stmt = $this->pdo->prepare("SELECT price FROM service WHERE id = :id");
        $stmt->execute([':id' => $service_id]);
        $service = $stmt->fetch();
        if (!$service) return false;

        $unit_price = $service['price'];
        $total_cost = $unit_price * $quantity;

        $stmt2 = $this->pdo->prepare("
            INSERT INTO group_service (group_id, service_id, date_use, quantity, unit_price, total_cost)
            VALUES (:group_id, :service_id, :date_use, :quantity, :unit_price, :total_cost)
        ");
        $stmt2->execute([
            ':group_id' => $group_id,
            ':service_id' => $service_id,
            ':date_use' => $date_use,
            ':quantity' => $quantity,
            ':unit_price' => $unit_price,
            ':total_cost' => $total_cost
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getServicesByGroup($group_id) {
        $stmt = $this->pdo->prepare("
            SELECT gs.*, s.name AS service_name
            FROM group_service gs
            JOIN service s ON gs.service_id = s.id
            WHERE gs.group_id = :group_id
        ");
        $stmt->execute([':group_id' => $group_id]);
        return $stmt->fetchAll();
    }
}
