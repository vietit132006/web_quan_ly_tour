<?php
class ServiceModel extends BaseModel
{
    protected $table = "service"; // ✅ ĐÚNG tên bảng

    // ✅ ĐÚNG TÊN HÀM – controller gọi được
    public function getAll()
    {
        $sql = "SELECT id, name, price FROM service WHERE status = 1";
        return $this->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
    // ✅ LẤY 1 DỊCH VỤ THEO ID
    public function find($id)
    {
        $sql = "SELECT * FROM service WHERE id = ?";
        return $this->query($sql, [$id])->fetch(PDO::FETCH_ASSOC);
    }
}
