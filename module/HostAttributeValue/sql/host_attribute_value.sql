SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `host_attribute_value`
--

CREATE TABLE IF NOT EXISTS `host_attribute_value` (
  `host_attribute_value_id` int(20) NOT NULL AUTO_INCREMENT,
  `host_attribute_id` int(20) NOT NULL,
  `host_attribute_value_name` varchar(255) NOT NULL,
  PRIMARY KEY (`host_attribute_value_id`),
  KEY `host_attribute` (`host_attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_attribute_value`
--

INSERT INTO `host_attribute_value` (`host_attribute_value_id`, `host_attribute_id`, `host_attribute_value_name`) VALUES
(1, 1, 'Microsoft Windows Vista Home Basic'),
(2, 1, 'Microsoft Windows Vista Business'),
(3, 1, 'Microsoft Windows 7 Home Basic'),
(4, 1, 'Microsoft Windows 7 Professional'),
(5, 1, 'Microsoft Windows Server 2008 Standard'),
(6, 2, 'Acer'),
(7, 2, 'Apple'),
(8, 2, 'Asus'),
(9, 2, 'Hewlett-Packard'),
(10, 2, 'IBM'),
(11, 2, 'Lenovo'),
(12, 2, 'Micron'),
(13, 2, 'Dell'),
(14, 2, 'Panasonic'),
(15, 2, 'Clone'),
(16, 2, 'Sony'),
(17, 2, 'Supermicro'),
(18, 2, 'Toshiba'),
(19, 1, 'Microsoft Windows Vista Home Premium'),
(20, 1, 'Microsoft Windows Vista Enterprise'),
(21, 1, 'Microsoft Windows Vista Ultimate'),
(22, 1, 'Microsoft Windows 7 Home Premium'),
(23, 1, 'Microsoft Windows 7 Enterprise'),
(24, 1, 'Microsoft Windows 7 Ultimate'),
(25, 1, 'Microsoft Windows Thin PC'),
(26, 1, 'Microsoft Windows 8'),
(27, 1, 'Microsoft Windows 8 Pro'),
(28, 1, 'Microsoft Windows 8 Enterprise'),
(29, 1, 'Microsoft Windows 8 OEM'),
(30, 1, 'Microsoft Windows 8.1'),
(31, 1, 'Microsoft Windows 8.1 Pro'),
(32, 1, 'Microsoft Windows 8.1 Enterprise'),
(33, 1, 'Microsoft Windows 10 Home'),
(34, 1, 'Microsoft Windows 10 Pro'),
(35, 1, 'Microsoft Windows 10 Enterprise'),
(36, 1, 'Microsoft Windows 10 Education'),
(37, 1, 'Microsoft Windows 10 Mobile'),
(38, 5, 'Domain Controller'),
(39, 5, 'Mail Server'),
(40, 5, 'FTP Server'),
(41, 5, 'Web Server'),
(42, 5, 'Database Server'),
(43, 5, 'DNS Server'),
(44, 5, 'DHCP Server'),
(45, 4, 'WEP'),
(46, 4, 'WPA + AES'),
(47, 4, 'WPA2 + AES'),
(48, 4, 'Open Network'),
(49, 4, 'WPA + TKIP/AES '),
(50, 4, 'WPA + TKIP'),
(51, 5, 'File Server');

--
-- Constraints for table `host_attribute_value`
--
ALTER TABLE `host_attribute_value`
  ADD CONSTRAINT `fk_host_attribute_value_host_attribute_id` FOREIGN KEY (`host_attribute_id`) REFERENCES `host_attribute` (`host_attribute_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
