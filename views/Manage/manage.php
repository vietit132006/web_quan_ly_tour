<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Quản lý lịch trình tour</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/manage.css">
</head>
<style>
  /* RESET NHẸ */
  * {
    box-sizing: border-box;
  }

  /* BODY */
  body {
    background-color: #f9fdf8;
    font-family: 'Poppins', sans-serif;
  }

  /* ========== SIDEBAR ========== */
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
    transition: width 0.3s ease;
    overflow: hidden;
  }

  .sidebar:hover {
    width: 220px;
  }

  .sidebar a {
    color: #e8d8ff;
    text-decoration: none;
    font-size: 18px;
    padding: 12px 15px;
    border-radius: 12px;
    margin: 6px 10px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: 0.25s;
    white-space: nowrap;
  }

  .sidebar a i {
    font-size: 22px;
  }

  .sidebar a:hover {
    background: #5e0b8a;
    color: #fff;
  }

  .sidebar a.active {
    background: #8d15cc;
    color: #fff;
    box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
  }

  /* Ẩn text khi thu gọn */
  .sidebar:not(:hover) span {
    opacity: 0;
    width: 0;
  }

  /* ========== TOPBAR ========== */
  .topbar {
    position: fixed;
    top: 0;
    left: 85px;
    right: 0;
    height: 60px;
    background: #2a0436;
    border-bottom: 1px solid #3b064b;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 150;
    transition: left 0.3s;
  }

  /* Khi sidebar mở */
  .sidebar:hover~.topbar {
    left: 220px;
  }

  .search-bar input {
    background-color: #3c0a4d;
    border: none;
    padding: 8px 14px;
    border-radius: 20px;
    outline: none;
    width: 220px;
    color: #fff;
  }

  .top-icons i {
    font-size: 20px;
    color: #e8d8ff;
    margin-left: 18px;
    cursor: pointer;
  }

  .top-icons i:hover {
    color: #fff;
  }

  /* ========== CONTENT ========== */
  .content {
    margin-left: 100px;
    margin-top: 80px;
    padding: 20px;
    transition: margin-left 0.3s;
  }

  .sidebar:hover~.content {
    margin-left: 235px;
  }

  /* ========== TABLE ========== */
  .table thead th {
    background-color: #ececec;
    font-weight: 600;
  }

  /* ========== BUTTON ACTION ========== */
  .action-btns a {
    margin-right: 8px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
  }

  .btn-edit {
    color: #0d6efd;
  }

  .btn-delete {
    color: #dc3545;
  }

  /* ========== FORM MODAL ========== */
  .form-container {
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
  }

  /* GRID FORM */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  /* FULL WIDTH */
  .form-group.full {
    grid-column: 1 / -1;
  }

  /* LABEL */
  .form-group label {
    font-weight: 500;
    font-size: 14px;
    margin-bottom: 6px;
  }

  /* INPUT / SELECT (OVERRIDE BOOTSTRAP) */
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #dce4ec;
    outline: none;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #5dade2;
    box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.15);
  }

  /* DAY DISPLAY */
  .day-display {
    grid-column: 1 / -1;
    font-weight: 600;
    margin: 8px 0;
  }

  /* SUBMIT BUTTON */
  .submit-button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background: #5dade2;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
  }

  .submit-button:hover {
    background: #3498db;
  }

  /* RESPONSIVE */
  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
    }
  }
</style>

<body>
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

  <!-- CONTENT -->
  <div class="content">
    <h3>Lịch trình tour</h3>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
      Thêm mới
    </button>
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
                  <a href="<?= BASE_URL ?>?action=manage-edit&id=<?= $tg['id'] ?>"
                    class="btn-edit">
                    Sửa
                  </a>


                  <a href="<?= BASE_URL ?>?action=manage-delete&id=<?= $tg['id'] ?>" class="btn-delete"
                    onclick="return confirm('Bạn có chắc muốn xóa lịch trình tour này không?')">Xóa</a>


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


  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Thêm lịch trình mới</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div>
            <form id="tourForm" action="?action=manage-store" method="POST">
              <div>

                <!-- Chọn Tour -->
                <div class="form-group">
                  <label>Tour</label>
                  <select name="tour_id" id="tour_id">
                    <option value="">-- Chọn Tour --</option>
                    <?php if (!empty($tours)): ?>
                      <?php foreach ($tours as $tour): ?>
                        <option value="<?= $tour['id'] ?>"><?= $tour['name'] ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <!-- Ngày bắt đầu -->
                <div class="form-group">
                  <label for="start_date">Ngày bắt đầu</label>
                  <input type="date" id="start_date" name="start_date">
                </div>

                <!-- Ngày kết thúc -->
                <div class="form-group">
                  <label for="end_date">Ngày kết thúc</label>
                  <input type="date" id="end_date" name="end_date">
                </div>

                <div class="day-display">
                  <span id="so_ngay">0</span> ngày <span id="so_dem">0</span> đêm
                </div>

                <!-- Số khách -->
                <div class="form-group">
                  <label for="number_guests">Số khách</label>
                  <input type="number" id="number_guests" name="number_guests" min="1" placeholder="0">
                </div>

                <input type="hidden" id="total_days" name="total_days">

                <!-- Hướng dẫn viên -->
                <div class="form-group">
                  <label>Hướng dẫn viên</label>
                  <select name="guide_id" id="guide_id">
                    <option value="">-- Chọn HDV --</option>
                    <?php if (!empty($guides)): ?>
                      <?php foreach ($guides as $guide): ?>
                        <option value="<?= $guide['guide_id'] ?>"><?= $guide['full_name'] ?></option>
                      <?php endforeach; ?>
                    <?php endif; ?>
                  </select>
                </div>

                <!-- Giờ khởi hành -->
                <div class="form-group">
                  <label for="departure_time">Giờ khởi hành</label>
                  <input type="time" id="departure_time" name="departure_time">
                </div>

                <!-- Dịch vụ -->
                <div class="form-group">
                  <label>Dịch vụ</label>
                  <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                      <label style="display:block; margin-bottom:5px;">
                        <input type="checkbox" name="services[]" value="<?= htmlspecialchars($service['id'] ?? '') ?>">
                        <?= htmlspecialchars($service['name'] ?? '') ?>
                      </label>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </div>

              </div>
              <button type="submit" class="submit-button">Thêm</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="scripts/manage.js"></script>
</body>

</html>