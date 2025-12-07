-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 07, 2025 at 05:28 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tour_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tour`
--

CREATE TABLE `assigned_tour` (
  `id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `group_id` int DEFAULT NULL,
  `guide_id` int DEFAULT NULL,
  `itinerary_id` int DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `daily_activities` text COLLATE utf8mb4_unicode_ci,
  `mission` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int NOT NULL,
  `history` datetime DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `payment_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `history`, `tour_id`, `payment_status`) VALUES
(1, '2025-11-01 18:29:54', 5, 'Đang sử lý'),
(2, '2025-11-02 18:29:54', 7, 'Thanh toán hoàn tất');

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `id` int NOT NULL,
  `time` datetime DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stage` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notee` text COLLATE utf8mb4_unicode_ci,
  `booking_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `check_in_point`
--

CREATE TABLE `check_in_point` (
  `id` int NOT NULL,
  `group_id` int DEFAULT NULL,
  `itinerary_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `check_in_time` datetime DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `developments`
--

CREATE TABLE `developments` (
  `id` int NOT NULL,
  `assigned_tour_id` int DEFAULT NULL,
  `guide_id` int DEFAULT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `outstanding` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `problem` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `group_service`
--

CREATE TABLE `group_service` (
  `id` int NOT NULL,
  `group_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `date_use` date DEFAULT NULL,
  `note_` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE `guest` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `identification` bigint DEFAULT NULL,
  `request` text COLLATE utf8mb4_unicode_ci,
  `booking_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`id`, `name`, `age`, `date_birth`, `phone`, `sex`, `email`, `address`, `identification`, `request`, `booking_id`) VALUES
(1, 'Nguyễn Đức Việt', 20, '2006-07-12', '12345678', 'Nam', 'ducv@gmail.com', 'Ba Vì', 12333648958, 'Đồ ăn phải ngon, dịch vụ phải tốt', 2),
(2, 'Lê Minh Quân ', 19, '2006-11-09', '123455723', 'Nam', 'quan@gmail.com', 'Hà Nội', 2334747477485, 'Cảnh đẹp, đồ ăn ngon', 2),
(3, 'Nguyễn Kiêm Hiếu', 17, '2008-11-12', '0982454312', 'Nam', 'hieu@gmail.com', 'Linh Đàm', 2347474747, 'Chỗ ngồi đầu tiên vì dễ say xe', 1),
(4, 'Nguyễn Văn Hải', 21, '2005-11-05', '03585858585885', 'Nam', 'hai@gmail.com', 'Thạch Thất', 4848844884, 'Chỗ ngồi gần cửa sổ ', 2);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`, `address`, `lat`, `lng`, `phone`, `note`) VALUES
(1, 'Tháp Eiffel', 'Pháp', 2.29500000, 48.85800000, '1234567890', 'Tháp Eiffel (tiếng Pháp: Tour Eiffel) là một công trình kiến trúc bằng thép nằm trên công viên Champ-de-Mars, cạnh sông Seine, thủ đô Paris nước Pháp. Vốn có tên nguyên thủy là Tháp 300 mét (Tour de 300 mètres), công trình này do kỹ sư Gustave Eiffel và các đồng nghiệp của mình thiết kế và xây dựng từ năm 1887 tới năm 1889 nhân dịp Triển lãm thế giới năm 1889, và cũng là dịp kỷ niệm 100 năm Cách mạng Pháp.'),
(2, 'Vịnh Hạ Long', 'Hạ Long', 5.74700000, 37.75700000, '09876123665', 'Vịnh Hạ Long là vùng biển đảo có khí hậu phân hóa 2 mùa rõ rệt: mùa hạ nóng ẩm với nhiệt độ khoảng 27-29 °C và mùa đông khô lạnh với nhiệt độ 16-18 °C, nhiệt độ trung bình năm dao động trong khoảng 15-25 °C. Lượng mưa trên vịnh Hạ Long vào khoảng từ 2.000 mm–2.200 mm[14] tuy có tài liệu chi tiết hóa lượng mưa là 1.680 mm với khoảng trên 300 mm vào mùa nóng nhất trong năm (từ tháng 6 đến tháng 8) và dưới 30 mm vào mùa khô');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Admin', 'Quản trị viên hệ thống', '2025-11-13 17:01:44'),
(2, 'Guide', 'Hướng dẫn viên du lịch', '2025-11-13 17:01:44'),
(3, 'Manager', 'Quản lý tour', '2025-11-13 17:01:44'),
(4, 'Admin', 'Quản trị viên hệ thống', '2025-11-13 17:02:34'),
(5, 'Guide', 'Hướng dẫn viên du lịch', '2025-11-13 17:02:34'),
(6, 'Manager', 'Quản lý tour', '2025-11-13 17:02:34');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_id` int DEFAULT NULL,
  `price` decimal(15,2) DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `name`, `type`, `supplier_id`, `price`, `description`, `status`) VALUES
(1, 'Khách sạn 5 sao', 'Restaurant', 2, 8000000.00, NULL, 1),
(2, 'Xe 45 chỗ', 'Transport', 1, 9000000.00, 'đhdhdhd', 1),
(3, 'HOTEL', 'Restaurant', 1, 1319000000.00, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_start` date DEFAULT NULL,
  `contract_end` date DEFAULT NULL,
  `rating` int DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `type`, `contact_person`, `phone`, `email`, `address`, `contract_number`, `contract_start`, `contract_end`, `rating`, `note`, `created_at`) VALUES
(1, 'Quý Đức', 'Restaurant', 'Đức Việt', '1234567822', 'quyduc@gamil.com', 'Nguyễn Quý Đức 1', '0993384844885', '2025-11-01', '2025-11-30', 5, NULL, '2025-11-14 03:26:53'),
(2, 'Đoàn Xuân', 'Transport', 'Văn Đức', '09876123666', 'duc@gmail.com', 'Suối hai', '09494994948585', '2025-11-06', '2025-11-28', 5, NULL, '2025-11-14 03:26:53');

-- --------------------------------------------------------

--
-- Table structure for table `tours`
--

CREATE TABLE `tours` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `base_price` decimal(15,2) DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(1) DEFAULT '1',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `tour_category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tours`
--

INSERT INTO `tours` (`id`, `name`, `base_price`, `duration`, `description`, `status`, `created_at`, `tour_category_id`) VALUES
(5, 'Ba Vi·', 2000000.00, 5, '1. Vị trí và địa lý\n\nNằm ở phía Tây Hà Nội, thuộc địa bàn các huyện Ba Vì, Thạch Thất và Quốc Oai.\n\nKhu vực Ba Vì có nhiều núi cao, rừng nguyên sinh, thác nước và suối mát.\n\nNúi Ba Vì gồm 3 đỉnh chính: Vua, Tản Viên, Ngọc Hoa, trong đó đỉnh Tản Viên được coi là cao nhất (khoảng 1.296 m).', 1, '2025-11-13 18:27:14', 1),
(6, 'Hạ Long ', 4500000.00, 6, NULL, 2, '2025-11-05 03:08:46', 1),
(7, 'Paris', 30000000.00, 8, 'Paris (phát âm tiếng Pháp: [paʁi]) là thủ đô và là thành phố đông dân nhất nước Pháp, cũng là một trong ba thành phố phát triển kinh tế nhanh nhất thế giới cùng Luân Đôn với New York và là một trung tâm hành chính của vùng Île-de-France với dân số ước tính là 2.165.423 người tính đến năm 2019, trên diện tích hơn 105,4 km2', 2, '2025-11-11 03:08:46', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tour_category`
--

CREATE TABLE `tour_category` (
  `id` int NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `describe` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_category`
--

INSERT INTO `tour_category` (`id`, `name`, `describe`) VALUES
(1, 'Trong nước', 'Trong nước'),
(2, 'Ngoài nước', 'Ngoài nước');

-- --------------------------------------------------------

--
-- Table structure for table `tour_finance`
--

CREATE TABLE `tour_finance` (
  `id` int NOT NULL,
  `tour_id` int NOT NULL,
  `total_revenue` decimal(15,2) DEFAULT '0.00',
  `total_cost` decimal(15,2) DEFAULT '0.00',
  `profit` decimal(15,2) GENERATED ALWAYS AS ((`total_revenue` - `total_cost`)) STORED,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_finance`
--

INSERT INTO `tour_finance` (`id`, `tour_id`, `total_revenue`, `total_cost`, `note`, `created_at`, `updated_at`) VALUES
(1, 5, 1000000.00, 500000.00, NULL, '2025-11-15 14:34:16', '2025-11-15 14:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `tour_group`
--

CREATE TABLE `tour_group` (
  `id` int NOT NULL,
  `booking_id` int DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `total_days` int DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number_guests` int DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tour_id` int DEFAULT NULL,
  `service_id` int NOT NULL DEFAULT '0',
  `guide_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_group`
--

INSERT INTO `tour_group` (`id`, `booking_id`, `start_date`, `end_date`, `total_days`, `departure_time`, `address`, `number_guests`, `status`, `note`, `tour_id`, `service_id`, `guide_id`) VALUES
(8, NULL, '2025-12-04', '2025-12-04', 1, '17:45:00', NULL, 2, NULL, NULL, 7, 0, 3),
(9, NULL, '2025-12-04', '2025-12-04', 1, '05:44:00', NULL, 1, NULL, NULL, 5, 0, 6),
(10, NULL, '2025-12-04', '2025-12-27', 24, '05:50:00', NULL, 10, NULL, NULL, 5, 0, 6),
(11, NULL, '2025-12-02', '2025-12-05', 3, '05:53:00', NULL, 4, NULL, NULL, 5, 0, 3),
(20, NULL, '2025-12-02', '2025-12-19', 0, '22:44:00', NULL, 10, NULL, NULL, 7, 0, 6),
(21, NULL, '2025-12-04', '2025-12-20', 0, '23:43:00', NULL, 13, NULL, NULL, 5, 0, 6),
(24, NULL, '2025-12-04', '2025-12-12', 0, '13:32:00', NULL, 8, NULL, NULL, 5, 0, 6),
(27, NULL, '2025-12-07', '2025-12-08', 2, '00:21:00', NULL, 1, NULL, NULL, 5, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tour_group_service`
--

CREATE TABLE `tour_group_service` (
  `id` int NOT NULL,
  `tour_group_id` int NOT NULL,
  `service_id` int DEFAULT NULL,
  `status` tinyint DEFAULT '1',
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_group_service`
--

INSERT INTO `tour_group_service` (`id`, `tour_group_id`, `service_id`, `status`, `note`) VALUES
(35, 9, 1, 1, NULL),
(36, 10, 2, 1, NULL),
(47, 20, 1, 1, NULL),
(50, 11, 1, 1, NULL),
(55, 21, 1, 1, NULL),
(57, 24, 1, 1, NULL),
(64, 8, 1, 1, NULL),
(65, 27, 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tour_guides`
--

CREATE TABLE `tour_guides` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `date_birth` date DEFAULT NULL,
  `avata_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `history` datetime DEFAULT NULL,
  `evaluate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `health` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `certificate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `license_expiry` date DEFAULT NULL,
  `experience_years` int DEFAULT NULL,
  `language` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classify` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_guides`
--

INSERT INTO `tour_guides` (`id`, `user_id`, `date_birth`, `avata_id`, `phone`, `history`, `evaluate`, `health`, `certificate`, `license_number`, `license_expiry`, `experience_years`, `language`, `classify`, `status`) VALUES
(3, 1, '2005-11-10', 'https://www.nydailynews.com/wp-content/uploads/migration/2022/08/31/CD3QKSRIXRF35A2TZA66YKFH4E.jpg', '123456799', '2025-11-07 14:00:23', 'Quản lý tốt, có kỹ năng làm việc tốt, biết 2 ngôn ngữ.', 'Good', 'Ielts 10.', '8338mk', '2025-12-31', 2, 'Tiếng Anh', 'Nội địa', 1),
(4, 2, '2006-11-10', 'https://s.yimg.com/zb/imgv1/222f339f-4261-39ca-b191-d710abdd7f15/t_500x300', '09876123661', '2025-11-15 14:00:23', 'Quản lý tốt, có kỹ năng làm việc tốt, biết 2 ngôn ngữ.', 'Good', 'Ielts 10.', '7575hp', '2025-12-31', 3, 'Tiếng Hàn', 'Ngoài nước', 1),
(6, 5, '2005-11-10', 'https://studiochupanhdep.com/Upload/Images/Album/anh-cv-02.jpg', '1234567890', '2025-11-01 18:29:54', '10 điểm không có nhưng', 'Good', 'toic9.0', 'Chứng nhận cấp tiểu', '2025-11-12', 2, 'Ba lan', 'Ngoài nước', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tour_guide_assignments`
--

CREATE TABLE `tour_guide_assignments` (
  `id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `guide_id` int DEFAULT NULL,
  `assigned_date` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tour_itinerary`
--

CREATE TABLE `tour_itinerary` (
  `id` int NOT NULL,
  `tour_id` int DEFAULT NULL,
  `location_id` int DEFAULT NULL,
  `stop_order` int DEFAULT NULL,
  `day` int DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci,
  `is_meeting_point` tinyint(1) DEFAULT '0',
  `is_dropoff_point` tinyint(1) DEFAULT '0',
  `note` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_itinerary`
--

INSERT INTO `tour_itinerary` (`id`, `tour_id`, `location_id`, `stop_order`, `day`, `arrival_time`, `departure_time`, `activity`, `is_meeting_point`, `is_dropoff_point`, `note`) VALUES
(2, 6, 2, 3, 2, '12:30:19', '20:57:35', 'mô tả hoạt động ở điểm này\r\n', 1, 4, NULL),
(3, 7, 1, 5, 1, '11:57:35', '39:57:35', 'hdhhđhdh', 1, 5, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT '1',
  `last_login` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `full_name`, `email`, `phone`, `role_id`, `avatar`, `status`, `last_login`, `created_at`) VALUES
(1, 'admin1', 'passhash1', 'Nguyen Van A', 'admin1@example.com', '0909000001', 1, NULL, 1, NULL, '2025-11-13 17:01:44'),
(2, 'guide1', 'passhash2', 'Tran Thi B', 'guide1@example.com', '0909000002', 2, NULL, 1, NULL, '2025-11-13 17:01:44'),
(3, 'manager1', 'passhash3', 'Le Van C', 'manager1@example.com', '0909000003', 3, NULL, 1, NULL, '2025-11-13 17:01:44'),
(5, 'nguyenducv2006', '123456', 'Nguyễn Đức Việt', 'nguyenducv2006@gmail.com', '0987654113', 2, 'https://i.pinimg.com/originals/50/c6/87/50c6876ae5a56958f0df8740f724a67e.jpg', 2, '2025-11-20 12:02:58', '2025-11-21 12:02:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_tour`
--
ALTER TABLE `assigned_tour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `itinerary_id` (`itinerary_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `check_in_point`
--
ALTER TABLE `check_in_point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `itinerary_id` (`itinerary_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `developments`
--
ALTER TABLE `developments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_tour_id` (`assigned_tour_id`),
  ADD KEY `guide_id` (`guide_id`);

--
-- Indexes for table `group_service`
--
ALTER TABLE `group_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `guest`
--
ALTER TABLE `guest`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tours`
--
ALTER TABLE `tours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_category_id` (`tour_category_id`);

--
-- Indexes for table `tour_category`
--
ALTER TABLE `tour_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tour_finance`
--
ALTER TABLE `tour_finance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`);

--
-- Indexes for table `tour_group`
--
ALTER TABLE `tour_group`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `service_id` (`service_id`),
  ADD KEY `guide_id` (`guide_id`);

--
-- Indexes for table `tour_group_service`
--
ALTER TABLE `tour_group_service`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_group_id` (`tour_group_id`),
  ADD KEY `service_id` (`service_id`);

--
-- Indexes for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `tour_guide_assignments`
--
ALTER TABLE `tour_guide_assignments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `guide_id` (`guide_id`),
  ADD KEY `tour_guide_assignments_ibfk_3` (`group_id`);

--
-- Indexes for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tour_id` (`tour_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assigned_tour`
--
ALTER TABLE `assigned_tour`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `check_in_point`
--
ALTER TABLE `check_in_point`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `developments`
--
ALTER TABLE `developments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `group_service`
--
ALTER TABLE `group_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest`
--
ALTER TABLE `guest`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tours`
--
ALTER TABLE `tours`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tour_category`
--
ALTER TABLE `tour_category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tour_finance`
--
ALTER TABLE `tour_finance`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tour_group`
--
ALTER TABLE `tour_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tour_group_service`
--
ALTER TABLE `tour_group_service`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `tour_guides`
--
ALTER TABLE `tour_guides`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tour_guide_assignments`
--
ALTER TABLE `tour_guide_assignments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_tour`
--
ALTER TABLE `assigned_tour`
  ADD CONSTRAINT `assigned_tour_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  ADD CONSTRAINT `assigned_tour_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `tour_group` (`id`),
  ADD CONSTRAINT `assigned_tour_ibfk_3` FOREIGN KEY (`guide_id`) REFERENCES `tour_guides` (`id`),
  ADD CONSTRAINT `assigned_tour_ibfk_4` FOREIGN KEY (`itinerary_id`) REFERENCES `tour_itinerary` (`id`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Constraints for table `check_in`
--
ALTER TABLE `check_in`
  ADD CONSTRAINT `check_in_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `check_in_point`
--
ALTER TABLE `check_in_point`
  ADD CONSTRAINT `check_in_point_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tour_group` (`id`),
  ADD CONSTRAINT `check_in_point_ibfk_2` FOREIGN KEY (`itinerary_id`) REFERENCES `tour_itinerary` (`id`),
  ADD CONSTRAINT `check_in_point_ibfk_3` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `developments`
--
ALTER TABLE `developments`
  ADD CONSTRAINT `developments_ibfk_1` FOREIGN KEY (`assigned_tour_id`) REFERENCES `assigned_tour` (`id`),
  ADD CONSTRAINT `developments_ibfk_2` FOREIGN KEY (`guide_id`) REFERENCES `tour_guides` (`id`);

--
-- Constraints for table `group_service`
--
ALTER TABLE `group_service`
  ADD CONSTRAINT `group_service_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `tour_group` (`id`),
  ADD CONSTRAINT `group_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `guest`
--
ALTER TABLE `guest`
  ADD CONSTRAINT `guest_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`);

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `service_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `tours`
--
ALTER TABLE `tours`
  ADD CONSTRAINT `tours_ibfk_1` FOREIGN KEY (`tour_category_id`) REFERENCES `tour_category` (`id`);

--
-- Constraints for table `tour_finance`
--
ALTER TABLE `tour_finance`
  ADD CONSTRAINT `tour_finance_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`);

--
-- Constraints for table `tour_group`
--
ALTER TABLE `tour_group`
  ADD CONSTRAINT `tour_group_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `booking` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tour_group_ibfk_2` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `tour_group_ibfk_4` FOREIGN KEY (`guide_id`) REFERENCES `tour_guides` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour_group_service`
--
ALTER TABLE `tour_group_service`
  ADD CONSTRAINT `tour_group_service_ibfk_1` FOREIGN KEY (`tour_group_id`) REFERENCES `tour_group` (`id`),
  ADD CONSTRAINT `tour_group_service_ibfk_2` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`);

--
-- Constraints for table `tour_guides`
--
ALTER TABLE `tour_guides`
  ADD CONSTRAINT `tour_guides_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tour_guide_assignments`
--
ALTER TABLE `tour_guide_assignments`
  ADD CONSTRAINT `tour_guide_assignments_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  ADD CONSTRAINT `tour_guide_assignments_ibfk_2` FOREIGN KEY (`guide_id`) REFERENCES `tour_guides` (`id`),
  ADD CONSTRAINT `tour_guide_assignments_ibfk_3` FOREIGN KEY (`group_id`) REFERENCES `group_service` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tour_itinerary`
--
ALTER TABLE `tour_itinerary`
  ADD CONSTRAINT `tour_itinerary_ibfk_1` FOREIGN KEY (`tour_id`) REFERENCES `tours` (`id`),
  ADD CONSTRAINT `tour_itinerary_ibfk_2` FOREIGN KEY (`location_id`) REFERENCES `locations` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
