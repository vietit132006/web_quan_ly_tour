
<?php
require_once __DIR__ . '/../models/DB.php';
require_once __DIR__ . '/../models/BaseModel.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';
require_once __DIR__ . '/../controllers/BookIngController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/SupplierController.php';
require_once __DIR__ . '/../models/SupplierModel.php';
require_once __DIR__ . '/../models/GuideModel.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../controllers/TourController.php';
require_once __DIR__ . '/../models/TourModel.php';


$model = new GuideModel();
$action = $_GET['action'] ?? '/';


// Các action KHÔNG cần đăng nhập
$public_actions = ['login', 'login_form'];

if (!in_array($action, $public_actions)) {
    AuthMiddleware::checkLogin();
}


match ($action) {


    // ============ AUTH ============ //
    'login_form'        => (new AuthController)->loginForm(),
    'login'             => (new AuthController)->login(),
    'logout'            => (new AuthController)->logout(),

    //home
    '/'                 => (new HomeController)->index(),
    'home'              => (new HomeController)->index(),

    // Tour
    'tours'            => (new TourController)->list(),
    'tour-store'       => (new TourController)->store(),
    'tour-update'      => (new TourController)->update($_GET['id'] ?? null),
    'tour-delete'      => (new TourController)->delete($_GET['id'] ?? null),



    // Booking
    // ============ BOOKING ============ //
    'booking'               => (new BookingController)->index(),
    'booking-detail'        => (new BookingController)->detail(),
    'booking-update'        => (new BookingController)->updateStatus(),



    // Users
    // 'users'             => (new UserController)->listUser(),
    // 'users-roles'       => (new UserController)->listUser(),
    'roles_users'       => (new UserController)->listUser(),
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
    'update' => (new SupplierController)->updateSupplier(),
    'nhacungcap_delete' => (new SupplierController)->deleteSupplier(),

    // Manage
    'manage'            => (new ManageController)->index(),
    'manage-store'      => (new ManageController)->store(),
    'manage-update'     => (new ManageController)->update($_GET['id'] ?? null),
    'manage-delete'     => (new ManageController)->delete($_GET['id'] ?? null),

    // Group
    'group_index'       => (new GroupController)->index(),
    'group_detail'      => (new GroupController)->detail($_GET['id'] ?? null),
    // 'group_addService'  => (new GroupController)->save(
    //     $_GET['id'] ?? null,
    //     json_decode(file_get_contents("php://input"), true)['service_id'],
    //     json_decode(file_get_contents("php://input"), true)['quantity'],
    //     json_decode(file_get_contents("php://input"), true)['date_use']
    // ),


    default => function () {
        http_response_code(404);
        echo "Trang không tồn tại (action chưa được khai báo).";
    }
};
error_log("ACTION: " . $action);
