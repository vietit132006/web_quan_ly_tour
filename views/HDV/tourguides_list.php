<h2>Danh sách hướng dẫn viên</h2>

<a href="index.php?action=HDV_add" class="btn btn-primary">+ Thêm hướng dẫn viên</a>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>ID</th>
        <th>Họ tên</th>
        <th>Email</th>
        <th>Avatar</th>
        <th>Năm kinh nghiệm</th>
        <th>Ngôn ngữ</th>
        <th>Loại</th>
        <th>Trạng thái</th>
    </tr>

    <?php if (!empty($tourguides)): ?>
        <?php foreach ($tourguides as $tg): ?>
            <tr>
                <td><?= $tg['id'] ?></td>
                <td><?= $tg['user_full_name'] ?></td>
                <td><?= $tg['user_email'] ?></td>

                <td>
                    <?php if (!empty($tg['avata_id'])): ?>
                        <img src="<?= $tg['avata_id'] ?>" width="70" height="70">
                    <?php else: ?>
                        Không có ảnh
                    <?php endif; ?>
                </td>

                <td><?= $tg['experience_years'] ?></td>
                <td><?= $tg['language'] ?></td>
                <td><?= $tg['classify'] ?></td>

                <td><?= $tg['status'] == 1 ? "Hoạt động" : "Tạm dừng" ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">Không có dữ liệu</td>
        </tr>
    <?php endif; ?>

</table>