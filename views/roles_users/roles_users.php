<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Người dùng & Vai trò</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        /* CSS từ giao diện home (giữ nguyên) */
        body {
            background-color: #f9fdf8;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            width: 80px;
            height: 100vh;
            background-color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #eee;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
            z-index: 200;
        }

        .sidebar a {
            color: #555;
            text-decoration: none;
            font-size: 20px;
            margin: 20px 0;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #00a86b;
        }

        .topbar {
            position: fixed;
            left: 80px;
            right: 0;
            top: 0;
            height: 60px;
            background-color: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
        }

        .search-bar input {
            border: none;
            background-color: #f2f6f4;
            padding: 6px 12px;
            border-radius: 20px;
            outline: none;
            width: 220px;
        }

        .top-icons i {
            font-size: 20px;
            color: #555;
            margin-left: 20px;
            cursor: pointer;
        }

        .top-icons img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-left: 20px;
        }

        /* Điều chỉnh margin-left của content để phù hợp với sidebar */
        .content {
            margin-left: 90px;
            margin-top: 80px;
            padding: 20px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
            border: none;
        }

        /* Thêm kiểu cho bảng */
        .table thead th {
            background-color: #e9ecef;
        }

        /* Cần thiết cho Avatar trong bảng */
        .rounded-circle {
            object-fit: cover;
        }
    </style>
</head>

<body>

   <div class="sidebar">
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
    <a href="index.php?action=nhacungcap" data-bs-toggle="tooltip" data-bs-placement="right" title="Nhà cung cấp"><i class="bi bi-graph-up"></i></a>
    <a href="index.php?action=users-roles" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>
  </div>

    <div class="topbar">
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm...">
        </div>
        <div class="top-icons">
            <i class="bi bi-sun" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chế độ sáng/tối"></i>
            <i class="bi bi-bell" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Thông báo"></i>
            <i class="bi bi-chat-dots" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tin nhắn"></i>
            <img src="https://i.pravatar.cc/40" alt="Ảnh người dùng" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tài khoản">
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <h3 class="fw-bold mb-4">User & Role Management</h3>

            <ul class="nav nav-tabs mb-3" id="myTab">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#users_tab">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#roles_tab">Roles</a>
                </li>
            </ul>

            <div class="tab-content">

                <div class="tab-pane fade show active" id="users_tab">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold">👥 User List</h5>
                        <a href="index.php?action=users_add" class="btn btn-success">
                            <i class="bi bi-person-plus"></i> Add User
                        </a>
                    </div>

                    <div class="card p-3">
                        <table class="table table-bordered table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Avatar</th>
                                    <th>Username</th>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($users) && is_array($users)): ?>
                                    <?php foreach ($users as $u): ?>
                                        <tr>
                                            <td><?= $u['id'] ?></td>
                                            <td><img src="<?= $u['avatar'] ?>" width="40" class="rounded-circle" alt="Avatar"></td>
                                            <td><?= $u['username'] ?></td>
                                            <td><?= $u['full_name'] ?></td>
                                            <td><?= $u['email'] ?></td>
                                            <td><?= $u['phone'] ?></td>
                                            <td><?= $u['role_name'] ?></td>
                                            <td>
                                                <?php if ($u['status'] == 1): ?>
                                                    <span class="badge bg-success">Active</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Inactive</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="index.php?action=users_edit&id=<?= $u['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="index.php?action=users_delete&id=<?= $u['id'] ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete user ID: <?= $u['id'] ?>?');" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="9" class="text-center text-danger">No user data found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="tab-pane fade" id="roles_tab">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="fw-bold">🛡️ Role List</h5>
                        <a href="index.php?action=role_add" class="btn btn-success">
                            <i class="bi bi-plus-circle"></i> Add Role
                        </a>
                    </div>

                    <div class="card p-3">
                        <table class="table table-bordered table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Role Name</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th width="150">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($roles) && is_array($roles)): ?>
                                    <?php foreach ($roles as $r): ?>
                                        <tr>
                                            <td><?= $r['id'] ?></td>
                                            <td><?= $r['name'] ?></td>
                                            <td><?= $r['description'] ?? 'Không có mô tả' ?></td>
                                            <td><?= $r['created_at'] ?? 'lỗi' ?></td>
                                            <td>
                                                <a href="index.php?action=roles_edit&id=<?= $r['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="index.php?action=roles_delete&id=<?= $r['id'] ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete role ID: <?= $r['id'] ?>?');" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-danger">No role data found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Kích hoạt Tooltips của Bootstrap (cần thiết cho Sidebar và Topbar)
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>