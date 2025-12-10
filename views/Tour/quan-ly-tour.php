<?php
$isEdit = !empty($editTour);
$formAction = $isEdit
    ? "index.php?action=tour-update&id={$editTour['id']}"
    : "index.php?action=tour-store";
?>

<style>
    .description-short {
        display: inline-block;
        max-width: 250px;
        /* chỉnh theo table */
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        vertical-align: middle;
    }

    .view-more {
        color: #0d6efd;
        cursor: pointer;
        font-weight: 500;
    }

    .tour-img {
        width: 100px;
        height: 85px;
        object-fit: cover;
        border-radius: 6px;
        border: 1px solid #ddd;
    }

    /* ====== PAGE TITLE ====== */
    h3.mb-4 {
        font-size: 26px;
        font-weight: 700;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ====== CARD FORM ====== */
    .card.mb-4 {
        border-radius: 14px;
        border: none;
        background: #ffffff;
        box-shadow: 0 14px 36px rgba(15, 23, 42, 0.08);
    }

    /* ====== CARD HEADER ====== */
    .card-header {
        background: linear-gradient(135deg, #2563eb, #4f46e5);
        color: #fff;
        font-size: 18px;
        padding: 16px 22px;
        border-radius: 14px 14px 0 0;
        letter-spacing: .3px;
    }

    /* ====== CARD BODY ====== */
    .card-body {
        padding: 26px;
    }

    /* ====== FORM LABEL ====== */
    .card-body label {
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 6px;
    }

    /* ====== INPUT / SELECT / TEXTAREA ====== */
    .form-control,
    .form-select {
        border-radius: 10px;
        padding: 10px 14px;
        font-size: 14px;
        border: 1px solid #cbd5e1;
        transition: all 0.2s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, .18);
    }

    /* ====== TEXTAREA ====== */
    textarea.form-control {
        min-height: 120px;
        resize: vertical;
    }

    /* ====== FORM ROW SPACING ====== */
    .row>div {
        margin-bottom: 14px;
    }

    /* ====== BUTTON STYLE ====== */
    .btn-success {
        background: linear-gradient(135deg, #22c55e, #16a34a);
        border: none;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 600;
    }

    .btn-success:hover {
        opacity: .92;
    }

    .btn-secondary {
        border-radius: 10px;
        padding: 10px 22px;
    }

    /* ====== DESCRIPTION SHORT ====== */
    .description-short {
        max-width: 260px;
        font-size: 14px;
        color: #334155;
    }

    /* ====== VIEW MORE ====== */
    .view-more {
        display: inline-block;
        margin-left: 6px;
        font-size: 13px;
        color: #2563eb;
        transition: .2s;
    }

    .view-more:hover {
        text-decoration: underline;
        color: #1d4ed8;
    }

    /* ====== IMAGE ====== */
    .tour-img {
        width: 100px;
        height: 80px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .08);
    }
</style>
<h3 class="mb-4 text-xl font-bold">
    <i class="bi bi-calendar-check"></i> Quản lý tour
</h3>
<div class="card mb-4">
    <div class="card-body">
        <form method="get" action="index.php" class="row g-3 align-items-end">
            <input type="hidden" name="action" value="tours">

            <!-- Tìm theo tên tour -->
            <div class="col-md-4">
                <label class="form-label">Tìm tour</label>
                <input type="text"
                    name="keyword"
                    class="form-control"
                    placeholder="Nhập tên tour..."
                    value="<?= $_GET['keyword'] ?? '' ?>">
            </div>

            <!-- Lọc danh mục -->
            <div class="col-md-3">
                <label class="form-label">Danh mục</label>
                <select name="category" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <option value="1" <?= ($_GET['category'] ?? '') == 1 ? 'selected' : '' ?>>Trong nước</option>
                    <option value="2" <?= ($_GET['category'] ?? '') == 2 ? 'selected' : '' ?>>Ngoài nước</option>
                    <option value="3" <?= ($_GET['category'] ?? '') == 3 ? 'selected' : '' ?>>Mạo hiểm</option>
                </select>
            </div>

            <!-- Lọc giá -->
            <div class="col-md-3">
                <label class="form-label">Khoảng giá</label>
                <select name="price" class="form-select">
                    <option value="">-- Tất cả --</option>
                    <option value="1" <?= ($_GET['price'] ?? '') == 1 ? 'selected' : '' ?>>Dưới 5 triệu</option>
                    <option value="2" <?= ($_GET['price'] ?? '') == 2 ? 'selected' : '' ?>>5 - 10 triệu</option>
                    <option value="3" <?= ($_GET['price'] ?? '') == 3 ? 'selected' : '' ?>>Trên 10 triệu</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="col-md-2 d-grid">
                <button class="btn btn-success">
                    <i class="bi bi-search"></i> Lọc
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header fw-bold">
        <?= $isEdit ? 'Cập nhật tour' : 'Thêm tour mới' ?>
    </div>

    <div class="card-body">
        <form method="post" action="<?= $formAction ?>">

            <div class="mb-3">
                <label>Tên tour</label>
                <input type="text" name="name" class="form-control"
                    value="<?= $editTour['name'] ?? '' ?>" required>
            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label>Giá</label>
                    <input type="number" name="base_price" class="form-control"
                        value="<?= $editTour['base_price'] ?? '' ?>" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Số ngày</label>
                    <input type="number" name="duration" class="form-control"
                        value="<?= $editTour['duration'] ?? '' ?>" required>
                </div>

                <div class="col-md-3 mb-3">
                    <label>Số người</label>
                    <input
                        type="number" class="form-control"
                        name="so_nguoi"
                        min="7"
                        max="30"
                        required
                        value="<?= $editTour['so_nguoi'] ?? '' ?>"
                        placeholder="7-30">
                </div>


                <div class="col-md-3 mb-3">
                    <label>Trạng thái</label>
                    <select name="status" class="form-select">
                        <option value="1" <?= (($editTour['status'] ?? 1) == 1) ? 'selected' : '' ?>>Hoạt động</option>
                        <option value="2" <?= (($editTour['status'] ?? '') == 2) ? 'selected' : '' ?>>Đã dừng</option>
                        <option value="3" <?= (($editTour['status'] ?? '') == 3) ? 'selected' : '' ?>>Bảo trì</option>
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label>Danh mục</label>
                <select name="tour_category_id" class="form-select">
                    <option value="1" <?= (($editTour['tour_category_id'] ?? '') == 1) ? 'selected' : '' ?>>Trong nước</option>
                    <option value="2" <?= (($editTour['tour_category_id'] ?? '') == 2) ? 'selected' : '' ?>>Ngoài nước</option>
                    <option value="3" <?= (($editTour['tour_category_id'] ?? '') == 3) ? 'selected' : '' ?>>Mạo hiểm</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Ảnh</label>
                <input type="text" name="image" class="form-control"
                    value="<?= $editTour['image'] ?? '' ?>">
            </div>

            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control"><?= $editTour['description'] ?? '' ?></textarea>
            </div>

            <button class="btn btn-success">
                <?= $isEdit ? 'Cập nhật' : 'Thêm tour' ?>
            </button>

            <?php if ($isEdit): ?>
                <a href="index.php?action=tours" class="btn btn-secondary ms-2">
                    Hủy
                </a>
            <?php endif; ?>

        </form>
    </div>
</div>
<table class="table table-bordered table-hover align-middle" width="100%">
    <thead class="table-light">
        <tr class="text-center">
            <th>ID</th>
            <th>Ảnh</th>
            <th>Tour</th>
            <th>Giá gốc</th>
            <th>Thời gian diễn ra tour</th>
            <th>Mô tả</th>
            <th>Số người</th>
            <th>Trạng thái</th>
            <th>Thời gian tạo</th>
            <th>Danh mục tour</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($tours as $tour): ?>
            <tr>
                <!-- ID -->
                <td class="text-center"><?= $tour['id'] ?></td>
                <!-- Ảnh -->
                <td class="text-center">
                    <?php if (!empty($tour['image'])): ?>
                        <img
                            src="<?= htmlspecialchars($tour['image']) ?>"
                            alt="Ảnh tour"
                            class="tour-img">
                    <?php else: ?>
                        <span class="text-muted">No Image</span>
                    <?php endif; ?>
                </td>

                <!-- Tên tour -->
                <td><?= $tour['name'] ?></td>

                <!-- Số tiền -->
                <td>
                    <?= number_format($tour['base_price'], 0, ',', '.') ?> VNĐ
                </td>

                <!-- Số ngày -->
                <td>
                    <?php if (!empty($tour['duration']) && is_numeric($tour['duration'])): ?>
                        <?= (int)$tour['duration'] ?> ngày <?= max((int)$tour['duration'] - 1, 0) ?> đêm
                    <?php else: ?>
                        <span class="text-muted">Chưa xác định</span>
                    <?php endif; ?>
                </td>

                <!-- Mô tả -->
                <td class="text-center">
                    <?php if (empty(trim($tour['description'] ?? ''))): ?>
                        <span class="text-muted">Trống...</span>
                    <?php else: ?>
                        <span class="description-short"
                            data-full="<?= htmlspecialchars($tour['description']) ?>">
                            <?= htmlspecialchars($tour['description']) ?>
                        </span>
                        <span class="view-more">Xem thêm</span>
                    <?php endif; ?>
                </td>

                <!-- Số người -->
                <td><?= $tour['so_nguoi'] ?></td>

                <!-- Trạng thái -->
                <?php
                $statusText = [
                    1 => 'Hoạt động',
                    2 => 'Đã dừng',
                    3 => 'Đang bảo trì'
                ];
                ?>
                <td><?= $statusText[$tour['status']] ?? 'Không xác định' ?></td>

                <!-- Thời gian tạo -->
                <td class="text-center">
                    <?php if (!empty($tour['created_at'])): ?>
                        <?= date('d/m/Y H:i', strtotime($tour['created_at'])) ?>
                    <?php else: ?>
                        <span class="text-muted">—</span>
                    <?php endif; ?>
                </td>

                <!-- Danh mục tour -->
                <?php
                $cateText = [
                    1 => 'Trong nước',
                    2 => 'Ngoài nước',
                    3 => 'Mạo hiểm',
                ];
                ?>
                <td><?= $cateText[$tour['tour_category_id']] ?? 'Không xác định' ?></td>

                <!-- Hành động -->
                <td class="text-center">
                    <!-- Xem -->
                    <a href="index.php?action=tour-detail&id=<?= $tour['id'] ?>"
                        class="btn btn-sm btn-info me-1">
                        <i class="bi bi-eye"></i>
                    </a>

                    <!-- Sửa -->
                    <a href="index.php?action=tours&id_edit=<?= $tour['id'] ?>"
                        class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>


                    <!-- Xóa -->
                    <a href="index.php?action=tour-delete&id=<?= $tour['id'] ?>"
                        class="btn btn-sm btn-danger"
                        onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>

            </tr>
        <?php endforeach; ?>
    </tbody>

</table>
<script>
    document.querySelectorAll('.view-more').forEach(btn => {
        btn.addEventListener('click', function() {
            const fullText = this.previousElementSibling.dataset.full;
            alert(fullText); // ✅ đơn giản
        });
    });
</script>