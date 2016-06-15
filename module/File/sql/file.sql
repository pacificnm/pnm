--
-- Table structure for table `file`
--

CREATE TABLE `file` (
  `file_id` int(11) NOT NULL,
  `employee_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_name` varchar(200) NOT NULL,
  `file_mime` varchar(100) NOT NULL,
  `file_size` float(10,2) NOT NULL,
  `file_create` int(20) NOT NULL,
  `file_modify` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`file_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT;