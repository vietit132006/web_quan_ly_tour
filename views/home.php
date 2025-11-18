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
    }

    .badge-plus {
      background-color: #00bfa5;
    }

    /* Thêm kiểu cho bảng tour */
    .table thead th {
      background-color: #e9ecef;
    }
  </style>
</head>

<body>

  <div class="sidebar">
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Báo cáo"><i class="bi bi-graph-up"></i></a>
    <a href="index.php?action=users-roles" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>
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
              <th>ID Danh mục Tour</th>
            </tr>
          </thead>
          <tbody>
            <?php
          
            // **Kiểm tra xem biến $tours đã được truyền từ Controller chưa**
            if (isset($tours) && is_array($tours)) {
                foreach ($tours as $tour) {
                    // Dữ liệu từ CSDL là mảng kết hợp (key là tên cột)
                    $status_badge = ($tour['status'] == 1) ? "<span class='badge bg-success'>Hoạt động</span>" : "<span class='badge bg-warning text-dark'>Tạm dừng</span>";
                    
                    echo "<tr>
                            <td><a href='edit.php?id={$tour['id']}' class='text-primary' title='Sửa'><i class='bi bi-pencil-square'></i></a></td> 
                            <td>{$tour['id']}</td>
                            <td class='fw-bold'>{$tour['name']}</td>
                            <td>" . number_format($tour['base_price'], 0, ',', '.') . " đ</td>
                            <td>{$tour['duration']} Ngày</td>
                            <td>" . (strlen($tour['description']) > 50 ? substr($tour['description'], 0, 50) . "..." : $tour['description']) . "</td>
                            <td>{$status_badge}</td>
                            <td class='small text-muted'>{$tour['created_at']}</td>
                            <td>{$tour['tour_category_id']}</td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='9' class='text-center text-danger'>Không tìm thấy dữ liệu tour. Vui lòng kiểm tra Model/Controller.</td></tr>";
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
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
      })
  </script>

</body>

</html>