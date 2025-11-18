<?php

// Thêm / Cập nhật nhóm
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = $_POST['id'] ?? time();
    $group = [
        'id' => $id,
        'group_name' => $_POST['group_name'],
        'tour_name' => $_POST['tour_name'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'number_guests' => $_POST['number_guests'],
        'guide_id' => $_POST['guide_id'] ?? '',
        'services' => $_POST['services'] ?? []
    ];

    $updated = false;
    foreach ($_SESSION['groups'] as &$g) {
        if ($g['id'] == $id) {
            $g = $group;
            $updated = true;
            break;
        }
    }
    unset($g);

    if(!$updated){
        $_SESSION['groups'][]=$group;
    }

    header('Location: schedule.php');
    exit;
}

// Xóa nhóm
if(isset($_GET['delete'])){
    $id=$_GET['delete'];
    $_SESSION['groups']=array_filter($_SESSION['groups'], fn($g)=>$g['id']!=$id);
    header('Location: schedule.php');
    exit;
}

$groups = $tour_group;
$services = $services;
$guides = $guides;

?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Quản lý Lịch Khởi Hành & Phân Bổ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 80px;
            height: 100%;
            background: #fff;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid #eee;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding-top: 10px;
        }

        .sidebar a {
            color: #555;
            text-decoration: none;
            font-size: 20px;
            margin: 20px 0;
            transition: 0.3s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            color: #00a86b;
        }

        .topbar {
            position: fixed;
            left: 80px;
            right: 0;
            top: 0;
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 100;
        }

        .search-bar input {
            border: none;
            background: #f2f6f4;
            padding: 6px 12px;
            border-radius: 20px;
            outline: none;
            width: 220px;
        }

        .top-icons i {
            font-size: 20px;
            color: #555;
            margin-left: 20px;
            cursor: pointer;
        }

        .top-icons img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            margin-left: 20px;
        }

        .content {
            margin-left: 100px;
            margin-top: 80px;
            padding: 20px;
            min-height: calc(100% - 80px);
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
            border: none;
        }
    </style>
</head>

<body>

    <div class="sidebar">
        <a href="#"><i class="bi bi-list"></i></a>
        <a href="index.php?action=/"><i class="bi bi-house-door"></i></a>
        <a href="index.php?action=booking"><i class="bi bi-calendar-check"></i></a>
        <a href="index.php?action=manage" class="active"><i class="bi bi-kanban"></i></a>
        <a href="#"><i class="bi bi-person"></i></a>
        <a href="#"><i class="bi bi-gear"></i></a>
    </div>



    <main class="content">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h4 class="fw-bold">Quản lý Lịch Khởi Hành & Phân Bổ</h4>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupModal">
                    <i class="bi bi-plus-circle me-2"></i> Thêm Đoàn
                </button>
            </div>

            <div class="card p-3">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr>
                                <th>Đoàn</th>
                                <th>Tour</th>
                                <th>Ngày khởi hành</th>
                                <th>Ngày kết thúc</th>
                                <th>Tour kéo dài</th>
                                <th>Giờ khởi hành</th>
                                <th>Số khách</th>
                                <th>Hướng dẫn viên</th>
                                <th>Dịch vụ</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="groupTableBody">
                            <?php if (empty($tour_group)): ?>
                                <tr>
                                    <td colspan="8" class="text-center">Chưa có đoàn nào</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($tour_group as $tg): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($tg['id']) ?></td>
                                        <td><?= htmlspecialchars($tg['tour_name']) ?></td>
                                        <td><?= htmlspecialchars($tg['start_date']) ?></td>
                                        <td><?= htmlspecialchars($tg['end_date']) ?></td>
                                        <td><?= htmlspecialchars($tg['total_days']) ?> ngày</td>
                                        <td><?= htmlspecialchars($tg['departure_time']) ?></td>
                                        <td><?= htmlspecialchars($tg['number_guests']) ?></td>
                                        <td>
                                            <select class="form-select form-select-sm">
                                                <option value="">Chọn HDV</option>

                                                <?php foreach ($users as $u): ?>
                                                    <option value="<?= $u['id'] ?>">
                                                        <?= htmlspecialchars($u['full_name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        <td><?= htmlspecialchars($tg['service_name']) ?></td>


                                        </td>


                                        <td>
                                            <?php
                                            $sNames = array_map(fn($sid) => $services[$sid - 1]['name'], $g['services'] ?? []);
                                            echo implode(', ', $sNames);
                                            ?>
                                        </td>
                                        <td>
                                            <a href="#addGroupModal" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                onclick="fillForm('<?= $g['id'] ?>')"><i class="bi bi-pencil"></i></a>
                                            <a href="?delete=<?= $g['id'] ?>" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Thêm -->
    <div class="modal fade" id="addGroupModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="groupForm">
                    <div class="modal-header">
                        <h5 class="modal-title">Thêm</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="groupId">
                        <div class="mb-3"><label>Đoàn</label><input type="text" name="id" id="id" class="form-control" required></div>
                        <div class="mb-3"><label>Tour</label><input type="text" name="tour_name" id="tourName" class="form-control" required></div>
                        <div class="mb-3"><label>Ngày khởi hành</label><input type="date" name="start_date" id="startDate" class="form-control" required></div>
                        <div class="mb-3"><label>Ngày kết thúc</label><input type="date" name="end_date" id="endDate" class="form-control" required></div>
                        <div class="mb-3"><label>Tour kéo dài</label><input type="number" name="end_date" id="endDate" class="form-control" required></div>
                        <div class="mb-3"><label>Giờ khởi hành</label><input type="time" name="end_date" id="endDate" class="form-control" required></div>
                        <div class="mb-3"><label>Số khách</label><input type="number" name="number_guests" id="numberGuests" class="form-control" min="1" required></div>
                        <div class="mb-3">
                            <label>Hướng dẫn viên</label>
                            <select name="guide_id" id="guideId" class="form-select">
                                <option value="<?= $u['user_id'] ?>">Chọn HDV</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Dịch vụ</label>
                            <select name="guide_id" id="guideId" class="form-select">
                                <option value="<?= $u['user_id'] ?>">Chọn HDV</option>
                            </select>
                        </div>

                        <?php foreach ($tour_group as $tg): ?>
                            <tr>
                                <td><?= htmlspecialchars($tg['id']) ?></td>
                                <td><?= htmlspecialchars($tg['tour_name']) ?></td>
                                <td><?= htmlspecialchars($tg['start_date']) ?></td>
                                <td><?= htmlspecialchars($tg['end_date']) ?></td>
                                <td><?= htmlspecialchars($tg['total_days']) ?> ngày</td>
                                <td><?= htmlspecialchars($tg['departure_time']) ?></td>
                                <td><?= htmlspecialchars($tg['number_guests']) ?></td>

                                <td>
                                    <?php foreach ($users as $u): ?>
                                         <option value="<?= $u['id'] ?>">
                                                        <?= htmlspecialchars($u['full_name']) ?>
                                                    </option>
                                    <?php endforeach; ?>
                                </td>                                                
                                <td>
                                    <?php
                                    $sNames = array_map(
                                        fn($sid) => $services[$sid - 1]['name'],
                                        $tg['services'] ?? []
                                    );
                                    echo implode(', ', $sNames);
                                    ?>
                                </td>

                                <td>
                                    <a href="#addGroupModal" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                        onclick="fillForm('<?= $tg['id'] ?>')"><i class="bi bi-pencil"></i></a>

                                    <a href="?delete=<?= $tg['id'] ?>" class="btn btn-outline-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
                    <script>
                        // Điền form khi sửa
                        function fillForm(id) {
                            const groups = <?php echo json_encode($groups); ?>;
                            const g = groups.find(x => x.id == id);
                            if (!g) return;
                            document.getElementById('groupId').value = g.id;
                            document.getElementById('groupName').value = g.group_name;
                            document.getElementById('tourName').value = g.tour_name;
                            document.getElementById('startDate').value = g.start_date;
                            document.getElementById('endDate').value = g.end_date;
                            document.getElementById('numberGuests').value = g.number_guests;
                            document.getElementById('guideId').value = g.guide_id;
                            const options = document.getElementById('services').options;
                            for (let i = 0; i < options.length; i++) {
                                options[i].selected = g.services?.includes(parseInt(options[i].value)) || false;
                            }
                        }
                    </script>

</body>

</html>
<script>
    document.querySelector('#groupForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('manage.php?action=save_group', {
                method: 'POST',
                body: formData
            })
            .then(res => res.text())
            .then(data => {
                alert("Thêm đoàn thành công!");
                location.reload();
            })
            .catch(err => console.log(err));
    });
</script>
