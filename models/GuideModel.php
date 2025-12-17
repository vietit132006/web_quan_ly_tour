<?php
class GuideModel extends BaseModel
{
    public function getAllActiveGuides()
    {
        $sql = "SELECT id, full_name, phone 
                FROM users 
                WHERE role_id = 2 AND status = 1 
                ORDER BY full_name ASC";
        return $this->query($sql)->fetchAll();
    }

    public function findByUserId($userId)
    {
        $sql = "SELECT * FROM tour_guides WHERE user_id = ?";
        return $this->query($sql, [$userId])->fetch();
    }
}
