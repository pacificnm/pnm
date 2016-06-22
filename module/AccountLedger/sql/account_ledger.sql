--
-- Table structure for table `account_ledger`
--

CREATE TABLE `account_ledger` (
  `account_ledger_id` int(20) NOT NULL,
  `account_id` int(20) NOT NULL,
  `from_account_id` int(20) NOT NULL,
  `account_ledger_type` enum('Deposit','Withdrawal','Transfer','') NOT NULL,
  `account_ledger_credit_amount` float(11,2) NOT NULL,
  `account_ledger_debit_amount` float(11,2) NOT NULL,
  `account_ledger_balance` float(11,2) NOT NULL,
  `account_ledger_create` int(11) NOT NULL,
  `payment_id` int(20) NOT NULL,
  `invoice_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_ledger`
--
ALTER TABLE `account_ledger`
  ADD PRIMARY KEY (`account_ledger_id`),
  ADD KEY `account_id` (`account_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_ledger`
--
ALTER TABLE `account_ledger`
  MODIFY `account_ledger_id` int(20) NOT NULL AUTO_INCREMENT;