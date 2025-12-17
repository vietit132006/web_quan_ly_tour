<?php

class AttendanceModel extends BaseModel
{
    public function getBookingInfo($bookingId)
    {
        $sql = "
        SELECT 
            b.id AS booking_id,
            b.status AS booking_status,
            b.admin_note,

            t.name AS tour_name,
            t.start_date,
            t.end_date,
            t.total_days,
            t.total_nights,
            t.departure_time,

            c.name  AS customer_name,
            c.phone AS customer_phone,
            c.email AS customer_email
        FROM booking b
        JOIN tours t ON b.tour_id = t.id
        LEFT JOIN customers c ON b.customer_id = c.id
        WHERE b.id = ?
    ";
        return $this->query($sql, [$bookingId])->fetch();
    }

    public function getGuests($bookingId)
    {
        $sql = "
        SELECT 
            id,
            name,
            age,
            date_birth,
            phone,
            sex,
            email,
            address,
            identification,
            request
        FROM guest
        WHERE booking_id = ?
    ";
        return $this->query($sql, [$bookingId])->fetchAll();
    }


    // Lưu phiên điểm danh
    public function createSession($bookingId, $guideId, $note)
    {
        $sql = "INSERT INTO attendance_sessions (booking_id, guide_id, note)
                VALUES (?, ?, ?)";
        $this->query($sql, [$bookingId, $guideId, $note]);
        return $this->lastInsertId();
    }

    // Lưu chi tiết khách
    public function saveDetails($sessionId, $statuses)
    {
        foreach ($statuses as $guestId => $status) {
            $sql = "INSERT INTO attendance_details (session_id, guest_id, status)
                    VALUES (?, ?, ?)";
            $this->query($sql, [$sessionId, $guestId, $status]);
        }
    }

    // Lịch sử các phiên
    public function getSessionsByBooking($bookingId, $guideId,)
    {
        $sql = "
        SELECT id, note, created_at
        FROM attendance_sessions
        WHERE booking_id = ?
          AND guide_id = ?
        ORDER BY created_at DESC
    ";
        return $this->query($sql, [$bookingId, $guideId])->fetchAll();
    }


    // Chi tiết 1 phiên
    public function getSessionDetail($sessionId)
    {
        $sql = "
            SELECT s.*, t.name AS tour_name
            FROM attendance_sessions s
            JOIN booking b ON s.booking_id = b.id
            JOIN tours t ON b.tour_id = t.id
            WHERE s.id = ?
        ";
        return $this->query($sql, [$sessionId])->fetch();
    }

    public function getSessionGuests($sessionId)
    {
        $sql = "
        SELECT g.name, g.phone, d.status
        FROM attendance_details d
        JOIN guest g ON d.guest_id = g.id
        WHERE d.session_id = ?
    ";
        return $this->query($sql, [$sessionId])->fetchAll();
    }
}
