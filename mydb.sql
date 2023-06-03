-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 02, 2023 at 06:43 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `a_id` int NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`) VALUES
(13);

-- --------------------------------------------------------

--
-- Table structure for table `body`
--

DROP TABLE IF EXISTS `body`;
CREATE TABLE IF NOT EXISTS `body` (
  `body_id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`body_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `body`
--

INSERT INTO `body` (`body_id`, `type`) VALUES
(1, 'limuzina'),
(2, 'hečbek'),
(3, 'kupe'),
(4, 'SUV'),
(5, 'minivan'),
(6, 'karavan'),
(7, 'kabriolet');

-- --------------------------------------------------------

--
-- Table structure for table `boja`
--

DROP TABLE IF EXISTS `boja`;
CREATE TABLE IF NOT EXISTS `boja` (
  `boja_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`boja_id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `boja`
--

INSERT INTO `boja` (`boja_id`, `name`) VALUES
(1, 'Bela'),
(2, 'Bež'),
(3, 'Bordo'),
(4, 'Braon'),
(5, 'Crna'),
(6, 'Crvena'),
(7, 'Kameleon'),
(8, 'Krem'),
(9, 'Ljubičasta'),
(10, 'Narandžasta'),
(11, 'Plava'),
(12, 'Siva'),
(13, 'Smeđa'),
(14, 'Srebrna'),
(15, 'Tirkiz'),
(16, 'Teget'),
(17, 'Zelena'),
(18, 'Zlatna'),
(19, 'Žuta');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`) VALUES
(1, 'Audi'),
(2, 'Aston Martin'),
(3, 'Alfa Romeo'),
(4, 'Bentley'),
(5, 'BMW'),
(6, 'Buick'),
(7, 'Cadillac'),
(8, 'Chevrolet'),
(9, 'Chrysler'),
(10, 'Daewoo'),
(11, 'Dodge'),
(12, 'Ferrari'),
(13, 'Fiat'),
(14, 'Ford'),
(15, 'Honda'),
(16, 'Hummer'),
(17, 'Hyundai'),
(18, 'Infiniti'),
(19, 'Jaguar'),
(20, 'Jeep'),
(21, 'Kia'),
(22, 'Lamborghini'),
(23, 'Land Rover'),
(24, 'Lexus'),
(25, 'Lotus'),
(26, 'Maserati'),
(27, 'Mazda'),
(28, 'Mercedes Benz'),
(29, 'MG'),
(30, 'Mini'),
(31, 'Mitsubishi'),
(32, 'Nissan'),
(33, 'Peugeot'),
(34, 'Porsche'),
(35, 'Ram'),
(36, 'Renault'),
(37, 'Rolls Royce'),
(38, 'Saab'),
(39, 'Smart'),
(40, 'Subaru'),
(41, 'Suzuki'),
(42, 'Toyota'),
(43, 'Volkswagen'),
(44, 'Volvo'),
(45, 'Yugo');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `cars_id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `brand_id` int NOT NULL,
  PRIMARY KEY (`cars_id`),
  UNIQUE KEY `b_id_UNIQUE` (`cars_id`),
  KEY `fk_Cars_brands1_idx` (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cars_id`, `model`, `brand_id`) VALUES
(1, 'A3', 1),
(2, '147', 3),
(3, 'A7', 1),
(4, 'A4', 1),
(5, '320d', 5),
(6, '407', 33),
(7, 'Clio', 36),
(8, 'C200', 28),
(9, 'GT', 3),
(10, 'Cayenne', 34),
(11, 'X3', 5),
(12, '207', 33),
(13, '106', 33),
(14, '607', 33),
(15, 'fds', 2),
(16, '206', 33),
(17, '508', 33);

-- --------------------------------------------------------

--
-- Table structure for table `cars_instance`
--

DROP TABLE IF EXISTS `cars_instance`;
CREATE TABLE IF NOT EXISTS `cars_instance` (
  `i_id` int NOT NULL AUTO_INCREMENT,
  `cars_id` int NOT NULL,
  `fuel` varchar(45) DEFAULT NULL,
  `mileage` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `transmission` varchar(45) DEFAULT NULL,
  `boja_id` int NOT NULL,
  `komentar` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `motor` varchar(45) DEFAULT NULL,
  `num_doors` varchar(45) DEFAULT NULL,
  `body_id` int NOT NULL,
  `registracija` varchar(45) DEFAULT NULL,
  `num_sed` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`i_id`),
  UNIQUE KEY `i_id_UNIQUE` (`i_id`),
  KEY `fk_Cars_instance_Cars_idx` (`cars_id`),
  KEY `fk_Cars_Instance_boja1_idx` (`boja_id`),
  KEY `fk_Cars_Instance_body1_idx` (`body_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cars_instance`
--

INSERT INTO `cars_instance` (`i_id`, `cars_id`, `fuel`, `mileage`, `year`, `transmission`, `boja_id`, `komentar`, `motor`, `num_doors`, `body_id`, `registracija`, `num_sed`) VALUES
(1, 1, 'Benzin', '267000', '2010', 'Manuelni 5 brzina', 1, 'Odlican auto.', '1600', '3', 1, 'Da', '5'),
(12, 4, 'Dizel', '150000', '2009', 'Manuelni 6 brzina', 5, '\\\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\\\"', '2000', '5', 1, 'Da', '5'),
(14, 4, 'Dizel', '350000', '2006', 'Manuelni 6 brzina', 5, 'Dobro stanje. Registrovan do 25.03.2023.', '2000', '5', 1, 'Ne', '5'),
(15, 1, 'Benzin', '267500', '2002', 'Manuelni 5 brzina', 5, 'Brz dobar pouzdan novo novo novo ludilo automobil bukvalno me kradete ak oga kupite ovoliko jeftino', '1600', '3', 2, 'Da', '5'),
(16, 6, 'Dizel', '270000', '2006', 'Manuelni 6 brzina', 5, 'Registrovan god dana, od ulaganja slab ukumulator i mali servis. Od ostecenja malo udubljenje na gepeku i malo na braniku,sve ostalo bez greske..', '2000', '5', 1, 'Da', '5'),
(17, 4, 'Dizel', '450000', '2004', 'Manuelni 6 brzina', 1, 'ADSdsaadsadsadsads', '2500', '5', 6, 'Ne', '5'),
(18, 7, 'Benzin', '300000', '2003', 'Manuelni 5 brzina', 6, 'reno klio na prodaju.', '1200', '3', 2, 'Da', '5'),
(19, 8, 'Dizel', '150000', '2012', 'Poluautomatski', 5, 'Mercedes Benz C200 na prodaju.', '2000', '5', 1, 'Da', '5'),
(20, 9, 'Dizel', '225000', '2005', 'Manuelni 6 brzina', 12, 'adsadsadsads', '1900', '3', 1, 'Da', '5'),
(21, 10, 'Dizel', '250000', '2008', 'Automatski', 1, 'adsadsads', '3200', '5', 4, 'Ne', '5'),
(22, 1, 'Dizel', '267000', '2002', 'Manuelni 5 brzina', 12, 'adsadsads', '1900', '3', 2, 'Da', '5'),
(23, 1, 'Dizel', '234000', '2002', 'Manuelni 5 brzina', 1, 'adsadsads', '1900', '5', 2, 'Ne', '5'),
(24, 11, 'Benzin', '', '2007', 'Automatski', 5, 'dobar.', '', '5', 1, 'Da', '5'),
(25, 11, 'Dizel', '244000', '2010', 'Automatski', 1, 'ads', '2500', '5', 4, 'Ne', '5'),
(26, 12, 'Dizel', '150000', '2006', 'Manuelni 5 brzina', 1, 'dsaadsads', '1400', '3', 2, 'Da', '5'),
(27, 13, 'Benzin', '350000', '2000', 'Manuelni 5 brzina', 12, 'dsadfhgagsdfg', '1100', '5', 2, 'Da', '5'),
(28, 6, 'Dizel', '320000', '2007', 'Manuelni 6 brzina', 4, 'htfrdhtrdh', '2000', '5', 1, 'Da', '5'),
(29, 14, 'Dizel', '330000', '2003', 'Manuelni 6 brzina', 1, 'gresgresgwerg', '2000', '5', 1, 'Da', '5'),
(30, 9, 'Dizel', '165000', '2007', 'Manuelni 6 brzina', 14, 'neki opis', '1900', '5', 3, 'Da', '5'),
(33, 16, 'Dizel', '260000', '2003', 'Manuelni 5 brzina', 2, 'Peugeot 206', '1300', '5', 2, 'Da', '5'),
(34, 17, 'Benzin', '90000', '2014', 'Automatski', 1, 'Peugeot 508 na prodaju.', '2000', '5', 1, 'Da', '5');

-- --------------------------------------------------------

--
-- Table structure for table `ci_has_image`
--

DROP TABLE IF EXISTS `ci_has_image`;
CREATE TABLE IF NOT EXISTS `ci_has_image` (
  `img_id` int NOT NULL AUTO_INCREMENT,
  `ci_id` int NOT NULL,
  `img` blob NOT NULL,
  PRIMARY KEY (`img_id`),
  KEY `ci_id` (`ci_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ci_has_image`
--

INSERT INTO `ci_has_image` (`img_id`, `ci_id`, `img`) VALUES
(16, 1, 0x33313637353032393333372e6a7067),
(56, 34, 0x35313637353334333336352e6a7067),
(55, 33, 0x35313637353334333239332e6a7067),
(15, 11, 0x33313637353031303438322e706e67),
(17, 1, 0x33313637353032393334302e6a7067),
(18, 1, 0x33313637353032393334352e6a7067),
(20, 12, 0x33313637353130313837342e6a7067),
(21, 12, 0x33313637353130313837372e6a7067),
(22, 12, 0x33313637353130313838342e6a7067),
(23, 12, 0x33313637353130313838382e6a7067),
(24, 12, 0x33313637353130313839322e6a7067),
(25, 12, 0x33313637353130313839372e6a706567),
(26, 12, 0x33313637353130313930382e6a7067),
(57, 34, 0x35313637353334333336392e6a7067),
(32, 15, 0x33313637353231333631342e6a7067),
(33, 15, 0x33313637353231333631392e6a7067),
(34, 15, 0x33313637353231333634362e6a7067),
(35, 14, 0x33313637353231333637302e6a706567),
(36, 14, 0x33313637353231333638332e6a7067),
(37, 16, 0x35313637353235303733382e6a7067),
(38, 16, 0x35313637353235303734322e6a7067),
(39, 16, 0x35313637353235303734352e6a7067),
(40, 16, 0x35313637353235303736302e6a7067),
(41, 19, 0x33313637353235363834382e6a7067),
(42, 20, 0x34313637353235363932382e6a7067),
(43, 21, 0x34313637353235373030302e6a7067),
(44, 22, 0x34313637353235373035332e6a7067),
(45, 24, 0x34313637353235373232382e6a7067),
(46, 24, 0x34313637353235373233312e6a7067),
(47, 25, 0x34313637353235373236382e6a7067),
(48, 26, 0x35313637353235373335342e6a7067),
(49, 26, 0x35313637353235373335382e6a7067),
(50, 27, 0x35313637353235373432302e6a7067),
(51, 28, 0x35313637353235373437342e6a7067),
(52, 29, 0x35313637353235373536352e6a7067),
(53, 29, 0x35313637353235373536382e6a7067),
(54, 30, 0x33313637353238363835322e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `ci_to_approve`
--

DROP TABLE IF EXISTS `ci_to_approve`;
CREATE TABLE IF NOT EXISTS `ci_to_approve` (
  `t_id` int NOT NULL AUTO_INCREMENT,
  `i_id` int NOT NULL,
  PRIMARY KEY (`t_id`),
  KEY `fk_Cars_instance_i_id` (`i_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ci_to_approve`
--

INSERT INTO `ci_to_approve` (`t_id`, `i_id`) VALUES
(3, 32);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `location` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `broj_tel` varchar(45) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `full_name`, `location`, `broj_tel`) VALUES
(3, 'Djordje Karisic', 'Šumadija District', '069 500 1525'),
(4, '123 123 ', 'Braničevo District', '061 123 1234'),
(5, 'Djordje Karisic', 'Belgrade', '061 111 1111');

-- --------------------------------------------------------

--
-- Table structure for table `customer_has_bought`
--

DROP TABLE IF EXISTS `customer_has_bought`;
CREATE TABLE IF NOT EXISTS `customer_has_bought` (
  `i_id` int NOT NULL,
  `c_id` int NOT NULL,
  PRIMARY KEY (`i_id`,`c_id`),
  KEY `fk_Cars_Instance_has_Customer_Customer1_idx` (`c_id`),
  KEY `fk_Cars_Instance_has_Customer_Cars_Instance1_idx` (`i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `customer_is_selling`
--

DROP TABLE IF EXISTS `customer_is_selling`;
CREATE TABLE IF NOT EXISTS `customer_is_selling` (
  `Cars_Instance_i_id` int NOT NULL,
  `Customer_c_id` int NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Cars_Instance_i_id`,`Customer_c_id`),
  KEY `fk_Cars_Instance_has_Customer_Customer2_idx` (`Customer_c_id`),
  KEY `fk_Cars_Instance_has_Customer_Cars_Instance2_idx` (`Cars_Instance_i_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `customer_is_selling`
--

INSERT INTO `customer_is_selling` (`Cars_Instance_i_id`, `Customer_c_id`, `price`) VALUES
(1, 3, '3500'),
(12, 3, '8000'),
(14, 3, '4500'),
(15, 3, '12000'),
(16, 5, '3500'),
(17, 3, '3000'),
(18, 3, '1200'),
(19, 3, '9500'),
(20, 4, '2500'),
(21, 4, '9900'),
(22, 4, '2500'),
(23, 4, '2200'),
(24, 4, '6500'),
(25, 4, '4500'),
(26, 5, '3000'),
(27, 5, '1000'),
(28, 5, '4200'),
(29, 5, '2500'),
(30, 3, '3200'),
(33, 5, '1240'),
(34, 5, '12500');

-- --------------------------------------------------------

--
-- Table structure for table `pretrage_korisnika`
--

DROP TABLE IF EXISTS `pretrage_korisnika`;
CREATE TABLE IF NOT EXISTS `pretrage_korisnika` (
  `p_id` int NOT NULL AUTO_INCREMENT,
  `brend` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `odgod` varchar(255) NOT NULL,
  `dogod` varchar(255) NOT NULL,
  `kilometraza` varchar(255) NOT NULL,
  `gorivo` varchar(255) NOT NULL,
  `menjac` varchar(255) NOT NULL,
  `boje` varchar(255) NOT NULL,
  `registracija` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `cenaod` varchar(255) NOT NULL,
  `cenado` varchar(255) NOT NULL,
  `vreme` datetime NOT NULL,
  `c_id` int NOT NULL,
  `po_cemu` varchar(255) DEFAULT NULL,
  `kako` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `c_id` (`c_id`)
) ENGINE=MyISAM AUTO_INCREMENT=742 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `pretrage_korisnika`
--

INSERT INTO `pretrage_korisnika` (`p_id`, `brend`, `model`, `odgod`, `dogod`, `kilometraza`, `gorivo`, `menjac`, `boje`, `registracija`, `cenaod`, `cenado`, `vreme`, `c_id`, `po_cemu`, `kako`) VALUES
(734, 'Svejedno', '', '1995', '2023', '500000', '', '', '', '', '', '', '2023-02-02 14:05:48', 4, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(720, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 05:11:31', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(719, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 05:11:29', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(718, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 05:11:27', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(717, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 04:54:02', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(716, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 05:08:36', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(715, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 05:08:07', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(714, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 04:54:25', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(713, 'Svejedno', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '', '2023-02-02 04:54:21', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(711, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 04:25:30', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(736, 'Svejedno', '', '1995', '2023', '500000', '', '', '', '', '', '', '2023-02-02 14:06:57', 5, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(737, 'Svejedno', '', '1995', '2023', '500000', '', '', '', '', '', '', '2023-02-02 14:07:01', 5, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(738, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 14:21:43', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(739, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 14:21:45', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(740, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 18:41:54', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(741, 'Svejedno', '', '1995', '2023', '500000', '', '', '', '', '', '', '2023-02-02 19:25:19', 12, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(733, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 13:55:52', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(732, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 13:55:52', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(729, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 13:49:18', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(728, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 13:48:43', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(727, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 13:47:40', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(726, 'Svejedno', '', '1990', '2023', '500000', '', '', '', '', '', '', '2023-02-02 13:47:21', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(724, '1', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 13:34:25', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC'),
(723, '28', 'A3', '1990', '2023', '500000', 'Benzin', 'Manuelni 5 brzina', 'Crna', 'Da', '', '15000', '2023-02-02 13:34:16', 3, ' ORDER BY CONVERT(cis.price,SIGNED)', ' DESC');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `email`, `password`) VALUES
(3, 'djordje34', 'djordje00karisic@gmail.com', '$2y$10$SIGtlJG1YrW0p0/MQ/atd.mFQKzIcPOLSrDT0KoRK2SLJ0RIWI2yW'),
(4, '123123', '213@gg.gg', '$2y$10$3JCQNyx/7xJzW0L8P822cOyP.cg5LCFTIIRoKzab6wUphpKpyNONC'),
(5, 'djordje', 'djordje@djordje.djordje', '$2y$10$7ISZqQZWTogZCfkbC9qZMudYiwhOCISnlblA.OaxwgNTLd5NIGOfe'),
(13, 'admin', 'admintim@udomiauto.com', '$2y$10$gV1ls6otXpMR4yFwrFjxmOU6nyMvosB7haY/PYbz3uC5c965KZOVi');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_Admin_User1` FOREIGN KEY (`a_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `fk_Cars_brands1` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `cars_instance`
--
ALTER TABLE `cars_instance`
  ADD CONSTRAINT `fk_Cars_Instance_body1` FOREIGN KEY (`body_id`) REFERENCES `body` (`body_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Cars_Instance_boja1` FOREIGN KEY (`boja_id`) REFERENCES `boja` (`boja_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Cars_instance_Cars` FOREIGN KEY (`cars_id`) REFERENCES `cars` (`cars_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_Customer_User1` FOREIGN KEY (`c_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_has_bought`
--
ALTER TABLE `customer_has_bought`
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Cars_Instance1` FOREIGN KEY (`i_id`) REFERENCES `cars_instance` (`i_id`),
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Customer1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);

--
-- Constraints for table `customer_is_selling`
--
ALTER TABLE `customer_is_selling`
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Cars_Instance2` FOREIGN KEY (`Cars_Instance_i_id`) REFERENCES `cars_instance` (`i_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Customer2` FOREIGN KEY (`Customer_c_id`) REFERENCES `customer` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
