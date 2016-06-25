SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `account_id` int(20) NOT NULL AUTO_INCREMENT,
  `account_type_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_description` text NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_balance` float(11,2) NOT NULL,
  `account_created` int(11) NOT NULL,
  `account_active` int(3) NOT NULL,
  `account_visible` int(3) NOT NULL,
  PRIMARY KEY (`account_id`),
  KEY `account_type_id` (`account_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `fk_account_account_type_id` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`account_type_id`) ON UPDATE CASCADE;

SET FOREIGN_KEY_CHECKS=1;