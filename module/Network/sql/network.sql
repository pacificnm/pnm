SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `network`
--

CREATE TABLE IF NOT EXISTS `network` (
  `network_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `network_attribute_id` int(20) NOT NULL,
  `network_value` varchar(255) NOT NULL,
  PRIMARY KEY (`network_id`),
  KEY `client_id` (`client_id`),
  KEY `network_attribute_id` (`network_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `network`
--
ALTER TABLE `network`
  ADD CONSTRAINT `fk_network_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_network_network_attribute_id` FOREIGN KEY (`network_attribute_id`) REFERENCES `network_attribute` (`network_attribute_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
