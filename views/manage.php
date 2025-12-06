<!DOCTYPE html>
< lang="vi">

  <head>
    <meta charset="UTF-8">
    <title>Quản lý Tour Du Lịch</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
      body {
        background-color: #f2f2f8;
        font-family: 'Poppins', sans-serif;
      }

      /* SIDEBAR */
      .sidebar {
        width: 85px;
        height: 100vh;
        background: #2a0436;
        position: fixed;
        top: 0;
        left: 0;
        border-right: 1px solid #3b064b;
        display: flex;
        flex-direction: column;
        padding-top: 15px;
        z-index: 200;
        transition: 0.3s;
        overflow: hidden;
      }

      .sidebar:hover {
        width: 220px;
        /* Mở rộng khi hover */
      }

      .sidebar a {
        color: #e8d8ff;
        text-decoration: none;
        font-size: 20px;
        padding: 12px 15px;
        border-radius: 12px;
        margin: 10px 10px;
        display: flex;
        align-items: center;
        gap: 12px;
        transition: 0.25s ease-in-out;
        white-space: nowrap;
      }

      .sidebar a i {
        font-size: 22px;
      }

      /* Hover */
      .sidebar a:hover {
        background: #5e0b8a;
        color: #fff;
      }

      /* ĐANG ACTIVE */
      .sidebar a.active {
        background: #8d15cc;
        color: #fff !important;
        box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
      }

      /* Khi sidebar thu nhỏ */
      .sidebar:not(:hover) span {
        opacity: 0;
        width: 0;
      }

      /* Khi mở rộng */
      .sidebar:hover span {
        opacity: 1;
        width: auto;
      }

      /* ĐANG ACTIVE */
      .sidebar a.active {
        background: #8d15cc;
        color: #fff !important;
        box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
      }

      /* TOPBAR */
      .topbar {
        position: fixed;
        left: 85px;
        right: 0;
        top: 0;
        height: 60px;
        background: #2a0436;
        border-bottom: 1px solid #3b064b;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0 20px;
        z-index: 100;
        color: white;
      }

      .search-bar input {
        border: none;
        background-color: #3c0a4d;
        padding: 8px 14px;
        border-radius: 20px;
        outline: none;
        width: 220px;
        color: white;
      }

      .top-icons i {
        font-size: 20px;
        color: #e8d8ff;
        margin-left: 20px;
        cursor: pointer;
      }

      .top-icons i:hover {
        color: #fff;
      }

      .content {
        margin-left: 105px;
        margin-top: 80px;
        padding: 20px;
      }

      .card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
      }
    </style>
  </head>

  <>

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
              <th>Giờ khởi hành</th>
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
                  <td><?= htmlspecialchars($tg['so_ngay']) ?> ngày <?= htmlspecialchars($tg['so_dem']) ?> đêm</td>
                  <td><?= htmlspecialchars($tg['departure_time']) ?></td>
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