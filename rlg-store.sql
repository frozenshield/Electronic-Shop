-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2025 at 03:27 PM
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
-- Database: `rlg-store`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_id` int(11) NOT NULL,
  `user` varchar(199) NOT NULL,
  `mypass` varchar(199) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_id`, `user`, `mypass`, `email`) VALUES
(1, 'RusselG', '$2y$10$uT.oglbZ5qr87wupcNkA2.to0yo4rI93fTAljHtedxPGuBgMh5X9W', ''),
(2, 'RLG', '$2y$10$DNq14nc5AVtW5h86ySzKBewFstwbin/XTdaqjelprxv0dHv6aJ7qG', 'russelluisg@gmail.com'),
(5, '1234', '$2y$10$7rbj3K82kQUGNGhDfWXZ5OL6Si0YKKt3vCuofAYOxxJb3PhFaqlf2', '');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `address` varchar(199) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `phone` int(15) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `user_id`, `fname`, `lname`, `address`, `zipcode`, `phone`, `date_created`) VALUES
(1, 2, 'Russel Luis ABX', 'Gementizaa', '13 Batangas St. Brgy San Antonio', 1101, 956993694, '2024-12-08 06:16:27');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) NOT NULL,
  `cart_qty` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cart_qty`, `user_id`, `product_id`, `date_created`) VALUES
(61, 1, 0, 31, '2024-12-08 14:41:07'),
(62, 1, 0, 24, '2024-12-08 14:41:11'),
(66, 1, 2, 4, '2025-03-21 04:42:38'),
(67, 1, 2, 29, '2025-03-21 04:43:03'),
(68, 1, 2, 13, '2025-03-21 04:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `total_amount`, `payment_method`, `status`, `created_at`) VALUES
(5, 2, 57998.00, 'paypal', 'pending', '2024-12-08 15:09:17'),
(6, 2, 57998.00, NULL, 'pending', '2024-12-09 11:41:39'),
(7, 2, 57998.00, 'paypal', 'pending', '2024-12-09 11:41:53'),
(8, 2, 5800.00, 'paypal', 'pending', '2024-12-30 13:54:53'),
(9, 2, 5800.00, 'paypal', 'pending', '2025-01-03 15:16:03'),
(10, 2, 5800.00, 'paypal', 'pending', '2025-01-03 15:22:19'),
(11, 2, 5800.00, 'paypal', 'pending', '2025-01-03 15:27:04'),
(12, 2, 5800.00, 'paypal', 'pending', '2025-01-03 15:28:36'),
(13, NULL, NULL, 'paypal', 'pending', '2025-01-03 15:32:02'),
(14, NULL, NULL, 'paypal', 'pending', '2025-03-21 04:43:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`item_id`, `order_id`, `product_name`, `quantity`, `price`) VALUES
(4, 5, 'ROG Strix Go 2.4', 1, 4000.00),
(5, 5, 'Asus k21', 1, 14000.00),
(6, 5, 'EOS R100 (RF-S18-45mm f/4.5-6.3 IS STM)', 1, 39998.00),
(7, 6, 'ROG Strix Go 2.4', 1, 4000.00),
(8, 6, 'Asus k21', 1, 14000.00),
(9, 6, 'EOS R100 (RF-S18-45mm f/4.5-6.3 IS STM)', 1, 39998.00),
(10, 7, 'ROG Strix Go 2.4', 1, 4000.00),
(11, 7, 'Asus k21', 1, 14000.00),
(12, 7, 'EOS R100 (RF-S18-45mm f/4.5-6.3 IS STM)', 1, 39998.00),
(13, 8, 'ROG Strix Flare II Animate', 1, 5800.00),
(14, 9, 'ROG Strix Flare II Animate', 1, 5800.00),
(15, 10, 'ROG Strix Flare II Animate', 1, 5800.00),
(16, 11, 'ROG Strix Flare II Animate', 1, 5800.00),
(17, 12, 'ROG Strix Flare II Animate', 1, 5800.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(9) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `product_desc` varchar(100) NOT NULL,
  `product_img` varchar(100) NOT NULL,
  `price` double(10,2) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 1,
  `created_dt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_type`, `product_desc`, `product_img`, `price`, `category`, `status`, `created_dt`) VALUES
(2, 'Macbook pro ', 'laptop', 'Macbook pro m3 12gb ', 'product01.png', 1000.00, 'laptop', 1, '2024-11-09 14:31:46'),
(3, 'Headphone Redragon H20', 'headphone', 'Headphone Redragon H20', 'product02.png', 500.00, 'headphone', 1, '2024-11-09 14:41:42'),
(4, 'Macbook pro 2 ', 'laptop', 'Macbook pro 2 13gb', 'product03.png', 49000.00, 'laptop', 1, '2024-11-09 14:42:46'),
(5, 'Huawei Tabpad pro', 'tablet', 'Huawei Tabpad pro', 'product04.png', 21000.00, 'tablet', 1, '2024-11-09 14:44:00'),
(6, 'Sony Headphone H31', 'headphone', 'Sony Headphone H31', 'product05.png', 1500.00, 'headphone', 1, '2024-11-09 14:44:40'),
(7, 'MSI old laptop', 'laptop', 'MSI old laptop', 'product06.png', 34500.00, 'laptop', 1, '2024-11-25 11:03:09'),
(8, 'Samsung A2', 'smartphone', 'Samsung A2', 'product07.png', 9000.00, 'smartphone', 1, '2024-11-25 11:04:27'),
(9, 'Asus k21', 'laptop', 'Asus k21', 'product08.png', 14000.00, 'laptop', 1, '2024-11-25 11:06:34'),
(10, 'Rekam digital camera', 'camera', 'Rekam digital camera', 'product09.png', 1700.00, 'camera', 1, '2024-11-25 11:07:29'),
(11, 'ROG Zephyrus G16 (2024)\r\nGU605MI-QR168WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4070 Laptop GPU\r\n\r\nIntel® AI Boost NPU\r\n\r\nIntel® Core™ Ultra', 'product10.png', 108000.00, 'laptop', 1, '2024-11-25 12:11:20'),
(12, 'ROG Zephyrus G16 (2024)\r\nGU605MI-QR169WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4070 Laptop GPU\r\n\r\nIntel® AI Boost NPU\r\n\r\nIntel® Core™ Ultra', 'product11.png', 122999.00, 'laptop', 1, '2024-11-25 12:18:29'),
(13, 'ROG Zephyrus G16 (2023)\r\nGU603VI-N4076WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4070 Laptop GPU\r\n\r\n13th Gen Intel® Core™ i9-13900H Processor', 'product12.png', 97000.00, 'laptop', 1, '2024-11-25 12:21:11'),
(14, 'ROG Strix SCAR 18 (2024)\r\nG834JYR-R6065WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4090 Laptop GPU\r\n\r\nIntel® Core™ i9-14900HX Processor\r\n\r\n18\" ', 'product13.png', 70000.00, 'laptop', 1, '2024-11-25 12:36:10'),
(15, 'ROG Strix SCAR 16 (2024)\r\nG634JZR-RA091WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4080 Laptop GPU\r\n\r\nIntel® Core™ i9-14900HX Processor\r\n\r\n16\" ', 'product14.png', 89000.00, 'laptop', 1, '2024-11-25 12:36:10'),
(16, 'ROG Strix G18 (2024)\r\nG814JIR-N6083WS', 'laptop', 'Windows 11 Home\r\n\r\nNVIDIA® GeForce RTX™ 4070 Laptop GPU\r\n\r\nIntel® Core™ i9-14900HX Processor\r\n\r\n18\" ', 'product15.png', 69000.00, 'laptop', 1, '2024-11-25 12:36:58'),
(17, 'Lenovo Legion Slim 5 14.5\"', 'laptop', '14.5\" WQXGA+ 120Hz OLED 400nits Glossy 100% DCI-P3 DisplayHDR True Black 500 Dolby Vision\r\nAMD Ryzen', 'product16.jpg', 60000.00, 'laptop', 1, '2024-11-25 13:43:15'),
(18, 'EOS R1 (Body)', 'camera', '24.2MP Full-Frame Back-Illuminated Stacked CMOS Sensor\r\nAccelerated Capture - DIGIC Accelerator & DI', 'product17.png', 24500.00, 'camera', 1, '2024-11-25 13:58:55'),
(19, 'EOS R5 Mark II (Body)', 'camera', '45MP Full-Frame Back-Illuminated Stacked CMOS Sensor\r\nAccelerated Capture - DIGIC Accelerator & DIGI', 'product18.png', 249998.00, 'camera', 1, '2024-11-25 14:01:09'),
(20, 'EOS R5 Mark II (RF24-105mm f/4L IS USM)', 'camera', '45MP Full-Frame Back-Illuminated Stacked CMOS Sensor\r\nAccelerated Capture - DIGIC Accelerator & DIGI', 'product19.png', 32999.00, 'camera', 1, '2024-11-25 14:13:49'),
(21, 'EOS R100 (RF-S18-45mm f/4.5-6.3 IS STM)', 'camera', 'Approx. 24.1MP APS-C CMOS sensor & approx. 356g (body)\r\nUp to 6.5 fps with Eye Detection AF\r\n4K 25p ', 'product20.png', 39998.00, 'camera', 1, '2024-11-25 14:17:51'),
(22, 'EOS R50 (RF-S18-45mm f/4.5-6.3 IS STM)', 'camera', 'Approx. 24.2MP APS-C CMOS sensor & approx. 375g\r\n4K 30p (6K oversampled) & FHD 120p\r\nUp to 15 fps & ', 'product21.png', 35000.00, 'camera', 1, '2024-11-25 14:19:36'),
(23, 'ROG Delta S', 'headphone', 'ROG Delta S gaming headset delivers impeccably clear, detailed audio to give serious gamers the edge', 'headphone1.png', 5000.00, 'headphone', 1, '2024-11-30 05:42:24'),
(24, 'ROG Strix Go BT', 'headphone', 'Bluetooth® wireless gaming headset with Qualcomm® aptX™ Adaptive audio technology, Active Noise canc', 'headphone2.png', 4500.00, 'headphone', 1, '2024-11-30 05:44:33'),
(25, 'ROG Strix Go 2.4', 'headphone', 'USB-C 2.4 GHz wireless gaming headset with AI noise-cancelling microphone and low-latency performanc', 'headphone3.png', 4000.00, 'headphone', 1, '2024-11-30 05:45:55'),
(26, 'ROG Strix Go Core Moonlight White', 'headphone', 'ROG Strix Go Core Moonlight White gaming headset delivers immersive gaming audio and incredible comf', 'headphone4.png', 4100.00, 'headphone', 1, '2024-11-30 05:47:11'),
(27, 'ROG Cetra II Core Moonlight White', 'headphone', 'ROG Cetra II Core Moonlight White in-ear gaming headphones with liquid silicone rubber (LSR) drivers', 'headphone5.png', 3800.00, 'headphone', 1, '2024-11-30 05:48:41'),
(28, 'ROG Cetra True Wireless', 'headphone', 'ROG Cetra True Wireless gaming headphones with low-latency wireless connection, ANC, up to 27-hour b', 'headphone6.png', 4300.00, 'headphone', 1, '2024-11-30 05:50:04'),
(29, 'ROG Cetra True Wireless SpeedNova', 'headphone', 'Bluetooth® and 2.4 GHz wireless gaming headphones with ROG SpeedNova wireless technology, 24-bit 96 ', 'headphone7.png', 4400.00, 'headphone', 1, '2024-11-30 05:51:07'),
(30, 'ROG Throne Qi', 'accessory', 'ROG Throne Qi with wireless charging, 7.1 surround sound , dual USB 3.1 ports and Aura Sync\r\nEfficie', 'accessory1.png', 2500.00, 'accessory', 1, '2024-11-30 05:59:05'),
(31, 'ROG THRONE', 'accessory', 'ROG Throne with 7.1 surround sound, dual USB 3.1 ports and Aura Sync\r\nCustomizable 18 RGB lighting z', 'accessory2.png', 2400.00, 'accessory', 1, '2024-11-30 06:00:22'),
(32, 'ROG Ally (2023) RC71L\r\n\r\nRC71L-NH019W', 'console', 'Processor\r\nCPU:\r\nAMD Ryzen™ Z1 Processor (\"Zen4\" architecture with 4nm process, 6-core /12-threads, ', 'console1.png', 24999.00, 'console', 1, '2024-12-01 05:12:09'),
(33, 'ROG Strix Flare II Animate', 'accessory', 'ROG Strix Flare II Animate gaming mechanical keyboard with AniMe Matrix™ LED display, 8000 Hz pollin', 'accessory3.png', 5800.00, 'accessory', 1, '2024-12-01 05:15:42'),
(34, 'ROG Claymore II', 'accessory', 'ROG Claymore II modular TKL 80%/100% gaming mechanical keyboard with ROG RX Optical Mechanical Switc', 'accessory4.png', 5300.00, 'accessory', 1, '2024-12-01 05:19:17'),
(35, 'ROG Falchion NX', 'accessory', 'ROG Falchion NX 65% wireless mechanical gaming keyboard with 68 keys, wireless Aura Sync lighting, i', 'accessory5.png', 3500.00, 'accessory', 1, '2024-12-01 05:21:08'),
(36, 'ROG Strix Scope TKL Deluxe', 'accessory', 'ROG Strix Scope TKL Deluxe wired mechanical RGB gaming keyboard for FPS games, with Cherry MX switch', 'accessory6.png', 4300.00, 'accessory', 1, '2024-12-01 05:22:30'),
(37, 'ROG Keycap Set For RX Switches EVA-02 Edition', 'accessory', 'The ROG Keycap Set for ROG RX Switches EVA-02 Edition offers EVA-inspired keycaps for ROG RX optical', 'accessory7.png', 1500.00, 'accessory', 1, '2024-12-01 05:24:12'),
(38, 'ROG Dye-Sub PBT Keycaps', 'accessory', 'ROG Dye-Sub PBT Keycaps for ROG NX switches are made of premium, durable PBT and feature dye-sublima', 'accessory8.png', 899.00, 'accessory', 1, '2024-12-01 05:25:43'),
(39, 'ROG Polling Rate Booster', 'accessory', 'Experience supersmooth cursor control with the ROG Polling Rate Booster – a new ROG-exclusive access', 'accessory9.png', 499.00, 'accessory', 1, '2024-12-01 05:26:29'),
(40, 'ROG Phone 8 Pro', 'smartphone', 'Qualcomm Snapdragon 8 Gen 3\r\n\r\nLPDDR5X 16GB\r\n\r\nUFS4.0 512GB\r\n\r\n5500mAh battery', 'phone1.png', 48000.00, 'smartphone', 1, '2024-12-01 05:37:08'),
(41, 'ROG Phone 8', 'smartphone', 'Qualcomm Snapdragon 8 Gen 3\r\n\r\nLPDDR5X 12GB\r\n\r\nUFS4.0 256GB\r\n\r\n5500mAh battery', 'phone2.png', 45000.00, 'smartphone', 1, '2024-12-01 05:37:52'),
(42, 'ROG Phone 8', 'smartphone', 'Qualcomm Snapdragon 8 Gen 3\r\n\r\nLPDDR5X 12GB\r\n\r\nUFS4.0 256GB\r\n\r\n5500mAh battery', 'phone3.png', 45000.00, 'smartphone', 1, '2024-12-01 05:38:59'),
(43, 'ROG Phone 6D', 'smartphone', 'MediaTek Dimensity 9000+\r\n\r\nLPDDR5X 12GB\r\n\r\nUFS3.1 256GB\r\n\r\n6000mAh battery', 'phone4.png', 44000.00, 'smartphone', 1, '2024-12-01 05:39:43');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `email` varchar(199) NOT NULL,
  `review` varchar(199) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `user_id`, `product_id`, `email`, `review`, `date_created`) VALUES
(1, 2, 16, 'russelluisg@gmail.com', 'Ganda ng Laptop', '2024-12-06 14:51:17'),
(5, 2, 34, 'russelluisg@gmail.com', 'try', '2024-12-07 05:24:31'),
(6, 2, 15, 'russelluisg@gmail.com', 'nice 1', '2024-12-20 14:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wish_id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `qty` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wish_id`, `product_id`, `user_id`, `qty`, `date_created`) VALUES
(29, 15, 2, 1, '2024-12-20 14:31:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wish_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wish_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `billing_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `account` (`user_id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
