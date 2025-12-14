<?php

class TourLogModel extends BaseModel
{
    protected $table = 'tour_logs';

    public function create($bookingId, $action, $content, $userId = null)
    {
        $sql = "
        INSERT INTO tour_logs (booking_id, action, content, created_by)
        VALUES (?, ?, ?, ?)
    ";

        return $this->execute($sql, [
            $bookingId,
            $action,
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
