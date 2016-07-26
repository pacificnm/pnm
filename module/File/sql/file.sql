SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_mime` varchar(100) NOT NULL,
  `file_size` float(10,2) NOT NULL,
  `file_create` int(20) NOT NULL,
  `file_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`file_id`),
  KEY `employee_id` (`employee_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `file` CHANGE `file_create` `file_create` INT(11) NOT NULL;
ALTER TABLE `file` CHANGE `file_name` `file_name` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
--
-- Constraints for table `file`
--
ALTER TABLE `file`,
  ADD CONSTRAINT `fk_file_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
