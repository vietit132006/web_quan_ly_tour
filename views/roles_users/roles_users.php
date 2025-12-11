<!-- User & Role Management (Được làm đồng bộ với giao diện trang quản lý Tour) -->

<style>
    /* ======================== GLOBAL SECTION ======================== */
    .card {
        border-radius: 14px;
        background: #ffffff;
        border: none;
        box-shadow: 0 8px 28px rgba(0, 0, 0, 0.07);
        overflow: hidden;
        transition: 0.25s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.09);
    }

    .card-header {
        background: linear-gradient(135deg, #10b981, #0d8f6e);
        color: #ffffff;
        font-size: 19px;
        font-weight: 600;
        padding: 18px 24px;
        letter-spacing: 0.4px;
    }

    .btn-success {
        background: linear-gradient(135deg, #10b981, #0d8f6e);
        border: none;
        border-radius: 12px;
        padding: 10px 26px;
        font-weight: 600;
    }

    .btn-success:hover {
        opacity: 0.9;
    }

    .btn-warning,
    .btn-danger {
        border-radius: 10px;
        padding: 6px 12px;
    }

    table thead {
        background: #f1f5f9;
    }

    table th {
        font-weight: 600;
        color: #334155;
    }

    table td {
        font-size: 14px;
        color: #475569;
    }

    img.avatar-img {
        width: 52px;
        height: 52px;
        object-fit: cover;
        border-radius: 50%;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }
</style>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<!-- Bootstrap JS (nếu có tab, modal, dropdown) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<div class="content">
    <div class="container-fluid">

        <h3 class="fw-bold mb-4">User & Role Management</h3>

        <!-- Tabs -->
        <ul class="nav nav-tabs mb-3" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#users_tab">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#roles_tab">Roles</a>
            </li>
        </ul>

        <div class="tab-content">

            <!-- ========================= USERS ========================= -->
            <div class="tab-pane fade show active" id="users_tab">

                <div class="card mb-4">
                    <div class="card-header">👥 Danh sách người dùng</div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold">User List</h5>
                            <a href="index.php?action=users_add" class="btn btn-success">
                                <i class="bi bi-person-plus"></i> Add User
                            </a>
                        </div>

                        <table class="table table-bordered table-hover align-middle">
                            <thead>
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

                                            <td>
                                                <img src="<?= $u['avatar'] ?>" class="avatar-img">
                                            </td>

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
                                                <a href="index.php?action=users_edit&id=<?= $u['id'] ?>" class="btn btn-warning btn-sm me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>

                                                <a href="index.php?action=users_delete&id=<?= $u['id'] ?>" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete user ID: <?= $u['id'] ?>?');">
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
            </div>

            <!-- ========================= ROLES ========================= -->
            <div class="tab-pane fade" id="roles_tab">

                <div class="card mb-4">
                    <div class="card-header">🛡️ Danh sách quyền truy cập</div>
                    <div class="card-body">

                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="fw-bold">Role List</h5>
                            <a href="index.php?action=role_add" class="btn btn-success">
                                <i class="bi bi-plus-circle"></i> Add Role
                            </a>
                        </div>

                        <table class="table table-bordered table-hover">
                            <thead>
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
                                                <a href="index.php?action=roles_edit&id=<?= $r['id'] ?>" class="btn btn-warning btn-sm me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="index.php?action=roles_delete&id=<?= $r['id'] ?>" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Delete role ID: <?= $r['id'] ?>?');">
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
</div>