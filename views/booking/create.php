<div class="container mt-4">
    <a href="index.php?action=booking" class="btn btn-secondary mb-3">⬅ Quay lại</a>

    <h3 class="mb-4">➕ Tạo Booking mới</h3>

    <form action="index.php?action=booking-store" method="POST" id="bookingForm">
        <!-- ===== Thông tin Booking ===== -->
        <div class="card mb-4">
            <div class="card-header bg-success text-white">Thông tin Booking</div>
            <div class="card-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Tour</label>
                    <select name="tour_id" class="form-select" required>
                        <option value="">-- Chọn tour --</option>
                        <?php foreach ($tours as $tour): ?>
                            <option value="<?= $tour['id'] ?>"><?= htmlspecialchars($tour['name']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Trạng thái</label>
                    <select name="status" class="form-select" required>
                        <?php foreach ($statuses as $key => $label): ?>
                            <option value="<?= $key ?>" <?= $key == 'pending' ? 'selected' : '' ?>><?= $label ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label">Ghi chú admin</label>
                    <textarea name="admin_note" class="form-control" rows="2" placeholder="Ghi chú"></textarea>
                </div>
            </div>
        </div>

        <!-- ===== Danh sách khách ===== -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>👥 Danh sách khách</span>
                <button type="button" class="btn btn-sm btn-success" onclick="addGuest()">+ Thêm khách</button>
            </div>
            <div class="card-body" id="guestContainer">
                <!-- Khách sẽ được thêm ở đây -->
            </div>
        </div>

        <button class="btn btn-primary">💾 Lưu Booking</button>
    </form>
</div>

<script>
    let guestIndex = 0;

    function addGuest() {
        const html = `
    <div class="border rounded p-3 mb-3 guest-item">
        <div class="d-flex justify-content-between mb-2">
            <strong>Khách #${guestIndex + 1}</strong>
            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('.guest-item').remove()">
                Xoá
            </button>
        </div>
        <div class="row g-2">
            <div class="col-md-6">
                <input name="guests[${guestIndex}][name]" class="form-control" placeholder="Họ tên" required>
            </div>
            <div class="col-md-6">
                <input name="guests[${guestIndex}][phone]" class="form-control" placeholder="SĐT">
            </div>
            <div class="col-md-6">
                <input name="guests[${guestIndex}][email]" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-6">
                <input name="guests[${guestIndex}][identification]" class="form-control" placeholder="CCCD / Passport">
            </div>
            <div class="col-md-4">
                <input type="date" name="guests[${guestIndex}][date_birth]" class="form-control">
            </div>
            <div class="col-md-4">
                <select name="guests[${guestIndex}][sex]" class="form-select">
                    <option value="">Giới tính</option>
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                    <option value="Khác">Khác</option>
                </select>
            </div>
            <div class="col-md-12">
                <textarea name="guests[${guestIndex}][request]" class="form-control" rows="2" placeholder="Ghi chú riêng"></textarea>
            </div>
        </div>
    </div>
    `;
        document.getElementById('guestContainer').insertAdjacentHTML('beforeend', html);
        guestIndex++;
    }

    // Thêm sẵn 1 khách khi load trang
    addGuest();
</script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">