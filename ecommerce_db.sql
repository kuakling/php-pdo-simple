-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2017 at 12:01 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `send_address` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(30) NOT NULL,
  `user_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `send_address`, `date`, `status`, `user_id`) VALUES
(1, 'CommSci PSU Pattani', '2017-09-09 11:56:39', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `product_id` int(10) NOT NULL,
  `orders_id` int(10) NOT NULL,
  `amount` int(10) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `orders_items`
--

INSERT INTO `orders_items` (`id`, `product_id`, `orders_id`, `amount`, `price`) VALUES
(1, 24, 1, 1, 199),
(2, 12, 1, 10, 159),
(3, 6, 1, 1, 123),
(4, 19, 1, 1, 1599);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `product_detail` text NOT NULL,
  `price` float NOT NULL,
  `qty` int(11) NOT NULL,
  `size` text NOT NULL,
  `type_id` int(11) NOT NULL,
  `image` varchar(200) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `product_detail`, `price`, `qty`, `size`, `type_id`, `image`, `supplier_id`) VALUES
(1, 'ป้ายชื่อพลาสติก 2.1/2x4 แนวตั้ง', '', 150, 1000, '', 12, '', 5),
(2, 'ลูกขนไก่จีน Tengyun', '', 220, 155, '', 4, '', 9),
(3, 'โพสต์-อิท ชุด', '', 25, 122, '', 10, '', 4),
(4, 'กล่องดินสอ (กล่องเหล็ก 2 ชั้น) 506-C9', '', 150, 35, '', 6, '', 3),
(5, 'ควอนตั้มดินสอกด อะตอม QM220 คละสีด้าม', 'ยี่ห้อ: ควอนตั้ม (Quantum)', 620, 412, '', 6, '', 2),
(6, 'กระดาษถ่ายเอกสาร 80G A4 Double A', 'ยี่ห้อ: ดับเบิล เอ (Double A)', 123, 500, '', 10, '', 1),
(7, 'ตราช้างแฟ้มหนีบ ปกพีพี สีดำ #590PFBLK ', 'ช้าง (Elephant)', 580, 652, '', 2, '', 5),
(8, 'คัตเตอร์สแตนเลสเล็ก 30 องศา', 'ยี่ห้อ: ฟักทอง (PUMPKIN)', 200, 39, '', 3, '', 6),
(9, 'กาว 2 หน้า 12MM.X20Y.', 'ยี่ห้อ: สยามอาร์มสตรองค์', 79, 666, '', 3, '', 7),
(10, 'จานสี กลมเล็กดอกไม้ คละสี 707 (บรรจุถุง)', 'ยี่ห้อ: สุขสวัสดิ์เจริญ', 25, 555, '', 9, '', 8),
(11, 'ตราช้างสมุดฉีก 70G 50S # P-108', 'ยี่ห้อ: ช้าง (Elephant)', 265, 401, '', 1, '', 10),
(12, 'ควอนตั้มปากกาสเก็ต 050 น้ำเงิน <1/50> ชนิดกระบอก', 'ยี่ห้อ: ควอนตั้ม (Quantum)', 159, 65, '', 5, '', 9),
(13, 'ยางลบ ERS-8300038-9', 'ยี่ห้อ: บาร์บี้ (BARBIE)', 259, 124, '', 7, '', 5),
(14, 'ฟุตเหล็ก 24 นิ้ว', 'ยี่ห้อ: สุขสวัสดิ์เจริญ', 420, 321, '', 8, '', 1),
(15, 'Happy new year กลาง 4905-01', '', 249, 21, '', 11, '', 2),
(16, 'ชอล์คขีดผ้า วีไอพี กระต่าย ขาว', 'ยี่ห้อ: สุขสวัสดิ์เจริญ', 49, 89, '', 12, '', 8),
(17, 'คลิปหนีบกระดาษ สีดำ อีซี่ 110', '', 199, 500, '', 12, '', 8),
(18, 'คิ้วสันรูด 5มม A4 โปรเกรส คละลาย (การ์ตูน) ', 'ยี่ห้อ: โปรกราส', 49, 159, '', 2, '', 4),
(19, 'กีตาร์กลาง444', '', 1599, 3, '', 4, '', 6),
(20, 'ตราช้างเครื่องเย็บกระดาษ เบอร์ LE-45F', 'ยี่ห้อ: ช้าง (Elephant)', 249, 20, '', 3, '', 3),
(21, 'ยางลบสเต็ดเล่อร์ 50 ก้อน #526 35 B สีดำ', 'ยี่ห้อ: สเต็ดเล่อร์ (STAEDTLER)', 199, 54, '', 7, '1504751231_1006352.jpg', 6),
(22, 'กบเหลา ทรงกลมรูปลูกบอล HC-8005', '', 255, 33, '', 6, '1504749840_6959837680050-800x800.jpg', 2),
(23, 'test', '', 224, 500, '', 1, '1504605163_html_vs_css.png', 1),
(24, '111111', '', 199, 500, '', 2, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `type_name`) VALUES
(1, 'สมุด'),
(2, 'แฟ้ม'),
(3, 'อุปกรณ์สำนักงาน'),
(4, 'อุกรณ์กีฬา'),
(5, 'ปากกา'),
(6, 'ดินสอ'),
(7, 'ยางลบ'),
(8, 'ไม้บรรทัด'),
(9, 'อุปกรณ์ศิลปะ และงานฝีมือ'),
(10, 'ผลิตภัณท์กระดาษ'),
(11, 'อุปกรณ์ตกแต่ง ตามเทศกาล'),
(12, 'เบ็ดเตล็ด');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `supplier_name`, `address`, `telephone`, `detail`) VALUES
(1, 'เพนซิล', 'ถ.เริญประดิษฐ์ อ.เมือง จ.ปัตตานี', '073-335666', 'ร้านนี้เป็นคู่แข่งกับเรา'),
(2, 'หาดใหญ่ เอดดูเคท', 'อ.หาดใหญ่ จ.สงขลา', '074-123456', 'เจ้าของร้านเรื่องมาก'),
(3, 'ป่าบอนเครื่องเขียน', 'อ.บ่าบอน จ.พัทลุง', '074-654321', 'ราคาถูกดี'),
(4, 'พะยูน', 'อ.เมือง จ.ตรัง', '075-259642', ''),
(5, 'NAVA Education', 'ยานาวา กรุงเทพมหานคร', '02-7894562', 'มีบริการส่งทางไปรษณีย์'),
(6, 'กำปงอินเตอร์', 'อ.ยะหริ่ง จ.ปัตตานี', '073-222555', 'อุปกรณ์กีฬาลดให้ 10%'),
(7, 'พี่เล็ก', 'อ.โคกโพธิ์ จ.ปัตตานี', '073-784512', 'ทางไปแคบมาก'),
(8, 'ทรู ดี', 'สามเสน กรุงเทพมหานคร', '02-753951', 'ไกล แต่ราคาถูก'),
(9, 'เพื่อนนักเรียน', 'อ.เมือง จ.สงขลา', '074-564231', 'ไปร้านนี้ได้แวะเที่ยวทะเลด้วย'),
(10, 'บายจัย', 'อ.เมือง จ.ยะลา', '072-258624', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(2) NOT NULL,
  `is_admin` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `status`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$11$el3AxHQ76bdLEvlsLCo6P.DI6EJnMeZfJKhlTCZy8kP1qlC5fdOPS', 'admin@localhost.com', 1, 0, '2017-09-09 09:08:43', '2017-09-09 09:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`id`, `fullname`, `address`, `gender`, `tel`, `created_at`, `updated_at`) VALUES
(1, 'แอดมิน', '123/1 หมู 9 ต.โคกโพธิ์ อ.โคกโพธิ์ จ.ปัตตานี 94120', 2, '0856289710', '2017-09-09 09:08:43', '2017-09-09 09:08:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
