<?php
// $tourguides được truyền từ Controller
?>

<div class="container mt-4">
    <h2 class="mb-3">Quản lý Hướng dẫn viên</h2>

    <!-- Nút thêm HDV -->
    <a href="index.php?action=HDV_add" class="btn btn-success mb-3">Thêm HDV</a>

    <table class="table table-bordered table-hover">
        <thead class="thead-light">
            <tr>
                <th>#</th>
                <th>Ảnh</th>
                <th>Họ và tên</th>
                <th>Email</th>
                <th>SĐT</th>
                <th>Kinh nghiệm (năm)</th>
                <th>Ngôn ngữ</th>
                <th>Phân loại</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($tourguides)): ?>
                <?php foreach ($tourguides as $index => $guide): ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td>
                            <?php if (!empty($guide['avata_id'])): ?>
                                <img src="public/uploads/<?= htmlspecialchars($guide['avata_id']) ?>"
                                    alt="Avatar" width="50" height="50" class="rounded-circle">
                            <?php else: ?>
                                <span class="text-muted">Chưa có</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($guide['full_name']) ?></td>
                        <td><?= htmlspecialchars($guide['email']) ?></td>
                        <td><?= htmlspecialchars($guide['guide_phone'] ?? 'Chưa có') ?></td>
                        <td><?= htmlspecialchars($guide['experience_years'] ?? 0) ?></td>
                        <td><?= htmlspecialchars($guide['language'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($guide['classify'] ?? '-') ?></td>
                        <td>
                            <?php if (($guide['guide_status'] ?? 0) == 1): ?>
                                <span class="badge bg-success">Hoạt động</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Không hoạt động</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="index.php?action=HDV_edit&id=<?= $guide['guide_id'] ?>" class="btn btn-primary btn-sm">Sửa</a>
                            <a href="index.php?action=HDV_delete&id=<?= $guide['guide_id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa HDV này?');">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center">Chưa có hướng dẫn viên nào</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- CSS cơ bản -->
<style>
    .table img {
        object-fit: cover;
    }

    .badge {
        font-size: 0.85em;
    }
</style>