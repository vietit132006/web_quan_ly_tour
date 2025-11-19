<?php

class UserController
{
    public function listUser()
    {
        $userModle = new UserModel();
        $users = $userModle->getAllUsers();
        $roles = $userModle->getAllRoles();
        include(PATH_VIEW . './roles_users/roles_users.php');
    }
    // Hiển thị form thêm
    public function addUser()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers(); // để load ra danh sách role
        include PATH_VIEW . 'user_add.php';
    }

    // Xử lý thêm vào DB
    public function storeUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'full_name' => $_POST['full_name'],
                'email' => $_POST['email'],
                'phone' => $_POST['phone'],
                'role_id' => $_POST['role_id'],
                'status' => $_POST['status'] ?? 1,
                'avatar' => $_FILES['avatar']['name'] ?? null
            ];

            // Upload avatar nếu có
            if (!empty($_FILES['avatar']['name'])) {
                move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    'uploads/' . $_FILES['avatar']['name']
                );
            }

            $userModel = new UserModel();
            $userModel->createUser($data);

            header("Location: index.php?action=users");
            exit;
        }
    }
   
}
