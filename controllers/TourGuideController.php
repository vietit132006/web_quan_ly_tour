<?php
require_once PATH_MODEL . 'GuideModel.php';
require_once PATH_MODEL . 'UserModel.php';

class TourGuideController
{
    /* =========================
        DANH SÁCH HDV
    ========================= */
    public function listTourGuide()
    {
        $model = new GuideModel();
        $tourguides = $model->getAll(); // 🔥 ĐÚNG HÀM MODEL

        require PATH_VIEW . 'HDV/tourguides_list.php';
    }

    /* =========================
        FORM THÊM HDV
    ========================= */
    public function addTourGuide()
    {
        $userModel = new UserModel();

        // chỉ lấy user là hướng dẫn viên
        $users = $userModel->getAllUsers();

        require PATH_VIEW . 'HDV/tourguides_add.php';
    }

    /* =========================
        XỬ LÝ THÊM HDV
    ========================= */
    public function storeTourGuide()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: index.php?action=HDV");
            exit;
        }

        // 1. Lấy dữ liệu user từ form
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $fullName = $_POST['full_name'] ?? '';
        $email    = $_POST['email'] ?? '';
        $phone    = $_POST['phone'] ?? '';

        if (!$username || !$password || !$fullName || !$email || !$phone) {
            die('Vui lòng nhập đầy đủ thông tin user (username, password, fullname, email, phone).');
        }

        // 2. Upload avatar nếu có
        $avatarName = null;
        if (!empty($_FILES['avatar']['name']) && $_FILES['avatar']['error'] === 0) {
            $uploadDir = PATH_ROOT . 'public/uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

            $avatarName = time() . '_' . basename($_FILES['avatar']['name']);
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $avatarName);
        }

        // 3. Tạo user mới
        $userModel = new UserModel();
        $userId = $userModel->createUser([
            'username'  => $username,
            'password'  => $password, // hash sẽ thực hiện trong createUser()
            'full_name' => $fullName,
            'email'     => $email,
            'phone'     => $phone,
            'role_id'   => 2, // 2 = HDV
            'avatar'    => $avatarName,
            'status'    => 1
        ]);

        if (!$userId) {
            die('Tạo user thất bại.');
        }

        // 4. Chuẩn bị dữ liệu HDV
        $data = [
            'user_id'          => $userId,
            'date_birth'       => $_POST['date_birth'] ?? null,
            'phone'            => $phone,
            'experience_years' => $_POST['experience_years'] ?? 0,
            'language'         => $_POST['language'] ?? null,
            'classify'         => $_POST['classify'] ?? null,
            'license_number'   => $_POST['license_number'] ?? null,
            'license_expiry'   => $_POST['license_expiry'] ?? null,
            'health'           => $_POST['health'] ?? null,
            'history'          => $_POST['history'] ?? null,
            'evaluate'         => $_POST['evaluate'] ?? null,
            'certificate'      => $_POST['certificate'] ?? null,
            'status'           => $_POST['status'] ?? 1,
            'avata_id'         => $avatarName
        ];

        // 5. Thêm vào bảng tour_guides
        $guideModel = new GuideModel();
        $result = $guideModel->insert($data);

        if ($result) {
            header("Location: index.php?action=HDV");
            exit;
        }

        die('Thêm hướng dẫn viên thất bại.');
    }


    /* =========================
    FORM EDIT HDV
========================= */
    public function editTourGuide($id)
    {
        if (!$id) {
            header("Location: index.php?action=HDV");
            exit;
        }

        $model = new GuideModel();
        $guide = $model->findById($id);

        require PATH_VIEW . 'HDV/tourguides_edit.php';
    }

    /* =========================
    UPDATE HDV
========================= */
    public function updateTourGuide($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !$id) {
            header("Location: index.php?action=HDV");
            exit;
        }

        $data = [
            'phone'            => $_POST['phone'],
            'experience_years' => $_POST['experience_years'],
            'language'         => $_POST['language'],
            'classify'         => $_POST['classify'],
            'evaluate'         => $_POST['evaluate'] ?? null,
            'health'           => $_POST['health'] ?? null,
            'status'           => $_POST['status'] ?? 1
        ];

        $model = new GuideModel();
        $model->update($id, $data);

        header("Location: index.php?action=HDV");
        exit;
    }

    /* =========================
    DELETE HDV
========================= */
    public function deleteTourGuide($id)
    {
        if (!$id) {
            header("Location: index.php?action=HDV");
            exit;
        }

        $model = new GuideModel();
        $model->delete($id);

        header("Location: index.php?action=HDV");
        exit;
    }
}
