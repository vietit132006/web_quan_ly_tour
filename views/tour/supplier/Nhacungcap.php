<?php ob_start(); ?>

    <!-- CONTENT -->
    <div class="content">

        <div class="container mt-4">
            <h3 class="mb-3">Danh Sách Nhà Cung Cấp</h3>
            <a href="index.php?action=nhacungcap_add">thêm nhà cung cấp</a>

            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Loại</th>
                        <th>Người liên hệ</th>
                        <th>SĐT</th>
                        <th>Email</th>
                        <th>Địa chỉ</th>
                        <th>Số hợp đồng</th>
                        <th>Bắt đầu</th>
                        <th>Kết thúc</th>
                        <th>Đánh giá</th>
                        <th>Ghi chú</th>
                        <th>Ngày tạo</th>
                        <th>Hành động</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($suppliers)): ?>
                        <?php foreach ($suppliers as $item): ?>
                            <tr>
                                <td><?= $item['id'] ?></td>
                                <td><?= $item['name'] ?></td>
                                <td><?= $item['type'] ?></td>
                                <td><?= $item['contact_person'] ?></td>
                                <td><?= $item['phone'] ?></td>
                                <td><?= $item['email'] ?></td>
                                <td><?= $item['address'] ?></td>
                                <td><?= $item['contract_number'] ?></td>
                                <td><?= $item['contract_start'] ?></td>
                                <td><?= $item['contract_end'] ?></td>
                                <td><?= $item['rating'] ?></td>
                                <td><?= $item['note'] ?></td>
                                <td><?= $item['created_at'] ?></td>
                                <td>
                                    <a href="index.php?action=nhacungcap_edit&id=<?= $item['id'] ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="index.php?action=nhacungcap_delete&id=<?= $item['id'] ?>"
                                        class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete role ID: <?= $item['id'] ?>?');" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="13" class="text-center">Không có dữ liệu nhà cung cấp.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>


    </div>
<?php $content = ob_get_clean(); ?>
<?php include PATH_VIEW . 'layout/master.php'; ?>