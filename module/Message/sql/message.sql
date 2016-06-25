SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `message_id` int(20) NOT NULL AUTO_INCREMENT,
  `message_date` int(11) NOT NULL,
  `message_subject` varchar(255) NOT NULL,
  `message_body` text NOT NULL,
  `message_to_email` varchar(200) NOT NULL,
  `message_to_name` varchar(200) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `message`:
--
SET FOREIGN_KEY_CHECKS=1;
