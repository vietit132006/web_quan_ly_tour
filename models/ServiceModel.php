<?php
class ServiceModel extends BaseModel
{
    protected $table = "sevices";

    public function getAllServiceModel()
    {
        $sql = "SELECT * FROM service WHERE status = 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
