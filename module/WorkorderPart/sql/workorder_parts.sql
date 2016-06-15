--
-- Table structure for table `workorder_parts`
--

CREATE TABLE `workorder_parts` (
  `workorder_parts_id` int(20) NOT NULL,
  `workorder_id` int(20) NOT NULL,
  `workorder_parts_qty` int(8) NOT NULL,
  `workorder_parts_description` varchar(255) NOT NULL,
  `workorder_parts_amount` float(10,2) NOT NULL,
  `workorder_parts_total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workorder_parts`
--
ALTER TABLE `workorder_parts`
  ADD PRIMARY KEY (`workorder_parts_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `workorder_parts`
--
ALTER TABLE `workorder_parts`
  MODIFY `workorder_parts_id` int(20) NOT NULL AUTO_INCREMENT;