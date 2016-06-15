--
-- Table structure for table `invoice_payment`
--

CREATE TABLE `invoice_payment` (
  `invoice_payment_id` int(20) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `invoice_payment_date` int(11) NOT NULL,
  `payment_option_id` int(20) NOT NULL,
  `invoice_payment_amount` float(10,2) NOT NULL,
  `invoice_payment_detail` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  ADD PRIMARY KEY (`invoice_payment_id`),
  ADD KEY `invoice_id` (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_payment`
--
ALTER TABLE `invoice_payment`
  MODIFY `invoice_payment_id` int(20) NOT NULL AUTO_INCREMENT;