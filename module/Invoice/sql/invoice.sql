SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `invoice`
--

CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(20) NOT NULL AUTO_INCREMENT,
  `client_id` int(20) NOT NULL,
  `invoice_date` int(20) NOT NULL,
  `invoice_date_start` int(11) NOT NULL,
  `invoice_date_end` int(11) NOT NULL,
  `invoice_subtotal` float(10,2) DEFAULT '0.00',
  `invoice_tax` float(10,2) NOT NULL,
  `invoice_discount` float(10,2) NOT NULL,
  `invoice_total` float(10,2) NOT NULL,
  `invoice_payment` float(10,2) NOT NULL,
  `invoice_balance` float(10,2) NOT NULL,
  `invoice_status` enum('Paid','Un-Paid','Void') NOT NULL,
  `invoice_date_paid` int(20) DEFAULT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `fk_invoice_client_id` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
