SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `invoice_option`
--

CREATE TABLE IF NOT EXISTS `invoice_option` (
  `invoice_option_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_option_enable_tax` tinyint(3) NOT NULL,
  `invoice_option_enable_discount` tinyint(3) NOT NULL,
  `invoice_option_memo` text NOT NULL,
  `invoice_option_terms` text NOT NULL,
  PRIMARY KEY (`invoice_option_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `invoice_option`:
--

--
-- Dumping data for table `invoice_option`
--

INSERT INTO `invoice_option` (`invoice_option_id`, `invoice_option_enable_tax`, `invoice_option_enable_discount`, `invoice_option_memo`, `invoice_option_terms`) VALUES
(1, 0, 0, 'Thank you for your business!', 'Payment due upon receipt.');
SET FOREIGN_KEY_CHECKS=1;
