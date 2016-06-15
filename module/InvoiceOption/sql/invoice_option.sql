--
-- Table structure for table `invoice_option`
--

CREATE TABLE `invoice_option` (
  `invoice_option_id` int(11) NOT NULL,
  `invoice_option_enable_tax` tinyint(3) NOT NULL,
  `invoice_option_enable_discount` tinyint(3) NOT NULL,
  `invoice_option_memo` text NOT NULL,
  `invoice_option_terms` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice_option`
--

INSERT INTO `invoice_option` (`invoice_option_id`, `invoice_option_enable_tax`, `invoice_option_enable_discount`, `invoice_option_memo`, `invoice_option_terms`) VALUES
(1, 0, 0, 'Thank you for your business!', 'Payment due upon receipt.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_option`
--
ALTER TABLE `invoice_option`
  ADD PRIMARY KEY (`invoice_option_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_option`
--
ALTER TABLE `invoice_option`
  MODIFY `invoice_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;