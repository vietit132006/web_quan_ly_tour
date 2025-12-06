<?php $current = $_GET['action'] ?? '/'; ?>
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

    <!-- CONTENT -->
    <div class="content">
      <div class="container-fluid">
        <h4 class="mb-4 fw-bold">Bảng Điều Khiển Tour</h4>
        <div class="row text-center mb-4">
          <div class="col-md-4">
            <div class="card p-3">
              <h6 class="text-muted">Tổng Lợi Nhuận</h6>
              <h3 class="fw-bold text-success">52,329,000 đ</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <h6 class="text-muted">Tổng Doanh Thu</h6>
              <h3 class="fw-bold text-primary">78,200,000 đ</h3>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card p-3">
              <h6 class="text-muted">Tổng Khách Hàng</h6>
              <h3 class="fw-bold text-info">22,500</h3>
            </div>
          </div>
        </div>

        <div class="card p-3 mb-4">
          <h5 class="mb-3 fw-bold">Danh Sách Tour Đã Tạo</h5>
          <table class="table align-middle table-hover">
            <thead>
              <tr>
                <th></th>
                <th>ID</th>
                <th>Tên Tour</th>
                <th>Giá cơ bản</th>
                <th>Thời lượng</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Ngày tạo</th>
                <th>Danh mục Tour</th>
              </tr>
            </thead>
            <tbody>
              <?php

              // **Kiểm tra xem biến $tours đã được truyền từ Controller chưa**
              if (isset($tours) && is_array($tours)) {
                foreach ($tours as $tour) {

                  // Badge trạng thái
                  $status_badge = ($tour['status'] == 1)
                    ? "<span class='badge bg-success'>Hoạt động</span>"
                    : "<span class='badge bg-danger text-white'>Tạm dừng</span>";

                  // Mô tả rút gọn
                  $desc = $tour['description'] ?? '';
                  $short_desc = strlen($desc) > 50 ? substr($desc, 0, 50) . "..." : $desc;

                  // Category name
                  $category_name = ($tour['tour_category_id'] == 1) ? "Trong nước" : "Nước ngoài";

                  echo "<tr>
                <td><a href='edit.php?id={$tour['id']}' class='text-primary' title='Sửa'>
                    <i class='bi bi-pencil-square'></i></a>
                </td>
                <td>{$tour['id']}</td>
                <td class='fw-bold'>{$tour['name']}</td>
                <td>" . number_format($tour['base_price'], 0, ',', '.') . " đ</td>
                <td>{$tour['duration']} Ngày</td>
                <td>{$short_desc}</td>
                <td>{$status_badge}</td>
                <td class='small text-muted'>{$tour['created_at']}</td>
                <td>{$category_name}</td>
            </tr>";
                }
              } else {
                echo "<tr><td colspan='9' class='text-center text-danger'>
            Không tìm thấy dữ liệu tour. Vui lòng kiểm tra Model/Controller.
          </td></tr>";
              }

              ?>
            </tbody>
          </table>
        </div>

        <h4 class="mb-3 fw-bold">Khách sạn Hàng đầu</h4>
        <div class="row">
          <?php
          $hotels = [
            ["Khách sạn Billas", "https://picsum.photos/300/160?random=1", "LUXURY", "620,000 đ/ngày", "4.8", "2 Giường | 3 Người lớn"],
            ["Khách sạn Taj", "https://picsum.photos/300/160?random=2", "LUXURY", "780,000 đ/ngày", "4.6", "2 Giường | 2 Người lớn"],
            ["Khách sạn Phượng Hoàng", "https://picsum.photos/300/160?random=3", "PENTHOUSE", "1,020,000 đ/ngày", "4.2", "3 Giường | 6 Người lớn"],
            ["Khách sạn Elite", "https://picsum.photos/300/160?random=4", "PLUS", "920,000 đ/ngày", "4.1", "1 Giường | 2 Người lớn"],
          ];
          foreach ($hotels as $h) {
            // Điều chỉnh logic cho lớp badge tiếng Việt
            $badgeClass = strtolower($h[2]) == 'luxury' ? 'badge-lux' : (strtolower($h[2]) == 'penthouse' ? 'badge-pent' : 'badge-plus');
            echo "
          <div class='col-md-3 mb-4'>
            <div class='card p-2 hotel-card'>
              <img src='{$h[1]}' alt='{$h[0]}'>
              <div class='p-2'>
                <h6 class='fw-bold'>{$h[0]}</h6>
                <span class='badge $badgeClass'>" . strtoupper($h[2]) . "</span>
                <p class='small mt-2 text-muted'>{$h[5]}</p>
                <div class='d-flex justify-content-between'>
                  <span class='fw-bold'>{$h[3]}</span>
                  <span class='text-warning'>★ {$h[4]}</span>
                </div>
              </div>
            </div>
          </div>";
          }
          ?>
        </div>
      </div>




    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      // Kích hoạt Tooltips của Bootstrap
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
      var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
      })
    </script>

    </body>

    </html>