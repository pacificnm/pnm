SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `workorder_employee`
--

CREATE TABLE IF NOT EXISTS `workorder_employee` (
  `workorder_employee_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  PRIMARY KEY (`workorder_employee_id`),
  KEY `employee_id` (`employee_id`),
  KEY `workorder_id` (`workorder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `workorder_employee`
--
ALTER TABLE `workorder_employee`
  ADD CONSTRAINT `fk_workorder_employee_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_employee_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
