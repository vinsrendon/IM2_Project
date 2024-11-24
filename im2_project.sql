-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2024 at 07:10 PM
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

CREATE DEFINER=`root`@`localhost` PROCEDURE `add_subject_to_student` (IN `sid` INT, IN `subId` INT, IN `time` VARCHAR(20), IN `room` VARCHAR(25), IN `day` VARCHAR(10))   BEGIN
DECLARE subjectCount INT;

    SELECT COUNT(*) INTO subjectCount 
    FROM users_subjects 
    WHERE stud_id = sid;

    IF subjectCount >= 10 THEN
        SIGNAL SQLSTATE '45000';
    ELSE
        -- Check if the combination already exists
        IF EXISTS (
            SELECT 1 
            FROM users_subjects 
            WHERE stud_id = sid AND subject_id = subId AND time = time AND room = room AND day = day
        ) THEN
            SIGNAL SQLSTATE '23000';
        ELSEIF EXISTS (
            SELECT 1 
            FROM users_subjects 
            WHERE stud_id = sid AND time = time AND day = day
        ) THEN
            SIGNAL SQLSTATE '23001';
        ELSE
            INSERT INTO users_subjects (stud_id, subject_id,time,room,day) 
            VALUES (sid, subId, time, room ,day);
        END IF;
    END IF;

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

CREATE DEFINER=`root`@`localhost` PROCEDURE `dltStudSub` (IN `sid` INT, IN `subId` INT)   BEGIN

DELETE FROM users_subjects WHERE stud_id = sid AND subject_id=subId;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_students` ()   BEGIN

SELECT u.user_id,u.stud_id,u.Flag,u.Role,ui.fname,ui.mname,ui.lname FROM users u JOIN users_info ui ON u.user_id=ui.user_id ;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_subjects` ()   BEGIN

SELECT * FROM subjects;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `get_sub_by_sid` (IN `sid` INT)   BEGIN 
	SELECT * FROM users_subjects us JOIN subjects s ON us.subject_id = s.subject_id WHERE us.stud_id = sid;
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
(1, 123, '$2y$10$fz4J03yoQiaFcSAHd2LJK.01cNmwJ80.mVTLbrnPbH14XpuNzEdD6', 1, 1),
(3, 20240001, '$2y$10$I0OFL63lJQnJfLNDexAmyuyYurKxHr4u.6kaS/ol/8istgqpUh1eq', 0, 1),
(4, 20240002, '$2y$10$C.TVHCmyfwZD29.NGnUCFeCaL5x0LnPg88vax6BrAt.DgPmb6QhDW', 0, 1),
(5, 20240003, '$2y$10$iSnys6XLv8RumV0ZeaXhG.R3mzrMfF0OlJYhyHcqOXC75DzxTU9qW', 0, 1),
(6, 20240004, '$2y$10$bzPHJbG29BNic1Ko9q4L0egFaYh8kv8xxreIS1/LEYW03KUjEH/T6', 0, 1),
(7, 20240005, '$2y$10$2k20vYAZ2oqR88bgdy21l.Q1P31onMyfOeFuuESiLvbS9wrj.saRe', 1, 1);

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
(1, 'ADMIN GFNAME', 'ADMIN GMNAME', 'ADMIN GLNAME', 'ADMIN GADDRESS', 'ADMIN GPNUMBER'),
(3, 'GEORGE', '', 'DOE', 'GABI', '09578646364'),
(4, 'RYAN', '', 'BAUTISTA', 'GABI', '09176523571'),
(5, 'SHERIL', '', 'SERNA', 'PILIPOG', '09178263472'),
(6, 'MARY', '', 'MONTéS', 'ALEGRIA', '09675236427'),
(7, 'ADMIN II F', 'ADMIN II M', 'ADMIN II L', 'ADMIN II', '09123762634');

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
(1, 'ADMIN FNAME', 'ADMIN MNAME', 'ADMIN LNAME', '1990-01-01', 'ADMIN ADDRESS', '09123456789'),
(3, 'JOHN', '', 'DOE', '2001-11-17', 'GABI', '09786347856'),
(4, 'MICHAEL', '', 'BAUTISTA', '2000-11-17', 'GABI', '09675624652'),
(5, 'ELLEN', '', 'SERNA', '1991-11-17', 'PILIPOG', '09782634623'),
(6, 'EDELIRA', '', 'MONTéS', '2001-11-17', 'ALEGRIA', '09736423764'),
(7, 'ADMIN II F', 'ADMIN II M', 'ADMIN II L', '2007-11-17', 'ADMIN II', '09123762364');

-- --------------------------------------------------------

--
-- Table structure for table `users_subjects`
--

CREATE TABLE `users_subjects` (
  `stud_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time` varchar(20) NOT NULL,
  `room` varchar(25) NOT NULL,
  `day` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_subjects`
--

INSERT INTO `users_subjects` (`stud_id`, `subject_id`, `time`, `room`, `day`) VALUES
(20240001, 2, '7:00-8:00 AM', 'LAB1', 'MWF');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

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
