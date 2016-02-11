-- phpMyAdmin SQL Dump
-- version 4.5.3.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2016 at 03:00 PM
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

DROP TABLE IF EXISTS `Access`;
CREATE TABLE IF NOT EXISTS `Access` (
  `id` int(11) NOT NULL,
  `Relay 1` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 2` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 3` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 4` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 5` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 6` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 7` tinyint(1) NOT NULL DEFAULT '0',
  `Relay 8` tinyint(1) NOT NULL DEFAULT '0',
  `Relay All` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Access`
--

INSERT INTO `Access` (`id`, `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`, `Relay All`) VALUES
(0, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Login`
--

DROP TABLE IF EXISTS `Login`;
CREATE TABLE IF NOT EXISTS `Login` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Login`
--

INSERT INTO `Login` (`id`, `username`, `password`) VALUES
(0, 'NA7KR', '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19');


--
-- Triggers `Login`
--
DROP TRIGGER IF EXISTS `Access`;
DELIMITER $$
CREATE TRIGGER `Access` AFTER INSERT ON `Login` FOR EACH ROW INSERT INTO `Access` (`id`) VALUES (NEW.id)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `Names`
--

DROP TABLE IF EXISTS `Names`;
CREATE TABLE IF NOT EXISTS `Names` (
  `id` int(11) NOT NULL,
  `Relay 1` varchar(256) NOT NULL,
  `Relay 2` varchar(256) NOT NULL,
  `Relay 3` varchar(256) NOT NULL,
  `Relay 4` varchar(256) NOT NULL,
  `Relay 5` varchar(265) NOT NULL,
  `Relay 6` varchar(265) NOT NULL,
  `Relay 7` varchar(265) NOT NULL,
  `Relay 8` varchar(265) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Names`
--

INSERT INTO `Names` (`id`, `Relay 1`, `Relay 2`, `Relay 3`, `Relay 4`, `Relay 5`, `Relay 6`, `Relay 7`, `Relay 8`) VALUES
(0, 'PI', 'Server', 'Radio', 'Not Used', 'Not Used', 'Not Used', 'Not Used', 'Not Used');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
