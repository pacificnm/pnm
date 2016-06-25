SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `task_priority`
--

CREATE TABLE IF NOT EXISTS `task_priority` (
  `task_priority_id` int(20) NOT NULL AUTO_INCREMENT,
  `task_priority_value` varchar(100) NOT NULL,
  PRIMARY KEY (`task_priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_priority`
--

INSERT INTO `task_priority` (`task_priority_id`, `task_priority_value`) VALUES
(1, 'Low'),
(2, 'Normal'),
(3, 'High');
SET FOREIGN_KEY_CHECKS=1;
