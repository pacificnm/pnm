-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:09 PM
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
-- Table structure for table `subscription`
--

CREATE TABLE IF NOT EXISTS `subscription` (
`subscription_id` int(20) unsigned NOT NULL,
  `client_id` int(20) NOT NULL,
  `subscription_date_create` int(11) unsigned NOT NULL,
  `subscription_date_due` int(11) unsigned NOT NULL,
  `subscription_date_update` int(11) NOT NULL,
  `subscription_date_end` int(11) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `subscription_schedule_id` int(20) unsigned NOT NULL,
  `subscription_status_id` int(20) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `subscription`:
--   `client_id`
--       `client` -> `client_id`
--   `payment_option_id`
--       `payment_option` -> `payment_option_id`
--   `subscription_schedule_id`
--       `subscription_schedule` -> `subscription_schedule_id`
--   `subscription_status_id`
--       `subscription_status` -> `subscription_status_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription`
--
ALTER TABLE `subscription`
 ADD PRIMARY KEY (`subscription_id`), ADD KEY `client_id` (`client_id`), ADD KEY `payment_option_id` (`payment_option_id`), ADD KEY `subscription_status_id` (`subscription_status_id`), ADD KEY `subscription_schedule_id` (`subscription_schedule_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription`
--
ALTER TABLE `subscription`
MODIFY `subscription_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription`
--
ALTER TABLE `subscription`
ADD CONSTRAINT `fk_subscription_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`),
ADD CONSTRAINT `fk_subscription_payment_option_id` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_option` (`payment_option_id`),
ADD CONSTRAINT `fk_subscription_schedule_id` FOREIGN KEY (`subscription_schedule_id`) REFERENCES `subscription_schedule` (`subscription_schedule_id`),
ADD CONSTRAINT `fk_subscription_status_id` FOREIGN KEY (`subscription_status_id`) REFERENCES `subscription_status` (`subscription_status_id`);
SET FOREIGN_KEY_CHECKS=1;
