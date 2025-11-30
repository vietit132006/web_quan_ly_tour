<?php
// $view là đường dẫn của file nội dung trang
// vd: booking/index.php hoặc users/list.php
?>

<?php include "views/layout/header.php"; ?>
<?php include "views/layout/sidebar.php"; ?>
<?php include "views/layout/topbar.php"; ?>

<div class="content">
    <?php include "views/" . $view; ?>
</div>

<?php include "views/layout/footer.php"; ?>