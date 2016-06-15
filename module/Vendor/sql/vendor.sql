--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(20) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `vendor_account_number` varchar(200) DEFAULT NULL,
  `vendor_address` varchar(200) NOT NULL,
  `vendor_city` varchar(200) NOT NULL,
  `vendor_state` varchar(200) NOT NULL,
  `vendor_postal` varchar(60) NOT NULL,
  `vendor_phone` varchar(60) NOT NULL,
  `vendor_website` varchar(200) DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(20) NOT NULL AUTO_INCREMENT;