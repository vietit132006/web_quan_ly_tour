<?php
class UserModel extends BaseModel
{
    protected $table = "users";

    public function getAllUsers()
    {
        // Lấy tất cả các cột cần thiết, sắp xếp theo ngày tạo mới nhất
        $sql = "SELECT 
    users.id,
    users.username,
    users.password_hash,
    users.full_name,
    users.email,
    users.phone,
    users.role_id,
    users.avatar,
    users.status,
    users.last_login,
    users.created_at,

    roles.name AS role_name,
    roles.description AS role_description,
    roles.created_at AS role_created_at

FROM users
LEFT JOIN roles 
       ON users.role_id = roles.id;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function createUser($data)
{
    $sql = "INSERT INTO users 
            (username, password_hash, full_name, email, phone, role_id, avatar, status, created_at)
            VALUES 
            (:username, :password_hash, :full_name, :email, :phone, :role_id, :avatar, :status, NOW())";

    $stmt = $this->pdo->prepare($sql);

    return $stmt->execute([
        ':username'      => $data['username'],
        ':password_hash' => password_hash($data['password'], PASSWORD_DEFAULT),
        ':full_name'     => $data['full_name'],
        ':email'         => $data['email'],
        ':phone'         => $data['phone'],
        ':role_id'       => $data['role_id'],
        ':avatar'        => $data['avatar'] ?? null,
        ':status'        => $data['status'] ?? 1,
    ]);
}



    //role
    public function getAllRoles()
    {
        // Lấy tất cả các cột cần thiết, sắp xếp theo ngày tạo mới nhất
        $sql = "SELECT id, name, description ,created_at FROM roles ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
      public function getRoleById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM roles WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Hướng dẫn viên
    public function getAllGuides()
{
    // Giả sử role_id = 3 là hướng dẫn viên
    $sql = "SELECT tg.id AS guide_id, u.full_name, u.email, u.phone
FROM tour_guides tg
JOIN users u ON tg.user_id = u.id
WHERE tg.status = 1
ORDER BY u.full_name ASC
";
    
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
