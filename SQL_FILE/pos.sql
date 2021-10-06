-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2021 at 06:05 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE `accounts_tbl` (
  `account_id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `account_type` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`account_id`, `username`, `password`, `account_type`) VALUES
(10, 'admin', 'admin', 'ADMIN'),
(29, 'cashier', 'cashier', 'CASHIER');

-- --------------------------------------------------------

--
-- Table structure for table `order_tbl`
--

CREATE TABLE `order_tbl` (
  `order_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_tbl`
--

INSERT INTO `order_tbl` (`order_id`, `status`) VALUES
(238, 'REMOVED'),
(239, 'REMOVED'),
(240, 'REMOVED'),
(241, 'REMOVED'),
(242, 'REMOVED'),
(243, 'REMOVED'),
(244, 'REMOVED'),
(245, 'REMOVED'),
(246, 'PREPARING'),
(247, 'PREPARING'),
(248, 'PREPARING'),
(249, 'PREPARING'),
(250, 'PREPARING'),
(251, 'PREPARING'),
(252, 'PREPARING'),
(253, 'PREPARING'),
(254, 'PREPARING'),
(255, 'PREPARING'),
(256, 'PLEASE COLLECT'),
(257, 'PLEASE COLLECT'),
(258, 'PLEASE COLLECT'),
(259, 'PLEASE COLLECT'),
(260, 'REMOVED'),
(261, 'REMOVED'),
(262, 'REMOVED'),
(263, 'REMOVED'),
(264, 'PREPARING'),
(265, 'PREPARING'),
(266, 'PREPARING');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `product_category_id` int(11) NOT NULL,
  `product_category_name` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`product_category_id`, `product_category_name`) VALUES
(20, 'Ice Creams'),
(21, 'Soft Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `product_in_transaction`
--

CREATE TABLE `product_in_transaction` (
  `product_id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_name` varchar(400) NOT NULL,
  `product_price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_in_transaction`
--

INSERT INTO `product_in_transaction` (`product_id`, `transaction_id`, `product_name`, `product_price`, `quantity`, `date`, `time`) VALUES
(36, 239, 'skyflakes', 123, 1, '2021-03-28', '17:16:30'),
(36, 241, 'skyflakes', 123, 1, '2021-03-28', '17:16:45'),
(39, 238, 'Jollibee Burger', 35.6, 1, '2021-03-28', '17:16:24'),
(39, 239, 'Jollibee Burger', 35.6, 1, '2021-03-28', '17:16:30'),
(39, 242, 'Jollibee Burger', 35.6, 1, '2021-03-28', '17:32:35'),
(39, 247, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:23:40'),
(39, 248, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:37:23'),
(39, 249, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:37:32'),
(39, 250, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:37:38'),
(39, 251, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:37:47'),
(39, 252, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:37:55'),
(39, 253, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:38:04'),
(39, 254, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:38:17'),
(39, 256, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:38:42'),
(39, 257, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:12'),
(39, 258, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:17'),
(39, 259, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:24'),
(39, 260, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:30'),
(39, 261, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:40'),
(39, 262, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:45'),
(39, 263, 'Jollibee Burger', 35.6, 1, '2021-03-29', '12:39:51'),
(39, 264, 'Jollibee Burger', 35.6, 1, '2021-03-29', '13:17:50'),
(39, 265, 'Jollibee Burger', 35.6, 1, '2021-03-30', '09:34:29'),
(39, 266, 'Jollibee Burger', 35.6, 1, '2021-03-30', '10:05:25'),
(40, 238, 'McDo Burger', 12, 1, '2021-03-28', '17:16:24'),
(40, 239, 'McDo Burger', 12, 1, '2021-03-28', '17:16:30'),
(40, 240, 'McDo Burger', 12, 1, '2021-03-28', '17:16:40'),
(40, 241, 'McDo Burger', 12, 1, '2021-03-28', '17:16:45'),
(40, 242, 'McDo Burger', 12, 1, '2021-03-28', '17:32:35'),
(40, 243, 'McDo Burger', 12, 1, '2021-03-28', '17:38:33'),
(40, 244, 'McDo Burger', 12, 1, '2021-03-28', '17:39:51'),
(40, 246, 'McDo Burger', 12, 1, '2021-03-29', '12:00:47'),
(40, 247, 'McDo Burger', 12, 1, '2021-03-29', '12:23:40'),
(40, 248, 'McDo Burger', 12, 1, '2021-03-29', '12:37:23'),
(40, 249, 'McDo Burger', 12, 1, '2021-03-29', '12:37:32'),
(40, 250, 'McDo Burger', 12, 1, '2021-03-29', '12:37:38'),
(40, 251, 'McDo Burger', 12, 1, '2021-03-29', '12:37:47'),
(40, 252, 'McDo Burger', 12, 1, '2021-03-29', '12:37:55'),
(40, 253, 'McDo Burger', 12, 1, '2021-03-29', '12:38:04'),
(40, 254, 'McDo Burger', 12, 1, '2021-03-29', '12:38:17'),
(40, 255, 'McDo Burger', 12, 1, '2021-03-29', '12:38:23'),
(40, 257, 'McDo Burger', 12, 1, '2021-03-29', '12:39:12'),
(40, 259, 'McDo Burger', 12, 1, '2021-03-29', '12:39:24'),
(40, 260, 'McDo Burger', 12, 1, '2021-03-29', '12:39:30'),
(40, 261, 'McDo Burger', 12, 1, '2021-03-29', '12:39:40'),
(40, 262, 'McDo Burger', 12, 1, '2021-03-29', '12:39:45'),
(40, 263, 'McDo Burger', 12, 1, '2021-03-29', '12:39:51'),
(40, 264, 'McDo Burger', 12, 1, '2021-03-29', '13:17:50'),
(40, 265, 'McDo Burger', 12, 1, '2021-03-30', '09:34:29'),
(40, 266, 'McDo Burger', 12, 1, '2021-03-30', '10:05:25'),
(42, 238, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:16:24'),
(42, 239, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:16:30'),
(42, 240, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:16:40'),
(42, 241, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:16:45'),
(42, 243, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:38:33'),
(42, 245, 'Selecta Cookies and Cream Pop', 15, 1, '2021-03-28', '17:39:57'),
(42, 246, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:00:47'),
(42, 247, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:23:40'),
(42, 250, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:37:38'),
(42, 251, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:37:47'),
(42, 252, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:37:55'),
(42, 253, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:38:04'),
(42, 256, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:38:42'),
(42, 259, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:39:24'),
(42, 260, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:39:30'),
(42, 261, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:39:40'),
(42, 262, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:39:45'),
(42, 263, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-29', '12:39:51'),
(42, 265, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-30', '09:34:29'),
(42, 266, 'Selecta Cookies and Cream Pop', 1, 1, '2021-03-30', '10:05:25'),
(43, 243, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-28', '17:38:33'),
(43, 244, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-28', '17:39:51'),
(43, 245, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-28', '17:39:57'),
(43, 246, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:00:47'),
(43, 254, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:38:17'),
(43, 255, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:38:23'),
(43, 256, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:38:42'),
(43, 261, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:39:40'),
(43, 262, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:39:45'),
(43, 263, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-29', '12:39:51'),
(43, 265, 'Selecta Marshmallow Choco Pop', 15.6, 1, '2021-03-30', '09:34:29'),
(44, 246, 'Piattos Green', 15, 1, '2021-03-29', '12:00:47'),
(44, 265, 'Piattos Green', 15, 1, '2021-03-30', '09:34:29'),
(45, 256, 'Piattos Cheese', 15, 1, '2021-03-29', '12:38:42'),
(45, 265, 'Piattos Cheese', 15, 1, '2021-03-30', '09:34:29'),
(47, 265, 'Fishda', 14, 1, '2021-03-30', '09:34:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_tbl`
--

CREATE TABLE `product_tbl` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(520) NOT NULL,
  `stock_type` varchar(100) NOT NULL,
  `stock` int(11) NOT NULL,
  `categories` varchar(150) NOT NULL,
  `price` float NOT NULL,
  `file` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_tbl`
--

INSERT INTO `product_tbl` (`product_id`, `product_name`, `stock_type`, `stock`, `categories`, `price`, `file`) VALUES
(39, 'Jollibee Burger', 'unlimited', -69, 'Burger', 35.6, '6052cb7bc48d40.77755511.png'),
(40, 'McDo Burger', 'unlimited', -69, 'Burger', 12, '6052cbbbdc4700.29008425.jpg'),
(42, 'Selecta Cookies and Cream Pop', 'limited', 70, 'Ice Creams', 1, '6052cc626f7457.31726519.png'),
(43, 'Selecta Marshmallow Choco Pop', 'limited', 88, 'Ice Creams', 15.6, '6052cc87825c28.41155718.jpg'),
(44, 'Piattos Green', 'limited', 97, 'Chichiryas', 15, '6052ccadc347f5.87461089.jpg'),
(45, 'Piattos Cheese', 'limited', 98, 'Chichiryas', 15, '6052cccc830c50.07957202.png'),
(47, 'Fishda', 'limited', 299, 'Chichiryas', 14, '6052cd5f4596b1.11883443.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_tbl`
--

CREATE TABLE `transaction_tbl` (
  `transaction_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_time` time NOT NULL,
  `account_id` varchar(250) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaction_tbl`
--

INSERT INTO `transaction_tbl` (`transaction_id`, `transaction_date`, `transaction_time`, `account_id`, `total`) VALUES
(238, '2021-03-28', '17:16:24', '26', 62.6),
(239, '2021-03-28', '17:16:30', '26', 185.6),
(240, '2021-03-28', '17:16:40', '26', 39),
(241, '2021-03-28', '17:16:45', '26', 162),
(242, '2021-03-28', '17:32:35', '26', 47.6),
(243, '2021-03-28', '17:38:33', '26', 42.6),
(244, '2021-03-28', '17:39:51', 'cashier', 27.6),
(245, '2021-03-28', '17:39:57', 'cashier', 30.6),
(246, '2021-03-29', '12:00:47', 'cashier', 43.6),
(247, '2021-03-29', '12:23:40', 'cashier', 48.6),
(248, '2021-03-29', '12:37:23', 'cashier', 47.6),
(249, '2021-03-29', '12:37:32', 'cashier', 47.6),
(250, '2021-03-29', '12:37:38', 'cashier', 48.6),
(251, '2021-03-29', '12:37:47', 'cashier', 48.6),
(252, '2021-03-29', '12:37:55', 'cashier', 48.6),
(253, '2021-03-29', '12:38:04', 'cashier', 48.6),
(254, '2021-03-29', '12:38:17', 'cashier', 63.2),
(255, '2021-03-29', '12:38:23', 'cashier', 27.6),
(256, '2021-03-29', '12:38:42', 'cashier', 67.2),
(257, '2021-03-29', '12:39:12', 'cashier', 47.6),
(258, '2021-03-29', '12:39:17', 'cashier', 35.6),
(259, '2021-03-29', '12:39:24', 'cashier', 48.6),
(260, '2021-03-29', '12:39:30', 'cashier', 48.6),
(261, '2021-03-29', '12:39:40', 'cashier', 64.2),
(262, '2021-03-29', '12:39:45', 'cashier', 64.2),
(263, '2021-03-29', '12:39:51', 'cashier', 64.2),
(264, '2021-03-29', '13:17:50', 'cashier', 47.6),
(265, '2021-03-30', '09:34:29', 'cashier', 108.2),
(266, '2021-03-30', '10:05:25', 'cashier', 48.6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD PRIMARY KEY (`account_id`);

--
-- Indexes for table `order_tbl`
--
ALTER TABLE `order_tbl`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_category_id`);

--
-- Indexes for table `product_in_transaction`
--
ALTER TABLE `product_in_transaction`
  ADD UNIQUE KEY `product_id` (`product_id`,`transaction_id`),
  ADD UNIQUE KEY `product_id_2` (`product_id`,`transaction_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `product_tbl`
--
ALTER TABLE `product_tbl`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `order_tbl`
--
ALTER TABLE `order_tbl`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `product_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `product_tbl`
--
ALTER TABLE `product_tbl`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `transaction_tbl`
--
ALTER TABLE `transaction_tbl`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=267;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `product_in_transaction`
--
ALTER TABLE `product_in_transaction`
  ADD CONSTRAINT `transaction_id` FOREIGN KEY (`transaction_id`) REFERENCES `transaction_tbl` (`transaction_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
