SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction`
--

CREATE TABLE IF NOT EXISTS `payroll_deduction` (
  `payroll_deduction_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `payroll_id` int(20) UNSIGNED NOT NULL,
  `payroll_deduction_type_id` int(20) UNSIGNED NOT NULL,
  `payroll_deduction_amount` float NOT NULL,
  `payroll_deduction_year` int(4) NOT NULL,
  PRIMARY KEY (`payroll_deduction_id`),
  KEY `payroll_id` (`payroll_id`),
  KEY `payroll_deduction_type_id` (`payroll_deduction_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `payroll_deduction`:
--   `payroll_deduction_type_id`
--       `payroll_deduction_type` -> `payroll_deduction_type_id`
--   `payroll_id`
--       `payroll` -> `payroll_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payroll_deduction`
--
ALTER TABLE `payroll_deduction`
  ADD CONSTRAINT `fk_payroll_deduction_deduction_type_id` FOREIGN KEY (`payroll_deduction_type_id`) REFERENCES `payroll_deduction_type` (`payroll_deduction_type_id`),
  ADD CONSTRAINT `fk_payroll_deduction_payroll_id` FOREIGN KEY (`payroll_id`) REFERENCES `payroll` (`payroll_id`);
SET FOREIGN_KEY_CHECKS=1;
