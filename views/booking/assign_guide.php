<div class="container mt-4">
    <a href="index.php?action=booking-detail&id=<?= $booking['id'] ?>"
        class="btn btn-secondary mb-3">⬅ Quay lại</a>

    <h4>👨‍✈️ Gán hướng dẫn viên cho Booking #<?= $booking['id'] ?></h4>

    <form method="post" action="index.php?action=tour-group-store">

        <input type="hidden" name="booking_id" value="<?= $booking['id'] ?>">
        <input type="hidden" name="tour_id" value="<?= $booking['tour_id'] ?>">

        <div class="mb-3">
            <label class="form-label">Hướng dẫn viên</label>
            <select name="guide_id" class="form-select" required>
                <option value="">-- Chọn hướng dẫn viên --</option>
                <?php foreach ($guides as $g): ?>
                    <option value="<?= $g['id'] ?>">
                        <?= htmlspecialchars($g['full_name']) ?>
                        (<?= $g['phone'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button class="btn btn-success">💾 Gán hướng dẫn viên</button>
    </form>
</div>