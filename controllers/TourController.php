<?php
// controllers/TourController.php

class TourController
{
    // ===============================
    // 1. Danh sách tour (READ ALL)
    // ===============================
    public function list()
    {
        $tourModel = new TourModel();

        // ✅ LẤY TOUR CẦN SỬA
        $editTour = null;
        if (!empty($_GET['id_edit'])) {
            $editTour = $tourModel->getTourById($_GET['id_edit']);
        }

        // ✅ FILTER
        $filters = [
            'keyword'  => $_GET['keyword'] ?? null,
            'category' => $_GET['category'] ?? null,
            'price'    => $_GET['price'] ?? null,
        ];

        $tours = $tourModel->searchTours($filters);

        $view = PATH_VIEW . "Tour/quan-ly-tour.php";
        require_once PATH_VIEW . "layout/master.php";
    }



    // ===============================
    // 2. Hiển thị form thêm tour
    // ===============================
    public function create()
    {
        $view = PATH_VIEW . "Tour/create.php";
        require_once PATH_VIEW . "layout/master.php";
    }

    // ===============================
    // 3. Xử lý thêm tour (CREATE)
    // ===============================
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tourModel = new TourModel();

            $data = [
                'name' => $_POST['name'],
                'base_price' => $_POST['base_price'],
                'duration' => $_POST['duration'],
                'description' => $_POST['description'] ?? null,
                'status' => $_POST['status'],
                'tour_category_id' => $_POST['tour_category_id'],
                'so_nguoi' => $_POST['so_nguoi'],   // ✅ BẮT BUỘC
                'image' => $_POST['image'],
            ];


            $tourModel->addTour($data);

            header("Location: index.php?action=tours");
            exit;
        }
    }

    // ===============================
    // 4. Hiển thị form sửa tour
    // ===============================
    public function edit()
    {
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=tour&action=list");
            exit;
        }

        $tourModel = new TourModel();
        $tour = $tourModel->getTourById($_GET['id']);

        $view = PATH_VIEW . "Tour/edit.php";
        require_once PATH_VIEW . "layout/master.php";
    }

    // ===============================
    // 5. Xử lý cập nhật tour (UPDATE)
    // ===============================
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'name' => $_POST['name'],
                'base_price' => $_POST['base_price'],
                'duration' => $_POST['duration'],
                'description' => $_POST['description'] ?? null,
                'status' => $_POST['status'],
                'tour_category_id' => $_POST['tour_category_id'],
                'so_nguoi' => $_POST['so_nguoi'],
                'image' => $_POST['image'],
            ];

            (new TourModel())->updateTour($id, $data);

            header("Location: index.php?action=tours");
            exit;
        }
    }


    // ===============================
    // 6. Xóa tour (DELETE)
    // ===============================
    public function delete()
    {
        if (isset($_GET['id'])) {
            $tourModel = new TourModel();
            $tourModel->deleteTour($_GET['id']);
        }

        header("Location: index.php?action=tours");
        exit;
    }
}
