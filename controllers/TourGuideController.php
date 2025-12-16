<?php
require_once PATH_MODEL . 'TourGuideModel.php';
require_once PATH_MODEL . 'UserModel.php';

class TourGuideController
{
    /* =========================
        DANH SÁCH HDV
    ========================= */
    public function listTourGuide()
    {
        $model = new TourGuideModel();
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

        // Upload avatar
        $avatarName = null;
        if (!empty($_FILES['avatar']['name'])) {
            $avatarName = time() . '_' . $_FILES['avatar']['name'];

            move_uploaded_file(
                $_FILES['avatar']['tmp_name'],
                PATH_ROOT . 'public/uploads/' . $avatarName
            );
        }

        $data = [
            'user_id'          => $_POST['user_id'],
            'date_birth'       => $_POST['date_birth'] ?? null,
            'phone'            => $_POST['phone'],
            'experience_years' => $_POST['experience_years'],
            'language'         => $_POST['language'],
            'classify'         => $_POST['classify'],
            'license_number'   => $_POST['license_number'] ?? null,
            'license_expiry'   => $_POST['license_expiry'] ?? null,
            'health'           => $_POST['health'] ?? null,
            'history'          => $_POST['history'] ?? null,
            'evaluate'         => $_POST['evaluate'] ?? null,
            'certificate'      => $_POST['certificate'] ?? null,
            'status'           => $_POST['status'] ?? 1,
            'avata_id'         => $avatarName // 🔥 KHỚP MODEL
        ];

        $model = new TourGuideModel();
        $result = $model->createTourGuide($data);

        if ($result) {
            header("Location: index.php?action=HDV");
            exit;
        }

        die('Thêm hướng dẫn viên thất bại');
    }
}
