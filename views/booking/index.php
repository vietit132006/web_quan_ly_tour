<style>
    /* ================== BOOKING PAGE PRO ================== */
    .booking-page {
        animation: fadeIn 0.4s ease-in-out;
    }

    /* Header */
    .page-header {
        background: #ffffff;
        padding: 16px 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
    }

    /* Card bảng */
    .card {
        border-radius: 14px;
        overflow: hidden;
    }

    /* Table */
    .table {
        margin-bottom: 0;
    }

    .table thead {
        background: linear-gradient(180deg, #f8f9fa, #eef1f4);
    }

    .table thead th {
        padding: 14px 12px;
        text-transform: uppercase;
        font-size: 12px;
        letter-spacing: 0.04em;
    }

    .table tbody td {
        padding: 14px 12px;
    }

    /* Hover từng dòng */
    .table tbody tr {
        transition: all 0.15s ease;
    }

    .table tbody tr:hover {
        background-color: #f6f9fc;
        transform: scale(1.002);
    }

    /* ID */
    .table td:first-child {
        font-weight: 600;
        color: #495057;
    }

    /* Badge đẹp hơn */
    .badge {
        border-radius: 999px;
        font-size: 12px;
    }

    /* Nút hành động */
    .btn-outline-primary {
        border-radius: 20px;
        padding: 4px 12px;
    }

    .btn-outline-primary:hover {
        transform: translateY(-1px);
    }

    /* Nút thêm booking */
    .page-header .btn-success {
        border-radius: 30px;
        padding: 8px 16px;
        font-weight: 500;
    }

    /* Không có dữ liệu */
    .table tbody tr td.text-muted {
        font-style: italic;
    }

    /* Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(6px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="content-wrapper">
    <div class="booking-page">

        <!-- Header -->
        <div class="page-header">
            <div>
                <h3 class="page-title">Danh sách Booking</h3>
                <p class="page-subtitle">Quản lý các booking tour của khách hàng</p>
            </div>

            <a href="index.php?action=booking-create" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Thêm Booking
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow-sm">
            <div class="card-body p-0">

                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Khách hàng</th>
                            <th>Tour</th>
                            <th>SĐT</th>
                            <th class="text-center">Số người</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Ngày tạo</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bookings as $b): ?>
                            <tr>
                                <td>#<?= $b['id'] ?></td>

                                <td>
                                    <div class="fw-semibold">
                                        <?= htmlspecialchars($b['customer_name'] ?? '---') ?>
                                    </div>
                                </td>

                                <td><?= htmlspecialchars($b['tour_name']) ?></td>

                                <td><?= htmlspecialchars($b['customer_phone'] ?? '---') ?></td>

                                <td class="text-center">
                                    <span class="badge bg-info">
                                        <?= isset($b['number_people']) ? (int)$b['number_people'] : 0 ?> người
                                    </span>


                                </td>

                                <td class="text-center">
                                    <?php
                                    $badge = match ($b['status']) {
                                        'pending'   => 'warning',
                                        'confirmed' => 'success',
                                        'cancelled' => 'danger',
                                        'completed' => 'primary',
                                        default     => 'secondary'
                                    };
                                    ?>
                                    <span class="badge bg-<?= $badge ?>">
                                        <?= ucfirst($b['status']) ?>
                                    </span>
                                </td>

                                <td class="text-center text-muted">
                                    <?= date('d/m/Y H:i', strtotime($b['created_at'] ?? '')) ?>
                                </td>

                                <td class="text-center">
                                    <a href="index.php?action=booking-detail&id=<?= $b['id'] ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <?php if (empty($bookings)): ?>
                            <tr>
                                <td colspan="8" class="text-center py-4 text-muted">
                                    Không có booking nào
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>