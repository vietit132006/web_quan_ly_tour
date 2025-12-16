<div class="container mt-4">
    <h2 class="mb-4">Thêm Hướng dẫn viên mới</h2>

    <form action="index.php?action=tourguides_store" method="POST" enctype="multipart/form-data">
        <label>Username:</label>
        <input type="text" name="username" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <label>Họ và tên:</label>
        <input type="text" name="full_name" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Số điện thoại:</label>
        <input type="text" name="phone" required><br><br>

        <label>Ngày sinh:</label>
        <input type="date" name="date_birth"><br><br>

        <label>Kinh nghiệm (năm):</label>
        <input type="number" name="experience_years"><br><br>

        <label>Ngôn ngữ:</label>
        <input type="text" name="language"><br><br>

        <label>Phân loại:</label>
        <select name="classify">
            <option>Chuyên nghiệp</option>
            <option>Bán thời gian</option>
            <option>Cộng tác viên</option>
        </select><br><br>

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

        <button type="submit">Thêm hướng dẫn viên</button>
    </form>

</div>