--
-- Table structure for table `host_attribute`
--

CREATE TABLE `host_attribute` (
  `host_attribute_id` int(20) NOT NULL,
  `host_attribute_name` varchar(100) NOT NULL,
  `host_attribute_type` enum('select','text','long text','boolen') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `host_attribute`
--

INSERT INTO `host_attribute` (`host_attribute_id`, `host_attribute_name`, `host_attribute_type`) VALUES
(1, 'Operating System', 'select'),
(2, 'Manufacture', 'select'),
(3, 'Model', 'text'),
(4, 'Wireless Security', 'select'),
(5, 'Server Type', 'select'),
(6, 'Username', 'text'),
(7, 'Password', 'text'),
(8, 'Wireless Security Password', 'text'),
(9, 'SSID', 'text'),
(10, 'Asset Tag', 'text'),
(11, 'Serial Number', 'text');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `host_attribute`
--
ALTER TABLE `host_attribute`
  ADD PRIMARY KEY (`host_attribute_id`),
  ADD UNIQUE KEY `name` (`host_attribute_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `host_attribute`
--
ALTER TABLE `host_attribute`
  MODIFY `host_attribute_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;