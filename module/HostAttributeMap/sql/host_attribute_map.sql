SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `host_attribute_map`
--

CREATE TABLE IF NOT EXISTS `host_attribute_map` (
  `host_attribute_map_id` int(20) NOT NULL AUTO_INCREMENT,
  `host_id` int(20) NOT NULL,
  `host_attribute_id` int(20) NOT NULL,
  `host_attribute_map_value` varchar(255) NOT NULL,
  PRIMARY KEY (`host_attribute_map_id`),
  KEY `host_id` (`host_id`),
  KEY `host_attribute_id` (`host_attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `host_attribute_map`
--
ALTER TABLE `host_attribute_map`
  ADD CONSTRAINT `fk_host_attribute_map_host_attribute_id` FOREIGN KEY (`host_attribute_id`) REFERENCES `host_attribute_value` (`host_attribute_value_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_host_attribute_map_host_id` FOREIGN KEY (`host_id`) REFERENCES `host` (`host_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
