-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 06, 2016 at 04:41 PM
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
-- Table structure for table `subscription_user`
--

CREATE TABLE IF NOT EXISTS `subscription_user` (
`subscription_user_id` int(20) unsigned NOT NULL,
  `subscription_id` int(20) unsigned NOT NULL,
  `user_id` int(20) NOT NULL,
  `subscription_user_create` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `subscription_user`:
--   `subscription_id`
--       `subscription` -> `subscription_id`
--   `user_id`
--       `user` -> `user_id`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subscription_user`
--
ALTER TABLE `subscription_user`
 ADD PRIMARY KEY (`subscription_user_id`), ADD UNIQUE KEY `subscription_id` (`subscription_id`,`user_id`), ADD KEY `fk_subscription_user_user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subscription_user`
--
ALTER TABLE `subscription_user`
MODIFY `subscription_user_id` int(20) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `subscription_user`
--
ALTER TABLE `subscription_user`
ADD CONSTRAINT `fk_subscription_user_subscription_id` FOREIGN KEY (`subscription_id`) REFERENCES `subscription` (`subscription_id`),
ADD CONSTRAINT `fk_subscription_user_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
SET FOREIGN_KEY_CHECKS=1;
