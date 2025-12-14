<?php
class BookingServiceModel extends BaseModel
{
    protected $table = 'booking_services';

    public function getByBooking($bookingId)
    {
        $sql = "
            SELECT 
                s.name,
                bs.price
            FROM booking_services bs
            JOIN service s ON bs.service_id = s.id
            WHERE bs.booking_id = ?
        ";

        return $this->query($sql, [$bookingId])->fetchAll();
    }
}
