-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 10, 2024 at 05:20 PM
-- Server version: 8.0.36-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `famous`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(12) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(15) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`) VALUES
('habib', 'famousoldwood');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `subject` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `message` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `name`, `subject`, `email`, `message`) VALUES
(1, 'Taha', 'tewuy@jsdf.dsf', 'Test', 'Hiii');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int NOT NULL,
  `name` text COLLATE utf8mb4_general_ci NOT NULL,
  `price` int NOT NULL,
  `image` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `name`, `price`, `image`, `description`) VALUES
(1, 'DR-001', 10000, 'DR-1.jpg', ''),
(2, 'DR-002', 15000, 'DR-2.jpg', ''),
(3, 'DR-003', 8000, 'DR-3.jpg', NULL),
(4, 'DR-004', 8000, 'DR-4.jpg', NULL),
(5, 'DR-005', 8000, 'DR-5.jpg', NULL),
(6, 'DR-006', 8000, 'DR-6.jpg', NULL),
(7, 'DR-007', 8000, 'DR-7.jpg', NULL),
(8, 'DR-008', 8000, 'DR-8.jpg', NULL),
(9, 'DR-009', 8000, 'DR-9.jpg', NULL),
(10, 'DR-010', 8000, 'DR-10.jpg', NULL),
(11, 'DR-011', 8000, 'DR-11.jpg', NULL),
(12, 'DR-012', 8000, 'DR-12.jpg', NULL),
(13, 'DR-013', 8000, 'DR-13.jpg', NULL),
(14, 'DR-014', 8000, 'DR-14.jpg', NULL),
(15, 'DR-015', 8000, 'DR-15.jpg', NULL),
(16, 'DR-016', 8000, 'DR-16.jpg', NULL),
(17, 'DR-017', 8000, 'DR-17.jpg', NULL),
(18, 'DR-018', 8000, 'DR-18.jpg', NULL),
(19, 'DR-019', 8000, 'DR-19.jpg', NULL),
(20, 'DR-020', 8000, 'DR-20.jpg', NULL),
(21, 'DR-021', 8000, 'DR-21.jpg', NULL),
(22, 'DR-022', 8000, 'DR-22.jpg', NULL),
(23, 'DR-023', 8000, 'DR-23.jpg', NULL),
(24, 'DR-024', 8000, 'DR-24.jpg', NULL),
(25, 'DR-025', 8000, 'DR-25.jpg', NULL),
(26, 'DR-026', 8000, 'DR-26.jpg', NULL),
(27, 'DR-027', 8000, 'DR-27.jpg', NULL),
(28, 'DR-028', 8000, 'DR-28.jpg', NULL),
(29, 'DR-029', 8000, 'DR-29.jpg', NULL),
(30, 'DR-030', 8000, 'DR-30.jpg', NULL),
(31, 'DR-031', 8000, 'DR-31.jpg', NULL),
(32, 'DR-032', 8000, 'DR-32.jpg', NULL),
(33, 'DR-033', 8000, 'DR-33.jpg', NULL),
(34, 'DR-034', 8000, 'DR-34.jpg', NULL),
(35, 'DR-035', 8000, 'DR-35.jpg', NULL),
(36, 'DR-036', 8000, 'DR-36.jpg', NULL),
(37, 'DR-037', 8000, 'DR-37.jpg', NULL),
(38, 'DR-038', 8000, 'DR-38.jpg', NULL),
(39, 'DR-039', 8000, 'DR-39.jpg', NULL),
(40, 'DR-040', 8000, 'DR-40.jpg', NULL),
(41, 'DR-041', 8000, 'DR-41.jpg', NULL),
(42, 'DR-042', 8000, 'DR-42.jpg', NULL),
(43, 'DR-043', 8000, 'DR-43.jpg', NULL),
(44, 'DR-044', 8000, 'DR-44.jpg', NULL),
(45, 'DR-045', 8000, 'DR-45.jpg', NULL),
(46, 'DR-046', 8000, 'DR-46.jpg', NULL),
(47, 'DR-047', 8000, 'DR-47.jpg', NULL),
(48, 'DR-048', 8000, 'DR-48.jpg', NULL),
(49, 'DR-049', 8000, 'DR-49.jpg', NULL),
(50, 'DR-050', 8000, 'DR-50.jpg', NULL),
(51, 'DR-051', 8000, 'DR-51.jpg', NULL),
(52, 'DR-052', 8000, 'DR-52.jpg', NULL),
(53, 'DR-053', 8000, 'DR-53.jpg', NULL),
(54, 'DR-054', 8000, 'DR-54.jpg', NULL),
(55, 'DR-055', 8000, 'DR-55.jpg', NULL),
(56, 'DR-056', 8000, 'DR-56.jpg', NULL),
(57, 'DR-057', 8000, 'DR-57.jpg', NULL),
(58, 'DR-058', 8000, 'DR-58.jpg', NULL),
(59, 'DR-059', 8000, 'DR-59.jpg', NULL),
(60, 'DR-060', 8000, 'DR-60.jpg', NULL),
(61, 'DR-061', 8000, 'DR-61.jpg', NULL),
(62, 'DR-062', 8000, 'DR-62.jpg', NULL),
(63, 'DR-063', 8000, 'DR-63.jpg', NULL),
(64, 'DR-064', 8000, 'DR-64.jpg', NULL),
(65, 'DR-065', 8000, 'DR-65.jpg', NULL),
(66, 'DR-066', 8000, 'DR-66.jpg', NULL),
(67, 'DR-067', 8000, 'DR-67.jpg', NULL),
(68, 'DR-068', 8000, 'DR-68.jpg', NULL),
(69, 'DR-069', 8000, 'DR-69.jpg', NULL),
(70, 'DR-070', 8000, 'DR-70.jpg', NULL),
(71, 'DR-071', 8000, 'DR-71.jpg', NULL),
(72, 'DR-072', 8000, 'DR-72.jpg', NULL),
(73, 'DR-073', 8000, 'DR-73.jpg', NULL),
(74, 'DR-074', 8000, 'DR-74.jpg', NULL),
(75, 'DR-075', 8000, 'DR-75.jpg', NULL),
(76, 'DR-076', 8000, 'DR-76.jpg', NULL),
(77, 'DR-077', 8000, 'DR-77.jpg', NULL),
(78, 'DR-078', 8000, 'DR-78.jpg', NULL),
(79, 'DR-079', 8000, 'DR-79.jpg', NULL),
(80, 'DR-080', 8000, 'DR-80.jpg', NULL),
(81, 'DR-081', 8000, 'DR-81.jpg', NULL),
(82, 'DR-082', 8000, 'DR-82.jpg', NULL),
(83, 'DR-083', 8000, 'DR-83.jpg', NULL),
(84, 'DR-084', 8000, 'DR-84.jpg', NULL),
(85, 'DR-085', 8000, 'DR-85.jpg', NULL),
(86, 'DR-086', 8000, 'DR-86.jpg', NULL),
(87, 'DR-087', 8000, 'DR-87.jpg', NULL),
(88, 'DR-088', 8000, 'DR-88.jpg', NULL),
(89, 'DR-089', 8000, 'DR-89.jpg', NULL),
(90, 'DR-090', 8000, 'DR-90.jpg', NULL),
(91, 'DR-091', 8000, 'DR-91.jpg', NULL),
(92, 'DR-092', 8000, 'DR-92.jpg', NULL),
(93, 'DR-093', 8000, 'DR-93.jpg', NULL),
(94, 'DR-094', 8000, 'DR-94.jpg', NULL),
(95, 'DR-095', 8000, 'DR-95.jpg', NULL),
(96, 'DR-096', 8000, 'DR-96.jpg', NULL),
(97, 'DR-097', 8000, 'DR-97.jpg', NULL),
(98, 'DR-098', 8000, 'DR-98.jpg', NULL),
(99, 'DR-099', 8000, 'DR-99.jpg', NULL),
(100, 'DR-100', 8000, 'DR-100.jpg', NULL),
(101, 'DR-101', 8000, 'DR-101.jpg', NULL),
(102, 'DR-102', 8000, 'DR-102.jpg', NULL),
(103, 'DR-103', 8000, 'DR-103.jpg', NULL),
(104, 'DR-104', 8000, 'DR-104.jpg', NULL),
(105, 'DR-105', 8000, 'DR-105.jpg', NULL),
(106, 'DR-106', 8000, 'DR-106.jpg', NULL),
(107, 'DR-107', 8000, 'DR-107.jpg', NULL),
(108, 'DR-108', 8000, 'DR-108.jpg', NULL),
(109, 'DR-109', 8000, 'DR-109.jpg', NULL),
(110, 'DR-110', 8000, 'DR-110.jpg', NULL),
(111, 'DR-111', 8000, 'DR-111.jpg', NULL),
(112, 'DR-112', 8000, 'DR-112.jpg', NULL),
(113, 'DR-113', 8000, 'DR-113.jpg', NULL),
(114, 'DR-114', 8000, 'DR-114.jpg', NULL),
(115, 'DR-115', 10000, 'DR-115.jpg', ''),
(116, 'DR-116', 8000, 'DR-116.jpg', NULL),
(117, 'DR-117', 8000, 'DR-117.jpg', NULL),
(121, 'teak wood door', 70000, 'msg-1001598690364-131520.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `tid` int NOT NULL,
  `c_name` text NOT NULL,
  `mobile_no` bigint NOT NULL,
  `address` text NOT NULL,
  `amount` int NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`tid`, `c_name`, `mobile_no`, `address`, `amount`, `status`, `date`) VALUES
(1, 'Taha', 8847747867, 'test', 32000, 'completed', '2023-04-26 16:58:15'),
(2, 'shafiq', 8698794210, 'malrgan', 8000, 'completed', '2023-04-30 06:37:16'),
(3, 'Famous ', 9960593849, 'Rom no 101floor nago mama niwas charni pada road kausa mumbra', 8000, 'pending', '2023-05-11 17:09:48');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_product_details`
--

CREATE TABLE `transaction_product_details` (
  `tid` int NOT NULL,
  `pid` int NOT NULL,
  `quantity` int NOT NULL,
  `size` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `transaction_product_details`
--

INSERT INTO `transaction_product_details` (`tid`, `pid`, `quantity`, `size`) VALUES
(1, 4, 1, 55),
(1, 11, 3, 33),
(2, 10, 1, 37),
(3, 109, 1, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`tid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `tid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
