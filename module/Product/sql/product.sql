SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `pacificnm_pnm`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) NOT NULL,
  `product_description_short` varchar(255) NOT NULL,
  `product_description_long` text NOT NULL,
  `product_fee` float NOT NULL,
  `product_fee_setup` float NOT NULL,
  `product_fee_monthly` float NOT NULL,
  `product_fee_anual` float NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_status` int(3) UNSIGNED NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `product`:
--
SET FOREIGN_KEY_CHECKS=1;
