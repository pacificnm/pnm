SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `labor`
--

CREATE TABLE IF NOT EXISTS `labor` (
  `labor_id` int(20) NOT NULL AUTO_INCREMENT,
  `labor_name` varchar(100) NOT NULL,
  `labor_amount` float(8,2) NOT NULL,
  PRIMARY KEY (`labor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `labor`:
--

--
-- Dumping data for table `labor`
--

INSERT INTO `labor` (`labor_id`, `labor_name`, `labor_amount`) VALUES
(1, 'Consulting Service', 85.00),
(2, 'Network Service', 75.00),
(3, 'Basic Service Charge', 65.00),
(4, 'Web Development', 25.00),
(5, 'Database Development', 45.00),
(6, 'No Charge', 0.00),
(7, 'Printer Service', 65.00),
(8, 'Os Configuration', 55.00);
SET FOREIGN_KEY_CHECKS=1;
