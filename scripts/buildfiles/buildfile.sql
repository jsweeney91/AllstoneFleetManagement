-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 19, 2017 at 05:03 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `allstone`
--

-- --------------------------------------------------------

--
-- Table structure for table `contract`
--

CREATE TABLE `contract` (
  `CODE` int(11) NOT NULL,
  `CUSTOMER_ID` int(11) NOT NULL,
  `DESCRIPTION` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contract`
--

INSERT INTO `contract` (`CODE`, `CUSTOMER_ID`, `DESCRIPTION`) VALUES
(8, 3, '1000 tonnes of Sand'),
(9, 3, '1000 tonnes of Sand'),
(10, 3, '1000 tonnes of Sand'),
(11, 3, '1000 tonnes of Sand'),
(12, 3, '1000 tonnes of Sand'),
(13, 3, '32 tonnes of 6F2'),
(14, 3, '32 tonnes of 6F2'),
(15, 3, '32 tonnes of 6F2'),
(16, 3, '32 tonnes of 6F2'),
(17, 3, '32 tonnes of 6F2'),
(18, 3, '32 tonnes of 6F2'),
(19, 3, '32 tonnes of 6F2'),
(20, 3, '32 tonnes of 6F2'),
(21, 4, '200 tonnes of Sand'),
(22, 2, '300 tonnes of Top soil');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CODE` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL COMMENT '		',
  `ADDRESS` varchar(255) NOT NULL,
  `PHONE` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CODE`, `NAME`, `ADDRESS`, `PHONE`) VALUES
(1, 'Glasgow City Council', 'George Square, Glasgow G2 1DU', '0141 287 2000'),
(2, 'John Bell', 'dkfjs dsfkj sdf ', '324 2342 '),
(3, 'Edinburgh City Council', '1 edinburgh lane, edinburgh, eh16 4py', '123 321 4312'),
(4, 'GS Site Services', 'Portcullis Estate', '0141 776 2000');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `CODE` int(11) NOT NULL,
  `FIRST_NAME` varchar(45) NOT NULL,
  `LAST_NAME` varchar(45) NOT NULL,
  `ENTRY_DATE` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`CODE`, `FIRST_NAME`, `LAST_NAME`, `ENTRY_DATE`) VALUES
(1, 'Gerrard', 'Sweeney', '2011-01-01 00:00:00'),
(2, 'Stewart', 'Mcneish', '2012-01-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `employee_role`
--

CREATE TABLE `employee_role` (
  `CODE` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `JOB_ROLE_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee_role`
--

INSERT INTO `employee_role` (`CODE`, `EMPLOYEE_ID`, `JOB_ROLE_ID`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_roles`
--

CREATE TABLE `job_roles` (
  `CODE` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `job_roles`
--

INSERT INTO `job_roles` (`CODE`, `NAME`, `DESCRIPTION`) VALUES
(1, 'HGV Driver', 'HGV Driver'),
(2, 'Excavator Operator(30T)', 'Excavator usage up to 30 tonnes'),
(3, 'Sweeper', 'Operator of street sweeping machinery');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

CREATE TABLE `material` (
  `CODE` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`CODE`, `Name`, `Description`) VALUES
(1, '6F2', 'Low grade soil'),
(2, 'Top soil', 'High quality top soil'),
(3, 'Sand', 'High quality sand'),
(4, 'Stone', 'Low Grade Stone');

-- --------------------------------------------------------

--
-- Table structure for table `required_material`
--

CREATE TABLE `required_material` (
  `CODE` int(11) NOT NULL,
  `Contract_CODE` int(11) NOT NULL,
  `Material_CODE` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `required_material`
--

INSERT INTO `required_material` (`CODE`, `Contract_CODE`, `Material_CODE`, `Quantity`) VALUES
(1, 8, 3, 1000),
(2, 9, 3, 1000),
(3, 10, 3, 1000),
(4, 11, 3, 1000),
(5, 12, 3, 1000),
(6, 13, 1, 32),
(7, 14, 1, 32),
(8, 15, 1, 32),
(9, 16, 1, 32),
(10, 17, 1, 32),
(11, 18, 1, 32),
(12, 19, 1, 32),
(13, 20, 1, 32),
(14, 21, 3, 200),
(15, 22, 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `required_roles`
--

CREATE TABLE `required_roles` (
  `CODE` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `TASK_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `CODE` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`CODE`, `Name`, `Description`) VALUES
(1, 'HGV Driver', 'Wagon driver'),
(2, 'Excavator operator', 'Digger operator up to 30T'),
(3, 'Sweeper Operator', 'Road sweeper operator'),
(4, 'Shovel Operator', 'Shovel Driver ');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE `site` (
  `CODE` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `ADDRESS` varchar(45) NOT NULL,
  `DESCRIPTION` varchar(45) DEFAULT NULL,
  `Coordinates` varchar(50) NOT NULL,
  `contract_id` int(11) NOT NULL,
  `collection_flag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`CODE`, `NAME`, `ADDRESS`, `DESCRIPTION`, `Coordinates`, `contract_id`, `collection_flag`) VALUES
(2, '', 'Moffat Way, Edinburgh EH16, UK', NULL, '(55.9340166, -3.1284213999999793)', 17, 1),
(3, '', 'Portcullis Estate, Milton of Campsie, Glasgow', NULL, '(55.9567138, -4.120933499999978)', 17, 0),
(4, '', 'Moffat Way, Edinburgh EH16, UK', NULL, '(55.9340166, -3.1284213999999793)', 18, 1),
(5, '', 'Portcullis Estate, Milton of Campsie, Glasgow', NULL, '(55.9567138, -4.120933499999978)', 18, 0),
(6, '', 'Moffat Way, Edinburgh EH16, UK', NULL, '(55.9340166, -3.1284213999999793)', 19, 1),
(7, '', 'Portcullis Estate, Milton of Campsie, Glasgow', NULL, '(55.9567138, -4.120933499999978)', 19, 0),
(8, '', 'Moffat Way, Edinburgh EH16, UK', NULL, '(55.9340166, -3.1284213999999793)', 20, 1),
(9, '', 'Portcullis Estate, Milton of Campsie, Glasgow', NULL, '(55.9567138, -4.120933499999978)', 20, 0),
(10, '', 'Milngavie Rd, Strathblane, Glasgow G63 9EH, U', NULL, '(55.9812589, -4.3029862999999295)', 21, 1),
(11, '', 'Portcullis Estate, Milton of Campsie, Glasgow', NULL, '(55.9567138, -4.120933499999978)', 21, 0),
(12, '', 'Glasgow Rd, Milngavie, Glasgow G62, UK', NULL, '(55.93728170000001, -4.311782099999959)', 22, 1),
(13, '', 'Drymen Rd, Bearsden, Glasgow G61, UK', NULL, '(55.9187477, -4.3330848000000515)', 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `CODE` int(11) NOT NULL,
  `DESCRIPTION` varchar(255) NOT NULL,
  `PROOF_OF_DELIVERY` varchar(45) DEFAULT NULL,
  `SITE_ID` int(11) NOT NULL,
  `CONTRACT_ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `ASSIGNED_VEHICLE_ID` int(11) DEFAULT NULL,
  `VEHICLE_TYPE_REQUIRED_ID` int(11) DEFAULT NULL,
  `estimated_time` int(11) NOT NULL,
  `start_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `CODE` int(11) NOT NULL,
  `REGISTRATION` varchar(10) NOT NULL,
  `IN_SERVICE` varchar(1) NOT NULL,
  `IS_HIRE` varchar(1) NOT NULL,
  `VEHICLE_TYPE_ID` int(11) NOT NULL,
  `Payload_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`CODE`, `REGISTRATION`, `IN_SERVICE`, `IS_HIRE`, `VEHICLE_TYPE_ID`, `Payload_size`) VALUES
(1, 'DW12FDS', '1', '0', 1, 20),
(2, 'FD32FDS', '1', '0', 1, 20),
(3, 'DS12FED', '1', '0', 1, 20),
(4, 'RD32DSA', '1', '0', 1, 20);

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_type`
--

CREATE TABLE `vehicle_type` (
  `CODE` int(11) NOT NULL,
  `NAME` varchar(45) NOT NULL,
  `DESCRIPTION` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_type`
--

INSERT INTO `vehicle_type` (`CODE`, `NAME`, `DESCRIPTION`) VALUES
(1, 'Wagon', 'Delivery Wagon');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contract`
--
ALTER TABLE `contract`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `CUSTOMER_FK_idx` (`CUSTOMER_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `EMP_ROLE_JOB_ROLE_FK_idx` (`JOB_ROLE_ID`),
  ADD KEY `EMP_ROLE_EMPLOYEE_FK_idx` (`EMPLOYEE_ID`);

--
-- Indexes for table `job_roles`
--
ALTER TABLE `job_roles`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `required_material`
--
ALTER TABLE `required_material`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `fk_Required_Material_Contract1_idx` (`Contract_CODE`),
  ADD KEY `fk_Required_Material_Material1_idx` (`Material_CODE`);

--
-- Indexes for table `required_roles`
--
ALTER TABLE `required_roles`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `REQ_ROLES_JOB_ROLE_FK_idx` (`ROLE_ID`),
  ADD KEY `REQ_ROLES_TASK_ID_idx` (`TASK_ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `site`
--
ALTER TABLE `site`
  ADD PRIMARY KEY (`CODE`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `CONTRACT_FK_idx` (`CONTRACT_ID`),
  ADD KEY `fk_Task_Employee1_idx` (`EMPLOYEE_ID`),
  ADD KEY `TASK_SITE_FK_idx` (`SITE_ID`),
  ADD KEY `TASK_VEHICLE_TYPE_FK_idx` (`VEHICLE_TYPE_REQUIRED_ID`),
  ADD KEY `TASK_VEHICLE_FK_idx` (`ASSIGNED_VEHICLE_ID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`CODE`),
  ADD KEY `VEHICLE_VEHICLE_TYPE_FK_idx` (`VEHICLE_TYPE_ID`);

--
-- Indexes for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  ADD PRIMARY KEY (`CODE`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contract`
--
ALTER TABLE `contract`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `employee_role`
--
ALTER TABLE `employee_role`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `job_roles`
--
ALTER TABLE `job_roles`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `material`
--
ALTER TABLE `material`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `required_material`
--
ALTER TABLE `required_material`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `required_roles`
--
ALTER TABLE `required_roles`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `site`
--
ALTER TABLE `site`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vehicle_type`
--
ALTER TABLE `vehicle_type`
  MODIFY `CODE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `contract`
--
ALTER TABLE `contract`
  ADD CONSTRAINT `CUSTOMER_FK` FOREIGN KEY (`CUSTOMER_ID`) REFERENCES `customer` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_role`
--
ALTER TABLE `employee_role`
  ADD CONSTRAINT `EMP_ROLE_EMPLOYEE_FK` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `EMP_ROLE_JOB_ROLE_FK` FOREIGN KEY (`JOB_ROLE_ID`) REFERENCES `job_roles` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `required_material`
--
ALTER TABLE `required_material`
  ADD CONSTRAINT `fk_Required_Material_Contract1` FOREIGN KEY (`Contract_CODE`) REFERENCES `contract` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Required_Material_Material1` FOREIGN KEY (`Material_CODE`) REFERENCES `material` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `required_roles`
--
ALTER TABLE `required_roles`
  ADD CONSTRAINT `REQ_ROLES_JOB_ROLE_FK` FOREIGN KEY (`ROLE_ID`) REFERENCES `job_roles` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `REQ_ROLES_TASK_ID` FOREIGN KEY (`TASK_ID`) REFERENCES `task` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `CONTRACT_FK` FOREIGN KEY (`CONTRACT_ID`) REFERENCES `contract` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TASK_EMPLOYEE_FK` FOREIGN KEY (`EMPLOYEE_ID`) REFERENCES `employee` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TASK_SITE_FK` FOREIGN KEY (`SITE_ID`) REFERENCES `site` (`CODE`),
  ADD CONSTRAINT `TASK_VEHICLE_FK` FOREIGN KEY (`ASSIGNED_VEHICLE_ID`) REFERENCES `vehicle` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `TASK_VEHICLE_TYPE_FK` FOREIGN KEY (`VEHICLE_TYPE_REQUIRED_ID`) REFERENCES `vehicle_type` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `VEHICLE_VEHICLE_TYPE_FK` FOREIGN KEY (`VEHICLE_TYPE_ID`) REFERENCES `vehicle_type` (`CODE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
