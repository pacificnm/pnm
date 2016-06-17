--
-- Table structure for table `host_type`
--

CREATE TABLE `host_type` (
  `host_type_id` int(20) NOT NULL,
  `host_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_type`
--

INSERT INTO `host_type` (`host_type_id`, `host_type_name`) VALUES
(11, 'Access Point'),
(6, 'Copier'),
(3, 'Laptop'),
(12, 'Other'),
(5, 'Printer'),
(8, 'Router'),
(7, 'Scanner'),
(2, 'Server'),
(9, 'Switch'),
(4, 'Tablet'),
(10, 'Wireless Router'),
(1, 'Workstation');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `host_type`
--
ALTER TABLE `host_type`
  ADD PRIMARY KEY (`host_type_id`),
  ADD UNIQUE KEY `value` (`host_type_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `host_type`
--
ALTER TABLE `host_type`
  MODIFY `host_type_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;