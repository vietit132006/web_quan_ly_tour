<h2>Danh sách danh mục tour</h2>

<!-- Form thêm danh mục -->
<form action="index.php?action=tour-category-store" method="POST" style="margin-bottom: 20px;">
    <input type="text" name="name" placeholder="Tên danh mục" required>
    <button type="submit">Thêm danh mục</button>
</form>

<!-- Hiển thị danh mục -->
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($categories as $cate): ?>
        <tr>
            <td><?= $cate['id'] ?></td>
            <td><?= $cate['name'] ?></td>
            <td>
                <a href="index.php?action=tour-category-delete&id=<?= $cate['id'] ?>"
                    onclick="return confirm('Bạn có chắc muốn xóa?')">
                    Xóa
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>