-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2019 at 09:32 AM
-- Server version: 5.7.11-log
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sallyport_dsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitcounter`
--

CREATE TABLE `tbl_visitcounter` (
  `visitCounterID` smallint(1) UNSIGNED ZEROFILL NOT NULL DEFAULT '1',
  `visitCounterValue` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_visitcounter`
--

INSERT INTO `tbl_visitcounter` (`visitCounterID`, `visitCounterValue`) VALUES
(1, 449);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_visitcounter`
--
ALTER TABLE `tbl_visitcounter`
  ADD PRIMARY KEY (`visitCounterID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
