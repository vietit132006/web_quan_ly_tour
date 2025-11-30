<?php include PATH_VIEW . "layout/header.php"; ?>

<div class="container mt-4">
    <h2 class="mb-3">Thêm Nhà Cung Cấp</h2>

    <form action="index.php?action=supplier_store" method="POST">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tên nhà cung cấp</label>
                <input name="name" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Loại nhà cung cấp</label>
                <input name="type" class="form-control" placeholder="Ví dụ: Restaurant, Transport...">
            </div>

            <div class="col-md-6 mb-3">
                <label>Người liên hệ</label>
                <input name="contact_person" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Số điện thoại</label>
                <input name="phone" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Địa chỉ</label>
                <input name="address" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Số hợp đồng</label>
                <input name="contract_number" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Bắt đầu hợp đồng</label>
                <input type="date" name="contract_start" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Kết thúc hợp đồng</label>
                <input type="date" name="contract_end" class="form-control">
            </div>

            <div class="col-md-3 mb-3">
                <label>Đánh giá (1 - 5)</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" value="5">
            </div>

            <div class="col-md-12 mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"></textarea>
            </div>
        </div>

        <button class="btn btn-success">✔ Lưu</button>
        <a href="index.php?action=supplier" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<?php include PATH_VIEW . "layout/footer.php"; ?>
