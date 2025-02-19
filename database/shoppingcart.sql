-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 04, 2024 at 01:20 PM
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
-- Database: `shoppingcart`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_date` datetime NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `grand_total` decimal(8,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(8,0) NOT NULL DEFAULT 0,
  `quantilty` int(11) NOT NULL DEFAULT 0,
  `total` decimal(8,0) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_name` varchar(255) NOT NULL,
  `price` decimal(8,0) NOT NULL DEFAULT 0,
  `profile_image` varchar(255) DEFAULT NULL,
  `detail` text DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_name`, `price`, `profile_image`, `detail`, `id`) VALUES
('อุปกรณ์เสริมจอยเกม สําหรับ Nintendo Switch Oled', 199, '60ad27edca508e62da99b505b93678ce.jfif', 'Feature : for Nintendo Switch joycon\r\nFeature 1 : for Nintendo Switch accessories\r\nFeature 2 : for Nintendo Switch oled joycon\r\nPackage include:\r\n1 x switch gun\r\ndon\'t include joycon', 12),
('Play Project จอยโยก Qanba Q5 Arcade Stick สำหรับ PS5/PS4/PS3/PC', 14000, '4cd8665fd032d835a6459c67665c6b93_65718264a388f__1200x1200.jpg', 'จอยโยก Qanba Q5 Arcade Stick สำหรับ PS5/PS4/PS3/PC', 13),
('Somic G951 ชุดหูฟังสเตอริโอเล่นเกม PC USB 7.1 พร้อมไมโครโฟน ไฟ Led สําหรับ PS4 แล็ปท็อป คอมพิวเตอร์', 1300, 'cn-11134207-7r98o-lq68fd0ffggoab.jfif', 'ชุดหูฟังสำหรับเล่นเกมสีดำ / ชมพู SOMIC G951 สำหรับพีซี, โฮสต์ PS4, แล็ปท็อป: หูฟังหูแมวแบบถอดได้เสมือนจริง 7.1 LED, USB, หูฟังแบบครอบหูน้ำหนักเบาสีดำ', 14);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `urole`, `create_at`) VALUES
(5, 'Nattakit', 'Boonmangam', 'ford4961@hotmail.com', '$2y$10$4mMeksYgdOwCnOrZhjVVb.fmmjXOiTSMylF5awEv62MmQplW2zDiG', 'user', '2024-03-03 13:33:47'),
(6, 'bom', 'parm', 'jam@pop.com', '$2y$10$lEc/tV9dm2qLmdd1rnbAGOkvh553wcLyxtxeuqbdzQ0NtUnLqUqjG', 'admin', '2024-03-03 14:17:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_id`,`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
