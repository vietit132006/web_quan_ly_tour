
<?php ob_start(); ?>
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
<?php $content = ob_get_clean(); ?>
<?php include __DIR__ . '/layout/master.php'; ?>