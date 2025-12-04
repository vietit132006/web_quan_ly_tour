<?php
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';
require_once __DIR__ . '/../models/GuideModel.php';

$model = new GuideModel();
$action = $_GET['action'] ?? '/';

switch ($action) {
    case '/':
    case 'home':
        (new HomeController)->index();
        break;

    case 'manage':
        (new ManageController)->index();
        break;

    case 'manage-create':
        (new ManageController)->create();
        break;

    case 'manage-store':
        (new ManageController)->store();
        break;

    case 'manage-edit':
        $id = $_GET['id'] ?? null;
        (new ManageController)->edit($id);
        break;

    case 'manage-update':
        $id = $_GET['id'] ?? null;
        (new ManageController)->update($id);
        break;
    case 'manage-delete':
        $id = $_GET['id'] ?? null;
        (new ManageController)->delete($id);
        break;

    case 'group_index':
        (new GroupController)->index();
        break;

    case 'group_detail':
        $id = $_GET['id'] ?? null;
        (new GroupController)->detail($id);
        break;

    // case 'group_addService':
    //     $data = json_decode(file_get_contents("php://input"), true);
    //     $group_id = $_GET['id'] ?? null;
    //     echo json_encode([
    //         'id' => (new GroupController)->save(
    //             $group_id,
    //             $data['service_id'],
    //             $data['quantity'],
    //             $data['date_use']
    //         )
    //     ]);
    //     break;

    default:
        echo "❌ Action not found!";
}
