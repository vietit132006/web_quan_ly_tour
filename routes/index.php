
<?php
require_once __DIR__ . '/../models/DB.php';
require_once __DIR__ . '/../models/BaseModel.php';
require_once __DIR__ . '/../controllers/HomeController.php';
require_once __DIR__ . '/../controllers/ManageController.php';
require_once __DIR__ . '/../controllers/GroupController.php';
require_once __DIR__ . '/../controllers/BookIngController.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/SupplierController.php';
require_once __DIR__ . '/../controllers/CalendarController.php';
require_once __DIR__ . '/../models/SupplierModel.php';
require_once __DIR__ . '/../models/GuideModel.php';
require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../controllers/TourController.php';
require_once __DIR__ . '/../models/TourModel.php';
require_once __DIR__ . '/../controllers/TourCategoryController.php';
require_once __DIR__ . '/../models/TourCategoryModel.php';
require_once __DIR__ . '/../models/CalendarModel.php';


$model = new GuideModel();
$action = $_GET['action'] ?? 'home';


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
    'tour_detail'      => (new TourController)->detail($_GET['id'] ?? null),
    'tour-create' => (new TourController)->create(),
    'tour-edit'   => (new TourController)->edit(),



    // Tour Category
    'tour-category'        => (new TourCategoryController)->index(),
    'tour-category-store'  => (new TourCategoryController)->store(),
    'tour-category-delete' => (new TourCategoryController)->delete(),

    // Booking
    // ============ BOOKING ============ //
    'booking'               => (new BookingController)->index(),
    'booking-detail'        => (new BookingController)->detail(),
    'booking-update'        => (new BookingController)->updateStatus(),
    // Booking
    'booking-create' => (new BookingController)->create(),
    'booking-store'  => (new BookingController)->store(),
    // ===== GÁN HƯỚNG DẪN VIÊN =====
    'booking-assign-guide'       => (new BookingController)->assignGuide(),
    'booking-assign-guide-store' => (new BookingController)->assignGuideStore(),

    // Tour Group / Assign Guide
    'tour-group-create' => (new GroupController)->create(),
    'tour-group-store'  => (new GroupController)->store(),




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
    'nhacungcap_store'  => (new SupplierController)->storeSupplier(),  // SỬA LẠI
    'nhacungcap_edit'   => (new SupplierController)->editSupplier(),
    'nhacungcap_update' => (new SupplierController)->updateSupplier(), // SỬA LẠI
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


    //HDV
    'HDV'        => (new TourGuideController)->listTourGuide(),
    'HDV_add'        => (new TourGuideController)->addTourGuide(),
    'HDV_store'        => (new TourGuideController)->storeTourGuide(),


    // ========== CALENDAR – HDV ==========
    'calendar' => (new CalendarController)->index(),
    'calendar-detail' => (new CalendarController)->detail(),
    'calendar-confirm' => (new CalendarController)->confirm(),
    'calendar-reject' => (new CalendarController)->reject(),
    'attendance'        => (new AttendanceController)->index(),
    'attendance-store'  => (new AttendanceController)->store(),
    // ===== ATTENDANCE =====
    'attendance-store'       => (new AttendanceController)->store(),
    'attendance-session'     => (new AttendanceController)->sessionDetail(),


    default => function () {
        http_response_code(404);
        echo "Trang không tồn tại (action chưa được khai báo).";
    }
};
error_log("ACTION: " . $action);
