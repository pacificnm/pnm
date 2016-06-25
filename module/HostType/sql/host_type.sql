SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `host_type`
--

CREATE TABLE IF NOT EXISTS `host_type` (
  `host_type_id` int(20) NOT NULL AUTO_INCREMENT,
  `host_type_name` varchar(100) NOT NULL,
  PRIMARY KEY (`host_type_id`),
  UNIQUE KEY `value` (`host_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_type`
--

INSERT INTO `host_type` (`host_type_id`, `host_type_name`) VALUES
(11, 'Access Point'),
(6, 'Copier'),
(3, 'Laptop'),
(12, 'Other'),
(5, 'Printer'),
(8, 'Router'),
(7, 'Scanner'),
(2, 'Server'),
(9, 'Switch'),
(4, 'Tablet'),
(10, 'Wireless Router'),
(1, 'Workstation');
SET FOREIGN_KEY_CHECKS=1;
