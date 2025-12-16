<style>
    
/* ===========================
   🌐 THEME – NHÀ CUNG CẤP (ADD)
=========================== */
:root {
    --primary: #06a3c9;
    --primary-dark: #008bb0;
    --text-dark: #2c3e50;
    --bg-card: #ffffff;
    --bg-hover: #eefaff;
    --radius: 14px;
    --radius-sm: 10px;
    --shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    --transition: all 0.25s ease;
}

/* ===========================
   📦 FORM WRAPPER
=========================== */
.ncc-content {
    max-width: 1000px;
    margin: 30px auto;
    background: var(--bg-card);
    padding: 28px;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
}

.ncc-content h3 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 20px;
    color: var(--primary);
}

/* ===========================
   🏷 LABEL & INPUT
=========================== */
.ncc-label {
    font-size: 13px;
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 6px;
    display: block;
}

.ncc-input {
    width: 100%;
    padding: 11px 14px;
    border-radius: var(--radius-sm);
    border: 1px solid #e1e6ef;
    font-size: 14px;
    transition: var(--transition);
    background: #fff;
}

.ncc-input:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(6, 163, 201, 0.15);
}

textarea.ncc-input {
    resize: vertical;
}

/* ===========================
   🎛 BUTTONS
=========================== */
.ncc-add-btn {
    background: var(--primary);
    border: none;
    padding: 10px 22px;
    border-radius: var(--radius-sm);
    font-weight: 600;
    color: #fff;
    box-shadow: var(--shadow);
    transition: var(--transition);
}

.ncc-add-btn:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
}

.ncc-btn-cancel {
    padding: 10px 22px;
    border-radius: var(--radius-sm);
    background: #eef1f5;
    color: var(--text-dark);
    text-decoration: none;
    font-weight: 600;
    transition: var(--transition);
}

.ncc-btn-cancel:hover {
    background: #dfe4ea;
}
</style>
<!-- Bootstrap CSS -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
  rel="stylesheet"
>

<!-- Bootstrap Icons -->
<link
  href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"
  rel="stylesheet"
>
<!-- CSS riêng cho Quản lý Nhà Cung Cấp -->
<link rel="stylesheet" href="assets/css/nhacungcap.css">


<div class="ncc-content">
    <h3>Thêm nhà cung cấp</h3>

    <form action="index.php?action=nhacungcap_store" method="POST">
        <div class="row g-3">

            <div class="col-md-6">
                <label class="ncc-label">Tên NCC</label>
                <input type="text" name="name" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Loại</label>
                <input type="text" name="type" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Người liên hệ</label>
                <input type="text" name="contact_person" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Điện thoại</label>
                <input type="text" name="phone" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Email</label>
                <input type="email" name="email" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Địa chỉ</label>
                <input type="text" name="address" class="ncc-input">
            </div>

            <div class="col-md-6">
                <label class="ncc-label">Số hợp đồng</label>
                <input type="text" name="contract_number" class="ncc-input">
            </div>

            <div class="col-md-3">
                <label class="ncc-label">Ngày bắt đầu</label>
                <input type="date" name="contract_start" class="ncc-input">
            </div>

            <div class="col-md-3">
                <label class="ncc-label">Ngày kết thúc</label>
                <input type="date" name="contract_end" class="ncc-input">
            </div>

            <div class="col-md-3">
                <label class="ncc-label">Đánh giá</label>
                <input type="number" name="rating" class="ncc-input">
            </div>

            <div class="col-12">
                <label class="ncc-label">Ghi chú</label>
                <textarea name="note" class="ncc-input" rows="3"></textarea>
            </div>

            <div class="col-12 d-flex gap-3 mt-3">
                <button type="submit" class="ncc-add-btn">
                    💾 Lưu
                </button>

                <a href="index.php?action=nhacungcap" class="ncc-btn-cancel">
                    ⬅ Quay lại
                </a>
            </div>

        </div>
    </form>
</div>
