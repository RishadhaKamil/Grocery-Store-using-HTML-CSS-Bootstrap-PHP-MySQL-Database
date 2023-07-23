-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2022 at 11:23 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(9, 43, 'Tom', 'Tom11@gmail.com', '2', 'Hello I&#39;m Tom! Nice Job!');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(12, 42, 'Tom', '4', 'Tom11@gmail.com', 'cash on delivery', 'flat no. 21 Albert street Kandy Central Sri Lanka - 44876', ', Fresh Red Apples ( 1 ), Fresh Strawberries ( 1 ), Fresh Green Apples ( 3 ), Fresh Onions ( 1 ), Fresh Carrots ( 1 )', 15, '08-Sep-2022', 'completed'),
(13, 43, 'Linda', '2', 'Tim11@gmail.com', 'credit card', 'flat no. 31 Walking Street Matara Southern Sri Lanka - 12678', ', Fresh Oranges ( 1 ), Fresh Red Apples ( 3 ), Fresh Figs ( 1 ), Fresh Brinjals ( 3 ), Ferrero Rocher 375g ( 3 )', 22, '08-Sep-2022', 'completed'),
(14, 43, 'Abc', '34', 'aayshafra@gmail.com', 'paypal', 'flat no. 2 Albert street Matara Southern Sri Lanka - 12345', ', Fresh Red Apples ( 3 )', 6, '08-Sep-2022', 'completed'),
(15, 44, 'Anna', '1', 'Anna@gmail.com', 'cash on delivery', 'flat no. 1 Georges Street Colombo Western Sri Lanka - 81200', ', Fresh Red Apples ( 3 ), Fresh Strawberries ( 4 ), Fresh Blueberries ( 4 ), Fresh Oranges ( 4 ), Fresh Watermelon ( 1 ), Fresh Avacados ( 2 )', 32, '08-Sep-2022', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(24, 'Fresh Oranges', 'fruits', 'Freshly picked Oranges from our well-known farmers from their immense harvest.', 3, 'product-1.png'),
(26, 'Fresh Red Apples', 'fruits', 'Freshly picked Red Apples from our well-known farmers from their immense harvest.', 2, 'apple.png'),
(27, 'Fresh Bananas', 'fruits', 'Freshly picked Bananas from our well-known farmers from their immense harvest.', 2, 'ban.jpg'),
(28, 'Fresh Watermelon', 'fruits', 'Freshly picked Watery Watermelons from our well-known farmers from their immense harvest.', 2, 'cart-img-1.png'),
(29, 'Fresh Green Apples', 'fruits', 'Freshly picked eye-catching Green Apples from our well-known farmers from their immense harvest.', 3, 'frt.jpg'),
(30, 'Fresh Strawberries', 'fruits', 'Freshly picked Strawberries from our well-known farmers from their immense harvest.', 1, '321.jpg'),
(31, 'Fresh Blueberries', 'fruits', 'Freshly picked Blueberries from our well-known farmers from their immense harvest.', 1, '45.jpg'),
(32, 'Fresh Figs', 'fruits', 'Freshly picked Figs from our well-known farmers from their immense harvest.', 1, '71.jpg'),
(33, 'Fresh Avacados', 'fruits', 'Freshly picked Avocados from our well-known farmers from their immense harvest.', 2, 'product-6.png'),
(34, 'Fresh Green Lemons', 'fruits', 'Freshly picked Green Lemons from our well-known farmers from their immense harvest.', 2, 'product-8.png'),
(35, 'Fresh Kiwis', 'fruits', 'Freshly picked Kiwis from our well-known farmers from their immense harvest.', 1, 'download (5).jfif'),
(36, 'Fresh Cabbages', 'vegetables', 'Freshly picked Cabbages from our well-known farmers from their immense harvest.', 2, 'product-4.png'),
(37, 'Fresh Potatoes', 'vegetables', 'Freshly picked vegetables from our well-known farmers from their immense harvest.', 2, 'product-5.png'),
(38, 'Fresh Onions', 'vegetables', 'Freshly picked Onions from our well-known farmers from their immense harvest.', 1, 'product-2.png'),
(39, 'Fresh Garlic', 'vegetables', 'Freshly picked garlic from our well-known farmers from their immense harvest.', 2, 'try.jpg'),
(40, 'Fresh Brinjals', 'vegetables', 'Freshly picked Brinjals from our well-known farmers from their immense harvest.', 2, '2.jpg'),
(41, 'Fresh Pumpkins', 'vegetables', 'Freshly picked Pumpkins from our well-known farmers from their immense harvest.', 2, 'az.jpg'),
(42, 'Fresh Cucumbers ', 'vegetables', 'Freshly picked Cucumbers from our well-known farmers from their immense harvest.', 3, '5.jpg'),
(43, 'Fresh Chilies', 'vegetables', 'Freshly picked Chilies from our well-known farmers from their immense harvest.', 1, '6.jpg'),
(44, 'Fresh Carrots', 'vegetables', 'Freshly picked Carrots from our well-known farmers from their immense harvest.', 2, 'vgy.jpg'),
(45, 'Fresh Cod', 'meat', 'Freshly bought Cods from our well-known fisheries from their immense collection.', 3, 'semon fish.png'),
(46, 'Eggs', 'meat', 'Newest hacked eggs from pure and recommended farms.', 2, '4.jfif'),
(47, 'Fresh Tuna', 'meat', 'Freshly bought Tuna from our well-known fisheries from their immense collection.', 2, 'salmon fish.png'),
(48, 'Fresh Shrimps', 'meat', 'Freshly bought Shrimps from our well-known fisheries from their immense collection.', 2, 'image1.jfif'),
(49, 'Chicken Sausages', 'meat', 'Non-Chemical Sausages with pure ingredients blended. ', 3, 'image2.jfif'),
(50, 'Fresh CuttleFish', 'meat', 'Freshly bought Cuttle fishes from our well-known fisheries from their immense collection.', 3, '9.jfif'),
(51, 'Fresh Boneless Chicken', 'meat', 'Freshly bought Boneless Chicken from our well-known farms from their best quality and hygiene.', 3, 'images.jfif'),
(54, 'Chocolate Nutella', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 3, 'download (4).jfif'),
(55, 'Ferrero Rocher 375g', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 2, '3.jfif'),
(56, 'KitKat Chunky Chocolates', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 2, '11.jfif'),
(57, 'Pringles', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 1, '13.jfif'),
(58, 'Kinder Bueno Mini Pack', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 2, '7.jfif'),
(59, 'M & Ms Chocolates', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 2, 'download (1).jfif'),
(60, 'Chocolate Toblerones', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 2, '12.jfif'),
(61, 'Kinder Bueno Cocolates', 'snacks', 'Best Snacks in town! Easy access just visit us and grab them and make your taste buds feel special!', 3, '9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(35, 'Admin1', 'Admin1@FastNFresh.com', '123', 'admin', 'Admin2.jpg'),
(42, 'Tom', 'Tom11@gmail.com', '456', 'user', 'pic-1.png'),
(43, 'Linda', 'Tim11@gmail.com', 'thn', 'user', 'pic-2.png'),
(44, 'Anna', 'Anna@gmail.com', 'zxc', 'user', 'as.jfif'),
(45, 'Admin2', 'Admin2@FastNFresh.com', '890', 'admin', 'Admin2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `pid`, `name`, `price`, `image`) VALUES
(50, 42, 24, 'Fresh Oranges', 3, 'product-1.png'),
(51, 42, 27, 'Fresh Bananas', 2, 'ban.jpg'),
(52, 42, 34, 'Fresh Green Lemons', 2, 'product-8.png'),
(53, 43, 24, 'Fresh Oranges', 3, 'product-1.png'),
(54, 43, 27, 'Fresh Bananas', 2, 'ban.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
