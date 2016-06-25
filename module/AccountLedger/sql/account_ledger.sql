--
-- Table structure for table `account_ledger`
--

CREATE TABLE IF NOT EXISTS `account_ledger` (
  `account_ledger_id` int(20) NOT NULL AUTO_INCREMENT,
  `account_id` int(20) NOT NULL,
  `from_account_id` int(20) NOT NULL,
  `account_ledger_type` enum('Deposit','Withdrawal','Transfer','') NOT NULL,
  `account_ledger_credit_amount` float(11,2) NOT NULL,
  `account_ledger_debit_amount` float(11,2) NOT NULL,
  `account_ledger_balance` float(11,2) NOT NULL,
  `account_ledger_create` int(11) NOT NULL,
  `account_ledger_memo` text NOT NULL,
  PRIMARY KEY (`account_ledger_id`),
  KEY `account_id` (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `account_ledger`:
--   `account_id`
--       `account` -> `account_id`
--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_ledger`
--
ALTER TABLE `account_ledger`
  ADD CONSTRAINT `fk_account_ledger_account_id` FOREIGN KEY (`account_id`) REFERENCES `account` (`account_id`);
SET FOREIGN_KEY_CHECKS=1;

