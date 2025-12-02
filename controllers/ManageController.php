<?php

class ManageController extends DB
{
    private $groupModel;
    private $tourModel;

    public function __construct()
    {
        parent::__construct();
        $this->groupModel = new GroupModel();
        $this->tourModel = new TourModel(); // Thêm model Tour
    }

    // Hiển thị danh sách nhóm
    public function index()
    {
        $tour_group = $this->groupModel->all(); // Lấy tất cả nhóm
        require_once PATH_VIEW . "manage.php";
    }

    // Hiển thị form tạo mới
 public function create()
{
    $tourModel = new TourModel();
    $guideModel = new GuideModel();
    $serviceModel = new ServiceModel();

    $tours = $tourModel->getAllTours();
    $guides = $guideModel->getAllActiveGuides();
    $services = $serviceModel->getAllServiceModel();
    require_once PATH_VIEW . "manage-create.php";
}
    // Xử lý lưu dữ liệu mới manager
    public function store()
    {
        // Lấy dữ liệu từ form
        $data = [
            'tour_id' => $_POST['tour_id'], // thêm tour_id
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'number_guests' => $_POST['number_guests'],
            'total_days' => $_POST['total_days'],
            'services' => $_POST['services'] ?? [], // danh sách service_id[]
            'departure_time' => $_POST['departure_time'],
            'guide_id'   => $_POST['guide_id']
        ];

        // Gọi model để insert dữ liệu
        $this->groupModel->insert($data);

        // Chuyển hướng về trang quản lý
        header("Location: " . BASE_URL . "?action=manage");
        exit;
    }
}
