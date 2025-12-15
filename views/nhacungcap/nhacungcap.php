<style>
    body {
        font-family: Arial, sans-serif;
        background: #f5f6fa;
        padding: 20px;
    }

    .container {
        background: #fff;
        padding: 20px;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        max-width: 1100px;
        margin: auto;
    }

    h2 {
        margin-bottom: 15px;
        color: #2c3e50;
    }

    a {
        text-decoration: none;
    }

    /* ===== BUTTON ===== */
    .btn {
        padding: 6px 12px;
        border-radius: 4px;
        font-size: 14px;
        display: inline-block;
    }

    .btn-add {
        background: #00b894;
        color: #fff;
        margin-bottom: 10px;
    }

    .btn-edit {
        background: #0984e3;
        color: #fff;
    }

    .btn-delete {
        background: #d63031;
        color: #fff;
    }

    .btn-back {
        background: #636e72;
        color: #fff;
        margin-top: 10px;
    }

    /* ===== TABLE ===== */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    th {
        background: #2d3436;
        color: #fff;
    }

    tr:nth-child(even) {
        background: #f1f2f6;
    }

    /* ===== FORM ===== */
    .form-group {
        margin-bottom: 12px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 4px;
    }

    input, textarea {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    textarea {
        resize: vertical;
    }
</style>

<body>
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
  