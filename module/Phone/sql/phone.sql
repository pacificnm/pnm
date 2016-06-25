SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `phone`
--

CREATE TABLE IF NOT EXISTS `phone` (
  `phone_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `phone_type` enum('Primary','Fax') NOT NULL DEFAULT 'Primary',
  `phone_num` varchar(60) NOT NULL,
  PRIMARY KEY (`phone_id`),
  KEY `client_id` (`client_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `phone`
--
ALTER TABLE `phone`
  ADD CONSTRAINT `fk_phone_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_phone_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
