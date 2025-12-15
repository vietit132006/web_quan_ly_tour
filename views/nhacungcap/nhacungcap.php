<style>
/* ===========================
   🌐 THEME – NHÀ CUNG CẤP
=========================== */
:root {
    --primary: #06a3c9;
    --primary-dark: #008bb0;
    --danger: #dc3545;

    --text-dark: #2c3e50;
    --text-light: #6c7a89;

    --bg-page: #f4f6fa;
    --bg-card: #ffffff;
    --bg-hover: #eefaff;

    --radius: 14px;
    --radius-sm: 10px;

    --shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.12);

    --transition: all 0.25s ease;
}

/* ===========================
   📦 CONTENT
=========================== */
.ncc-content {
    background: var(--bg-card);
    padding: 28px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    margin: 20px;
}

.ncc-content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--primary);
}

/* ===========================
   📊 TABLE
=========================== */
.ncc-table {
    background: var(--bg-card);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
}

.ncc-table thead {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
}

.ncc-table thead th {
    padding: 16px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
}

.ncc-table tbody td {
    padding: 15px;
    font-size: 14px;
    border-top: 1px solid #eef1f5;
    vertical-align: middle;
}

/* Hover row */
.ncc-table tbody tr:hover {
    background: var(--bg-hover);
    transform: scale(1.005);
    transition: var(--transition);
}

/* Highlight column – Tên NCC */
.ncc-table tbody td:nth-child(2) {
    font-weight: 600;
    color: var(--primary);
}

/* ===========================
   🎛 ACTION BUTTONS
=========================== */
.ncc-actions {
    display: flex;
    gap: 10px;
    justify-content: center;
}

.ncc-btn-edit,
.ncc-btn-delete {
    padding: 7px 18px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
}

.ncc-btn-edit {
    background: #e7f7ff;
    color: var(--primary);
}

.ncc-btn-edit:hover {
    background: var(--primary);
    color: #fff;
    box-shadow: var(--shadow-lg);
}

.ncc-btn-delete {
    background: #ffe7e7;
    color: var(--danger);
}

.ncc-btn-delete:hover {
    background: var(--danger);
    color: #fff;
    box-shadow: var(--shadow-lg);
}

/* ===========================
   ➕ ADD BUTTON
=========================== */
.ncc-add-btn {
    background: var(--primary);
    border: none;
    padding: 10px 22px;
    border-radius: var(--radius-sm);
    font-weight: 600;
    color: #fff;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.ncc-add-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

/* ===========================
   📱 RESPONSIVE
=========================== */
@media (max-width: 992px) {
    .ncc-content {
        padding: 18px;
    }

    .ncc-table thead th,
    .ncc-table tbody td {
        padding: 10px;
        font-size: 12px;
    }

    .ncc-actions {
        flex-direction: column;
    }
}

</style>
<!-- Bootstrap CSS -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
  rel="stylesheet"
>

<!-- Bootstrap Icons -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
  rel="stylesheet"
>
<!-- CSS riêng cho Quản lý Nhà Cung Cấp -->
<link rel="stylesheet" href="assets/css/nhacungcap.css">

<body>

<div class="ncc-content">
    <h3>Danh sách nhà cung cấp</h3>

    <a href="index.php?action=nhacungcap_add"
       class="ncc-add-btn mb-3 d-inline-block">
        Thêm nhà cung cấp
    </a>

    <div class="table-responsive">
        <table class="table table-striped align-middle ncc-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên NCC</th>
                    <th>Loại</th>
                    <th>Người liên hệ</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Hợp đồng</th>
                    <th>Đánh giá</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($suppliers)): ?>
                    <?php foreach ($suppliers as $sup): ?>
                        <tr>
                            <td><?= htmlspecialchars($sup['id']) ?></td>

                            <!-- Cột nổi bật -->
                            <td><?= htmlspecialchars($sup['name']) ?></td>

                            <td><?= htmlspecialchars($sup['type']) ?></td>
                            <td><?= htmlspecialchars($sup['contact_person']) ?></td>
                            <td><?= htmlspecialchars($sup['phone']) ?></td>
                            <td><?= htmlspecialchars($sup['email']) ?></td>
                            <td><?= htmlspecialchars($sup['contract_number']) ?></td>
                            <td><?= htmlspecialchars($sup['rating']) ?></td>

                            <td class="ncc-actions">
                                <a href="index.php?action=nhacungcap_edit&id=<?= $sup['id'] ?>"
                                   class="ncc-btn-edit">
                                    Sửa
                                </a>

                                <a href="index.php?action=nhacungcap_delete&id=<?= $sup['id'] ?>"
                                   class="ncc-btn-delete"
                                   onclick="return confirm('Xóa nhà cung cấp này?')">
                                    Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center">
                            Chưa có nhà cung cấp nào
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS -->
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
