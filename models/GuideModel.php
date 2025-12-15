<?php
class GuideModel extends BaseModel
{
    protected $table = "tour_guides";

    public function getAllActiveGuides()
    {
        $sql = "
            SELECT 
                tg.id,
                u.full_name,
                u.email,
                u.phone,
                tg.experience_years,
                tg.language
            FROM {$this->table} tg
            JOIN users u ON tg.user_id = u.id
            WHERE tg.status = 1
            ORDER BY u.full_name ASC
        ";

        return $this->query($sql)->fetchAll();
    }
}
