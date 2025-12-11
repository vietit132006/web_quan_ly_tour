<style>
    /* =====================================
   🌐 ROOT – TRAVELPRO THEME
===================================== */
    :root {
        --primary: #06a3c9;
        --primary-dark: #008bb0;
        --danger: #dc3545;
        --success: #28a745;
        --warning: #ffc107;

        --text-dark: #2c3e50;
        --text-light: #6c7a89;

        --bg-card: #ffffff;
        --bg-hover: #eefaff;

        --radius: 14px;
        --radius-sm: 8px;

        --shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.12);

        --transition: all 0.25s ease;
    }

    /* =====================================
   📝 TITLE
===================================== */
    h3 {
        font-weight: 700;
        color: var(--primary);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    /* =====================================
   📊 BOOKING TABLE
===================================== */
    .table {
        background: var(--bg-card);
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-top: 15px;
    }

    /* Header */
    .table thead {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
    }

    .table thead th {
        padding: 14px;
        font-size: 13px;
        text-transform: uppercase;
        border: none;
        letter-spacing: 0.5px;
    }

    /* Body */
    .table tbody td {
        padding: 14px;
        font-size: 14px;
        color: var(--text-dark);
        vertical-align: middle;
        border-top: 1px solid #eef1f5;
    }

    /* Hover row */
    .table tbody tr {
        transition: var(--transition);
    }

    .table tbody tr:hover {
        background: var(--bg-hover);
        transform: scale(1.005);
    }

    /* =====================================
   🎖 BADGES (Trạng thái)
===================================== */
    .badge {
        padding: 8px 12px;
        font-size: 12px;
        border-radius: 50px;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    /* Pending */
    .badge.bg-warning {
        background: #fff4cc !important;
        color: #a97800 !important;
    }

    /* Confirmed */
    .badge.bg-success {
        background: #d7f7df !important;
        color: var(--success) !important;
    }

    /* Cancelled */
    .badge.bg-danger {
        background: #ffe1e1 !important;
        color: var(--danger) !important;
    }

    /* =====================================
   🔘 ACTION BUTTONS
===================================== */
    td .btn {
        border-radius: 50px !important;
        padding: 6px 10px;
        font-size: 13px;
        font-weight: 600;
        transition: var(--transition);
        border: none !important;
    }

    /* View button */
    .btn-info {
        background: #e6f7ff !important;
        color: var(--primary) !important;
    }

    .btn-info:hover {
        background: var(--primary) !important;
        color: white !important;
        box-shadow: var(--shadow-lg);
    }

    /* Confirm */
    .btn-success {
        background: #d7f7df !important;
        color: var(--success) !important;
    }

    .btn-success:hover {
        background: var(--success) !important;
        color: white !important;
        box-shadow: var(--shadow-lg);
    }

    /* Cancel */
    .btn-danger {
        background: #ffe1e1 !important;
        color: var(--danger) !important;
    }

    .btn-danger:hover {
        background: var(--danger) !important;
        color: white !important;
        box-shadow: var(--shadow-lg);
    }

    /* =====================================
   📱 RESPONSIVE
===================================== */
    @media (max-width: 992px) {

        .table thead th,
        .table tbody td {
            padding: 10px;
            font-size: 12px;
        }

        td .btn {
            padding: 5px 8px;
        }
    }
</style>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/styles.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<h3 class="mb-4 text-xl font-bold">
    <i class="bi bi-calendar-check"></i> Quản lý Booking
</h3>

<table class="table table-bordered table-hover align-middle" width="100%">
    <thead class="table-light">
        <tr class="text-center">
            <th>ID</th>
            <th>Khách hàng</th>
            <th>SĐT</th>
            <th>Tour</th>
            <th>Số người</th>
            <th>Ngày đặt</th>
            <th>Trạng thái</th>
            <th>Thanh toán</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($bookings as $b): ?>
            <tr>
                <td class="text-center"><?= $b['id'] ?></td>
                <td><?= $b['customer_name'] ?></td>
                <td><?= $b['customer_phone'] ?></td>
                <td><?= htmlspecialchars($b['tour_name']) ?></td>
                <td class="text-center"><?= $b['number_people'] ?></td>
                <td><?= $b['history'] ?></td>

                <!-- Trạng thái -->
                <td class="text-center">
                    <?php if ($b['status'] === 'pending'): ?>
                        <span class="badge bg-warning text-dark">
                            <i class="bi bi-hourglass-split"></i> Đang xử lý
                        </span>
                    <?php elseif ($b['status'] === 'confirmed'): ?>
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle"></i> Đã xác nhận
                        </span>
                    <?php else: ?>
                        <span class="badge bg-danger">
                            <i class="bi bi-x-circle"></i> Đã hủy
                        </span>
                    <?php endif; ?>
                </td>

                <td class="text-center">
                    <?= $b['payment_status'] ?>
                </td>

                <!-- Hành động -->
                <td class="text-center">
                    <a class="btn btn-sm btn-info"
                        href="index.php?action=booking-detail&id=<?= $b['id'] ?>">
                        <i class="bi bi-eye"></i>
                    </a>

                    <?php if ($b['status'] === 'pending'): ?>
                        <a class="btn btn-sm btn-success"
                            href="index.php?action=booking-update&id=<?= $b['id'] ?>&status=confirmed"
                            onclick="return confirm('Xác nhận booking này?')">
                            <i class="bi bi-check-lg"></i>
                        </a>

                        <a class="btn btn-sm btn-danger"
                            href="index.php?action=booking-update&id=<?= $b['id'] ?>&status=cancelled"
                            onclick="return confirm('Hủy booking này?')">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
>>>>>>> master
