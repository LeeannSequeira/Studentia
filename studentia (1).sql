-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 06:18 PM
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
-- Table structure for table `category_courses`
--

CREATE TABLE `category_courses` (
  `Cat_id` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `C_id` int(10) NOT NULL,
  `C_name` varchar(30) NOT NULL,
  `Category` int(11) NOT NULL,
  `Credits` int(11) NOT NULL,
  `Teacher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`C_id`, `C_name`, `Category`, `Credits`, `Teacher`) VALUES
(1, 'Database Management System', 1, 6, NULL),
(2, 'IT Project Management', 2, 4, NULL),
(3, 'Human Resource Management', 2, 4, NULL),
(4, 'E-Commerce', 2, 4, NULL),
(5, 'Software Testing', 1, 6, NULL),
(6, 'Web Technology', 1, 4, NULL),
(7, 'Web Technology Lab', 1, 4, NULL),
(8, 'Marketing', 2, 4, NULL),
(9, 'Operations Research', 1, 4, NULL),
(10, 'Organizational Behaviour', 2, 4, NULL),
(11, 'Legal Aspects of Business', 2, 4, NULL),
(12, 'Management Information Systems', 3, 4, NULL),
(13, 'Business Ethics', 3, 4, NULL),
(14, 'Career Planning ', 2, 4, NULL),
(15, 'Film Appriciation', 3, 4, NULL),
(16, 'Media Law and Ethics', 1, 4, NULL),
(17, 'Corporate Communication', 1, 6, NULL),
(18, 'Scripting for Media', 2, 4, NULL),
(19, 'History of Media', 2, 4, NULL),
(20, 'Digital Photography', 2, 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_test`
--

CREATE TABLE `course_test` (
  `Course_id` int(11) NOT NULL,
  `Test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Table structure for table `department_programs`
--

CREATE TABLE `department_programs` (
  `Dept_id` int(11) NOT NULL,
  `Prog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department_students`
--

CREATE TABLE `department_students` (
  `Dept_id` int(11) NOT NULL,
  `Roll_no` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department_teachers`
--

CREATE TABLE `department_teachers` (
  `Dept_id` int(11) NOT NULL,
  `T_id` int(11) NOT NULL,
  `Teacher_role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `C_id` int(11) NOT NULL,
  `Roll_no` varchar(40) NOT NULL,
  `attendance` int(11) NOT NULL,
  `Course_grade` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `P_id` int(11) NOT NULL,
  `P_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`P_id`, `P_name`) VALUES
(1, 'BCA'),
(2, 'BBA'),
(3, 'BAMC');

-- --------------------------------------------------------

--
-- Table structure for table `program_semesters`
--

CREATE TABLE `program_semesters` (
  `Sem_id` int(11) NOT NULL,
  `Prog_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `CPI` float(10,5) NOT NULL,
  `Grade` varchar(20) NOT NULL,
  `Gradepoint` float(6,3) NOT NULL,
  `Program` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_spi`
--

CREATE TABLE `student_spi` (
  `Sem_id` int(11) NOT NULL,
  `Roll_no` varchar(20) NOT NULL,
  `SPI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `teacher_courses`
--

CREATE TABLE `teacher_courses` (
  `T_id` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `category_courses`
--
ALTER TABLE `category_courses`
  ADD PRIMARY KEY (`Cat_id`,`Course_id`),
  ADD KEY `clink` (`Course_id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`C_id`),
  ADD KEY `categoryCourseLink` (`Category`),
  ADD KEY `teacherCourseLink` (`Teacher`);

--
-- Indexes for table `course_test`
--
ALTER TABLE `course_test`
  ADD PRIMARY KEY (`Course_id`,`Test_id`),
  ADD KEY `tlink` (`Test_id`);

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
-- Indexes for table `department_programs`
--
ALTER TABLE `department_programs`
  ADD PRIMARY KEY (`Dept_id`,`Prog_id`),
  ADD KEY `proglink` (`Prog_id`);

--
-- Indexes for table `department_students`
--
ALTER TABLE `department_students`
  ADD PRIMARY KEY (`Dept_id`,`Roll_no`),
  ADD KEY `stulink` (`Roll_no`);

--
-- Indexes for table `department_teachers`
--
ALTER TABLE `department_teachers`
  ADD PRIMARY KEY (`Dept_id`,`T_id`),
  ADD KEY `teachlink` (`T_id`);

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
  ADD PRIMARY KEY (`P_id`);

--
-- Indexes for table `program_semesters`
--
ALTER TABLE `program_semesters`
  ADD PRIMARY KEY (`Sem_id`,`Prog_id`),
  ADD KEY `pproglink` (`Prog_id`);

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
-- Indexes for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD PRIMARY KEY (`T_id`,`Course_id`),
  ADD KEY `ccourselink` (`Course_id`);

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
  MODIFY `T_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `Test_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_courses`
--
ALTER TABLE `category_courses`
  ADD CONSTRAINT `catlink` FOREIGN KEY (`Cat_id`) REFERENCES `c_category` (`C_id`),
  ADD CONSTRAINT `clink` FOREIGN KEY (`Course_id`) REFERENCES `course` (`C_id`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `categoryCourseLink` FOREIGN KEY (`Category`) REFERENCES `c_category` (`C_id`),
  ADD CONSTRAINT `teacherCourseLink` FOREIGN KEY (`Teacher`) REFERENCES `teacher` (`T_id`);

--
-- Constraints for table `course_test`
--
ALTER TABLE `course_test`
  ADD CONSTRAINT `courselink` FOREIGN KEY (`Course_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `tlink` FOREIGN KEY (`Test_id`) REFERENCES `test` (`Test_id`);

--
-- Constraints for table `department_programs`
--
ALTER TABLE `department_programs`
  ADD CONSTRAINT `deplink` FOREIGN KEY (`Dept_id`) REFERENCES `department` (`Dept_id`),
  ADD CONSTRAINT `proglink` FOREIGN KEY (`Prog_id`) REFERENCES `program` (`P_id`);

--
-- Constraints for table `department_students`
--
ALTER TABLE `department_students`
  ADD CONSTRAINT `deptlink` FOREIGN KEY (`Dept_id`) REFERENCES `department` (`Dept_id`),
  ADD CONSTRAINT `stulink` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`);

--
-- Constraints for table `department_teachers`
--
ALTER TABLE `department_teachers`
  ADD CONSTRAINT `depttlink` FOREIGN KEY (`Dept_id`) REFERENCES `department` (`Dept_id`),
  ADD CONSTRAINT `teachlink` FOREIGN KEY (`T_id`) REFERENCES `teacher` (`T_id`);

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `courseEnrollLink` FOREIGN KEY (`C_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `studentEnrollLink` FOREIGN KEY (`Roll_no`) REFERENCES `student` (`Roll_no`);

--
-- Constraints for table `program_semesters`
--
ALTER TABLE `program_semesters`
  ADD CONSTRAINT `pproglink` FOREIGN KEY (`Prog_id`) REFERENCES `program` (`P_id`),
  ADD CONSTRAINT `semmlink` FOREIGN KEY (`Sem_id`) REFERENCES `semester` (`Sem_id`);

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
-- Constraints for table `teacher_courses`
--
ALTER TABLE `teacher_courses`
  ADD CONSTRAINT `ccourselink` FOREIGN KEY (`Course_id`) REFERENCES `course` (`C_id`),
  ADD CONSTRAINT `tteachlink` FOREIGN KEY (`T_id`) REFERENCES `teacher` (`T_id`);

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