<?php
class UserModel extends BaseModel
{
    protected $table = "users";

    /* =========================
        LẤY DANH SÁCH USER
    ========================= */
    public function getAllUsers()
    {
        $sql = "
            SELECT 
                u.id, u.username, u.full_name, u.email, u.phone, u.role_id, u.avatar, u.status, u.created_at,
                r.name AS role_name, r.description AS role_description
            FROM users u
            LEFT JOIN roles r ON u.role_id = r.id
            ORDER BY u.created_at DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
        LẤY USER THEO ID
    ========================= */
    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
        TẠO USER MỚI
    ========================= */
    public function createUser($data)
    {
        $sql = "
            INSERT INTO {$this->table} 
                (username, password_hash, full_name, email, phone, role_id, avatar, status, created_at)
            VALUES 
                (:username, :password_hash, :full_name, :email, :phone, :role_id, :avatar, :status, NOW())
        ";
        $stmt = $this->pdo->prepare($sql);
        $result = $stmt->execute([
            ':username'      => $data['username'],
            ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
            ':full_name'     => $data['full_name'],
            ':email'         => $data['email'],
            ':phone'         => $data['phone'],
            ':role_id'       => $data['role_id'] ?? 2, // 2 = Guide mặc định
            ':avatar'        => $data['avatar'] ?? null,
            ':status'        => $data['status'] ?? 1
        ]);

        if ($result) {
            return $this->pdo->lastInsertId(); // trả về ID user mới tạo
        }
        return false;
    }

    /* =========================
        CẬP NHẬT USER
    ========================= */
    public function updateUser($id, $data)
    {
        $fields = [];
        $params = [];
        foreach ($data as $key => $value) {
            $fields[] = "$key = :$key";
            $params[":$key"] = $value;
        }
        $params[':id'] = $id;

        $sql = "UPDATE {$this->table} SET " . implode(', ', $fields) . " WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /* =========================
        XÓA USER (kèm tour_guides)
    ========================= */
    public function deleteUser($id)
    {
        try {
            $this->pdo->beginTransaction();

            // Xóa HDV nếu có
            $stmt1 = $this->pdo->prepare("DELETE FROM tour_guides WHERE user_id = :id");
            $stmt1->execute(['id' => $id]);

            // Xóa user
            $stmt2 = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
            $stmt2->execute(['id' => $id]);

            $this->pdo->commit();
            return true;
        } catch (PDOException $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    /* =========================
        LẤY DANH SÁCH ROLE
    ========================= */
    public function getAllRoles()
    {
        $stmt = $this->pdo->prepare("SELECT id, name, description, created_at FROM roles ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
        LẤY DANH SÁCH HDV
    ========================= */
    public function getAllGuides()
    {
        $sql = "
            SELECT tg.id AS guide_id, u.id AS user_id, u.full_name, u.email, u.phone
            FROM tour_guides tg
            JOIN users u ON tg.user_id = u.id
            WHERE u.role_id = 2 AND tg.status = 1
            ORDER BY u.full_name ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
        LẤY USER THEO USERNAME (ĐĂNG NHẬP)
    ========================= */
    public function getUserByUsername($username)
    {
        $sql = "
            SELECT u.*, r.name AS role_name 
            FROM users u
            LEFT JOIN roles r ON u.role_id = r.id
            WHERE u.username = :username
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
        CẬP NHẬT LẦN ĐĂNG NHẬP CUỐI
    ========================= */
    public function updateLastLogin($id)
    {
        $stmt = $this->pdo->prepare("UPDATE users SET last_login = NOW() WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function getLastInsertId()
    {
        return $this->pdo->lastInsertId();
    }
}
