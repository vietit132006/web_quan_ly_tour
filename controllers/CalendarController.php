<?php
require_once PATH_ROOT . 'models/CalendarModel.php';

class CalendarController
{
    private CalendarModel $calendarModel;

    public function __construct()
    {
        $this->calendarModel = new CalendarModel();
    }

    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            die('Chưa đăng nhập');
        }

        // 🔥 LẤY GUIDE_ID ĐÚNG
        $guide = (new GuideModel())->findByUserId($userId);
        if (!$guide) {
            die('Tài khoản chưa là hướng dẫn viên');
        }

        $guideId = $guide['id'];

        $tours = $this->calendarModel->getToursByGuideId($guideId);

        $view = PATH_VIEW . "tour_guide/calendar/calendar.php";
        require PATH_VIEW . "layout/tour_guide/master.php";
    }

    public function detail()
    {
        $userId    = $_SESSION['user']['id'];
        $bookingId = $_GET['id'] ?? null;

        $guide = (new GuideModel())->findByUserId($userId);
        $guideId = $guide['id'];

        $booking = $this->calendarModel->getBookingDetail($bookingId, $guideId);

        if (!$booking) {
            die('❌ Không tìm thấy booking hoặc bạn không được phân công');
        }
        $guests  = $this->calendarModel->getGuestsByBooking($bookingId);

        $view = PATH_VIEW . "tour_guide/calendar/calendar_detail.php";
        require PATH_VIEW . "layout/tour_guide/master.php";
    }

    public function confirm()
    {
        (new CalendarModel())->confirmBooking($_GET['id']);
        header('Location: index.php?action=calendar');
    }

    public function reject()
    {
        (new CalendarModel())->rejectBooking($_GET['id']);
        header('Location: index.php?action=calendar');
    }
}
