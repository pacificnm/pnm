--
-- Table structure for table `invoice_payment`
--

CREATE TABLE IF NOT EXISTS `invoice_payment` (
  `invoice_payment_id` int(20) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(20) NOT NULL,
  `account_id` int(20) NOT NULL,
  `invoice_payment_date` int(11) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `invoice_payment_amount` float(10,2) NOT NULL,
  `invoice_payment_detail` varchar(200) NOT NULL,
  PRIMARY KEY (`invoice_payment_id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;