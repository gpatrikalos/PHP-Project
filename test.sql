-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 09:35 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryname` varchar(50) NOT NULL,
  `availability` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryname`, `availability`) VALUES
('Books', 1),
('Cables', 0),
('Tech', 1);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `product_id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `price` float NOT NULL,
  `amount` int(5) NOT NULL,
  `maxprice` float NOT NULL,
  `finaldate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`product_id`, `name`, `category`, `description`, `price`, `amount`, `maxprice`, `finaldate`) VALUES
(1, 'LG TV MONITOR', 'TECH', 'On of a kind Tv', 0, 0, 50, '2018-02-28'),
(2, 'iphone 7', 'Tech', 'next gen phone', 0, 0, 80, '2018-02-28'),
(3, 'Harry Potter', 'Books', 'The brand new harry potter book', 150, 0, 300, '2018-02-28'),
(4, 'Razer blackwidow', 'Tech', 'new keyboard from razer', 0, 0, 150, '2018-02-28'),
(5, 'Inferno', 'Books', 'New book the sequel of illuminati', 0, 0, 250, '2018-02-28'),
(6, 'Kraken 7.1 Headphones', 'Tech', 'Razer 7.1 all around sound  headphones', 0, 0, 100, '2018-02-28');

--
-- Triggers `items`
--
DELIMITER $$
CREATE TRIGGER `NotificationCounter` AFTER UPDATE ON `items` FOR EACH ROW UPDATE users,wishlist,items
set count_notifications = IFNULL(count_notifications,0) + 1
where items.product_id=wishlist.product_id and wishlist.username=users.username and amount = new.amount
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `notif_id` int(50) NOT NULL,
  `product_id` int(50) NOT NULL,
  `message` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `product_id`, `message`) VALUES
(0, 3, 'New price on product 3 Harry set on 150');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `count_notifications` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `name`, `surname`, `birthday`, `password`, `email`, `address`, `count_notifications`) VALUES
('admin', 'Vaggelis', 'Paparrizos', '1995-06-15', 'admin', 'cs131101@teiath.gr', 'antigonis', 0),
('vag', 'Vaggelis', 'Paparrizos', '1995-09-08', '1234', 'abcd@hotmail.com', 'kanarinias 10', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `product_id` int(3) NOT NULL,
  `username` varchar(50) NOT NULL,
  `useramount` int(5) NOT NULL,
  `key1` int(3) NOT NULL,
  `flag` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`product_id`, `username`, `useramount`, `key1`, `flag`) VALUES
(0, 'vag', 123, 7, 0),
(0, 'vag', 3434, 8, 0),
(0, 'vag', 123123, 9, 0);

--
-- Triggers `wishlist`
--
DELIMITER $$
CREATE TRIGGER `DELETE_WishlistItem` BEFORE DELETE ON `wishlist` FOR EACH ROW UPDATE items
SET amount = IFNULL(amount, 0) - old.useramount
WHERE product_id= OLD.product_id
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryname`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_id` (`product_id`),
  ADD KEY `category` (`category`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`key1`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `product_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11214;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `key1` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
