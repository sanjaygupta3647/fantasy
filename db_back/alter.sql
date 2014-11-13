-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 12, 2014 at 07:35 AM
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
  `prediction_gift` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `pro_prediction`
--

INSERT INTO `pro_prediction` (`pid`, `prediction`, `prediction_points`, `prediction_gift`, `status`) VALUES
(1, 'which team will win ', 50, '$10', 'Active'),
(2, ' Who wins the toss', 50, 'Bat', 'Active'),
(3, ' Runs scored in 1st over', 100, '$20', 'Active'),
(4, 'Man of the Match', 200, '$50', 'Active'),
(5, 'Total Score by (Team1)', 300, '$100', 'Active'),
(6, 'Total Score by (Team2)', 300, '$100', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
