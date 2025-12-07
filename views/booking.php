<?php
session_start();

// Khởi tạo mảng booking nếu chưa có
if (!isset($_SESSION['bookings'])) {
    $_SESSION['bookings'] = [];
}

// Thêm / Cập nhật booking
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

    header('Location: booking.php');
    exit;
}

// Xóa booking
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $_SESSION['bookings'] = array_filter($_SESSION['bookings'], function($b) use ($id) {
        return $b['id'] != $id;
    });
    header('Location: booking.php');
    exit;
}

$bookings = $_SESSION['bookings'] ?? [];
?>
    <!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Quản Lý Booking</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
/* Sidebar */
.sidebar {
    width: 80px;
    height: 100%;
    background-color: #fff;
    position: fixed;
    top: 0;
    left: 0;
    border-right: 1px solid #eee;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 10px;
}
.sidebar a {
    color: #555;
    text-decoration: none;
    font-size: 20px;
    margin: 20px 0;
    transition: 0.3s;
}
.sidebar a:hover,
.sidebar a.active { color: #00a86b; }
/* Topbar */
.topbar {
    position: fixed;
    left: 80px;
    right: 0;
    top: 0;
    height: 60px;
    background-color: #fff;
    border-bottom: 1px solid #eee;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 100;
}
.search-bar input {
    border: none;
    background-color: #f2f6f4;
    padding: 6px 12px;
    border-radius: 20px;
    outline: none;
    width: 220px;
}
.top-icons i { font-size: 20px; color: #555; margin-left: 20px; cursor: pointer; }
.top-icons img { width: 35px; height: 35px; border-radius: 50%; margin-left: 20px; }
/* Content */
.content { margin-left: 100px; margin-top: 80px; padding: 20px; min-height: calc(100% - 80px); }
.card { border-radius: 15px; box-shadow: 0 3px 8px rgba(0,0,0,0.05); border: none; }
.status-badge { padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; }
.status-pending { background-color: #fff3cd; color: #856404; }
.status-confirmed { background-color: #d4edda; color: #155724; }
.status-cancelled { background-color: #f8d7da; color: #721c24; }
</style>
</head>
<body>
<div class="sidebar">

    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
    <a href="index.php?action=nhacungcap" data-bs-toggle="tooltip" data-bs-placement="right" title="Nhà cung cấp"><i class="bi bi-graph-up"></i></a>
    <a href="index.php?action=users" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>

  </div>

  <div class="topbar">
    <div class="search-bar">
      <input type="text" placeholder="Tìm kiếm...">
    </div>

    <div class="top-icons">
      <i class="bi bi-sun" data-bs-toggle="tooltip" title="Chế độ sáng/tối"></i>
      <i class="bi bi-bell" data-bs-toggle="tooltip" title="Thông báo"></i>
      <i class="bi bi-chat-dots" data-bs-toggle="tooltip" title="Tin nhắn"></i>

      <div class="dropdown">
        <?php if (empty($_SESSION["user"])): ?>
          <!-- CHƯA LOGIN -->
          <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
            class="rounded-circle"
            style="width:40px; cursor:pointer;"
            id="avatarDropdown"
            data-bs-toggle="dropdown">
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="index.php?action=login_form">Đăng nhập</a></li>
          </ul>

        <?php else: ?>
          <!-- ĐÃ LOGIN -->
          <img src="<?= htmlspecialchars($_SESSION['user']['avatar'] ?? 'https://i.pravatar.cc/40') ?>"
            class="rounded-circle"
            style="width:40px; cursor:pointer;"
            id="avatarDropdown"
            data-bs-toggle="dropdown">
          <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="index.php?action=logout">Đăng xuất</a></li>
          </ul>
        <?php endif; ?>
      </div>

    </div>


  </div>

<!-- Nội dung chính -->
<main class="content">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Quản Lý Booking</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                <i class="bi bi-plus-circle me-2"></i> Thêm Booking Mới
            </button>
        </div>

        <!-- Bảng Booking -->
        <div class="card p-3">
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th>Tour</th>
                            <th>Khách Hàng</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Mã Tour</th>
                            <th>Trạng thái thanh toán</th>
                        </tr>
                    </thead>
                    <tbody id="bookingTableBody">
                        <?php if(empty($bookings)): ?>
                            <tr><td colspan="10" class="text-center">Chưa có booking nào</td></tr>
                        <?php else: ?>
                            <?php foreach($bookings as $b): ?>
                                <tr>
                                    <td><?= htmlspecialchars($b['history']) ?></td>
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
                                    <td><span class="status-badge status-<?= $b['status'] ?>"><?= ucfirst($b['status']) ?></span></td>
                                    <td>
                                        <a href="#addBookingModal" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                           onclick="fillForm('<?= $b['id'] ?>')"><i class="bi bi-pencil"></i></a>
                                        <a href="?delete=<?= $b['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- Modal Thêm/Sửa Booking -->
<div class="modal fade" id="addBookingModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" id="bookingForm">
                <div class="modal-header">
                    <h5 class="modal-title">Thêm Booking Mới</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="bookingId">
                    <div class="mb-3"><label>Tên Tour</label><input type="text" name="tour_name" id="tourName" class="form-control" required></div>
                    <div class="mb-3"><label>Quốc Gia</label><input type="text" name="country" id="country" class="form-control" required></div>
                    <div class="mb-3"><label>Tên Khách Hàng</label><input type="text" name="customer_name" id="customerName" class="form-control" required></div>
                    <div class="mb-3"><label>Email Khách Hàng</label><input type="email" name="customer_email" id="customerEmail" class="form-control" required></div>
                    <div class="mb-3"><label>Số Đêm</label><input type="number" name="nights" id="nights" class="form-control" min="1" required></div>
                    <div class="mb-3"><label>Số Người Lớn</label><input type="number" name="adults" id="adults" class="form-control" min="1" required></div>
                    <div class="mb-3"><label>Giá (VNĐ)</label><input type="number" name="price" id="price" class="form-control" min="0" required></div>
                    <div class="mb-3"><label>Từ Ngày</label><input type="date" name="from_date" id="fromDate" class="form-control" required></div>
                    <div class="mb-3"><label>Đến Ngày</label><input type="date" name="to_date" id="toDate" class="form-control" required></div>
                    <div class="mb-3">
                        <label>Trạng Thái</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending">Chờ Xác Nhận</option>
                            <option value="confirmed">Đã Xác Nhận</option>
                            <option value="cancelled">Đã Hủy</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function fillForm(id) {
    const bookings = <?php echo json_encode($bookings); ?>;
    const booking = bookings.find(b => b.id == id);
    if (!booking) return;
    document.getElementById('bookingId').value = booking.id;
    document.getElementById('tourName').value = booking.tour_name;
    document.getElementById('country').value = booking.country;
    document.getElementById('customerName').value = booking.customer_name;
    document.getElementById('customerEmail').value = booking.customer_email;
    document.getElementById('nights').value = booking.nights;
    document.getElementById('adults').value = booking.adults;
    document.getElementById('price').value = booking.price;
    document.getElementById('fromDate').value = booking.from_date;
    document.getElementById('toDate').value = booking.to_date;
    document.getElementById('status').value = booking.status;
}

// Tìm kiếm đơn giản
document.getElementById('searchInput').addEventListener('input', function() {
    const term = this.value.toLowerCase();
    document.querySelectorAll('#bookingTableBody tr').forEach(tr => {
        tr.style.display = tr.textContent.toLowerCase().includes(term) ? '' : 'none';
    });
});
</script>
</body>
</html>
