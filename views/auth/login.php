<?php session_start(); ?>

<h2>Đăng nhập hệ thống</h2>

<?php if (!empty($_SESSION['error'])): ?>
    <p style="color:red"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
<?php endif; ?>

<form action="index.php?action=login" method="POST">
    <label>Username:</label><br>
    <input type="text" name="username"><br><br>

    <label>Password:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Đăng nhập</button>
</form>
