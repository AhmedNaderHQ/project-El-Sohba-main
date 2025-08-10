-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2023 at 09:43 PM
-- Server version: 8.0.27
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edu_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci NOT NULL,
  `Course_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Branch_Course` (`Course_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Add_Date` datetime NOT NULL,
  `Admin_ID` int NOT NULL,
  `Visibility` tinyint(1) NOT NULL,
  `Sale` tinyint(1) NOT NULL DEFAULT '0',
  `SaleValue` tinyint DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Category_Admin` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`ID`, `Name`, `Image`, `Add_Date`, `Admin_ID`, `Visibility`, `Sale`, `SaleValue`) VALUES
(1, 'kkllklklk', 'kl kldkmlcmk', '2023-12-10 20:21:37', 1, 0, 0, NULL),
(2, 'Nina Dixon', '624_2479_سلطة جبن الحلومي.jpg', '2023-12-10 22:31:49', 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `categories-properties`
--

DROP TABLE IF EXISTS `categories-properties`;
CREATE TABLE IF NOT EXISTS `categories-properties` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Property` varchar(255) NOT NULL,
  `Value_ar` varchar(255) NOT NULL,
  `Value_du` varchar(255) NOT NULL,
  `Price` int NOT NULL,
  `Category_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Category_ID` (`Category_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Comment` text NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '0',
  `Order_ID` varchar(255) DEFAULT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Coupon` varchar(255) NOT NULL,
  `Description` text,
  `Value` tinyint NOT NULL,
  `Limit` int NOT NULL,
  `Admin_ID` int NOT NULL,
  `Adding-Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`),
  KEY `Admin` (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
CREATE TABLE IF NOT EXISTS `courses` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Image` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Price` float NOT NULL,
  `Add_Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Cat_ID` int NOT NULL,
  `Admin_ID` int DEFAULT NULL,
  `Type` tinyint(1) NOT NULL,
  `Availability` tinyint(1) DEFAULT '1',
  `Sale` tinyint(1) NOT NULL DEFAULT '0',
  `SaleValue` tinyint DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_Cat` (`Cat_ID`),
  KEY `Item_Admin` (`Admin_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`ID`, `Name`, `Description`, `Image`, `Price`, `Add_Date`, `Cat_ID`, `Admin_ID`, `Type`, `Availability`, `Sale`, `SaleValue`) VALUES
(1, 'Eve D', 'Atque illo ut accusa', '4771_2339_ddddd.png', 943, '2023-12-10 21:08:34', 1, 1, 1, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courses-properties`
--

DROP TABLE IF EXISTS `courses-properties`;
CREATE TABLE IF NOT EXISTS `courses-properties` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Property` varchar(255) NOT NULL,
  `Value_ar` varchar(255) NOT NULL,
  `Value_du` varchar(255) NOT NULL,
  `Price` float NOT NULL,
  `Course_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Item_ID` (`Course_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Street` varchar(255) NOT NULL,
  `ZipCode` varchar(255) NOT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `LocationLink` varchar(255) DEFAULT NULL,
  `Adding-Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Last-Log-In` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `VerificationCode` int DEFAULT NULL,
  `VerificationStatus` tinyint(1) NOT NULL DEFAULT '0',
  `ResetPasswordCode` int NOT NULL DEFAULT '0',
  `Subscription` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
CREATE TABLE IF NOT EXISTS `general_settings` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Setting` varchar(255) NOT NULL,
  `Value` varchar(255) CHARACTER SET utf32 COLLATE utf32_general_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`ID`, `Setting`, `Value`) VALUES
(1, 'ShippingPrice', '4'),
(5, 'Opening', '10:00'),
(6, 'Closing', '23:57');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Type` varchar(255) NOT NULL,
  `TypeID` int NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'unread',
  `AddingDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`ID`, `Type`, `TypeID`, `Status`, `AddingDate`) VALUES
(1, 'Item', 1, 'unread', '2023-12-10 21:08:34');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Location` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `LocationLink` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Price` double NOT NULL,
  `Notes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `Customer_Name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Customer_Phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Customer_Email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Customer_ID` int DEFAULT NULL,
  `OrderInfo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `Status` int NOT NULL DEFAULT '0',
  `Payment` tinyint NOT NULL,
  `Order_ID` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Adding-Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CouponValue` tinyint NOT NULL DEFAULT '0',
  `Subscription` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Questions` text COLLATE utf8mb4_general_ci NOT NULL,
  `A` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `B` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `C` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `D` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Rigth_Answer` enum('A','B','C','D') COLLATE utf8mb4_general_ci NOT NULL,
  `Score` int NOT NULL,
  `Quiz_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Question_Quiz` (`Quiz_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quizes`
--

DROP TABLE IF EXISTS `quizes`;
CREATE TABLE IF NOT EXISTS `quizes` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Questions_number` int NOT NULL,
  `Branch_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Quiz_Branch` (`Branch_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ranks`
--

DROP TABLE IF EXISTS `ranks`;
CREATE TABLE IF NOT EXISTS `ranks` (
  `ID` tinyint NOT NULL AUTO_INCREMENT,
  `Rank` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `ranks`
--

INSERT INTO `ranks` (`ID`, `Rank`) VALUES
(1, 'Admin'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `to-do-list`
--

DROP TABLE IF EXISTS `to-do-list`;
CREATE TABLE IF NOT EXISTS `to-do-list` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Task` text NOT NULL,
  `Priority` int NOT NULL,
  `Admin_ID` int NOT NULL,
  `Add-Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Deadline` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Assign-To` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Task_Admin` (`Admin_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Status` tinyint NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(255) NOT NULL,
  `Country` varchar(255) DEFAULT NULL,
  `About` text,
  `Image-Name` varchar(255) NOT NULL,
  `Last-Log-In` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `notifyOrder` varchar(255) NOT NULL DEFAULT 'off',
  `notifyMessage` varchar(255) NOT NULL DEFAULT 'off',
  `notifyItem` varchar(255) NOT NULL DEFAULT 'off',
  `notifyTask` varchar(255) NOT NULL DEFAULT 'off',
  `Token` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `User_PR` (`Status`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Name`, `Email`, `Username`, `Password`, `Status`, `Date`, `Phone`, `Country`, `About`, `Image-Name`, `Last-Log-In`, `notifyOrder`, `notifyMessage`, `notifyItem`, `notifyTask`, `Token`) VALUES
(1, '', 'z2a.programing@gmail.com', 'Z2A.programming', '5cddf801224d05fb6b95b62adbe494820b00f935', 1, '2023-11-04 15:12:58', '', NULL, NULL, '', '2023-12-06 06:26:25', 'off', 'off', 'off', 'off', 'BobAdSDv0OGMC6I22hZxjV6appZgT7'),
(7, 'Lars Clements', 'sagoramyt@mailinator.com', 'fefikaw', 'ac748cb38ff28d1ea98458b16695739d7e90f22d', 2, '2023-12-02 16:24:53', '+1 (531) 951-4023', 'Velit deserunt eu n', 'Voluptas voluptatem ', '3946_4106_logo.webp', '2023-12-02 16:24:53', 'off', 'off', 'off', 'off', 'zWl5rjQpMOWgO1E49ml0tePXCGh8Ck');

-- --------------------------------------------------------

--
-- Table structure for table `weeks`
--

DROP TABLE IF EXISTS `weeks`;
CREATE TABLE IF NOT EXISTS `weeks` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Video_Link` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `Description` text COLLATE utf8mb4_general_ci NOT NULL,
  `Branch_ID` int NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `Week_Branch` (`Branch_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `Branch_Course` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `Category_Admin` FOREIGN KEY (`Admin_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `categories-properties`
--
ALTER TABLE `categories-properties`
  ADD CONSTRAINT `Category_ID` FOREIGN KEY (`Category_ID`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `coupons`
--
ALTER TABLE `coupons`
  ADD CONSTRAINT `Admin` FOREIGN KEY (`Admin_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `Item_Admin` FOREIGN KEY (`Admin_ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `Item_Cat` FOREIGN KEY (`Cat_ID`) REFERENCES `categories` (`ID`);

--
-- Constraints for table `courses-properties`
--
ALTER TABLE `courses-properties`
  ADD CONSTRAINT `Item_ID` FOREIGN KEY (`Course_ID`) REFERENCES `courses` (`ID`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `Question_Quiz` FOREIGN KEY (`Quiz_ID`) REFERENCES `quizes` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `quizes`
--
ALTER TABLE `quizes`
  ADD CONSTRAINT `Quiz_Branch` FOREIGN KEY (`Branch_ID`) REFERENCES `branches` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `to-do-list`
--
ALTER TABLE `to-do-list`
  ADD CONSTRAINT `Task_Admin` FOREIGN KEY (`Admin_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `User_PR` FOREIGN KEY (`Status`) REFERENCES `ranks` (`ID`);

--
-- Constraints for table `weeks`
--
ALTER TABLE `weeks`
  ADD CONSTRAINT `Week_Branch` FOREIGN KEY (`Branch_ID`) REFERENCES `branches` (`ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
