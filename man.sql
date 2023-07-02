-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2021 at 01:40 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `man`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'Ahmed', 'm06ahmed');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `kind` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `messa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `fullname`, `kind`, `national_id`, `messa`) VALUES
(1, 'sd fd', 'teacher', '13212', 'asdcxz'),
(2, 'ahmed saeed', 'student', '32e31wsa', 'asdczx'),
(3, 'as ds', 'teacher', '3231', 'asdcxz');

-- --------------------------------------------------------

--
-- Table structure for table `notif_teacher`
--

CREATE TABLE `notif_teacher` (
  `id` int(255) NOT NULL,
  `subjects` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `messagee` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notif_teacher`
--

INSERT INTO `notif_teacher` (`id`, `subjects`, `national_id`, `messagee`) VALUES
(1, 'Eng', '3231', 'asdc');

-- --------------------------------------------------------

--
-- Table structure for table `registeration`
--

CREATE TABLE `registeration` (
  `id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `registeration`
--

INSERT INTO `registeration` (`id`, `fname`, `lname`, `birthdate`, `telephone`, `email`, `message`) VALUES
(1, 'Ahmed', 'Saeed', '2021-06-04', '+44158673', 'asyd12855@gmail.com', 'zxc ');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(1000) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL,
  `birthdate` date NOT NULL,
  `startingtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `pass`, `fname`, `lname`, `email`, `telephone`, `national_id`, `subjects`, `birthdate`, `startingtime`) VALUES
(1, 'student1', 'm06ahmed', 'ahmed', 'saeed', 'asyd12855@gmail.com', '2122143565', '32e31wsa', 'Ara , Eng , Fra , Mat', '2021-06-04', '2021-06-16'),
(2, 'student2', 'm06ahmed', 'asd', 'zxc', 'asyd12855@gmail.com', '+44158673', '32cacds', 'Ara , Eng , Mat', '2021-06-09', '2021-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(255) NOT NULL,
  `valuesubject` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `valuesubject`, `subjects`) VALUES
(1, 'Ara', 'Arabic'),
(2, 'Eng', 'English'),
(3, 'Fra', 'France'),
(4, 'Mat', 'Math');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(1000) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(1000) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL,
  `startingtime` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `username`, `pass`, `fname`, `lname`, `email`, `telephone`, `national_id`, `subjects`, `startingtime`) VALUES
(1, 'teacher1', 'm06ahmed', 'as', 'ds', 'asyd12855@gmail.com', '+44158673', '3231', 'Ara , Eng , Fra , Mat', '2021-05-31'),
(2, 'teacher2', 'm06ahmed', 'sd', 'fd', 'zxc@as', '+44158673', '13212', 'Ara , Eng , Mat', '2021-06-02');

-- --------------------------------------------------------

--
-- Table structure for table `upload_pdf`
--

CREATE TABLE `upload_pdf` (
  `id` int(255) NOT NULL,
  `pdf_name` varchar(255) NOT NULL,
  `national_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `subjects` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_pdf`
--

INSERT INTO `upload_pdf` (`id`, `pdf_name`, `national_id`, `subjects`) VALUES
(1, 'Lect. 1.pdf', '3231', 'Ara');

-- --------------------------------------------------------

--
-- Table structure for table `upload_videos_mp4`
--

CREATE TABLE `upload_videos_mp4` (
  `id` int(255) NOT NULL,
  `video_name` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_videos_mp4`
--

INSERT INTO `upload_videos_mp4` (`id`, `video_name`, `national_id`, `subjects`) VALUES
(1, 'lect-1_yNgH9dOx.mp4', '3231', 'Ara');

-- --------------------------------------------------------

--
-- Table structure for table `upload_videos_url`
--

CREATE TABLE `upload_videos_url` (
  `id` int(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `national_id` varchar(255) NOT NULL,
  `subjects` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_videos_url`
--

INSERT INTO `upload_videos_url` (`id`, `video_url`, `national_id`, `subjects`) VALUES
(1, 'https://www.youtube.com/watch?v=eewc_fjV8HU', '3231', 'Eng');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_teacher`
--
ALTER TABLE `notif_teacher`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registeration`
--
ALTER TABLE `registeration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_pdf`
--
ALTER TABLE `upload_pdf`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_videos_mp4`
--
ALTER TABLE `upload_videos_mp4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_videos_url`
--
ALTER TABLE `upload_videos_url`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notif_teacher`
--
ALTER TABLE `notif_teacher`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `registeration`
--
ALTER TABLE `registeration`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_pdf`
--
ALTER TABLE `upload_pdf`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_videos_mp4`
--
ALTER TABLE `upload_videos_mp4`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `upload_videos_url`
--
ALTER TABLE `upload_videos_url`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
