--
-- Table structure for table `password`
--

CREATE TABLE `password` (
  `password_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `password_location` varchar(200) DEFAULT NULL,
  `password_title` varchar(60) NOT NULL,
  `password_username` varchar(100) NOT NULL,
  `password_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password`
--
ALTER TABLE `password`
  ADD PRIMARY KEY (`password_id`),
  ADD KEY `client_id` (`client_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `password`
--
ALTER TABLE `password`
  MODIFY `password_id` int(20) NOT NULL AUTO_INCREMENT;