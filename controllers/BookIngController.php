<?php
require_once PATH_ROOT . 'models/BookingModel.php';
require_once PATH_ROOT . 'models/GuestModel.php';
require_once PATH_ROOT . 'models/TourLogModel.php';
require_once PATH_ROOT . 'models/TourModel.php';
require_once PATH_ROOT . 'models/BookingServiceModel.php';
require_once PATH_ROOT . 'models/CustomerModel.php';


class BookingController
{
    protected $bookingModel;
    protected $guestModel;
    protected $logModel;
    protected $tourModel;
    protected $bookingServiceModel;
    protected $customerModel;


    public function __construct()
    {
        $this->bookingModel = new BookingModel();
        $this->customerModel = new CustomerModel();
        $this->guestModel   = new GuestModel();
        $this->logModel     = new TourLogModel();
        $this->tourModel    = new TourModel();
        $this->bookingServiceModel = new BookingServiceModel();
    }

    // =========================
    // DANH SÁCH BOOKING
    // =========================
    public function index()
    {
        $status = $_GET['status'] ?? null;
        $bookings = $this->bookingModel->getAll($status);

        $view = PATH_VIEW . 'booking/index.php';
        require PATH_VIEW . 'layout/master.php';
    }
    // =========================
    // CHI TIẾT BOOKING
    // =========================
    public function detail()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            die('Thiếu ID booking');
        }

        // 1️⃣ LẤY BOOKING
        $booking = $this->bookingModel->find($id);
        if (!$booking) {
            die('Booking không tồn tại');
        }

        // 2️⃣ LẤY DANH SÁCH KHÁCH
        // 2️⃣ LẤY DANH SÁCH KHÁCH (LUÔN LÀ MẢNG)
        $customers = $this->guestModel->getByBooking($id) ?? [];

        $guests = $this->guestModel->getByBooking($id) ?? [];



        // 3️⃣ NHẬT KÝ
        $logs = $this->logModel->getByBooking($id);

        // 4️⃣ DỊCH VỤ
        $services = $this->bookingServiceModel->getByBooking($id);

        // 5️⃣ 💰 TÍNH TIỀN
        $totalMoney = $this->bookingModel->calculateTotal($id);

        $serviceTotal = 0;
        foreach ($services as $s) {
            $serviceTotal += $s['price'];
        }

        $totalMoney['service_price'] = $serviceTotal;
        $totalMoney['total'] += $serviceTotal;

        // 6️⃣ VIEW
        $view = PATH_VIEW . 'booking/detail.php';
        require PATH_VIEW . 'layout/master.php';
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

        // Trạng thái mặc định cho booking mới
        $statuses = [
            'pending'   => 'Chờ xác nhận',
            'confirmed' => 'Đã xác nhận',
            'cancelled' => 'Huỷ',
            'completed' => 'Hoàn thành'
        ];

        // Load view
        $view = PATH_VIEW . 'booking/create.php';
        require PATH_VIEW . 'layout/master.php';
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

    public function save_guest()
    {
        // Lấy dữ liệu từ form
        $booking_id = $_POST['booking_id'] ?? null;
        $name = $_POST['name'] ?? null;
        $phone = $_POST['phone'] ?? null;
        $email = $_POST['email'] ?? null;
        $age = $_POST['age'] ?? null;
        $date_birth = $_POST['date_birth'] ?? null;
        $sex = $_POST['sex'] ?? null;
        $address = $_POST['address'] ?? null;
        $identification = $_POST['identification'] ?? null;
        $request = $_POST['request'] ?? null;

        if (!$booking_id || !$name) {
            // Thiếu thông tin quan trọng
            $_SESSION['error'] = "Tên khách và booking ID là bắt buộc!";
            header("Location: /booking/view/$booking_id");
            exit;
        }

        // Gọi model để lưu
        $this->guestModel->addGuest([
            'booking_id' => $booking_id,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'age' => $age,
            'date_birth' => $date_birth,
            'sex' => $sex,
            'address' => $address,
            'identification' => $identification,
            'request' => $request
        ]);


        $_SESSION['success'] = "Thêm khách thành công!";
        header('Location: index.php?action=booking-detail&id=' . $booking_id);
        exit;
    }
}
