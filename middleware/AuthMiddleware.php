<?php
class AuthMiddleware {
    public static function checkLogin() {
        
        if (empty($_SESSION['user'])) {
            header("Location: index.php?action=login_form");
            exit;
        }
    }

    // check quyền Admin
    public static function requireAdmin() {
        self::checkLogin();
        if ($_SESSION['user']['role_id'] != 1) {
            die("Bạn không có quyền truy cập trang này!");
        }
    }
}
