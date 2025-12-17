<style>
    /* ================== BOOKING DETAIL ================== */
    .booking-detail {
        animation: fadeIn 0.4s ease-in-out;
    }

    /* Nút quay lại */
    .booking-detail .btn-secondary {
        border-radius: 20px;
        padding: 6px 14px;
    }

    /* Card chung */
    .booking-detail .card {
        border-radius: 14px;
        border: none;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.05);
        overflow: hidden;
    }

    /* Card header */
    .booking-detail .card-header {
        font-weight: 600;
        padding: 14px 18px;
        font-size: 15px;
    }

    /* Badge trạng thái */
    .booking-detail .badge {
        font-size: 12px;
        border-radius: 999px;
        padding: 6px 12px;
    }

    /* Nội dung card */
    .booking-detail .card-body p {
        margin-bottom: 8px;
        font-size: 14px;
    }

    /* Update form */
    .booking-detail .form-select,
    .booking-detail .btn-success {
        border-radius: 20px;
    }

    /* List group */
    .booking-detail .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f3f5;
        font-size: 14px;
        padding: 12px 14px;
    }

    .booking-detail .list-group-item:last-child {
        border-bottom: none;
    }

    /* Giá tiền */
    .booking-detail .price-box {
        background: #fff5f5;
        border-radius: 12px;
        padding: 16px;
    }

    .booking-detail .price-box p {
        margin-bottom: 6px;
    }

    /* Tổng tiền */
    .booking-detail .total-price {
        font-size: 18px;
        font-weight: 700;
    }

    /* Thanh toán */
    .payment-status-paid {
        color: green;
        font-weight: bold;
    }

    .payment-status-unpaid {
        color: red;
        font-weight: bold;
    }

    /* Nhật ký */
    .booking-detail .log-item {
        padding: 10px 0;
    }

    .booking-detail .log-item small {
        display: block;
        margin-bottom: 4px;
        color: #6c757d;
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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="content-wrapper booking-detail">
    <div class="container mt-4">
        <!-- Nút quay lại -->
        <a href="index.php?action=booking" class="btn btn-secondary mb-3">⬅ Quay lại</a>

        <!-- ===== THÔNG TIN BOOKING ===== -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between 
                        <?= ($booking['status'] ?? '') === 'completed' ? 'bg-success text-white' : 'bg-light' ?>">
                <span>📌 Booking #<?= htmlspecialchars($booking['id'] ?? '---') ?></span>
                <span class="badge bg-light text-dark">
                    <?= strtoupper($booking['status'] ?? 'PENDING') ?>
                </span>
            </div>
            <div class="card-body row">
                <div class="col-md-6">
                    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($booking['customer_name'] ?? '---') ?></p>
                    <p><strong>SĐT:</strong> <?= htmlspecialchars($booking['customer_phone'] ?? '---') ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($booking['customer_email'] ?? '---') ?></p>
                    <p>
                        <strong>Số người:</strong>
                        <?= isset($guests) ? count($guests) : 0 ?> người
                        <?php if (isset($guests) && count($guests) < 5): ?>
                            <span class="text-danger">(Chưa đủ 5 khách)</span>
                        <?php endif; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <p><strong>Tour:</strong> <?= htmlspecialchars($booking['tour_name'] ?? '---') ?></p>
                    <p><strong>Ngày tạo:</strong>
                        <?= isset($booking['created_at']) ? date('d/m/Y H:i', strtotime($booking['created_at'])) : '---' ?>
                    </p>
                    <p><strong>Ghi chú:</strong><br>
                        <?= nl2br(htmlspecialchars($booking['admin_note'] ?? '—')) ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== CẬP NHẬT TRẠNG THÁI ===== -->
        <div class="card mb-4">
            <div class="card-header bg-warning">⚙️ Cập nhật trạng thái</div>
            <div class="card-body">
                <form method="post" action="index.php?action=booking-update" class="row g-3">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($booking['id'] ?? '') ?>">
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <?php
                            $currentStatus = $booking['status'] ?? 'pending';
                            foreach ($statuses as $key => $label):
                            ?>
                                <option value="<?= $key ?>" <?= $currentStatus === $key ? 'selected' : '' ?>><?= $label ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success">Cập nhật</button>
                    </div>
                </form>
            </div>
        </div>





        <!-- ===== DANH SÁCH KHÁCH ===== -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">
                👥 Danh sách khách (<?= isset($guests) ? count($guests) : 0 ?> người)
            </div>
            <div class="card-body">
                <?php if (!empty($guests) && is_array($guests)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($guests as $g): ?>
                            <li class="list-group-item">
                                <div class="fw-semibold"><?= htmlspecialchars($g['name'] ?? '---') ?></div>
                                <small class="text-muted">
                                    <?= $g['phone'] ?? '—' ?>
                                    <?= !empty($g['email']) ? '· ' . htmlspecialchars($g['email']) : '' ?>
                                </small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">Chưa có khách nào</p>
                <?php endif; ?>
            </div>
        </div>

        <!--   ==============Dịch vụ  -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">🧾 Dịch vụ sử dụng</div>
            <div class="card-body">

                <?php if (!empty($services)): ?>
                    <ul class="list-group">
                        <?php foreach ($services as $s): ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>
                                    <?= htmlspecialchars($s['name']) ?>
                                    * <?= $s['quantity'] ?>
                                </span>
                                <strong><?= number_format($s['total']) ?>đ</strong>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Chưa có dịch vụ</p>
                <?php endif; ?>

            </div>
        </div>


        <!-- ===== HƯỚNG DẪN VIÊN ===== -->
        <div class="card mb-4">
            <div class="card-header bg-warning">
                👨‍✈️ Hướng dẫn viên
            </div>
            <div class="card-body">
                <?php if (!empty($guidesAssigned) && is_array($guidesAssigned)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($guidesAssigned as $g): ?>

                            <li class="list-group-item">
                                <div class="fw-semibold">
                                    <?= htmlspecialchars($g['full_name']) ?>
                                </div>
                                <small class="text-muted">
                                    📞 <?= htmlspecialchars($g['phone'] ?? '—') ?>
                                    <?= !empty($g['email']) ? ' · ✉ ' . htmlspecialchars($g['email']) : '' ?>
                                </small>
                                <div class="mt-1">
                                    <span class="badge bg-info">KN: <?= $g['experience_years'] ?> năm</span>
                                    <span class="badge bg-secondary"><?= htmlspecialchars($g['language']) ?></span>
                                    <span class="badge bg-dark"><?= htmlspecialchars($g['classify']) ?></span>
                                    <span class="badge bg-info"><?= $statuses[$g['status_guides'] ?? 'pending'] ?? 'Chờ xác nhận' ?></span>
                                </div>

                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">
                        Chưa gán hướng dẫn viên cho booking này
                    </p>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($isAddGuideAllowed): ?>
            <a href="index.php?action=booking-assign-guide&booking_id=<?= $booking['id'] ?>"
                class="btn btn-warning">
                👨‍✈️ Gán hướng dẫn viên
            </a>
        <?php endif; ?>
        <!-- 💰 TỔNG TIỀN -->
        <hr>
        <h5 class="mt-4">💰 Chi phí</h5>
        <p><strong>Giá tour:</strong> <?= number_format($totalMoney['tour_price'] ?? 0) ?>đ</p>
        <p><strong>Dịch vụ:</strong> <?= number_format($totalMoney['service_price'] ?? 0) ?>đ</p>
        <p class="total-price text-danger">Tổng cộng: <?= number_format($totalMoney['total'] ?? 0) ?>đ</p>

        <!-- Thanh toán -->
        <h3>Thanh toán</h3>
        <p>Phương thức: <b><?= strtoupper($payment['method'] ?? '---') ?></b></p>
        <p>Số tiền: <b><?= number_format($payment['amount'] ?? 0) ?> VNĐ</b></p>
        <p>Trạng thái:
            <b class="<?= ($payment['status'] ?? '') === 'paid' ? 'payment-status-paid' : 'payment-status-unpaid' ?>">
                <?= $payment['status'] ?? '---' ?>
            </b>
        </p>
        <?php if (!empty($payment['paid_at'])): ?>
            <p>Thời gian thanh toán: <?= date('d/m/Y H:i', strtotime($payment['paid_at'])) ?></p>
        <?php endif; ?>
        <?php if (!empty($payment['note'])): ?>
            <p>Ghi chú: <?= nl2br(htmlspecialchars($payment['note'])) ?></p>
        <?php endif; ?>

        <!-- ===== NHẬT KÝ ===== -->
        <div class="card">
            <div class="card-header bg-dark text-white">📘 Nhật ký tour</div>
            <div class="card-body">
                <?php if (!empty($logs) && is_array($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <p class="log-item">
                            <small><?= date('d/m/Y H:i', strtotime($log['created_at'] ?? '')) ?></small><br>
                            <?= htmlspecialchars($log['content'] ?? '---') ?>
                        </p>
                        <hr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted fst-italic">Chưa có nhật ký</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>