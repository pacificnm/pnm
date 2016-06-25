SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `workorder_time`
--

CREATE TABLE IF NOT EXISTS `workorder_time` (
  `workorder_time_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `workorder_time_in` int(20) NOT NULL,
  `workorder_time_out` int(20) NOT NULL,
  `workorder_time_total` int(20) NOT NULL,
  `labor_id` int(20) NOT NULL,
  `labor_name` varchar(255) NOT NULL,
  `labor_rate` float(10,2) NOT NULL,
  `labor_total` float(10,2) NOT NULL,
  PRIMARY KEY (`workorder_time_id`),
  KEY `workorder_id` (`workorder_id`),
  KEY `employee_id` (`employee_id`),
  KEY `labor_id` (`labor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `workorder_time`
--
ALTER TABLE `workorder_time`
  ADD CONSTRAINT `fk_workorder_time_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_time_labor_id` FOREIGN KEY (`labor_id`) REFERENCES `labor` (`labor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_time_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
