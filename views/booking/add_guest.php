<form action="/booking/save_guest" method="POST">
    <input type="hidden" name="booking_id" value="<?= $booking_id ?>">

    <label>Tên khách:</label>
    <input type="text" name="name" required>

    <label>SĐT:</label>
    <input type="text" name="phone">

    <label>Email:</label>
    <input type="email" name="email">

    <label>Tuổi:</label>
    <input type="number" name="age">

    <label>Ngày sinh:</label>
    <input type="date" name="date_birth">

    <label>Giới tính:</label>
    <select name="sex">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select>

    <label>Địa chỉ:</label>
    <input type="text" name="address">

    <label>CMND/CCCD:</label>
    <input type="text" name="identification">

    <label>Yêu cầu đặc biệt:</label>
    <textarea name="request"></textarea>

    <button type="submit">Thêm khách</button>
</form>