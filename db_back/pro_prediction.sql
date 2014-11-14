-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 09:05 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
-- Table structure for table `pro_prediction`
--

CREATE TABLE IF NOT EXISTS `pro_prediction` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `prediction` varchar(255) NOT NULL,
  `prediction_points` int(10) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pro_prediction`
--

INSERT INTO `pro_prediction` (`pid`, `prediction`, `prediction_points`, `status`) VALUES
(1, 'Team Win', 300, 'Active'),
(2, 'Team Wins Toss', 50, 'Active'),
(3, 'Runs in 1st Over', 100, 'Active'),
(4, 'Man of the Match', 250, 'Active'),
(5, 'Total Score Team1', 200, 'Active'),
(6, 'Total Score Team2', 200, 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
