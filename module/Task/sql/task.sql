SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int(20) NOT NULL AUTO_INCREMENT,
  `employee_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `task_date_start` int(20) NOT NULL,
  `task_date_end` int(20) NOT NULL,
  `task_status` varchar(60) NOT NULL,
  `task_priority_id` int(11) NOT NULL,
  `task_date_reminder` int(20) DEFAULT NULL,
  `task_title` varchar(255) NOT NULL,
  `task_description` text,
  PRIMARY KEY (`task_id`),
  KEY `user_id` (`employee_id`),
  KEY `client_id` (`client_id`),
  KEY `task_priority_id` (`task_priority_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- update added flag to dismiss the reminder
--
ALTER TABLE `task` ADD `task_date_reminder_active` INT(3) NOT NULL AFTER `task_date_reminder`;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk_task_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_task_priority_id` FOREIGN KEY (`task_priority_id`) REFERENCES `task_priority` (`task_priority_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
