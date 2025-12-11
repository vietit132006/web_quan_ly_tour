<<<<<<< HEAD
<?php ob_start(); ?>
<h3>Quản lý Booking</h3>

<table border="1" cellpadding="8" cellspacing="0" width="100%">
    <tr>
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

    <?php foreach ($bookings as $b): ?>
        <tr>
            <td><?= $b['id'] ?></td>
            <td><?= $b['customer_name'] ?></td>
            <td><?= $b['customer_phone'] ?></td>
            <td><?= htmlspecialchars($b['tour_name']) ?></td>
            <td><?= $b['number_people'] ?></td>
            <td><?= $b['history'] ?></td>

            <!-- Trạng thái -->
            <td>
                <?php
                if ($b['status'] === 'pending') {
                    echo '<span style="color:orange">Đang xử lý</span>';
                } elseif ($b['status'] === 'confirmed') {
                    echo '<span style="color:green">Đã xác nhận</span>';
                } else {
                    echo '<span style="color:red">Đã hủy</span>';
                }
                ?>
            </td>

            <td><?= $b['payment_status'] ?></td>

            <!-- Hành động -->
            <td>
                <a href="index.php?action=booking-detail&id=<?= $b['id'] ?>">👁 Chi tiết</a>

                <?php if ($b['status'] === 'pending'): ?>
                    | <a href="index.php?action=booking-update&id=<?= $b['id'] ?>&status=confirmed"
                        onclick="return confirm('Xác nhận booking này?')">
                        ✅ Xác nhận
                    </a>

                    | <a href="index.php?action=booking-update&id=<?= $b['id'] ?>&status=cancelled"
                        onclick="return confirm('Hủy booking này?')">
                        ❌ Hủy
                    </a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/../layout/master.php'; ?>

  
=======
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
