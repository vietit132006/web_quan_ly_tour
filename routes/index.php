<?php
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';

// Lấy action từ URL, ví dụ ?action=manage hoặc ?action=index
$action = $_GET['action'] ?? '/';
if ($_GET['action'] == 'save_group') {
    $controller->saveGroup();
    exit;
}

// Front controller kiểu đơn giản, gọi trực tiếp method không thêm "Action"
switch ($action) {
    case '/':
        (new HomeController)->index();
        break;
    case 'home':
        (new HomeController)->index();
        break;
    case 'manage':
        (new ManageController)->index();
        break;
    case 'group_index':
        $controller = new GroupController();
        $controller->index();
        break;
    case 'group_detail':
        $controller = new GroupController();
        $id = $_GET['id'] ?? null;
        if ($id) $controller->detail($id);
        break;
    case 'group_create':
        $controller = new GroupController();
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $controller->create($data);
        echo json_encode(['id' => $id]);
        break;
    case 'group_addService':
        $controller = new GroupController();
        $data = json_decode(file_get_contents("php://input"), true);
        $group_id = $_GET['id'] ?? null;
        $result = $controller->addService($group_id, $data['service_id'], $data['quantity'], $data['date_use']);
        echo json_encode(['id' => $result]);
        break;
    default:
        echo "Action not found!";
}

require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';

// Lấy action từ URL, ví dụ ?action=manage hoặc ?action=index
$action = $_GET['action'] ?? '/';
if ($_GET['action'] == 'save_group') {
    $controller->saveGroup();
    exit;
}

// Front controller kiểu đơn giản, gọi trực tiếp method không thêm "Action"
switch ($action) {
    case '/':
        (new HomeController)->index();
        break;
    case 'home':
        (new HomeController)->index();
        break;
    case 'manage':
        (new ManageController)->index();
        break;
    case 'group_index':
        $controller = new GroupController();
        $controller->index();
        break;
    case 'group_detail':
        $controller = new GroupController();
        $id = $_GET['id'] ?? null;
        if ($id) $controller->detail($id);
        break;
    case 'group_create':
        $controller = new GroupController();
        $data = json_decode(file_get_contents("php://input"), true);
        $id = $controller->create($data);
        echo json_encode(['id' => $id]);
        break;
    case 'group_addService':
        $controller = new GroupController();
        $data = json_decode(file_get_contents("php://input"), true);
        $group_id = $_GET['id'] ?? null;
        $result = $controller->addService($group_id, $data['service_id'], $data['quantity'], $data['date_use']);
        echo json_encode(['id' => $result]);
        break;
    default:
        echo "Action not found!";
}

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
};

