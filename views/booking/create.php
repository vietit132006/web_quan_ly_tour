  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <div class="container mt-4">
      <a href="index.php?action=booking" class="btn btn-secondary mb-3">⬅ Quay lại</a>

      <h3 class="mb-4">➕ Tạo Booking mới</h3>

      <form action="index.php?action=booking-store" method="POST" id="bookingForm" onsubmit="return validateGuestCount()">

          <!-- ================= THÔNG TIN BOOKING ================= -->
          <div class="card mb-4">
              <div class="card-header bg-success text-white">Thông tin Booking</div>
              <div class="card-body row g-3">

                  <div class="col-md-6">
                      <label class="form-label">Tour</label>
                      <select name="tour_id" class="form-select" required onchange="updateTourInfo(this)">
                          <option value="">-- Chọn tour --</option>
                          <?php foreach ($tours as $tour): ?>
                              <option
                                  value="<?= $tour['id'] ?>"
                                  data-min="<?= $tour['min_people'] ?>"
                                  data-max="<?= $tour['max_people'] ?>"
                                  data-price="<?= $tour['promo_price'] ?>">
                                  <?= htmlspecialchars($tour['name']) ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                      <p id="tourLimit" class="text-muted mt-1"></p>
                  </div>

                  <div class="col-md-6">
                      <label class="form-label">Trạng thái</label>
                      <select name="status" class="form-select">
                          <?php foreach ($statuses as $key => $label): ?>
                              <option value="<?= $key ?>" <?= $key === 'pending' ? 'selected' : '' ?>>
                                  <?= $label ?>
                              </option>
                          <?php endforeach; ?>
                      </select>
                  </div>

                  <div class="col-12">
                      <label class="form-label">Ghi chú admin</label>
                      <textarea name="admin_note" class="form-control" rows="2"></textarea>
                  </div>
              </div>
          </div>

          <!-- ================= CUSTOMER ================= -->
          <div class="card mb-4">
              <div class="card-header bg-info text-white">👤 Khách đặt tour</div>
              <div class="card-body row g-3">

                  <div class="col-md-6">
                      <input name="customer_name" class="form-control" placeholder="Họ tên khách đặt" required>
                  </div>

                  <div class="col-md-6">
                      <input name="customer_phone" class="form-control" placeholder="Số điện thoại" required>
                  </div>

                  <div class="col-md-6">
                      <input name="customer_email" class="form-control" placeholder="Email">
                  </div>

                  <div class="col-md-6">
                      <input name="customer_address" class="form-control" placeholder="Địa chỉ">
                  </div>
              </div>
          </div>
          <!-- ================= SERVICES ================= -->
          <div class="card mb-4">
              <div class="card-header bg-primary text-white">
                  🧾 Dịch vụ thêm
              </div>
              <div class="card-body">

                  <?php if (!empty($services)): ?>
                      <?php foreach ($services as $s): ?>
                          <div class="row align-items-center mb-2 border-bottom pb-2">
                              <div class="col-md-5">
                                  <label class="form-check-label">
                                      <input
                                          type="checkbox"
                                          class="form-check-input service-checkbox"
                                          name="services[<?= $s['id'] ?>][id]"
                                          value="<?= $s['id'] ?>"
                                          data-price="<?= $s['price'] ?>"
                                          onchange="toggleServiceQty(this)">
                                      <?= htmlspecialchars($s['name']) ?>
                                  </label>
                              </div>

                              <div class="col-md-3">
                                  <span class="text-muted">
                                      <?= number_format($s['price']) ?> đ
                                  </span>
                              </div>

                              <div class="col-md-4">
                                  <input
                                      type="number"
                                      class="form-control service-qty"
                                      name="services[<?= $s['id'] ?>][qty]"
                                      value="1"
                                      min="1"
                                      disabled>
                              </div>
                          </div>
                      <?php endforeach; ?>
                  <?php else: ?>
                      <p class="text-muted fst-italic">Chưa có dịch vụ nào</p>
                  <?php endif; ?>

              </div>
          </div>

          <!-- ================= GUEST ================= -->
          <div class="card mb-4">
              <div class="card-header d-flex justify-content-between">
                  <span>👥 Danh sách khách đi tour</span>
                  <button type="button" class="btn btn-sm btn-success" onclick="addGuest()">+ Thêm khách</button>
              </div>
              <div class="card-body" id="guestContainer"></div>
          </div>

          <!-- ================= PAYMENT ================= -->
          <div class="card mb-4">
              <div class="card-header bg-warning">💰 Thanh toán đặt cọc</div>
              <div class="card-body">

                  <p>Giá tour: <strong id="tourPriceDisplay">0</strong> VNĐ</p>
                  <p>Đặt cọc (30%): <strong id="depositAmountDisplay">0</strong> VNĐ</p>

                  <input type="hidden" name="tour_price" id="tourPrice">
                  <input type="hidden" name="deposit_amount" id="depositAmount">

                  <select name="payment_method" class="form-select mt-2" required>
                      <option value="">-- Phương thức thanh toán --</option>
                      <option value="cash">Tiền mặt</option>
                      <option value="bank">Chuyển khoản</option>
                      <option value="momo">Momo</option>
                      <option value="vnpay">VNPay</option>
                  </select>
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
        <div class="d-flex justify-content-between">
            <strong>Khách #${guestIndex + 1}</strong>
            <button type="button" class="btn btn-sm btn-danger"
                onclick="this.closest('.guest-item').remove()">Xoá</button>
        </div>

        <div class="row g-2 mt-2">
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
                    <option>Nam</option>
                    <option>Nữ</option>
                </select>
            </div>
            <div class="col-md-12">
                <textarea name="guests[${guestIndex}][request]" class="form-control"
                    placeholder="Ghi chú riêng"></textarea>
            </div>
        </div>
    </div>`;
          document.getElementById('guestContainer').insertAdjacentHTML('beforeend', html);
          guestIndex++;
      }

      addGuest();

      function updateTourInfo(select) {
          const opt = select.options[select.selectedIndex];
          const price = parseFloat(opt.dataset.price || 0);
          const guestCount = document.querySelectorAll('.guest-item').length;
          const deposit = Math.round(price * 0.3 * guestCount);

          document.getElementById('tourPriceDisplay').innerText = price.toLocaleString();
          document.getElementById('depositAmountDisplay').innerText = deposit.toLocaleString();

          document.getElementById('tourPrice').value = price;
          document.getElementById('depositAmount').value = deposit;
      }

      function validateGuestCount() {
          return document.querySelectorAll('.guest-item').length > 0;
      }

      function toggleServiceQty(checkbox) {
          const row = checkbox.closest('.row');
          const qtyInput = row.querySelector('.service-qty');

          if (checkbox.checked) {
              qtyInput.disabled = false;
              qtyInput.value = 1;
          } else {
              qtyInput.disabled = true;
              qtyInput.value = 1;
          }
      }
  </script>