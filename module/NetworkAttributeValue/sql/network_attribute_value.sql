SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `network_attribute_value`
--

CREATE TABLE IF NOT EXISTS `network_attribute_value` (
  `network_attribute_value_id` int(20) NOT NULL AUTO_INCREMENT,
  `network_attribute_id` int(20) NOT NULL,
  `network_attribute_value_name` varchar(255) NOT NULL,
  PRIMARY KEY (`network_attribute_value_id`),
  KEY `network_attribute_id` (`network_attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network_attribute_value`
--

INSERT INTO `network_attribute_value` (`network_attribute_value_id`, `network_attribute_id`, `network_attribute_value_name`) VALUES
(1, 6, 'Plain'),
(2, 6, 'Login'),
(3, 6, 'GSSAPI'),
(4, 6, 'DIGEST-MD5 '),
(5, 6, 'MD5'),
(6, 6, 'CRAM-MD5');

--
-- Constraints for table `network_attribute_value`
--
ALTER TABLE `network_attribute_value`
  ADD CONSTRAINT `fk_network_attribute_value_network_attribute_id` FOREIGN KEY (`network_attribute_id`) REFERENCES `network_attribute` (`network_attribute_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
