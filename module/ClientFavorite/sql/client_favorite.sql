--
-- Table structure for table `client_favorite`
--

CREATE TABLE `client_favorite` (
  `client_favorite_id` int(20) NOT NULL,
  `auth_id` int(20) NOT NULL,
  `client_id` int(20) NOT NULL,
  `client_favorite_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client_favorite`
--
ALTER TABLE `client_favorite`
  ADD PRIMARY KEY (`client_favorite_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client_favorite`
--
ALTER TABLE `client_favorite`
  MODIFY `client_favorite_id` int(20) NOT NULL AUTO_INCREMENT;