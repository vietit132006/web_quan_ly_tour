<style>
  /* ===========================
   🌐 ROOT – THEME SETUP
=========================== */
  :root {
    --primary: #06a3c9;
    --primary-dark: #008bb0;
    --danger: #dc3545;

    --text-dark: #2c3e50;
    --text-light: #6c7a89;

    --bg-page: #f4f6fa;
    --bg-card: #ffffff;
    --bg-hover: #eefaff;

    --radius: 14px;
    --radius-sm: 10px;

    --shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    --shadow-lg: 0 12px 28px rgba(0, 0, 0, 0.12);

    --transition: all 0.25s ease;
  }

  /* ===========================
   📦 GENERAL LAYOUT
=========================== */
  body {
    background: var(--bg-page);
    font-family: "Inter", sans-serif;
    color: var(--text-dark);
  }

  /* Content container */
  .content {
    background: var(--bg-card);
    padding: 28px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    margin: 20px;
  }

  /* Page title */
  .content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--primary);
  }

  /* ===========================
   📊 TABLE STYLE – PRO LEVEL
=========================== */
  .table {
    background: var(--bg-card);
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow);
  }

  .table thead {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
  }

  .table thead th {
    padding: 16px;
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    border: none;
  }

  .table tbody td {
    padding: 15px;
    vertical-align: middle;
    font-size: 14px;
    color: var(--text-dark);
    border-top: 1px solid #eef1f5;
  }

  /* Hover row effect */
  .table tbody tr:hover {
    background: var(--bg-hover);
    transform: scale(1.005);
    transition: var(--transition);
  }

  /* Highlight column – Tour Name */
  .table tbody td:nth-child(2) {
    font-weight: 600;
    color: var(--primary);
  }

  /* Services column */
  .table tbody td:nth-child(9) {
    font-size: 13px;
    color: var(--text-light);
  }

  /* ===========================
   🎛 ACTION BUTTONS
=========================== */
  .action-btns {
    display: flex;
    gap: 10px;
    justify-content: center;
  }

  .btn-edit,
  .btn-delete {
    padding: 7px 18px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    transition: var(--transition);
  }

  .btn-edit {
    background: #e7f7ff;
    color: var(--primary);
  }

  .btn-edit:hover {
    background: var(--primary);
    color: #fff;
    box-shadow: var(--shadow-lg);
  }

  .btn-delete {
    background: #ffe7e7;
    color: var(--danger);
  }

  .btn-delete:hover {
    background: var(--danger);
    color: #fff;
    box-shadow: var(--shadow-lg);
  }

  /* Add button */
  button.btn-primary {
    background: var(--primary) !important;
    border: none !important;
    padding: 10px 22px;
    border-radius: var(--radius-sm);
    font-weight: 600;
    box-shadow: var(--shadow);
    transition: var(--transition);
  }

  button.btn-primary:hover {
    background: var(--primary-dark) !important;
    transform: translateY(-2px);
  }

  /* ===========================
   📝 FORM – MODAL STYLE
=========================== */
  .modal-content {
    border-radius: var(--radius);
    border: none;
    box-shadow: var(--shadow-lg);
  }

  .modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    border: none;
  }

  .modal-title {
    font-weight: 700;
  }

  .modal-body {
    padding: 26px;
  }

  .form-group {
    margin-bottom: 18px;
  }

  .form-group label {
    font-size: 14px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 6px;
    display: block;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 12px 16px;
    border-radius: var(--radius-sm);
    border: 1px solid #dde3eb;
    font-size: 14px;
    transition: var(--transition);
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(6, 163, 201, 0.15);
  }

  /* Days box */
  .day-display {
    margin: 10px 0 18px;
    padding: 12px;
    border-radius: var(--radius-sm);
    background: #e6f7ff;
    color: var(--primary);
    text-align: center;
    font-weight: 700;
  }

  /* Submit */
  .submit-button {
    width: 100%;
    padding: 12px;
    border-radius: var(--radius);
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    border: none;
    color: #fff;
    font-size: 15px;
    font-weight: 600;
    transition: var(--transition);
  }

  .submit-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
  }

  /* ===========================
   📱 RESPONSIVE
=========================== */
  @media (max-width: 992px) {
    .content {
      padding: 18px;
    }

    .table tbody td,
    .table thead th {
      padding: 10px;
      font-size: 12px;
    }

    .action-btns {
      flex-direction: column;
    }
  }
</style>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

<!-- Custom CSS -->
<link rel="stylesheet" href="assets/css/styles.css">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<div class="content">
  <h3>Lịch trình tour</h3>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Thêm mới
  </button>
  <div class="table-responsive">
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tour</th>
          <th>Ngày bắt đầu</th>
          <th>Ngày kết thúc</th>
          <th>Ngày tour</th>
          <th>Giờ khởi hành</th>
          <th>Số khách</th>
          <th>Hướng dẫn viên</th>
          <th>Dịch vụ</th>
          <th>Hành động</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($tour_group)): ?>
          <?php foreach ($tour_group as $tg): ?>
            <tr>
              <td><?= htmlspecialchars($tg['id']) ?></td>
              <td><?= htmlspecialchars($tg['tour_name']) ?></td>
              <td><?= htmlspecialchars($tg['start_date']) ?></td>
              <td><?= htmlspecialchars($tg['end_date']) ?></td>
              <td><?= htmlspecialchars($tg['so_ngay']) ?> ngày <?= htmlspecialchars($tg['so_dem']) ?> đêm</td>
              <td><?= htmlspecialchars($tg['departure_time']) ?></td>
              <td><?= htmlspecialchars($tg['number_guests']) ?></td>
              <td><?= htmlspecialchars($tg['guide_name']) ?></td>
              <td><?= htmlspecialchars($tg['service_list']) ?></td>
              <td class="action-btns">
                <a href="index.php?action=manage-edit&id=<?= $tg['id'] ?>"
                  class="btn-edit">
                  Sửa
                </a>

                <a href="index.php?action=manage-delete&id=<?= $tg['id'] ?>"
                  class="btn-delete"
                  onclick="return confirm('Bạn có chắc muốn xóa không?')">
                  Xóa
                </a>


              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="8" class="text-center">Chưa có dữ liệu</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Thêm lịch trình mới</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div>
          <form id="tourForm" action="?action=manage-store" method="POST">
            <div>

              <!-- Chọn Tour -->
              <div class="form-group">
                <label>Tour</label>
                <select name="tour_id" id="tour_id">
                  <option value="">-- Chọn Tour --</option>
                  <?php if (!empty($tours)): ?>
                    <?php foreach ($tours as $tour): ?>
                      <option value="<?= $tour['id'] ?>"><?= $tour['name'] ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>

              <!-- Ngày bắt đầu -->
              <div class="form-group">
                <label for="start_date">Ngày bắt đầu</label>
                <input type="date" id="start_date" name="start_date">
              </div>

              <!-- Ngày kết thúc -->
              <div class="form-group">
                <label for="end_date">Ngày kết thúc</label>
                <input type="date" id="end_date" name="end_date">
              </div>

              <div class="day-display">
                <span id="so_ngay">0</span> ngày <span id="so_dem">0</span> đêm
              </div>

              <!-- Số khách -->
              <div class="form-group">
                <label for="number_guests">Số khách</label>
                <input type="number" id="number_guests" name="number_guests" min="1" placeholder="0">
              </div>

              <input type="hidden" id="total_days" name="total_days">

              <!-- Hướng dẫn viên -->
              <div class="form-group">
                <label>Hướng dẫn viên</label>
                <select name="guide_id" id="guide_id">
                  <option value="">-- Chọn HDV --</option>
                  <?php if (!empty($guides)): ?>
                    <?php foreach ($guides as $guide): ?>
                      <option value="<?= $guide['guide_id'] ?>"><?= $guide['full_name'] ?></option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
              </div>

              <!-- Giờ khởi hành -->
              <div class="form-group">
                <label for="departure_time">Giờ khởi hành</label>
                <input type="time" id="departure_time" name="departure_time">
              </div>

              <!-- Dịch vụ -->
              <div class="form-group">
                <label>Dịch vụ</label>
                <?php if (!empty($services)): ?>
                  <?php foreach ($services as $service): ?>
                    <label style="display:block; margin-bottom:5px;">
                      <input type="checkbox" name="services[]" value="<?= htmlspecialchars($service['id'] ?? '') ?>">
                      <?= htmlspecialchars($service['name'] ?? '') ?>
                    </label>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>

            </div>
            <button type="submit" class="submit-button">Thêm</button>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>