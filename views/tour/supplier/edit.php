<?php include PATH_VIEW . "layout/header.php"; ?>

<div class="container mt-4">
    <h2 class="mb-3">Sửa Nhà Cung Cấp</h2>

    <form action="index.php?action=nhacungcap_update" method="POST">

        <input type="hidden" name="id" value="<?= $supplier['id'] ?>">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tên nhà cung cấp</label>
                <input name="name" class="form-control" value="<?= $supplier['name'] ?>" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Loại nhà cung cấp</label>
                <input name="type" class="form-control" value="<?= $supplier['type'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Người liên hệ</label>
                <input name="contact_person" class="form-control" value="<?= $supplier['contact_person'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Số điện thoại</label>
                <input name="phone" class="form-control" value="<?= $supplier['phone'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input name="email" type="email" class="form-control" value="<?= $supplier['email'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Địa chỉ</label>
                <input name="address" class="form-control" value="<?= $supplier['address'] ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label>Số hợp đồng</label>
                <input name="contract_number" class="form-control" value="<?= $supplier['contract_number'] ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label>Bắt đầu hợp đồng</label>
                <input type="date" name="contract_start" class="form-control" value="<?= $supplier['contract_start'] ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label>Kết thúc hợp đồng</label>
                <input type="date" name="contract_end" class="form-control" value="<?= $supplier['contract_end'] ?>">
            </div>

            <div class="col-md-3 mb-3">
                <label>Đánh giá (1 - 5)</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" value="<?= $supplier['rating'] ?>">
            </div>

            <div class="col-md-12 mb-3">
                <label>Ghi chú</label>
                <textarea name="note" class="form-control" rows="3"><?= $supplier['note'] ?></textarea>
            </div>
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-success px-4">Cập nhật</button>
            <a href="index.php?action=nhacungcap" class="btn btn-secondary px-4">Quay lại</a>
        </div>
    </form>
</div>

<?php include PATH_VIEW . "layout/footer.php"; ?>