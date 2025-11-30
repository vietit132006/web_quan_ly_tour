<?php
class ServiceModel extends BaseModel
{
    protected $table = "sevices";

    public function getAllServiceModel()
    {
        $sql = "SELECT service.name FROM service";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
