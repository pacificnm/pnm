
SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `client_account`
--

CREATE TABLE IF NOT EXISTS `client_account` (
  `client_account_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `account_id` int(20) NOT NULL,
  PRIMARY KEY (`client_account_id`),
  KEY `client_id` (`client_id`),
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `client_account`
--
ALTER TABLE `client_account`
  ADD CONSTRAINT `fk_account_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_account_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;