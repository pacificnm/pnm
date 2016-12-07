-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:31 PM
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
-- Table structure for table `subscription_status`
--

CREATE TABLE IF NOT EXISTS `subscription_status` (
`subscription_status_id` int(20) unsigned NOT NULL,
  `subscription_status_name` varchar(255) NOT NULL,
  `subscription_status_status` int(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_status`
--

INSERT INTO `subscription_status` (`subscription_status_id`, `subscription_status_name`, `subscription_status_status`) VALUES
(1, 'Active', 0),
(2, 'Canceled', 0),
(3, 'Suspended', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_status`
--
ALTER TABLE `subscription_status`
 ADD PRIMARY KEY (`subscription_status_id`), ADD UNIQUE KEY `subscription_status_name` (`subscription_status_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_status`
--
ALTER TABLE `subscription_status`
MODIFY `subscription_status_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;SET FOREIGN_KEY_CHECKS=1;
