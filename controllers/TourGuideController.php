<?php
require_once PATH_MODEL . 'TourGuideModel.php';
require_once PATH_MODEL . 'UserModel.php'; // nếu cần


class TourGuideController
{
    // Danh sách hướng dẫn viên
    public function listTourGuide()
    {
        $model = new TourGuideModel();
        $tourguides = $model->getAllTourGuides();
        include_once __DIR__ . '/../views/HDV/tourguides_list.php';
    }


    // Hiển thị form thêm hướng dẫn viên
    public function addTourGuide()
    {
        $userModel = new UserModel();
        $users = $userModel->getAllUsers(); // Load danh sách user để chọn

        include_once __DIR__ . '/../views/HDV/tourguides_add.php';
    }


    // Lưu hướng dẫn viên vào DB
    public function storeTourGuide()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Upload avatar
            $avatarName = null;
            if (!empty($_FILES['avatar']['name'])) {
                $avatarName = time() . '_' . $_FILES['avatar']['name'];

                move_uploaded_file(
                    $_FILES['avatar']['tmp_name'],
                    __DIR__ . '/../../public/uploads/' . $avatarName
                );
            }

            $data = [
                'user_id'          => $_POST['user_id'],
                'date_birth'       => $_POST['date_birth'],
                'phone'            => $_POST['phone'],
                'experience_years' => $_POST['experience_years'],
                'language'         => $_POST['language'],
                'classify'         => $_POST['classify'],
                'license_number'   => $_POST['license_number'],
                'license_expiry'   => $_POST['license_expiry'],
                'health'           => $_POST['health'] ?? null,
                'history'          => $_POST['history'] ?? null,
                'evaluate'         => $_POST['evaluate'] ?? null,
                'certificate'      => $_POST['certificate'] ?? null,
                'status'           => $_POST['status'] ?? 1,
                'avata_id'         => $avatarName // 🔥 ĐÚNG TÊN
            ];

            $model = new TourGuideModel();
            $result = $model->createTourGuide($data);

            if ($result) {
                header("Location: index.php?action=tourguides_list");
                exit;
            } else {
                die('Insert tour guide thất bại');
            }
        }
    }
}
