<?php include __DIR__ . '/header.php'; ?>
<?php include __DIR__ . '/topbar.php'; ?>
<?php include __DIR__ . '/sidebar.php'; ?>
<?php if (!empty($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error'] ?>
  </div>
  <?php unset($_SESSION['error']); ?>
<?php endif; ?>


<main class="ml-64 mt-16 p-8 bg-gray-50 min-h-screen">
  <?php
  // an toàn: chỉ include nếu $view tồn tại và file thực sự tồn tại
  if (!empty($view) && is_string($view) && file_exists($view)) {
    include $view;
  } else {
    // fallback: thông báo debug (bỏ hoặc tùy chỉnh khi production)
    echo '<div class="p-6 bg-white rounded shadow">';
    echo '<h2 class="text-xl font-semibold mb-2">Trang chưa được cấu hình</h2>';
    echo '<p class="text-sm text-gray-600">Biến <code>$view</code> chưa được gán hoặc file không tồn tại.</p>';
    echo '</div>';
  }
  ?>
</main>

<?php include __DIR__ . '/footer_script.php'; ?>