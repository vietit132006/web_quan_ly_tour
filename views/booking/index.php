<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>📋 Danh sách Booking</h3>
        <a href="index.php?action=booking-create" class="btn btn-success">
            ➕ Thêm Booking mới
        </a>
    </div>

    <table class="table table-bordered table-hover align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>ID</th>
                <th>Người đặt</th>
                <th>Tour</th>
                <th>SĐT</th>
                <th>Số người</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th width="120">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $b): ?>
                <tr>
                    <td class="text-center"><?= $b['id'] ?></td>

                    <!-- Hiển thị người đặt booking -->
                    <td><?= htmlspecialchars($b['customer_name'] ?? '') ?></td>
                    <td><?= htmlspecialchars($b['tour_name']) ?></td>
                    <td><?= htmlspecialchars($b['customer_phone'] ?? '') ?></td>
                    <td class="text-center"><?= $b['number_people'] ?></td>

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

                    <td class="text-center">
                        <?= date('d/m/Y H:i', strtotime($b['created_at'] ?? '')) ?>
                    </td>

                    <td class="text-center">
                        <a href="index.php?action=booking-detail&id=<?= $b['id'] ?>"
                            class="btn btn-sm btn-primary">
                            Chi tiết
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>