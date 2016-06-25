SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `employee_id` int(20) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(100) NOT NULL,
  `employee_title` varchar(60) DEFAULT NULL,
  `employee_email` varchar(200) NOT NULL,
  `employee_phone` varchar(60) NOT NULL,
  `employee_phone_mobile` varchar(60) DEFAULT NULL,
  `employee_street` varchar(200) NOT NULL,
  `employee_street_cont` varchar(200) DEFAULT NULL,
  `employee_city` varchar(60) NOT NULL,
  `employee_state` varchar(60) NOT NULL,
  `employee_postal` varchar(60) NOT NULL,
  `employee_im` varchar(60) DEFAULT NULL,
  `employee_image` varchar(200) DEFAULT 'photo_60x60.jpg',
  `employee_status` enum('Active','Closed','Deleted') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `employee`:
--
SET FOREIGN_KEY_CHECKS=1;
