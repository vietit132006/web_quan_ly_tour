<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$db   = "tour_management";
$user = "root";
$pass = "";

try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$db;charset=utf8",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    // ===== LẤY USER =====
    $users = $conn
        ->query("SELECT id, full_name FROM users")
        ->fetchAll(PDO::FETCH_ASSOC);

    // ===== LƯU =====
    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $sql = "INSERT INTO tour_guides (
            user_id, date_birth, avata_id, phone, history, evaluate,
            health, certificate, license_number, license_expiry,
            experience_years, language, classify, status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            $_POST['user_id'],
            $_POST['date_birth'] ?: null,
            $_POST['avata_id'],
            $_POST['phone'],
            $_POST['history'],
            $_POST['evaluate'],
            $_POST['health'],
            $_POST['certificate'],
            $_POST['license_number'],
            $_POST['license_expiry'] ?: null,
            $_POST['experience_years'] ?: 0,
            $_POST['language'],
            $_POST['classify'],
            $_POST['status']
        ]);

        header("Location: tourguide_view.php");
        exit;
    }
} catch (PDOException $e) {
    die("Lỗi SQL: " . $e->getMessage());
}
?>



<main class="ml-64 mt-16 p-8 bg-gray-50 min-h-screen">

    <div class="bg-white rounded shadow p-6 max-w-4xl">
        <h2 class="text-xl font-bold mb-4">
            ➕ Thêm mới Hướng dẫn viên
        </h2>

        <form method="POST" class="space-y-4">

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-medium">Tài khoản</label>
                    <select name="user_id" required class="w-full border rounded px-3 py-2">
                        <?php foreach ($users as $u): ?>
                            <option value="<?= $u['id'] ?>">
                                <?= htmlspecialchars($u['full_name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label class="font-medium">Avatar URL</label>
                    <input type="text" name="avata_id"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Ngày sinh</label>
                    <input type="date" name="date_birth"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>Số điện thoại</label>
                    <input type="text" name="phone"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Sức khỏe</label>
                    <input type="text" name="health"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>Bằng cấp</label>
                    <input type="text" name="certificate"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Ngôn ngữ</label>
                    <input type="text" name="language"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>Phân loại</label>
                    <select name="classify" class="w-full border rounded px-3 py-2">
                        <option value="Nội địa">Nội địa</option>
                        <option value="Quốc tế">Quốc tế</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Số GPHN</label>
                    <input type="text" name="license_number"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>Hạn GPHN</label>
                    <input type="date" name="license_expiry"
                        class="w-full border rounded px-3 py-2">
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4">
                <div>
                    <label>Kinh nghiệm (năm)</label>
                    <input type="number" name="experience_years"
                        class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label>Trạng thái</label>
                    <select name="status" class="w-full border rounded px-3 py-2">
                        <option value="1">Bật</option>
                        <option value="0">Tắt</option>
                    </select>
                </div>
            </div>

            <div>
                <label>Tiểu sử</label>
                <textarea name="history"
                    class="w-full border rounded px-3 py-2"
                    rows="3"></textarea>
            </div>

            <div>
                <label>Đánh giá</label>
                <textarea name="evaluate"
                    class="w-full border rounded px-3 py-2"
                    rows="2"></textarea>
            </div>

            <div class="flex gap-3">
                <button class="bg-green-600 text-white px-5 py-2 rounded">
                    💾 Lưu lại
                </button>
                <a href="tourguide_view.php"
                    class="px-5 py-2 border rounded">
                    Hủy
                </a>
            </div>

        </form>
    </div>

</main>