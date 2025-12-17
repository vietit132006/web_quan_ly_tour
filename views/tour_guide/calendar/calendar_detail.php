<?php if (empty($booking)): ?>
    <div class="alert alert-danger">
        Không tìm thấy thông tin booking
    </div>
    <?php return; ?>
<?php endif; ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết Booking</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 30px 0;
        }

        .container {
            max-width: 900px;
        }

        h2,
        h4 {
            color: #0d6efd;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .card-header {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .list-group-item {
            border-radius: 8px;
            margin-bottom: 5px;
            padding: 10px 15px;
            transition: all 0.3s;
        }

        .list-group-item:hover {
            background-color: #e7f1ff;
        }

        .btn {
            font-weight: 600;
            border-radius: 8px;
        }

        .btn-success,
        .btn-danger {
            min-width: 120px;
        }

        /* Trạng thái booking */
        .status-badge {
            font-weight: 600;
            text-transform: uppercase;
            padding: 0.4em 0.8em;
            border-radius: 12px;
            font-size: 0.9rem;
        }

        .status-pending {
            background-color: #ffc107;
            color: #212529;
        }

        .status-confirmed {
            background-color: #198754;
        }

        .status-cancelled {
            background-color: #dc3545;
        }

        /* Responsive table & content spacing */
        @media (max-width: 576px) {
            .card-body p {
                font-size: 0.9rem;
            }

            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>

<body>

    <div class="container mt-4">

        <a href="index.php?action=calendar" class="btn btn-secondary mb-3">⬅ Quay lại</a>

        <!-- ===== THÔNG TIN TOUR ===== -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">🧭 Thông tin tour</div>
            <div class="card-body">
                <h4><?= htmlspecialchars($booking['tour_name']) ?></h4>
                <p><?= nl2br(htmlspecialchars($booking['description'])) ?></p>
                <p><b>Thời gian:</b>
                    <?= date('d/m/Y', strtotime($booking['start_date'])) ?> → <?= date('d/m/Y', strtotime($booking['end_date'])) ?>
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
                <p><b>Trạng thái:</b>
                    <span class="status-badge status-<?= $booking['booking_status'] ?>">
                        <?= strtoupper($booking['booking_status']) ?>
                    </span>
                </p>
                <p><b>Ghi chú:</b><br><?= nl2br(htmlspecialchars($booking['admin_note'] ?? '—')) ?></p>
            </div>
        </div>

        <!-- ===== KHÁCH ĐẶT ===== -->
        <div class="card mb-4">
            <div class="card-header bg-info text-white">👤 Khách đặt</div>
            <div class="card-body">
                <p><b>Tên:</b> <?= htmlspecialchars($booking['customer_name']) ?></p>
                <p><b>SĐT:</b> <?= htmlspecialchars($booking['customer_phone']) ?></p>
                <p><b>Email:</b> <?= htmlspecialchars($booking['customer_email']) ?></p>
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
                                <?= htmlspecialchars($g['name']) ?> — <?= htmlspecialchars($g['phone']) ?> — <?= htmlspecialchars($g['email']) ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Chưa có khách</p>
                <?php endif; ?>
            </div>
        </div>
        <!-- ===== LỊCH SỬ ĐIỂM DANH ===== -->
        <div class="card mb-4">
            <div class="card-header bg-dark text-white">
                📚 Lịch sử điểm danh
            </div>
            <div class="card-body">

                <?php if (!empty($sessions)): ?>
                    <?php foreach ($sessions as $s): ?>
                        <div class="card mb-2">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Phiên #<?= $s['id'] ?></strong> —
                                    <?= date('d/m/Y H:i', strtotime($s['created_at'])) ?><br>
                                    <small class="text-muted">
                                        Ghi chú: <?= $s['note'] ?: '—' ?>
                                    </small>
                                </div>
                                <a href="index.php?action=attendance-session&id=<?= $s['id'] ?>"
                                    class="btn btn-outline-secondary btn-sm">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted fst-italic mb-0">
                        Chưa có phiên điểm danh
                    </p>
                <?php endif; ?>

            </div>
        </div>


        <!-- ===== HÀNH ĐỘNG ===== -->
        <?php if ($booking['guide_status'] === 'pending'): ?>
            <div class="d-flex gap-3 flex-wrap mb-4">
                <a href="index.php?action=calendar-confirm&id=<?= $booking['booking_id'] ?>"
                    class="btn btn-success">✅ Nhận booking</a>
                <a href="index.php?action=calendar-reject&id=<?= $booking['booking_id'] ?>"
                    class="btn btn-danger">❌ Từ chối</a>
            </div>
        <?php endif; ?>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>