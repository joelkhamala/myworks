-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 21, 2021 at 08:12 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `rating` tinyint(1) NOT NULL,
  `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `page_id`, `name`, `content`, `rating`, `submit_date`) VALUES
(1, 1, 'Mulongo', 'Best System Ever', 5, '2021-06-20 23:48:51'),
(2, 1, 'Mulongo', 'Bad', 2, '2021-06-20 23:53:15'),
(3, 1, 'Mulongo', 'The best', 5, '2021-06-21 00:39:16'),
(4, 1, 'Mulongo', 'Wow', 4, '2021-06-21 02:34:18');

-- --------------------------------------------------------

--
-- Table structure for table `spaces`
--

DROP TABLE IF EXISTS `spaces`;
CREATE TABLE IF NOT EXISTS `spaces` (
  `Space_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Space_name` varchar(200) NOT NULL,
  `User_ID` int(10) NOT NULL DEFAULT '0',
  `booked` int(11) NOT NULL DEFAULT '0',
  `classname` varchar(200) NOT NULL DEFAULT 'not_booked',
  `time_booked` varchar(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Space_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`Space_ID`, `Space_name`, `User_ID`, `booked`, `classname`, `time_booked`) VALUES
(1, 'space_1', 0, 0, 'not_booked', '0'),
(2, 'space_2', 0, 0, 'not_booked', '0'),
(3, 'space_3', 0, 0, 'not_booked', '0'),
(4, 'space_4', 0, 0, 'not_booked', '0'),
(5, 'space_5', 0, 0, 'not_booked', '0'),
(6, 'space_6', 0, 0, 'not_booked', '0'),
(7, 'space_7', 0, 0, 'not_booked', '0'),
(8, 'space_8', 0, 0, 'not_booked', '0'),
(9, 'space_9', 0, 0, 'not_booked', '0'),
(10, 'space_10', 0, 0, 'not_booked', '0'),
(11, 'space_11', 0, 0, 'not_booked', '0'),
(12, 'space_12', 0, 0, 'not_booked', '0'),
(13, 'space_13', 0, 0, 'not_booked', '0'),
(14, 'space_14', 0, 0, 'not_booked', '0'),
(15, 'space_15', 0, 0, 'not_booked', '0'),
(16, 'space_16', 0, 0, 'not_booked', '0'),
(17, 'space_17', 0, 0, 'not_booked', '0'),
(18, 'space_18', 0, 0, 'not_booked', '0'),
(19, 'space_19', 0, 0, 'not_booked', '0'),
(20, 'space_20', 0, 0, 'not_booked', '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

DROP TABLE IF EXISTS `tbladmin`;
CREATE TABLE IF NOT EXISTS `tbladmin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MobileNumber` varchar(255) DEFAULT NULL,
  `AdminName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `UserName`, `Password`, `Email`, `MobileNumber`, `AdminName`) VALUES
(1, 'neddy', 'ae8b5aa26a3ae31612eec1d1f6ffbce9', 'neddysasala@gmail.com', '05080594809', 'neddy'),
(3, 'john ', 'baaf901179590e912a54f3194de2d121', 'sarahsasala97@gmail.com', '5959595959', 'johnito'),
(4, 'Neddy', 'baaf901179590e912a54f3194de2d121', 'neddysasala@kisiwatech.ac.ke', '5959595959', 'Neddy Sasala'),
(5, 'Job', 'c4cce19cf6453c10754339a15cf9265d', 'jjuma@gmail.com', '0787867576', 'Job Juma'),
(6, 'Hue', 'f14029217ff5e7a50cdc7e70f686cf29', 'sarahsasala99u9@gmail.com', '0787867599', 'Neddy Sasala'),
(7, 'JnJ', '3abf00fa61bfae2fff9133375e142416', 'jnj@gmail.com', '0787657645', 'Joel Masai'),
(8, 'Magufuli', '9aee390f19345028f03bb16c588550e1', 'magufuli@gmail.com', '0787665655', 'John Magufuli'),
(9, 'Neddy', '4c8b40018f893d4384fcfe60302cb46a', 'neddysasala@kisiwatech.ac.ke', '0786765655', 'Neddy Sasala'),
(10, 'Wanyoa', '862994799e1ae336d995855d0dbf5882', 'jwanyoa@gmail.com', '0729520665', 'Joel Wanyoa'),
(11, 'Neddy', '4c8b40018f893d4384fcfe60302cb46a', 'nsasala@gmail.com', '0787867599', 'Neddy Sasala'),
(12, 'Wainaina', '34a6e9b616cae85c90366db83272ff8f', 'wainaina@gmail.com', '0735465364', 'Job');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE IF NOT EXISTS `tblcategory` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `VehicleCat` varchar(255) DEFAULT NULL,
  `parking_charge` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `VehicleCat`, `parking_charge`) VALUES
(1, 'Motorcycle', '50'),
(2, 'Lorry', '150'),
(3, 'PICK UPS', '100'),
(4, 'Saloon Car', '150'),
(5, 'Tipper', '350'),
(6, 'Tractor', '200'),
(7, 'Truck', '150'),
(8, 'Sedan Car', '250'),
(9, 'V8', '250'),
(10, 'Bus', '500'),
(11, 'PSV', '700'),
(12, 'Motorcycles', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

DROP TABLE IF EXISTS `tblusers`;
CREATE TABLE IF NOT EXISTS `tblusers` (
  `User_ID` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone` int(200) NOT NULL,
  `residence` varchar(200) NOT NULL,
  `vehiclecategory` varchar(200) NOT NULL,
  `vehiclecompany` varchar(200) NOT NULL,
  `vehiclereg` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `subscribed` int(200) NOT NULL DEFAULT '0',
  `parking_frequency` int(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`User_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`User_ID`, `firstname`, `middlename`, `lastname`, `username`, `email`, `phone`, `residence`, `vehiclecategory`, `vehiclecompany`, `vehiclereg`, `password`, `subscribed`, `parking_frequency`) VALUES
(1, 'John', 'Maina', 'Wafula', 'Wafula', 'jmaina@gmail.com', 787564765, 'embu', 'V8', 'Toyota', 'KBN 124G', '3abf00fa61bfae2fff9133375e142416', 1, 5),
(2, 'Job', 'Muindi', 'Mulamu', 'Mulamu', 'jmuindi@gmail.com', 786576465, 'kakamega', 'Saloon Car', 'ISUZU', 'KBN 167H', '9aee390f19345028f03bb16c588550e1', 1, 1),
(3, 'Alex', 'Paul', 'Lumumba', 'Lumumba', 'neddysasala@gmail.com', 720334706, 'bungoma', 'Lorry', 'Kisiwa TTI', 'KCZ 220D', '0e12e937d6c57d9a812905a86b915303', 1, 0),
(4, 'Khamala', 'Joel', 'Wanyoa', 'Joe', 'jwanyoa@gmail.com', 729520665, 'bungoma', 'Saloon Car', 'Toyota', 'KRA 123A', '6516f50f2a6675a8cbd4b9c805d58e19', 1, 0),
(5, 'Paul', 'Edwin', 'Mosotya', 'Paul', 'paulmosotya@gmail.com', 756454656, 'bungoma', 'Truck', 'Isuzu', 'KBX 187X', '2a6df21e82a3b929df6a7076c4be1d06', 1, 0),
(6, 'Job', 'Otieno', 'Awinja', 'Awinja', 'awinja@gmail.com', 723465645, 'kiambu', 'Saloon Car', 'Toyota', 'KBX 154N', '3ce3b268ea35e2a1d94eeb6475738e47', 1, 10),
(7, 'Joelly', 'Kham', 'La', 'Joelly', 'joelly@gmail.com', 723445465, 'bungoma', 'V8', 'Toyota', 'KBX 154J', 'e95223f9d4c04ef789348c58d2fdc810', 1, 1),
(8, 'Kimtoo', 'Kiptum', 'Elias', 'Elias', 'elikiptum@gmail.com', 784657543, 'elgeyo marakwet', 'Truck', 'Scania', 'KBV 123J', 'f5113df8ab4054d6852f8a7af1726c2b', 1, 0),
(9, 'Kimtoo', 'Mulongo', 'Elias', 'Mulongo', 'mulongo@gmail.com', 723445465, 'elgeyo marakwet', 'Lorry', 'Scania', 'KBX 154F', 'bba578c72c1620faa538530cd59c63cf', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblvehicle`
--

DROP TABLE IF EXISTS `tblvehicle`;
CREATE TABLE IF NOT EXISTS `tblvehicle` (
  `ParkingNumber` varchar(255) NOT NULL,
  `VehicleCategory` varchar(255) NOT NULL,
  `VehicleCompanyname` varchar(255) NOT NULL,
  `RegistrationNumber` varchar(255) NOT NULL,
  `OwnerName` varchar(255) NOT NULL,
  `OwnerContactNumber` varchar(255) NOT NULL,
  `Status` varchar(255) DEFAULT '',
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Remark` varchar(255) DEFAULT NULL,
  `ParkingCharge` varchar(255) DEFAULT NULL,
  `approved` int(20) NOT NULL DEFAULT '0',
  `InTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `OutTime` timestamp(6) NULL DEFAULT NULL,
  `expectedOutTime` varchar(200) NOT NULL,
  `DateIn` varchar(200) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblvehicle`
--

INSERT INTO `tblvehicle` (`ParkingNumber`, `VehicleCategory`, `VehicleCompanyname`, `RegistrationNumber`, `OwnerName`, `OwnerContactNumber`, `Status`, `ID`, `Remark`, `ParkingCharge`, `approved`, `InTime`, `OutTime`, `expectedOutTime`, `DateIn`) VALUES
('132869853', 'V8', 'Toyota', 'KBN 124G', 'Wafula', '787564765', '', 1, NULL, '250', 0, '2021-03-31 05:54:43', NULL, '0.5', '2021-03-31'),
('860132142', 'Saloon Car', 'ISUZU', 'KBN 167H', 'Mulamu', '786576465', '', 2, NULL, '150', 0, '2021-04-01 13:45:17', NULL, '1', '2021-04-01'),
('541454448', 'V8', 'Toyota', 'KBN 124G', 'Wafula', '787564765', '', 3, NULL, '250', 0, '2021-04-02 16:43:37', NULL, '0.5', '2021-04-02'),
('731578023', 'Saloon Car', 'Toyota', 'KBX 154N', 'Awinja', '723465645', '', 10, NULL, '150', 0, '2021-06-16 21:14:44', NULL, '0.5', '2021-06-16'),
('556908178', 'V8', 'Toyota', 'KBX 154J', 'Joelly', '723445465', '', 11, NULL, '150', 0, '2021-06-18 06:36:33', NULL, '0.5', '2021-06-18'),
('414069832', 'Saloon Car', 'Toyota', 'KBX 154N', 'Awinja', '723465645', '', 12, NULL, '150', 0, '2021-06-18 10:37:56', NULL, '0.5', '2021-06-18'),
('434783156', 'Saloon Car', 'Toyota', 'KBX 154N', 'Awinja', '723465645', '', 13, NULL, '150', 0, '2021-06-19 12:54:33', NULL, '0.5', '2021-06-19'),
('677028952', 'Saloon Car', 'Toyota', 'KBX 154N', 'Awinja', '723465645', '', 14, NULL, '150', 0, '2021-06-20 04:33:08', NULL, '0.5', '2021-06-20'),
('211298477', 'Tractor', 'Isuzu', 'KBX 354U', 'Dennis', '0786756465', '', 15, NULL, NULL, 0, '2021-06-21 08:08:41', NULL, '', '2021-06-21'),
('939224566', 'Lorry', 'Isuzu', 'KBX 354I', 'Dennis Otieno', '0786756465', '', 16, NULL, NULL, 0, '2021-06-21 08:12:22', NULL, '', '2021-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `Transaction_ID` int(11) NOT NULL AUTO_INCREMENT,
  `confirmationCode` varchar(200) NOT NULL,
  `space_booked` varchar(20) NOT NULL,
  `User_ID` int(20) NOT NULL,
  `Amount` int(20) NOT NULL,
  `paydate` date NOT NULL,
  PRIMARY KEY (`Transaction_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`Transaction_ID`, `confirmationCode`, `space_booked`, `User_ID`, `Amount`, `paydate`) VALUES
(2, 'QWERTY', 'space_3', 6, 150, '2021-06-16'),
(3, 'HJKLOMN', 'space_3', 6, 150, '2021-06-18'),
(4, 'KILOT', '', 4, 250, '2021-06-21'),
(5, 'JKLNM', '', 1, 250, '2021-06-21');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
