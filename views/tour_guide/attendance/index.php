<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Điểm danh khách</title>

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

        h3 {
            color: #0d6efd;
            margin-bottom: 20px;
        }

        table {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        table th {
            background-color: #0d6efd;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        table td {
            vertical-align: middle;
            text-align: center;
        }

        table tr:nth-child(even) {
            background-color: #f8f9fa;
        }

        table tr:hover {
            background-color: #e7f1ff;
            transition: background 0.3s;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            border-radius: 10px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #0b5ed7;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            font-weight: 500;
        }

        @media (max-width: 576px) {

            table th,
            table td {
                font-size: 0.85rem;
                padding: 8px 5px;
            }

            .btn-primary {
                width: 100%;
                padding: 12px;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <h3>📋 Điểm danh khách</h3>

        <form method="post" action="index.php?action=attendance-store">
            <input type="hidden" name="booking_id" value="<?= $booking['booking_id'] ?>">

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Khách</th>
                        <th>SĐT</th>
                        <th>Giới tính</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($guests as $g): ?>
                        <tr>
                            <td><?= htmlspecialchars($g['name']) ?></td>
                            <td><?= htmlspecialchars($g['phone']) ?></td>
                            <td><?= htmlspecialchars($g['sex']) ?></td>
                            <td>
                                <label class="checkbox-label">
                                    <input type="checkbox"
                                        name="status[<?= $g['id'] ?>]"
                                        value="1"
                                        checked>
                                    Có mặt
                                </label>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <textarea name="note" class="form-control mb-3" rows="3" placeholder="Ghi chú điểm danh..."></textarea>

            <button type="submit" class="btn btn-primary">💾 Lưu điểm danh</button>
        </form>

    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<script>
    document.querySelectorAll('.attendance-check').forEach(cb => {
        cb.addEventListener('change', function() {
            this.closest('tr').classList.toggle('table-danger', !this.checked);
        });
    });
</script>