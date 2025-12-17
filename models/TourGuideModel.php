<?php

class TourGuideModel extends BaseModel
{
    protected $table = "tour_guides";

    // Lấy danh sách hướng dẫn viên
    public function getAllTourGuides()
    {
        $sql = "SELECT 
            tour_guides.id,
            tour_guides.user_id,
            tour_guides.date_birth,
            tour_guides.avata_id,
            tour_guides.phone,
            tour_guides.history,
            tour_guides.evaluate,
            tour_guides.health,
            tour_guides.certificate,
            tour_guides.license_number,
            tour_guides.license_expiry,
            tour_guides.experience_years,
            tour_guides.language,
            tour_guides.classify,
            tour_guides.status,

            users.full_name AS user_full_name,
            users.email AS user_email,
            tour_guides.avata_id AS avatar,


            roles.name AS role_name,
            roles.description AS role_description

        FROM tour_guides
        LEFT JOIN users ON tour_guides.user_id = users.id
        LEFT JOIN roles ON users.role_id = roles.id
        ORDER BY tour_guides.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Danh sách guide đang hoạt động
    public function getActiveGuides()
    {
        $sql = "
            SELECT 
                g.id,
                u.full_name,
                u.phone,
                g.experience_years,
                g.language,
                g.classify
            FROM tour_guides g
            JOIN users u ON u.id = g.user_id
            WHERE g.status = 1
            ORDER BY u.full_name
        ";

        return $this->query($sql)->fetchAll();
    }


    // Lấy thông tin 1 hướng dẫn viên
    public function getTourGuideById($id)
    {
        $sql = "SELECT 
                tour_guides.*,
                users.full_name AS user_full_name,
                users.email AS user_email,
                roles.name AS role_name
            FROM tour_guides
            LEFT JOIN users ON tour_guides.user_id = users.id
            LEFT JOIN roles ON users.role_id = roles.id
            WHERE tour_guides.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // Tạo mới hướng dẫn viên
    public function createTourGuide($data)
    {
        $sql = "INSERT INTO tour_guides 
                (user_id, date_birth, avata_id, phone, history, evaluate, health, certificate, 
                 license_number, license_expiry, experience_years, language, classify, status)
                VALUES
                (:user_id, :date_birth, :avata_id, :phone, :history, :evaluate, :health, :certificate,
                 :license_number, :license_expiry, :experience_years, :language, :classify, :status)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_id'         => $data['user_id'],
            ':date_birth'      => $data['date_birth'],
            ':avata_id'       => $data['avata_id'] ?? null,
            ':phone'           => $data['phone'],
            ':history'         => $data['history'] ?? null,
            ':evaluate'        => $data['evaluate'] ?? null,
            ':health'          => $data['health'] ?? null,
            ':certificate'     => $data['certificate'] ?? null,
            ':license_number'  => $data['license_number'],
            ':license_expiry'  => $data['license_expiry'],
            ':experience_years' => $data['experience_years'],
            ':language'        => $data['language'],
            ':classify'        => $data['classify'],
            ':status'          => $data['status'] ?? 1
        ]);
    }


    // Cập nhật hướng dẫn viên
    public function updateTourGuide($id, $data)
    {
        $sql = "UPDATE tour_guides SET
                    user_id = :user_id,
                    date_birth = :date_birth,
                    avata_id = :avatar_id,
                    phone = :phone,
                    history = :history,
                    evaluate = :evaluate,
                    health = :health,
                    certificate = :certificate,
                    license_number = :license_number,
                    license_expiry = :license_expiry,
                    experience_years = :experience_years,
                    language = :language,
                    classify = :classify,
                    status = :status
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':user_id'         => $data['user_id'],
            ':date_birth'      => $data['date_birth'],
            ':avata_id'       => $data['avatar_id'] ?? null,
            ':phone'           => $data['phone'],
            ':history'         => $data['history'] ?? null,
            ':evaluate'        => $data['evaluate'] ?? null,
            ':health'          => $data['health'] ?? null,
            ':certificate'     => $data['certificate'] ?? null,
            ':license_number'  => $data['license_number'],
            ':license_expiry'  => $data['license_expiry'],
            ':experience_years' => $data['experience_years'],
            ':language'        => $data['language'],
            ':classify'        => $data['classify'],
            ':status'          => $data['status'],
            ':id'              => $id
        ]);
    }

    // ================== BOOKING - GUIDE ==================

    // Lấy danh sách hướng dẫn viên theo booking
    public function getGuidesByBooking($bookingId)
    {
        $sql = "
        SELECT 
            tg.id AS guide_id,
            u.full_name,
            u.phone,
            u.email,
            tg.experience_years,
            tg.language,
            tg.classify
        FROM booking_guides bg
        JOIN tour_guides tg ON bg.guide_id = tg.id
        JOIN users u ON tg.user_id = u.id
        WHERE bg.booking_id = ?
    ";

        return $this->query($sql, [$bookingId])->fetchAll(PDO::FETCH_ASSOC);
    }


    // Gán hướng dẫn viên cho booking
    public function assignGuideToBooking($bookingId, $guideId)
    {
        // Không cho gán trùng
        $check = "
        SELECT COUNT(*) 
        FROM booking_guides 
        WHERE booking_id = ? AND guide_id = ?
    ";

        if ($this->query($check, [$bookingId, $guideId])->fetchColumn() > 0) {
            return false;
        }

        $sql = "
        INSERT INTO booking_guides (booking_id, guide_id)
        VALUES (?, ?)
    ";

        return $this->query($sql, [$bookingId, $guideId]);
    }

    // Xóa hướng dẫn viên
    public function deleteTourGuide($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tour_guides WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
