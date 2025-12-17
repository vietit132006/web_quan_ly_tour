<?php
class GuideModel extends BaseModel
{
    public function getAllActiveGuides()
    {
        $sql = "
            SELECT 
                tg.id AS guide_id, 
                u.full_name, 
                u.phone
            FROM tour_guides tg
            JOIN users u ON tg.user_id = u.id
            WHERE tg.status = 1 AND u.role_id = 2
            ORDER BY u.full_name ASC
        ";
        return $this->query($sql)->fetchAll();
    }

    public function findByUserId($userId)
    {
        $sql = "SELECT * FROM tour_guides WHERE user_id = ?";
        return $this->query($sql, [$userId])->fetch();
    }
}
