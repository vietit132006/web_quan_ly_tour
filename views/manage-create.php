
<!doctype html>
<html lang="vi">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="views/manage-create.css">
  <title>Quản lý Tour</title>
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

    <div class="form-group">
    <label>Tour</label>
  <select name="tour_id" id="tour_id">
    <?php if (!empty($tours)): ?>
        <?php foreach ($tours as $tour): ?>
            <option value="<?= $tour['id'] ?>"><?= $tour['name'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">Không có tour nào</option>
    <?php endif; ?>
</select>


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

      <select name="guide_id" id="guide_id">
    <?php if (!empty($guides)): ?>
        <?php foreach ($guides as $guide): ?>
            <option value="<?= $guide['guide_id'] ?>"><?= $guide['full_name'] ?></option>
        <?php endforeach; ?>
    <?php else: ?>
        <option value="">Không có hướng dẫn viên nào</option>
    <?php endif; ?>
</select>
<?php

?>
      <div class="form-group"><label for="departure_time">Giờ khởi hành</label> 
        <input type="time" id="departure_time" name="departure_time" required>
      </div>

<div class="form-group">
    <label>Dịch vụ</label>
    <?php if (!empty($services)): ?>
        
        <?php foreach ($services as $service): ?>
            <label style="display:block; margin-bottom:5px;">
             <input type="checkbox" name="services[]" value="<?= htmlspecialchars($service['id'] ?? '') ?>">
                <?= htmlspecialchars($service['name'] ?? '') ?>
            </label>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có dịch vụ nào</p>
    <?php endif; ?>
</div>
     </div>
     <button type="submit" class="submit-button">Thêm</button>
    </form>
    <?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "<h3>DEBUG DỮ LIỆU FORM:</h3>";
    
    echo "Tour ID: " . ($_POST['tour_id'] ?? 'null') . "<br>";
    echo "Ngày bắt đầu: " . ($_POST['start_date'] ?? 'null') . "<br>";
    echo "Ngày kết thúc: " . ($_POST['end_date'] ?? 'null') . "<br>";
    echo "Tổng ngày: " . ($_POST['total_days'] ?? 'null') . "<br>";
    echo "Số khách: " . ($_POST['number_guests'] ?? 'null') . "<br>";
    echo "HDV: " . ($_POST['guide_id'] ?? 'null') . "<br>";
    echo "Giờ khởi hành: " . ($_POST['departure_time'] ?? 'null') . "<br>";

    echo "Dịch vụ chọn: ";
    if (!empty($_POST['services'])) {
        foreach ($_POST['services'] as $sv) {
            echo $sv . " ";
        }
    } else {
        echo "Không chọn dịch vụ nào";
    }
}
?>

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
