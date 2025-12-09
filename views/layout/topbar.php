<div class="topbar">
  <div class="search-bar">
    <input type="text" placeholder="Tìm kiếm..."
           class="form-control">
  </div>

  <div class="d-flex align-items-center gap-3">
    <i class="bi bi-sun"></i>
    <i class="bi bi-bell"></i>

    <div class="dropdown">
      <?php if (empty($_SESSION["user"])): ?>
        <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
             class="rounded-circle"
             style="width:40px; cursor:pointer;"
             data-bs-toggle="dropdown">

        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="index.php?action=login_form">
              Đăng nhập
            </a>
          </li>
        </ul>
      <?php else: ?>
        <img src="<?= htmlspecialchars($_SESSION['user']['avatar'] ?? 'https://i.pravatar.cc/40') ?>"
             class="rounded-circle"
             style="width:40px; cursor:pointer;"
             data-bs-toggle="dropdown">

        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="index.php?action=logout">
              Đăng xuất
            </a>
          </li>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>
