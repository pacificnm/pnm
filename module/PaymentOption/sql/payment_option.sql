SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `payment_option`
--

CREATE TABLE IF NOT EXISTS `payment_option` (
  `payment_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_option_name` varchar(200) NOT NULL,
  `payment_option_enabled` tinyint(3) NOT NULL,
  PRIMARY KEY (`payment_option_id`),
  UNIQUE KEY `payment_option_name` (`payment_option_name`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`payment_option_id`, `payment_option_name`, `payment_option_enabled`) VALUES
(1, 'Cash', 1),
(2, 'Check', 1),
(3, 'Credit Card', 0),
(4, 'Pay Pal', 0);
SET FOREIGN_KEY_CHECKS=1;
