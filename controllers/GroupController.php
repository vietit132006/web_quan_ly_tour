<?php
class GroupController {
    public function index() {
        echo "Danh sách Group";
    }

    public function detail($id) {
        echo "Chi tiết Group ID: $id";
    }

    public function create($data) {
        // Giả lập tạo group và trả về ID
        return rand(100, 999);
    }

    public function addService($group_id, $service_id, $quantity, $date_use) {
        // Giả lập add service
        return rand(1000, 9999);
    }
}
