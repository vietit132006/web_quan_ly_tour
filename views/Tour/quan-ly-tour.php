    <?php
    $isEdit = !empty($editTour);
    $formAction = $isEdit
        ? "index.php?action=tour-update&id={$editTour['id']}"
        : "index.php?action=tour-store";
    ?>
    <style>
        /* ======================== GLOBAL LAYOUT ======================== */
        #tour-page .layout-wrapper {
            display: flex;
            gap: 28px;
            margin-top: 24px;
        }

        /* ======================== FILTER CARD ======================== */
        #tour-page .filter-card {
            width: 180px;
            flex-shrink: 0;
        }

        /* ===================== FORM 2 CỘT ======================= */
        #tour-page .form-2col {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px 28px;
        }

        #tour-page .form-full {
            grid-column: span 2;
        }

        /* ======================== CARD STYLE ======================== */
        #tour-page .card {
            border-radius: 14px;
            background: #ffffff;
            border: none;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.07);
            overflow: hidden;
            transition: 0.25s ease;
        }

        #tour-page .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(0, 0, 0, 0.09);
        }

        /* ======================== CARD HEADER ======================== */
        #tour-page .card-header {
            background: linear-gradient(135deg, #10b981, #0d8f6e);
            color: #ffffff;
            font-size: 19px;
            font-weight: 600;
            padding: 18px 24px;
            letter-spacing: 0.4px;
        }

        /* ======================== CARD BODY ======================== */
        #tour-page .card-body {
            padding: 26px;
        }

        /* ======================== LABEL ======================== */
        #tour-page .card-body label {
            font-size: 14px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 6px;
        }

        /* ======================== INPUTS ======================== */
        #tour-page .form-control,
        #tour-page .form-select {
            border-radius: 12px;
            padding: 12px 14px;
            font-size: 14px;
            border: 1px solid #cbd5e1;
            background: #f8fafc;
            transition: all 0.25s ease;
        }

        #tour-page .form-control:focus,
        #tour-page .form-select:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.25);
            background: #fff;
        }

        /* Textarea */
        #tour-page textarea.form-control {
            min-height: 130px;
            resize: vertical;
        }

        /* ======================== BUTTONS ======================== */
        #tour-page .btn-success {
            background: linear-gradient(135deg, #10b981, #0d8f6e);
            border: none !important;
            border-radius: 12px;
            padding: 10px 26px;
            font-weight: 600;
            transition: 0.2s ease;
        }

        #tour-page .btn-success:hover {
            opacity: 0.9;
        }

        #tour-page .btn-secondary {
            border-radius: 12px;
            padding: 10px 22px;
        }

        /* ======================== TABLE DESCRIPTION ======================== */
        #tour-page .description-short {
            max-width: 260px;
            font-size: 14px;
            color: #475569;
        }

        /* "Xem thêm" */
        #tour-page .view-more {
            margin-left: 6px;
            font-size: 13px;
            color: #0ea5e9;
            transition: 0.2s ease;
        }

        #tour-page .view-more:hover {
            text-decoration: underline;
            color: #0284c7;
        }

        /* ======================== IMAGE STYLE ======================== */
        #tour-page .tour-img {
            width: 110px;
            height: 82px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            transition: 0.25s ease;
        }

        #tour-page .tour-img:hover {
            transform: scale(1.03);
        }

        #tour-page .description-short {
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 260px;
            font-size: 14px;
            color: #334155;
            line-height: 1.4;
        }

        #tour-page .description-empty {
            font-style: italic;
            color: #94a3b8;
            font-size: 14px;
            opacity: 0.8;
        }

        #tour-page .description-short {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        #tour-page .description-empty {
            font-style: italic;
            color: #94a3b8;
            font-size: 14px;
            opacity: 0.8;
        }

        /* RESET ẢNH HƯỞNG TỪ BOOTSTRAP */
        .sidebar a,
        .sidebar .menu-item {
            display: flex !important;
            align-items: center !important;
            gap: 12px;
            padding: 12px 18px !important;
            text-decoration: none !important;
            color: #2c3e50 !important;
            font-size: 16px;
            border-radius: 10px;
        }

        /* ICON luôn canh giữa */
        .sidebar i,
        .sidebar svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ITEM ĐƯỢC CHỌN */
        .sidebar .active {
            background: #e6fbff !important;
            color: #008cba !important;
            font-weight: 600;
            position: relative;
        }

        /* GẠCH ĐỨNG BÊN TRÁI */
        .sidebar .active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 8px;
            bottom: 8px;
            width: 4px;
            background: #0099cc;
            border-radius: 10px;
        }

        /* KHOẢNG CÁCH CÁC MỤC */
        .sidebar .menu-group {
            padding: 6px 0;
        }
    </style>


    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" data-scope="tour-page">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <div id="tour-page">
        <!-- ======================== FORM THÊM / SỬA ======================== -->
        <div class="card mb-4">
            <div class="card-header">
                <?= $isEdit ? 'Cập nhật tour' : 'Thêm tour mới' ?>
            </div>

            <div class="card-body">

                <form method="post" action="<?= $formAction ?>" class="form-2col">

                    <!-- Tên tour -->
                    <div>
                        <label class="fw-bold">Tên tour</label>
                        <input type="text" name="name" class="form-control" required
                            value="<?= $editTour['name'] ?? '' ?>">
                    </div>

                    <!-- Giá -->
                    <div>
                        <label class="fw-bold">Giá</label>
                        <input type="number" name="base_price" class="form-control" required
                            value="<?= $editTour['base_price'] ?? '' ?>">
                    </div>

                    <!-- Số ngày -->
                    <div>
                        <label class="fw-bold">Số ngày</label>
                        <input type="number" name="duration" class="form-control" required
                            value="<?= $editTour['duration'] ?? '' ?>">
                    </div>

                    <!-- Số người -->
                    <div>
                        <label class="fw-bold">Số người</label>
                        <input type="number" name="so_nguoi" class="form-control"
                            min="7" max="30" required
                            value="<?= $editTour['so_nguoi'] ?? '' ?>">
                    </div>

                    <!-- Trạng thái -->
                    <div>
                        <label class="fw-bold">Trạng thái</label>
                        <select name="status" class="form-select">
                            <option value="1" <?= (($editTour['status'] ?? 1) == 1) ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="2" <?= (($editTour['status'] ?? '') == 2) ? 'selected' : '' ?>>Đã dừng</option>
                            <option value="3" <?= (($editTour['status'] ?? '') == 3) ? 'selected' : '' ?>>Bảo trì</option>
                        </select>
                    </div>

                    <!-- Danh mục -->
                    <div>
                        <label class="fw-bold">Danh mục</label>
                        <select name="tour_category_id" class="form-select">
                            <option value="1" <?= (($editTour['tour_category_id'] ?? '') == 1) ? 'selected' : '' ?>>Trong nước</option>
                            <option value="2" <?= (($editTour['tour_category_id'] ?? '') == 2) ? 'selected' : '' ?>>Ngoài nước</option>
                            <option value="3" <?= (($editTour['tour_category_id'] ?? '') == 3) ? 'selected' : '' ?>>Mạo hiểm</option>
                        </select>
                    </div>

                    <!-- Ảnh -->
                    <div>
                        <label class="fw-bold">Ảnh</label>
                        <input type="text" name="image" class="form-control"
                            value="<?= $editTour['image'] ?? '' ?>">
                    </div>

                    <!-- Mô tả (FULL WIDTH) -->
                    <div class="form-full">
                        <label class="fw-bold">Mô tả</label>
                        <textarea name="description" class="form-control"><?= $editTour['description'] ?? '' ?></textarea>
                    </div>

                    <!-- Nút -->
                    <div class="form-full mt-2">
                        <button class="btn btn-success"><?= $isEdit ? 'Cập nhật' : 'Thêm tour' ?></button>

                        <?php if ($isEdit): ?>
                            <a href="index.php?action=tours" class="btn btn-secondary ms-2">Hủy</a>
                        <?php endif; ?>
                    </div>

                </form>
            </div>
        </div>




        <!-- ======================== LAYOUT DƯỚI: LỌC + BẢNG ======================== -->
        <div class="layout-wrapper">

            <!-- ======== FORM LỌC (TRÁI) ======== -->
            <div class="filter-card card">
                <div class="card-body">

                    <form method="get" action="index.php">
                        <input type="hidden" name="action" value="tours">

                        <div class="mb-3">
                            <label class="fw-bold">Tìm tour</label>
                            <input type="text" name="keyword" class="form-control"
                                value="<?= $_GET['keyword'] ?? '' ?>" placeholder="Nhập tên tour...">
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Danh mục</label>
                            <select name="category" class="form-select">
                                <option value="">-- Tất cả --</option>
                                <option value="1" <?= ($_GET['category'] ?? '') == 1 ? 'selected' : '' ?>>Trong nước</option>
                                <option value="2" <?= ($_GET['category'] ?? '') == 2 ? 'selected' : '' ?>>Ngoài nước</option>
                                <option value="3" <?= ($_GET['category'] ?? '') == 3 ? 'selected' : '' ?>>Mạo hiểm</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="fw-bold">Khoảng giá</label>
                            <select name="price" class="form-select">
                                <option value="">-- Tất cả --</option>
                                <option value="1" <?= ($_GET['price'] ?? '') == 1 ? 'selected' : '' ?>>Dưới 5 triệu</option>
                                <option value="2" <?= ($_GET['price'] ?? '') == 2 ? 'selected' : '' ?>>5 - 10 triệu</option>
                                <option value="3" <?= ($_GET['price'] ?? '') == 3 ? 'selected' : '' ?>>Trên 10 triệu</option>
                            </select>
                        </div>

                        <button class="btn btn-success w-100">
                            <i class="bi bi-search"></i> Lọc
                        </button>
                    </form>

                </div>
            </div>


            <!-- ======== BẢNG TOUR (PHẢI) ======== -->
            <div class="table-wrapper">

                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>ID</th>
                            <th>Ảnh</th>
                            <th>Tour</th>
                            <th>Giá</th>
                            <th>Thời gian</th>
                            <th>Mô tả</th>
                            <th>Số người</th>
                            <th>Trạng thái</th>
                            <th>Tạo lúc</th>
                            <th>Danh mục</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>

                                <td class="text-center"><?= $tour['id'] ?></td>

                                <td class="text-center">
                                    <?php if (!empty($tour['image'])): ?>
                                        <img src="<?= htmlspecialchars($tour['image']) ?>" class="tour-img">
                                    <?php else: ?><span class="text-muted">No Image</span><?php endif; ?>
                                </td>

                                <td><?= $tour['name'] ?></td>

                                <td><?= number_format($tour['base_price'], 0, ',', '.') ?> VNĐ</td>

                                <td>
                                    <?= (int)$tour['duration'] ?> ngày <?= max((int)$tour['duration'] - 1, 0) ?> đêm
                                </td>

                                <td>
                                    <?php if (empty(trim($tour['description']))): ?>
                                        <span class="text-muted">Trống...</span>
                                    <?php else: ?>
                                        <span class="description-short"
                                            data-full="<?= htmlspecialchars($tour['description']) ?>">
                                            <?= htmlspecialchars($tour['description']) ?>
                                        </span>
                                        <span class="view-more">Xem thêm</span>
                                    <?php endif; ?>
                                </td>

                                <td><?= $tour['so_nguoi'] ?></td>

                                <?php $statusText = [1 => 'Hoạt động', 2 => 'Đã dừng', 3 => 'Bảo trì']; ?>
                                <td><?= $statusText[$tour['status']] ?? '—' ?></td>

                                <td><?= date('d/m/Y H:i', strtotime($tour['created_at'])) ?></td>

                                <?php $cateText = [1 => 'Trong nước', 2 => 'Ngoài nước', 3 => 'Mạo hiểm']; ?>
                                <td><?= $cateText[$tour['tour_category_id']] ?? '—' ?></td>

                                <!-- Hành động -->
                                <td class="text-center">
                                    <a href="index.php?action=tours&id_edit=<?= $tour['id'] ?>"
                                        class="btn btn-sm btn-warning"><i class="bi bi-pencil"></i></a>

                                    <a onclick="return confirm('Bạn có chắc muốn xoá?')"
                                        href="index.php?action=tour-delete&id=<?= $tour['id'] ?>"
                                        class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </tbody>

                </table>

            </div>

        </div>
    </div>

    <script>
        document.querySelectorAll('.view-more').forEach(btn => {
            btn.addEventListener('click', function() {
                alert(this.previousElementSibling.dataset.full);
            });
        });
    </script>