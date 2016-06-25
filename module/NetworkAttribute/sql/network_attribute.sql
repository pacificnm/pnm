SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `network_attribute`
--

CREATE TABLE IF NOT EXISTS `network_attribute` (
  `network_attribute_id` int(20) NOT NULL AUTO_INCREMENT,
  `network_attribute_name` varchar(255) NOT NULL,
  `network_attribute_type` varchar(255) NOT NULL,
  PRIMARY KEY (`network_attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `network_attribute`:
--

--
-- Dumping data for table `network_attribute`
--

INSERT INTO `network_attribute` (`network_attribute_id`, `network_attribute_name`, `network_attribute_type`) VALUES
(1, 'Windows Domain', 'text'),
(2, 'Web Domain', 'text'),
(3, 'SMTP Server', 'text'),
(4, 'POP 3 Server', 'text'),
(5, 'IMAP Server', 'text'),
(6, 'SMTP Auth Type', 'select'),
(7, 'SMTP Server Port', 'text'),
(8, 'IMAP Server Port', 'text'),
(9, 'POP 3 Server Port', 'text'),
(10, 'LAN Network', 'text'),
(11, 'LAN Default Gateway', 'text'),
(12, 'LAN Domain Name Server', 'text'),
(13, 'LAN Subnet', 'text'),
(14, 'Public IP Address', 'text'),
(15, 'Public Default Gateway', 'text'),
(16, 'Public Domain Name Server', 'text'),
(17, 'Public Subnet', 'text');
SET FOREIGN_KEY_CHECKS=1;
