-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2021 at 06:19 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epm_data`
--
CREATE DATABASE IF NOT EXISTS `epm_data` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `epm_data`;

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--
-- Creation: May 08, 2021 at 04:10 PM
--

CREATE TABLE `disease` (
  `disease_Id` int(11) NOT NULL,
  `disease_name` varchar(150) NOT NULL,
  `disease_description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `disease`:
--

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`disease_Id`, `disease_name`, `disease_description`) VALUES
(1, 'Kidney Problem', 'It is disorder in human body'),
(2, 'Cancer', NULL),
(3, 'Corona', 'Lung problems occur in this disease.'),
(4, 'Acne', 'Skin Problem'),
(5, 'Cold', 'Basic Problem'),
(6, 'Lower respiratory infections', 'Risk factors for lower respiratory infection include: the flu poor air quality '),
(7, 'Diabetes', 'Feel very tired, Have blurry vision'),
(8, 'Dengue', 'Dengue is caused by mosquitoes. patient fills weakness ');

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--
-- Creation: May 09, 2021 at 06:40 AM
--

CREATE TABLE `gender` (
  `GenderId` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `gender`:
--

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`GenderId`, `Gender`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--
-- Creation: May 10, 2021 at 04:54 PM
--

CREATE TABLE `patients` (
  `PatientId` int(11) NOT NULL,
  `Firstname` varchar(100) NOT NULL,
  `Lastname` varchar(100) DEFAULT NULL,
  `Birthdate` date NOT NULL,
  `Gender` int(11) NOT NULL,
  `Mobile` varchar(11) NOT NULL,
  `Email` varchar(150) DEFAULT NULL,
  `AadharNumber` varchar(20) NOT NULL,
  `Address1` varchar(100) NOT NULL,
  `Address2` varchar(100) DEFAULT NULL,
  `Address3` varchar(100) DEFAULT NULL,
  `City` varchar(100) NOT NULL,
  `Pincode` int(11) NOT NULL,
  `state` varchar(50) NOT NULL DEFAULT '3',
  `DiseaseId` int(11) DEFAULT NULL,
  `DiseaseFrom` varchar(50) DEFAULT NULL,
  `Symptoms` varchar(500) DEFAULT NULL,
  `Notes` varchar(500) DEFAULT NULL,
  `PatientsTypeId` int(11) DEFAULT NULL,
  `StatusId` int(11) DEFAULT '4',
  `CreatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` int(11) NOT NULL,
  `UpdatedDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `UpdatedBy` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `patients`:
--   `CreatedBy`
--       `users` -> `User_Id`
--   `DiseaseId`
--       `disease` -> `disease_Id`
--   `Gender`
--       `gender` -> `GenderId`
--   `PatientsTypeId`
--       `patientstype` -> `PatientsTypeId`
--   `StatusId`
--       `status` -> `StatusId`
--   `UpdatedBy`
--       `users` -> `User_Id`
--

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`PatientId`, `Firstname`, `Lastname`, `Birthdate`, `Gender`, `Mobile`, `Email`, `AadharNumber`, `Address1`, `Address2`, `Address3`, `City`, `Pincode`, `state`, `DiseaseId`, `DiseaseFrom`, `Symptoms`, `Notes`, `PatientsTypeId`, `StatusId`, `CreatedDate`, `CreatedBy`, `UpdatedDate`, `UpdatedBy`) VALUES
(1, 'Prakash', 'Patel', '1979-01-20', 1, '7889542566', 'Prakash.patel@xxx.com', '123456789897', 'test address1', 'test address2', 'test address3', 'Mehsana', 384002, 'Gujarat', 1, '1 Year', ' Pain while urine ', ' patient is having allergy from oils    ', 1, 1, '2021-05-08 22:54:42', 1, '2021-05-09 20:37:19', 1),
(2, 'Parag', 'Patel', '1973-01-01', 1, '1234567890', 'test@gmail.com', '1234 1234 4567', '15', 'test address', 'test road', 'Mehsana', 384001, 'Gujarat', 1, '3 Years', '  Pains in body', '  No Suggestions', 3, 1, '2021-05-09 15:10:31', 1, '2021-05-09 18:32:17', 1),
(18, 'Dhruv ', 'Patel', '2000-02-09', 1, '1234567892', 'dhruv.patel@xxx.com', '2121 3232 4554', '12', 'My society', 'park road', 'mehsana', 384002, 'Gujarat', 4, '3 Years', 'Acne on Face\r\nPain full bumps on face', 'Not eat Oily food', 4, 1, '2021-05-10 20:40:07', 1, '2021-05-11 16:37:51', 1),
(19, 'Margi', 'prajapati', '2003-01-01', 2, '2121323265', 'margi.patel@xxx.com', '1234 5454 6522', '112/B', 'test appartments', 'test road', 'Mahesana', 384001, 'Gujarat', 1, '1 Month', 'Pain in Body', '   No Suggestions', 1, 1, '2021-05-10 22:19:01', 1, '2021-05-10 22:20:02', 1),
(20, 'Hetal', 'Kansara', '1911-01-01', 2, '1234123432', 'hetal.kansara@ccc.com', '1234 3214 4123', '17', 'Ashopalav Society', 'Dhobighat road', 'Ahmedabad', 380001, 'Gujarat', 2, '30 Years', 'Body Pain\r\nStomach Ache\r\nHead Ache\r\nBlood in nose', '   Diabitic ', 5, 1, '2021-05-11 12:39:07', 1, '2021-05-11 12:41:02', 1),
(21, 'Maharshi', 'Joshi', '0001-01-01', 1, '2121323265', 'mj@gg.com', '1232 2323 1211', '00', 'Swarg', 'swarg', 'Anantapur', 721635, 'Andhra Pradesh', 3, '3 Days', 'cough\r\nvomiting\r\ncold\r\nfever\r\nweakness ', 'Maintain Social Distancing', 2, 1, '2021-05-11 20:45:52', 1, '2021-05-11 20:49:31', 1),
(22, 'Kishan', 'Thakor', '2021-01-12', 1, '1234123432', 'kt@gpg.com', '1232 1232 1221', '01', 'aakar society', 'park road', 'Gwalior', 475001, 'Madhya Pradesh', 6, '1 Month', 'No Symptoms ', '   ', 1, 1, '2021-05-11 20:53:29', 1, '2021-05-11 20:55:24', 1),
(23, 'Karm', 'Patel', '2007-03-11', 1, '9712920440', 'karm@test.com', '1234 1234 1234', '36', 'Manohar Park', 'Nava para', 'Mahesana', 384001, 'Gujarat', 8, '3 Days', 'Fever, Headache  ', 'take medicines on time ', 2, 1, '2021-05-14 09:59:53', 1, '2021-05-14 10:01:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patientstype`
--
-- Creation: May 08, 2021 at 04:12 PM
--

CREATE TABLE `patientstype` (
  `PatientsTypeId` int(11) NOT NULL,
  `PatientsType` varchar(100) NOT NULL,
  `patients_type_Description` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `patientstype`:
--

--
-- Dumping data for table `patientstype`
--

INSERT INTO `patientstype` (`PatientsTypeId`, `PatientsType`, `patients_type_Description`) VALUES
(1, 'Asymptomatic', 'Asymptomatic'),
(2, 'Mild', NULL),
(3, 'Moderate', NULL),
(4, 'Severe', NULL),
(5, 'Critical', NULL),
(6, 'Test', 'Test Description');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--
-- Creation: May 08, 2021 at 04:13 PM
--

CREATE TABLE `roles` (
  `RoleId` int(11) NOT NULL,
  `Role_Name` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `roles`:
--

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleId`, `Role_Name`) VALUES
(1, 'Admin'),
(2, 'Doctor'),
(3, 'Nurse'),
(4, 'Managment'),
(5, 'Compounder');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--
-- Creation: May 08, 2021 at 04:23 PM
--

CREATE TABLE `status` (
  `StatusId` int(11) NOT NULL,
  `Status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `status`:
--

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`StatusId`, `Status`) VALUES
(1, 'Active'),
(2, 'Close'),
(3, 'Pending'),
(4, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `userlog`
--
-- Creation: May 13, 2021 at 12:20 PM
--

CREATE TABLE `userlog` (
  `userlogid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `userip` varchar(50) DEFAULT NULL,
  `Logintime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `userlog`:
--

--
-- Dumping data for table `userlog`
--

INSERT INTO `userlog` (`userlogid`, `uid`, `username`, `userip`, `Logintime`, `status`) VALUES
(1, 0, 'akash@gmail.com', '::1', '2021-05-13 11:15:03', 0),
(2, 0, 'akash@gmail.com', '::1', '2021-05-13 11:15:03', 0),
(3, 1, 'akash@gmail.com', '::1', '2021-05-13 11:20:03', 1),
(4, 1, 'akash@gmail.com', '::1', '2021-05-13 16:15:03', 1),
(5, 1, 'akash@gmail.com', '127.0.0.1', '2021-05-13 16:30:36', 1),
(7, 0, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 16:38:38', 0),
(17, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 17:44:37', 1),
(18, 2, 'dhruv.raval.official@gmail.com', '127.0.0.1', '2021-05-13 17:51:30', 1),
(19, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 17:55:16', 1),
(20, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 17:55:49', 1),
(21, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 18:38:41', 1),
(22, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 18:48:21', 1),
(23, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 18:56:42', 1),
(24, 0, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:15:49', 0),
(25, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:16:08', 1),
(26, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:17:23', 1),
(27, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:24:11', 1),
(28, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:27:55', 1),
(29, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:36:27', 1),
(30, 1, 'akash@gmail.com', '::1', '2021-05-13 19:38:22', 1),
(31, 1, 'akash@gmail.com', '::1', '2021-05-13 19:38:47', 1),
(32, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:42:25', 1),
(33, 1, 'akash@gmail.com', '::1', '2021-05-13 19:45:46', 1),
(34, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:50:31', 1),
(35, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:52:39', 1),
(36, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 19:58:32', 1),
(37, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 20:02:35', 1),
(38, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 20:03:06', 1),
(39, 1, 'akash@gmail.com', '::1', '2021-05-13 20:06:08', 1),
(40, 5, 'rr@gmail.com', '::1', '2021-05-13 20:18:35', 1),
(41, 5, 'rr@gmail.com', '::1', '2021-05-13 20:20:45', 1),
(42, 1, 'akash@gmail.com', '::1', '2021-05-13 20:35:16', 1),
(43, 5, 'rr@gmail.com', '::1', '2021-05-13 22:19:25', 1),
(44, 5, 'rr@gmail.com', '::1', '2021-05-13 22:20:25', 1),
(45, 5, 'rr@gmail.com', '::1', '2021-05-13 22:21:15', 1),
(46, 5, 'rr@gmail.com', '::1', '2021-05-13 22:21:57', 1),
(47, 5, 'rr@gmail.com', '::1', '2021-05-13 22:22:41', 1),
(48, 5, 'rr@gmail.com', '::1', '2021-05-13 22:23:12', 1),
(49, 5, 'rr@gmail.com', '::1', '2021-05-13 22:27:42', 1),
(50, 1, 'akash@gmail.com', '::1', '2021-05-13 22:28:30', 1),
(51, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-13 22:29:35', 1),
(52, 4, 'pppp@gmail.com', '::1', '2021-05-13 22:33:06', 1),
(53, 1, 'akash@gmail.com', '::1', '2021-05-13 23:55:08', 1),
(54, 1, 'akash@gmail.com', '::1', '2021-05-13 23:57:57', 1),
(55, 1, 'akash@gmail.com', '::1', '2021-05-14 00:28:27', 1),
(56, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-14 00:33:18', 1),
(57, 1, 'akash@gmail.com', '::1', '2021-05-14 09:52:56', 1),
(58, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-14 09:53:33', 1),
(59, 2, 'dhruv.raval.official@gmail.com', '::1', '2021-05-14 09:55:31', 1),
(60, 1, 'akash@gmail.com', '::1', '2021-05-23 11:55:54', 1),
(61, 1, 'akash@gmail.com', '::1', '2021-05-23 12:33:29', 1),
(62, 1, 'akash@gmail.com', '::1', '2021-05-23 12:34:36', 1),
(63, 3, 'archna.vyas@googly.com', '::1', '2021-05-23 14:14:50', 1),
(64, 0, '', '::1', '2021-05-23 14:15:00', 0),
(65, 1, 'akash@gmail.com', '::1', '2021-05-23 14:37:33', 1),
(66, 3, 'archna.vyas@googly.com', '::1', '2021-05-23 16:10:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: May 13, 2021 at 06:55 PM
--

CREATE TABLE `users` (
  `User_Id` int(11) NOT NULL,
  `Prefix` varchar(10) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `mobile` varchar(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `aadharNumber` varchar(25) NOT NULL,
  `address1` varchar(100) NOT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address3` varchar(100) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `state` varchar(20) NOT NULL,
  `statusId` int(11) NOT NULL,
  `avaiblity` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdby` int(11) NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedy` int(11) NOT NULL,
  `RoleId` int(11) NOT NULL,
  `viewusers` tinyint(1) NOT NULL DEFAULT '0',
  `editusers` tinyint(1) NOT NULL DEFAULT '0',
  `editdiseases` tinyint(1) NOT NULL DEFAULT '0',
  `editconditions` tinyint(1) NOT NULL DEFAULT '0',
  `editroles` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `Password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `users`:
--   `RoleId`
--       `roles` -> `RoleId`
--   `createdby`
--       `users` -> `User_Id`
--   `statusId`
--       `status` -> `StatusId`
--   `updatedy`
--       `users` -> `User_Id`
--   `RoleId`
--       `roles` -> `RoleId`
--   `RoleId`
--       `roles` -> `RoleId`
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_Id`, `Prefix`, `firstname`, `lastname`, `mobile`, `email`, `aadharNumber`, `address1`, `address2`, `address3`, `city`, `pincode`, `state`, `statusId`, `avaiblity`, `created_date`, `createdby`, `updated_date`, `updatedy`, `RoleId`, `viewusers`, `editusers`, `editdiseases`, `editconditions`, `editroles`, `admin`, `Password`) VALUES
(1, 'ER.', 'Akash', 'Raval', '7990542798', 'akash@gmail.com', '123456789898', 'test address1', 'test address2', 'test address3', 'Mehsana', '384001', 'Gujarat', 1, 1, '2021-05-08 22:49:32', 1, '2021-05-23 14:37:33', 5, 1, 0, 0, 0, 0, 0, 1, '202cb962ac59075b964b07152d234b70'),
(2, 'DR.', 'Dhruv', 'Raval', '7878545485', 'dhruv.raval.official@gmail.com', '1234 4123 2134', '15 , New Ashopalav Society', 'opp/ Jayvijay Society', 'Dhobighat Road', 'Mahesana', '384001', 'Gujarat', 1, 1, '2021-05-11 18:45:37', 1, '2021-05-14 09:55:31', 1, 2, 0, 0, 1, 1, 0, 0, '202cb962ac59075b964b07152d234b70'),
(3, 'MRS', 'Archna', 'Vyas', '2121323265', 'archna.vyas@googly.com', '1234 2132 2424', '03', 'Mehsanavali Dharamshala', 'Main Road', 'Ambaji', '385110', 'Gujarat', 1, 1, '2021-05-11 20:39:04', 1, '2021-05-23 16:10:03', 1, 3, 0, 0, 0, 0, 0, 0, '202cb962ac59075b964b07152d234b70'),
(4, 'MR', 'Priyansu', 'Raval', '2121323265', 'pppp@gmail.com', '2134 2134 1232', '03', 'Mehsanavali Dharamshala', 'Main Road', 'Ambaji', '385110', 'Gujarat', 1, 0, '2021-05-11 20:40:42', 1, '2021-05-13 21:43:19', 1, 4, 0, 0, 0, 0, 0, 0, '202cb962ac59075b964b07152d234b70'),
(5, 'MR', 'Rushi', 'Vyas', '2121323265', 'rr@gmail.com', '1212 2323 5221', '03', 'Mehsanavali Dharamshala', 'Main Road', 'Ambaji', '385110', 'Gujarat', 1, 0, '2021-05-11 20:42:12', 1, '2021-05-13 22:23:38', 1, 5, 0, 0, 0, 0, 0, 0, '202cb962ac59075b964b07152d234b70'),
(6, 'MR', 'Prabhu', 'Rana', '1231233211', 'parabhu@nurse.com', '12312345621222', '11', 'Hospital housing', 'Park road', 'Mahesana', '384001', 'Gujarat', 1, 0, '2021-05-23 12:26:52', 1, '2021-05-23 12:29:40', 1, 3, 0, 0, 0, 0, 0, 0, NULL),
(7, 'DR.', 'Riya', 'Patel', '1234568750', 'riya@dhruv.com', '12345698745', '122', 'Housing Building', 'Park road', 'Mahesana', '384001', 'Gujarat', 1, 0, '2021-05-23 12:28:50', 1, '2021-05-23 12:29:46', 1, 2, 0, 0, 0, 0, 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`disease_Id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`GenderId`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`PatientId`);

--
-- Indexes for table `patientstype`
--
ALTER TABLE `patientstype`
  ADD PRIMARY KEY (`PatientsTypeId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`StatusId`);

--
-- Indexes for table `userlog`
--
ALTER TABLE `userlog`
  ADD PRIMARY KEY (`userlogid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_Id`),
  ADD KEY `RoleId` (`RoleId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `disease_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `GenderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `PatientId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `patientstype`
--
ALTER TABLE `patientstype`
  MODIFY `PatientsTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `StatusId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `userlog`
--
ALTER TABLE `userlog`
  MODIFY `userlogid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `FK_User_RoleId` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`RoleId`),
  ADD CONSTRAINT `FK_Users_RoleId` FOREIGN KEY (`RoleId`) REFERENCES `roles` (`RoleId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
