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
                <p><strong>Khách hàng:</strong> <?= $booking['customer_name'] ?></p>
                <p><strong>SĐT:</strong> <?= $booking['customer_phone'] ?></p>
                <p><strong>Email:</strong> <?= $booking['customer_email'] ?></p>
                <p><strong>Số người:</strong> <?= $booking['number_people'] ?></p>
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
        <div class="card-header bg-info text-white">👥 Danh sách khách</div>
        <div class="card-body">
            <?php if (!empty($guests)): ?>
                <ul class="list-group">
                    <?php foreach ($guests as $g): ?>
                        <li class="list-group-item">
                            <strong><?= $g['name'] ?></strong>
                            — <?= $g['phone'] ?> — <?= $g['email'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted fst-italic">Chưa có khách</p>
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