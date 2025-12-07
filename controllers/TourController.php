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
   /// II. nhà cung cấp 





    
    
}
?>