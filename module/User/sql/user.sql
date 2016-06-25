SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `location_id` int(20) NOT NULL,
  `user_status` enum('Active','Deleted') NOT NULL,
  `user_name_first` varchar(60) NOT NULL,
  `user_name_last` varchar(60) DEFAULT NULL,
  `user_job_title` varchar(100) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_type` enum('Primary','Logon','Staff') NOT NULL DEFAULT 'Primary',
  PRIMARY KEY (`user_id`),
  KEY `client_id` (`client_id`),
  KEY `location_id` (`location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_user_location_id` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
