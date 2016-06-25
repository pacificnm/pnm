SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `invoice_payment`
--

CREATE TABLE IF NOT EXISTS `invoice_payment` (
  `invoice_payment_id` int(20) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(20) NOT NULL,
  `account_id` int(20) NOT NULL,
  `account_ledger_id` int(20) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `invoice_payment_date` int(11) NOT NULL,
  `invoice_payment_amount` float(10,2) NOT NULL,
  `invoice_payment_detail` varchar(200) NOT NULL,
  PRIMARY KEY (`invoice_payment_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `account_ledger_id` (`account_id`),
  KEY `payment_option_id` (`payment_option_id`),
  KEY `account_ledger_id_2` (`account_ledger_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  ADD CONSTRAINT `invoice_payment_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_payment_account_ledger_id` FOREIGN KEY (`account_ledger_id`) REFERENCES `account_ledger` (`account_ledger_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_payment_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_payment_option_id` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_option` (`payment_option_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
