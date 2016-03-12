-- phpMyAdmin SQL Dump
-- version 4.6.0-alpha1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 11, 2016 at 03:27 PM
-- Server version: 5.6.28-1
-- PHP Version: 5.6.17-3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Relays`
--
CREATE DATABASE IF NOT EXISTS `Relays` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Relays`;

-- --------------------------------------------------------

--
-- Table structure for table `Access`
--

CREATE TABLE `Access` (
  `login_id` int(10) NOT NULL,
  `Relay 1` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 2` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 3` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 4` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 5` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 6` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 7` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 8` tinyint(1) NOT NULL DEFAULT '0',
  `Relay All` tinyint(1) NOT NULL DEFAULT '0',
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Access`
--
INSERT INTO `Access` (`login_id`, `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`, `Relay All`, `Admin`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);



-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

CREATE TABLE `Login` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Name` varchar(32) NOT NULL,
  `Email` varchar(90) NOT NULL,
  `ChangePassword` tinyint(1) NOT NULL DEFAULT '0',
  `temp_pass` varchar(256) NOT NULL,
  `activated` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`id`, `username`, `password`, `Name`, `Email`, `ChangePassword`, `temp_pass`, `activated`) VALUES
(1, 'admin', '*4ACFE3202A5FF5CF467898FC58AAB1D615029441', 'Admin', 'admin@localhost', 0, '', 1);

--
-- Triggers `Login`
--
DELIMITER $$
CREATE TRIGGER `Access` AFTER INSERT ON `Login` FOR EACH ROW INSERT INTO `Access` (`login_id`) VALUES (NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Names`
--

CREATE TABLE `Names` (
  `id` int(10) NOT NULL,
  `Relay 1` varchar(256) NOT NULL,
  `Relay 2` varchar(256) NOT NULL,
  `Relay 3` varchar(256) NOT NULL,
  `Relay 4` varchar(256) NOT NULL,
  `Relay 5` varchar(265) NOT NULL,
  `Relay 6` varchar(265) NOT NULL,
  `Relay 7` varchar(265) NOT NULL,
  `Relay 8` varchar(265) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Names`
--

INSERT INTO `Names` (`id`, `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`) VALUES
(0, 'Radio', 'PI', '3', '4', '5', '6', '7', '8');

-- --------------------------------------------------------

--
-- Table structure for table `Security`
--

CREATE TABLE `Security` (
  `id` int(10) NOT NULL,
  `IP_Address` varchar(15) NOT NULL,
  `Action` varchar(256) NOT NULL,
  `Username` varchar(256) NOT NULL,
  `Tries` int(2) NOT NULL DEFAULT '1',
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Security`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `Access`
--
ALTER TABLE `Access`
  ADD UNIQUE KEY `id` (`login_id`);

--
-- Indexes for table `Login`
--
ALTER TABLE `Login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Names`
--
ALTER TABLE `Names`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Security`
--
ALTER TABLE `Security`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Login`
--
ALTER TABLE `Login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- AUTO_INCREMENT for table `Security`
--
ALTER TABLE `Security`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Access`
--
ALTER TABLE `Access`
  ADD CONSTRAINT `Access_fk_login` FOREIGN KEY (`login_id`) REFERENCES `Login` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

