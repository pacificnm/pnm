-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:30 PM
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
-- Table structure for table `subscription_schedule`
--

CREATE TABLE IF NOT EXISTS `subscription_schedule` (
`subscription_schedule_id` int(20) unsigned NOT NULL,
  `subscription_schedule_name` varchar(255) NOT NULL,
  `subscription_schedule_status` int(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_schedule`
--

INSERT INTO `subscription_schedule` (`subscription_schedule_id`, `subscription_schedule_name`, `subscription_schedule_status`) VALUES
(1, 'Monthly', 1),
(2, 'Annual', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_schedule`
--
ALTER TABLE `subscription_schedule`
 ADD PRIMARY KEY (`subscription_schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_schedule`
--
ALTER TABLE `subscription_schedule`
MODIFY `subscription_schedule_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;SET FOREIGN_KEY_CHECKS=1;
