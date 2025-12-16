<!DOCTYPE html>
<html lang="vi">

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lịch làm việc</title>
    <style>
        /* ===== BODY & CONTAINER ===== */
        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 30px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        /* ===== HEADER ===== */
        h2 {
            text-align: center;
            color: #0d6efd;
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 25px;
        }

        /* ===== TABLE ===== */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 14px;
        }

        thead th {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
            text-align: center;
            padding: 14px 10px;
            position: sticky;
            top: 0;
            z-index: 1;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        tbody td {
            padding: 12px 10px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        tbody tr {
            transition: all 0.3s ease;
        }

        tbody tr:hover {
            background: linear-gradient(90deg, #e7f1ff, #ffffff);
            transform: scale(1.01);
        }

        /* ===== BADGES ===== */
        .badge {
            padding: 6px 12px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            display: inline-block;
        }

        .bg-warning {
            background-color: #ffc107 !important;
            color: #212529;
        }

        .bg-success {
            background-color: #28a745 !important;
        }

        .bg-danger {
            background-color: #dc3545 !important;
        }

        .bg-secondary {
            background-color: #6c757d !important;
        }

        /* ===== BUTTONS ===== */
        .btn {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: 0.2s;
            cursor: pointer;
        }

        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }

        .btn-info:hover {
            background-color: #138496;
        }

        .btn-checkin {
            background-color: #fd7e14;
            color: #fff;
        }

        .btn-checkin:hover {
            background-color: #e4690b;
        }

        /* ===== STATUS DOTS ===== */
        .status {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
            font-weight: 600;
        }

        .status-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: green;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            table thead {
                display: none;
            }

            table,
            table tbody,
            table tr,
            table td {
                display: block;
                width: 100%;
            }

            table tr {
                margin-bottom: 20px;
                border: 1px solid #e9ecef;
                border-radius: 12px;
                padding: 12px;
            }

            table td {
                text-align: right;
                padding-left: 50%;
                position: relative;
            }

            table td::before {
                content: attr(data-label);
                position: absolute;
                left: 15px;
                font-weight: 600;
                text-transform: uppercase;
                font-size: 12px;
                color: #6c757d;
            }
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>📅 Lịch làm việc</h2>

        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#Booking</th>
                    <th>Tên tour</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Thời lượng</th>
                    <th>Giờ khởi hành</th>
                    <th>Số khách</th>
                    <th>Trạng thái</th>
                    <th>Chức năng</th>
                </tr>
            </thead>

            <tbody>
                <?php if (!empty($tours)): ?>
                    <?php foreach ($tours as $t): ?>
                        <tr>
                            <td>#<?= $t['booking_id'] ?></td>
                            <td><?= htmlspecialchars($t['tour_name']) ?></td>
                            <td><?= $t['start_date'] ?></td>
                            <td><?= $t['end_date'] ?></td>
                            <td><?= $t['total_days'] ?>N / <?= $t['total_nights'] ?>Đ</td>
                            <td><?= $t['departure_time'] ?></td>
                            <td><?= $t['total_guests'] ?> khách</td>

                            <!-- TRẠNG THÁI -->
                            <td>
                                <?php
                                $badge = match ($t['booking_status']) {
                                    'pending'   => 'warning',
                                    'confirmed' => 'success',
                                    'cancelled' => 'danger',
                                    default     => 'secondary'
                                };
                                ?>
                                <span class="badge bg-<?= $badge ?>">
                                    <?= strtoupper($t['booking_status']) ?>
                                </span>
                            </td>

                            <!-- CHỨC NĂNG -->
                            <td>
                                <a href="index.php?action=calendar-detail&id=<?= $t['booking_id'] ?>"
                                    class="btn btn-info btn-sm">
                                    Chi tiết
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="text-center text-muted">
                            Chưa có lịch làm việc
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>



</html>