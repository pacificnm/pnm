-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:28 PM
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
-- Table structure for table `subscription_product`
--

CREATE TABLE IF NOT EXISTS `subscription_product` (
`subscription_product_id` int(20) unsigned NOT NULL,
  `subscription_id` int(20) unsigned NOT NULL,
  `subscription_product_qty` int(10) unsigned NOT NULL,
  `product_id` int(20) unsigned NOT NULL,
  `subscription_product_status` int(3) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `subscription_product`:
--   `product_id`
--       `product` -> `product_id`
--   `subscription_id`
--       `subscription` -> `subscription_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_product`
--
ALTER TABLE `subscription_product`
 ADD PRIMARY KEY (`subscription_product_id`), ADD KEY `subscription_id` (`subscription_id`), ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_product`
--
ALTER TABLE `subscription_product`
MODIFY `subscription_product_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription_product`
--
ALTER TABLE `subscription_product`
ADD CONSTRAINT `fk_subscription_product_product_id` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`),
ADD CONSTRAINT `fk_subscription_product_subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`);
SET FOREIGN_KEY_CHECKS=1;
