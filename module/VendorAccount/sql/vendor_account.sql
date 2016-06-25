SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `vendor_account`
--

CREATE TABLE IF NOT EXISTS `vendor_account` (
  `vendor_account_id` int(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(20) NOT NULL,
  `vendor_id` int(20) NOT NULL,
  PRIMARY KEY (`vendor_account_id`),
  KEY `account_id` (`account_id`),
  KEY `vendor_id` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `vendor_account`
--
ALTER TABLE `vendor_account`
  ADD CONSTRAINT `fk_vendor_account_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `fk_vendor_account_vandor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`);
SET FOREIGN_KEY_CHECKS=1;
