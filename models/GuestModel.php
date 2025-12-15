<?php

class GuestModel extends BaseModel
{
    protected $table = 'guest';

    /**
     * Lấy danh sách khách theo booking
     */
    public function getByBooking($bookingId)
    {
        $sql = "SELECT * FROM {$this->table} WHERE booking_id = ?";
        return $this->query($sql, [$bookingId])->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Thêm 1 khách
     */
    public function create($data)
    {
        $sql = "
            INSERT INTO {$this->table}
            (
                booking_id,
                name,
                phone,
                email,
                identification,
                date_birth,
                sex,
                address,
                request
            )
            VALUES
            (
                :booking_id,
                :name,
                :phone,
                :email,
                :identification,
                :date_birth,
                :sex,
                :address,
                :request
            )
        ";

        return $this->execute($sql, [
            'booking_id'     => $data['booking_id'],
            'name'           => $data['name'],
            'phone'          => $data['phone'] ?? null,
            'email'          => $data['email'] ?? null,
            'identification' => $data['identification'] ?? null,
            'date_birth'     => $data['date_birth'] ?? null,
            'sex'            => $data['sex'] ?? null,
            'address'        => $data['address'] ?? null,
            'request'        => $data['request'] ?? null,
        ]);
    }

    /**
     * Xoá khách
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        return $this->execute($sql, [$id]);
    }
}
