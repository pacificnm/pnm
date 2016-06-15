--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `config_id` int(20) NOT NULL,
  `config_version` varchar(20) NOT NULL,
  `config_copy_year` int(4) NOT NULL,
  `config_company_name` varchar(200) NOT NULL,
  `config_company_name_short` varchar(60) NOT NULL,
  `config_company_name_abv` varchar(20) NOT NULL,
  `config_company_street` varchar(200) NOT NULL,
  `config_company_street_cont` varchar(200) DEFAULT NULL,
  `config_company_city` varchar(200) NOT NULL,
  `config_company_state` varchar(200) NOT NULL,
  `config_company_postal` varchar(60) NOT NULL,
  `config_company_phone` varchar(60) NOT NULL,
  `config_company_phone_alt` varchar(60) DEFAULT NULL,
  `config_http_address` varchar(200) NOT NULL,
  `config_date_long` varchar(60) NOT NULL,
  `config_date_short` varchar(60) NOT NULL,
  `config_lang` varchar(20) NOT NULL,
  `config_currency` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`config_id`, `config_version`, `config_copy_year`, `config_company_name`, `config_company_name_short`, `config_company_name_abv`, `config_company_street`, `config_company_street_cont`, `config_company_city`, `config_company_state`, `config_company_postal`, `config_company_phone`, `config_company_phone_alt`, `config_http_address`, `config_date_long`, `config_date_short`, `config_lang`, `config_currency`) VALUES
(1, '2.5.0', 2013, '', '', '', '', '', '', '', '', '', '', '', 'm/d/Y h:i a', 'm/d/Y', 'en_US', 'USD');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`config_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `config_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;