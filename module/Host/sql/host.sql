SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `host_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `host_type_id` int(20) NOT NULL,
  `host_name` varchar(100) NOT NULL,
  `host_ip` varchar(60) NOT NULL,
  `host_status` enum('Active','Retired','Deleted') NOT NULL DEFAULT 'Active',
  `host_health` enum('Not Enabled','Ok','Warning','Alert') NOT NULL,
  `host_created` int(11) NOT NULL,
  PRIMARY KEY (`host_id`),
  KEY `client_id` (`client_id`),
  KEY `location_id` (`location_id`),
  KEY `host_type_id` (`host_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `host` ADD `host_description` TEXT NOT NULL AFTER `host_name`;

--
-- Constraints for table `host`
--
ALTER TABLE `host`
  ADD CONSTRAINT `fk_host_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_host_host_type_id` FOREIGN KEY (`host_type_id`) REFERENCES `host_type` (`host_type_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_host_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
