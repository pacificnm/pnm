SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `location_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `location_type` enum('Primary','Branch Office','Billing','Shipping','Service') NOT NULL DEFAULT 'Primary',
  `location_street` varchar(100) NOT NULL,
  `location_street_cont` varchar(100) DEFAULT NULL,
  `location_city` varchar(60) NOT NULL,
  `location_state` varchar(60) NOT NULL,
  `location_zip` varchar(60) NOT NULL,
  `location_Status` enum('Active','Closed') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`location_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `fk_location_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
