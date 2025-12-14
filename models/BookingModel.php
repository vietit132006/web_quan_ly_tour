<?php

class BookingModel extends BaseModel
{
    protected $table = 'booking';

    // =========================
    // LẤY DANH SÁCH BOOKING
    // =========================
    public function getAll()
    {
        $sql = "
        SELECT
            b.id,
            b.status,
            b.created_at,

            c.name  AS customer_name,
            c.phone AS customer_phone,

            t.name AS tour_name,

            COUNT(g.id) AS number_people
        FROM booking b
        LEFT JOIN customers c ON c.id = b.customer_id
        LEFT JOIN tours t ON t.id = b.tour_id
        LEFT JOIN guest g ON g.booking_id = b.id
        GROUP BY b.id
        ORDER BY b.created_at DESC
    ";

        return $this->query($sql)->fetchAll();
    }


    // =========================
    // LẤY BOOKING THEO ID
    // =========================
    public function find($id)
    {
        $sql = "
            SELECT 
                b.*,
                t.name AS tour_name,
                c.name AS customer_name,
                c.phone AS customer_phone,
                c.email AS customer_email,
                c.address AS customer_address
            FROM booking b
            JOIN tours t ON b.tour_id = t.id
            LEFT JOIN customers c ON b.customer_id = c.id
            WHERE b.id = ?
            LIMIT 1
        ";

        return $this->query($sql, [$id])->fetch();
    }

    // =========================
    // TẠO BOOKING
    // =========================
    public function create($data)
    {
        $sql = "INSERT INTO booking
        (tour_id, user_id, customer_id, status, admin_note)
        VALUES (?, ?, ?, ?, ?)";

        $this->execute($sql, [
            $data['tour_id'],
            $data['user_id'],
            $data['customer_id'],
            $data['status'] ?? 'pending',
            $data['admin_note'] ?? null
        ]);

        return $this->lastInsertId();
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
    // KIỂM TRA XOÁ
    // =========================
    public function canDelete($id)
    {
        $sql = "SELECT status FROM booking WHERE id = ?";
        $status = $this->query($sql, [$id])->fetchColumn();
        return $status === 'pending';
    }

    // =========================
    // TÍNH TỔNG TIỀN
    // =========================
    public function calculateTotal($bookingId)
    {
        $sql = "
        SELECT 
            COUNT(g.id) AS number_people,
            t.base_price,
            t.promo_price
        FROM booking b
        JOIN tours t ON b.tour_id = t.id
        LEFT JOIN guest g ON g.booking_id = b.id
        WHERE b.id = ?
        GROUP BY b.id
        LIMIT 1
    ";

        $row = $this->query($sql, [$bookingId])->fetch();

        if (!$row) {
            return [
                'tour_price'    => 0,
                'service_price' => 0,
                'total'         => 0
            ];
        }

        $pricePerPerson = $row['promo_price'] ?? $row['base_price'];
        $tourTotal = $pricePerPerson * $row['number_people'];

        // ===== DỊCH VỤ =====
        $serviceModel = new BookingServiceModel();
        $services = $serviceModel->getByBooking($bookingId);

        $serviceTotal = 0;
        foreach ($services as $s) {
            $serviceTotal += $s['price'];
        }

        return [
            'number_people' => $row['number_people'],
            'tour_price'    => $tourTotal,
            'service_price' => $serviceTotal,
            'total'         => $tourTotal + $serviceTotal
        ];
    }

    public function countGuests($bookingId)
    {
        $sql = "SELECT COUNT(*) FROM guests WHERE booking_id = ?";
        return (int) $this->query($sql, [$bookingId])->fetchColumn();
    }
}
