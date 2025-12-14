<?php
require_once __DIR__ . '/../configs/database.php';

class BaseModel
{
    protected $table;
    protected $pdo;

    public function __construct()
    {
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            DB_HOST,
            DB_PORT,
            DB_NAME
        );

        try {
            $this->pdo = new PDO(
                $dsn,
                DB_USERNAME,
                DB_PASSWORD,
                DB_OPTIONS
            );
        } catch (PDOException $e) {
            die("Kết nối CSDL thất bại: " . $e->getMessage());
        }
    }

    /* ================= CORE QUERY ================= */

    protected function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    protected function execute($sql, $params = [])
    {
        $this->query($sql, $params);
        return true;
    }

    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }

    public function __destruct()
    {
        $this->pdo = null;
    }

    public function query_all($sql, $params = [])
{
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
