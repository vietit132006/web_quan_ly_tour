<h3>📋 Chi tiết phiên điểm danh</h3>

<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Khách</th>
            <th>SĐT</th>
            <th>Trạng thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($details as $d): ?>
            <tr>
                <td><?= $d['name'] ?></td>
                <td><?= $d['phone'] ?></td>
                <td>
                    <?php if ($d['status']): ?>
                        <span class="badge bg-success">Có mặt</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Vắng mặt</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="javascript:history.back()" class="btn btn-secondary mt-3">
    ⬅ Quay lại
</a>