-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 15, 2023 at 03:29 PM
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
-- Database: `database_inv`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_requests`
--

CREATE TABLE `borrow_requests` (
  `id` int(6) NOT NULL,
  `item_request` varchar(50) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL,
  `model_number` varchar(50) NOT NULL,
  `property_number` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `purpose` varchar(100) NOT NULL,
  `date_needed` date NOT NULL,
  `date_borrowed` date DEFAULT NULL,
  `date_returned` date DEFAULT NULL,
  `requesting_person` varchar(75) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrow_requests`
--

INSERT INTO `borrow_requests` (`id`, `item_request`, `manufacturer_name`, `model_number`, `property_number`, `quantity`, `purpose`, `date_needed`, `date_borrowed`, `date_returned`, `requesting_person`) VALUES
(41, 'Laptop', 'Dell', 'G15', 'OE-12345', 1, 'Gaming', '2023-08-14', '2023-08-14', '2023-08-14', 'George Isidro'),
(42, 'Notebook', 'Veco', 'None', 'OE-13421', 1, 'Writing', '2023-08-14', '2023-08-14', '2023-08-14', 'Juan De La Cruz'),
(43, 'Crimping Tool', 'Fluke', 'V1', 'OE-23236', 1, 'Wire Cutting', '2023-08-14', '2023-08-14', '2023-08-14', 'George Isidro'),
(44, 'Notebook', 'Veco', 'None', 'OE-13421', 1, 'Writing', '2023-08-14', '2023-08-04', '2023-08-14', 'Jericho Isidro'),
(45, 'Crimping Tool', 'Fluke', 'V1', 'OE-23236', 1, 'try', '2023-08-14', '2023-08-14', '2023-08-14', 'George Isidro'),
(46, 'Marker', 'HBW', 'None', 'OE-16978', 10, 'writing', '2023-08-15', '2023-08-14', '2023-08-14', 'Jericho Isidro'),
(47, 'Laptop', 'Apple', 'Macbook M3', 'OE-14433', 1, 'Presentation', '2023-08-14', '2023-08-14', '2023-08-14', 'Lebron James');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_requests`
--
ALTER TABLE `borrow_requests`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
