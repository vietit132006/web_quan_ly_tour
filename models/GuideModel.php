<?php
class GuideModel extends BaseModel
{
    protected $table = "tour_guides";

    public function getAllActiveGuides()
    {
        $sql = "SELECT tg.id AS guide_id, u.full_name, u.email, u.phone
                FROM {$this->table} tg
                JOIN users u ON tg.user_id = u.id
                WHERE tg.status = 1
                ORDER BY u.full_name ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
