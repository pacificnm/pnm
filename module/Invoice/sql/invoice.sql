--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `invoice_date` int(20) NOT NULL,
  `invoice_date_start` int(11) NOT NULL,
  `invoice_date_end` int(11) NOT NULL,
  `invoice_subtotal` float(10,2) DEFAULT '0.00',
  `invoice_tax` float(10,2) NOT NULL,
  `invoice_discount` float(10,2) NOT NULL,
  `invoice_total` float(10,2) NOT NULL,
  `invoice_payment` float(10,2) NOT NULL,
  `invoice_balance` float(10,2) NOT NULL,
  `invoice_status` enum('Paid','Un-Paid','Void') NOT NULL,
  `invoice_date_paid` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_id` int(20) NOT NULL AUTO_INCREMENT;