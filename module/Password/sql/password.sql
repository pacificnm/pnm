SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `password`
--

CREATE TABLE IF NOT EXISTS `password` (
  `password_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `password_location` varchar(200) DEFAULT NULL,
  `password_title` varchar(60) NOT NULL,
  `password_username` varchar(100) NOT NULL,
  `password_password` varchar(255) NOT NULL,
  PRIMARY KEY (`password_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `password`
--
ALTER TABLE `password`
  ADD CONSTRAINT `fk_password_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
