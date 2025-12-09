<?php
$current = $_GET['action'] ?? '/';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <?php include __DIR__ . '/header.php'; ?>
</head>
<body>

<?php include __DIR__ . '/sidebar.php'; ?>
<?php include __DIR__ . '/topbar.php'; ?>

<div class="content">
  <?= $content ?? '' ?>
</div>

<?php include __DIR__ . '/footer.php'; ?>
</body>
</html>
