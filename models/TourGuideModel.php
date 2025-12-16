<?php

class TourGuideModel extends BaseModel
{
    protected $table = "tour_guides";

    /* =========================
        DANH SÁCH HDV
    ========================= */
    public function getAll()
    {
        $sql = "
            SELECT 
                tg.id AS guide_id,
                tg.avata_id,
                tg.phone,
                tg.experience_years,
                tg.language,
                tg.classify,
                tg.status,

                u.full_name,
                u.email
            FROM tour_guides tg
            JOIN users u ON tg.user_id = u.id
            WHERE u.role_id =2
            ORDER BY tg.id DESC
        ";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================
        CHI TIẾT 1 HDV
    ========================= */
    public function findById($id)
    {
        $sql = "
            SELECT 
                tg.*,
                u.full_name,
                u.email
            FROM tour_guides tg
            JOIN users u ON tg.user_id = u.id
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
            INSERT INTO tour_guides
            (user_id, date_birth, avata_id, phone, history, evaluate, health,
             certificate, license_number, license_expiry,
             experience_years, language, classify, status)
            VALUES
            (:user_id, :date_birth, :avata_id, :phone, :history, :evaluate, :health,
             :certificate, :license_number, :license_expiry,
             :experience_years, :language, :classify, 1)
        ";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_id'          => $data['user_id'],
            ':date_birth'       => $data['date_birth'] ?? null,
            ':avata_id'         => $data['avata_id'] ?? null,
            ':phone'            => $data['phone'],
            ':history'          => $data['history'] ?? null,
            ':evaluate'         => $data['evaluate'] ?? null,
            ':health'           => $data['health'] ?? null,
            ':certificate'      => $data['certificate'] ?? null,
            ':license_number'   => $data['license_number'] ?? null,
            ':license_expiry'   => $data['license_expiry'] ?? null,
            ':experience_years' => $data['experience_years'],
            ':language'         => $data['language'],
            ':classify'         => $data['classify']
        ]);
    }

    /* =========================
        CẬP NHẬT HDV
    ========================= */
    public function update($id, $data)
    {
        $sql = "
            UPDATE tour_guides SET
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
            ':phone'            => $data['phone'],
            ':experience_years' => $data['experience_years'],
            ':language'         => $data['language'],
            ':classify'         => $data['classify'],
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
        $stmt = $this->pdo->prepare(
            "DELETE FROM tour_guides WHERE id = :id"
        );

        return $stmt->execute(['id' => $id]);
    }
}
