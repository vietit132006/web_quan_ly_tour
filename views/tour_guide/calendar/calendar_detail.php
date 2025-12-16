<div class="container mt-4">

    <a href="index.php?action=calendar" class="btn btn-secondary mb-3">⬅ Quay lại</a>

    <!-- ===== THÔNG TIN TOUR ===== -->
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">🧭 Thông tin tour</div>
        <div class="card-body">
            <h4><?= htmlspecialchars($booking['tour_name']) ?></h4>
            <p><?= nl2br(htmlspecialchars($booking['description'])) ?></p>

            <p><b>Thời gian:</b>
                <?= date('d/m/Y', strtotime($booking['start_date'])) ?> →
                <?= date('d/m/Y', strtotime($booking['end_date'])) ?>
                (<?= $booking['total_days'] ?>N / <?= $booking['total_nights'] ?>Đ)
            </p>

            <p><b>Giờ khởi hành:</b> <?= $booking['departure_time'] ?></p>
            <p><b>Điểm đi:</b> <?= $booking['diem_di'] ?></p>
            <p><b>Điểm đến:</b> <?= $booking['diem_den'] ?></p>
            <p><b>Phương tiện:</b> <?= $booking['phuong_tien'] ?></p>
        </div>
    </div>

    <!-- ===== THÔNG TIN BOOKING ===== -->
    <div class="card mb-4">
        <div class="card-header bg-warning">📌 Thông tin booking</div>
        <div class="card-body">
            <p><b>Trạng thái:</b> <?= strtoupper($booking['booking_status']) ?></p>
            <p><b>Ghi chú:</b><br><?= nl2br(htmlspecialchars($booking['admin_note'] ?? '—')) ?></p>
        </div>
    </div>

    <!-- ===== KHÁCH ĐẶT ===== -->
    <div class="card mb-4">
        <div class="card-header bg-info text-white">👤 Khách đặt</div>
        <div class="card-body">
            <p><b>Tên:</b> <?= $booking['customer_name'] ?></p>
            <p><b>SĐT:</b> <?= $booking['customer_phone'] ?></p>
            <p><b>Email:</b> <?= $booking['customer_email'] ?></p>
        </div>
    </div>

    <!-- ===== DANH SÁCH KHÁCH ===== -->
    <div class="card mb-4">
        <div class="card-header bg-secondary text-white">
            👥 Danh sách khách (<?= count($guests) ?> người)
        </div>
        <div class="card-body">
            <?php if (!empty($guests)): ?>
                <ul class="list-group">
                    <?php foreach ($guests as $g): ?>
                        <li class="list-group-item">
                            <?= htmlspecialchars($g['name']) ?> —
                            <?= $g['phone'] ?> —
                            <?= $g['email'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-muted">Chưa có khách</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- ===== HÀNH ĐỘNG ===== -->
    <?php if ($booking['booking_status'] === 'pending'): ?>
        <a href="index.php?action=calendar-confirm&id=<?= $booking['booking_id'] ?>"
            class="btn btn-success">
            ✅ Nhận booking
        </a>
        <a href="index.php?action=calendar-reject&id=<?= $booking['booking_id'] ?>"
            class="btn btn-danger">
            ❌ Từ chối
        </a>
    <?php endif; ?>

</div>