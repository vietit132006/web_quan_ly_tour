<?php
require_once __DIR__.'/../models/Group.php';

class GroupController {
    private $model;

    public function __construct() {
        $this->model = new Group();
    }

    // Hiển thị danh sách nhóm
    public function index() {
        $groups = $this->model->all();
        require __DIR__.'/../../views/groups.php';
    }

    // Xóa nhóm
    public function delete($id) {
        $this->model->delete($id);
        header('Location: index.php?controller=group');
        exit;
    }

    // Thêm/Sửa nhóm
    public function save() {
        $group = [
            'id' => $_POST['id'] ?? time(),
            'group_name' => $_POST['group_name'],
            'tour_name' => $_POST['tour_name'],
            'start_date' => $_POST['start_date'],
            'end_date' => $_POST['end_date'],
            'number_guests' => $_POST['number_guests'],
            'guide_id' => $_POST['guide_id'] ?? '',
            'services' => $_POST['services'] ?? []
        ];
        $this->model->save($group);
        header('Location: index.php?controller=group');
        exit;
    }
}
