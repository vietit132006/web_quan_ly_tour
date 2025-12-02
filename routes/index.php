<?php
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';
require_once __DIR__ . '/../controllers/BookingController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/SupplierController.php';
require_once __DIR__ . '/../models/GuideModel.php';

$model = new GuideModel();
$action = $_GET['action'] ?? '/';

match ($action) {
    '/'                 => (new HomeController)->index(),
    'home'              => (new HomeController)->index(),

    // Booking
    'booking'           => (new BookingController)->index(),

    // Users
    'users'             => (new UserController)->listUser(),
    'users-roles'       => (new UserController)->listUser(),
    'users_add'         => (new UserController)->addUser(),
    'users_store'       => (new UserController)->storeUser(),
    'users_edit'        => (new UserController)->editUser(),
    'users_update'      => (new UserController)->updateUser(),
    'users_delete'      => (new UserController)->deleteUser(),

    // Nhà cung cấp
    'nhacungcap'        => (new SupplierController)->listSuppliers(),
    'nhacungcap_add'    => (new SupplierController)->addSupplier(),
    'supplier_store'    => (new SupplierController)->storeSupplier(),
    'nhacungcap_edit'   => (new SupplierController)->editSupplier(),
    'nhacungcap_update' => (new SupplierController)->updateSupplier(),
    'nhacungcap_delete' => (new SupplierController)->deleteSupplier(),

    // Manage
    'manage'            => (new ManageController)->index(),
    'manage-create'     => (new ManageController)->create(),
    'manage-store'      => (new ManageController)->store(),

    // Group
    'group_index'       => (new GroupController)->index(),
    'group_detail'      => (new GroupController)->detail($_GET['id'] ?? null),
    'group_addService'  => (new GroupController)->save(
        $_GET['id'] ?? null,
        json_decode(file_get_contents("php://input"), true)['service_id'],
        json_decode(file_get_contents("php://input"), true)['quantity'],
        json_decode(file_get_contents("php://input"), true)['date_use']
    ),

    default => function () {
        http_response_code(404);
        echo "Trang không tồn tại (action chưa được khai báo).";
    }
};
