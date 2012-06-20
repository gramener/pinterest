-- phpMyAdmin SQL Dump
-- version 3.1.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 19, 2012 at 11:43 AM
-- Server version: 5.1.44
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

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
  `pinID` int(11) NOT NULL,
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
  `emailID` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_userdetails`
--

INSERT INTO `tbl_userdetails` (`pinnerID`, `registrationDate`, `alertThreshold`, `emailID`, `password`) VALUES
('rockey', '2012-06-12 15:50:40', 10, 'rock', '5f4dcc3b5aa765d61d8327deb882cf99'),
('dadad', '2012-06-12 16:01:53', 10, 'intranet@gfg.hg', 'eb9279982226a42afdf2860dbdc29b45'),
('rockey_nebhwani', '2012-06-13 14:37:30', 10, 'jjss@sas.css', '437599f1ea3514f8969f161a6606ce18'),
('rockey_nebhwani', '2012-06-19 16:11:03', 10, 'dsds@dsd.ff', 'f274a979296de5b2f82d4ad21e8409ed');
