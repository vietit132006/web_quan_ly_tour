<?php

class ManageController extends DB
{
    private $groupModel;
    private $tourModel;

    public function __construct()
    {
        parent::__construct();
        $this->groupModel = new GroupModel();
        $this->tourModel = new TourModel(); 
    }

    // Hiển thị danh sách nhóm
    public function index()
    {
        $tour_group = $this->groupModel->all();
        require_once PATH_VIEW . "Manage/manage.php";
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
        require_once PATH_VIEW . "Manage/manage-create.php";
    }

    // Xử lý lưu dữ liệu mới
    public function store()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        die("Phải submit bằng POST form!");
    }

    $data = [
        'tour_id'        => $_POST['tour_id'] ?? null,
        'start_date'     => $_POST['start_date'] ?? null,
        'end_date'       => $_POST['end_date'] ?? null,
        'number_guests'  => (int) ($_POST['number_guests'] ?? 0),
        'total_days'     => (int) ($_POST['total_days'] ?? 0),
        'services'       => isset($_POST['services']) && is_array($_POST['services'])
                            ? array_map('intval', $_POST['services'])
                            : [],
        'departure_time' => $_POST['departure_time'] ?? null,
        'guide_id'       => $_POST['guide_id'] ?? null
    ];

    $groupId = $this->groupModel->insert($data);

    $_SESSION['success'] = "Thêm tour group thành công!";
    header("Location: ?action=manage");
    exit;
}

}
