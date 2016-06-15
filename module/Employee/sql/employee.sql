--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(20) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_title` varchar(60) DEFAULT NULL,
  `employee_email` varchar(200) NOT NULL,
  `employee_im` varchar(60) DEFAULT NULL,
  `employee_image` varchar(200) DEFAULT 'photo_60x60.jpg',
  `employee_status` enum('Active','Closed','Deleted') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(20) NOT NULL AUTO_INCREMENT;