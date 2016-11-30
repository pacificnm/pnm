SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

CREATE TABLE IF NOT EXISTS `payroll` (
  `payroll_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `payroll_check` int(11) UNSIGNED NOT NULL,
  `payroll_date_create` int(11) UNSIGNED NOT NULL,
  `payroll_date_start` int(11) UNSIGNED NOT NULL,
  `payroll_date_end` int(11) UNSIGNED NOT NULL,
  `payroll_hours` float NOT NULL,
  `payroll_hours_ot` float NOT NULL,
  `payroll_hours_vacation` float NOT NULL,
  `payroll_hours_sick` float NOT NULL,
  `payroll_rate` float NOT NULL,
  `payroll_rate_ot` float NOT NULL,
  `payroll_wages` float NOT NULL,
  `payroll_wages_ot` float NOT NULL,
  `payroll_wages_vacation` float NOT NULL,
  `payroll_wages_sick` float NOT NULL,
  `payroll_wages_gross` float NOT NULL,
  `payroll_wages_net` float NOT NULL,
  `payroll_wages_state` float NOT NULL,
  `payroll_wages_social_security` float NOT NULL,
  `payroll_wages_medicare` float NOT NULL,
  `payroll_tax_federal_income` float NOT NULL,
  `payroll_tax_social_security` float NOT NULL,
  `payroll_tax_state` float NOT NULL,
  `payroll_tax_medicare` float NOT NULL,
  PRIMARY KEY (`payroll_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `payroll`:
--   `employee_id`
--       `employee` -> `employee_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payroll`
--
ALTER TABLE `payroll`
  ADD CONSTRAINT `fk_payroll_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
SET FOREIGN_KEY_CHECKS=1;