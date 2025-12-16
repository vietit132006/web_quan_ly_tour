<?php ob_start(); ?>
<div class="content">
  <h4>Bảng Điều Khiển Tour</h4>
  <!-- Nội dung dashboard -->
</div>
<?php $content = ob_get_clean(); ?>
<style>
  /* =====================================================
   GLOBAL RESET & VARIABLES
===================================================== */
  :root {
    --primary: #2563eb;
    --success: #16a34a;
    --danger: #dc2626;
    --warning: #f59e0b;
    --info: #0ea5e9;

    --bg-main: #f3f4f6;
    --bg-card: #ffffff;

    --text-main: #1f2937;
    --text-muted: #6b7280;

    --radius-sm: 8px;
    --radius-md: 12px;
    --radius-lg: 16px;

    --shadow-sm: 0 2px 6px rgba(0, 0, 0, 0.06);
    --shadow-md: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  * {
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    background-color: var(--bg-main);
    color: var(--text-main);
    margin: 0;
    padding: 0;
  }

  /* =====================================================
   TYPOGRAPHY
===================================================== */
  h4 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }

  h5 {
    font-size: 1.2rem;
    font-weight: 600;
  }

  h6 {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-muted);
  }

  /* =====================================================
   CARD COMPONENT
===================================================== */
  .card {
    background-color: var(--bg-card);
    border-radius: var(--radius-md);
    box-shadow: var(--shadow-sm);
    border: none;
    transition: all 0.25s ease;
  }

  .card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }

  /* =====================================================
   STATS CARDS
===================================================== */
  .card h3 {
    font-size: 1.6rem;
    margin-top: 0.25rem;
  }

  .text-success {
    color: var(--success) !important;
  }

  .text-primary {
    color: var(--primary) !important;
  }

  .text-info {
    color: var(--info) !important;
  }

  /* =====================================================
   BADGES
===================================================== */
  .badge {
    display: inline-block;
    padding: 0.35rem 0.7rem;
    font-size: 0.7rem;
    font-weight: 600;
    border-radius: 999px;
    letter-spacing: 0.04em;
  }

  .badge.bg-success {
    background-color: var(--success) !important;
    color: #fff;
  }

  .badge.bg-danger {
    background-color: var(--danger) !important;
    color: #fff;
  }

  /* Hotel type badges */
  .badge-lux {
    background: linear-gradient(135deg, #7c3aed, #a855f7);
    color: #fff;
  }

  .badge-pent {
    background: linear-gradient(135deg, #f59e0b, #fbbf24);
    color: #fff;
  }

  .badge-plus {
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    color: #fff;
  }

  /* =====================================================
   TABLE STYLE
===================================================== */
  .table {
    background-color: var(--bg-card);
    border-radius: var(--radius-md);
    overflow: hidden;
  }

  .table thead {
    background-color: #e5e7eb;
  }

  .table th {
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    color: #374151;
    border-bottom: none;
  }

  .table td {
    font-size: 0.85rem;
    vertical-align: middle;
    border-top: 1px solid #f1f5f9;
  }

  .table tbody tr {
    transition: background 0.2s ease;
  }

  .table tbody tr:hover {
    background-color: #f8fafc;
  }

  .table a {
    text-decoration: none;
  }

  .table a i {
    font-size: 1.1rem;
  }

  /* =====================================================
   HOTEL CARDS
===================================================== */
  .hotel-card {
    padding: 0.5rem;
  }

  .hotel-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
    border-radius: var(--radius-md);
  }

  .hotel-card h6 {
    font-size: 1rem;
    margin: 0.5rem 0 0.25rem;
  }

  .hotel-card p {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-bottom: 0.5rem;
  }

  .hotel-card .fw-bold {
    font-size: 0.9rem;
  }

  .hotel-card .text-warning {
    font-size: 0.85rem;
  }

  /* =====================================================
   ICONS & LINKS
===================================================== */
  .bi {
    vertical-align: middle;
  }

  .text-warning {
    color: var(--warning) !important;
  }

  /* =====================================================
   RESPONSIVE
===================================================== */
  @media (max-width: 992px) {
    h4 {
      font-size: 1.3rem;
    }

    .card h3 {
      font-size: 1.4rem;
    }
  }

  @media (max-width: 768px) {
    .row.text-center.mb-4 .col-md-4 {
      margin-bottom: 1rem;
    }

    .hotel-card img {
      height: 140px;
    }
  }
</style>

<!-- Google Font: Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Dashboard Custom CSS -->
<link rel="stylesheet" href="<?= BASE_URL ?>assets/css/dashboard.css">

<!-- Stats cards -->
<div class="row text-center mb-4">
  <div class="col-md-4">
    <div class="card p-3">
      <h6>Tổng Lợi Nhuận</h6>
      <h3 class="fw-bold text-success">52,329,000 đ</h3>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3">
      <h6>Tổng Doanh Thu</h6>
      <h3 class="fw-bold text-primary">78,200,000 đ</h3>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card p-3">
      <h6>Tổng Khách Hàng</h6>
      <h3 class="fw-bold text-info">22,500</h3>
    </div>
  </div>
</div>

<!-- Tour Table -->
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
      <?php if (isset($tours) && is_array($tours)): ?>
        <?php foreach ($tours as $tour): ?>
          <?php
          $status_badge = ($tour['status'] == 1) ? "<span class='badge bg-success'>Hoạt động</span>" : "<span class='badge bg-danger'>Tạm dừng</span>";
          $desc = $tour['description'] ?? '';
          $short_desc = strlen($desc) > 50 ? substr($desc, 0, 50) . '...' : $desc;
          $category_name = ($tour['tour_category_id'] == 1) ? 'Trong nước' : 'Nước ngoài';
          ?>
          <tr>
            <td><a href='edit.php?id=<?= $tour['id'] ?>' class='text-primary'><i class='bi bi-pencil-square'></i></a></td>
            <td><?= $tour['id'] ?></td>
            <td class='fw-bold'><?= $tour['name'] ?></td>
            <td><?= number_format($tour['base_price'], 0, ',', '.') ?> đ</td>
            <td><?= $tour['duration'] ?> Ngày</td>
            <td><?= $short_desc ?></td>
            <td><?= $status_badge ?></td>
            <td class='small text-muted'><?= $tour['created_at'] ?></td>
            <td><?= $category_name ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="9" class="text-center text-danger">Không tìm thấy dữ liệu tour.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Top Hotels -->
<h4 class="mb-3 fw-bold">Khách sạn Hàng đầu</h4>
<div class="row">
  <?php
  $hotels = [
    ["Khách sạn Billas", "https://picsum.photos/300/160?random=1", "LUXURY", "620,000 đ/ngày", "4.8", "2 Giường | 3 Người lớn"],
    ["Khách sạn Taj", "https://picsum.photos/300/160?random=2", "LUXURY", "780,000 đ/ngày", "4.6", "2 Giường | 2 Người lớn"],
    ["Khách sạn Phượng Hoàng", "https://picsum.photos/300/160?random=3", "PENTHOUSE", "1,020,000 đ/ngày", "4.2", "3 Giường | 6 Người lớn"],
    ["Khách sạn Elite", "https://picsum.photos/300/160?random=4", "PLUS", "920,000 đ/ngày", "4.1", "1 Giường | 2 Người lớn"]
  ];
  foreach ($hotels as $h):
    $badgeClass = strtolower($h[2]) == 'luxury' ? 'badge-lux' : (strtolower($h[2]) == 'penthouse' ? 'badge-pent' : 'badge-plus');
  ?>
    <div class="col-md-3 mb-4">
      <div class="card p-2 hotel-card">
        <img src="<?= $h[1] ?>" alt="<?= $h[0] ?>">
        <div class="p-2">
          <h6 class="fw-bold"><?= $h[0] ?></h6>
          <span class="badge <?= $badgeClass ?>"><?= strtoupper($h[2]) ?></span>
          <p class="small mt-2 text-muted"><?= $h[5] ?></p>
          <div class="d-flex justify-content-between">
            <span class="fw-bold"><?= $h[3] ?></span>
            <span class="text-warning">★ <?= $h[4] ?></span>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>
</div>