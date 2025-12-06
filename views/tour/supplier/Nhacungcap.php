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

        <div class="container mt-4">
            <h3 class="mb-3">Danh Sách Nhà Cung Cấp</h3>
            <a href="index.php?action=nhacungcap_add">thêm nhà cung cấp</a>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Người liên hệ</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số hợp đồng</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Đánh giá</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['type'] ?></td>
                                <td><?= $item['contact_person'] ?></td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?= $item['contract_number'] ?></td>
                                <td><?= $item['contract_start'] ?></td>
                                <td><?= $item['contract_end'] ?></td>
                                <td><?= $item['rating'] ?></td>
                                <td><?= $item['note'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td>
                                    <a href="index.php?action=nhacungcap_edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?action=nhacungcap_delete&id=<?= $item['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete role ID: <?= $item['id'] ?>?');" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="13" class="text-center">Không có dữ liệu nhà cung cấp.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>