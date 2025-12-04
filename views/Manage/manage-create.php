<!doctype html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Tour</title>
</head>
<style>
    body {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: #f0f4f8;
        min-height: 100%;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 2rem 1rem;
    }

    .form-container {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        padding: 2.5rem;
        max-width: 600px;
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

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    label {
        color: #34495e;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    input {
        padding: 0.75rem;
        border: 1px solid #dce4ec;
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        background: #ffffff;
        color: #2c3e50;
    }

    input::placeholder {
        color: #95a5a6;
    }

    input:focus {
        outline: none;
        border-color: #5dade2;
        box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.1);
    }

    input:hover {
        border-color: #aeb6bf;
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

    .submit-button:active {
        transform: scale(0.98);
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

        .form-container {
            padding: 2rem 1.5rem;
        }

        .form-header h1 {
            font-size: 1.5rem;
        }
    }
</style>

<body>
    <main>
        <div class="form-container">
            <header class="form-header">
                <h1>Quản lý Tour</h1>
                <p>Vui lòng điền thông tin tour</p>
            </header>
            <form id="tourForm" action="?action=manage-store" method="POST">
                <div class="form-grid"> <!-- Chọn Tour -->
                    <div class="form-group"> <label>Tour</label> <select name="tour_id" id="tour_id">
                            <option value="">-- Chọn Tour --</option> <?php if (!empty($tours)): ?> <?php foreach ($tours as $tour): ?> <option value="<?= $tour['id'] ?>"><?= $tour['name'] ?></option> <?php endforeach; ?> <?php endif; ?>
                        </select> </div> <!-- Ngày bắt đầu -->
                    <div class="form-group"> <label for="start_date">Ngày bắt đầu</label> <input type="date" id="start_date" name="start_date"> </div> <!-- Ngày kết thúc -->
                    <div class="form-group"> <label for="end_date">Ngày kết thúc</label> <input type="date" id="end_date" name="end_date"> </div>
                    <div class="day-display"> <span id="so_ngay">0</span> ngày - <span id="so_dem">0</span> đêm </div> <!-- Số khách -->
                    <div class="form-group"> <label for="number_guests">Số khách</label> <input type="number" id="number_guests" name="number_guests" min="1" placeholder="0"> </div> <input type="hidden" id="total_days" name="total_days"> <!-- Hướng dẫn viên -->
                    <div class="form-group"> <label>Hướng dẫn viên</label> <select name="guide_id" id="guide_id">
                            <option value="">-- Chọn HDV --</option> <?php if (!empty($guides)): ?> <?php foreach ($guides as $guide): ?> <option value="<?= $guide['guide_id'] ?>"><?= $guide['full_name'] ?></option> <?php endforeach; ?> <?php endif; ?>
                        </select> </div> <!-- Giờ khởi hành -->
                    <div class="form-group"> <label for="departure_time">Giờ khởi hành</label> <input type="time" id="departure_time" name="departure_time"> </div> <!-- Dịch vụ -->
                    <div class="form-group"> <label>Dịch vụ</label> <?php if (!empty($services)): ?> <?php foreach ($services as $service): ?> <label style="display:block; margin-bottom:5px;"> <input type="checkbox" name="services[]" value="<?= htmlspecialchars($service['id'] ?? '') ?>"> <?= htmlspecialchars($service['name'] ?? '') ?> </label> <?php endforeach; ?> <?php endif; ?> </div>
                </div> <button type="submit" class="submit-button">Thêm</button>
            </form>
        </div>
    </main>
    <script>
        function toDate(dateString) {
            const [y, m, d] = dateString.split('-').map(Number);
            return new Date(y, m - 1, d);
        }

        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalDaysInput = document.getElementById('total_days');
        const displayDays = document.getElementById('so_ngay');
        const displayNights = document.getElementById('so_dem');

        function calculateTotalDays() {
            if (!startDateInput.value || !endDateInput.value) return;

            const start = toDate(startDateInput.value);
            const end = toDate(endDateInput.value);

            if (end >= start) {
                const diffDays = (end - start) / (1000 * 60 * 60 * 24) + 1;
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

        const form = document.getElementById('tourForm');
        form.addEventListener('submit', function(e) {

            const tour = document.getElementById('tour_id').value;
            const guide = document.getElementById('guide_id').value;
            const guests = document.getElementById('number_guests').value;
            const departureTime = document.getElementById('departure_time').value;
            const serviceCheckboxes = document.querySelectorAll('input[name="services[]"]');

            if (!tour) {
                alert("Vui lòng chọn Tour!");
                e.preventDefault();
                return;
            }

            if (!guide) {
                alert("Vui lòng chọn Hướng dẫn viên!");
                e.preventDefault();
                return;
            }

            if (!startDateInput.value || !endDateInput.value) {
                alert("Vui lòng chọn ngày bắt đầu và ngày kết thúc!");
                e.preventDefault();
                return;
            }

            const start = toDate(startDateInput.value);
            const end = toDate(endDateInput.value);

            if (end < start) {
                alert("Ngày kết thúc phải sau ngày bắt đầu!");
                e.preventDefault();
                return;
            }

            if (guests < 1) {
                alert("Số khách phải lớn hơn hoặc bằng 1!");
                e.preventDefault();
                return;
            }

            let serviceChecked = [...serviceCheckboxes].some(cb => cb.checked);

            if (!serviceChecked) {
                alert("Vui lòng chọn ít nhất một dịch vụ!");
                e.preventDefault();
                return;
            }

            if (!departureTime) {
                alert("Vui lòng chọn giờ khởi hành!");
                e.preventDefault();
                return;
            }
        });
    </script>

</body>

</html>