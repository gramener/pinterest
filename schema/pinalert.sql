-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 01, 2012 at 11:35 AM
-- Server version: 5.5.13
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_pinalerts`
--

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `country` varchar(250) NOT NULL,
  `symbol` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`country`, `symbol`) VALUES
('United States', 'USD');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_alertstats`
--

CREATE TABLE IF NOT EXISTS `tbl_alertstats` (
  `pinID` int(11) NOT NULL,
  `alertID` bigint(20) NOT NULL,
  `alertTimestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alertPrice` decimal(10,0) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_alertstats`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_boardalerts`
--

CREATE TABLE IF NOT EXISTS `tbl_boardalerts` (
  `boardID` varchar(256) NOT NULL,
  `pinnerID` varchar(256) NOT NULL,
  `boardStatus` char(1) NOT NULL,
  `alertCreatedDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_boardalerts`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinalerts`
--

CREATE TABLE IF NOT EXISTS `tbl_pinalerts` (
  `pinID` varchar(50) NOT NULL,
  `pinnerID` varchar(256) NOT NULL,
  `isProduct` tinyint(1) NOT NULL,
  `pinStatus` char(1) NOT NULL,
  `alertSent` tinyint(1) NOT NULL,
  `alertCreatedPrice` decimal(10,0) NOT NULL,
  `alertCreatedDate` date NOT NULL,
  `productURL` varchar(1024) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='This table holds all the pin alerts subscribed by the user.';

--
-- Dumping data for table `tbl_pinalerts`
--

INSERT INTO `tbl_pinalerts` (`pinID`, `pinnerID`, `isProduct`, `pinStatus`, `alertSent`, `alertCreatedPrice`, `alertCreatedDate`, `productURL`) VALUES
('56083957829850258', 'rockey_nebhwani', 1, 'y', 0, '10', '2012-07-01', 'http://direct.asda.com/Floral-Wall-Clock/001786219,default,pd.html#.T5wMONRqIN0.pinterest'),
('56083957829868474', 'rockey_nebhwani', 1, 'y', 0, '20', '2012-07-01', 'http://direct.asda.com/Jones-Red-Wall-Clock/001765975,default,pd.html#.T6DxjeKOJvU.pinterest');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pricetracker`
--

CREATE TABLE IF NOT EXISTS `tbl_pricetracker` (
  `productID` varchar(256) NOT NULL,
  `merchantID` int(11) NOT NULL,
  `date` date NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `currency` char(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_pricetracker`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_retailers`
--

CREATE TABLE IF NOT EXISTS `tbl_retailers` (
  `merchantName` varchar(256) NOT NULL,
  `merchantDomain` varchar(256) NOT NULL,
  `skimLinkMerchantID` int(11) NOT NULL,
  `skimLinkMerchantDomainID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_retailers`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbl_userdetails`
--

CREATE TABLE IF NOT EXISTS `tbl_userdetails` (
  `pinnerID` varchar(256) NOT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `alertThreshold` int(11) DEFAULT '10',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `emailID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userdetails`
--

INSERT INTO `tbl_userdetails` (`pinnerID`, `registrationDate`, `alertThreshold`, `firstName`, `lastName`, `emailID`, `password`) VALUES
('rockey_nebhwani', '2012-07-01 16:37:56', 10, 'Jayaseelan', 'Gabriel', 'jayaseelan.gabriel@gmail.com', '55e60109f4844ad674609e9c40172530');
