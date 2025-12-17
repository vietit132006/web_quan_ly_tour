<?php

class TourGroupModel extends BaseModel
{
    protected $table = 'tour_group';

    // Lấy tour group theo booking
    public function getByBooking($bookingId)
    {
        $sql = "
            SELECT 
                tg.*,
                u.full_name AS guide_name,
                u.phone AS guide_phone
            FROM tour_group tg
            LEFT JOIN tour_guides g ON g.id = tg.guide_id
            LEFT JOIN users u ON u.id = g.user_id
            WHERE tg.booking_id = ?
            LIMIT 1
        ";

        return $this->query($sql, [$bookingId])->fetch();
    }

    // Tạo tour group
    public function create($data)
    {
        $sql = "
            INSERT INTO tour_group
            (booking_id, tour_id, guide_id, start_date, end_date, departure_time,
             total_days, address, number_guests, status, note)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ";

        return $this->execute($sql, [
            $data['booking_id'],
            $data['tour_id'],
            $data['guide_id'],
            $data['start_date'],
            $data['end_date'],
            $data['departure_time'],
            $data['total_days'],
            $data['address'],
            $data['number_guests'],
            $data['status'],
            $data['note']
        ]);
    }
}
