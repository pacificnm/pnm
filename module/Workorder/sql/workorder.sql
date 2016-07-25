SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `workorder`
--

CREATE TABLE IF NOT EXISTS `workorder` (
  `workorder_id` int(20) NOT NULL AUTO_INCREMENT,
  `location_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `user_id` int(20) NOT NULL,
  `phone_id` int(20) NOT NULL,
  `workorder_status` enum('Active','Closed','Deleted') NOT NULL DEFAULT 'Active',
  `workorder_description` longtext NOT NULL,
  `workorder_labor` float(11,2) DEFAULT '0.00',
  `workorder_parts` float(11,2) DEFAULT '0.00',
  `workorder_date_create` int(20) NOT NULL,
  `workorder_date_scheduled` int(11) NOT NULL,
  `workorder_date_end` int(20) NOT NULL,
  `workorder_date_close` int(20) DEFAULT NULL,
  `invoice_id` int(20) NOT NULL,
  PRIMARY KEY (`workorder_id`),
  KEY `location_id` (`location_id`,`client_id`),
  KEY `phone_id` (`phone_id`),
  KEY `user_id` (`user_id`),
  KEY `fk_workorder_client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


ALTER TABLE `workorder` ADD `workorder_title` VARCHAR(255) NOT NULL AFTER `workorder_status`;

ALTER TABLE `workorder` ADD `workorder_signature` TEXT NULL AFTER `workorder_date_close`;

--
-- Constraints for table `workorder`
--
ALTER TABLE `workorder`
  ADD CONSTRAINT `fk_workorder_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_phone_id` FOREIGN KEY (`phone_id`) REFERENCES `phone` (`phone_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
