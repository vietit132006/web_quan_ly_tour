<!doctype html>
<html lang="vi" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản Lý Tour Du Lịch</title>
  <script src="https://cdn.tailwindcss.com"></script>


<<<<<<< HEAD
  /* BODY */
  body {
    background-color: #f9fdf8;
    font-family: 'Poppins', sans-serif;
  }

  /* ========== SIDEBAR ========== */
  .sidebar {
    width: 85px;
    height: 100vh;
    background: #2a0436;
    position: fixed;
    top: 0;
    left: 0;
    border-right: 1px solid #3b064b;
    display: flex;
    flex-direction: column;
    padding-top: 15px;
    z-index: 200;
    transition: width 0.3s ease;
    overflow: hidden;
  }

  .sidebar:hover {
    width: 220px;
  }

  .sidebar a {
    color: #e8d8ff;
    text-decoration: none;
    font-size: 18px;
    padding: 12px 15px;
    border-radius: 12px;
    margin: 6px 10px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: 0.25s;
    white-space: nowrap;
  }

  .sidebar a i {
    font-size: 22px;
  }

  .sidebar a:hover {
    background: #5e0b8a;
    color: #fff;
  }

  .sidebar a.active {
    background: #8d15cc;
    color: #fff;
    box-shadow: 0 0 10px rgba(141, 21, 204, 0.6);
  }

  /* Ẩn text khi thu gọn */
  .sidebar:not(:hover) span {
    opacity: 0;
    width: 0;
  }

  /* ========== TOPBAR ========== */
  .topbar {
    position: fixed;
    top: 0;
    left: 85px;
    right: 0;
    height: 60px;
    background: #2a0436;
    border-bottom: 1px solid #3b064b;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
    z-index: 150;
    transition: left 0.3s;
  }

  /* Khi sidebar mở */
  /* .sidebar:hover~.topbar {
    left: 220px;
  } */

  .search-bar input {
    background-color: #3c0a4d;
    border: none;
    padding: 8px 14px;
    border-radius: 20px;
    outline: none;
    width: 220px;
    color: #fff;
  }

  .top-icons i {
    font-size: 20px;
    color: #e8d8ff;
    margin-left: 18px;
    cursor: pointer;
  }

  .top-icons i:hover {
    color: #fff;
  }

  /* ========== CONTENT ========== */
  .content {
    margin-left: 100px;
    margin-top: 80px;
    padding: 20px;
    transition: margin-left 0.3s;
  }

  /* .sidebar:hover~.content {
    margin-left: 235px;
  } */

  /* ========== TABLE ========== */
  .table thead th {
    background-color: #ececec;
    font-weight: 600;
  }

  /* ========== BUTTON ACTION ========== */
  .action-btns a {
    margin-right: 8px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
  }

  .btn-edit {
    color: #0d6efd;
  }

  .btn-delete {
    color: #dc3545;
  }

  /* ========== FORM MODAL ========== */
  .form-container {
    background: #fff;
    border-radius: 12px;
    padding: 2rem;
  }

  /* GRID FORM */
  .form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  /* FULL WIDTH */
  .form-group.full {
    grid-column: 1 / -1;
  }

  /* LABEL */
  .form-group label {
    font-weight: 500;
    font-size: 14px;
    margin-bottom: 6px;
  }

  /* INPUT / SELECT (OVERRIDE BOOTSTRAP) */
  .form-group input,
  .form-group select {
    width: 100%;
    padding: 10px 12px;
    font-size: 14px;
    border-radius: 6px;
    border: 1px solid #dce4ec;
    outline: none;
  }

  .form-group input:focus,
  .form-group select:focus {
    border-color: #5dade2;
    box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.15);
  }

  /* DAY DISPLAY */
  .day-display {
    grid-column: 1 / -1;
    font-weight: 600;
    margin: 8px 0;
  }

  /* SUBMIT BUTTON */
  .submit-button {
    margin-top: 20px;
    width: 100%;
    padding: 12px;
    background: #5dade2;
    border: none;
    color: #fff;
    font-size: 16px;
    border-radius: 8px;
    cursor: pointer;
  }

  .submit-button:hover {
    background: #3498db;
  }

  /* RESPONSIVE */
  @media (max-width: 768px) {
    .form-grid {
      grid-template-columns: 1fr;
=======
  <style>
    body {
      box-sizing: border-box;
>>>>>>> master
    }

    /* TOPBAR */
    .user-menu {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      margin-top: 8px;
      min-width: 200px;
      background: white;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
      overflow: hidden;
      z-index: 50;
    }

    .user-menu.show {
      display: block;
    }

    .user-menu-item {
      padding: 12px 16px;
      cursor: pointer;
      transition: background 0.2s;
    }

    .user-menu-item:hover {
      background: #f3f4f6;
    }

    .notification-badge {
      animation: pulse 2s infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 1;
      }

      50% {
        opacity: .7;
      }
    }

    /* SIDEBAR */
    .sidebar-link {
      transition: all 0.2s ease;
    }

    .sidebar-link:hover {
      transform: translateX(4px);
    }

    .sidebar-link.active {
      position: relative;
    }

    .sidebar-link.active::before {
      content: '';
      position: absolute;
      left: 0;
      top: 0;
      bottom: 0;
      width: 4px;
      background: #0891b2;
      border-radius: 0 4px 4px 0;
    }
  </style>
</head>

<body class="h-full">
  <div class="w-full h-full overflow-auto">