<?php
class BookingServiceModel extends BaseModel
{
    protected $table = 'booking_services';

    // Thêm dịch vụ vào booking
    public function addServiceToBooking($bookingId, $serviceId, $quantity, $price)
    {
        $sql = "
            INSERT INTO booking_services (booking_id, service_id, quantity, price)
            VALUES (?, ?, ?, ?)
        ";

        return $this->query($sql, [
            $bookingId,
            $serviceId,
            $quantity,
            $price
        ]);
    }

    // Lấy dịch vụ theo booking
    public function getByBooking($bookingId)
    {
        $sql = "
            SELECT 
                s.name,
                bs.quantity,
                bs.price,
                (bs.quantity * bs.price) AS total
            FROM booking_services bs
            JOIN service s ON bs.service_id = s.id
            WHERE bs.booking_id = ?
        ";

        return $this->query($sql, [$bookingId])->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy service
    public function getServiceById($id)
    {
        $sql = "SELECT id, name, price FROM service WHERE id = ? AND status = 1";
        return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllActiveServices()
    {
        $sql = "SELECT id, name, price FROM service WHERE status = 1";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // ✅ THÊM DỊCH VỤ VÀO BOOKING
    public function create($data)
    {
        $sql = "
            INSERT INTO booking_services 
            (booking_id, service_id, price, quantity)
            VALUES (?, ?, ?, ?)
        ";

        return $this->query($sql, [
            $data['booking_id'],
            $data['service_id'],
            $data['price'],
            $data['quantity']
        ]);
    }
}
