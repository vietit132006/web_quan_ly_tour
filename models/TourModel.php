<?php 
// Đổi tên từ ProductModel thành TourModel cho phù hợp với dữ liệu tour
class TourModel extends BaseModel 
{
    // Đổi tên bảng từ "product" sang "tours"
    protected $table = "tours"; 
    
    // ===================================
    // 1. Lấy tất cả (Read All)
    // ===================================
    public function getAllTours(){
        // Lấy tất cả các cột cần thiết, sắp xếp theo ngày tạo mới nhất
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ===================================
    // 2. Lấy theo ID (Read One)
    // ===================================
    public function getTourById($id){
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
        $sql = "INSERT INTO {$this->table} 
                (name, base_price, duration, description, status, tour_category_id)
                VALUES 
                (:name, :base_price, :duration, :description, :status, :tour_category_id)";
        
        $stmt = $this->pdo->prepare($sql);
        // $data phải chứa 6 key: name, base_price, duration, description, status, tour_category_id
        return $stmt->execute($data); 
    }
    
    // ===================================
    // 4. Cập nhật Tour (Update)
    // ===================================
    public function updateTour($id, $data){
        // Bắt buộc phải thêm id vào mảng data để truyền vào execute
        $data['id'] = $id; 
        
        // Cập nhật tất cả các cột có thể thay đổi
        $sql = "UPDATE {$this->table} SET
                    name = :name,
                    base_price = :base_price,
                    duration = :duration,
                    description = :description,
                    status = :status,
                    tour_category_id = :tour_category_id
                WHERE id = :id";
                
        $stmt = $this->pdo->prepare($sql);
        // $data phải chứa 7 key: id, name, base_price, duration, description, status, tour_category_id
        return $stmt->execute($data); 
    }
    
    // ===================================
    // 5. Xóa Tour (Delete)
    // ===================================
    public function deleteTour($id){
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]); // Đảm bảo key truyền vào là 'id'
    }
}
?>