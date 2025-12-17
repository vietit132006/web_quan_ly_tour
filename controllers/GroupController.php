<?php
require_once PATH_ROOT . 'models/GroupModel.php';

class GroupController
{

    protected $groupModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
    }

    public function store()
    {
        // DEBUG BẮT BUỘC (để không trắng trang)
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Method not allowed');
        }

        if (empty($_POST['booking_id']) || empty($_POST['guide_id'])) {
            die('Thiếu booking_id hoặc guide_id');
        }

        $data = [
            'booking_id'     => $_POST['booking_id'],
            'tour_id'        => $_POST['tour_id'],
            'guide_id'       => $_POST['guide_id'],
            'start_date'     => $_POST['start_date'],
            'end_date'       => $_POST['end_date'],
            'departure_time' => $_POST['departure_time'],
            'total_days'     => $_POST['total_days'],
            'address'        => $_POST['address'] ?? null,
            'note'           => $_POST['note'] ?? null,
        ];

        $this->groupModel->create($data);

        header("Location: index.php?action=booking-detail&id=" . $_POST['booking_id']);
        exit;
    }
    // Danh sách nhóm tour
    public function index()
    {
        $groups = $this->groupModel->all();

        require PATH_ROOT . 'views/group/index.php';
    }
    // Chi tiết nhóm tour
    public function detail($id = null)
    {
        if (!$id) {
            die('ID nhóm tour không hợp lệ');
        }

        $group = $this->groupModel->find($id);
        if (!$group) {
            die('Nhóm tour không tồn tại');
        }

        require PATH_ROOT . 'views/group/detail.php';
    }
    public function create()
    {
        // Lấy booking_id từ query string
        $bookingId = $_GET['booking_id'] ?? null;
        if (!$bookingId) {
            die('Thiếu booking_id');
        }

        // Lấy thông tin booking
        $bookingModel = new BookingModel();
        $booking = $bookingModel->find($bookingId);
        if (!$booking) {
            die('Booking không tồn tại');
        }

        // Lấy danh sách hướng dẫn viên
        $guideModel = new GuideModel();
        $guides = $guideModel->getAllActiveGuides();

        require PATH_ROOT . 'views/tour_group/create.php';
    }
}
