<form action="?action=manage-update&id=<?= $group['id'] ?>" method="POST">

    <label>Tour</label>
    <select name="tour_id">
        <?php foreach ($tours as $tour): ?>
            <option value="<?= $tour['id'] ?>" <?= $group['tour_id']==$tour['id']?'selected':'' ?>>
                <?= $tour['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Ngày bắt đầu</label>
    <input type="date" name="start_date" id="start_date" value="<?= $group['start_date'] ?>">

    <label>Ngày kết thúc</label>
    <input type="date" name="end_date" id="end_date" value="<?= $group['end_date'] ?>">

    <div>
        <span id="so_ngay">0</span> ngày - <span id="so_dem">0</span> đêm
    </div>

    <input type="hidden" name="total_days" id="total_days" value="<?= $group['total_days'] ?>">

    <label>Số khách</label>
    <input type="number" name="number_guests" value="<?= $group['number_guests'] ?>">

    <label>Giờ khởi hành</label>
    <input type="time" name="departure_time" value="<?= $group['departure_time'] ?>">

    <label>Hướng dẫn viên</label>
    <select name="guide_id">
        <?php foreach ($guides as $guide): ?>
            <option value="<?= $guide['guide_id'] ?>" <?= $group['guide_id']==$guide['guide_id']?'selected':'' ?>>
                <?= $guide['full_name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Dịch vụ</label>
    <?php foreach ($services as $service): ?>
        <label>
            <input type="checkbox" name="services[]" value="<?= $service['id'] ?>" 
                <?= in_array($service['id'], $selectedServices) ? 'checked' : '' ?>>
            <?= $service['name'] ?>
        </label>
    <?php endforeach; ?>

    <button type="submit">Cập nhật</button>
</form>

<script>
const startDateInput = document.getElementById('start_date');
const endDateInput = document.getElementById('end_date');
const totalDaysInput = document.getElementById('total_days');
const displayDays = document.getElementById('so_ngay');
const displayNights = document.getElementById('so_dem');

function calculateTotalDays() {
    const start = new Date(startDateInput.value);
    const end = new Date(endDateInput.value);
    if (start && end && end >= start) {
        const diffTime = end - start;
        const diffDays = Math.ceil(diffTime / (1000*60*60*24)) + 1;
        totalDaysInput.value = diffDays;
        displayDays.innerText = diffDays;
        displayNights.innerText = diffDays - 1;
    } else {
        totalDaysInput.value = '';
        displayDays.innerText = 0;
        displayNights.innerText = 0;
    }
}

startDateInput.addEventListener('change', calculateTotalDays);
endDateInput.addEventListener('change', calculateTotalDays);

// Gọi 1 lần lúc load
calculateTotalDays();
</script>
