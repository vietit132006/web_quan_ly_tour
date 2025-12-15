<?php

class DB
{
    protected $pdo;

    public function __construct()
    {
       $config = require __DIR__ . '/config.php';
        try {
            $this->pdo = new PDO(

                "mysql:host=localhost;dbname=" . $config['DB_NAME'] . ";charset=utf8mb4",

                "root",
                "",
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }
    public function query($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }

    // Thêm hàm lastInsertId
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
    public function execute($sql, $params = [])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }
}
