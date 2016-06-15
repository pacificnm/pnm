--
-- Table structure for table `network_attribute`
--

CREATE TABLE `network_attribute` (
  `network_attribute_id` int(20) NOT NULL,
  `network_attribute_name` varchar(255) NOT NULL,
  `network_attribute_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network_attribute`
--

INSERT INTO `network_attribute` (`network_attribute_id`, `network_attribute_name`, `network_attribute_type`) VALUES
(1, 'Windows Domain', 'text'),
(2, 'Web Domain', 'text'),
(3, 'SMTP Server', 'text'),
(4, 'POP 3 Server', 'text'),
(5, 'IMAP Server', 'text'),
(6, 'SMTP Auth Type', 'select'),
(7, 'SMTP Server Port', 'text'),
(8, 'IMAP Server Port', 'text'),
(9, 'POP 3 Server Port', 'text'),
(10, 'LAN Network', 'text'),
(11, 'LAN Default Gateway', 'text'),
(12, 'LAN Domain Name Server', 'text'),
(13, 'LAN Subnet', 'text'),
(14, 'Public IP Address', 'text'),
(15, 'Public Default Gateway', 'text'),
(16, 'Public Domain Name Server', 'text'),
(17, 'Public Subnet', 'text');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `network_attribute`
--
ALTER TABLE `network_attribute`
  ADD PRIMARY KEY (`network_attribute_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `network_attribute`
--
ALTER TABLE `network_attribute`
  MODIFY `network_attribute_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;