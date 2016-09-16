-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2012 at 01:46 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mexpense`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'f4a7eccf2d88332ddcf65cf1555f40c6');

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE IF NOT EXISTS `beneficiaries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL COMMENT 'tbl:expenses',
  `beneficiar_id` int(11) NOT NULL COMMENT 'tbl:users',
  `amount` float(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `expense_id`, `beneficiar_id`, `amount`) VALUES
(14, 2, 1, 50.00),
(15, 2, 2, 50.00),
(16, 2, 3, 50.00),
(17, 2, 4, 50.00),
(22, 1, 1, 200.00),
(23, 1, 2, 200.00),
(24, 1, 3, 200.00),
(25, 1, 4, 200.00);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payer_id` int(11) NOT NULL COMMENT 'tbl:users',
  `expense_name` varchar(255) NOT NULL,
  `description` text,
  `expense_date` datetime NOT NULL,
  `total_amount` float(10,2) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `payer_id`, `expense_name`, `description`, `expense_date`, `total_amount`, `created_date`) VALUES
(1, 2, 'E-Test', 'Test description', '2012-04-07 08:00:00', 800.00, '2012-04-07 16:11:00'),
(2, 4, 'E-Test2', 'Test descripton', '2012-04-10 16:00:00', 200.00, '2012-04-07 16:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text,
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0=inactive,1=active',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `address`, `status`, `created_date`) VALUES
(1, 'alan', 'alan@test.cm', '8985693453', 'Test address', 1, '2012-04-07 16:04:57'),
(2, 'Mark', 'mark@test.com', '8768678678', 'Test address', 1, '2012-04-07 16:05:54'),
(3, 'Montana', 'montana@test.com', '9667867867', 'test address', 1, '2012-04-07 16:07:14'),
(4, 'Sharon', 'sharon1@test.com', '65756756651', 'test address', 1, '2012-04-07 16:08:01');
