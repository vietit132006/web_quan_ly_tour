<?php

class SupplierController
{
    // ======================
    // 1. Danh sách
    // ======================
    public function listSuppliers()
    {
        $model = new SupplierModel();
        $suppliers = $model->getAllSuppliers();
        // Truyền biến view cho master
        // đường dẫn đúng
        $view = PATH_VIEW . "Nhacungcap/nhacungcap.php";

        // load layout
        include PATH_LAYOUT . "admin/master.php";
    }

    // ======================
    // 2. Hiển thị form thêm
    // ======================
    public function addSupplier()
    {
        // đường dẫn đúng
        $view = PATH_VIEW . "Nhacungcap/add.php";

        // load layout
        include PATH_LAYOUT . "admin/master.php";
    }

    // ======================
    // 3. Xử lý thêm
    // ======================
    public function storeSupplier()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $data = [
                'name'            => $_POST['name'],
                'type'            => $_POST['type'],
                'contact_person'  => $_POST['contact_person'],
                'phone'           => $_POST['phone'],
                'email'           => $_POST['email'],
                'address'         => $_POST['address'],
                'contract_number' => $_POST['contract_number'],
                'contract_start'  => $_POST['contract_start'],
                'contract_end'    => $_POST['contract_end'],
                'rating'          => $_POST['rating'],
                'note'            => $_POST['note']
            ];

            $model = new SupplierModel();
            $model->insert($data);

            header("Location: index.php?action=nhacungcap");
            exit;
        }
    }

    // ======================
    // 4. Hiển thị form sửa
    // ======================
    public function editSupplier()
    {
        if (!isset($_GET['id'])) {
            die("Thiếu ID để sửa");
        }

        $id = $_GET['id'];

        $model = new SupplierModel();
        $supplier = $model->findById($id);



        // đường dẫn đúng
        $view = PATH_VIEW . "Nhacungcap/edit.php";

        // load layout
        include PATH_LAYOUT . "admin/master.php";
    }

    // ======================
    // 5. Xử lý cập nhật
    // ======================
    public function updateSupplier()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = $_POST["id"];

            $data = [
                'name'            => $_POST['name'],
                'type'            => $_POST['type'],
                'contact_person'  => $_POST['contact_person'],
                'phone'           => $_POST['phone'],
                'email'           => $_POST['email'],
                'address'         => $_POST['address'],
                'contract_number' => $_POST['contract_number'],
                'contract_start'  => $_POST['contract_start'],
                'contract_end'    => $_POST['contract_end'],
                'rating'          => $_POST['rating'],
                'note'            => $_POST['note']
            ];

            $model = new SupplierModel();
            $model->updateSupplier($id, $data);

            header("Location: index.php?action=nhacungcap");
            exit;
        }
    }

    // ======================
    // 6. Xóa
    // ======================
    public function deleteSupplier()
    {
        $id = $_GET["id"] ?? 0;

        if (!$id) {
            echo "Không tìm thấy ID để xóa!";
            return;
        }

        $model = new SupplierModel();

        if ($model->deleteSupplier($id)) {
            header("Location: index.php?action=nhacungcap&msg=deleted");
            exit;
        } else {
            echo "Xóa thất bại!";
        }
    }
}
