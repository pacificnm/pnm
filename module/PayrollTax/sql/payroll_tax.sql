SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `payroll_tax`
--

CREATE TABLE IF NOT EXISTS `payroll_tax` (
  `payroll_tax_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payroll_tax_federal` float NOT NULL,
  `payroll_tax_social_security` float NOT NULL,
  `payroll_tax_medicare` float NOT NULL,
  `payroll_tax_state` float NOT NULL,
  PRIMARY KEY (`payroll_tax_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `payroll_tax`:
--

--
-- Dumping data for table `payroll_tax`
--

INSERT INTO `payroll_tax` (`payroll_tax_id`, `payroll_tax_federal`, `payroll_tax_social_security`, `payroll_tax_medicare`, `payroll_tax_state`) VALUES
(1, 17.5, 6.2, 1.45, 6);
SET FOREIGN_KEY_CHECKS=1;