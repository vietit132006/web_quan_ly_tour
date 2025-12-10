<?php
$currentAction = $_GET['action'] ?? 'home';
?>

<aside class="fixed top-16 left-0 bottom-0 w-64 bg-white shadow-lg overflow-y-auto">
  <nav class="p-4 space-y-2">

    <!-- Tổng quan -->
    <a href="index.php?action=home"
      class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
   <?= in_array($currentAction, ['home', '/'])
      ? 'active text-cyan-600 bg-cyan-50'
      : 'text-gray-700 hover:bg-gray-100' ?>">
      <i class="bi bi-speedometer2 text-lg"></i>
      <span class="font-medium">Tổng Quan</span>


      <!-- Quản lý tour -->
      <a href="index.php?action=tours"
        class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
   <?= $currentAction === 'tours'
      ? 'active text-cyan-600 bg-cyan-50'
      : 'text-gray-700 hover:bg-gray-100' ?>">
        <i class="bi bi-card-list text-lg"></i>
        <span class="font-medium">Quản Lý Tour</span>

        <!-- Đặt tour -->
        <a href="index.php?action=booking"
          class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
   <?= str_starts_with($currentAction, 'booking')
      ? 'active text-cyan-600 bg-cyan-50'
      : 'text-gray-700 hover:bg-gray-100' ?>">
          <i class="bi bi-calendar-check text-lg"></i>
          <span class="font-medium">Đặt Tour</span>

          <!-- Khách hàng -->
          <a href="index.php?action=manage"
            class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
   <?= $currentAction === 'manage'
      ? 'active text-cyan-600 bg-cyan-50'
      : 'text-gray-700 hover:bg-gray-100' ?>">
            <i class="bi bi-bookmark-check-fill"></i>
            <span class="font-medium">Lịch trình tour</span>

            <!-- Người dùng -->
            <a href="index.php?action=users"
              class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg
   <?= $currentAction === 'users'
      ? 'active text-cyan-600 bg-cyan-50'
      : 'text-gray-700 hover:bg-gray-100' ?>">
              <i class="bi bi-person-lines-fill"></i>
              <span class="font-medium">Quản lý người dùng</span>

              <!-- Báo cáo -->
              <a href="#reports" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="bi bi-bar-chart-line text-lg"></i>
                <span class="font-medium">Báo Cáo</span>
              </a>

              <div class="border-t border-gray-200 my-4"></div>

              <!-- Cài đặt -->
              <a href="#settings" class="sidebar-link flex items-center space-x-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-gray-100">
                <i class="bi bi-gear text-lg"></i>
                <span class="font-medium">Cài Đặt</span>
              </a>

  </nav>
</aside>