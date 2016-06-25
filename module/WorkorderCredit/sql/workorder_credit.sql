SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Table structure for table `workorder_credit`
--

CREATE TABLE IF NOT EXISTS `workorder_credit` (
  `workorder_credit_id` int(20) NOT NULL AUTO_INCREMENT,
  `workorder_id` int(20) NOT NULL,
  `workorder_credit_amount` float(10,2) NOT NULL,
  `workorder_credit_amount_left` float(10,2) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `workorder_credit_detail` varchar(200) NOT NULL,
  `workorder_credit_date` int(11) NOT NULL,
  `workorder_credit_type` enum('Labor','Parts','Total') NOT NULL,
  PRIMARY KEY (`workorder_credit_id`),
  KEY `workorder_id` (`workorder_id`),
  KEY `payment_option_id` (`payment_option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for table `workorder_credit`
--
ALTER TABLE `workorder_credit`
  ADD CONSTRAINT `fk_workorder_credit_payment_option_id` FOREIGN KEY (`payment_option_id`) REFERENCES `payment_option` (`payment_option_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workorder_credit_workorder_id` FOREIGN KEY (`workorder_id`) REFERENCES `workorder` (`workorder_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
