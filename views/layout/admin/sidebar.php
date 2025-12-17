<?php
$currentAction = $_GET['action'] ?? 'home';
$listActions = [
  ['label' => 'Tổng Quan', 'action' => ['home', '/'], 'icon' => 'bi-speedometer2'],
  ['label' => 'Quản Lý Tour', 'action' => ['tours'], 'icon' => 'bi-card-list'],
  ['label' => 'Đặt Tour', 'action' => ['booking'], 'icon' => 'bi-calendar-check'],
  // ['label' => 'Lịch trình tour', 'action' => ['manage'], 'icon' => 'bi-bookmark-check-fill'],
  ['label' => 'Quản lý người dùng', 'action' => ['roles_users'], 'icon' => 'bi-person-lines-fill'],
  ['label' => 'Đối tác', 'action' => ['nhacungcap'], 'icon' => 'bi-people']
];
?>

<aside class="fixed top-16 left-0 bottom-0 w-64 bg-white shadow-lg overflow-y-auto">
  <h1 class="fs-3 fw-bold text-center">Quản Trị Viên</h1>

  <nav class="p-4 space-y-2">

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