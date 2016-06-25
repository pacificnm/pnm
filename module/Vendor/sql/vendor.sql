SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `vendor`
--

CREATE TABLE IF NOT EXISTS `vendor` (
  `vendor_id` int(20) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(200) NOT NULL,
  `vendor_account_number` varchar(200) DEFAULT NULL,
  `vendor_street` varchar(200) NOT NULL,
  `vendor_street_cont` varchar(255) DEFAULT NULL,
  `vendor_city` varchar(200) NOT NULL,
  `vendor_state` varchar(200) NOT NULL,
  `vendor_postal` varchar(60) NOT NULL,
  `vendor_phone` varchar(60) NOT NULL,
  `vendor_website` varchar(200) DEFAULT NULL,
  `vendor_active` int(3) NOT NULL,
  PRIMARY KEY (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `vendor`:
--
SET FOREIGN_KEY_CHECKS=1;
