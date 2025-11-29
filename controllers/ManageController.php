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
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'number_guests' => $_POST['number_guests'],
        'departure_time' => $_POST['departure_time'],
        'status' => 1,
        'services' => $_POST['services'] ?? []     // danh sách service_id[]
    ];

    $this->groupModel->insert($data);

    header("Location: " . BASE_URL . "?action=manage");
    exit;
}

}
