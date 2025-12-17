<div class="container mt-4">
    <h4>👨‍✈️ Tạo Tour Group & Gán Hướng Dẫn Viên</h4>

    <form method="post" action="index.php?action=tour-group-store" class="row g-3">

        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
        <input type="hidden" name="tour_id" value="<?= $booking['tour_id'] ?>">
        <input type="hidden" name="number_guests" value="<?= count($this->guestModel->getByBooking($booking['id'])) ?>">

        <div class="col-md-6">
            <label>Ngày khởi hành</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>

        <div class="col-md-6">
            <label>Ngày kết thúc</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label>Giờ xuất phát</label>
            <input type="time" name="departure_time" class="form-control" required>
        </div>

        <div class="col-md-4">
            <label>Tổng số ngày</label>
            <input type="number" name="total_days" class="form-control" required>
        </div>

        <div class="col-md-12">
            <label>Địa điểm tập trung</label>
            <input type="text" name="address" class="form-control">
        </div>

        <div class="col-md-12">
            <label>Hướng dẫn viên</label>
            <select name="guide_id" class="form-select" required>
                <option value="">-- Chọn hướng dẫn viên --</option>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['id'] ?>">
                        <?= $g['full_name'] ?>
                        (<?= $g['experience_years'] ?> năm – <?= $g['language'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-12">
            <label>Ghi chú</label>
            <textarea name="note" class="form-control"></textarea>
        </div>

        <div class="col-md-12">
            <button class="btn btn-success">💾 Tạo tour group</button>
        </div>
    </form>
</div>