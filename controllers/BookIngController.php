<?php
require_once PATH_ROOT . 'models/BookingModel.php';
require_once PATH_ROOT . 'models/GuestModel.php';
require_once PATH_ROOT . 'models/TourLogModel.php';
require_once PATH_ROOT . 'models/TourModel.php';
require_once PATH_ROOT . 'models/BookingServiceModel.php';
require_once PATH_ROOT . 'models/CustomerModel.php';
require_once PATH_ROOT . 'models/PaymentModel.php';
require_once PATH_ROOT . 'models/TourGroupModel.php';
require_once PATH_ROOT . 'models/TourGuideModel.php';
require_once PATH_ROOT . 'models/GuideModel.php';
require_once PATH_ROOT . 'models/ServiceModel.php';



class BookingController
{
    protected $bookingModel;
    protected $guestModel;
    protected $logModel;
    protected $tourModel;
    protected $bookingServiceModel;
    protected $customerModel;
    protected $paymentModel;
    protected $tourGroupModel;
    protected $tourGuideModel;
    protected $guideModel;
    protected $serviceModel;




    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->customerModel = new CustomerModel();
        $this->guestModel   = new GuestModel();
        $this->logModel     = new TourLogModel();
        $this->tourModel    = new TourModel();
        $this->bookingServiceModel = new BookingServiceModel();
        $this->paymentModel = new PaymentModel();
        $this->tourGroupModel = new TourGroupModel();
        $this->tourGuideModel = new TourGuideModel();
        $this->guideModel = new GuideModel();
        $this->serviceModel = new ServiceModel();
    }

    // =========================
    // DANH SÁCH BOOKING
    // =========================
    public function index()
    {
        $status = $_GET['status'] ?? null;
        $bookings = $this->bookingModel->getAll($status);

        $view = PATH_VIEW . 'booking/index.php';
        require PATH_VIEW . 'layout/admin/master.php';
    }
    // =========================
    // CHI TIẾT BOOKING
    // =========================
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) die('Thiếu ID booking');

        // 1️⃣ Booking
        $booking = $this->bookingModel->find($id);
        if (!$booking) die('Booking không tồn tại');

        // 2️⃣ Related data
        $guests   = $this->guestModel->getByBooking($id);
        $payment  = $this->paymentModel->getByBooking($id);
        $logs     = $this->logModel->getByBooking($id);
        $services = $this->bookingServiceModel->getByBooking($id);

        // ✅ Lấy HDV đã gán
        $guidesAssigned = $this->bookingModel->getAssignedGuides($id);
        $isAddGuideAllowed = $this->bookingModel->isAddGuideAllowed($id);
        $statuses = ['pending' => 'Chờ xác nhận', 'confirmed' => 'Đã xác nhận', 'completed' => 'Hoàn thành', 'cancelled' => 'Huỷ'];

        // 3️⃣ TÍNH TIỀN
        $totalMoney = $this->bookingModel->calculateTotal($id);

        // 4️⃣ View
        $view = PATH_VIEW . 'booking/detail.php';
        require PATH_VIEW . 'layout/admin/master.php';
    }



    public function createTourGroup()
    {
        $bookingId = $_GET['booking_id'] ?? null;
        if (!$bookingId) die('Thiếu booking');

        $booking = $this->bookingModel->find($bookingId);
        $guides  = $this->tourGuideModel->getActiveGuides();

        $view = PATH_VIEW . 'tour_group/create.php';
        require PATH_VIEW . 'layout/admin/master.php';
    }

    public function storeTourGroup()
    {
        $data = $_POST;

        if (empty($data['guide_id'])) {
            $_SESSION['error'] = 'Vui lòng chọn hướng dẫn viên';
            header('Location: index.php?action=tour-group-create&booking_id=' . $data['booking_id']);
            exit;
        }

        $this->tourGroupModel->create([
            'booking_id'     => $data['booking_id'],
            'tour_id'        => $data['tour_id'],
            'guide_id'       => $data['guide_id'],
            'start_date'     => $data['start_date'],
            'end_date'       => $data['end_date'],
            'total_days'     => $data['total_days'],
            'departure_time' => $data['departure_time'],
            'address'        => $data['address'],
            'number_guests'  => $data['number_guests'],
            'status'         => 'confirmed',
            'note'           => $data['note'] ?? null
        ]);

        $_SESSION['success'] = 'Tạo tour group & gán hướng dẫn viên thành công';
        header('Location: index.php?action=booking-detail&id=' . $data['booking_id']);
        exit;
    }

    public function assignGuide()
    {
        $bookingId = $_GET['booking_id'] ?? null;
        if (!$bookingId) die('Thiếu booking_id');

        $booking = $this->bookingModel->find($bookingId);
        if (!$booking) die('Booking không tồn tại');

        $guides = $this->guideModel->getAllActiveGuides();

        $view = PATH_VIEW . 'booking/assign_guide.php';
        require PATH_VIEW . 'layout/admin/master.php';
    }



    public function assignGuideStore()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Phương thức không hợp lệ');
        }

        $bookingId = $_POST['booking_id'] ?? null;
        $guideId   = $_POST['guide_id'] ?? null;

        if (!$bookingId || !$guideId) {
            die('Thiếu booking hoặc guide');
        }

        // ✅ GÁN HƯỚNG DẪN VIÊN CHO BOOKING
        $this->tourGuideModel->assignGuideToBooking($bookingId, $guideId);

        // ✅ GHI LOG
        $this->logModel->create(
            $bookingId,
            'Gán hướng dẫn viên',
            'Admin gán hướng dẫn viên cho booking',
            $_SESSION['user']['id'] ?? null
        );

        $_SESSION['success'] = 'Gán hướng dẫn viên thành công';

        header('Location: index.php?action=booking-detail&id=' . $bookingId);
        exit;
    }

    // =========================
    // CẬP NHẬT TRẠNG THÁI
    // =========================
    public function updateStatus()
    {
        $id     = $_POST['id'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$id || !$status) {
            die('Thiếu dữ liệu');
        }

        // Update booking
        $this->bookingModel->updateStatus($id, $status);

        // Ghi log
        $this->logModel->create(
            $id,
            'Cập nhật trạng thái',
            "Trạng thái booking chuyển thành: $status",
            $_SESSION['user']['id'] ?? null
        );

        $_SESSION['success'] = 'Cập nhật trạng thái thành công';
        header('Location: index.php?action=booking-detail&id=' . $id);
        exit;
    }

    // =========================
    // FORM TẠO BOOKING
    // =========================
    public function create()
    {
        // Lấy danh sách tour
        $tours = $this->tourModel->getAllTours();
        $guides = $this->guideModel->getAllActiveGuides();

        // ✅ LẤY DỊCH VỤ
        $services = $this->serviceModel->getAll();

        // Trạng thái mặc định cho booking mới
        $statuses = [
            'pending'   => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Huỷ',
            'completed' => 'Hoàn thành'
        ];

        $view = PATH_VIEW . 'booking/create.php';
        require PATH_VIEW . 'layout/admin/master.php';
    }


    // =========================
    // LƯU BOOKING + KHÁCH
    // =========================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die('Phương thức không hợp lệ');
        }

        // =========================
        // 1️⃣ LẤY TOUR
        // =========================
        $tour = $this->tourModel->find($_POST['tour_id'] ?? null);
        if (!$tour) {
            $_SESSION['error'] = 'Tour không tồn tại';
            header('Location: index.php?action=booking-create');
            exit;
        }

        // =========================
        // 2️⃣ LẤY + LỌC KHÁCH
        // =========================
        $guests = $_POST['guests'] ?? [];

        $validGuests = array_filter($guests, function ($g) {
            return !empty(trim($g['name']));
        });

        $guestCount = count($validGuests);

        // =========================
        // 3️⃣ VALIDATE MIN / MAX
        // =========================
        if ($guestCount < $tour['min_people']) {
            $_SESSION['error'] =
                "Tour này yêu cầu tối thiểu {$tour['min_people']} khách (hiện tại: $guestCount)";
            header('Location: index.php?action=booking-create');
            exit;
        }

        if ($guestCount > $tour['max_people']) {
            $_SESSION['error'] =
                "Tour này chỉ cho phép tối đa {$tour['max_people']} khách";
            header('Location: index.php?action=booking-create');
            exit;
        }

        // =========================
        // 4️⃣ TẠO CUSTOMER
        // =========================
        $customerId = $this->customerModel->findOrCreate([
            'name'    => $_POST['customer_name'],
            'phone'   => $_POST['customer_phone'],
            'email'   => $_POST['customer_email'] ?? null,
            'address' => $_POST['customer_address'] ?? null
        ]);

        // =========================
        // 5️⃣ TẠO BOOKING
        // =========================
        $bookingId = $this->bookingModel->create([
            'tour_id'     => $_POST['tour_id'],
            'user_id'     => $_SESSION['user']['id'],
            'customer_id' => $customerId,
            'status'      => $_POST['status'] ?? 'pending',
            'admin_note'  => $_POST['admin_note'] ?? null,
        ]);
        // =========================
        // 🔹 LƯU DỊCH VỤ
        // =========================
        $services = $_POST['services'] ?? [];

        foreach ($services as $s) {
            if (empty($s['id']) || empty($s['qty'])) continue;

            // lấy giá dịch vụ tại thời điểm booking
            $service = $this->serviceModel->find($s['id']);

            $this->bookingServiceModel->create([
                'booking_id' => $bookingId,
                'service_id' => $s['id'],
                'price'      => $service['price'],
                'quantity'   => $s['qty']
            ]);
        }

        // =========================
        // 8️⃣ TÍNH TỔNG TIỀN (SAU KHI CÓ GUEST)
        // =========================
        $totalMoney = $this->bookingModel->calculateTotal($bookingId);

        // fallback an toàn
        $totalMoney = is_array($totalMoney)
            ? $totalMoney
            : [
                'total' => (float)$totalMoney
            ];

        $amount = $totalMoney['total'] ?? 0;

        // =========================
        // 9️⃣ TẠO PAYMENT ĐẶT CỌC
        // =========================
        $this->paymentModel->create([
            'booking_id' => $bookingId,
            'method'     => $_POST['payment_method'] ?? 'cash',
            'amount'     => $_POST['deposit_amount'] ?? 0,
            'status'     => 'unpaid',
            'note'       => 'Đặt cọc khi tạo booking'
        ]);

        // =========================
        // 6️⃣ LƯU KHÁCH
        // =========================
        foreach ($validGuests as $guest) {
            $guest['booking_id'] = $bookingId;
            $this->guestModel->create($guest);
        }

        // =========================
        // 7️⃣ LOG
        // =========================
        $this->logModel->create(
            $bookingId,
            'Tạo booking',
            "Tạo booking mới - Customer ID: $customerId",
            $_SESSION['user']['id'] ?? null
        );



        $_SESSION['success'] = 'Tạo booking thành công';
        header('Location: index.php?action=booking-detail&id=' . $bookingId);
        exit;
    }
    public function confirmPayment()
    {
        $bookingId = $_POST['booking_id'] ?? null;
        if (!$bookingId) die('Thiếu booking ID');

        $this->paymentModel->markPaid(
            $bookingId,
            $_POST['note'] ?? 'Admin xác nhận thanh toán'
        );

        $_SESSION['success'] = 'Đã xác nhận thanh toán';
        header('Location: index.php?action=booking-detail&id=' . $bookingId);
        exit;
    }
}
