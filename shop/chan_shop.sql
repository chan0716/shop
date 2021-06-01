-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 10:25 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chan_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `order_info`
--

CREATE TABLE `order_info` (
  `id` int(10) NOT NULL,
  `numberofproduct` int(10) NOT NULL,
  `totalamount` float NOT NULL,
  `name` varchar(250) NOT NULL,
  `emailid` varchar(250) NOT NULL,
  `phonenumber` int(10) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_product_stats`
--

CREATE TABLE `order_product_stats` (
  `id` int(10) NOT NULL,
  `orderid` int(10) NOT NULL,
  `productid` int(10) NOT NULL,
  `productname` varchar(25) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sku` varchar(14) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `image` varchar(50) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `sku`, `price`, `image`, `cat_id`, `description`, `short_description`) VALUES
(1, 'Iphone', 'IPHO001', '400.00', 'images/iphone.jpg', 1, 'This product is iPhone.', 'short description - iphone'),
(2, 'Camera', 'CAME001', '700.00', 'images/camera.jpg', 2, 'This product is Camera', 'short description - camera'),
(3, 'Watch', 'WATC001', '100.00', 'images/watch.jpg', 1, 'This product is Watch.', 'short description -watch');

-- --------------------------------------------------------

--
-- Table structure for table `prod_category`
--

CREATE TABLE `prod_category` (
  `id` int(10) NOT NULL,
  `name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prod_category`
--

INSERT INTO `prod_category` (`id`, `name`) VALUES
(1, 'First'),
(2, 'Second');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `order_info`
--
ALTER TABLE `order_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_product_stats`
--
ALTER TABLE `order_product_stats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `prod_category`
--
ALTER TABLE `prod_category`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `order_info`
--
ALTER TABLE `order_info`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_product_stats`
--
ALTER TABLE `order_product_stats`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prod_category`
--
ALTER TABLE `prod_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
