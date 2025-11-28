<?php

class ManageController extends DB
{
    private $groupModel;

    public function __construct()
    {
        parent::__construct();
        $this->groupModel = new GroupModel();
    }
    public function index()
    {
        $tour_group = $this->groupModel->all();

        require_once PATH_VIEW . "manage.php";
    }

    public function create()
    {
        require_once PATH_VIEW . "manage-create.php";
    }

    public function store()
    {
        $data = [
    'id' => $_POST['id'],
    'tour_name' => $_POST['tour_name'],
    'start_date' => $_POST['start_date'],
    'end_date' => $_POST['end_date'],
    'total_days' => $_POST['total_days'],
    'departure_time' => $_POST['departure_time'],
    'number_guests' => $_POST['number_guests'],
    'guide_name' => $_POST['guide_name'],
    'service_list' => $_POST['service_list']
];


        $this->groupModel->insert($data);

        header("Location: " . BASE_URL . "?action=manage");
        exit;
    }
}
