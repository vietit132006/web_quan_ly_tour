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
        $editTour = null;
        $itineraries = [];

        if (!empty($_GET['id_edit'])) {
            $tourId = $_GET['id_edit'];
            $editTour = $this->tourModel->getTourById($tourId);
            $itineraries = $this->tourModel->getItineraries($tourId);
        }

        // Filter 
        $filters = [
            'keyword'  => $_GET['keyword'] ?? null,
            'category' => $_GET['category'] ?? null,
            'price'    => $_GET['price'] ?? null,
        ];

        $tours = $this->tourModel->searchTours($filters);

        // LẤY DANH MỤC TOUR (✔ dùng cùng 1 biến tourCategories)
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();

        $view = PATH_VIEW . "Tour/quan-ly-tour.php";
        require_once PATH_VIEW . "layout/master.php";
    }

    // ===============================
    // 2. Form thêm tour
    // ===============================
    public function create()
    {
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();   // Lấy toàn bộ danh mục tour

        include PATH_VIEW . 'tours/add.php';
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
        $id = $_GET['id'];

        $editTour = $this->tourModel->getTourById($id);
        $itineraries = $this->tourModel->getItineraries($id);
        $images = $this->tourModel->getImagesWithId($id);

        // Danh mục
        $categoryModel = new TourCategoryModel();
        $tourCategories = $categoryModel->getAll();

        $isEdit = true;
        $formAction = "index.php?action=updateTour";

        require PATH_VIEW . 'Tour/form.php';
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
    public function delete()
    {
        $id = $_GET['id'];

        $this->tourModel->deleteItineraries($id);
        $this->tourModel->deleteTour($id);

        header("Location: index.php?action=tours");
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
