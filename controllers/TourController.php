<?php
require_once __DIR__ . '/../models/BaseModel.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../models/TourCategoryModel.php';

class TourController
{
    private $tourModel;

    public function __construct()
    {
        $this->tourModel = new TourModel();
    }

    // ===============================
    // 1. Danh sách tour
    // ===============================
    public function list()
    {
        // Filter
        $filters = [
            'keyword'  => $_GET['keyword'] ?? null,
            'category' => $_GET['category'] ?? null,
            'price'    => $_GET['price'] ?? null,
        ];

        $tours = $this->tourModel->searchTours($filters);

        // Danh mục
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();

        $view = PATH_VIEW . "Tour/quan-ly-tour.php";
        require PATH_VIEW . "layout/admin/master.php";
    }


    // ===============================
    // 2. Form thêm tour
    // ===============================
    public function create()
    {
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();

        $isEdit = false;
        $editTour = null;
        $itineraries = [];
        $images = [];

        $view = PATH_VIEW . "Tour/tour-form.php";
        require PATH_VIEW . "layout/admin/master.php";
    }


    // ===============================
    // 3. Lưu dữ liệu thêm tour
    // ===============================
    public function store()
    {
        $imageName = null;

        // Upload ảnh chính
        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = PATH_ASSETS_UPLOADS;

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = "tour_" . time() . "_" . rand(1000, 9999) . "." . $ext;

            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }

        // Xử lý giá khuyến mãi
        $promo = null;
        if (isset($_POST['promo_price']) && $_POST['promo_price'] !== '') {
            $promoVal = floatval($_POST['promo_price']);
            $base = floatval($_POST['base_price']);

            if ($promoVal > 0 && $promoVal <= $base) {
                $promo = $promoVal;
            }
        }

        // LƯU TOUR
        $this->tourModel->addTour([
            'name' => $_POST['name'],
            'base_price' => $_POST['base_price'],
            'promo_price' => $promo,
            'duration' => $_POST['duration'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
            'tour_category_id' => $_POST['tour_category_id'],
            'so_nguoi' => $_POST['so_nguoi'],
            'image' => $imageName,
            'diem_di' => $_POST['diem_di'],
            'diem_den' => $_POST['diem_den'],
            'phuong_tien' => $_POST['phuong_tien'],
        ]);

        $tourId = $this->tourModel->lastInsertId();

        // Upload nhiều ảnh
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = PATH_ASSETS_UPLOADS;

            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            foreach ($_FILES['images']['name'] as $idx => $origName) {
                $tmpName = $_FILES['images']['tmp_name'][$idx];
                $error = $_FILES['images']['error'][$idx];

                if ($tmpName && $error === UPLOAD_ERR_OK) {
                    $ext = pathinfo($origName, PATHINFO_EXTENSION);
                    $newName = "tourimg_" . time() . "_" . rand(1000, 9999) . "." . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $newName);

                    $this->tourModel->addImage($tourId, $newName);
                }
            }
        }

        // Thêm lịch trình
        $days = $_POST['days'] ?? [];
        $titles = $_POST['titles'] ?? [];
        $contents = $_POST['contents'] ?? [];

        for ($i = 0; $i < count($days); $i++) {
            $this->tourModel->addItinerary($tourId, $days[$i], $titles[$i], $contents[$i]);
        }

        header("Location: index.php?action=tours");
        exit;
    }

    // ===============================
    // 4. Form sửa tour
    // ===============================
    public function edit()
    {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=tours");
            exit;
        }

        $editTour = $this->tourModel->getTourById($id);
        if (!$editTour) {
            header("Location: index.php?action=tours");
            exit;
        }

        $itineraries = $this->tourModel->getItineraries($id);
        $images = $this->tourModel->getImagesWithId($id);

        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();

        $isEdit = true;

        $view = PATH_VIEW . "Tour/tour-form.php";
        require PATH_VIEW . "layout/admin/master.php";
    }


    // ===============================
    // 5. Lưu cập nhật tour
    // ===============================
    public function update()
    {
        $id = $_POST['id'];
        $old = $this->tourModel->getTourById($id);
        $imageName = $old['image'];

        // Upload ảnh chính nếu có
        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = PATH_ASSETS_UPLOADS;

            $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $imageName = "tour_" . time() . "_" . rand(1000, 9999) . "." . $ext;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $imageName);
        }

        // Upload nhiều ảnh phụ
        if (!empty($_FILES['images']['name'][0])) {
            $uploadDir = PATH_ASSETS_UPLOADS;
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            foreach ($_FILES['images']['name'] as $idx => $origName) {
                $tmpName = $_FILES['images']['tmp_name'][$idx];
                $error = $_FILES['images']['error'][$idx];

                if ($tmpName && $error === UPLOAD_ERR_OK) {
                    $ext = pathinfo($origName, PATHINFO_EXTENSION);
                    $newName = "tourimg_" . time() . "_" . rand(1000, 9999) . "." . $ext;
                    move_uploaded_file($tmpName, $uploadDir . $newName);

                    $this->tourModel->addImage($id, $newName);
                }
            }
        }

        // Giá KM
        $promo = null;
        if ($_POST['promo_price'] !== '') {
            $promoVal = floatval($_POST['promo_price']);
            $base = floatval($_POST['base_price']);
            if ($promoVal > 0 && $promoVal <= $base) {
                $promo = $promoVal;
            }
        }

        // Update tour
        $this->tourModel->updateTour($id, [
            'name' => $_POST['name'],
            'base_price' => $_POST['base_price'],
            'promo_price' => $promo,
            'duration' => $_POST['duration'],
            'description' => $_POST['description'],
            'status' => $_POST['status'],
            'tour_category_id' => $_POST['tour_category_id'],
            'so_nguoi' => $_POST['so_nguoi'],
            'image' => $imageName,
            'diem_di' => $_POST['diem_di'],
            'diem_den' => $_POST['diem_den'],
            'phuong_tien' => $_POST['phuong_tien']
        ]);

        // Lịch trình
        $this->tourModel->deleteItineraries($id);

        $days = $_POST['days'] ?? [];
        $titles = $_POST['titles'] ?? [];
        $contents = $_POST['contents'] ?? [];

        for ($i = 0; $i < count($days); $i++) {
            $this->tourModel->addItinerary($id, $days[$i], $titles[$i], $contents[$i]);
        }

        header("Location: index.php?action=tours");
        exit;
    }

    // ===============================
    // 6. Xóa tour
    // ===============================
    public function delete($id)
    {
        $tourModel = new TourModel();

        // ❌ nếu tour đã có booking
        if ($tourModel->hasBooking($id)) {
            $_SESSION['error'] = 'Tour đã có người đặt, không thể xoá!';
            header('Location: index.php?action=tours');
            exit;
        }

        // ✅ nếu chưa có booking thì xoá
        $tourModel->deleteTour($id);
        $_SESSION['success'] = 'Xoá tour thành công!';
        header('Location: index.php?action=tours');
        exit;
    }


    // ===============================
    // 7. Chi tiết tour
    // ===============================
    public function detail($id)
    {
        if (!$id) {
            echo "Thiếu ID tour!";
            return;
        }

        $tour = $this->tourModel->getTourById($id);

        if (!$tour) {
            echo "Tour không tồn tại!";
            return;
        }

        $itineraries = $this->tourModel->getItineraries($id);
        $images = $this->tourModel->getImages($id);

        require_once __DIR__ . '/../views/Tour/tour_detail.php';
    }
}
