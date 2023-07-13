-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 06, 2022 at 01:57 PM
-- Server version: 10.5.16-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u310295298_csams`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `stud_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `timein` time NOT NULL,
  `timeout` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `date`, `stud_id`, `subject_id`, `status`, `teacher_id`, `timein`, `timeout`) VALUES
(10, '2022-11-01', 12, 5, 1, 11, '08:54:42', '22:00:00'),
(11, '2022-11-01', 10, 5, 1, 11, '08:56:08', '22:00:00'),
(13, '2022-11-03', 13, 6, 0, 11, '00:00:00', '19:00:00'),
(14, '2022-11-03', 12, 6, 0, 11, '00:00:00', '19:00:00'),
(16, '2022-11-03', 10, 7, 1, 11, '04:04:38', '17:00:00'),
(17, '2022-11-03', 12, 7, 0, 11, '00:00:00', '17:00:00'),
(18, '2022-11-03', 13, 7, 1, 11, '04:10:53', '17:00:00'),
(19, '2022-11-03', 12, 5, 0, 11, '00:00:00', '22:00:00'),
(20, '2022-11-03', 10, 5, 1, 11, '04:15:11', '22:00:00'),
(21, '2022-11-03', 13, 5, 1, 11, '04:12:37', '22:00:00'),
(22, '2022-11-03', 10, 8, 1, 11, '04:26:27', '14:00:00'),
(23, '2022-11-05', 10, 8, 1, 11, '12:23:19', '14:00:00'),
(24, '2022-11-05', 10, 7, 0, 11, '00:00:00', '14:00:00'),
(25, '2022-11-05', 12, 7, 0, 11, '00:00:00', '14:00:00'),
(26, '2022-11-05', 13, 7, 0, 11, '00:00:00', '14:00:00'),
(27, '2022-11-05', 12, 5, 0, 11, '00:00:00', '15:00:00'),
(28, '2022-11-05', 10, 5, 0, 11, '00:00:00', '15:00:00'),
(29, '2022-11-05', 13, 5, 0, 11, '00:00:00', '15:00:00'),
(30, '2022-11-06', 10, 8, 0, 11, '00:00:00', '20:00:00'),
(31, '2022-11-06', 15, 8, 1, 11, '12:45:36', '20:00:00'),
(33, '2022-11-06', 10, 7, 0, 11, '00:00:00', '22:00:00'),
(34, '2022-11-06', 12, 7, 0, 11, '00:00:00', '22:00:00'),
(35, '2022-11-06', 13, 7, 1, 11, '12:52:00', '22:00:00'),
(36, '2022-11-06', 15, 7, 0, 11, '00:00:00', '22:00:00'),
(40, '2022-11-06', 12, 5, 0, 11, '00:00:00', '21:00:00'),
(41, '2022-11-06', 10, 5, 0, 11, '00:00:00', '21:00:00'),
(42, '2022-11-06', 13, 5, 1, 11, '12:54:22', '21:00:00'),
(43, '2022-11-06', 15, 5, 0, 11, '00:00:00', '21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `admin` varchar(15) NOT NULL,
  `nurse` varchar(15) NOT NULL,
  `guard` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `admin`, `nurse`, `guard`) VALUES
(1, '09453143447', '09453143447', '09453143447');

-- --------------------------------------------------------

--
-- Table structure for table `studentsubject`
--

CREATE TABLE `studentsubject` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `subjectid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentsubject`
--

INSERT INTO `studentsubject` (`id`, `studid`, `subjectid`) VALUES
(8, 12, 5),
(9, 10, 5),
(10, 13, 5),
(11, 13, 6),
(12, 12, 6),
(14, 10, 6),
(15, 10, 7),
(16, 12, 7),
(17, 13, 7),
(18, 10, 8),
(19, 15, 8),
(20, 15, 7),
(21, 15, 5),
(22, 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `student_survey`
--

CREATE TABLE `student_survey` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_survey`
--

INSERT INTO `student_survey` (`id`, `user_id`, `date`) VALUES
(8, 12, '2022-11-01'),
(9, 10, '2022-11-01'),
(10, 13, '2022-11-01'),
(11, 10, '2022-11-02'),
(12, 13, '2022-11-02'),
(13, 10, '2022-11-03'),
(14, 10, '2022-11-05'),
(15, 15, '2022-11-05'),
(16, 13, '2022-11-05'),
(17, 15, '2022-11-06');

-- --------------------------------------------------------

--
-- Table structure for table `student_survey_details`
--

CREATE TABLE `student_survey_details` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `student_survey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subjectcode` varchar(50) NOT NULL,
  `subjectname` varchar(250) NOT NULL,
  `unit` int(11) NOT NULL,
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `day` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subjectcode`, `subjectname`, `unit`, `timefrom`, `timeto`, `teacher_id`, `day`) VALUES
(5, 'IT401', 'Information Assurance and Security 2', 3, '20:53:00', '21:00:00', 11, 'Sunday'),
(7, 'FIL101', 'Filipino', 3, '12:30:00', '22:00:00', 11, 'Sunday'),
(8, 'IT402', 'Programming', 2, '20:00:00', '22:00:00', 11, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `id` int(11) NOT NULL,
  `description` varchar(800) NOT NULL,
  `createdDate` date NOT NULL,
  `column` int(11) NOT NULL,
  `descriptiontag` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`id`, `description`, `createdDate`, `column`, `descriptiontag`) VALUES
(10, 'Fever', '2022-11-01', 2, ' Lagnat '),
(11, 'Headache', '2022-11-01', 2, ' Pananakit ng ulo '),
(12, 'Coughs and/ or Colds', '2022-11-01', 1, ' Ubo at/ o Sipon'),
(13, 'Diarrhea', '2022-11-01', 1, ' Pagtatae'),
(14, 'Body Pains', '2022-11-01', 2, ' Pananakit ng katawan');

-- --------------------------------------------------------

--
-- Table structure for table `surveysubmit`
--

CREATE TABLE `surveysubmit` (
  `id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `visitor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveysubmit`
--

INSERT INTO `surveysubmit` (`id`, `survey_id`, `visitor_id`) VALUES
(15, 12, 12),
(16, 13, 14),
(17, 14, 17),
(18, 14, 19);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `course` varchar(50) NOT NULL,
  `year` varchar(80) NOT NULL,
  `usertype` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `createdDate` date NOT NULL,
  `number` varchar(13) NOT NULL,
  `id_no` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `course`, `year`, `usertype`, `status`, `createdDate`, `number`, `id_no`) VALUES
(5, 'superadmin', '$2y$10$IuJf9jom6jg3DpQ1TQYZ.ujFR.44mNYbqQpMDigsua/nTWUrpyfX6', 'super admin', '', '', 1, 1, '2022-10-24', '90909090', 'Admin101'),
(10, '20190337', '$2y$10$ewCHpRaSz.gaNLFok2/GmueiNuHWsy.lRR0uUWwGs9szHCw0gESty', 'Gio Cabuyao', 'BSIT, Bachelor of Science in INFORMATION TECHNOLOG', 'Fourth year / Second Semester', 3, 0, '2022-11-01', '09453143447', '20190337'),
(11, 'Gio123', '$2y$10$3QEs/bFZmHSMGQAAOoF9k.Al/xg8AtfFeVWcQ8ImO9VKCzkkzQaHq', 'John Kent Abulencia', '', '', 2, 1, '2022-11-01', '09123456789', 'ST1234'),
(12, '20190232', '$2y$10$84topI3Yw9yW3zOJPacv8eJr30g9kAXuALRhIiZA0in62kLp7A4PO', 'Monsoure De La Cruz', 'BSIT, Bachelor of Science in INFORMATION TECHNOLOG', 'Fourth year / Second Semester', 3, 1, '2022-11-01', '09062469081', '20190232'),
(13, '20190401', '$2y$10$0q55zbJ3LERMzpo2UYOT2eLckTPZ5vgBx71sC079HLxmACYnrxS8e', 'John Kent Abulencia', 'BSTM, Bachelor of SCIENCE in TOURISM MANAGEMENT', 'Fourth year / First Semester', 3, 1, '2022-11-01', '09665227694', '20190401'),
(14, 'Admin', '$2y$10$uHEXCqgo3jRbO1pDo.BXLeaXPEgD5oOf4Ff/TjPW48aoox6DDHXPO', 'Admin', '', '', 1, 1, '2022-11-01', '09453143447', 'SA1'),
(15, 'Gio', '$2y$10$WXrZ.COUT8GCncOFNFvWj.Hlm93RvdBffbAvC9n2/0uNUV.2j0/tu', 'Gio', 'BSIT, Bachelor of Science in INFORMATION TECHNOLOG', 'Fourth year / Second Semester', 3, 1, '2022-11-05', '09453143447', '20190337');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `number` varchar(50) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`id`, `date`, `name`, `address`, `number`, `type`) VALUES
(12, '2022-11-01', 'Majin Buu', 'Tayabas', '09865897642', 0),
(13, '2022-11-03', 'Gio Cabuyao', 'Tayabas', '09453143447', 0),
(14, '2022-11-05', 'fullname', 'dyan lang', '09000000000', 0),
(15, '2022-11-05', 'Laiza Zuniga', 'Sariaya,Quezon', '09167276094', 0),
(16, '2022-11-05', 'Abcd Efgh', 'Sariaya Quezon', '09214567891', 0),
(17, '2022-11-05', 'name', 'adres', '09090909090', 0),
(18, '2022-11-05', 'Kulot', 'Jjl', '09123345678', 0),
(19, '2022-11-05', 'name', '15262', '09348484943', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentsubject`
--
ALTER TABLE `studentsubject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_survey`
--
ALTER TABLE `student_survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_survey_details`
--
ALTER TABLE `student_survey_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveysubmit`
--
ALTER TABLE `surveysubmit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentsubject`
--
ALTER TABLE `studentsubject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `student_survey`
--
ALTER TABLE `student_survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `student_survey_details`
--
ALTER TABLE `student_survey_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `surveysubmit`
--
ALTER TABLE `surveysubmit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
