<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập hệ thống</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: url('https://up.yimg.com/ib/th/id/OIP.9xSjn2fiIyky21jwOcqDeQHaE8?pid=Api&rs=1&c=1&qlt=95&w=150&h=100') no-repeat center/cover;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Lớp phủ làm tối ảnh */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.55);
            z-index: 1;
        }

        /* Form nổi lên trên */
        .login-box {
            position: relative;
            z-index: 2;
            width: 380px;
            background: rgba(255, 255, 255, 0.12);
            border: 1px solid rgba(255,255,255,0.25);
            backdrop-filter: blur(12px);
            border-radius: 18px;
            padding: 35px 30px;
            color: #fff;
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
        }

        .login-box label {
            font-size: 14px;
            opacity: 0.85;
        }

        .login-box input {
            width: 100%;
            padding: 12px 14px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 10px;
            border: none;
            outline: none;
            font-size: 15px;
            background: rgba(255,255,255,0.2);
            color: #fff;
        }

        .login-box input::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .login-box button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: #8d15cc;
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
        }

        .login-box button:hover {
            background: #a81df5;
        }

        .error {
            background: rgba(255, 0, 0, 0.2);
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>Đăng nhập hệ thống</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="error">
            <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="index.php?action=login" method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Nhập tên đăng nhập" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Nhập mật khẩu" required>

        <button type="submit">Đăng nhập</button>
    </form>
</div>

</body>
</html>
