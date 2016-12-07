-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 11:15 PM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.27-0+deb8u1

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `report_profit`
--

CREATE TABLE IF NOT EXISTS `report_profit` (
`report_profit_id` int(20) unsigned NOT NULL,
  `report_profit_labor` float(11,2) NOT NULL,
  `report_profit_parts` float(11,2) NOT NULL,
  `report_profit_expense` float(11,2) NOT NULL,
  `report_profit_month` int(3) unsigned NOT NULL,
  `report_profit_year` int(4) unsigned NOT NULL,
  `report_profit_updated` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `report_profit`
--
ALTER TABLE `report_profit`
 ADD PRIMARY KEY (`report_profit_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `report_profit`
--
ALTER TABLE `report_profit`
MODIFY `report_profit_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;SET FOREIGN_KEY_CHECKS=1;
