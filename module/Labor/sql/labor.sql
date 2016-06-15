--
-- Table structure for table `labor`
--

CREATE TABLE `labor` (
  `labor_id` int(20) NOT NULL,
  `labor_name` varchar(100) NOT NULL,
  `labor_amount` float(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labor`
--

INSERT INTO `labor` (`labor_id`, `labor_name`, `labor_amount`) VALUES
(1, 'Consulting Service', 85.00),
(2, 'Network Service', 75.00),
(3, 'Basic Service Charge', 65.00),
(4, 'Web Development', 25.00),
(5, 'Database Development', 45.00),
(6, 'No Charge', 0.00),
(7, 'Printer Service', 65.00),
(8, 'Os Configuration', 55.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `labor`
--
ALTER TABLE `labor`
  ADD PRIMARY KEY (`labor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `labor`
--
ALTER TABLE `labor`
  MODIFY `labor_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;