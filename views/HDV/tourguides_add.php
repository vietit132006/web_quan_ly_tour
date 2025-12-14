<h2>Thêm hướng dẫn viên</h2>

<form action="index.php?action=tourguides_store" method="POST" enctype="multipart/form-data">

    <label>User (role = 3):</label>
    <select name="user_id" required>
        <?php foreach ($users as $u): ?>
            <option value="<?= $u['id'] ?>">
                <?= $u['full_name'] ?> (<?= $u['email'] ?>)
            </option>
        <?php endforeach; ?>
    </select>
    <br><br>

    <label>Ngày sinh:</label>
    <input type="date" name="date_birth" required><br><br>

    <label>Số điện thoại:</label>
    <input type="text" name="phone" required><br><br>

    <label>Kinh nghiệm (năm):</label>
    <input type="number" name="experience_years" required><br><br>

    <label>Ngôn ngữ:</label>
    <input type="text" name="language"><br><br>

    <label>Phân loại:</label>
    <select name="classify">
        <option>Chuyên nghiệp</option>
        <option>Bán thời gian</option>
        <option>Cộng tác viên</option>
    </select>
    <br><br>

    <label>Số bằng cấp:</label>
    <input type="text" name="license_number"><br><br>

    <label>Ngày hết hạn bằng:</label>
    <input type="date" name="license_expiry"><br><br>

    <label>Sức khỏe:</label>
    <textarea name="health"></textarea><br><br>

    <label>Lịch sử làm việc:</label>
    <textarea name="history"></textarea><br><br>

    <label>Đánh giá:</label>
    <textarea name="evaluate"></textarea><br><br>

    <label>Chứng chỉ:</label>
    <textarea name="certificate"></textarea><br><br>

    <label>Avatar:</label>
    <input type="file" name="avatar"><br><br>

    <button type="submit">Lưu</button>

</form>
