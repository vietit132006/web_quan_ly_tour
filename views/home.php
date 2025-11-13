<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Travel Dashboard</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f9fdf8;
      font-family: 'Poppins', sans-serif;
    }

    /* Sidebar trái */
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
      text-decoration: none;
      font-size: 20px;
      margin: 20px 0;
      transition: 0.3s;
    }

    .sidebar a:hover,
    .sidebar a.active {
      color: #00a86b;
    }

    /* Thanh trên cùng */
    .topbar {
      position: fixed;
      left: 80px;
      right: 0;
      top: 0;
      height: 60px;
      background-color: #fff;
      border-bottom: 1px solid #eee;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 20px;
      z-index: 100;
    }

    .search-bar input {
      border: none;
      background-color: #f2f6f4;
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

    /* Nội dung chính */
    .content {
      margin-left: 100px;
      margin-top: 80px;
      padding: 20px;
    }

    .card {
      border-radius: 15px;
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
    }

    .hotel-card img {
      width: 100%;
      height: 160px;
      border-radius: 15px;
      object-fit: cover;
    }

    .badge-lux {
      background-color: #ffca28;
      color: #000;
    }

    .badge-pent {
      background-color: #1976d2;
    }

    .badge-plus {
      background-color: #00bfa5;
    }
  </style>
</head>

<body>

  <!-- Sidebar trái -->
  <div class="sidebar">
    <a href="#"><i class="bi bi-list"></i></a>
    <a href="#" class="active"><i class="bi bi-house-door"></i></a>
    <a href="#"><i class="bi bi-graph-up"></i></a>
    <a href="#"><i class="bi bi-person"></i></a>
    <a href="#"><i class="bi bi-gear"></i></a>
  </div>

  <!-- Thanh công cụ trên cùng -->
  <div class="topbar">
    <div class="search-bar">
      <input type="text" placeholder="Search...">
    </div>
    <div class="top-icons">
      <i class="bi bi-sun"></i>
      <i class="bi bi-bell"></i>
      <i class="bi bi-chat-dots"></i>
      <img src="https://i.pravatar.cc/40" alt="User">
    </div>
  </div>

  <!-- Nội dung chính -->
  <div class="content">
    <div class="container-fluid">
      <h4 class="mb-4 fw-bold">Travel History</h4>
      <div class="row text-center mb-4">
        <div class="col-md-4">
          <div class="card p-3">
            <h6>Total Profit</h6>
            <h3>52,329</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h6>Total Revenue</h6>
            <h3>78,200</h3>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card p-3">
            <h6>Total Visitors</h6>
            <h3>22,500</h3>
          </div>
        </div>
      </div>

      <!-- Travel Table -->
      <div class="card p-3 mb-4">
        <table class="table align-middle">
          <thead>
            <tr>
              <th>Tour</th>
              <th>Country</th>
              <th>Nights</th>
              <th>From</th>
              <th>To</th>
              <th>Adult</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $tours = [
              ["The great wall of China", "China", 5, "10 Jan 2023", "16 Jan 2023", 2, "$124"],
              ["Taj Mahal", "India", 4, "8 Dec 2023", "21 Dec 2023", 2, "$140"],
              ["Niagara Falls", "Canada", 12, "11 Dec 2023", "11 Dec 2023", 5, "$560"],
              ["Great Barrier Reef", "Italy", 3, "22 Dec 2023", "25 Dec 2023", 2, "$200"],
              ["Pyramid", "Greek", 4, "24 Dec 2023", "28 Dec 2023", 3, "$900"]
            ];
            foreach ($tours as $tour) {
              echo "<tr>
                      <td>{$tour[0]}</td>
                      <td>{$tour[1]}</td>
                      <td>{$tour[2]} Night</td>
                      <td>{$tour[3]}</td>
                      <td>{$tour[4]}</td>
                      <td>{$tour[5]} Adult</td>
                      <td>{$tour[6]}</td>
                    </tr>";
            }
            ?>
          </tbody>
        </table>
      </div>

      <!-- Top Hotels -->
      <h4 class="mb-3 fw-bold">Top Hotels</h4>
      <div class="row">
        <?php
        $hotels = [
          ["Billas hotel&Motel", "img/h1.jpg", "LUX", "$62/day", "4.8", "2 BEDS | 3 ADULT"],
          ["Taj Hotel", "img/h2.jpg", "LUX", "$78/day", "4.6", "2 BEDS | 2 ADULT"],
          ["The great wall of China", "img/h3.jpg", "PENTHOUSE", "$102/day", "4.2", "3 BEDS | 6 ADULT"],
          ["Elite Hotel", "img/h4.jpg", "PLUS", "$92/day", "4.1", "1 BED | 2 ADULT"],
        ];
        foreach ($hotels as $h) {
          $badgeClass = strtolower($h[2]) == 'lux' ? 'badge-lux' : (strtolower($h[2]) == 'penthouse' ? 'badge-pent' : 'badge-plus');
          echo "
          <div class='col-md-3 mb-4'>
            <div class='card p-2 hotel-card'>
              <img src='{$h[1]}' alt='{$h[0]}'>
              <div class='p-2'>
                <h6 class='fw-bold'>{$h[0]}</h6>
                <span class='badge $badgeClass'>{$h[2]}</span>
                <p class='small mt-2 text-muted'>{$h[5]}</p>
                <div class='d-flex justify-content-between'>
                  <span class='fw-bold'>{$h[3]}</span>
                  <span class='text-warning'>★ {$h[4]}</span>
                </div>
              </div>
            </div>
          </div>";
        }
        ?>
      </div>
    </div>
  </div>

</body>

</html>