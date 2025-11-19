<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Booking Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9fdf8;
            font-family: 'Poppins', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            width: 80px;
            height: 100vh;
            background-color: #fff;
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
            font-size: 20px;
            margin: 20px 0;
            text-decoration: none;
            transition: .3s;
        }

        .sidebar a.active,
        .sidebar a:hover {
            color: #00a86b;
        }

        /* Topbar */
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
        }

        .search-bar input {
            background: #f2f6f4;
            border: none;
            border-radius: 20px;
            padding: 6px 12px;
            outline: none;
            width: 220px;
        }

        .content {
            margin-left: 110px;
            margin-top: 80px;
            padding: 20px;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    
  <div class="sidebar">
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"><i class="bi bi-list"></i></a>
    <a href="index.php?action=/" data-bs-toggle="tooltip" data-bs-placement="right" title="Bảng điều khiển"><i class="bi bi-house-door"></i></a>
    <a href="index.php?action=booking" class="active" data-bs-toggle="tooltip" data-bs-placement="right" title="Quản lý Tour"><i class="bi bi-calendar-check"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Báo cáo"><i class="bi bi-graph-up"></i></a>
    <a href="index.php?action=users-roles" data-bs-toggle="tooltip" data-bs-placement="right" title="admin/editer"><i class="bi bi-person"></i></a>
    <a href="#" data-bs-toggle="tooltip" data-bs-placement="right" title="Cài đặt"><i class="bi bi-gear"></i></a>
  </div>

    <!-- Topbar -->
    <div class="topbar">
        <div class="search-bar">
            <input type="text" placeholder="Search...">
        </div>

        <div class="top-icons">
            <i class="bi bi-sun"></i>
            <i class="bi bi-bell"></i>
            <i class="bi bi-chat-dots"></i>
            <img src="https://i.pravatar.cc/40" class="rounded-circle">
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        <div class="container-fluid">
            <h3 class="fw-bold mb-4">Booking Tour</h3>

            <div class="row">
                <!-- FORM BOOKING -->
                <div class="col-md-7">
                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold mb-3">📝 Booking Information</h5>

                        <div class="mb-3">
                            <label class="form-label">Select Tour</label>
                            <select id="tour" class="form-select">
                                <option value="124">The Great Wall of China – $124</option>
                                <option value="140">Taj Mahal – $140</option>
                                <option value="560">Niagara Falls – $560</option>
                                <option value="200">Great Barrier Reef – $200</option>
                                <option value="900">Pyramid – $900</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control" id="date_in">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" class="form-control" id="date_out">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adults</label>
                                <input type="number" class="form-control" id="adult" value="1" min="1">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children</label>
                                <input type="number" class="form-control" id="child" value="0" min="0">
                            </div>
                        </div>

                        <h5 class="fw-bold mt-4 mb-3">👤 Guest Information</h5>

                        <input type="text" id="name" class="form-control mb-3" placeholder="Full Name">
                        <input type="email" id="email" class="form-control mb-3" placeholder="Email">
                        <input type="text" id="phone" class="form-control mb-3" placeholder="Phone Number">

                        <button class="btn btn-success w-100 fw-bold" onclick="calculateTotal()">Calculate Total</button>
                    </div>
                </div>

                <!-- SUMMARY -->
                <div class="col-md-5">
                    <div class="card p-4 mb-4">
                        <h5 class="fw-bold mb-3">📌 Booking Summary</h5>

                        <p><strong>Tour Price:</strong> $<span id="price">0</span></p>
                        <p><strong>Adults:</strong> <span id="sum_adult">0</span></p>
                        <p><strong>Children (50%):</strong> <span id="sum_child">0</span></p>

                        <hr>
                        <h4 class="fw-bold">Total: $<span id="total">0</span></h4>

                        <button class="btn btn-primary mt-3 w-100 fw-bold">Confirm Booking</button>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function calculateTotal() {
            let price = parseInt(document.getElementById("tour").value);
            let adult = parseInt(document.getElementById("adult").value);
            let child = parseInt(document.getElementById("child").value);

            let total = (price * adult) + (price * 0.5 * child);

            document.getElementById("price").innerText = price;
            document.getElementById("sum_adult").innerText = adult;
            document.getElementById("sum_child").innerText = child;

            document.getElementById("total").innerText = total.toFixed(2);
        }
    </script>

</body>

</html>