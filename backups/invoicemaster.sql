-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 16, 2021 at 02:20 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `invoicemaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `lineitems`
--

DROP TABLE IF EXISTS `lineitems`;
CREATE TABLE IF NOT EXISTS `lineitems` (
  `recid` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `tax` int(11) DEFAULT NULL,
  `quantity` int(20) DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `totalwithtx` decimal(10,2) DEFAULT NULL,
  `endeffdt` date DEFAULT NULL,
  PRIMARY KEY (`recid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lineitems`
--

INSERT INTO `lineitems` (`recid`, `name`, `price`, `tax`, `quantity`, `total`, `totalwithtx`, `endeffdt`) VALUES
(1, 'Apples', '100.00', 1, 5, '505.00', NULL, '2021-07-28'),
(2, 'Apples', '100.00', 1, 5, '505.00', NULL, '2021-07-28'),
(3, 'Apples', '100.00', 1, 5, '505.00', NULL, '2021-07-28'),
(4, 'Apples', '100.00', 1, 5, '505.00', NULL, '2021-07-28'),
(5, 'Apples', '10.00', 5, 3, '32.00', NULL, '2021-07-28'),
(6, 'Apples', '10.00', 1, 5, '50.00', '50.50', '2021-07-28'),
(7, 'Apples', '100.00', 10, 2, '200.00', '220.00', '2021-07-28'),
(8, 'Apples', '5.00', 1, 5, '25.00', '25.25', '2021-07-28'),
(9, 'peaches', '2.00', 10, 1, '2.00', '2.20', '2021-08-15'),
(10, 'Oranges', '10.00', 1, 200, '2000.00', '2020.00', '2021-07-29'),
(11, 'Apples', '5.00', 0, 6, '30.00', '30.00', '2021-08-15'),
(12, 'orange', '12.00', 5, 2, '24.00', '25.20', '2021-08-15'),
(13, 'orange', '15.00', 10, 3, '45.00', '49.50', '2021-08-15'),
(14, 'ds', '1.00', 1, 1, '1.00', '1.01', '2021-08-15'),
(15, 'test 1', '1.00', 0, 1, '1.00', '1.00', '2021-08-15'),
(16, 'dfsd', '213.00', 0, 231, '49203.00', '49203.00', '2021-08-15'),
(17, '32', '23.00', 0, 32, '736.00', '736.00', '2021-08-15'),
(18, 'orange', '1.00', 0, 12, '12.00', '12.00', '2021-08-16'),
(19, 'orange', '1.00', 0, 12, '12.00', '12.00', '2021-08-16'),
(20, 'ds', '4.00', 1, 3, '12.00', '12.12', '2021-08-16'),
(21, 'er', '4.00', 0, 3, '12.00', '12.00', '2021-08-16'),
(22, 'orange', '3.00', 5, 2, '6.00', '6.30', '2021-08-16'),
(23, 'pooo', '5.00', 5, 2, '10.00', '10.50', '2021-08-16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
