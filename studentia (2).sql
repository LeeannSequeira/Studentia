-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2021 at 07:05 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentia`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `C_id` int(10) NOT NULL,
  `C_name` varchar(30) NOT NULL,
  `Category` int(11) NOT NULL,
  `Credits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_id`, `C_name`, `Category`, `Credits`) VALUES
(1, 'Database Management System', 1, 6),
(2, 'IT Project Management', 2, 4),
(3, 'Human Resource Management', 2, 4),
(4, 'E-Commerce', 2, 4),
(5, 'Software Testing', 1, 6),
(6, 'Web Technology', 1, 4),
(7, 'Web Technology Lab', 1, 4),
(8, 'Marketing', 2, 4),
(9, 'Operations Research', 1, 4),
(10, 'Organizational Behaviour', 2, 4),
(11, 'Legal Aspects of Business', 2, 4),
(12, 'Management Information Systems', 3, 4),
(13, 'Business Ethics', 3, 4),
(14, 'Career Planning ', 2, 4),
(15, 'Film Appriciation', 3, 4),
(16, 'Media Law and Ethics', 1, 4),
(17, 'Corporate Communication', 1, 6),
(18, 'Scripting for Media', 2, 4),
(19, 'History of Media', 2, 4),
(20, 'Digital Photography', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `c_category`
--

CREATE TABLE `c_category` (
  `C_id` int(11) NOT NULL,
  `C_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `c_category`
--

INSERT INTO `c_category` (`C_id`, `C_type`) VALUES
(1, 'Core'),
(2, 'Elective'),
(3, 'Ability Enhancement');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Dept_id` int(11) NOT NULL,
  `D_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Dept_id`, `D_name`) VALUES
(1, 'BCA'),
(2, 'BBA'),
(3, 'BAMC');

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `C_id` int(11) NOT NULL,
  `Roll_no` varchar(40) NOT NULL,
  `attendance` int(11) NOT NULL,
  `Course_grade` varchar(5) NOT NULL,
  `Grade_point` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`C_id`, `Roll_no`, `attendance`, `Course_grade`, `Grade_point`) VALUES
(1, '-2', 0, 'F', 0),
(1, '2', 78, 'F', 0),
(2, '-2', 0, 'F', 0),
(2, '2', 0, 'F', 0),
(3, '-2', 0, 'F', 0),
(3, '2', 0, 'F', 0),
(4, '-2', 0, 'F', 0),
(4, '2', 0, 'F', 0),
(5, '-2', 0, 'F', 0),
(5, '2', 0, 'F', 0),
(6, '-2', 0, 'F', 0),
(6, '2', 0, 'F', 0),
(7, '-2', 0, 'F', 0),
(7, '2', 0, 'F', 0),
(10, '-2', 0, 'F', 0),
(10, '2', 0, 'F', 0),
(12, '-2', 0, 'F', 0),
(12, '2', 0, 'F', 0),
(13, '-2', 0, 'F', 0),
(13, '2', 0, 'F', 0),
(14, '-2', 0, 'F', 0),
(14, '2', 0, 'F', 0);

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `P_id` int(11) NOT NULL,
  `P_name` varchar(20) NOT NULL,
  `Department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`P_id`, `P_name`, `Department`) VALUES
(1, 'BCA', 1),
(2, 'BBA', 2),
(3, 'BAMC', 3);

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `Sem_id` int(11) NOT NULL,
  `Start_date` date NOT NULL,
  `End_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`Sem_id`, `Start_date`, `End_date`) VALUES
(1, '0000-06-15', '0000-10-31'),
(2, '0000-12-01', '0000-04-15'),
(3, '0000-06-15', '0000-10-31'),
(4, '0000-12-01', '0000-04-15'),
(5, '0000-06-15', '0000-10-31'),
(6, '0000-12-01', '0000-04-15');

-- --------------------------------------------------------

--
-- Table structure for table `semester_courses`
--

CREATE TABLE `semester_courses` (
  `Sem_id` int(11) NOT NULL,
  `Prog_id` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `semester_courses`
--

INSERT INTO `semester_courses` (`Sem_id`, `Prog_id`, `Course_id`) VALUES
(1, 1, 1),
(1, 1, 2),
(1, 1, 3),
(1, 1, 4),
(1, 1, 5),
(1, 1, 10),
(1, 2, 3),
(1, 2, 8),
(1, 2, 9),
(1, 2, 13),
(1, 2, 14),
(1, 3, 15),
(1, 3, 16),
(1, 3, 17),
(1, 3, 19),
(1, 3, 20),
(2, 1, 6),
(2, 1, 7),
(2, 1, 12),
(2, 1, 13),
(2, 1, 14);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `Roll_no` varchar(20) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Mname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Dateofjoin` date NOT NULL,
  `Education_year` varchar(20) NOT NULL,
  `CPI` float(4,2) NOT NULL,
  `Grade` varchar(20) NOT NULL,
  `Gradepoint` float(6,3) NOT NULL,
  `Program` int(11) NOT NULL,
  `Entitlement_marks` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`Roll_no`, `Fname`, `Mname`, `Lname`, `Dateofjoin`, `Education_year`, `CPI`, `Grade`, `Gradepoint`, `Program`, `Entitlement_marks`) VALUES
('-2', 'Lee', 'E', 'S', '2021-05-07', '1', 0.00, '', 0.000, 1, 0),
('2', 'Leeann', 'Eva', 'Sequeira', '2021-05-13', '1', 0.00, '', 0.000, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_spi`
--

CREATE TABLE `student_spi` (
  `Sem_id` int(11) NOT NULL,
  `Roll_no` varchar(20) NOT NULL,
  `SPI` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_spi`
--

INSERT INTO `student_spi` (`Sem_id`, `Roll_no`, `SPI`) VALUES
(1, '-2', 0.00),
(1, '2', 0.00),
(2, '-2', 0.00),
(2, '2', 0.00),
(3, '-2', 0.00),
(3, '2', 0.00),
(4, '-2', 0.00),
(4, '2', 0.00),
(5, '-2', 0.00),
(5, '2', 0.00),
(6, '-2', 0.00),
(6, '2', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `T_id` int(5) NOT NULL,
  `Fname` varchar(20) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `T_role` varchar(20) NOT NULL,
  `Department` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`T_id`, `Fname`, `Lname`, `Gender`, `Password`, `Email`, `T_role`, `Department`) VALUES
(1016, 'leeann', 'sequeira', 'f', '123123', 'Leeannes2000@gmail.com', 'incharge', 1),
(1017, 'Leeann', 'Se', 'f', '111111', 'lee@gmail.com', 'teacher', 1),
(1018, 'Mark', 'Sequeira', 'm', '111111', 'mark@mail.com', 'incharge', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `Test_id` int(10) NOT NULL,
  `T_name` varchar(20) NOT NULL,
  `Date_conducted` date NOT NULL,
  `Max_marks` int(4) NOT NULL,
  `Test_category` varchar(20) NOT NULL,
  `Course` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`Test_id`, `T_name`, `Date_conducted`, `Max_marks`, `Test_category`, `Course`) VALUES
(37, 'ISA2', '2021-05-13', 15, 'ISA', 13),
(38, 'ESE', '2021-05-13', 50, 'ESE', 13),
(39, 'SRS Activities', '2021-05-06', 10, 'OBT', 13),
(40, 'Ethical Issues', '2021-05-13', 10, 'Presentation', 13),
(41, 'isa1', '2021-05-26', 15, 'ISA', 13),
(43, 'ISA1', '2021-06-18', 15, 'ISA', 14),
(44, 'ISA2', '2021-06-17', 15, 'ISA', 14),
(45, 'SRS_Activities', '2021-06-23', 10, 'Quiz', 14),
(46, 'ESE', '2021-06-26', 50, 'ESE', 14),
(47, 'CSR_ACtivities', '2021-06-21', 10, 'Quiz', 14),
(48, 'abc ', '2021-06-11', 10, 'ISA', 7);

-- --------------------------------------------------------

--
-- Table structure for table `test_conducted`
--

CREATE TABLE `test_conducted` (
  `Test_id` int(11) NOT NULL,
  `Roll_no` varchar(40) NOT NULL,
  `Obtained_marks` int(11) NOT NULL,
  `Attempt_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `test_conducted`
--

INSERT INTO `test_conducted` (`Test_id`, `Roll_no`, `Obtained_marks`, `Attempt_no`) VALUES
(43, '-2', 15, 0),
(43, '2', 15, 0),
(44, '-2', 15, 0),
(44, '2', 0, 0),
(45, '-2', 10, 0),
(45, '2', 0, 0),
(46, '-2', 45, 0),
(46, '2', 0, 0),
(47, '-2', 0, 0),
(47, '2', 0, 0),
(48, '-2', 0, 0),
(48, '2', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`C_id`),
  ADD KEY `categoryCourseLink` (`Category`);

--
-- Indexes for table `c_category`
--
ALTER TABLE `c_category`
  ADD PRIMARY KEY (`C_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dept_id`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`C_id`,`Roll_no`),
  ADD KEY `studentlink` (`Roll_no`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`P_id`),
  ADD KEY `DepartmentProgramLink` (`Department`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`Sem_id`);

--
-- Indexes for table `semester_courses`
--
ALTER TABLE `semester_courses`
  ADD PRIMARY KEY (`Sem_id`,`Prog_id`,`Course_id`),
  ADD KEY `courseelink` (`Course_id`),
  ADD KEY `programCourseLink` (`Prog_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Roll_no`),
  ADD KEY `StudentProgramLink` (`Program`);

--
-- Indexes for table `student_spi`
--
ALTER TABLE `student_spi`
  ADD PRIMARY KEY (`Sem_id`,`Roll_no`),
  ADD KEY `StudentspiLink` (`Roll_no`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`T_id`),
  ADD KEY `DepartmentTeacherLink` (`Department`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`Test_id`),
  ADD KEY `CourseTestLink` (`Course`);

--
-- Indexes for table `test_conducted`
--
ALTER TABLE `test_conducted`
  ADD PRIMARY KEY (`Test_id`,`Roll_no`),
  ADD KEY `sstudlink` (`Roll_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `Dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `P_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `T_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1019;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `Test_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `categoryCourseLink` FOREIGN KEY (`Category`) REFERENCES `c_category` (`C_id`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `courseEnrollLink` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `studentEnrollLink` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`);

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `DepartmentProgramLink` FOREIGN KEY (`Department`) REFERENCES `department` (`Dept_id`);

--
-- Constraints for table `semester_courses`
--
ALTER TABLE `semester_courses`
  ADD CONSTRAINT `CourseSemesterLink` FOREIGN KEY (`Course_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `programCourseLink` FOREIGN KEY (`Prog_id`) REFERENCES `program` (`P_id`),
  ADD CONSTRAINT `semesterCourseLink` FOREIGN KEY (`Sem_id`) REFERENCES `semester` (`Sem_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `StudentProgramLink` FOREIGN KEY (`Program`) REFERENCES `program` (`P_id`);

--
-- Constraints for table `student_spi`
--
ALTER TABLE `student_spi`
  ADD CONSTRAINT `SemesterspiLink` FOREIGN KEY (`Sem_id`) REFERENCES `semester` (`Sem_id`),
  ADD CONSTRAINT `StudentspiLink` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `DepartmentTeacherLink` FOREIGN KEY (`Department`) REFERENCES `department` (`Dept_id`);

--
-- Constraints for table `test`
--
ALTER TABLE `test`
  ADD CONSTRAINT `CourseTestLink` FOREIGN KEY (`Course`) REFERENCES `course` (`C_id`);

--
-- Constraints for table `test_conducted`
--
ALTER TABLE `test_conducted`
  ADD CONSTRAINT `StudentTestLink` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`),
  ADD CONSTRAINT `TestLink` FOREIGN KEY (`Test_id`) REFERENCES `test` (`Test_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
