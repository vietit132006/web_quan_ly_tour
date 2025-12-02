<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Quản lý Tour</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">


<header class="bg-blue-600 text-white p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold">Quản lý Lịch Khởi Hành & Phân bổ Nhân sự</h1>
    <div>Admin | <a href="#" class="underline">Đăng xuất</a></div>
</header>

<div class="flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-screen p-4">
        <nav class="space-y-3">
            <a href="#" class="block p-2 rounded hover:bg-blue-100">Dashboard</a>
            <a href="#" class="block p-2 rounded hover:bg-blue-100">Tours</a>
            <a href="#" class="block p-2 rounded hover:bg-blue-100">Groups</a>
            <a href="#" class="block p-2 rounded hover:bg-blue-100">Services</a>
            <a href="#" class="block p-2 rounded hover:bg-blue-100">Assigned Tours</a>
        </nav>
    </aside>

    <!-- Content -->
    <main class="flex-1 p-6">
        <h2 class="text-2xl font-semibold mb-4">Danh sách đoàn khách</h2>

        <!-- Filter -->
        <div class="mb-4 flex gap-2">
            <input type="date" class="border rounded p-2" placeholder="Từ ngày">
            <input type="date" class="border rounded p-2" placeholder="Đến ngày">
            <select class="border rounded p-2">
                <option value="">Chọn tour</option>
                <option value="1">Tour Đà Lạt 3N2Đ</option>
                <option value="2">Tour Nha Trang 2N1Đ</option>
            </select>
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Lọc</button>
        </div>

        <!-- Table danh sách đoàn -->
        <div class="overflow-x-auto bg-white shadow rounded">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">#</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tên đoàn</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tour</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Ngày khởi hành</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Số khách</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Trạng thái</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Hướng dẫn viên</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Dịch vụ</th>
                        <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Hành động</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2">1</td>
                        <td class="px-4 py-2">Đoàn VIP</td>
                        <td class="px-4 py-2">Tour Đà Lạt 3N2Đ</td>
                        <td class="px-4 py-2">15/11/2025</td>
                        <td class="px-4 py-2">20</td>
                        <td class="px-4 py-2 text-green-600 font-semibold">Scheduled</td>
                        <td class="px-4 py-2">
                            <select class="border rounded p-1">
                                <option value="">Chọn HDV</option>
                                <option value="1">Nguyễn Văn A</option>
                                <option value="2">Trần Thị B</option>
                            </select>
                        </td>
                        <td class="px-4 py-2">
                            <button class="bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600">Quản lý dịch vụ</button>
                        </td>
                        <td class="px-4 py-2">
                            <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">Chi tiết</button>
                        </td>
                    </tr>
                    <!-- Thêm nhiều dòng khác -->
                </tbody>
            </table>
        </div>
    </main>
</div>

</body>
</html>
