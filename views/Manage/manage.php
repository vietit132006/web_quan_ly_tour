<style>
  /* ====== BẢNG LỊCH TRÌNH TOUR ====== */
  /* ================= ROOT ================= */
  :root {
    --primary: #0d6efd;
    --primary-dark: #0b5ed7;
    --danger: #dc3545;
    --bg-light: #f8f9fb;
    --radius: 14px;
    --transition: all 0.25s ease;
    --shadow-soft: 0 12px 28px rgba(0, 0, 0, 0.08);
  }

  /* ================= CONTENT ================= */
  .content {
    background: var(--bg-light);
    padding: 24px;
    border-radius: var(--radius);
  }

  /* ================= TABLE ================= */
  .tour-table,
  .table {
    background: #fff;
    border-radius: var(--radius);
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    font-size: 14px;
  }

  /* Header */
  .table thead {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
  }

  .table thead th {
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
    padding: 16px;
    border: none;
    text-align: center;
    letter-spacing: 0.5px;
  }

  /* Body */
  .table tbody td {
    padding: 15px;
    text-align: center;
    vertical-align: middle;
    border-top: 1px solid #eef1f5;
    color: #333;
    transition: var(--transition);
  }

  /* Hover row */
  .table tbody tr {
    transition: var(--transition);
  }

  .table tbody tr:hover {
    background: #f6f9ff;
    transform: scale(1.005);
  }

  /* Cột Tour */
  .table tbody td:nth-child(2) {
    color: var(--primary);
    font-weight: 600;
  }

  /* Dịch vụ */
  .table tbody td:nth-child(9) {
    font-size: 13px;
    color: #555;
  }

  /* ================= ACTION BUTTON ================= */
  .action-btns {
    display: flex;
    gap: 10px;
    justify-content: center;
  }

  .btn-edit,
  .btn-delete {
    padding: 7px 16px;
    border-radius: 999px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    justify-content: center;
  }

  /* Edit */
  .btn-edit {
    background: #e7f1ff;
    color: var(--primary);
  }

  .btn-edit:hover {
    background: var(--primary);
    color: #fff;
    box-shadow: 0 8px 20px rgba(13, 110, 253, 0.35);
  }

  /* Delete */
  .btn-delete {
    background: #ffe7e7;
    color: var(--danger);
  }

  .btn-delete:hover {
    background: var(--danger);
    color: #fff;
    box-shadow: 0 8px 20px rgba(220, 53, 69, 0.35);
  }

  /* ================= BUTTON TOP ================= */
  button.btn-primary {
    border-radius: 10px;
    padding: 8px 20px;
    font-weight: 600;
    box-shadow: 0 6px 18px rgba(13, 110, 253, 0.3);
  }

  /* ================= MODAL ================= */
  .modal-content {
    border-radius: var(--radius);
    border: none;
    box-shadow: var(--shadow-soft);
  }

  .modal-header {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    border: none;
  }

  .modal-title {
    font-weight: 600;
  }

  .modal-body {
    padding: 24px;
  }

  /* ================= FORM ================= */
  .form-group {
    margin-bottom: 16px;
  }

  .form-group label {
    font-size: 13px;
    font-weight: 600;
    color: #444;
    margin-bottom: 6px;
    display: block;
  }

  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px 14px;
    border-radius: 10px;
    border: 1px solid #e0e6ed;
    transition: var(--transition);
    font-size: 14px;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
    outline: none;
  }

  /* Checkbox service */
  .form-group input[type="checkbox"] {
    margin-right: 6px;
  }

  /* Day display */
  .day-display {
    margin: 10px 0 16px;
    padding: 10px;
    border-radius: 10px;
    background: #f1f6ff;
    font-weight: 600;
    color: var(--primary);
    text-align: center;
  }

  /* Submit button */
  .submit-button {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-weight: 600;
    font-size: 15px;
    transition: var(--transition);
  }

  .submit-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 28px rgba(13, 110, 253, 0.35);
  }

  /* ================= RESPONSIVE ================= */
  @media (max-width: 992px) {

    .table thead th,
    .table tbody td {
      font-size: 12px;
      padding: 10px;
    }

    .action-btns {
      flex-direction: column;
    }

    .content {
      padding: 16px;
    }
  }
</style>
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