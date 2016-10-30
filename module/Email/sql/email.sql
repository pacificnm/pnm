SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `email`
--

CREATE TABLE IF NOT EXISTS `email` (
  `email_id` int(20) NOT NULL AUTO_INCREMENT,
  `auth_id` int(20) NOT NULL,
  `email_date_created` int(11) NOT NULL,
  `email_date_sent` int(11) DEFAULT NULL,
  `email_to_address` varchar(200) NOT NULL,
  `email_to_name` varchar(200) NOT NULL,
  `email_from_address` varchar(200) NOT NULL,
  `email_from_name` varchar(200) NOT NULL,
  `email_subject` varchar(255) NOT NULL,
  `email_body` text NOT NULL,
  `email_log` text,
  PRIMARY KEY (`email_id`),
  KEY `user_id` (`auth_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Constraints for dumped tables
--



