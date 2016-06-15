--
-- Table structure for table `workorder_credit`
--

CREATE TABLE `workorder_credit` (
  `workorder_credit_id` int(20) NOT NULL,
  `workorder_id` int(20) NOT NULL,
  `workorder_credit_amount` float(10,2) NOT NULL,
  `workorder_credit_amount_left` float(10,2) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `workorder_credit_detail` varchar(200) NOT NULL,
  `workorder_credit_date` int(11) NOT NULL,
  `workorder_credit_type` enum('Labor','Parts','Total') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder_credit`
--
ALTER TABLE `workorder_credit`
  ADD PRIMARY KEY (`workorder_credit_id`),
  ADD KEY `workorder_id` (`workorder_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder_credit`
--
ALTER TABLE `workorder_credit`
  MODIFY `workorder_credit_id` int(20) NOT NULL AUTO_INCREMENT;