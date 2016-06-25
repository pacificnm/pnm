SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `host_attribute`
--

CREATE TABLE IF NOT EXISTS `host_attribute` (
  `host_attribute_id` int(20) NOT NULL AUTO_INCREMENT,
  `host_attribute_name` varchar(100) NOT NULL,
  `host_attribute_type` enum('select','text','long text','boolen','password') NOT NULL,
  PRIMARY KEY (`host_attribute_id`),
  UNIQUE KEY `name` (`host_attribute_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_attribute`
--

INSERT INTO `host_attribute` (`host_attribute_id`, `host_attribute_name`, `host_attribute_type`) VALUES
(1, 'Operating System', 'select'),
(2, 'Manufacture', 'select'),
(3, 'Model', 'text'),
(4, 'Wireless Security', 'select'),
(5, 'Server Type', 'select'),
(6, 'Username', 'text'),
(7, 'Password', 'text'),
(8, 'Wireless Security Password', 'text'),
(9, 'SSID', 'text'),
(10, 'Asset Tag', 'text'),
(11, 'Serial Number', 'text');
SET FOREIGN_KEY_CHECKS=1;
