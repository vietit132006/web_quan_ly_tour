<header class="fixed top-0 left-0 right-0 h-16 bg-cyan-600 text-white flex items-center justify-between px-6 shadow-md z-40">

  <!-- Logo -->
  <div class="flex items-center space-x-4">
    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
    </svg>
    <h1 class="text-xl font-bold">TravelPro</h1>
  </div>

  <!-- Search + notification + user -->
  <div class="flex items-center space-x-6">

    <!-- Search -->
    <div class="hidden md:flex items-center space-x-2 px-4 py-2 rounded-lg bg-white bg-opacity-20">
      <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
      <input type="text" placeholder="Tìm kiếm..." class="bg-transparent border-none outline-none w-48 placeholder-gray-400 text-white">
    </div>

    <!-- Notification -->
    <button class="relative p-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
      </svg>
      <span class="notification-badge absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
    </button>

    <!-- User -->
    <!-- User -->
    <div class="relative">
      <button id="user-button"
        class="flex items-center space-x-3 p-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition focus:outline-none">

        <div class="w-9 h-9 rounded-full bg-white bg-opacity-20 flex items-center justify-center font-semibold">
          NA
        </div>

        <div class="hidden md:block text-left">
          <div class="text-sm font-semibold">Nguyễn Văn A</div>
          <div class="text-xs opacity-80">Quản Trị Viên</div>
        </div>

        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M19 9l-7 7-7-7" />
        </svg>
      </button>

      <!-- MENU DROPDOWN -->
      <div id="user-menu"
        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg border border-gray-200 hidden z-50">

        <div class="px-4 py-3 border-b">
          <div class="font-semibold text-sm text-gray-800">Nguyễn Văn A</div>
          <div class="text-xs text-gray-500">admin@travelpro.com</div>
        </div>

        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Hồ sơ
        </a>

        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
          Cài đặt
        </a>

        <form action="index.php?action=logout" method="POST">
          <button type="submit"
            class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 border-t">
            Đăng xuất
          </button>
        </form>
      </div>
    </div>


  </div>
</header>
<script>
  const userBtn = document.getElementById('user-button');
  const userMenu = document.getElementById('user-menu');

  userBtn.addEventListener('click', (e) => {
    e.stopPropagation();
    userMenu.classList.toggle('hidden');
  });

  document.addEventListener('click', () => {
    userMenu.classList.add('hidden');
  });
</script>