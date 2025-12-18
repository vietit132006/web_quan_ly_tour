<?php
session_start();

/**
 * Router đơn giản cho module Hướng dẫn viên (FILE THUẦN)
 * URL:
 *  - index.php                → danh sách
 *  - index.php?page=add       → thêm mới
 *  - index.php?page=edit&id=5 → chỉnh sửa
 */

$page = $_GET['page'] ?? 'list';

switch ($page) {
    case 'add':
        $view = __DIR__ . '/tourguide_add.php';
        break;

    case 'edit':
        $view = __DIR__ . '/tourguide_edit.php';
        break;

    default:
        $view = __DIR__ . '/tourguide_view.php';
        break;
}

// gọi master layout (dùng chung header, sidebar, topbar)
include __DIR__ . '/../layout/admin/master.php';
