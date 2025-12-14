
<h2>Danh sách nhà cung cấp</h2>

<a href="index.php?action=nhacungcap_add">Thêm nhà cung cấp</a>

<table border="1" cellspacing="0" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Tên NCC</th>
        <th>Loại</th>
        <th>Người liên hệ</th>
        <th>Điện thoại</th>
        <th>Email</th>
        <th>Hợp đồng</th>
        <th>Đánh giá</th>
        <th>Hành động</th>
    </tr>

    <?php foreach ($suppliers as $sup): ?>
        <tr>
            <td><?= $sup['id'] ?></td>
            <td><?= $sup['name'] ?></td>
            <td><?= $sup['type'] ?></td>
            <td><?= $sup['contact_person'] ?></td>
            <td><?= $sup['phone'] ?></td>
            <td><?= $sup['email'] ?></td>
            <td><?= $sup['contract_number'] ?></td>
            <td><?= $sup['rating'] ?></td>
            <td>
                <a href="index.php?action=nhacungcap_edit&id=<?= $sup['id'] ?>">Sửa</a> | 
                <a onclick="return confirm('Xóa nhà cung cấp này?')" 
                   href="index.php?action=nhacungcap_delete&id=<?= $sup['id'] ?>">
                    Xóa
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
  