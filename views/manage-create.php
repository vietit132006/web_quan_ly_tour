<!doctype html>
<html lang="vi">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Tour</title>
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
 </head>
 <body>
  <main>
   <div class="form-container">
    <header class="form-header">
     <h1>Quản lý Tour</h1>
     <p>Vui lòng điền thông tin tour</p>
    </header>
    <form action="?action=manage-store" method="POST">
     <div class="form-grid">

      <div class="form-group"><label for="tour_name">Tour</label> 
        <input type="text" id="tour_name" name="tour_name" required placeholder="Nhập tên tour">
      </div>

      <div class="form-group"><label for="start_date">Ngày bắt đầu</label> 
        <input type="date" id="start_date" name="start_date" required>
      </div>

      <div class="form-group"><label for="end_date">Ngày kết thúc</label> 
        <input type="date" id="end_date" name="end_date" required>
      </div>

      <!-- Hiển thị số ngày – số đêm -->
      <div class="day-display">
        <span id="so_ngay">0</span> ngày - <span id="so_dem">0</span> đêm
      </div>

      <div class="form-group"><label for="number_guests">Số khách</label> 
        <input type="number" id="number_guests" name="number_guests" required min="1" placeholder="0">
      </div>

      <!-- Input ẩn để gửi tổng ngày lên server -->
      <input type="hidden" id="total_days" name="total_days">

      <div class="form-group"><label for="guide_name">Hướng dẫn viên</label> 
        <input type="text" id="guide_name" name="guide_name" required placeholder="Tên hướng dẫn viên">
      </div>

      <div class="form-group"><label for="departure_time">Giờ khởi hành</label> 
        <input type="time" id="departure_time" name="departure_time" required>
      </div>

      <div class="form-group full-width"><label for="service_list">Dịch vụ</label> 
        <input type="text" id="service_list" name="service_list" required placeholder="Nhập các dịch vụ">
      </div>
     </div>
     <button type="submit" class="submit-button">Thêm</button>
    </form>
   </div>
  </main>

  <!-- JS tự động tính số ngày và số đêm -->
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
            const diffTime = end - start; // milliseconds
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // tính cả ngày đầu
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
  </script>
 </body>
</html>
