<?php
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

    // XÓA HƯỚNG DẪN VIÊN
    if (isset($_GET['del'])) {
        $stmt = $conn->prepare("DELETE FROM tour_guides WHERE id = ?");
        $stmt->execute([$_GET['del']]);

        // quay lại danh sách (qua index.php)
        header("Location: index.php");
        exit();
    }

    // LẤY DANH SÁCH HDV
    $query = "
        SELECT tg.*, u.full_name
        FROM tour_guides tg
        LEFT JOIN users u ON tg.user_id = u.id
    ";
    $guides = $conn->query($query)->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<div class="text-red-600">Lỗi: ' . $e->getMessage() . '</div>';
    return;
}
?>

<!-- ===== NỘI DUNG VIEW (MASTER SẼ BỌC NGOÀI) ===== -->

<h2 class="text-2xl font-bold mb-4">Danh sách Hướng dẫn viên</h2>

<a href="index.php?page=add"
    class="inline-block mb-4 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
    + Thêm mới
</a>

<div class="overflow-x-auto bg-white rounded shadow">
    <table class="w-full border text-sm">
        <thead class="bg-gray-100">
            <tr>
                <th class="border px-2 py-2">ID</th>
                <th class="border px-2 py-2">Tên user</th>
                <th class="border px-2 py-2">Ảnh</th>
                <th class="border px-2 py-2">SĐT</th>
                <th class="border px-2 py-2">Ngày sinh</th>
                <th class="border px-2 py-2">Sức khỏe</th>
                <th class="border px-2 py-2">Bằng cấp</th>
                <th class="border px-2 py-2">Ngôn ngữ</th>
                <th class="border px-2 py-2">Số GPHN</th>
                <th class="border px-2 py-2">Hạn GPHN</th>
                <th class="border px-2 py-2">Kinh nghiệm</th>
                <th class="border px-2 py-2">Phân loại</th>
                <th class="border px-2 py-2">Trạng thái</th>
                <th class="border px-2 py-2">Thao tác</th>
            </tr>
        </thead>

        <tbody>
            <?php if (empty($guides)): ?>
                <tr>
                    <td colspan="14" class="text-center py-4 text-gray-500">
                        Chưa có hướng dẫn viên
                    </td>
                </tr>
            <?php else: ?>
                <?php foreach ($guides as $g): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="border px-2 py-2 text-center"><?= $g['id'] ?></td>
                        <td class="border px-2 py-2"><?= htmlspecialchars($g['full_name'] ?? 'N/A') ?></td>
                        <td class="border px-2 py-2 text-center">
                            <img src="<?= $g['avata_id'] ?>"
                                class="w-12 h-12 object-cover rounded mx-auto"
                                onerror="this.src='https://via.placeholder.com/50'">
                        </td>
                        <td class="border px-2 py-2"><?= $g['phone'] ?></td>
                        <td class="border px-2 py-2"><?= $g['date_birth'] ?></td>
                        <td class="border px-2 py-2"><?= $g['health'] ?></td>
                        <td class="border px-2 py-2"><?= $g['certificate'] ?></td>
                        <td class="border px-2 py-2"><?= $g['language'] ?></td>
                        <td class="border px-2 py-2"><?= $g['license_number'] ?></td>
                        <td class="border px-2 py-2"><?= $g['license_expiry'] ?></td>
                        <td class="border px-2 py-2 text-center"><?= $g['experience_years'] ?> năm</td>
                        <td class="border px-2 py-2"><?= $g['classify'] ?></td>
                        <td class="border px-2 py-2 text-center">
                            <?= $g['status'] == 1 ? 'Bật' : 'Tắt' ?>
                        </td>
                        <td class="border px-2 py-2 text-center whitespace-nowrap">
                            <a href="index.php?page=edit&id=<?= $g['id'] ?>"
                                class="text-blue-600 hover:underline">Sửa</a>
                            |
                            <a href="index.php?del=<?= $g['id'] ?>"
                                onclick="return confirm('Bạn chắc chắn muốn xóa hướng dẫn viên này?')"
                                class="text-red-600 hover:underline">
                                Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>