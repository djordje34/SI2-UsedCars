-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 21, 2022 at 06:00 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

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
  `a_id` int(11) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand` varchar(45) DEFAULT NULL,
  `model` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_id_UNIQUE` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cars_instance`
--

DROP TABLE IF EXISTS `cars_instance`;
CREATE TABLE IF NOT EXISTS `cars_instance` (
  `i_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL,
  `fuel` varchar(45) DEFAULT NULL,
  `mileage` varchar(45) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `transmission` varchar(45) DEFAULT NULL,
  `body` varchar(45) DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`i_id`),
  KEY `fk_Cars_instance_Cars` (`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(11) NOT NULL,
  `balance` varchar(45) DEFAULT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `balance`, `full_name`) VALUES
(2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_has_bought`
--

DROP TABLE IF EXISTS `customer_has_bought`;
CREATE TABLE IF NOT EXISTS `customer_has_bought` (
  `i_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  PRIMARY KEY (`i_id`,`c_id`),
  KEY `fk_Cars_Instance_has_Customer_Customer1` (`c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `customer_is_selling`
--

DROP TABLE IF EXISTS `customer_is_selling`;
CREATE TABLE IF NOT EXISTS `customer_is_selling` (
  `Cars_Instance_i_id` int(11) NOT NULL,
  `Customer_c_id` int(11) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Cars_Instance_i_id`,`Customer_c_id`),
  KEY `fk_Cars_Instance_has_Customer_Customer2` (`Customer_c_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `username`, `email`, `password`) VALUES
(2, 'djordje34', 'djordje00karisic@gmail.com', '$2y$10$22.lDWLc2ZPKO9bvK6oZgeQ7f1G2VLmY6cyA0rYM7W8M0vufG8U4a');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `fk_Admin_User1` FOREIGN KEY (`a_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cars_instance`
--
ALTER TABLE `cars_instance`
  ADD CONSTRAINT `fk_Cars_instance_Cars` FOREIGN KEY (`b_id`) REFERENCES `cars` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `fk_Customer_User1` FOREIGN KEY (`c_id`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_has_bought`
--
ALTER TABLE `customer_has_bought`
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Cars_Instance1` FOREIGN KEY (`i_id`) REFERENCES `cars_instance` (`i_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Cars_Instance_has_Customer_Customer1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
