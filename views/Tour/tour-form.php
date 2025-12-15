<?php
$formAction = $isEdit
    ? "index.php?action=tour-update"
    : "index.php?action=tour-store";
?>
<style>
    #tour-page .form-col {
        justify-content: space-between;
    }

    /* 2 cột cân xứng */
    #tour-page .form-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
    }

    /* mỗi cột */
    #tour-page .form-col {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }

    /* mỗi field */
    #tour-page .form-group {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    /* input luôn full chiều ngang */
    #tour-page .form-group .form-control,
    #tour-page .form-group .form-select {
        width: 100%;
    }

    /* ===== FORM 2 CỘT CÂN XỨNG ===== */
    #tour-page .form-split {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 28px;
    }

    /* mỗi nửa */
    #tour-page .form-col {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    /* phần full chiều ngang */
    #tour-page .form-full {
        grid-column: span 2;
    }

    #tour-page .card {
        border-radius: 14px;
        background: #fff;
        border: none;
        box-shadow: 0 8px 28px rgba(0, 0, 0, .07);
    }

    #tour-page .card-header {
        background: linear-gradient(135deg, #10b981, #0d8f6e);
        color: #fff;
        font-size: 19px;
        font-weight: 600;
        padding: 18px 24px;
    }

    #tour-page .card-body {
        padding: 26px;
    }

    #tour-page .form-2col {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px 28px;
    }

    #tour-page .form-full {
        grid-column: span 2;
    }

    #tour-page label {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
    }

    #tour-page .form-control,
    #tour-page .form-select {
        border-radius: 12px;
        padding: 12px 14px;
        border: 1px solid #cbd5e1;
        background: #f8fafc;
    }

    #tour-page .form-control:focus,
    #tour-page .form-select:focus {
        border-color: #10b981;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, .25);
        background: #fff;
    }

    #tour-page textarea.form-control {
        min-height: 130px;
    }

    #tour-page .btn-success {
        background: linear-gradient(135deg, #10b981, #0d8f6e);
        border: none;
        border-radius: 12px;
        padding: 10px 26px;
        font-weight: 600;
    }

    #tour-page .form-image {
        width: 150px;
        height: 110px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        margin-top: 8px;
    }
</style>
<div id="tour-page">
    <div class="card mb-4">
        <div class="card-header">
            <?= $isEdit ? 'Cập nhật tour' : 'Thêm tour mới' ?>
        </div>

        <div class="card-body">
            <form action="<?= $formAction ?>" method="POST" enctype="multipart/form-data">

                <?php if ($isEdit): ?>
                    <input type="hidden" name="id" value="<?= $editTour['id'] ?>">
                <?php endif; ?>

                <div class="form-split">

                    <!-- ===== CỘT TRÁI ===== -->
                    <div class="form-col">

                        <div class="form-group">
                            <label>Tên tour</label>
                            <input type="text" name="name" class="form-control"
                                value="<?= $editTour['name'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Thời lượng</label>
                            <input type="text" name="duration" class="form-control"
                                value="<?= $editTour['duration'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="tour_category_id" class="form-select" required>
                                <option value="">-- Chọn danh mục --</option>
                                <?php foreach ($tourCategories as $cate): ?>
                                    <option value="<?= $cate['id'] ?>"
                                        <?= ($editTour['tour_category_id'] ?? '') == $cate['id'] ? 'selected' : '' ?>>
                                        <?= $cate['name'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Điểm đi</label>
                            <input type="text" name="diem_di" class="form-control"
                                value="<?= $editTour['diem_di'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Điểm đến</label>
                            <input type="text" name="diem_den" class="form-control"
                                value="<?= $editTour['diem_den'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Phương tiện</label>
                            <input type="text" name="phuong_tien" class="form-control"
                                value="<?= $editTour['phuong_tien'] ?? '' ?>" required>
                        </div>

                    </div>

                    <!-- ===== CỘT PHẢI ===== -->
                    <div class="form-col">

                        <div class="form-group">
                            <label>Giá gốc</label>
                            <input type="number" name="base_price" class="form-control"
                                value="<?= $editTour['base_price'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Giá khuyến mãi</label>
                            <input type="number" name="promo_price" class="form-control"
                                value="<?= $editTour['promo_price'] ?? '' ?>">
                        </div>

                        <div class="form-group">
                            <label>Số người tối đa</label>
                            <input type="number" name="so_nguoi" class="form-control"
                                value="<?= $editTour['so_nguoi'] ?? '' ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="status" class="form-select" required>
                                <option value="1" <?= ($editTour['status'] ?? '') == 1 ? 'selected' : '' ?>>Hoạt động</option>
                                <option value="2" <?= ($editTour['status'] ?? '') == 2 ? 'selected' : '' ?>>Dừng hoạt động</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Ảnh chính</label>
                            <input type="file" name="image" class="form-control">
                            <?php if ($isEdit && !empty($editTour['image'])): ?>
                                <img src="<?= BASE_ASSETS_UPLOADS . $editTour['image'] ?>" class="form-image">
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label>Ảnh phụ</label>
                            <input type="file" name="images[]" multiple class="form-control">
                        </div>

                    </div>

                    <!-- ===== MÔ TẢ (FULL WIDTH) ===== -->
                    <div class="form-group" class="form-full">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control"><?= $editTour['description'] ?? '' ?></textarea>
                    </div>

                    <!-- ===== LỊCH TRÌNH (FULL WIDTH) ===== -->
                    <div class="form-full">
                        <hr>
                        <h4>Lịch trình tour</h4>

                        <div class="form-group" id="itinerary-list">
                            <?php if (!empty($itineraries)): ?>
                                <?php foreach ($itineraries as $it): ?>
                                    <div class="border rounded p-3 mb-2">
                                        <input type="number" name="days[]" class="form-control mb-2"
                                            value="<?= $it['day_number'] ?>">
                                        <input type="text" name="titles[]" class="form-control mb-2"
                                            value="<?= $it['title'] ?>">
                                        <textarea name="contents[]" class="form-control"><?= $it['content'] ?></textarea>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>

                        <button type="button" class="btn btn-warning mt-2" onclick="addItinerary()">
                            + Thêm ngày
                        </button>
                    </div>

                </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-success">
                        <?= $isEdit ? "Cập nhật" : "Thêm mới" ?>
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>
<script>
    function addItinerary() {
        const wrapper = document.getElementById('itinerary-list');
        if (!wrapper) return;

        wrapper.insertAdjacentHTML('beforeend', `
        <div class="border rounded p-3 mb-2 itinerary-item">
            <label>Ngày:</label>
            <input type="number" name="days[]" class="form-control mb-2" required>

            <label>Tiêu đề:</label>
            <input type="text" name="titles[]" class="form-control mb-2" required>

            <label>Nội dung:</label>
            <textarea name="contents[]" class="form-control" required></textarea>

            <button type="button"
                    class="btn btn-sm btn-danger mt-2"
                    onclick="this.closest('.itinerary-item').remove()">
                Xóa ngày
            </button>
        </div>
    `);
    }
</script>