<?php
// Đổi tên từ ProductModel thành TourModel cho phù hợp với dữ liệu tour
class TourModel extends BaseModel
{
    // Đổi tên bảng từ "product" sang "tours"
    protected $table = "tours";

    // ===================================
    // 1. Lấy tất cả (Read All)
    // ===================================
    public function getAllTours()
    {
        // Lấy tất cả các cột cần thiết, sắp xếp theo ngày tạo mới nhất
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================================
    // 2. Lấy theo ID (Read One)
    // ===================================
    public function getTourById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ===================================
    // 3. Thêm Tour (Create)
    // ===================================
    // Các tham số phải khớp với các cột có thể CHÈN (bỏ qua id, created_at)
    public function addTour($data)
    {
        $sql = "INSERT INTO tours
(name, base_price, duration, description, status, tour_category_id, so_nguoi, image)
VALUES
(:name, :base_price, :duration, :description, :status, :tour_category_id, :so_nguoi, :image)
";

        $stmt = $this->pdo->prepare($sql);
        // $data phải chứa 6 key: name, base_price, duration, description, status, tour_category_id
        return $stmt->execute($data);
    }

    // ===================================
    // 4. Cập nhật Tour (Update)
    // ===================================
    public function updateTour($id, $data)
    {
        $data['id'] = $id;

        $sql = "UPDATE tours SET
                name = :name,
                base_price = :base_price,
                duration = :duration,
                description = :description,
                status = :status,
                tour_category_id = :tour_category_id,
                so_nguoi = :so_nguoi,
                image = :image
            WHERE id = :id";

        return $this->pdo->prepare($sql)->execute($data);
    }


    // ===================================
    // 5. Xóa Tour (Delete)
    // ===================================
    public function deleteTour($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]); // Đảm bảo key truyền vào là 'id'
    }
    public function searchTours($filters)
    {
        $sql = "SELECT * FROM {$this->table} WHERE 1";
        $params = [];

        // Tìm theo tên
        if (!empty($filters['keyword'])) {
            $sql .= " AND name LIKE :keyword";
            $params['keyword'] = '%' . $filters['keyword'] . '%';
        }

        // Lọc danh mục
        if (!empty($filters['category'])) {
            $sql .= " AND tour_category_id = :category";
            $params['category'] = $filters['category'];
        }

        // Lọc giá
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

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
