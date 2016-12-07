-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:12 PM
-- Server version: 10.0.28-MariaDB-0+deb8u1
-- PHP Version: 5.6.27-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `subscription_host`
--

CREATE TABLE IF NOT EXISTS `subscription_host` (
`subscription_host_id` int(20) unsigned NOT NULL,
  `host_id` int(20) NOT NULL,
  `subscription_id` int(20) unsigned NOT NULL,
  `subscription_host_created` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `subscription_host`:
--   `host_id`
--       `host` -> `host_id`
--   `subscription_id`
--       `subscription` -> `subscription_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_host`
--
ALTER TABLE `subscription_host`
 ADD PRIMARY KEY (`subscription_host_id`), ADD UNIQUE KEY `host_id` (`host_id`,`subscription_id`), ADD KEY `fk_subscription_host_subscription_id` (`subscription_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_host`
--
ALTER TABLE `subscription_host`
MODIFY `subscription_host_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription_host`
--
ALTER TABLE `subscription_host`
ADD CONSTRAINT `fk_subscription_host_id` FOREIGN KEY (`host_id`) REFERENCES `host` (`host_id`),
ADD CONSTRAINT `fk_subscription_host_subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`) ON DELETE CASCADE ON UPDATE CASCADE;
