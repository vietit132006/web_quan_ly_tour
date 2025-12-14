<h2>Thêm nhà cung cấp</h2>

<form action="index.php?action=nhacungcap_store" method="POST">

    <label>Tên NCC:</label><br>
    <input type="text" name="name"><br><br>

    <label>Loại:</label><br>
    <input type="text" name="type"><br><br>

    <label>Người liên hệ:</label><br>
    <input type="text" name="contact_person"><br><br>

    <label>Điện thoại:</label><br>
    <input type="text" name="phone"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Địa chỉ:</label><br>
    <input type="text" name="address"><br><br>

    <label>Số hợp đồng:</label><br>
    <input type="text" name="contract_number"><br><br>

    <label>Ngày bắt đầu hợp đồng:</label><br>
    <input type="date" name="contract_start"><br><br>

    <label>Ngày kết thúc hợp đồng:</label><br>
    <input type="date" name="contract_end"><br><br>

    <label>Đánh giá:</label><br>
    <input type="number" name="rating"><br><br>

    <label>Ghi chú:</label><br>
    <textarea name="note"></textarea><br><br>

    <button type="submit">Lưu</button>
</form>

<br>
<a href="index.php?action=nhacungcap">Quay lại</a>
