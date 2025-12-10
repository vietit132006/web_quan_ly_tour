<!doctype html>
<html lang="vi" class="h-full">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản Lý Tour Du Lịch</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


  <style>
    body {
      box-sizing: border-box;
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