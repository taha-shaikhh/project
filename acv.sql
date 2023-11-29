-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2023 at 07:24 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acv`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_channels`
--

CREATE TABLE `all_channels` (
  `channel_id` int(11) NOT NULL,
  `channel_name` text NOT NULL,
  `price` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `all_channels`
--

INSERT INTO `all_channels` (`channel_id`, `channel_name`, `price`) VALUES
(1, 'test', 12),
(2, 'test2', 2);

-- --------------------------------------------------------

--
-- Table structure for table `packs`
--

CREATE TABLE `packs` (
  `pack_id` int(11) NOT NULL,
  `pack_name` text NOT NULL,
  `pack_price` int(12) NOT NULL,
  `pack_type` text NOT NULL,
  `channels` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packs`
--

INSERT INTO `packs` (`pack_id`, `pack_name`, `pack_price`, `pack_type`, `channels`) VALUES
(2, 'Test', 250, 'broadcast', '1,2'),
(0, 'Platinum', 500, 'channels', '1,2');

-- --------------------------------------------------------

--
-- Table structure for table `recharge_details`
--

CREATE TABLE `recharge_details` (
  `recharge_id` int(12) NOT NULL,
  `customer_name` text NOT NULL,
  `vc_id` int(18) NOT NULL,
  `pack_details` text NOT NULL,
  `transaction_id` int(20) NOT NULL,
  `amount` int(9) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recharge_details`
--

INSERT INTO `recharge_details` (`recharge_id`, `customer_name`, `vc_id`, `pack_details`, `transaction_id`, `amount`, `date`, `status`) VALUES
(1, 'test', 1111, 'gold', 22312, 200, '2023-11-06', 'complete'),
(3, '', 12345, 'Test', 2147483647, 250, '2023-11-16', 'complete'),
(4, '', 12345, 'Test', 2147483647, 250, '2023-11-17', 'complete'),
(5, '1111', 1111, 'Test', 2147483647, 250, '2023-11-27', 'pending'),
(6, 'test', 1111, 'Test', 2147483647, 250, '2023-11-27', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `static_details`
--

CREATE TABLE `static_details` (
  `base_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `static_details`
--

INSERT INTO `static_details` (`base_price`) VALUES
(120);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `user_name` text NOT NULL,
  `vc_id` varchar(15) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `mobile_no` varchar(10) NOT NULL,
  `email` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `reset_token_hash` varchar(64) DEFAULT NULL,
  `reset_token_expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `vc_id`, `password`, `mobile_no`, `email`, `address`, `reset_token_hash`, `reset_token_expires_at`) VALUES
(0, 'test', '1111', '$2y$10$2XRIpHfpbr0VvgdaD9MUt.2w2E.pYfxIsMXnrGX0e4sb7FnDHMAci', '8847747867', 'aw2@ds.df', 'ddfdhdhfgjfghffg', NULL, NULL),
(0, 'Test', '2222', NULL, '9967672377', 'test@gmail.com', 'lksdf8dffkdf', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_channels`
--
ALTER TABLE `all_channels`
  ADD PRIMARY KEY (`channel_id`);

--
-- Indexes for table `recharge_details`
--
ALTER TABLE `recharge_details`
  ADD PRIMARY KEY (`recharge_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_channels`
--
ALTER TABLE `all_channels`
  MODIFY `channel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recharge_details`
--
ALTER TABLE `recharge_details`
  MODIFY `recharge_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
