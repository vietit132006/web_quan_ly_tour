<h4>Chi tiết Booking #<?= $booking['id'] ?></h4>

<form method="POST" action="index.php?action=booking-update">
    <input type="hidden" name="id" value="<?= $booking['id'] ?>">
    <p><strong>Tên người booking:</strong> <?= $booking['customer_name'] ?></p>
    <p><strong>Số điện thoại:</strong> <?= $booking['customer_phone'] ?></p>
    <p><strong>Tour:</strong> <?= $booking['tour_name'] ?></p>
    <p><strong>Số người:</strong> <?= $booking['number_people'] ?></p>
    <p><strong>Ngày đặt:</strong> <?= $booking['history'] ?></p>

    <label>Trạng thái</label>
    <select name="status" class="form-control">
        <option value="pending" <?= $booking['payment_status'] == 'pending' ? 'selected' : '' ?>>Chờ xác nhận</option>
        <option value="confirmed" <?= $booking['payment_status'] == 'confirmed' ? 'selected' : '' ?>>Xác nhận</option>
        <option value="cancelled" <?= $booking['payment_status'] == 'cancelled' ? 'selected' : '' ?>>Hủy</option>
    </select>

    <label class="mt-2">Ghi chú nội bộ</label>
    <textarea name="admin_note" class="form-control"><?= $booking['admin_note'] ?></textarea>




    <button type="submit" class="btn btn-primary mt-3">Cập nhật</button>
    <a href="index.php?action=booking" class="btn btn-secondary mt-3">Quay lại</a>
</form>