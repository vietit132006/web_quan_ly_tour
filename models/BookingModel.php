<?php

class BookingModel extends BaseModel
{
    protected $table = 'booking';


    // =========================
    // LẤY DANH SÁCH BOOKING
    // =========================
    public function getAll($status = null)
    {
        $sql = "SELECT b.*, t.name AS tour_name
            FROM booking b
            JOIN tours t ON b.tour_id = t.id";

        $params = [];

        if ($status) {
            $sql .= " WHERE b.status = ?";
            $params[] = $status;
        }

        $sql .= " ORDER BY b.created_at DESC";

        return $this->query($sql, $params)->fetchAll();
    }



    // =========================
    // LẤY BOOKING THEO ID
    // =========================
    public function find($id)
    {
        $sql = "SELECT b.*, t.name AS tour_name
                FROM booking b
                JOIN tours t ON b.tour_id = t.id
                WHERE b.id = ?";
        return $this->query($sql, [$id])->fetch();
    }

    // =========================
    // TẠO BOOKING
    // =========================
    public function create($data)
    {
        $sql = "INSERT INTO booking
        (tour_id, user_id, status, admin_note)
        VALUES (?, ?, 'pending', ?)";
        return $this->execute($sql, [
            $data['tour_id'],
            $data['user_id'],
            $data['admin_note'] ?? null
        ]);
    }

    // =========================
    // CẬP NHẬT TRẠNG THÁI
    // =========================
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE booking SET status = ? WHERE id = ?";
        return $this->execute($sql, [$status, $id]);
    }

    // =========================
    // KHÔNG CHO XOÁ KHI ĐÃ CONFIRMED
    // =========================
    public function canDelete($id)
    {
        $sql = "SELECT status FROM booking WHERE id = ?";
        $status = $this->query($sql, [$id])->fetchColumn();
        return $status === 'pending';
    }
    public function calculateTotal($bookingId)
    {
        $sql = "
        SELECT 
            b.number_people,
            t.base_price,
            t.promo_price
        FROM booking b
        JOIN tours t ON b.tour_id = t.id
        WHERE b.id = ?
        LIMIT 1
    ";
        $row = $this->query($sql, [$bookingId])->fetch();

        if (!$row) {
            return [
                'tour_price' => 0,
                'service_price' => 0,
                'total' => 0
            ];
        }

        $tourPrice = $row['promo_price'] ?? $row['base_price'];
        $tourTotal = $tourPrice * $row['number_people'];

        // Lấy tổng dịch vụ
        $serviceModel = new BookingServiceModel();
        $services = $serviceModel->getByBooking($bookingId);
        $serviceTotal = 0;
        foreach ($services as $s) {
            $serviceTotal += $s['price'];
        }

        return [
            'tour_price' => $tourTotal,
            'service_price' => $serviceTotal,
            'total' => $tourTotal + $serviceTotal
        ];
    }
}
