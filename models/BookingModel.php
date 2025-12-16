<?php

class BookingModel extends BaseModel
{
    protected $table = 'booking';

    /* =========================
     * DANH SÁCH BOOKING
     * ========================= */
    public function getAll()
    {
        $sql = "
            SELECT
                b.id,
                b.status,
                b.created_at,
                b.total_amount,

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

    /* =========================
     * CHI TIẾT BOOKING
     * ========================= */
    public function find($id)
    {
        $sql = "
        SELECT 
            b.*,
            c.name  AS customer_name,
            c.phone AS customer_phone,
            c.email AS customer_email,
            t.name  AS tour_name,
            t.promo_price AS tour_price
        FROM booking b
        LEFT JOIN customers c ON b.customer_id = c.id
        LEFT JOIN tours t ON b.tour_id = t.id
        WHERE b.id = ?
    ";

        return $this->query($sql, [$id])->fetch();
    }


    /* =========================
     * TẠO BOOKING
     * ========================= */
    public function create($data)
    {
        $sql = "
            INSERT INTO booking
            (tour_id, user_id, customer_id, status, admin_note, total_amount)
            VALUES (?, ?, ?, ?, ?, 0)
        ";

        $this->execute($sql, [
            $data['tour_id'],
            $data['user_id'],
            $data['customer_id'],
            $data['status'] ?? 'pending',
            $data['admin_note'] ?? null
        ]);

        return $this->lastInsertId();
    }

    /* =========================
     * TRẠNG THÁI
     * ========================= */
    public function updateStatus($id, $status)
    {
        return $this->execute(
            "UPDATE booking SET status = ? WHERE id = ?",
            [$status, $id]
        );
    }

    public function canDelete($id)
    {
        $status = $this->query(
            "SELECT status FROM booking WHERE id = ?",
            [$id]
        )->fetchColumn();

        return $status === 'pending';
    }

    /* =========================
     * TỔNG TIỀN (CHỈ TÍNH)
     * ========================= */
    public function calculateTotal($bookingId)
    {
        // 1️⃣ Giá tour × số người
        $sqlTour = "
        SELECT 
            COUNT(g.id) AS number_people,
            COALESCE(t.promo_price, t.base_price) AS price
        FROM booking b
        JOIN tours t ON b.tour_id = t.id
        LEFT JOIN guest g ON g.booking_id = b.id
        WHERE b.id = ?
        GROUP BY b.id
    ";

        $tourRow = $this->query($sqlTour, [$bookingId])->fetch();

        $numberPeople   = $tourRow['number_people'] ?? 0;
        $pricePerPerson = $tourRow['price'] ?? 0;

        $tourPrice = $numberPeople * $pricePerPerson;

        // 2️⃣ Tổng dịch vụ (✔ ĐÚNG NGHIỆP VỤ)
        $sqlService = "
        SELECT COALESCE(SUM(quantity * price), 0) AS total
        FROM booking_services
        WHERE booking_id = ?
    ";

        $serviceRow = $this->query($sqlService, [$bookingId])->fetch();
        $servicePrice = $serviceRow['total'] ?? 0;

        // 3️⃣ Trả về format view
        return [
            'tour_price'    => (float)$tourPrice,
            'service_price' => (float)$servicePrice,
            'total'         => (float)$tourPrice + (float)$servicePrice
        ];
    }


    /* =========================
     * CẬP NHẬT TOTAL
     * ========================= */
    public function updateTotalAmount($bookingId, $total)
    {
        return $this->execute(
            "UPDATE booking SET total_amount = ? WHERE id = ?",
            [$total, $bookingId]
        );
    }

    /* =========================
     * ĐẾM KHÁCH (FIX guest)
     * ========================= */
    public function countGuests($bookingId)
    {
        return (int) $this->query(
            "SELECT COUNT(*) FROM guest WHERE booking_id = ?",
            [$bookingId]
        )->fetchColumn();
    }
}
