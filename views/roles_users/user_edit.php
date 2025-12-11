<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Sửa Người Dùng</title>

  <!-- Bootstrap + Icons -->
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
      background: #fff;
      position: fixed;
      border-right: 1px solid #eee;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding-top: 10px;
      z-index: 200;
    }

    .sidebar a {
      color: #666;
      font-size: 20px;
      margin: 20px 0;
      transition: .3s;
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
      background: #fff;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 150;
    }

    .search-bar input {
      background: #f2f6f4;
      border: none;
      padding: 6px 12px;
      border-radius: 20px;
      width: 220px;
    }

    .content {
      margin-left: 100px;
      margin-top: 80px;
      padding: 20px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, .05);
      border: none;
    }
  </style>
</head>

<body>
  <!-- MAIN CONTENT -->
  <div class="content">
    <div class="container-fluid">

      <h4 class="fw-bold mb-4">Sửa Người Dùng</h4>

      <div class="card p-4">

        <form action="index.php?action=users_update" method="POST" enctype="multipart/form-data">

          <input type="hidden" name="id" value="<?= $user['id'] ?>">

          <div class="mb-3">
            <label class="fw-bold">Tên đăng nhập:</label>
            <input type="text" name="username" class="form-control" value="<?= $user['username'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Họ và tên:</label>
            <input type="text" name="full_name" class="form-control" value="<?= $user['full_name'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Email:</label>
            <input type="email" name="email" class="form-control" value="<?= $user['email'] ?>" required>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Số điện thoại:</label>
            <input type="text" name="phone" class="form-control" value="<?= $user['phone'] ?>">
          </div>

          <div class="mb-3">
            <label class="fw-bold">Vai trò (Role):</label>
            <select name="role_id" class="form-select">
              <?php foreach ($roles as $r): ?>
                <option value="<?= $r['id'] ?>" <?= $user['role_id'] == $r['id'] ? 'selected' : '' ?>>
                  <?= $r['name'] ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Trạng thái:</label>
            <select name="status" class="form-select">
              <option value="1" <?= $user['status'] == 1 ? 'selected' : '' ?>>Hoạt động</option>
              <option value="0" <?= $user['status'] == 0 ? 'selected' : '' ?>>Khóa</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="fw-bold">Avatar hiện tại:</label><br>

            <?php if (!empty($user['avatar'])): ?>
              <img src="uploads/<?= $user['avatar'] ?>" width="90" class="rounded border mb-2">
            <?php else: ?>
              <p class="text-muted">Không có ảnh</p>
            <?php endif; ?>

            <input type="text" name="avatar" class="form-control mt-2">
          </div>

          <div class="mt-4">
            <button type="submit" class="btn btn-success px-4">Cập nhật</button>
            <a href="index.php?action=roles_users" class="btn btn-secondary px-4">Quay lại</a>
          </div>

        </form>

      </div>

    </div>
  </div>

</body>

</html>