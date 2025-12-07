<?php

class SupplierModel extends BaseModel
{
    protected $table = "suppliers";

    public function getAllSuppliers()
    {
        $sql = "SELECT * FROM suppliers ORDER BY created_at DESC";
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        $sql = "SELECT * FROM suppliers WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert($data)
    {
        $sql = "INSERT INTO suppliers 
                (name, type, contact_person, phone, email, address,
                 contract_number, contract_start, contract_end, rating, note)
                VALUES (:name, :type, :contact_person, :phone, :email, :address,
                        :contract_number, :contract_start, :contract_end, :rating, :note)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function updateSupplier($id, $data)
    {
        $data["id"] = $id;

        $sql = "UPDATE suppliers SET
                    name = :name,
                    type = :type,
                    contact_person = :contact_person,
                    phone = :phone,
                    email = :email,
                    address = :address,
                    contract_number = :contract_number,
                    contract_start = :contract_start,
                    contract_end = :contract_end,
                    rating = :rating,
                    note = :note
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function deleteSupplier($id)
    {
        $sql = "DELETE FROM suppliers WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}
