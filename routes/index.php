<?php

$action = $_GET['action'] ?? '/';

match ($action) {
    '/'         => (new HomeController)->index(),
    'booking'   => (new BookingController)->index(),
    'users' => (new UserController)->listUser(),
    'users-roles'     => (new UserController)->listUser(),
    'users_add'   => (new UserController)->addUser(),
    'users_store' => (new UserController)->storeUser(),
    'users_edit'    => (new UserController)->editUser(),
    'users_update'  => (new UserController)->updateUser(),
    'users_delete'  => (new UserController)->deleteUser(),
    'nhacungcap' => (new SupplierController)->listSuppliers(),
    'nhacungcap_add' => (new SupplierController)->addSupplier(),
    'supplier_store' => (new SupplierController)->storeSupplier(),//p2 của thêm
    'nhacungcap_edit' => (new SupplierController)->editSupplier(),
    'nhacungcap_update' => (new SupplierController)->updateSupplier(),//p2 của sửa
    'nhacungcap_delete' => (new SupplierController)->deleteSupplier(),

     default => function() {
        http_response_code(404);
        echo "Trang không tồn tại (action không được xử lý).";
    }
};
