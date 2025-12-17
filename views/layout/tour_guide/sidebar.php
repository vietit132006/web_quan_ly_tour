<?php
$currentAction = $_GET['action'] ?? 'home';
$listActions = [
  ['label' => 'Lịch làm việc', 'action' => ['calendar'], 'icon' => 'bi-calendar-check'],
];
?>

<aside class="fixed top-16 left-0 bottom-0 w-64 bg-white shadow-lg overflow-y-auto">
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