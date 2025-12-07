<!DOCTYPE html>
<html lang="vi">

<head>
  <meta charset="UTF-8">
  <title>Quản lý Tour Du Lịch</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="styles/manage.css">
</head>

<body>
  <div class="sidebar">
    <a href="#"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking"><i class="bi bi-calendar-check"></i></a>
    <a href="index.php?action=manage" class="active"><i class="bi bi-kanban"></i></a>
    <a href="#"><i class="bi bi-person"></i></a>
    <a href="#"><i class="bi bi-gear"></i></a>
  </div>

  <div class="topbar">
    <div class="search-bar">
      <input type="text" placeholder="Tìm kiếm...">
    </div>
    <div class="top-icons">
      <i class="bi bi-sun" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chế độ sáng/tối"></i>
      <i class="bi bi-bell" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Thông báo"></i>
      <i class="bi bi-chat-dots" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tin nhắn"></i>
      <img src="https://i.pravatar.cc/40" alt="Ảnh người dùng" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tài khoản">
    </div>
  </div>

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
                  <a href="#" class="btn-edit"
                    onclick="openModal('<?= BASE_URL ?>?action=manage-edit&id=<?= $tg['id'] ?>')">
                    Sửa
                  </a>

                  <a href="<?= BASE_URL ?>?action=manage-delete&id=<?= $tg['id'] ?>" class="btn-delete"
                    onclick="return confirm('Bạn có chắc muốn xóa lịch trình tour này không?')">Xóa</a>


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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <script src="scripts/manage.js"></script>
</body>

</html>