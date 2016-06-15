--
-- Table structure for table `payment_option`
--

CREATE TABLE `payment_option` (
  `payment_option_id` int(11) NOT NULL,
  `payment_option_name` varchar(200) NOT NULL,
  `payment_option_enabled` tinyint(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`payment_option_id`, `payment_option_name`, `payment_option_enabled`) VALUES
(1, 'Cash', 1),
(2, 'Check', 1),
(3, 'Credit Card', 0),
(4, 'Pay Pal', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_option`
--
ALTER TABLE `payment_option`
  ADD PRIMARY KEY (`payment_option_id`),
  ADD UNIQUE KEY `payment_option_name` (`payment_option_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_option`
--
ALTER TABLE `payment_option`
  MODIFY `payment_option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;