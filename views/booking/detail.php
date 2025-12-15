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
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="content-wrapper booking-detail">
    <!-- toàn bộ code bạn gửi -->

    <div class="container mt-4">
        <a href="index.php?action=booking" class="btn btn-secondary mb-3">⬅ Quay lại</a>

        <!-- ===== THÔNG TIN BOOKING ===== -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white d-flex justify-content-between">
                <span>📌 Booking #<?= $booking['id'] ?></span>
                <span class="badge bg-light text-dark">
                    <?= strtoupper($booking['status']) ?>
                </span>
            </div>

            <div class="card-body row">
                <div class="col-md-6">
                    <p><strong>Khách hàng:</strong> <?= htmlspecialchars($booking['customer_name']) ?></p>
                    <p><strong>SĐT:</strong> <?= htmlspecialchars($booking['customer_phone']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($booking['customer_email']) ?></p>

                    <p>
                        <strong>Số người:</strong>
                        <?= count($guests) ?> người

                        <?php if (count($guests) < 5): ?>
                            <span class="text-danger">(Chưa đủ 5 khách)</span>
                        <?php endif; ?>
                    </p>



                </div>


                <div class="col-md-6">
                    <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
                    <p><strong>Ngày tạo:</strong>
                        <?= date('d/m/Y H:i', strtotime($booking['created_at'])) ?>
                    </p>
                    <p><strong>Ghi chú:</strong><br>
                        <?= nl2br($booking['admin_note'] ?? '—') ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- ===== CẬP NHẬT TRẠNG THÁI ===== -->
        <div class="card mb-4">
            <div class="card-header bg-warning">⚙️ Cập nhật trạng thái</div>
            <div class="card-body">
                <form method="post" action="index.php?action=booking-update" class="row g-3">
                    <input type="hidden" name="id" value="<?= $booking['id'] ?>">

                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="pending" <?= $booking['status'] == 'pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
                            <option value="confirmed" <?= $booking['status'] == 'confirmed' ? 'selected' : '' ?>>Đã xác nhận</option>
                            <option value="completed" <?= $booking['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                            <option value="cancelled" <?= $booking['status'] == 'cancelled' ? 'selected' : '' ?>>Huỷ</option>
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
                👥 Danh sách khách (<?= count($guests) ?> người)
            </div>

            <div class="card-body">
                <?php if (!empty($guests) && is_array($guests)): ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($guests as $g): ?>
                            <li class="list-group-item">
                                <div class="fw-semibold"><?= htmlspecialchars($g['name']) ?></div>
                                <small class="text-muted">
                                    <?= $g['phone'] ?? '—' ?>
                                    <?php if (!empty($g['email'])): ?>
                                        · <?= $g['email'] ?>
                                    <?php endif; ?>
                                </small>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">Chưa có khách nào</p>
                <?php endif; ?>
            </div>
        </div>


        <!-- ===== DỊCH VỤ ===== -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">🧾 Dịch vụ sử dụng</div>
            <div class="card-body">
                <?php if (!empty($services)): ?>
                    <ul class="list-group">
                        <?php foreach ($services as $s): ?>
                            <li class="list-group-item">
                                <?= $s['name'] ?>
                                — <?= number_format($s['price']) ?>đ
                            </li>

                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted fst-italic">Chưa có dịch vụ</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- 💰 TỔNG TIỀN -->
        <hr>
        <h5 class="mt-4">💰 Chi phí</h5>

        <p>
            <strong>Giá tour:</strong>
            <?= number_format($totalMoney['tour_price'] ?? 0) ?>đ
        </p>

        <p>
            <strong>Dịch vụ:</strong>
            <?= number_format($totalMoney['service_price'] ?? 0) ?>đ
        </p>

        <p class="fw-bold text-danger">
            Tổng cộng:
            <?= number_format($totalMoney['total'] ?? 0) ?>đ
        </p>



        <!-- ===== NHẬT KÝ ===== -->
        <div class="card">
            <div class="card-header bg-dark text-white">📘 Nhật ký tour</div>
            <div class="card-body">
                <?php if (!empty($logs)): ?>
                    <?php foreach ($logs as $log): ?>
                        <p>
                            <small class="text-muted">
                                <?= date('d/m/Y H:i', strtotime($log['created_at'])) ?>
                            </small><br>
                            <?= $log['content'] ?>
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