<?php

class GuestModel extends BaseModel
{
    protected $table = 'guest';

    public function getByBooking($bookingId)
    {
        $sql = "SELECT * FROM guest WHERE booking_id = ?";
        return $this->query($sql, [$bookingId])->fetchAll();
    }

    public function create($data)
    {
        $sql = "
        INSERT INTO guest
        (name, phone, email, identification, date_birth, sex, request, booking_id, address)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
    ";

        return $this->execute($sql, [
            $data['name'],
            !empty($data['phone']) ? $data['phone'] : null,
            !empty($data['email']) ? $data['email'] : null,
            !empty($data['identification']) ? $data['identification'] : null,
            !empty($data['date_birth']) ? $data['date_birth'] : null,
            !empty($data['sex']) ? $data['sex'] : null,
            !empty($data['request']) ? $data['request'] : null,
            $data['booking_id'],
            !empty($data['address']) ? $data['address'] : null,
        ]);
    }


    public function delete($id)
    {
        return $this->execute("DELETE FROM guest WHERE id = ?", [$id]);
    }
    public function addGuest($data)
    {
        $sql = "INSERT INTO guest
    (booking_id, name, phone, email, age, date_birth, sex, address, identification, request)
    VALUES (:booking_id, :name, :phone, :email, :age, :date_birth, :sex, :address, :identification, :request)";

        $stmt = $this->pdo->prepare($sql); // <-- dùng $this->pdo

        $stmt->execute([
            'booking_id' => $data['booking_id'],
            'name' => $data['name'],
            'phone' => !empty($data['phone']) ? $data['phone'] : null,
            'email' => !empty($data['email']) ? $data['email'] : null,
            'age' => !empty($data['age']) ? (int)$data['age'] : null,
            'date_birth' => !empty($data['date_birth']) ? $data['date_birth'] : null,
            'sex' => !empty($data['sex']) ? $data['sex'] : null,
            'address' => !empty($data['address']) ? $data['address'] : null,
            'identification' => !empty($data['identification']) ? (int)$data['identification'] : null,
            'request' => !empty($data['request']) ? $data['request'] : null,
        ]);
    }
}
