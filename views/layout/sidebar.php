<?php
$currentAction = $_GET['action'] ?? 'home';
$listActions = [
  ['label' => 'Tổng Quan', 'action' => ['home', '/'], 'icon' => 'bi-speedometer2'],
  ['label' => 'Quản Lý Tour', 'action' => ['tours'], 'icon' => 'bi-card-list'],
  ['label' => 'Đặt Tour', 'action' => ['booking'], 'icon' => 'bi-calendar-check'],
  ['label' => 'Lịch trình tour', 'action' => ['manage'], 'icon' => 'bi-bookmark-check-fill'],
  ['label' => 'Quản lý người dùng', 'action' => ['roles_users'], 'icon' => 'bi-person-lines-fill']
];
?>

<aside class="fixed top-16 left-0 bottom-0 w-64 bg-white shadow-lg overflow-y-auto">
  <nav class="p-4 space-y-2">

<<<<<<< HEAD
  <a href="index.php?action=/"
     class="<?= $current == '/' ? 'active' : '' ?>">
    <i class="bi bi-house-door"></i><span>ADMIN-_-</span>
  </a>

  <a href="index.php?action=#"
     class="<?= $current == '#' ? 'active' : '' ?>">
    <i class="bi bi-list-columns"></i><span>Quản lý Tour</span>
  </a>

   <a href="index.php?action=booking"
     class="<?= $current == 'booking' ? 'active' : '' ?>">
    <i class="bi bi-bookmark-check-fill"></i><span>Quản lý Booking</span>
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
=======
    <?php foreach ($listActions as $item): ?>
      <?php $isActive = in_array($currentAction, $item['action']); ?>
      <a href="index.php?action=<?= $item['action'][0] ?>"
        class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
        <?= $isActive
          ? 'active text-cyan-600 bg-cyan-50'
          : 'text-gray-700 hover:bg-gray-100' ?>">
        <i class="bi <?= $item['icon'] ?> text-lg"></i>
        <span class="font-medium"><?= $item['label'] ?></span>
      </a>
    <?php endforeach; ?>
  </nav>
</aside>
>>>>>>> master
