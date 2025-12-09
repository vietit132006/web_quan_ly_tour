<!-- SIDEBAR -->
<div class="sidebar">

    <a href="#">
        <i class="bi bi-list"></i>
        <span>Menu</span>
    </a>

    <a href="index.php?action=/"
        class="<?= $current == '/' ? 'active' : '' ?>">
        <i class="bi bi-house-door"></i>
        <span>Trang chủ</span>
    </a>

    <a href="index.php?action=booking"
        class="<?= $current == 'booking' ? 'active' : '' ?>">
        <i class="bi bi-calendar-check"></i>
        <span>Quản lý Tour</span>
    </a>

    <a href="index.php?action=nhacungcap"
        class="<?= $current == 'nhacungcap' ? 'active' : '' ?>">
        <i class="bi bi-building"></i>
        <span>Nhà cung cấp</span>
    </a>

    <a href="index.php?action=manage"
        class="<?= $current == 'manage' ? 'active' : '' ?>">
        <i class="bi bi-kanban"></i>
        <span>Lịch trình tour</span>
    </a>

    <a href="index.php?action=users"
        class="<?= $current == 'users' ? 'active' : '' ?>">
        <i class="bi bi-people"></i>
        <span>Tài khoản</span>
    </a>

    <a href="#">
        <i class="bi bi-gear"></i>
        <span>Cài đặt</span>
    </a>

</div>


<!-- TOPBAR -->
<div class="topbar">
    <div class="search-bar">
        <input type="text" placeholder="Tìm kiếm...">
    </div>

    <div class="top-icons">
        <i class="bi bi-sun"></i>
        <i class="bi bi-bell"></i>
        <i class="bi bi-chat-dots"></i>

        <div class="dropdown">
            <?php if (empty($_SESSION["user"])): ?>
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                    class="rounded-circle" style="width:40px; cursor:pointer;"
                    data-bs-toggle="dropdown">
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="index.php?action=login_form">Đăng nhập</a></li>
                </ul>
            <?php else: ?>
                <img src="<?= htmlspecialchars($_SESSION['user']['avatar'] ?? 'https://i.pravatar.cc/40') ?>"
                    class="rounded-circle" style="width:40px; cursor:pointer;"
                    data-bs-toggle="dropdown">
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="index.php?action=logout">Đăng xuất</a></li>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
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