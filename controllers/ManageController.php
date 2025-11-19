<?php
class ManageController
{
    private $pdo;

    public function __construct()
    {
        // Kết nối DB
        $this->pdo = new PDO(
            "mysql:host=localhost;dbname=tour_management;charset=utf8mb4",
            "root", "",
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
        try {
    $pdo = new PDO("mysql:host=localhost;dbname=tour_management;charset=utf8mb4", "root", "");
    echo "Kết nối DB thành công!";
} catch (PDOException $e) {
    echo "Lỗi kết nối DB: " . $e->getMessage();
}

    }

    public function index() 
    {
        // Lấy dữ liệu từ database
        $tour_group = $this->getTourGroups();
        $guides     = $this->getGuides();
        $services   = $this->getServices();
        $users = $this->getUsers();

        require_once PATH_VIEW . 'manage.php';
    }
public function saveGroup()
{
    $id             = $_POST['id'] ?? null;
    $tour_id        = $_POST['tour_id'];
    $start_date     = $_POST['start_date'];
    $end_date       = $_POST['end_date'];
    $total_days     = $_POST['total_days'];
    $departure_time = $_POST['departure_time'];
    $number_guests  = $_POST['number_guests'];
    $guide_id       = $_POST['guide_id'];
    $services       = $_POST['services'] ?? []; // multiple service_id

    if ($id) {
        // --- CẬP NHẬT ---
        $sql = "UPDATE tour_group 
                SET tour_id=?, start_date=?, end_date=?, total_days=?, departure_time=?, number_guests=?, guide_id=?
                WHERE id=?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $tour_id,
            $start_date,
            $end_date,
            $total_days,
            $departure_time,
            $number_guests,
            $guide_id,
            $id
        ]);

        // Xóa dịch vụ cũ
        $this->pdo->prepare("DELETE FROM group_service WHERE group_id=?")->execute([$id]);

        // Thêm dịch vụ mới
        foreach ($services as $sv) {
            $this->pdo->prepare(
                "INSERT INTO group_service (group_id, service_id) VALUES (?,?)"
            )->execute([$id, $sv]);
        }

    } else {
        // --- THÊM MỚI ---
        $sql = "INSERT INTO tour_group (tour_id, start_date, end_date, total_days, departure_time, number_guests, guide_id) 
                VALUES (?,?,?,?,?,?,?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $tour_id,
            $start_date,
            $end_date,
            $total_days,
            $departure_time,
            $number_guests,
            $guide_id
        ]);

        $new_id = $this->pdo->lastInsertId();

        // Thêm dịch vụ
        foreach ($services as $sv) {
            $this->pdo->prepare(
                "INSERT INTO group_service (group_id, service_id) VALUES (?,?)"
            )->execute([$new_id, $sv]);
        }
    }

    echo "OK";
    exit;
}


    private function getTourGroups()
    {
        $stmt = $this->pdo->query("SELECT tour_group.*, tours.name AS tour_name, service.name AS service_name FROM tour_group JOIN tours ON tour_group.tour_id = tours.id JOIN service ON tour_group.service_id = service.id;"); // bảng tour_groups
        return $stmt->fetchAll();
    }

    private function getGuides()
    {
        $stmt = $this->pdo->query("SELECT * FROM tour_guides"); // bảng guides
        return $stmt->fetchAll();
    }

    private function getServices()
    {
        $stmt = $this->pdo->query("SELECT * FROM service"); // bảng services
        return $stmt->fetchAll();
    }

    private function getUsers()
{
    $stmt = $this->pdo->query("SELECT tour_guides.*, users.full_name FROM tour_guides JOIN users ON tour_guides.user_id = users.id");
    
    return $stmt->fetchAll();
}


}
