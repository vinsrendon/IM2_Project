-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 10, 2024 at 07:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im2_project`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_subject` (IN `subjectCode` VARCHAR(64), IN `subjectName` VARCHAR(128), IN `units` INT)   BEGIN
	INSERT INTO subjects(subject_code,subject_name,units)
    VALUES(subjectCode,subjectName,units);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deactivate_user` (IN `userid` INT)   BEGIN
	UPDATE users SET flag = 0 WHERE user_id = userid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_students` ()   BEGIN

SELECT u.user_id,u.stud_id,u.Flag,ui.fname,ui.mname,ui.lname FROM users u JOIN users_info ui ON u.user_id=ui.user_id WHERE u.Role=0;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_user` (IN `userid` INT)   BEGIN
SELECT * FROM users u JOIN users_info ui ON u.user_id=ui.user_id 
JOIN users_guardian_info ug ON u.user_id=ug.user_id WHERE u.user_id=userid;


END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `hard_delete` (IN `userid` INT)   BEGIN
	DELETE FROM users WHERE user_id = userid;
    DELETE FROM users_info WHERE user_id = userid;
    DELETE FROM users_guardian_info WHERE user_id = userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `studid` INT)   BEGIN
	SELECT * from users where stud_id = studid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `reactivate_user` (IN `userid` INT)   BEGIN
	UPDATE users SET flag = 1 WHERE user_id = userid;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `register_user` (IN `studid` INT, IN `studpass` VARCHAR(128), IN `role` INT, IN `flag` INT, IN `fname` VARCHAR(128), IN `mname` VARCHAR(128), IN `lname` VARCHAR(128), IN `DOB` DATE, IN `address` VARCHAR(256), IN `pnumber` VARCHAR(15), IN `gfname` VARCHAR(128), IN `gmname` VARCHAR(128), IN `glname` VARCHAR(128), IN `gaddress` VARCHAR(256), IN `gpnumber` VARCHAR(15))   BEGIN
	DECLARE new_user_id INT;

 	INSERT INTO users(stud_id,stud_pass,Role,Flag) VALUES(studid,studpass,role,flag);
 
 	SET new_user_id = LAST_INSERT_ID();
 
 	INSERT into users_info(user_id,fname,mname,lname,DOB,address,pnumber) VALUES(new_user_id,fname,mname,lname,DOB,address,pnumber);
 
	INSERT into users_guardian_info(user_id,gfname,gmname,glname,gaddress,gpnumber) VALUES(new_user_id,gfname,gmname,glname,gaddress,gpnumber);
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `truncate_tables` ()   BEGIN
    TRUNCATE TABLE subjects;
    TRUNCATE TABLE users;
    TRUNCATE TABLE users_info;
    TRUNCATE TABLE users_guardian_info;
    TRUNCATE TABLE users_subjects;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `getuserinfo`
-- (See below for the actual view)
--
CREATE TABLE `getuserinfo` (
`user_id` int(11)
,`stud_id` int(11)
,`stud_pass` varchar(128)
,`Role` int(11)
,`Flag` int(11)
,`fname` varchar(128)
,`mname` varchar(128)
,`lname` varchar(128)
,`DOB` date
,`address` varchar(256)
,`pnumber` varchar(15)
,`gfname` varchar(128)
,`gmname` varchar(128)
,`glname` varchar(128)
,`gaddress` varchar(256)
,`gpnumber` varchar(15)
);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_code` varchar(64) NOT NULL,
  `subject_name` varchar(128) NOT NULL,
  `units` int(11) NOT NULL,
  `course` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_code`, `subject_name`, `units`, `course`) VALUES
(1, 'APPSDEV', 'APPLICATIONS DEVELOPMENT', 3, 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `stud_id` int(11) NOT NULL,
  `stud_pass` varchar(128) NOT NULL,
  `Role` int(11) NOT NULL COMMENT '0:student 1:admin',
  `Flag` int(11) NOT NULL COMMENT '0:deactivated 1:active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `stud_id`, `stud_pass`, `Role`, `Flag`) VALUES
(1, 20230101, '$2y$10$czBN8O/nX.MVbKFEYYPy5.lUjll5t75Gagrk.isN4dvV2MeWU6b7.', 0, 1),
(2, 123, '$2y$10$9fIGy9WvtYhK5TCHFSWJ1.CVcR5dpm1Pggg8nz28MHXAnegcY7kLC', 1, 1),
(26, 20230102, '$2y$10$QxwmUmW4CvpvGLY2P5EIVeGPRTIAXOINJjJxGuJM5Hi9BIpM9lsUi', 0, 1),
(27, 20230103, '$2y$10$EB8cp0JEk1gVMX5d3MUt2uS.ldkfoD2bnVJIxWRmbLyl4kw4xtrq6', 0, 1),
(28, 20230104, '$2y$10$IF3qB5A9X5ohNs0Ga5i3nuIGVc2I1Ky9L7tUWrjFU/tvjtjfiFyPq', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_guardian_info`
--

CREATE TABLE `users_guardian_info` (
  `user_id` int(11) NOT NULL,
  `gfname` varchar(128) NOT NULL,
  `gmname` varchar(128) NOT NULL,
  `glname` varchar(128) NOT NULL,
  `gaddress` varchar(256) NOT NULL,
  `gpnumber` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_guardian_info`
--

INSERT INTO `users_guardian_info` (`user_id`, `gfname`, `gmname`, `glname`, `gaddress`, `gpnumber`) VALUES
(1, 'Nicandro', 'Bustos ', 'Montano', 'Rua Maria Areia 575 Cataguases MG 36774 176', '09123456781'),
(2, 'admin gfname', 'admin gmname', 'admin glname', 'admin gaddress', 'admin gpnumber'),
(26, 'john', '', 'reyes', 'pilipog', '09765667324'),
(27, 'john', '', 'curi', 'alegria', '09345623542'),
(28, 'mark', '', 'doe', 'gabi', '09172563172');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

CREATE TABLE `users_info` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(128) NOT NULL,
  `mname` varchar(128) DEFAULT NULL,
  `lname` varchar(128) NOT NULL,
  `DOB` date NOT NULL,
  `address` varchar(256) NOT NULL,
  `pnumber` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`user_id`, `fname`, `mname`, `lname`, `DOB`, `address`, `pnumber`) VALUES
(1, 'Eusebia ', 'Bustos ', 'Montano', '2003-12-26', 'Rua Maria Areia 575 Cataguases MG 36774 176', '09123456780'),
(2, 'admin fname', 'admin mname', 'admin lname', '2003-12-26', 'admin adress', 'admin pnumber'),
(26, 'mark', '', 'reyes', '2000-01-01', 'pilipog', '09162536715'),
(27, 'mari', '', 'curi', '2005-01-01', 'alegria', '09123561253'),
(28, 'john', '', 'doe', '2001-01-01', 'gabi', '09671523652');

-- --------------------------------------------------------

--
-- Table structure for table `users_subjects`
--

CREATE TABLE `users_subjects` (
  `stud_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure for view `getuserinfo`
--
DROP TABLE IF EXISTS `getuserinfo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `getuserinfo`  AS SELECT `u`.`user_id` AS `user_id`, `u`.`stud_id` AS `stud_id`, `u`.`stud_pass` AS `stud_pass`, `u`.`Role` AS `Role`, `u`.`Flag` AS `Flag`, `ui`.`fname` AS `fname`, `ui`.`mname` AS `mname`, `ui`.`lname` AS `lname`, `ui`.`DOB` AS `DOB`, `ui`.`address` AS `address`, `ui`.`pnumber` AS `pnumber`, `ug`.`gfname` AS `gfname`, `ug`.`gmname` AS `gmname`, `ug`.`glname` AS `glname`, `ug`.`gaddress` AS `gaddress`, `ug`.`gpnumber` AS `gpnumber` FROM ((`users` `u` join `users_info` `ui` on(`u`.`user_id` = `ui`.`user_id`)) join `users_guardian_info` `ug` on(`u`.`user_id` = `ug`.`user_id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `stud_id` (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
