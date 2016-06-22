--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(20) NOT NULL,
  `account_type_id` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_description` text NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `account_balance` float(11,2) NOT NULL,
  `account_created` int(11) NOT NULL,
  `account_active` int(3) NOT NULL,
  `account_visible` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `account_type_id` (`account_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(20) NOT NULL AUTO_INCREMENT;