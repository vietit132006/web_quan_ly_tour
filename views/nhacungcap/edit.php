<h2>Sửa nhà cung cấp</h2>

<form action="index.php?action=nhacungcap_update" method="POST">

    <input type="hidden" name="id" value="<?= $supplier['id'] ?>">

    <label>Tên NCC:</label><br>
    <input type="text" name="name" value="<?= $supplier['name'] ?>"><br><br>

    <label>Loại:</label><br>
    <input type="text" name="type" value="<?= $supplier['type'] ?>"><br><br>

    <label>Người liên hệ:</label><br>
    <input type="text" name="contact_person" value="<?= $supplier['contact_person'] ?>"><br><br>

    <label>Điện thoại:</label><br>
    <input type="text" name="phone" value="<?= $supplier['phone'] ?>"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" value="<?= $supplier['email'] ?>"><br><br>

    <label>Địa chỉ:</label><br>
    <input type="text" name="address" value="<?= $supplier['address'] ?>"><br><br>

    <label>Số hợp đồng:</label><br>
    <input type="text" name="contract_number" value="<?= $supplier['contract_number'] ?>"><br><br>

    <label>Ngày bắt đầu hợp đồng:</label><br>
    <input type="date" name="contract_start" value="<?= $supplier['contract_start'] ?>"><br><br>

    <label>Ngày kết thúc hợp đồng:</label><br>
    <input type="date" name="contract_end" value="<?= $supplier['contract_end'] ?>"><br><br>

    <label>Đánh giá:</label><br>
    <input type="number" name="rating" value="<?= $supplier['rating'] ?>"><br><br>

    <label>Ghi chú:</label><br>
    <textarea name="note"><?= $supplier['note'] ?></textarea><br><br>

    <button type="submit">Cập nhật</button>
</form>

<br>
<a href="index.php?action=nhacungcap">Quay lại</a>
