<?php

class TourLogModel extends BaseModel
{
    protected $table = 'tour_logs';

    public function create($bookingId, $title, $content, $userId = null)
    {
        $sql = "
            INSERT INTO tour_logs 
            (booking_id, title, content, created_at, created_by)
            VALUES (?, ?, ?, NOW(), ?)
        ";

        return $this->execute($sql, [
            $bookingId,
            $title,
            $content,
            $userId
        ]);
    }

    public function getByBooking($bookingId)
    {
        $sql = "SELECT * FROM tour_logs WHERE booking_id = ? ORDER BY created_at DESC";
        return $this->query($sql, [$bookingId])->fetchAll();
    }
}
