<?php $current = $_GET['action'] ?? '/'; ?>

<div class="sidebar">
  <a href="#"><i class="bi bi-list"></i><span>Menu</span></a>

  <a href="index.php?action=/"
     class="<?= $current == '/' ? 'active' : '' ?>">
    <i class="bi bi-house-door"></i><span>Trang chủ</span>
  </a>

  <a href="index.php?action=manage"
     class="<?= $current == 'manage' ? 'active' : '' ?>">
    <i class="bi bi-calendar-check"></i><span>Quản lý Tour</span>
  </a>

  <a href="index.php?action=manage"
     class="<?= $current == 'manage' ? 'active' : '' ?>">
    <i class="bi bi-calendar-check"></i><span>Quản lý Lịch Trình Tour</span>
  </a>

  <a href="index.php?action=nhacungcap"
     class="<?= $current == 'nhacungcap' ? 'active' : '' ?>">
    <i class="bi bi-building"></i><span>Nhà cung cấp</span>
  </a>

  <a href="index.php?action=users"
     class="<?= $current == 'users' ? 'active' : '' ?>">
    <i class="bi bi-people"></i><span>Tài khoản</span>
  </a>
</div>
