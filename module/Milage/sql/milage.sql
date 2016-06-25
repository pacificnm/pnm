SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `milage`
--

CREATE TABLE IF NOT EXISTS `milage` (
  `mileage_id` int(20) NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `date` int(20) NOT NULL,
  `start_location` varchar(200) NOT NULL,
  `end_location` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `odometer_start` float(10,2) NOT NULL,
  `odometer_end` float(10,2) NOT NULL,
  `mileage` float(10,2) NOT NULL,
  `reimbursement` float(10,2) NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`mileage_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `milage`
--
ALTER TABLE `milage`
  ADD CONSTRAINT `fk_milage_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`);
SET FOREIGN_KEY_CHECKS=1;
