--
-- Table structure for table `network_attribute_value`
--

CREATE TABLE `network_attribute_value` (
  `network_attribute_value_id` int(20) NOT NULL,
  `network_attribute_id` int(20) NOT NULL,
  `network_attribute_value_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network_attribute_value`
--

INSERT INTO `network_attribute_value` (`network_attribute_value_id`, `network_attribute_id`, `network_attribute_value_name`) VALUES
(1, 6, 'Plain'),
(2, 6, 'Login'),
(3, 6, 'GSSAPI'),
(4, 6, 'DIGEST-MD5 '),
(5, 6, 'MD5'),
(6, 6, 'CRAM-MD5');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `network_attribute_value`
--
ALTER TABLE `network_attribute_value`
  ADD PRIMARY KEY (`network_attribute_value_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `network_attribute_value`
--
ALTER TABLE `network_attribute_value`
  MODIFY `network_attribute_value_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;