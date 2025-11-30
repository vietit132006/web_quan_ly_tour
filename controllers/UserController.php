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
        $roles = $userModel->getAllRoles();
        include PATH_VIEW . './roles_users/user_add.php';
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

            if (!empty($_FILES['avatar']['name'])) {

                $fileName = time() . '-' . $_FILES['avatar']['name'];
                $filePath = 'users/' . $fileName;

                move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    PATH_ASSETS_UPLOADS . $filePath
                );

                $data['avatar'] = $filePath;
            }


            $userModel = new UserModel();
            $userModel->createUser($data);

            header("Location: index.php?action=users");
            exit;
        }
    }
    // Hiển thị form sửa
    public function editUser()
    {
        if (!isset($_GET['id'])) {
            die("Thiếu ID để sửa");
        }

        $id = $_GET['id'];
        $userModel = new UserModel();

        $user = $userModel->getUserById($id);
        $roles = $userModel->getAllRoles();

        include PATH_VIEW . "roles_users/user_edit.php";
    }

    // Xử lý cập nhật
    public function updateUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $id = $_POST['id'];

            $data = [
                'username'  => $_POST['username'],
                'full_name' => $_POST['full_name'],
                'email'     => $_POST['email'],
                'phone'     => $_POST['phone'],
                'role_id'   => $_POST['role_id'],
                'status'    => $_POST['status'] ?? 1,
            ];

            // Xử lý avatar mới
            if (!empty($_FILES['avatar']['name'])) {

                $fileName = time() . '-' . $_FILES['avatar']['name'];
                $filePath = 'users/' . $fileName;

                move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    PATH_ASSETS_UPLOADS . $filePath
                );

                $data['avatar'] = $filePath;
            }

            $userModel = new UserModel();
            $userModel->updateUser($id, $data);

            header("Location: index.php?action=users");
            exit;
        }
    }
    public function deleteUser()
    {
        $id = $_GET['id'] ?? 0;

        if (!$id) {
            echo "Không tìm thấy ID để xóa!";
            return;
        }

        require_once "./models/UserModel.php";
        $userModel = new UserModel();

        if ($userModel->deleteUser($id)) {
            header("Location: index.php?action=users-roles&msg=deleted");
            exit;
        } else {
            echo "Xóa thất bại!";
        }
    }
}
