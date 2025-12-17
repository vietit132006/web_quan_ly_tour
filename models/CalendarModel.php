<?php

class CalendarModel extends BaseModel
{
    /**
     * Lấy lịch làm việc của HDV
     */
    public function getToursByGuideId($guideId)
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
                t.description AS tour_description,

                c.name AS customer_name,
                c.phone AS customer_phone,

                COUNT(g.id) AS total_guests
            FROM booking_guides bg
            JOIN booking b ON bg.booking_id = b.id
            JOIN tours t ON b.tour_id = t.id
            LEFT JOIN customers c ON b.customer_id = c.id
            LEFT JOIN guest g ON g.booking_id = b.id
            WHERE bg.guide_id = ?
            GROUP BY b.id
            ORDER BY t.start_date ASC
        ";

        return $this->query($sql, [$guideId])->fetchAll();
    }

    /**
     * Chi tiết booking
     */
    public function getBookingDetail($bookingId, $guideId)
    {
        $sql = "
        SELECT
            b.id              AS booking_id,
            b.status          AS booking_status,
            b.admin_note,

            t.name            AS tour_name,
            t.description,
            t.start_date,
            t.end_date,
            t.total_days,
            t.total_nights,
            t.departure_time,
            t.diem_di,
            t.diem_den,
            t.phuong_tien,

            c.name            AS customer_name,
            c.phone           AS customer_phone,
            c.email           AS customer_email
        FROM booking b
        JOIN booking_guides bg ON bg.booking_id = b.id
        JOIN tours t ON b.tour_id = t.id
        LEFT JOIN customers c ON b.customer_id = c.id
        WHERE b.id = ?
          AND bg.guide_id = ?
        LIMIT 1
    ";

        return $this->query($sql, [$bookingId, $guideId])->fetch();
    }


    public function getGuestsByBooking($bookingId)
    {
        $sql = "SELECT * FROM guest WHERE booking_id = ?";
        return $this->query($sql, [$bookingId])->fetchAll();
    }

    public function confirmBooking($bookingId)
    {
        $sql = "UPDATE booking SET status = 'confirmed' WHERE id = ?";
        $this->query($sql, [$bookingId]);
    }

    public function rejectBooking($bookingId)
    {
        $sql = "UPDATE booking SET status = 'cancelled' WHERE id = ?";
        $this->query($sql, [$bookingId]);
    }
}
