<!DOCTYPE html>
<html>
<head>
    <title>Danh sách nhóm</title>
</head>
<body>
<h3>Danh sách nhóm</h3>
<table border="1">
    <tr>
        <th>Đoàn</th>
        <th>Tour</th>
        <th>Ngày khởi hành</th>
        <th>Hành động</th>
    </tr>
    <?php foreach($groups as $g): ?>
    <tr>
        <td><?= htmlspecialchars($g['id']) ?></td>
        <td><?= htmlspecialchars($g['tour_name']) ?></td>
        <td><?= htmlspecialchars($g['start_date']) ?></td>
        <td>
            <a href="index.php?controller=group&action=delete&id=<?= $g['id'] ?>">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
