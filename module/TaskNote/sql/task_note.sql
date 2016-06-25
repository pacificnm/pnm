SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `task_note`
--

CREATE TABLE IF NOT EXISTS `task_note` (
  `task_note_id` int(20) NOT NULL AUTO_INCREMENT,
  `task_id` int(20) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `task_note_date` int(20) NOT NULL,
  `task_note_text` mediumtext NOT NULL,
  PRIMARY KEY (`task_note_id`),
  KEY `task_id` (`task_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `task_note`
--
ALTER TABLE `task_note`
  ADD CONSTRAINT `fk_task_note_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_task_note_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`task_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
