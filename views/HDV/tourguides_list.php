
<h2>Danh sách hướng dẫn viên</h2>

<a href="index.php?action=HDV_add" class="btn btn-primary">+ Thêm hướng dẫn viên</a>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Avatar</th>
        <th>Điện thoại</th>
        <th>Kinh nghiệm</th>
        <th>Ngôn ngữ</th>
        <th>Phân loại</th>
        <th>Trạng thái</th>
    </tr>

    <?php if (!empty($tourguides)): ?>
        <?php foreach ($tourguides as $tg): ?>
            <tr>
                <td><?= $tg['guide_id'] ?></td>
                <td><?= $tg['full_name'] ?></td>
                <td><?= $tg['email'] ?></td>

                <td>
                    <?php if (!empty($tg['avata_id'])): ?>
                        <img src="public/uploads/<?= $tg['avata_id'] ?>" width="60">
                    <?php else: ?>
                        Không có ảnh
                    <?php endif; ?>
                </td>

                <td><?= $tg['phone'] ?></td>
                <td><?= $tg['experience_years'] ?></td>
                <td><?= $tg['language'] ?></td>
                <td><?= $tg['classify'] ?></td>

                <td>
                    <?= $tg['status'] == 1 ? 'Hoạt động' : 'Tạm dừng' ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="9" align="center">Không có dữ liệu</td>
        </tr>
    <?php endif; ?>
</table>
