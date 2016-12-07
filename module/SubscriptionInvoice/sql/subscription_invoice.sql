-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:23 PM
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
-- Table structure for table `subscription_invoice`
--

CREATE TABLE IF NOT EXISTS `subscription_invoice` (
`subscription_invoice_id` int(20) unsigned NOT NULL,
  `subscription_id` int(20) unsigned NOT NULL,
  `invoice_id` int(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `subscription_invoice`:
--   `invoice_id`
--       `invoice` -> `invoice_id`
--   `subscription_id`
--       `subscription` -> `subscription_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_invoice`
--
ALTER TABLE `subscription_invoice`
 ADD PRIMARY KEY (`subscription_invoice_id`), ADD UNIQUE KEY `subscription_id` (`subscription_id`,`invoice_id`), ADD KEY `fk_subscription_invoice_invoice_id` (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_invoice`
--
ALTER TABLE `subscription_invoice`
MODIFY `subscription_invoice_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription_invoice`
--
ALTER TABLE `subscription_invoice`
ADD CONSTRAINT `fk_subscription_invoice_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`),
ADD CONSTRAINT `fk_subscription_invoice_subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`);
SET FOREIGN_KEY_CHECKS=1;
