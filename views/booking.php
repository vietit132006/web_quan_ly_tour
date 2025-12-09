<?php
session_start();

/* ===== Logic xử lý giữ nguyên ===== */
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? time();
    $booking = [
        'id' => $id,
        'tour_name' => $_POST['tour_name'],
        'country' => $_POST['country'],
        'customer_name' => $_POST['customer_name'],
        'customer_email' => $_POST['customer_email'],
        'nights' => (int)$_POST['nights'],
        'adults' => (int)$_POST['adults'],
        'price' => (int)$_POST['price'],
        'from_date' => $_POST['from_date'],
        'to_date' => $_POST['to_date'],
        'status' => $_POST['status'],
        'created_at' => $_POST['created_at'] ?? date('c')
    ];

    $updated = false;
    foreach ($_SESSION['bookings'] as &$b) {
        if ($b['id'] == $id) {
            $b = $booking;
            $updated = true;
            break;
        }
    }
    unset($b);

    if (!$updated) {
        $_SESSION['bookings'][] = $booking;
    }

    header('Location: index.php?action=booking');
    exit;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $_SESSION['bookings'] = array_filter($_SESSION['bookings'], function($b) use ($id) {
        return $b['id'] != $id;
    });
    header('Location: index.php?action=booking');
    exit;
}

$bookings = $_SESSION['bookings'] ?? [];
?>

<?php $current = 'booking'; ?>
<?php ob_start(); ?>

<!-- ===== PHẦN NỘI DUNG RIÊNG ===== -->

<div class="content">
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Quản Lý Booking</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                <i class="bi bi-plus-circle me-2"></i> Thêm Booking
            </button>
        </div>

        <div class="card p-3">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>Khách Hàng</th>
                            <th>Quốc Gia</th>
                            <th>Số Đêm</th>
                            <th>Từ</th>
                            <th>Đến</th>
                            <th>Số Người</th>
                            <th>Giá</th>
                            <th>Trạng Thái</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody id="bookingTableBody">
                        <?php if(empty($bookings)): ?>
                            <tr><td colspan="10" class="text-center">Chưa có booking nào</td></tr>
                        <?php else: ?>
                            <?php foreach($bookings as $b): ?>
                                <tr>
                                    <td><?= htmlspecialchars($b['tour_name']) ?></td>
                                    <td>
                                        <?= htmlspecialchars($b['customer_name']) ?><br>
                                        <small><?= htmlspecialchars($b['customer_email']) ?></small>
                                    </td>
                                    <td><?= htmlspecialchars($b['country']) ?></td>
                                    <td><?= $b['nights'] ?></td>
                                    <td><?= $b['from_date'] ?></td>
                                    <td><?= $b['to_date'] ?></td>
                                    <td><?= $b['adults'] ?></td>
                                    <td><?= number_format($b['price']) ?> VNĐ</td>
                                    <td>
                                        <span class="status-badge status-<?= $b['status'] ?>">
                                            <?= ucfirst($b['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button class="btn btn-outline-primary btn-sm"
                                            data-bs-toggle="modal"
                                            data-bs-target="#addBookingModal"
                                            onclick="fillForm('<?= $b['id'] ?>')">
                                            <i class="bi bi-pencil"></i>
                                        </button>

                                        <a href="index.php?action=booking&delete=<?= $b['id'] ?>"
                                           class="btn btn-outline-danger btn-sm"
                                           onclick="return confirm('Xóa booking này?')">
                                           <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- MODAL GIỮ NGUYÊN -->
<?php include __DIR__ . '/Manage/modal_booking.php'; ?>

<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layout/master.php'; ?>
