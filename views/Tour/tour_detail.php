<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Chi tiết tour</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        #tour-detail-page .card {
            border-radius: 14px;
            border: none;
            background: #ffffff;
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.08);
        }

        #tour-detail-page .card-header {
            background: linear-gradient(135deg, #10b981, #0d8f6e);
            color: #fff;
            padding: 20px 26px;
            font-size: 22px;
            font-weight: 600;
            border-radius: 14px 14px 0 0;
        }

        #tour-detail-page .tour-img {
            width: 100%;
            border-radius: 14px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.12);
        }

        #tour-detail-page .section-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 14px;
            color: #0f172a;
        }

        #tour-detail-page .itinerary-item {
            padding: 16px;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            margin-bottom: 14px;
        }

        #tour-detail-page .itinerary-item h4 {
            color: #0d9488;
            font-size: 18px;
            font-weight: 700;
        }

        #tour-detail-page p {
            font-size: 15px;
            color: #334155;
        }

        #tour-detail-page .price-tag {
            font-size: 22px;
            font-weight: 700;
            color: #059669;
        }

        #tour-detail-page .price-original {
            text-decoration: line-through;
            color: #94a3b8;
        }
    </style>
</head>

<body class="p-4">
    <div id="tour-detail-page" class="container">

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <button class="btn btn-light btn-sm" onclick="history.back()">
                    ⬅ Quay lại
                </button>

                <span><?= $tour['name'] ?></span>
            </div>

            <div class="card-body">

                <div class="row mb-4">

                    <!-- Ảnh phụ hoặc ảnh chính -->
                    <div class="col-md-6">

                        <?php if (!empty($images) && count($images) > 0): ?>
                            <!-- Slider hiển thị các ảnh phụ -->
                            <div id="tourSlider" class="carousel slide mb-3" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    <?php foreach ($images as $i => $img): ?>
                                        <div class="carousel-item <?= $i == 0 ? 'active' : '' ?>">
                                            <img src="<?= BASE_URL . 'assets/uploads/' . $img['image'] ?>"
                                                class="d-block w-100 rounded"
                                                style="max-height:420px; object-fit:cover;">
                                        </div>
                                    <?php endforeach; ?>
                                </div>

                                <button class="carousel-control-prev" type="button" data-bs-target="#tourSlider" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#tourSlider" data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>

                        <?php else: ?>
                            <!-- Nếu chưa có ảnh phụ → dùng ảnh chính -->
                            <img src="<?= BASE_URL . 'assets/uploads/' . $tour['image'] ?>" class="tour-img">
                        <?php endif; ?>

                    </div>

                    <!-- Thông tin tour -->
                    <div class="col-md-6">
                        <h3 class="section-title">Thông tin tour</h3>

                        <p>
                            <strong>Giá gốc:</strong>
                            <span class="price-original"><?= number_format($tour['base_price']) ?>đ</span>
                        </p>

                        <?php if (!empty($tour['promo_price'])): ?>
                            <p>
                                <strong>Giá khuyến mãi:</strong>
                                <span class="price-tag"><?= number_format($tour['promo_price']) ?>đ</span>
                            </p>
                        <?php endif; ?>

                        <p><strong>Điểm đi:</strong> <?= $tour['diem_di'] ?></p>
                        <p><strong>Điểm đến:</strong> <?= $tour['diem_den'] ?></p>
                        <p><strong>Phương tiện:</strong> <?= $tour['phuong_tien'] ?></p>

                        <p><strong>Mô tả:</strong></p>
                        <div><?= nl2br($tour['description']) ?></div>
                    </div>
                </div>

                <hr>

                <!-- Lịch trình -->
                <h3 class="section-title mt-4">Lịch trình chi tiết</h3>

                <?php if (!empty($itineraries)): ?>
                    <?php foreach ($itineraries as $item): ?>
                        <div class="itinerary-item">
                            <h4>Ngày <?= $item['day_number'] ?> — <?= $item['title'] ?></h4>
                            <p><?= nl2br($item['content']) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted fst-italic">Chưa có lịch trình.</p>
                <?php endif; ?>

            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>