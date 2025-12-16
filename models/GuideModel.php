<?php

class GuideModel extends BaseModel
{
    protected $table = "tour_guides";

    /* =========================
        DANH SÁCH TẤT CẢ HDV
    ========================= */
    public function getAll()
    {
        $sql = "
            SELECT 
                tg.id AS guide_id,
                tg.avata_id,
                tg.phone AS guide_phone,
                tg.experience_years,
                tg.language,
                tg.classify,
                tg.status AS guide_status,
                u.id AS user_id,
                u.full_name,
                u.email,
                r.id AS role_id,
                r.name AS role_name
            FROM {$this->table} tg
            JOIN users u ON tg.user_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE r.id = 2    -- 2 = HDV
            ORDER BY tg.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
        DANH SÁCH HDV ĐANG HOẠT ĐỘNG
    ========================= */
    public function getAllActiveGuides()
    {
        $sql = "
            SELECT 
                tg.id AS guide_id,
                tg.avata_id,
                tg.phone AS guide_phone,
                tg.experience_years,
                tg.language,
                tg.classify,
                tg.status AS guide_status,
                u.id AS user_id,
                u.full_name,
                u.email,
                r.id AS role_id,
                r.name AS role_name
            FROM {$this->table} tg
            JOIN users u ON tg.user_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE tg.status = 1 AND r.id = 2
            ORDER BY u.full_name ASC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
        LẤY CHI TIẾT 1 HDV
    ========================= */
    public function findById($id)
    {
        $sql = "
            SELECT 
                tg.*,
                u.id AS user_id,
                u.full_name,
                u.email,
                u.phone AS user_phone,
                r.id AS role_id,
                r.name AS role_name
            FROM {$this->table} tg
            JOIN users u ON tg.user_id = u.id
            JOIN roles r ON u.role_id = r.id
            WHERE tg.id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================
        THÊM HDV
    ========================= */
    public function insert($data)
    {

        $sql = "
        INSERT INTO {$this->table} 
        (user_id, date_birth, avata_id, phone, history, evaluate, health,
         certificate, license_number, license_expiry,
         experience_years, language, classify, status)
        VALUES
        (:user_id, :date_birth, :avata_id, :phone, :history, :evaluate, :health,
         :certificate, :license_number, :license_expiry,
         :experience_years, :language, :classify, :status)
    ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':user_id'          => $data['user_id'],            // ID user vừa tạo
            ':date_birth'       => $data['date_birth'] ?? null,
            ':avata_id'         => $data['avata_id'] ?? null,
            ':phone'            => $data['phone'] ?? null,
            ':history'          => $data['history'] ?? null,
            ':evaluate'         => $data['evaluate'] ?? null,
            ':health'           => $data['health'] ?? null,
            ':certificate'      => $data['certificate'] ?? null,
            ':license_number'   => $data['license_number'] ?? null,
            ':license_expiry'   => $data['license_expiry'] ?? null,
            ':experience_years' => $data['experience_years'] ?? 0,
            ':language'         => $data['language'] ?? null,
            ':classify'         => $data['classify'] ?? null,
            ':status'           => $data['status'] ?? 1
        ]);
    }

    /* =========================
        CẬP NHẬT HDV
    ========================= */
    public function update($id, $data)
    {
        $sql = "
            UPDATE {$this->table} SET
                phone = :phone,
                experience_years = :experience_years,
                language = :language,
                classify = :classify,
                evaluate = :evaluate,
                health = :health,
                status = :status
            WHERE id = :id
        ";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':phone'            => $data['phone'] ?? null,
            ':experience_years' => $data['experience_years'] ?? 0,
            ':language'         => $data['language'] ?? null,
            ':classify'         => $data['classify'] ?? null,
            ':evaluate'         => $data['evaluate'] ?? null,
            ':health'           => $data['health'] ?? null,
            ':status'           => $data['status'] ?? 1,
            ':id'               => $id
        ]);
    }

    /* =========================
        XÓA HDV
    ========================= */
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
