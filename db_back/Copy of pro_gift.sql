-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 10:03 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cricket`
--

-- --------------------------------------------------------

--
-- Table structure for table `pro_gift`
--

CREATE TABLE IF NOT EXISTS `pro_gift` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `giftName` varchar(255) NOT NULL,
  `get_points` int(10) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `pro_gift`
--

INSERT INTO `pro_gift` (`pid`, `giftName`, `get_points`, `status`) VALUES
(1, 'Mouse', 50, 'Active'),
(2, 'Key Board', 80, 'Active'),
(3, 'Sport Shos', 120, 'Active'),
(4, 'Google', 20, 'Active'),
(5, 'Fan', 125, 'Active'),
(6, 'Coller', 200, 'Active'),
(7, 'Washing Machin', 250, 'Active'),
(8, 'LCD', 225, 'Active'),
(9, 'Tablet', 300, 'Active'),
(10, 'Home Theater Sound.', 325, 'Active'),
(11, 'PC Desktop', 400, 'Active'),
(12, 'Laptop', 500, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
