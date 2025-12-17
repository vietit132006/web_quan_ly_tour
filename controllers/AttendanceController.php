<?php
require_once PATH_ROOT . 'models/AttendanceModel.php';
class AttendanceController
{
    public function index()
    {
        $bookingId = $_GET['id'] ?? null;
        if (!$bookingId) die('Thiếu booking');

        $model = new AttendanceModel();

        $booking = $model->getBookingInfo($bookingId);
        $guests  = $model->getGuests($bookingId);

        $view = PATH_VIEW . "tour_guide/attendance/index.php";
        require_once PATH_VIEW . "layout/tour_guide/master.php";
    }

    public function store()
    {
        if (empty($_POST['booking_id'])) {
            die('❌ booking_id bị thiếu – không thể lưu điểm danh');
        }

        $bookingId = (int) $_POST['booking_id'];
        $note      = $_POST['note'] ?? '';
        $statuses  = $_POST['status'] ?? [];
        $guideId   = $_SESSION['user']['id'] ?? null;

        if (!$guideId) {
            die('❌ Chưa đăng nhập hướng dẫn viên');
        }

        $model = new AttendanceModel();

        $sessionId = $model->createSession($bookingId, $guideId, $note);

        foreach ($statuses as $guestId => $v) {
            $statuses[$guestId] = 1; // có mặt
        }

        $model->saveDetails($sessionId, $statuses);

        header("Location: index.php?action=calendar-detail&id=$bookingId");
        exit;
    }


    public function sessionDetail()
    {
        $sessionId = $_GET['id'] ?? null;
        if (!$sessionId) die('Thiếu session');

        $model = new AttendanceModel();

        $session = $model->getSessionDetail($sessionId);
        $guests  = $model->getSessionGuests($sessionId);

        $view = PATH_VIEW . "tour_guide/attendance/session_detail.php";
        require_once PATH_VIEW . "layout/tour_guide/master.php";
    }
}
