--
-- Table structure for table `vendor_account`
--

CREATE TABLE IF NOT EXISTS `vendor_account` (
  `vendor_account_id` int(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(20) NOT NULL,
  `vendor_id` int(20) NOT NULL,
  PRIMARY KEY (`vendor_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
