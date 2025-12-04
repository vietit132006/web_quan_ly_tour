<?php
class AuthController {

    public function loginForm() {
        require PATH_VIEW . "auth/login.php";
    }

    public function login() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    $userModel = new UserModel();
    $user = $userModel->getUserByUsername($username);

    if (!$user) {
        $_SESSION['error'] = "Username không tồn tại!";
        header("Location: index.php?action=login_form");
        exit;
    }

    // Kiểm tra password
    $valid = false;

    if (password_verify($password, $user['password_hash'])) {
        $valid = true;
    } elseif ($password === $user['password_hash']) { 
        // backup cho pass thường
        $valid = true;
    }

    if (!$valid) {
        $_SESSION['error'] = "Sai mật khẩu!";
        header("Location: index.php?action=login_form");
        exit;
    }

    // Lưu session
    $_SESSION['user'] = [
        'id'       => $user['id'],
        'username' => $user['username'],
        'full_name'=> $user['full_name'],
        'role_id'  => $user['role_id'],
        'role_name'=> $user['role_name'],
    ];

    // ✔ Cập nhật last_login bằng model (đúng chuẩn MVC)
    $userModel->updateLastLogin($user['id']);

    header("Location: index.php?action=home");
    exit;
}


    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?action=login_form");
        exit;
    }
}
