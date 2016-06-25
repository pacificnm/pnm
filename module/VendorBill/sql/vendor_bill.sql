SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `vendor_bill`
--

CREATE TABLE IF NOT EXISTS `vendor_bill` (
  `vendor_bill_id` int(20) NOT NULL AUTO_INCREMENT,
  `vendor_id` int(20) NOT NULL,
  `vendor_bill_date_create` int(11) NOT NULL,
  `vendor_bill_date_due` int(20) NOT NULL,
  `vendor_bill_date_paid` int(20) NOT NULL,
  `vendor_bill_amount` float(11,2) NOT NULL,
  `vendor_bill_balance` float(11,2) NOT NULL,
  `vendor_bill_memo` text NOT NULL,
  `vendor_bill_status` enum('Un-Paid','Paid') NOT NULL,
  PRIMARY KEY (`vendor_bill_id`),
  KEY `vendorId` (`vendor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `vendor_bill`
--
ALTER TABLE `vendor_bill`
  ADD CONSTRAINT `fk_vendor_bill_vendor_id` FOREIGN KEY (`vendor_id`) REFERENCES `vendor` (`vendor_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
