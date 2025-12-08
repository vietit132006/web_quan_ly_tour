<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <title>Quản lý Tour Du Lịch</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f2f2f8;
            font-family: 'Poppins', sans-serif;
        }

        /* SIDEBAR */
        .sidebar {
            width: 85px;
            height: 100vh;
            background: #2a0436;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #3b064b;
            display: flex;
            flex-direction: column;
            padding-top: 15px;
            z-index: 200;
            transition: 0.3s;
            overflow: hidden;
        }

        .sidebar:hover {
            width: 220px;
            /* Mở rộng khi hover */
        }

        .sidebar a {
            color: #e8d8ff;
            text-decoration: none;
            font-size: 20px;
            padding: 12px 15px;
            border-radius: 12px;
            margin: 10px 10px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: 0.25s ease-in-out;
            white-space: nowrap;
        }

        .sidebar a i {
            font-size: 22px;
        }

        /* Hover */
        .sidebar a:hover {
            background: #5e0b8a;
            color: #fff;
        }

        /* ĐANG ACTIVE */
        .sidebar a.active {
            background: #8d15cc;
            color: #fff !important;
            box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
        }

        /* Khi sidebar thu nhỏ */
        .sidebar:not(:hover) span {
            opacity: 0;
            width: 0;
        }

        /* Khi mở rộng */
        .sidebar:hover span {
            opacity: 1;
            width: auto;
        }

        /* ĐANG ACTIVE */
        .sidebar a.active {
            background: #8d15cc;
            color: #fff !important;
            box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
        }

        /* TOPBAR */
        .topbar {
            position: fixed;
            left: 85px;
            right: 0;
            top: 0;
            height: 60px;
            background: #2a0436;
            border-bottom: 1px solid #3b064b;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
            color: white;
        }

        .search-bar input {
            border: none;
            background-color: #3c0a4d;
            padding: 8px 14px;
            border-radius: 20px;
            outline: none;
            width: 220px;
            color: white;
        }

        .top-icons i {
            font-size: 20px;
            color: #e8d8ff;
            margin-left: 20px;
            cursor: pointer;
        }

        .top-icons i:hover {
            color: #fff;
        }

        .content {
            margin-left: 105px;
            margin-top: 80px;
            padding: 20px;
        }

        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
        }
    </style>
</head>

<>

    <!-- SIDEBAR -->
    <div class="sidebar">

        <a href="#">
            <i class="bi bi-list"></i>
            <span>Menu</span>
        </a>

        <a href="index.php?action=/"
            class="<?= $current == '/' ? 'active' : '' ?>">
            <i class="bi bi-house-door"></i>
            <span>Trang chủ</span>
        </a>

        <a href="index.php?action=booking"
            class="<?= $current == 'booking' ? 'active' : '' ?>">
            <i class="bi bi-calendar-check"></i>
            <span>Quản lý Tour</span>
        </a>

        <a href="index.php?action=nhacungcap"
            class="<?= $current == 'nhacungcap' ? 'active' : '' ?>">
            <i class="bi bi-building"></i>
            <span>Nhà cung cấp</span>
        </a>

        <a href="index.php?action=users"
            class="<?= $current == 'users' ? 'active' : '' ?>">
            <i class="bi bi-people"></i>
            <span>Tài khoản</span>
        </a>

        <a href="#">
            <i class="bi bi-gear"></i>
            <span>Cài đặt</span>
        </a>

    </div>


    <!-- TOPBAR -->
    <div class="topbar">
        <div class="search-bar">
            <input type="text" placeholder="Tìm kiếm...">
        </div>

        <div class="top-icons">
            <i class="bi bi-sun"></i>
            <i class="bi bi-bell"></i>
            <i class="bi bi-chat-dots"></i>

            <div class="dropdown">
                <?php if (empty($_SESSION["user"])): ?>
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                        class="rounded-circle" style="width:40px; cursor:pointer;"
                        data-bs-toggle="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="index.php?action=login_form">Đăng nhập</a></li>
                    </ul>
                <?php else: ?>
                    <img src="<?= htmlspecialchars($_SESSION['user']['avatar'] ?? 'https://i.pravatar.cc/40') ?>"
                        class="rounded-circle" style="width:40px; cursor:pointer;"
                        data-bs-toggle="dropdown">
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="index.php?action=logout">Đăng xuất</a></li>
                    </ul>
                <?php endif; ?>
            </div>
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