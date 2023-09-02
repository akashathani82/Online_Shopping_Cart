-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2023 at 01:01 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mycart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) DEFAULT NULL,
  `shipping_address` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `order_date`, `total_amount`, `shipping_address`, `payment_method`) VALUES
(1, 1, '2023-09-01 08:30:25', 89.96, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(2, 1, '2023-09-01 08:33:05', 89.96, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(3, 1, '2023-09-01 08:35:03', 89.96, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(5, 1, '2023-09-01 08:37:45', 99.97, 'Banglore, Karnataka', 'paypal'),
(6, 1, '2023-09-01 08:41:11', 0.00, 'Banglore, Karnataka', 'paypal'),
(7, 1, '2023-09-01 08:48:24', 39.98, 'Delhi', 'credit_card'),
(8, 1, '2023-09-01 08:59:03', 89.97, 'Banglore, Karnataka', 'paypal'),
(9, 1, '2023-09-01 08:59:32', 89.97, 'Banglore, Karnataka', 'paypal'),
(10, 1, '2023-09-01 08:59:42', 89.97, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(11, 1, '2023-09-01 09:00:25', 89.97, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(12, 1, '2023-09-01 09:00:31', 89.97, 'Sheersai, Pune, Maharashtra', 'credit_card'),
(13, 1, '2023-09-01 09:02:32', 129.95, 'Sheersai, Pune, Maharashtra', 'paypal'),
(14, 1, '2023-09-01 09:06:18', 129.95, 'Sheersai, Pune, Maharashtra', 'paypal'),
(15, 1, '2023-09-01 09:10:32', 19.99, 'Delhi', 'paypal'),
(16, 1, '2023-09-01 09:16:02', 0.00, 'Delhi', 'paypal'),
(17, 1, '2023-09-01 09:18:32', 79.98, 'Rajasthan', 'paypal'),
(18, 1, '2023-09-01 09:52:37', 149.95, 'Delhi', 'paypal'),
(19, 1, '2023-09-01 09:56:25', 59.97, 'Rajasthan', 'paypal'),
(20, 1, '2023-09-01 10:25:44', 219.94, 'Banglore, Karnataka', 'paypal');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price_per_item` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price_per_item`) VALUES
(1, 3, 1, 0, 19.99),
(2, 3, 2, 0, 19.99),
(3, 3, 7, 0, 19.99),
(4, 3, 5, 0, 19.99),
(5, 5, 1, 0, 39.99),
(6, 5, 15, 0, 39.99),
(7, 5, 16, 0, 39.99),
(8, 7, 1, 0, 0.00),
(9, 7, 4, 0, 0.00),
(10, 14, 6, 0, 0.00),
(11, 14, 10, 0, 0.00),
(12, 14, 14, 0, 0.00),
(13, 14, 1, 0, 0.00),
(14, 14, 2, 0, 0.00),
(15, 15, 6, 1, 0.00),
(16, 17, 15, 1, 0.00),
(17, 17, 16, 1, 0.00),
(18, 18, 15, 1, 0.00),
(19, 18, 13, 1, 0.00),
(20, 18, 8, 1, 0.00),
(21, 18, 5, 1, 0.00),
(22, 18, 6, 1, 0.00),
(23, 19, 1, 1, 0.00),
(24, 19, 2, 1, 0.00),
(25, 19, 8, 1, 0.00),
(26, 20, 11, 1, 0.00),
(27, 20, 10, 1, 0.00),
(28, 20, 15, 1, 0.00),
(29, 20, 16, 1, 0.00),
(30, 20, 9, 1, 0.00),
(31, 20, 6, 1, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, 'Shirt', 'Summer wear, printed, half sleeve', 19.99, 'http://localhost/online-shopping/images/products/f1.jpg'),
(2, 'Shirt', 'Summer wear, printed, half sleeve', 19.99, 'http://localhost/online-shopping/images/products/f2.jpg'),
(3, 'Shirt', 'Summer wear, printed, half sleeve', 19.99, 'http://localhost/online-shopping/images/products/f3.jpg'),
(4, 'Shirt', 'Summer wear, printed, half sleeve', 19.99, 'http://localhost/online-shopping/images/products/f4.jpg'),
(5, 'Shirt', 'Summer wear, printed, half sleeve', 19.99, 'http://localhost/online-shopping/images/products/f5.jpg'),
(6, 'Shirt', 'Summer wear, printed, full sleeve with a white t-shirt attached', 19.99, 'http://localhost/online-shopping/images/products/f6.jpg'),
(7, 'Pant', 'Summer wear, plazo for women', 29.99, 'http://localhost/online-shopping/images/products/f7.jpg'),
(8, 'Top', 'Summer wear, women, printed, full sleeve', 19.99, 'http://localhost/online-shopping/images/products/f8.jpg'),
(9, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n1.jpg'),
(10, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n2.jpg'),
(11, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n3.jpg'),
(12, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n4.jpg'),
(13, 'Shirt', 'Men, Denim, full sleeve', 49.99, 'http://localhost/online-shopping/images/products/n5.jpg'),
(14, 'Pant', 'Men, short', 29.99, 'http://localhost/online-shopping/images/products/n6.jpg'),
(15, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n7.jpg'),
(16, 'Shirt', 'Men, full sleeve', 39.99, 'http://localhost/online-shopping/images/products/n8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'John Doe', 'john@example.com', 'hashed_password'),
(2, 'Jane Smith', 'jane@example.com', 'hashed_password'),
(3, 'Akash Athani', 'athaniakash7@gmail.com', '$2y$10$M5Y54c1uFpUz0Oxs5P5e4uI2kutM8eWvMAIZRlLmnqGPMmWchoHVq'),
(5, 'Malhar', 'malhar@example.com', '$2y$10$Y37Y0C5rAPUXqXBaYYT6YefVKHkUcSzvA/fILNl4yp/Bz10up/nQe'),
(6, 'Abhijit', 'abhijit@example.com', '$2y$10$krMDOrcAzcgAKWiRTk/8z.Tppo4LJCN29cr7FNo/aEsUc1ujhkvbm'),
(7, 'Pranav Shine', 'pranav@example.com', '$2y$10$yz37Ylez/ijrpl/scGtqbOOoetPWsyhZlq9b7f9eyX4x3RVkCuj4y'),
(9, 'Vaibhav', 'vaibhav@example.com', '$2y$10$gX.kSpFLNzmYKNRE3/2yeOSoFPo5iwIGkic7q7qc9eQ24YaUtCpuu'),
(10, 'Atul', 'atul@gmail.com', '$2y$10$nToBDwF8dNUmF9xyjcoc0.WWOXAK.QPjP.aX.q0FEMwjKQ7vnwg.y'),
(11, 'Pooja Verma', 'pooja@gmail.com', '$2y$10$61F6j0H6v91xbXJRD7xfNekMz4H3Rkt8YEwAI.liGEL5.oTOEIRDa'),
(12, 'Sagar Sharma', 'sagar@gmail.com', '$2y$10$RwNQmBUQBByZ3VoyJXyASeazArj86tQb3NIYUiNb2Ay/z7y/8tX5m'),
(13, 'Amol Pande', 'amolpande@gmail.com', '$2y$10$n5epEwQ4CMlH4ZRoun57deWt.hcoYMxReBvKp8Ou48X34x7v5M3oa'),
(14, 'Shilpa', 'shilpa@gmail.com', '$2y$10$.XX2xHJIUr1dZevEnNxykuQfAyt28CliRUfvO6693Zr4oxT.SfYDi'),
(15, 'Test Me', 'testme@gmail.com', '$2y$10$fvpv8aR6nVz4YRjAanG6zeg6X0zpSvkRVf/Zj0MOmLHDTnTcIK5C2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

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
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
