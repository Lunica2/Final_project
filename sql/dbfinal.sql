-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2024 at 09:41 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id_address` int(10) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `id_member` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id_address`, `address`, `zipcode`, `id_member`) VALUES
(1, 'อุดรธานี', 46375, 1),
(2, '1 บ.หนองอ.เพชร จ.จัน', 47290, 11),
(3, '1 บ.หนองอ.เพชร จ.จัน', 47290, 11);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `id_order_detail` int(11) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`id_order_detail`, `item_amount`, `total`, `id_pro`, `id_order`) VALUES
(38, 1, 20, 11, 30),
(39, 1, 99, 6, 31),
(40, 1, 49, 3, 32),
(41, 1, 49, 3, 33),
(42, 1, 20, 11, 34),
(43, 1, 43, 12, 35),
(44, 1, 100, 2, 36),
(45, 1, 49, 3, 37),
(46, 1, 99, 21, 41),
(47, 1, 100, 2, 43),
(48, 1, 99, 25, 44),
(49, 1, 70, 13, 41),
(50, 1, 20, 11, 46),
(51, 1, 99, 21, 47),
(52, 1, 49, 3, 48),
(53, 1, 30, 26, 49),
(54, 1, 500, 16, 50),
(55, 1, 20, 11, 50),
(56, 1, 50, 15, 51),
(57, 1, 43, 12, 52),
(58, 1, 43, 12, 53),
(59, 1, 6, 9, 54),
(60, 1, 443, 18, 55),
(61, 1, 443, 18, 56),
(62, 1, 443, 18, 57),
(63, 1, 443, 18, 58),
(64, 1, 500, 10, 59),
(65, 1, 30, 26, 60),
(66, 1, 249, 33, 61),
(67, 1, 249, 33, 62),
(68, 3, 90, 26, 63),
(69, 3, 147, 34, 64);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `order_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `pay_money` double NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`order_id`, `pay_money`, `pay_date`, `pay_time`, `pay_image`) VALUES
(0000000022, 227, '2024-05-28', '08:59:00', 'pay_66553a7f70cdd.png'),
(0000000026, 108, '2024-05-31', '09:46:00', 'pay_66593a282c87f.png'),
(0000000032, 49, '2024-07-01', '13:05:00', 'pay_6682471a66bd9.png'),
(0000000033, 49, '2024-07-08', '13:30:00', 'pay_668b87b166561.png'),
(0000000045, 70, '2024-07-18', '22:14:00', 'pay_669931152cee7.png'),
(0000000047, 99, '2024-07-18', '22:13:00', 'pay_6699312a7e1c0.png'),
(0000000049, 30, '2024-07-18', '22:16:00', 'pay_669931ce02f12.png'),
(0000000060, 30, '2024-07-23', '09:28:00', 'pay_669f156a7db85.png');

-- --------------------------------------------------------

--
-- Table structure for table `payment_pre`
--

CREATE TABLE `payment_pre` (
  `id_pre` int(10) NOT NULL,
  `pay_money` double NOT NULL,
  `pay_date` date NOT NULL,
  `pay_time` time NOT NULL,
  `pay_image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `payment_pre`
--

INSERT INTO `payment_pre` (`id_pre`, `pay_money`, `pay_date`, `pay_time`, `pay_image`) VALUES
(1, 0, '2024-07-02', '10:59:00', 'pay_66837b2a907cc.jpg'),
(11, 70, '2024-07-02', '11:00:00', 'pay_66837b565c9b6.jpg'),
(31, 500, '2024-07-23', '09:33:00', 'pay_669f167176555.png');

-- --------------------------------------------------------

--
-- Table structure for table `pre_order`
--

CREATE TABLE `pre_order` (
  `id_pre` int(11) NOT NULL,
  `time_pre` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price_pre` float NOT NULL,
  `pre_status` varchar(1) NOT NULL COMMENT '0=ยกเลิกการ Pre Order,1=ยังไม่ชำระเงิน,2=ชำระเงินแล้ว,3=รอตรวจสอบ',
  `address` text NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pre_order`
--

INSERT INTO `pre_order` (`id_pre`, `time_pre`, `total_price_pre`, `pre_status`, `address`, `id_pro`, `id_member`) VALUES
(13, '2024-07-02 04:04:47', 50, '1', '', 4, 11),
(14, '2024-07-02 04:06:42', 30, '1', '', 4, 11),
(15, '2024-07-02 04:09:13', 20, '1', '', 4, 11),
(16, '2024-07-02 04:14:02', 100, '1', '', 4, 11),
(17, '2024-07-02 04:15:28', 500, '1', '', 4, 11),
(18, '2024-07-02 04:17:02', 34, '1', '', 4, 11),
(20, '2024-07-02 04:17:53', 6, '1', '', 4, 11),
(22, '2024-07-02 04:19:17', 399, '1', '', 4, 11),
(23, '2024-07-02 04:21:55', 500, '2', '', 10, 11),
(24, '2024-07-08 03:39:47', 30, '1', '', 26, 1),
(25, '2024-07-08 03:40:58', 30, '1', '', 26, 11),
(26, '2024-07-08 03:42:20', 99, '0', '', 25, 7),
(27, '2024-07-08 03:48:25', 40, '2', '', 14, 7),
(29, '2024-07-21 14:26:28', 500, '1', '', 16, 11),
(30, '2024-07-21 15:20:14', 500, '1', '405 หมู หมา กา ไก่', 16, 11),
(31, '2024-07-23 02:29:51', 500, '3', '1 บ.หนองอ.เพชร จ.จัน 45471', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pre_order_detail`
--

CREATE TABLE `pre_order_detail` (
  `id_pre_detail` int(11) NOT NULL,
  `item_amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_pre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pre_order_detail`
--

INSERT INTO `pre_order_detail` (`id_pre_detail`, `item_amount`, `total`, `id_pro`, `id_pre`) VALUES
(1, 1, 500, 10, 7),
(2, 1, 70, 13, 8),
(3, 1, 20, 11, 9),
(4, 1, 70, 13, 10),
(5, 1, 70, 13, 11),
(6, 1, 399, 4, 12),
(7, 1, 50, 15, 13),
(8, 1, 30, 26, 14),
(9, 1, 20, 11, 15),
(10, 1, 100, 2, 0),
(11, 1, 500, 10, 17),
(12, 1, 34, 17, 18),
(13, 1, 6, 9, 20),
(14, 1, 399, 4, 22),
(15, 1, 500, 10, 23),
(16, 1, 30, 26, 24),
(17, 1, 30, 26, 25),
(18, 1, 99, 25, 26),
(19, 1, 40, 14, 27),
(21, 1, 500, 16, 29),
(22, 1, 500, 16, 30),
(23, 1, 500, 16, 31);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id_pro` int(11) NOT NULL,
  `id_user` int(255) NOT NULL COMMENT 'รหัสผู้ใช้ที่ลงขาย',
  `name_pro` varchar(60) NOT NULL,
  `price_pro` int(15) NOT NULL,
  `photo_pro` varchar(100) NOT NULL COMMENT 'รูปภาพ',
  `detail_pro` varchar(255) NOT NULL,
  `amount` int(10) NOT NULL,
  `status_pro` int(1) NOT NULL COMMENT '0=ยกเลิก\r\n1=วางขาย\r\n2=รอตรวจสอบ',
  `id_type` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id_pro`, `id_user`, `name_pro`, `price_pro`, `photo_pro`, `detail_pro`, `amount`, `status_pro`, `id_type`) VALUES
(2, 15, 'lol 555', 100, 'pro_664d5aa898156.jpg', '1', 47, 1, 3),
(9, 2, 'ม่าม่า', 6, 'pro_6642ce3e5f383.jpg', 'อร่อยมาก', 10, 1, 3),
(10, 15, 'ดิน', 500, 'pro_6642cea729ca3.jpg', 'สวยจัด', 49, 1, 2),
(11, 15, 'น้ำ', 20, 'pro_6642ced752513.jpg', 'ใสมาก', 294, 1, 1),
(12, 2, 'ไฟ', 43, 'pro_6642cf0366a31.jpg', 'ร้อนมาก', 32, 1, 2),
(13, 15, 'ลม', 70, 'pro_6642cfbb9a236.jpg', 'แรงจัดๆ', 83, 1, 3),
(14, 2, 'หม้อ', 40, 'pro_6642d02a85130.jpg', 'ประหยัด', 26, 1, 3),
(15, 2, 'แก้ว', 50, 'pro_6642d0722dbe7.jpg', '5555555', 7, 1, 2),
(16, 2, 'ช้าง', 500, 'pro_6642d0a24dd83.jpg', 'Big Big', 0, 1, 1),
(17, 15, 'มาดิ', 34, 'pro_6642d0c2b15de.jpg', 'afaf', 29, 1, 2),
(18, 2, 'lol', 443, 'pro_6642d0f4c9ee6.jpg', 'shshsh', 524, 1, 2),
(19, 2, 'afafaf', 53, 'pro_6642d117db893.jpg', 'rhhe', 343, 1, 1),
(25, 15, 'เด็ก', 99, 'pro_664d54ae2674c.jpg', ' สสสสส', 49, 1, 1),
(26, 2, 'สวย', 30, 'pro_66530d1762fac.jpg', ' ddddddd', 5, 1, 3),
(31, 15, 'Test', 45, 'pro_668f7758d8d9f.png', 'มีจำนวนจำกัด', 20, 2, 3),
(34, 17, 'Mic', 49, 'pro_66a073c585f7a.png', 'ดีมาก', 47, 1, 1),
(35, 17, 'นวม', 399, 'pro_66a1e55f9d911.jpg', 'นวมคุณภาพดี', 20, 0, 2),
(36, 17, 'ยาง', 50, 'pro_66a1e63ef074d.jpg', 'ยางมาใหม่ ถูกๆ ครับ', 20, 1, 2),
(37, 17, 'ข้าว', 300, 'pro_66a70bc5e466d.png', 'ข้าวมาใหม่', 0, 1, 2),
(38, 17, 'ยาง', 250, 'pro_66bc1bc4af494.jpg', 'ขายดีที่สุดในโลก', 10, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `uploaded_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_member` int(11) NOT NULL COMMENT 'ID คนลงขาย',
  `id_pro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `file_name`, `uploaded_on`, `id_member`, `id_pro`) VALUES
(4, 'images.png', '2024-07-25 05:44:30', 17, 36),
(5, 'images.jpg', '2024-07-25 05:44:30', 17, 36),
(6, '0MtNTBLSb-Ak.jpg', '2024-07-25 05:44:30', 17, 36),
(7, 'images.jpg', '2024-07-29 03:25:57', 17, 37),
(8, '0MtNTBLSb-Ak.jpg', '2024-07-29 03:25:57', 17, 37),
(9, 'My_Profile.jpg', '2024-07-29 03:25:57', 17, 37),
(10, 'Nitro_Wallpaper_01_3840x2400.jpg', '2024-08-14 02:51:48', 17, 38),
(11, 'Nitro_Wallpaper_02_3840x2400.jpg', '2024-08-14 02:51:48', 17, 38),
(12, 'Nitro_Wallpaper_03_3840x2400.jpg', '2024-08-14 02:51:48', 17, 38);

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `rate_detail` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_table`
--

CREATE TABLE `review_table` (
  `review_id` int(11) NOT NULL,
  `id_pro` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `user_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `user_rating` int(1) NOT NULL,
  `user_review` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `datetime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `review_table`
--

INSERT INTO `review_table` (`review_id`, `id_pro`, `user_id`, `user_name`, `user_rating`, `user_review`, `datetime`) VALUES
(18, 6, 11, 'home', 5, 'ดี', 0),
(19, 3, 11, 'home', 0, 'สนุกมากครับ', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell`
--

CREATE TABLE `sell` (
  `id_sell` int(10) NOT NULL,
  `sell_amount` int(11) NOT NULL,
  `sell_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `sell_month` varchar(30) NOT NULL,
  `id_pro` int(11) NOT NULL,
  `id_member` int(11) NOT NULL COMMENT 'Id คนซื้อ'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sell`
--

INSERT INTO `sell` (`id_sell`, `sell_amount`, `sell_date`, `sell_month`, `id_pro`, `id_member`) VALUES
(10, 2, '2024-07-23 04:10:41', 'July', 33, 1),
(11, 3, '2024-07-24 03:25:24', 'July', 34, 1),
(12, 0, '2024-07-25 05:40:47', '', 35, 0),
(13, 0, '2024-07-25 05:44:30', '', 36, 0),
(14, 0, '2024-07-29 03:25:57', '', 37, 0),
(15, 0, '2024-08-14 02:51:48', '', 38, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `order_id` int(10) UNSIGNED ZEROFILL NOT NULL,
  `id` int(10) NOT NULL COMMENT 'ID คนซื้อ',
  `cus_name` varchar(60) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `total_price` float NOT NULL,
  `order_status` varchar(1) NOT NULL COMMENT '0=ยกเลิกสินค้า\r\n1=ยังไม่ชำระเงิน\r\n2=ชำระเงิน\r\n3=รอตรวจสอบ',
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `dateMonth` varchar(30) NOT NULL,
  `zipcode` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`order_id`, `id`, `cus_name`, `address`, `telephone`, `total_price`, `order_status`, `reg_date`, `dateMonth`, `zipcode`) VALUES
(0000000030, 7, 'dfh ', '1 บ.หนองอ.เพชร จ.จัน 45471 ', '0956348751', 20, '0', '2024-06-10 02:45:29', 'June', 0),
(0000000032, 11, 'home', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '0675468954', 49, '2', '2024-07-01 06:04:25', 'July', 0),
(0000000033, 1, 'Nakarin Wannin', '84 บ.บ่อ อ.ชื่อ จ.สิงค์ 41271', '0956636035', 49, '2', '2024-07-02 02:00:45', 'July', 0),
(0000000034, 1, 'Nakarin Wannin', '84 บ.บ่อ อ.ชื่อ จ.สิงค์ 41271', '0956636035', 20, '0', '2024-07-02 02:33:12', 'July', 0),
(0000000035, 1, 'Nakarin Wannin', '84 บ.บ่อ อ.ชื่อ จ.สิงค์ 41271', '0956636035', 43, '1', '2024-07-02 02:44:46', 'July', 0),
(0000000037, 7, 'dfh', '150 สว่าง จัง', '0956348751', 49, '1', '2024-07-09 02:31:32', 'July', 0),
(0000000039, 7, 'dfh', '140 จันทร์ อังคาร', '0956348751', 20, '1', '2024-07-09 02:37:18', 'July', 0),
(0000000040, 7, 'dfh', '14 จันทร์ อังคาร', '0956348751', 20, '1', '2024-07-09 02:44:43', 'July', 0),
(0000000041, 7, 'dfh', '47 จันทร์ อังคาร', '0956348751', 6, '2', '2024-07-09 02:46:07', 'July', 0),
(0000000042, 7, 'dfh', '64 จันทร์ อังคาร', '0956348751', 99, '1', '2024-07-09 02:47:08', 'July', 0),
(0000000043, 7, 'dfh', 'นครพนม', '0956348751', 100, '0', '2024-07-09 02:50:19', 'July', 0),
(0000000044, 7, 'dfh', '64 จันทร์ อังคาร', '0956348751', 99, '0', '2024-07-09 06:40:30', 'July', 0),
(0000000045, 11, 'home', 'มหาสารคาม', '0675468954', 70, '2', '2024-07-10 06:09:57', 'July', 0),
(0000000046, 11, 'home', '160 บ.หนองแปน อ.เพชร จ.สกล 9999', '0675468954', 20, '0', '2024-07-10 06:11:46', 'July', 0),
(0000000047, 11, 'OLO', '3', '5555555555', 99, '2', '2024-07-18 06:59:37', 'July', 12500),
(0000000048, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 49, '1', '2024-07-18 07:05:44', 'July', 12500),
(0000000049, 11, 'OLO', '405 หมู หมา กา ไก่', '5555555555', 30, '2', '2024-07-18 15:16:20', 'July', 57842),
(0000000050, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 520, '1', '2024-07-18 15:28:54', 'July', 12500),
(0000000051, 11, 'OLO', '405 หมู หมา กา ไก่', '5555555555', 50, '1', '2024-07-21 15:14:15', 'July', 57842),
(0000000052, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 43, '1', '2024-07-22 03:03:43', 'July', 12500),
(0000000053, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 43, '1', '2024-07-22 03:08:26', 'July', 12500),
(0000000054, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 6, '1', '2024-07-22 03:11:48', 'July', 12500),
(0000000055, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 443, '1', '2024-07-22 03:21:30', 'July', 12500),
(0000000056, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 443, '1', '2024-07-22 03:25:16', 'July', 12500),
(0000000057, 11, 'OLO', '405 หมู หมา กา ไก่', '5555555555', 443, '1', '2024-07-22 03:25:46', 'July', 57842),
(0000000058, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 443, '1', '2024-07-22 03:44:27', 'July', 12500),
(0000000059, 11, 'OLO', '160 บ.หนองแปน อ.เพชร จ.สกล 45213', '5555555555', 500, '0', '2024-07-22 04:50:17', 'July', 12500),
(0000000060, 1, 'WOW', '1 บ.หนองอ.เพชร จ.จัน 45471', '0475635865', 30, '3', '2024-07-23 02:28:44', 'July', 47290),
(0000000061, 1, 'WOW', '1 บ.หนองอ.เพชร จ.จัน 45471', '0475635865', 249, '1', '2024-07-23 04:09:20', 'July', 47290),
(0000000062, 1, 'WOW', '1 บ.หนองอ.เพชร จ.จัน 45471', '0475635865', 249, '1', '2024-07-23 04:10:41', 'July', 47290),
(0000000063, 1, 'WOW', '1 บ.หนองอ.เพชร จ.จัน 45471', '0475635865', 90, '1', '2024-07-24 03:22:13', 'July', 47290),
(0000000064, 1, 'WOW', '1 บ.หนองอ.เพชร จ.จัน 45471', '0475635865', 147, '2', '2024-07-24 03:25:24', 'July', 47290);

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `id_type` int(5) NOT NULL,
  `name_type` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`id_type`, `name_type`) VALUES
(1, 'หนังสือถูก'),
(2, 'หนังสือใหม่'),
(3, 'หนังสือขายดี'),
(4, 'หนังสือแพง');

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `bank` varchar(255) NOT NULL COMMENT 'ชื่อธนาคาร',
  `bank_number` varchar(10) NOT NULL COMMENT 'เลขที่บัญชี'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `username`, `name`, `email`, `telephone`, `password`, `user_type`, `bank`, `bank_number`) VALUES
(1, 'brown1250', 'WOW', 'nakarinwannin1250@gmail.com', '0475635865', '81e5f81db77c596492e6f1a5a792ed53', 'Buyer', '', '0'),
(2, 'brown1250', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'Seller', 'ธนาคารไทยพาณิชย์', '457652347'),
(6, 'admin', 'Admin', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '', '0'),
(7, 'dfh', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'Buyer', '', '0'),
(10, 'admin1', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'admin', '', '0'),
(11, 'TT', 'OLO', 'nakarinwannin1250@gmail.com', '5555555555', '81dc9bdb52d04dc20036dbd8313ed055', 'Buyer', '', '0'),
(14, 'BB', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'Buyer', '', '0'),
(15, 'Tup', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'Seller', 'ธนาคารไทยพาณิชย์', '8888888888'),
(17, 'ice', 'House', 'nakarinwannin1250@gmail.com', '0999999999', '81dc9bdb52d04dc20036dbd8313ed055', 'Seller', 'ธนาคารไทยพาณิชย์', '666666');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id_address`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`id_order_detail`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `payment_pre`
--
ALTER TABLE `payment_pre`
  ADD PRIMARY KEY (`id_pre`);

--
-- Indexes for table `pre_order`
--
ALTER TABLE `pre_order`
  ADD PRIMARY KEY (`id_pre`);

--
-- Indexes for table `pre_order_detail`
--
ALTER TABLE `pre_order_detail`
  ADD PRIMARY KEY (`id_pre_detail`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id_pro`);
ALTER TABLE `product` ADD FULLTEXT KEY `name_pro` (`name_pro`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `review_table`
--
ALTER TABLE `review_table`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sell`
--
ALTER TABLE `sell`
  ADD PRIMARY KEY (`id_sell`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`id_type`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id_address` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `id_order_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `payment_pre`
--
ALTER TABLE `payment_pre`
  MODIFY `id_pre` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pre_order`
--
ALTER TABLE `pre_order`
  MODIFY `id_pre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pre_order_detail`
--
ALTER TABLE `pre_order_detail`
  MODIFY `id_pre_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id_pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `review_table`
--
ALTER TABLE `review_table`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `sell`
--
ALTER TABLE `sell`
  MODIFY `id_sell` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `order_id` int(10) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `type`
--
ALTER TABLE `type`
  MODIFY `id_type` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
