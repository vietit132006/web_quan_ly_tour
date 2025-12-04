<?php
require_once __DIR__.'/../models/Group.php';

class GroupController {
    private $model;

    public function __construct() {
        $this->model = new GroupModel();
    }
    public function detail($id)
    {
        echo "Chi tiết tour có ID: $id";
    }
    // Hiển thị danh sách nhóm
    public function index() {
        $groups = $this->model->all();
        require __DIR__.'/../../views/groups.php';
    }
}
