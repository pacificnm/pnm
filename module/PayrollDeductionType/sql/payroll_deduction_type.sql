SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction_type`
--

CREATE TABLE IF NOT EXISTS `payroll_deduction_type` (
  `payroll_deduction_type_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payroll_deduction_type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payroll_deduction_type_id`),
  UNIQUE KEY `payroll_deduction_type_name` (`payroll_deduction_type_name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `payroll_deduction_type`:
--

--
-- Dumping data for table `payroll_deduction_type`
--

INSERT INTO `payroll_deduction_type` (`payroll_deduction_type_id`, `payroll_deduction_type_name`) VALUES
(1, '401k'),
(6, 'Child Support'),
(7, 'Child Support 2'),
(4, 'Dental'),
(2, 'Life Insurance'),
(3, 'Loan'),
(5, 'Unemployment Insurance');
SET FOREIGN_KEY_CHECKS=1;
