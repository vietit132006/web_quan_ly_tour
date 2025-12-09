<?php $current = 'users'; ?>
<?php ob_start(); ?>

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

            <!-- USERS -->
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
                                        <td><img src="<?= $u['avatar'] ?>" width="50" height="50"></td>
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
                                            <a href="index.php?action=users_edit&id=<?= $u['id'] ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="index.php?action=users_delete&id=<?= $u['id'] ?>"
                                                class="btn btn-danger btn-sm"
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

            <!-- ROLES -->
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
                                            <a href="index.php?action=roles_edit&id=<?= $r['id'] ?>"
                                                class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <a href="index.php?action=roles_delete&id=<?= $r['id'] ?>"
                                                class="btn btn-danger btn-sm"
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

<?php $content = ob_get_clean(); ?>
<?php include PATH_VIEW . 'layout/master.php'; ?>