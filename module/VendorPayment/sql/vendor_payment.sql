SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `vendor_payment`
--

CREATE TABLE IF NOT EXISTS `vendor_payment` (
  `vendor_payment_id` int(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(20) NOT NULL,
  `vendor_bill_id` int(20) NOT NULL,
  `account_id` int(20) NOT NULL,
  `account_ledger_id` int(20) NOT NULL,
  `vendor_payment_date` int(11) NOT NULL,
  `vendor_payment_amount` float(11,2) NOT NULL,
  `vendor_payment_active` int(3) NOT NULL,
  PRIMARY KEY (`vendor_payment_id`),
  KEY `vendor_id` (`vendor_id`),
  KEY `vendor_bill_id` (`vendor_bill_id`),
  KEY `account_id` (`account_id`),
  KEY `account_ledger_id` (`account_ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `vendor_payment`
--
ALTER TABLE `vendor_payment`
  ADD CONSTRAINT `fk_vendor_payment_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`),
  ADD CONSTRAINT `fk_vendor_payment_account_ledger_id` FOREIGN KEY (`account_ledger_id`) REFERENCES `account_ledger` (`account_ledger_id`),
  ADD CONSTRAINT `fk_vendor_payment_vendor_bill_id` FOREIGN KEY (`vendor_bill_id`) REFERENCES `vendor_bill` (`vendor_bill_id`),
  ADD CONSTRAINT `fk_vendor_payment_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`);
SET FOREIGN_KEY_CHECKS=1;
