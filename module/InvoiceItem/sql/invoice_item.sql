--
-- Table structure for table `invoice_item`
--

CREATE TABLE `invoice_item` (
  `invoice_item_id` int(20) NOT NULL,
  `invoice_id` int(20) NOT NULL,
  `invoice_item_qty` float(10,2) NOT NULL,
  `invoice_item_descrip` text NOT NULL,
  `invoice_item_amount` float(10,2) NOT NULL,
  `invoice_item_total` float(10,2) NOT NULL,
  `invoice_item_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_item`
--
ALTER TABLE `invoice_item`
  ADD PRIMARY KEY (`invoice_item_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_item`
--
ALTER TABLE `invoice_item`
  MODIFY `invoice_item_id` int(20) NOT NULL AUTO_INCREMENT;