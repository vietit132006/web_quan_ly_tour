
    <style>
        .form-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            max-width: 650px;
            width: 100%;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h1 {
            color: #2c3e50;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            color: #34495e;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        input, select {
            padding: 0.75rem;
            border: 1px solid #dce4ec;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background: #ffffff;
            color: #2c3e50;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #5dade2;
            box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.1);
        }

        .submit-button {
            width: 100%;
            padding: 0.875rem;
            background: #5dade2;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.75rem;
        }

        .submit-button:hover {
            background: #3498db;
        }

        .day-display {
            grid-column: 1 / -1;
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 0.5rem;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
<div class="form-container">
    <header class="form-header">
        <h1>Cập nhật lịch trình tour</h1>
        <p>Chỉnh sửa thông tin</p>
    </header>

    <form action="<?= BASE_URL ?>?action=manage-update&id=<?= $group['id'] ?>" method="POST">
        
        <div class="form-grid">

            <!-- Chọn Tour -->
            <div class="form-group">
                <label>Tour</label>
                <select name="tour_id">
                    <?php foreach ($tours as $tour): ?>
                        <option value="<?= $tour['id'] ?>"
                            <?= $group['tour_id'] == $tour['id'] ? 'selected' : '' ?>>
                            <?= $tour['name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Ngày bắt đầu -->
            <div class="form-group">
                <label>Ngày bắt đầu</label>
                <input type="date" id="start_date" name="start_date" value="<?= $group['start_date'] ?>">
            </div>

            <!-- Ngày kết thúc -->
            <div class="form-group">
                <label>Ngày kết thúc</label>
                <input type="date" id="end_date" name="end_date" value="<?= $group['end_date'] ?>">
            </div>

            <div class="day-display">
                <span id="so_ngay"><?= $group['total_days'] ?></span> ngày - 
                <span id="so_dem"><?= $group['total_days'] - 1 ?></span> đêm
            </div>

            <input type="hidden" id="total_days" name="total_days" value="<?= $group['total_days'] ?>">

            <!-- Số khách -->
            <div class="form-group">
                <label>Số khách</label>
                <input type="number" name="number_guests" value="<?= $group['number_guests'] ?>">
            </div>

            <!-- Hướng dẫn viên -->
            <div class="form-group">
                <label>Hướng dẫn viên</label>
                <select name="guide_id">
                    <?php foreach ($guides as $guide): ?>
                        <option value="<?= $guide['guide_id'] ?>"
                            <?= $group['guide_id'] == $guide['guide_id'] ? 'selected' : '' ?>>
                            <?= $guide['full_name'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Giờ khởi hành -->
            <div class="form-group">
                <label>Giờ khởi hành</label>
                <input type="time" name="departure_time" value="<?= $group['departure_time'] ?>">
            </div>

            <!-- Dịch vụ -->
            <div class="form-group" style="grid-column:1 / -1;">
                <label>Dịch vụ</label>
                <?php foreach ($services as $service): ?>
                    <label style="display:block; margin-bottom:6px;">
                        <input type="checkbox"
                               name="services[]"
                               value="<?= $service['id'] ?>"
                               <?= in_array($service['id'], $selectedServices) ? 'checked' : '' ?>>
                        <?= $service['name'] ?>
                    </label>
                <?php endforeach; ?>
            </div>

        </div>

        <button class="submit-button" type="submit">Cập nhật</button>
    </form>

</div>
<script>
    const s = document.getElementById('start_date');
    const e = document.getElementById('end_date');
    const total = document.getElementById('total_days');
    const showDay = document.getElementById('so_ngay');
    const showNight = document.getElementById('so_dem');

    function calc() {
        const start = new Date(s.value);
        const end = new Date(e.value);
        if (!isNaN(start) && !isNaN(end) && end >= start) {
            const diff = Math.ceil((end - start) / 86400000) + 1;
            total.value = diff;
            showDay.innerText = diff;
            showNight.innerText = diff - 1;
        }
    }

    s.addEventListener("change", calc);
    e.addEventListener("change", calc);
</script>

