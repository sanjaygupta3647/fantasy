-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 14, 2014 at 11:24 AM
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
-- Table structure for table `pro_testimonials`
--

CREATE TABLE IF NOT EXISTS `pro_testimonials` (
  `id` int(10) NOT NULL DEFAULT '1',
  `testimonials` varchar(1000) NOT NULL,
  `status` enum('Active','Inactive','','') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_testimonials`
--

INSERT INTO `pro_testimonials` (`id`, `testimonials`, `status`) VALUES
(1, '<p>\r\n	Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus hic dolor eaque quidem animi ullam quod veritatis magnam laborum, omnis quia placeat, aperiam voluptatibus, et! Praesentium cum iure quae voluptate ut?</p>\r\n<p>\r\n	<span style="color:#00ffff;"><strong>Praesentium id accusamus a fuga, quas quae non iusto, aspernatur saepe! Esse ratione eum suscipit, voluptatum omnis placeat vel. Iusto harum est illum consequatur sint accusamus illo error beatae sit officiis quidem eius aliquid hic quisquam minima ducimus fugiat, qui nihil quis amet.</strong></span></p>\r\n<p>\r\n	<span style="color:#b22222;">Nemo unde accusantium ipsam inventore repudiandae excepturi molestias sapiente amet officia laboriosam facilis consectetur blanditiis, aut, cumque temporibus, quam beatae. Alias qui sint, numquam accusantium necessitatibus!</span></p>\r\n', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
