<?php
require_once __DIR__ . '/../configs/database.php';

class Group {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    // Lấy danh sách tất cả group
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM `group` ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    // Lấy chi tiết 1 group
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM `group` WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }

    // Tạo group mới
    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO `group` (booking_id, start_date, end_date, number_guests, status, note)
            VALUES (:booking_id, :start_date, :end_date, :number_guests, :status, :note)
        ");
        $stmt->execute([
            ':booking_id' => $data['booking_id'],
            ':start_date' => $data['start_date'],
            ':end_date' => $data['end_date'],
            ':number_guests' => $data['number_guests'],
            ':status' => $data['status'],
            ':note' => $data['note']
        ]);
        return $this->pdo->lastInsertId();
    }
}
