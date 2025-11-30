<?php
// Tên tập tin: controllers/TourController.php

class TourController {
    
    // Phương thức hiển thị danh sách Tour (READ)
    public function list() {
        // Tạo TourModel
        $tourModel = new TourModel();
        
        // Lấy dữ liệu tour
        $tours = $tourModel->getAllTours();
        
        // Nhúng View danh sách tour
        // Điều chỉnh đường dẫn View cho phù hợp với cấu trúc của bạn
        include(PATH_VIEW . 'home.php'); 
    }

    // // Phương thức thêm Tour mới (CREATE)
    // public function add() {
    //     // Lấy dữ liệu từ form khi người dùng bấm submit
    //     if (isset($_POST['submit'])) {
            
    //         // 1. Lấy dữ liệu từ POST, sử dụng tên cột trong CSDL
    //         $name               = $_POST['name'] ?? '';
    //         $base_price         = $_POST['base_price'] ?? 0; // decimal(15,2)
    //         $duration           = $_POST['duration'] ?? 0;   // int
    //         $description        = $_POST['description'] ?? '';
    //         $status             = $_POST['status'] ?? 1;      // tinyint(1)
    //         $tour_category_id   = $_POST['tour_category_id'] ?? ''; // int
            
    //         // **LƯU Ý QUAN TRỌNG:** Bảng 'tours' không có cột 'image' như trong code cũ. 
    //         // Nếu bạn muốn thêm cột ảnh, bạn phải thêm nó vào CSDL trước.
    //         // Nếu bạn cần upload ảnh cho Tour, hãy thêm logic upload vào đây.
            
    //         // 2. Chuẩn bị dữ liệu để lưu vào CSDL
    //         $data = [
    //             'name'               => $name,
    //             'base_price'         => $base_price,
    //             'duration'           => $duration,
    //             'description'        => $description,
    //             'status'             => $status,
    //             'tour_category_id'   => $tour_category_id,
    //         ];
            
    //         // 3. Gọi Model để thêm Tour
    //         $tourModel = new TourModel();
    //         $tourModel->addTour($data); // Đảm bảo TourModel có hàm addTour
            
    //         // 4. Chuyển hướng về trang danh sách tour
    //         header('Location: ' . BASE_URL . 'index.php?role=admin&action=tour-list');
    //     }
        
    //     // Nhúng View form thêm tour
    //     include(PATH_VIEW . 'admin/tours/add.php');
    // }

    // // Phương thức sửa Tour (UPDATE)
    // public function edit() {
    //     $id = $_GET['id'] ?? 0; // Lấy ID tour cần sửa
    //     $tourModel = new TourModel();
        
    //     // Lấy thông tin tour hiện tại để hiển thị lên form
    //     $tourCurrent = $tourModel->getTourById($id); 
        
    //     if (isset($_POST['submit'])) {
            
    //         // 1. Lấy dữ liệu mới từ form
    //         $name               = $_POST['name'] ?? '';
    //         $base_price         = $_POST['base_price'] ?? 0;
    //         $duration           = $_POST['duration'] ?? 0;
    //         $description        = $_POST['description'] ?? '';
    //         $status             = $_POST['status'] ?? 1;
    //         $tour_category_id   = $_POST['tour_category_id'] ?? '';
            
    //         // **LƯU Ý:** Nếu có upload ảnh, logic sẽ phức tạp hơn (xem chú thích)
    //         /*
    //         $file = $_FILES['image'] ?? null;
    //         $image = $tourCurrent['image']; // Giữ ảnh cũ
    //         if($file['name'] != ''){
    //             // Xử lý upload và gán $image mới
    //             $folder = 'tours';
    //             $image = upload_file($folder, $file);
    //         }
    //         */

    //         // 2. Chuẩn bị dữ liệu để cập nhật
    //         $data = [
    //             'name'               => $name,
    //             'base_price'         => $base_price,
    //             'duration'           => $duration,
    //             'description'        => $description,
    //             'status'             => $status,
    //             'tour_category_id'   => $tour_category_id,
    //             // Thêm 'image' nếu bạn có cột này: 'image' => $image,
    //         ];
            
    //         // 3. Gọi Model để cập nhật Tour
    //         $tourModel->updateTour($id, $data); // Đảm bảo TourModel có hàm updateTour
            
    //         // 4. Chuyển hướng về trang danh sách tour
    //         header('Location: ' . BASE_URL . 'index.php?role=admin&action=tour-list');
    //     }
        
    //     // Nhúng View form sửa tour, truyền dữ liệu $tourCurrent vào View
    //     include(PATH_VIEW . 'admin/tours/edit.php');
    // }

    // // Phương thức xóa Tour (DELETE)
    // public function delete() {
    //     $id = $_GET['id'] ?? 0; // Lấy ID tour cần xóa
        
    //     $tourModel = new TourModel();
    //     $tourModel->deleteTour($id); // Đảm bảo TourModel có hàm deleteTour
        
    //     // Chuyển hướng về trang danh sách tour
    //     header('Location: ' . BASE_URL . 'index.php?role=admin&action=tour-list');
    // }
}
?>