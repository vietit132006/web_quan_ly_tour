<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Thêm Người Dùng</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f9fdf8;
      font-family: 'Poppins', sans-serif;
    }

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

    .content {
      margin-left: 110px;
      margin-top: 80px;
      padding: 20px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
      border: none;
    }
  </style>
</head>

<body>

  <!-- Sidebar -->
  <div class="sidebar">
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
    <a href="index.php?action=nhacungcap" data-bs-toggle="tooltip" data-bs-placement="right" title="Nhà cung cấp"><i class="bi bi-graph-up"></i></a>
    <a href="index.php?action=users-roles" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>
  </div>

  <!-- Topbar -->
  <div class="topbar">
    <div class="search-bar">
      <input type="text" placeholder="Tìm kiếm...">
    </div>
    <div class="top-icons">
      <i class="bi bi-sun"></i>
      <i class="bi bi-bell"></i>
      <i class="bi bi-chat-dots"></i>
      <img src="https://i.pravatar.cc/40">
    </div>
  </div>

  <!-- Nội dung -->
  <div class="content">
    <div class="container">

      <h4 class="mb-4 fw-bold">Thêm Người Dùng Mới</h4>

      <!-- Card được căn giữa, không tràn, đẹp trên mọi màn hình -->
      <div class="card p-4 mx-auto" style="max-width: 700px;">

        <form action="index.php?action=users_store" method="POST" enctype="multipart/form-data">

          <div class="mb-3">
            <label class="fw-bold">Username:</label>
            <input type="text" name="username" required class="form-control" placeholder="Nhập username">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Họ và tên:</label>
            <input type="text" name="full_name" required class="form-control" placeholder="Nhập họ tên đầy đủ">
          </div>

          <div class="row">
            <div class="col-md-6 mb-3">
              <label class="fw-bold">Email:</label>
              <input type="email" name="email" class="form-control" placeholder="Nhập email">
            </div>
            <div class="col-md-6 mb-3">
              <label class="fw-bold">Số điện thoại:</label>
              <input type="text" name="phone" class="form-control" placeholder="Nhập số điện thoại">
            </div>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Vai trò (Role):</label>
            <select name="role_id" class="form-select">
              <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Trạng thái:</label>
            <select name="status" class="form-select">
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Ảnh đại diện (Avatar):</label>
            <input type="text" name="avatar" class="form-control">
          </div>

          <button type="submit" class="btn btn-success px-4">
            <i class="bi bi-check-circle"></i> Thêm người dùng
          </button>

        </form>
      </div>

    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>

</body>

</html>