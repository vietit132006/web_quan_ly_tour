<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Quản lý Tour Du Lịch</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9fdf8;
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar trái */
    .sidebar {
      width: 80px;
      height: 100vh;
      background-color: #fff;
      position: fixed;
      top: 0;
      left: 0;
      border-right: 1px solid #eee;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 10px;
      z-index: 200;
    }

    .sidebar a {
      color: #555;
      text-decoration: none;
      font-size: 20px;
      margin: 20px 0;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      color: #00a86b;
    }

    /* Thanh trên cùng */
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

    .top-icons i {
      font-size: 20px;
      color: #555;
      margin-left: 20px;
      cursor: pointer;
    }

    .top-icons img {
      width: 35px;
      height: 35px;
      border-radius: 50%;
      margin-left: 20px;
    }

    /* Nội dung chính */
    .content {
      margin-left: 100px;
      margin-top: 80px;
      padding: 20px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
      border: none;
    }

    .hotel-card img {
      width: 100%;
      height: 160px;
      border-radius: 15px;
      object-fit: cover;
    }

    .badge-lux {
      background-color: #ffca28;
      color: #000;
    }

    .badge-pent {
      background-color: #1976d2;
      color: #fff;
    }

    .badge-plus {
      background-color: #00bfa5;
      color: #fff;
    }

    /* Bảng tour */
    .table thead th {
      background-color: #e9ecef;
    }

    .action-btns a {
      margin-right: 5px;
      font-size: 14px;
      text-decoration: none;
    }

    .action-btns a.btn-edit {
      color: #0d6efd;
    }

    .action-btns a.btn-delete {
      color: #dc3545;
    }
  </style>
</head>

<body>
  <div class="sidebar">
    <a href="#"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" class="active"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking"><i class="bi bi-calendar-check"></i></a>
    <a href="index.php?action=manage"><i class="bi bi-graph-up"></i></a>
    <a href="#"><i class="bi bi-person"></i></a>
    <a href="#"><i class="bi bi-gear"></i></a>
  </div>

  <div class="topbar">
    <div class="search-bar">
      <input type="text" placeholder="Tìm kiếm...">
    </div>
    <div class="top-icons">
      <i class="bi bi-sun" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chế độ sáng/tối"></i>
      <i class="bi bi-bell" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Thông báo"></i>
      <i class="bi bi-chat-dots" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tin nhắn"></i>
      <img src="https://i.pravatar.cc/40" alt="Ảnh người dùng" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tài khoản">
    </div>
  </div>

  <div class="content">
    <h3>Lịch trình tour</h3>
 <a href="index.php?action=manage-create">Thêm mới</a>

    <div class="table-responsive">
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>ID</th>
            <th>Tour</th>
            <th>Ngày bắt đầu</th>
            <th>Ngày kết thúc</th>
            <th>Ngày tour</th>
            <th>Số khách</th>
            <th>Hướng dẫn viên</th>
            <th>Dịch vụ</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($tour_group)): ?>
            <?php foreach ($tour_group as $tg): ?>
              <tr>
                <td><?= htmlspecialchars($tg['id']) ?></td>
                <td><?= htmlspecialchars($tg['tour_name']) ?></td>
                <td><?= htmlspecialchars($tg['start_date']) ?></td>
                <td><?= htmlspecialchars($tg['end_date']) ?></td>
                <td><?= htmlspecialchars($tg['so_ngay']) ?> ngày  <?= htmlspecialchars($tg['so_dem']) ?> đêm</td>
                <td><?= htmlspecialchars($tg['number_guests']) ?></td>
                <td><?= htmlspecialchars($tg['guide_name']) ?></td>
                <td><?= htmlspecialchars($tg['service_list']) ?></td>
                <td class="action-btns">
                  <a href="<?= BASE_URL ?>?action=edit&id=<?= $tg['id'] ?>" class="btn-edit">Sửa</a>
                  <a href="<?= BASE_URL ?>?action=delete&id=<?= $tg['id'] ?>" class="btn-delete">Xóa</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="text-center">Chưa có dữ liệu</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
