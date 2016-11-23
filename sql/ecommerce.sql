-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2016 at 07:13 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE `balance` (
  `user_id` int(5) NOT NULL,
  `current_balance` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance`
--

INSERT INTO `balance` (`user_id`, `current_balance`) VALUES
(1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(1) NOT NULL,
  `name` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Trading Cards'),
(2, 'CDs'),
(3, 'Consoles'),
(4, 'Peripherals');

-- --------------------------------------------------------

--
-- Table structure for table `listing`
--

CREATE TABLE `listing` (
  `listing_id` int(7) NOT NULL,
  `user_id` int(5) NOT NULL,
  `product_name` varchar(150) NOT NULL,
  `category` int(1) NOT NULL,
  `price` int(5) NOT NULL,
  `item_condition` varchar(9) NOT NULL,
  `product_description` varchar(2000) NOT NULL,
  `list_date` date NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(7) NOT NULL,
  `user_id` int(5) NOT NULL,
  `order_date` date NOT NULL,
  `order_total` int(5) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(7) NOT NULL,
  `product_id` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reputation`
--

CREATE TABLE `reputation` (
  `user_id` int(5) NOT NULL,
  `reviewer_id` int(5) NOT NULL,
  `feedback` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `ID` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`ID`, `name`) VALUES
(1, 'OPEN'),
(2, 'CLOSED'),
(3, 'PENDING'),
(4, 'GOOD'),
(5, 'BANNED'),
(6, 'LOCKED'),
(7, 'AVAILABLE'),
(8, 'PURCHASED'),
(9, 'PACKING'),
(10, 'SHIPPING'),
(11, 'RECEIVED'),
(12, 'USER'),
(13, 'ADMIN'),
(14, 'REFUNDED');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(7) NOT NULL,
  `sender_id` int(5) NOT NULL,
  `listing_id` int(7) NOT NULL,
  `verified_by` varchar(50) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(7) NOT NULL,
  `user_id` int(5) NOT NULL,
  `order_id` int(7) NOT NULL,
  `transaction_method` int(2) NOT NULL,
  `amount` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_methods`
--

CREATE TABLE `transaction_methods` (
  `ID` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction_methods`
--

INSERT INTO `transaction_methods` (`ID`, `name`) VALUES
(1, 'balance');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(5) NOT NULL,
  `username` varchar(20) NOT NULL,
  `passwordhash` varchar(200) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone_num` varchar(20) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `passwordhash`, `fname`, `lname`, `email`, `address`, `phone_num`, `status`) VALUES
(1, 'lucas', '$2y$10$zkRXw1nh4Ul7QkBDl5pEiObVCi/khxGp0u7dCcrGNAMGJvm9KWSOC', 'Lucas', 'Kourouklis', 'lucas.kourouklis@gmail.com', '223 Rue Lauzon', '4506897096', 13);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance`
--
ALTER TABLE `balance`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `listing`
--
ALTER TABLE `listing`
  ADD PRIMARY KEY (`listing_id`),
  ADD KEY `listing_user_id_fk` (`user_id`),
  ADD KEY `status` (`status`),
  ADD KEY `category` (`category`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_fk` (`user_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD UNIQUE KEY `order_id_2` (`order_id`,`product_id`),
  ADD KEY `order_product_order_id_fk` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `reputation`
--
ALTER TABLE `reputation`
  ADD PRIMARY KEY (`user_id`,`reviewer_id`),
  ADD KEY `reputation_reviewer_id_fk` (`reviewer_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `ticket_sender_id_fk` (`sender_id`),
  ADD KEY `ticket_listing_id_fk` (`listing_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_method` (`transaction_method`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `transaction_methods`
--
ALTER TABLE `transaction_methods`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `listing`
--
ALTER TABLE `listing`
  MODIFY `listing_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `ID` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `transaction_methods`
--
ALTER TABLE `transaction_methods`
  MODIFY `ID` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `listing`
--
ALTER TABLE `listing`
  ADD CONSTRAINT `listing_category_fk` FOREIGN KEY (`category`) REFERENCES `category` (`id`),
  ADD CONSTRAINT `listing_status_fk` FOREIGN KEY (`status`) REFERENCES `status` (`ID`),
  ADD CONSTRAINT `listing_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_status_fk` FOREIGN KEY (`status`) REFERENCES `status` (`ID`),
  ADD CONSTRAINT `orders_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_product_order_id_fk` FOREIGN KEY (`product_id`) REFERENCES `listing` (`listing_id`);

--
-- Constraints for table `reputation`
--
ALTER TABLE `reputation`
  ADD CONSTRAINT `reputation_reviewer_id_fk` FOREIGN KEY (`reviewer_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `reputation_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_listing_id_fk` FOREIGN KEY (`listing_id`) REFERENCES `listing` (`listing_id`),
  ADD CONSTRAINT `ticket_sender_id_fk` FOREIGN KEY (`sender_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `ticket_status_fk` FOREIGN KEY (`status`) REFERENCES `status` (`ID`);

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_order_id_fk` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `transaction_trans_method_fk` FOREIGN KEY (`transaction_method`) REFERENCES `transaction_methods` (`ID`),
  ADD CONSTRAINT `transaction_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_status_fk` FOREIGN KEY (`status`) REFERENCES `status` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
