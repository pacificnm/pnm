SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `invoice_item`
--

CREATE TABLE IF NOT EXISTS `invoice_item` (
  `invoice_item_id` int(20) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(20) NOT NULL,
  `invoice_item_qty` float(10,2) NOT NULL,
  `invoice_item_descrip` text NOT NULL,
  `invoice_item_amount` float(10,2) NOT NULL,
  `invoice_item_total` float(10,2) NOT NULL,
  `invoice_item_date` int(11) NOT NULL,
  PRIMARY KEY (`invoice_item_id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD CONSTRAINT `fk_invoice_item_invoice_id` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`invoice_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
