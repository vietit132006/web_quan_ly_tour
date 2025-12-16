
<?php
require_once PATH_ROOT . 'models/TourCategoryModel.php';


class TourModel extends BaseModel
{
    protected $table = "tours";

    // ============================
    // 1. LẤY TẤT CẢ TOUR
    // ============================
    public function getAllTours()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        return $this->query($sql)->fetchAll();
    }

    // ============================
    // 2. LẤY TOUR THEO ID
    // ============================
    public function getTourById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        return $this->query($sql, [$id])->fetch();
    }

    // ============================
    // 3. THÊM TOUR (CREATE)
    // ============================
    public function addTour($data)
    {
        $sql = "INSERT INTO tours
    (
        name, base_price, promo_price, duration, description, status,
        tour_category_id, so_nguoi, image, diem_di, diem_den, phuong_tien,
        start_date, end_date, total_days, total_nights, departure_time
    )
    VALUES
    (
        :name, :base_price, :promo_price, :duration, :description, :status,
        :tour_category_id, :so_nguoi, :image, :diem_di, :diem_den, :phuong_tien,
        :start_date, :end_date, :total_days, :total_nights, :departure_time
    )";

        return $this->pdo->prepare($sql)->execute([
            'name' => $data['name'],
            'base_price' => $data['base_price'],
            'promo_price' => $data['promo_price'],
            'duration' => $data['duration'],
            'description' => $data['description'],
            'status' => $data['status'],
            'tour_category_id' => $data['tour_category_id'],
            'so_nguoi' => $data['so_nguoi'],
            'image' => $data['image'],
            'diem_di' => $data['diem_di'],
            'diem_den' => $data['diem_den'],
            'phuong_tien' => $data['phuong_tien'],

            // NEW
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_days' => $data['total_days'],
            'total_nights' => $data['total_nights'],
            'departure_time' => $data['departure_time']
        ]);
    }


    // ============================
    // 4. CẬP NHẬT TOUR (UPDATE)
    // ============================
    public function updateTour($id, $data)
    {
        $sql = "UPDATE tours SET
    name = :name,
    base_price = :base_price,
    promo_price = :promo_price,
    duration = :duration,
    description = :description,
    status = :status,
    tour_category_id = :tour_category_id,
    so_nguoi = :so_nguoi,
    image = :image,
    diem_di = :diem_di,
    diem_den = :diem_den,
    phuong_tien = :phuong_tien,

    start_date = :start_date,
    end_date = :end_date,
    total_days = :total_days,
    total_nights = :total_nights,
    departure_time = :departure_time
WHERE id = :id";

        return $this->pdo->prepare($sql)->execute([
            'name' => $data['name'],
            'base_price' => $data['base_price'],
            'promo_price' => $data['promo_price'] ?? null,
            'duration' => $data['duration'],
            'description' => $data['description'],
            'status' => $data['status'],
            'tour_category_id' => $data['tour_category_id'],
            'so_nguoi' => $data['so_nguoi'],
            'image' => $data['image'],
            'diem_di' => $data['diem_di'],
            'diem_den' => $data['diem_den'],
            'phuong_tien' => $data['phuong_tien'],
            'id' => $id,
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_days' => $data['total_days'],
            'total_nights' => $data['total_nights'],
            'departure_time' => $data['departure_time'],

        ]);
    }
    // ============================
    // KIỂM TRA TOUR ĐÃ CÓ BOOKING CHƯA
    // ============================
    public function hasBooking($tourId)
    {
        $sql = "SELECT COUNT(*) FROM booking WHERE tour_id = ?";
        return $this->query($sql, [$tourId])->fetchColumn() > 0;
    }

    // ============================
    // 5. XÓA TOUR
    // ============================
    public function deleteTour($id)
    {
        // 1. Xóa lịch trình
        $this->execute(
            "DELETE FROM tour_itinerary WHERE tour_id = ?",
            [$id]
        );

        // 2. Xóa ảnh phụ
        $this->execute(
            "DELETE FROM tour_images WHERE tour_id = ?",
            [$id]
        );

        // 3. Xóa booking (nếu có)
        $this->execute(
            "DELETE FROM booking WHERE tour_id = ?",
            [$id]
        );

        // 4. Cuối cùng xóa tour
        return $this->execute(
            "DELETE FROM tours WHERE id = ?",
            [$id]
        );
    }


    // ============================
    // 6. TÌM KIẾM TOUR
    // ============================
    public function searchTours($filters)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1";
        $params = [];

        if (!empty($filters['keyword'])) {
            $sql .= " AND name LIKE ?";
            $params[] = '%' . $filters['keyword'] . '%';
        }

        if (!empty($filters['category'])) {
            $sql .= " AND tour_category_id = ?";
            $params[] = $filters['category'];
        }

        if (!empty($filters['price'])) {
            if ($filters['price'] == 1) {
                $sql .= " AND base_price < 5000000";
            } elseif ($filters['price'] == 2) {
                $sql .= " AND base_price BETWEEN 5000000 AND 10000000";
            } elseif ($filters['price'] == 3) {
                $sql .= " AND base_price > 10000000";
            }
        }

        $sql .= " ORDER BY created_at DESC";

        return $this->query($sql, $params)->fetchAll();
    }

    // ============================
    // 7. LỊCH TRÌNH TOUR
    // ============================
    public function getItineraries($tourId)
    {
        $sql = "SELECT * FROM tour_itineraries WHERE tour_id = ? ORDER BY day_number";
        return $this->query($sql, [$tourId])->fetchAll();
    }

    public function addItinerary($tourId, $day, $title, $content)
    {
        $sql = "INSERT INTO tour_itineraries (tour_id, day_number, title, content)
                VALUES (?, ?, ?, ?)";
        return $this->execute($sql, [$tourId, $day, $title, $content]);
    }

    public function deleteItineraries($tourId)
    {
        $sql = "DELETE FROM tour_itineraries WHERE tour_id = ?";
        return $this->execute($sql, [$tourId]);
    }
    // ===============================
    // HIỂN THỊ CHI TIẾT TOUR
    // ===============================
    public function detail()
    {
        if (empty($_GET['id'])) {
            die("Không tìm thấy tour!");
        }

        $id = $_GET['id'];

        $tourModel = new TourModel();
        $tour = $tourModel->getTourById($id);
        $itineraries = $tourModel->getItineraries($id);

        if (!$tour) {
            die("Tour không tồn tại!");
        }

        $view = PATH_VIEW . "Tour/tour_detail.php";
        require PATH_VIEW . "layout/master.php";
    }
    // ============================
    // LẤY NHIỀU ẢNH TOUR
    // ============================
    public function getImages($tourId)
    {
        $sql = "SELECT image FROM tour_images WHERE tour_id = ?";
        return $this->query($sql, [$tourId])->fetchAll();
    }
    // ============================
    // LƯU ẢNH CHO TOUR
    // ============================
    public function addImage($tourId, $imageName)
    {
        $sql = "INSERT INTO tour_images (tour_id, image) VALUES (?, ?)";
        return $this->execute($sql, [$tourId, $imageName]);
    }

    // (Tùy chọn) Lấy ảnh cùng với id (dùng khi muốn xóa từng ảnh)
    public function getImagesWithId($tourId)
    {
        $sql = "SELECT id, image FROM tour_images WHERE tour_id = ? ORDER BY id";
        return $this->query($sql, [$tourId])->fetchAll();
    }

    // (Tùy chọn) Xóa một ảnh theo id
    public function deleteImage($imageId)
    {
        $sql = "DELETE FROM tour_images WHERE id = ?";
        return $this->execute($sql, [$imageId]);
    }

    // LẤY min / max TRONG TourModel
    public function find($id)
    {
        $sql = "SELECT * FROM tours WHERE id = ? LIMIT 1";
        return $this->query($sql, [$id])->fetch();
    }
}
