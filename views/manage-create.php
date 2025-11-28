<!doctype html>
<html lang="vi">
 <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Quản lý Tour</title>
  <style>
        body {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f0f4f8;
            min-height: 100%;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .form-container {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 2.5rem;
            max-width: 600px;
            width: 100%;
        }

        .form-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-header h1 {
            color: #2c3e50;
            font-size: 1.75rem;
            font-weight: 600;
            margin: 0 0 0.5rem 0;
        }

        .form-header p {
            color: #7f8c8d;
            font-size: 0.9rem;
            margin: 0;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.25rem;
            margin-bottom: 1.25rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            color: #34495e;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        input {
            padding: 0.75rem;
            border: 1px solid #dce4ec;
            border-radius: 6px;
            font-size: 0.9rem;
            transition: all 0.2s ease;
            background: #ffffff;
            color: #2c3e50;
        }

        input::placeholder {
            color: #95a5a6;
        }

        input:focus {
            outline: none;
            border-color: #5dade2;
            box-shadow: 0 0 0 3px rgba(93, 173, 226, 0.1);
        }

        input:hover {
            border-color: #aeb6bf;
        }

        .submit-button {
            width: 100%;
            padding: 0.875rem;
            background: #5dade2;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-top: 0.75rem;
        }

        .submit-button:hover {
            background: #3498db;
        }

        .submit-button:active {
            transform: scale(0.98);
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-container {
                padding: 2rem 1.5rem;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }
        }
    </style>
  <style>@view-transition { navigation: auto; }</style>
  <script src="/_sdk/data_sdk.js" type="text/javascript"></script>
  <script src="/_sdk/element_sdk.js" type="text/javascript"></script>
  <script src="https://cdn.tailwindcss.com" type="text/javascript"></script>
 </head>
 <body>
  <main>
   <div class="form-container">
    <header class="form-header">
     <h1>Quản lý Tour</h1>
     <p>Vui lòng điền thông tin tour</p>
    </header>
    <form action="/manage/store" method="POST">
     <div class="form-grid">
      <div class="form-group"><label for="stt">STT</label> <input type="number" id="stt" name="stt" required min="1">
      </div>
      <div class="form-group"><label for="tour_name">Tour</label> <input type="text" id="tour_name" name="tour_id" required placeholder="Nhập tên tour">
      </div>
      <div class="form-group"><label for="start_date">Ngày bắt đầu</label> <input type="date" id="start_date" name="start_date" required>
      </div>
      <div class="form-group"><label for="end_date">Ngày kết thúc</label> <input type="date" id="end_date" name="end_date" required>
      </div>
      <div class="form-group"><label for="number_guests">Số khách</label> <input type="number" id="number_guests" name="number_guests" required min="1" placeholder="0">
      </div>
      <div class="form-group"><label for="total_days">Tổng ngày</label> <input type="number" id="total_days" name="total_days" required min="1" placeholder="0">
      </div>
      <div class="form-group"><label for="guide_name">Hướng dẫn viên</label> <input type="text" id="guide_name" name="guide_name" required placeholder="Tên hướng dẫn viên">
      </div>
      <div class="form-group"><label for="departure_time">Giờ khởi hành</label> <input type="time" id="departure_time" name="departure_time" required>
      </div>
      <div class="form-group full-width"><label for="service_list">Dịch vụ</label> <input type="text" id="service_list" name="service_list" required placeholder="Nhập các dịch vụ">
      </div>
     </div><button type="submit" class="submit-button">Thêm</button>
    </form>
   </div>
  </main>
 <script>(function(){function c(){var b=a.contentDocument||a.contentWindow.document;if(b){var d=b.createElement('script');d.innerHTML="window.__CF$cv$params={r:'9a542e77d006e656',t:'MTc2NDI3MzMxMC4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";b.getElementsByTagName('head')[0].appendChild(d)}}if(document.body){var a=document.createElement('iframe');a.height=1;a.width=1;a.style.position='absolute';a.style.top=0;a.style.left=0;a.style.border='none';a.style.visibility='hidden';document.body.appendChild(a);if('loading'!==document.readyState)c();else if(window.addEventListener)document.addEventListener('DOMContentLoaded',c);else{var e=document.onreadystatechange||function(){};document.onreadystatechange=function(b){e(b);'loading'!==document.readyState&&(document.onreadystatechange=e,c())}}}})();</script></body>
</html>