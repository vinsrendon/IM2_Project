-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 02:13 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_subject` (IN `subjectCode` VARCHAR(64), IN `subjectName` VARCHAR(128), IN `units` INT, IN `course` VARCHAR(64))   BEGIN
	INSERT INTO subjects(subject_code,subject_name,units,course)
    VALUES(subjectCode,subjectName,units,course);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `change_pass` (IN `newPass` VARCHAR(128), IN `id` INT)   BEGIN
	UPDATE users u SET u.stud_pass=newPass WHERE u.user_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `deactivate_user` (IN `userid` INT)   BEGIN
	UPDATE users SET flag = 0 WHERE user_id = userid;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_subject` (IN `subId` INT)   BEGIN

DELETE FROM subjects WHERE subjects.subject_id = subId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_students` ()   BEGIN

SELECT u.user_id,u.stud_id,u.Flag,ui.fname,ui.mname,ui.lname FROM users u JOIN users_info ui ON u.user_id=ui.user_id WHERE u.Role=0;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_subjects` ()   BEGIN

SELECT * FROM subjects;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `reset_pass` (IN `pass` VARCHAR(128), IN `id` INT)   BEGIN
	UPDATE users u SET u.stud_pass=pass WHERE u.user_id = id;
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
-- Table structure for table `section_template`
--

CREATE TABLE `section_template` (
  `template_id` int(11) NOT NULL,
  `template_section` varchar(16) NOT NULL,
  `template_description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 'HCI 1', 'HUMAN COMPUTER INTERFACE 1', 3, 'BSIT'),
(3, 'IM 1', 'INFORMATION MANAGEMENT 1', 3, 'BSIT'),
(4, 'HCI 2', 'HUMAN COMPUTER INTERFACE 2', 3, 'BSIT'),
(5, 'OS', 'OPERATION SYSTEM', 3, 'BSIT'),
(6, 'OOP1', 'OBJECT ORIENTED PROGRAMMING 1', 3, 'BSIT'),
(7, 'OOP2', 'OBJECT ORIENTED PROGRAMMING 2', 3, 'BSIT'),
(8, 'IM2', 'INFORMATION MANAGEMENT 2', 3, 'BSIT'),
(9, 'IAS1', 'INFORMATION ASSURANCE SECURITY 1', 3, 'BSIT'),
(10, 'IT TRACK EL 2', 'BUSINESS ANALYTICS', 3, 'BSIT'),
(11, 'NET1', 'NETWORKING 1', 3, 'BSIT'),
(12, 'NET2', 'NETWORKING 2', 3, 'BSIT'),
(15, 'SOC SCI1', 'PHIL. CONSTITUTION AND GOVERNMENT', 3, 'BSIT'),
(16, 'SOC SCI 2', 'PHIL. CONSTITUTION AND GOVERNMENT', 3, 'BSIT'),
(17, 'APPSDEV', 'APPLICATIONS DEVELOPMENT', 3, 'BSIT');

-- --------------------------------------------------------

--
-- Table structure for table `template_info`
--

CREATE TABLE `template_info` (
  `template_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(2, 123, '$2y$10$9fIGy9WvtYhK5TCHFSWJ1.CVcR5dpm1Pggg8nz28MHXAnegcY7kLC', 1, 1),
(29, 20230101, '$2y$10$iJJ7YXSlBPK0qUW3MKW1j.hutjFUF2KstsCgelreE.a29Vlpr7bBG', 0, 1),
(30, 20230102, '$2y$10$oWfyf.jyHLxweLwqMWUl5O54P5HF7ztSwmi2qoz4SX9QlYMQHzSTK', 0, 1);

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
(2, 'admin gfname', 'admin gmname', 'admin glname', 'admin gaddress', 'admin gpnumber'),
(29, 'MARK', '', 'DOE', 'GABI CORDOVA', '09347537656'),
(30, 'GEORGE', '', 'REYES', 'PILIPOG', '09785623786');

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
(2, 'admin fname', 'admin mname', 'admin lname', '2003-12-26', 'admin adress', 'admin pnumber'),
(29, 'JOHN', '', 'DOE', '2001-05-22', 'GABI CORDOVA', '07864283756'),
(30, 'JOHN', '', 'REYES', '2001-04-25', 'PILIPOG', '09187346573');

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
-- Indexes for table `section_template`
--
ALTER TABLE `section_template`
  ADD PRIMARY KEY (`template_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD UNIQUE KEY `subject_code` (`subject_code`);

--
-- Indexes for table `template_info`
--
ALTER TABLE `template_info`
  ADD KEY `template_id` (`template_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `stud_id` (`stud_id`);

--
-- Indexes for table `users_guardian_info`
--
ALTER TABLE `users_guardian_info`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_info`
--
ALTER TABLE `users_info`
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users_subjects`
--
ALTER TABLE `users_subjects`
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `stud_id` (`stud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `template_info`
--
ALTER TABLE `template_info`
  ADD CONSTRAINT `template_info_ibfk_1` FOREIGN KEY (`template_id`) REFERENCES `section_template` (`template_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `template_info_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_guardian_info`
--
ALTER TABLE `users_guardian_info`
  ADD CONSTRAINT `users_guardian_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_info`
--
ALTER TABLE `users_info`
  ADD CONSTRAINT `users_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_subjects`
--
ALTER TABLE `users_subjects`
  ADD CONSTRAINT `users_subjects_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`subject_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `users_subjects_ibfk_2` FOREIGN KEY (`stud_id`) REFERENCES `users` (`stud_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
