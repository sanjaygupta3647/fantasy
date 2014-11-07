-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 07, 2014 at 10:19 PM
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
-- Table structure for table `pro_player`
--

CREATE TABLE IF NOT EXISTS `pro_player` (
  `pid` int(10) NOT NULL AUTO_INCREMENT,
  `playerName` varchar(255) NOT NULL,
  `playerImage` varchar(255) NOT NULL,
  `teamName` varchar(255) NOT NULL,
  `age` int(3) NOT NULL,
  `playerProfile` enum('Batsman','Bowler','All Rounder','Wicket Keeper/Batsman','Caption/Bowler','Caption/All Rounder','Caption/Wicket Keeper','Caption/Batsman','Caption/Wicket Keeper/Batsman') NOT NULL DEFAULT 'Batsman',
  `profileStatus` varchar(255) NOT NULL,
  `playTeams` varchar(255) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`pid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `pro_player`
--

INSERT INTO `pro_player` (`pid`, `playerName`, `playerImage`, `teamName`, `age`, `playerProfile`, `profileStatus`, `playTeams`, `status`) VALUES
(5, 'Inshant Sharma', '2883225689.png', '19', 26, '', '', 'India', 'Active'),
(6, 'MS Dhoni', '1636213019.jpg', '19', 33, '', '', 'INDIA', 'Active'),
(7, 'Virat Kohli', '698917922.jpg', '19', 25, '', '', 'India', 'Active'),
(8, 'Ravichandran Ashwin', '234197576.jpg', '19', 27, '', '', 'India', 'Active'),
(9, 'Stuart Binny', '447212369.jpg', '19', 30, '', '', 'INDIA', 'Active'),
(10, 'Shikhar Dhawan', '288548631.jpg', '19', 28, '', '', 'INDIA', 'Active'),
(11, 'Ravindra Jadeja', '1349023555.jpg', '19', 25, '', '', 'INDIA', 'Active'),
(12, 'Dhawal Kulkarni', '2662310700.jpg', '19', 25, '', '', 'INDIA', 'Active'),
(13, '	 Bhuvneshwar Kumar', '664110710.jpg', '19', 24, '', '', 'INDIA', 'Active'),
(14, 'Mohammed Shami', '19748141.jpg', '19', 24, '', '', 'INDIA', 'Active'),
(15, 'Ajinkya Rahane', '183048633.jpg', '19', 26, '', '', 'INDIA', 'Active'),
(16, 'Suresh Raina', '6931336.jpg', '19', 27, '', '', 'INDIA', 'Active'),
(17, 'Ambati Rayudu', '251548787.jpg', '19', 28, '', '', 'INDIA', 'Active'),
(18, 'Sanju Samson', '60326281.jpg', '2', 19, '', '', 'INDIA', 'Active'),
(19, 'Karn Sharma', '923729482.jpg', '19', 26, '', '', 'INDIA', 'Active'),
(20, 'Mohit Sharma', '1339931556.jpg', '19', 25, '', '', 'INDIA', 'Active'),
(21, 'Murali Vijay', '13075816.jpg', '19', 30, '', '', 'INDIA', 'Active'),
(22, 'Umesh Yadav', '2713413663.jpg', '19', 26, '', '', 'INDIA', 'Active'),
(23, 'Rohit Sharma', '800916462.jpg', '19', 27, '', '', 'INDIA', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
