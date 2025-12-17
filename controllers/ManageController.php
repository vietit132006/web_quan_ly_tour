<?php

class ManageController
{
    private $groupModel;
    private $tourModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
        $this->tourModel = new TourModel();
    }

    // Hiển thị danh sách nhóm
    public function index()
    {
        $tour_group = $this->groupModel->all();
        $tours = (new TourModel())->getAllTours();
        $guides = (new GuideModel())->getAllActiveGuides();
        $services = (new ServiceModel())->getAll();

        // ✅ GÁN VIEW
        $view = PATH_VIEW . "Manage/manage.php";

        // ✅ LOAD LAYOUT CHUNG
        require_once PATH_VIEW . "layout/admin/master.php";
    }



    // Lưu dữ liệu mới
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Phải submit bằng POST!");
        }

        $data = [
            'tour_id'        => $_POST['tour_id'] ?? null,
            'start_date'     => $_POST['start_date'] ?? null,
            'end_date'       => $_POST['end_date'] ?? null,
            'number_guests'  => (int) ($_POST['number_guests'] ?? 0),
            'total_days'     => (int) ($_POST['total_days'] ?? 0),
            'services'       => isset($_POST['services']) ? array_map('intval', $_POST['services']) : [],
            'departure_time' => $_POST['departure_time'] ?? null,
            'guide_id'       => $_POST['guide_id'] ?? null
        ];
        $tour_id = $_POST['tour_id'] ?? null;
        if (!$tour_id) {
            header("Location: ?action=manage&error=missing_tour");
            exit;
        }

        $this->groupModel->insert($data);

        $_SESSION['success'] = "Thêm tour group thành công!";
        header("Location: ?action=manage");
        exit;
    }

    // Hiển thị form edit
    public function edit($id)
    {
        $tours = (new TourModel())->getAllTours();
        $guides = (new GuideModel())->getAllActiveGuides();
        $services = (new ServiceModel())->getAll();

        $group = $this->groupModel->find($id);
        $selectedServices = $this->groupModel->getServices($id);
        require_once PATH_VIEW . "Manage/manage-edit-modal.php";
    }

    // Xóa dữ liệu
    public function delete($id)
    {
        if (!$id) {
            $_SESSION['error'] = "Không tìm thấy ID cần xóa!";
            header("Location: ?action=manage");
            exit;
        }

        $this->groupModel->delete($id);

        $_SESSION['success'] = "Xóa tour group thành công!";
        header("Location: ?action=manage");
        exit;
    }


    // Cập nhật dữ liệu
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Phải submit bằng POST!");
        }

        $data = [
            'tour_id'        => $_POST['tour_id'] ?? null,
            'start_date'     => $_POST['start_date'] ?? null,
            'end_date'       => $_POST['end_date'] ?? null,
            'number_guests'  => (int) ($_POST['number_guests'] ?? 0),
            'total_days'     => (int) ($_POST['total_days'] ?? 0),
            'services'       => isset($_POST['services']) ? array_map('intval', $_POST['services']) : [],
            'departure_time' => $_POST['departure_time'] ?? null,
            'guide_id'       => $_POST['guide_id'] ?? null
        ];

        $this->groupModel->update($id, $data);

        $_SESSION['success'] = "Cập nhật tour group thành công!";
        header("Location: ?action=manage");
        exit;
    }
}
