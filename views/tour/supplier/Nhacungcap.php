<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết Tour</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9fdf8;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 80px;
            height: 100vh;
            background-color: #fff;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid #eee;
            padding-top: 10px;
            z-index: 200;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar a {
            color: #555;
            font-size: 20px;
            margin: 18px 0;
            text-decoration: none;
            transition: .3s;
        }

        .sidebar a.active,
        .sidebar a:hover {
            color: #00a86b;
        }

        /* Topbar */
        .topbar {
            position: fixed;
            left: 80px;
            right: 0;
            top: 0;
            height: 60px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 100;
        }

        /* Content */
        .content {
            margin-left: 100px;
            margin-top: 80px;
            padding: 20px;
        }

        .card {
            border-radius: 14px;
            border: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }

        .gallery img {
            width: 100%;
            border-radius: 12px;
            height: 150px;
            object-fit: cover;
        }

        .timeline-item {
            border-left: 3px solid #00a86b;
            padding-left: 15px;
            margin-bottom: 20px;
        }

        .price-card {
            border-left: 5px solid #00a86b;
        }

        .supplier-card img {
            width: 100%;
            height: 140px;
            border-radius: 12px;
            object-fit: cover;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
        <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
        <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
        <a href="index.php?action=nhacungcap" data-bs-toggle="tooltip" data-bs-placement="right" title="Nhà cung cấp"><i class="bi bi-graph-up"></i></a>
        <a href="index.php?action=users-roles" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
        <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>
    </div>

    <!-- TOPBAR -->
    <div class="topbar">
        <div>
            <input type="text" class="form-control" style="width:220px; background:#f3f6f4; border:none; border-radius:20px;" placeholder="Tìm kiếm...">
        </div>
        <div class="d-flex align-items-center">
            <i class="bi bi-sun me-3"></i>
            <i class="bi bi-bell me-3"></i>
            <i class="bi bi-chat-dots me-3"></i>
            <img src="https://i.pravatar.cc/40" class="rounded-circle">
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">

        <div class="container mt-4">
            <h3 class="mb-3">Danh Sách Nhà Cung Cấp</h3>
            <a href="index.php?action=nhacungcap_add">thêm nhà cung cấp</a>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Người liên hệ</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số hợp đồng</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Đánh giá</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['type'] ?></td>
                                <td><?= $item['contact_person'] ?></td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?= $item['contract_number'] ?></td>
                                <td><?= $item['contract_start'] ?></td>
                                <td><?= $item['contract_end'] ?></td>
                                <td><?= $item['rating'] ?></td>
                                <td><?= $item['note'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td>
                                    <a href="index.php?action=nhacungcap_edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?action=nhacungcap_delete&id=<?= $item['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete role ID: <?= $item['id'] ?>?');" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="13" class="text-center">Không có dữ liệu nhà cung cấp.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>