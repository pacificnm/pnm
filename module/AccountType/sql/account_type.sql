--
-- Table structure for table `account_type`
--

CREATE TABLE `account_type` (
  `account_type_id` int(11) NOT NULL,
  `account_type_name` varchar(200) NOT NULL,
  `account_type_active` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_type`
--

INSERT INTO `account_type` (`account_type_id`, `account_type_name`, `account_type_active`) VALUES
(1, 'Fixed Asset (Major Purchase)', 1),
(2, 'Bank', 1),
(3, 'Loan', 1),
(4, 'Credit Card', 1),
(5, 'Equity', 1),
(6, 'Accounts Receivable', 1),
(7, 'Other Current Asset', 1),
(8, 'Accounts Payable', 1),
(9, 'Other Current Liability', 1),
(10, 'Long Term Liability', 1),
(11, 'Cost Of Goods Sold', 1),
(12, 'Other Income', 1),
(13, 'Other Expense', 1),
(14, 'Auto Loan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_type`
--
ALTER TABLE `account_type`
  ADD PRIMARY KEY (`account_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_type`
--
ALTER TABLE `account_type`
  MODIFY `account_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;