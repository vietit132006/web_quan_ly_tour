<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thêm nhà cung cấp</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="col-md-8 col-lg-6">

            <div class="card shadow-sm">
                <div class="card-body">

                    <h4 class="text-center mb-4 fw-bold text-primary">
                        Thêm nhà cung cấp
                    </h4>

                    <form action="index.php?action=nhacungcap_store" method="POST">

                        <div class="mb-3">
                            <label class="form-label">Tên NCC</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Loại</label>
                            <input type="text" name="type" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Người liên hệ</label>
                            <input type="text" name="contact_person" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Điện thoại</label>
                            <input type="text" name="phone" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ</label>
                            <input type="text" name="address" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số hợp đồng</label>
                            <input type="text" name="contract_number" class="form-control">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày bắt đầu</label>
                                <input type="date" name="contract_start" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Ngày kết thúc</label>
                                <input type="date" name="contract_end" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Đánh giá</label>
                            <input type="number" name="rating" class="form-control" min="1" max="5">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Ghi chú</label>
                            <textarea name="note" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">
                                Lưu nhà cung cấp
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <a href="index.php?action=nhacungcap" class="text-decoration-none">
                            ← Quay lại danh sách
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>