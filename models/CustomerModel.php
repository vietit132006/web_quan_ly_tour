<?php

class CustomerModel extends BaseModel
{
    protected $table = 'customers';

    // =========================
    // TÌM KHÁCH THEO SĐT (ƯU TIÊN)
    // =========================
    public function findByPhone($phone)
    {
        $sql = "SELECT * FROM customers WHERE phone = ? LIMIT 1";
        return $this->query($sql, [$phone])->fetch();
    }

    // =========================
    // TÌM KHÁCH THEO EMAIL
    // =========================
    public function findByEmail($email)
    {
        $sql = "SELECT * FROM customers WHERE email = ? LIMIT 1";
        return $this->query($sql, [$email])->fetch();
    }

    // =========================
    // TẠO HOẶC LẤY CUSTOMER
    // =========================
    public function findOrCreate($data)
    {
        // 1. Ưu tiên tìm theo SĐT
        if (!empty($data['phone'])) {
            $customer = $this->findByPhone($data['phone']);
            if ($customer) {
                return $customer['id'];
            }
        }

        // 2. Nếu không có SĐT thì tìm theo email
        if (!empty($data['email'])) {
            $customer = $this->findByEmail($data['email']);
            if ($customer) {
                return $customer['id'];
            }
        }

        // 3. Không tồn tại → tạo mới
        $sql = "
            INSERT INTO customers (name, phone, email, address)
            VALUES (?, ?, ?, ?)
        ";

        $this->execute($sql, [
            $data['name'],
            $data['phone'] ?? null,
            $data['email'] ?? null,
            $data['address'] ?? null
        ]);

        return $this->lastInsertId();
    }

    // =========================
    // LẤY CUSTOMER THEO ID
    // =========================
    public function find($id)
    {
        $sql = "
        SELECT 
            b.*,
            c.name  AS customer_name,
            c.phone AS customer_phone,
            c.email AS customer_email,
            c.address AS customer_address
        FROM booking b
        JOIN customers c ON b.customer_id = c.id
        WHERE b.id = ?
    ";
        return $this->query($sql, [$id])->fetch();
    }
}
