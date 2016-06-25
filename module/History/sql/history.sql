SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `history`
--

CREATE TABLE IF NOT EXISTS `history` (
  `history_id` int(11) NOT NULL AUTO_INCREMENT,
  `auth_id` int(11) NOT NULL,
  `history_action` enum('CREATE','READ','UPDATE','DELETE') NOT NULL,
  `history_url` varchar(255) NOT NULL,
  `history_note` text,
  `history_time` int(11) NOT NULL,
  PRIMARY KEY (`history_id`),
  KEY `auth_id` (`auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `history`
--
ALTER TABLE `history`
  ADD CONSTRAINT `fk_history_auth_id` FOREIGN KEY (`auth_id`) REFERENCES `auth` (`auth_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
