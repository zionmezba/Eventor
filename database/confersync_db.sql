-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 10:52 PM
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
-- Database: `confersync_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `avatar` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `mail`, `password`, `avatar`) VALUES
('721500444', 'Md. Mezbaul Islam Zion', 'uta2.cse@diu.edu.bd', '16176064', '');

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `institute` varchar(150) NOT NULL,
  `position` varchar(50) NOT NULL,
  `portfolio` varchar(200) NOT NULL,
  `title` varchar(500) NOT NULL,
  `country` varchar(100) NOT NULL,
  `host1` varchar(150) NOT NULL,
  `host2` varchar(150) NOT NULL,
  `type` varchar(50) NOT NULL,
  `indexing` varchar(50) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `venue` varchar(150) NOT NULL,
  `participants` varchar(50) NOT NULL,
  `timestrap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `applicant` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `name`, `mail`, `phone`, `institute`, `position`, `portfolio`, `title`, `country`, `host1`, `host2`, `type`, `indexing`, `startdate`, `enddate`, `venue`, `participants`, `timestrap`, `status`, `applicant`) VALUES
('20625', 'Md. Mezbaul Islam Zion', 'mezbazion@gmail.com', '01750458479', 'DIU', 'Professor', 'https://www.youtube.com/', 'BIM International Conference', 'Bangladesh', 'Daffodil International University', 'jahangirnagar University', 'Conference', 'IEEE Xplore', '2023-08-31', '2023-08-30', 'Both Univerisity', '1000', '2023-08-25 21:10:52', 1, ''),
('2580501', 'Md. Mezbaul Islam Zion', 'mezbazion@gmail.com', '01750458479', 'DIU', 'Professor', 'https://www.youtube.com/', 'BIM International Conference', 'Bangladesh', 'asdasd', 'jahangirnagar University', 'Conference', 'IEEE Xplore', '2023-08-20', '2023-08-29', 'Host University', '300', '2023-08-26 19:57:46', 1, '187580'),
('2600928', 'Md. Mezbaul Islam Zion', 'mezbazion@gmail.com', '01750458479', 'DIU', 'Professor', 'https://www.youtube.com/', 'DIM International Conference', 'Bangladesh', 'Daffodil International University', 'jahangirnagar University', 'Conference', 'IEEE Xplore', '2023-09-01', '2023-09-05', 'Host University', '100', '2023-08-25 21:07:11', 1, ''),
('3512297', 'Md. Mezbaul Islam Zion', 'mezbazion@gmail.com', '01750458479', 'DIU', 'Professor', 'https://zionmezba.github.io/Zion-Portfolio/', '2nd International Conference on Big Data, IoT and Machine Learning (BIM )', 'Bangladesh', 'Center for Intelligent Computing in association with Institute of Information Technology (IIT), Jahangirnagar University', 'Daffodil International University', 'Conference', 'IEEE Xplore', '2023-09-06', '2023-09-08', 'Daffodil International Univeristy', '300', '2023-08-27 22:19:02', 1, '187580');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` varchar(50) NOT NULL,
  `title` varchar(500) NOT NULL,
  `description` varchar(1500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `indexing` varchar(50) NOT NULL,
  `host1` varchar(550) NOT NULL,
  `host2` varchar(550) DEFAULT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `venue` varchar(150) NOT NULL,
  `country` varchar(50) NOT NULL,
  `cover` varchar(150) DEFAULT 'img_default_cover.jpg',
  `registration` datetime NOT NULL,
  `timestrap` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `editor` varchar(50) NOT NULL,
  `organizer` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `description`, `type`, `indexing`, `host1`, `host2`, `startdate`, `enddate`, `timefrom`, `timeto`, `venue`, `country`, `cover`, `registration`, `timestrap`, `editor`, `organizer`, `status`) VALUES
('a85586', 'BIM International Conference', '', 'Conference', 'Scopus', 'Dhaka University', 'CUET', '2023-07-20', '2023-07-29', '00:00:00', '00:00:00', 'Host University', 'Bangladesh', 'test2.jpg', '2023-08-25 10:00:00', '2023-08-28 19:49:42', '187580', '', 0),
('CfI45683', '2nd International Conference on Big Data, IoT and Machine Learning (BIM )', 'The 2nd International Conference on Big Data, IoT and Machine Learning (BIM) is a premier event that brings together researchers, practitioners, and industry experts to share and discuss the latest advances and challenges in these fields. The conference aims to foster interdisciplinary collaborations and exchange of ideas among diverse disciplines and sectors. The conference will feature keynote speeches, invited talks, technical sessions, workshops, tutorials, poster presentations, and exhibitions.', 'Conference', 'IEEE Xplore', 'Center for Intelligent Computing in association with Institute of Information Technology (IIT), Jahangirnagar University', 'Department of CSE, Daffodil International University', '2023-09-06', '2023-09-08', '00:00:00', '00:00:00', 'Daffodil International Univeristy', 'Bangladesh', 'img_default_cover.jpg', '0000-00-00 00:00:00', '2023-08-27 22:32:43', '187580', '', 1),
('DIU15263', 'DIM International Conference', 'Morphological reconstruction is a technique used in image processing to enhance or extract features of interest within an image while preserving their shapes. It\'s particularly useful for tasks like image segmentation, object detection, and noise reduction. Here\'s an overview of how morphological reconstruction works.', 'Conference', 'IEEE Xplore', 'Daffodil International University', 'BUET', '2023-09-01', '2023-09-05', '00:00:00', '00:00:00', 'Host University', 'Bangladesh', 'test2.jpg', '2023-08-25 10:00:00', '2023-08-28 19:49:46', '187580', '', 0),
('DIU56283', 'BIM International Conference', '', 'Conference', 'IEEE Xplore', 'Daffodil International University', 'jahangirnagar University', '2023-08-25', '2023-08-29', '00:00:00', '00:00:00', 'Both Univerisity', 'Bangladesh', 'test1.jpg', '0000-00-00 00:00:00', '2023-08-28 19:49:49', '187580', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `joinconf`
--

CREATE TABLE `joinconf` (
  `id` varchar(50) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `confid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `participants`
--

CREATE TABLE `participants` (
  `serial` int(11) NOT NULL,
  `userid` varchar(50) NOT NULL,
  `eventid` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `participants`
--

INSERT INTO `participants` (`serial`, `userid`, `eventid`) VALUES
(3, '187580', 'DIU56283');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(50) NOT NULL,
  `eventid` varchar(50) NOT NULL,
  `level` varchar(200) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `date` date NOT NULL,
  `timefrom` time NOT NULL,
  `timeto` time NOT NULL,
  `type` varchar(50) NOT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `zoomid` varchar(100) DEFAULT NULL,
  `papers` varchar(1000) NOT NULL,
  `chair` varchar(1000) NOT NULL,
  `moderator` varchar(1000) NOT NULL,
  `coordinator` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `eventid`, `level`, `title`, `date`, `timefrom`, `timeto`, `type`, `venue`, `zoomid`, `papers`, `chair`, `moderator`, `coordinator`) VALUES
('122336110', 'CfI45683', 'End of Day 2', '', '2023-09-07', '20:00:00', '20:00:00', '', '', '', '', '', '', ''),
('128594254', 'CfI45683', 'Invited Talk-1 and Technical Session–D2A1', 'Machine Learning for Disease Detection-02', '2023-09-07', '09:00:00', '10:30:00', 'offline', 'DIU', '', '155, 187, 197, 200', '', '', ''),
('134093671', 'CfI45683', 'Technical Session–D1C2', 'Cyber Security for Industry 4.0', '2023-09-06', '14:30:00', '16:00:00', 'online', 'https://bdren.zoom.us/j/67308192888', '673 0819 2888', '231, 318, 338, 353, 399, 433', '', '', ''),
('137861621', 'CfI45683', 'Technical Session –D2B2', 'Pattern Recognition and Classification -02', '2023-09-07', '14:30:00', '16:00:00', 'offline', '', '', '266, 268, 290, 305, 322, 378', '', '', ''),
('143207864', 'CfI45683', 'Invited Talk-3 and Technical Session–D2C1', 'Data Science and Big Data- 02', '2023-09-07', '09:00:00', '10:30:00', 'offline', '', '', '143, 243, 252, 255', '', '', ''),
('146056385', 'CfI45683', 'Technical Session –D2A2', 'Internet of Things for Smart Applications-02', '2023-09-07', '14:30:00', '04:00:00', 'online', '', '', '276, 298, , 396, 413, 450, 472', '', '', ''),
('149512583', 'CfI45683', 'Keynote Talk-2', '', '2023-09-06', '16:15:00', '16:30:00', 'online', '', '', '', '', '', ''),
('156202520', 'CfI45683', 'Invited Talk 5 and Technical Session –D3A2', 'Internet of Things for Wellbeing-02', '2023-09-08', '14:30:00', '16:00:00', 'offline', '', '', 'Four papers will be presented', '', '', ''),
('204178946', 'CfI45683', 'Closing and Award Ceremony', '', '2023-09-08', '19:00:00', '20:00:00', 'offline', '', '', '', '', '', ''),
('211752744', 'CfI45683', 'Keynote Session-6 (Online)', '', '2023-09-07', '18:30:00', '19:15:00', 'online', '', '', '', '', '', ''),
('219203607', 'CfI45683', 'Refreshment and Prayer Break', '', '2023-09-07', '17:30:00', '18:30:00', 'both', '', '', '', '', '', ''),
('238395520', 'CfI45683', 'Registration and Kits Collection', '', '2023-09-07', '08:00:00', '09:00:00', 'offline', 'Registration Sub-committee', '', '', '', '', ''),
('245150618', 'CfI45683', 'Poster Sessions, Collocated Events Final Round', '', '2023-09-07', '12:30:00', '13:30:00', 'online', '', '', '', '', '', ''),
('251416893', 'CfI45683', 'Invited Talk 8 and Technical Session–D3D2', 'Informatics for Emerging Applications-03', '2023-09-08', '14:30:00', '16:00:00', 'offline', '', '', 'Four papers will be presented', '', '', ''),
('252246307', 'CfI45683', 'Prayer and Lunch Break', '', '2023-09-06', '13:00:00', '14:30:00', 'offline', '', '', '', '', '', ''),
('255098335', 'CfI45683', 'Invited Talk-2 and Technical Session–D2B1', 'Artificial Intelligence for Imaging Applications-02', '2023-09-07', '09:00:00', '10:30:00', 'offline', '', '', '225, 326, 373, 471', '', '', ''),
('272563544', 'CfI45683', 'Technical Session –D3A1', 'Bangla Information Processing - 01', '2023-09-08', '09:00:00', '10:30:00', 'offline', '', '', '293, 319, 421, 455, 458, 460', '', '', ''),
('324022078', 'CfI45683', 'Technical Session –D2C2', 'Text Mining and Education 4.0', '2023-09-07', '14:30:00', '16:00:00', 'offline', '', '', '248, 249, 320, 333, 435, 436', '', '', ''),
('341408740', 'CfI45683', 'Technical Session-D3B1', 'Security Detection and Countermeasures', '2023-09-08', '09:00:00', '10:30:00', 'offline', '', '', '238, 295, 328, 329, 364, 401', '', '', ''),
('396154502', 'CfI45683', 'Opening Ceremony', '', '2023-09-06', '11:30:00', '13:00:00', 'online', 'https://bdren.zoom.us/j/67308192888', '673 0819 2888', '', '', '', ''),
('396158541', 'CfI45683', 'Technical Session –D1A1', 'Machine Learning for Disease Detection-01', '2023-09-06', '09:00:00', '10:30:00', 'online', 'meet.google.com/dfhaosdfhi', '', '112, 149, 152, 201, 208, 216', 'ABC', 'DEF', 'GHI'),
('396165479', 'CfI45683', 'Technical Session –D1C1', 'Data Science and Big Data- 01', '2023-09-06', '09:00:00', '10:30:00', 'online', 'meet.google.com/dfhaosdfhi', '', '110, 138,140, 153, 166, 170', 'MNO', 'PQR', 'JKL'),
('396442745', 'CfI45683', 'Keynote Session-10', '', '2023-09-08', '16:30:00', '17:15:00', 'offline', '', '', '', '', '', ''),
('396854796', 'CfI45683', 'Technical Session – D1D1', 'Informatics for Emerging Applications-01', '2023-09-06', '09:00:00', '10:30:00', 'online', 'meet.google.com/dfhaosdfhi', '', '192. 279, 288, 302, 387, 388', 'TYM', 'MIP', 'BRE'),
('417459866', 'CfI45683', 'Technical Session–D1B2', 'Pattern Recognition and Classification -01', '2023-09-06', '14:30:00', '16:30:00', 'online', 'https://bdren.zoom.us/j/67308192111', '673 0819 2111', '122, 169, 185, 229, 240, 257', '', '', ''),
('425177261', 'CfI45683', 'Keynote Session-7 (Online)', '', '2023-09-07', '19:15:00', '20:00:00', 'online', '', '', '', '', '', ''),
('456154841', 'CfI45683', 'Registration and Kits Collection', NULL, '2023-09-06', '08:00:00', '09:00:00', 'offline', 'Knowledge Tower Ground Floor', '', '', '', 'Registration Sub-committee', ''),
('463224018', 'CfI45683', 'Technical Session –D1A2', 'Internet of Things for Smart Applications-01', '2023-09-06', '14:30:00', '16:00:00', 'online', 'https://bdren.zoom.us/j/67308192888', '673 0819 2888', '130, 154, 212, 242, 250, 296', '', '', ''),
('498539432', 'CfI45683', 'Prayer and lunch Break', '', '2023-09-07', '13:30:00', '14:30:00', 'offline', '', '', '', '', '', ''),
('509922783', 'CfI45683', 'END of BIM 2023', '', '2023-09-08', '22:00:00', '22:00:00', '', '', '', '', '', '', ''),
('527785137', 'CfI45683', 'Keynote Session-8', '', '2023-09-08', '11:00:00', '11:45:00', 'offline', '', '', '', '', '', ''),
('530309982', 'CfI45683', 'Invited Talk 6 and Technical Session –D3B2', 'Pattern Recognition and Classification-03', '2023-09-08', '14:30:00', '16:00:00', 'offline', '', '', 'Four papers will be presented', '', '', ''),
('551500659', 'CfI45683', 'Keynote Session-9', '', '2023-09-08', '11:45:00', '12:30:00', 'offline', '', '', '', '', '', ''),
('572649520', 'CfI45683', 'Invited Talk-4 and Technical Session–D2D1', 'Informatics for Emerging Applications-02', '2023-09-07', '09:30:00', '10:30:00', 'online', '', '', '146, 220, 370, 440', '', '', ''),
('602825141', 'CfI45683', 'Refreshment and Prayer Break', '', '2023-09-07', '16:00:00', '16:30:00', '', '', '', '', '', '', ''),
('619403945', 'CfI45683', 'Keynote Session -1', '', '2023-09-06', '10:45:00', '11:30:00', 'online', 'meet.google.com/saihdf', '', '', '', '', ''),
('624202075', 'CfI45683', 'Technical Session –D2C3', 'Machine Learning for Intelligent Applications-02', '2023-09-07', '16:30:00', '17:30:00', 'offline', '', '', '283, 285, 289, 301', '', '', ''),
('630420677', 'CfI45683', 'Refreshment', '', '2023-09-08', '10:30:00', '11:00:00', '', '', '', '', '', '', ''),
('671076774', 'CfI45683', 'Technical Session-D3D1', 'Machine Learning for Disease Detection-04', '2023-09-08', '09:00:00', '10:30:00', 'offline', '', '', '244, 300, 303, 304, 375, 449', '', '', ''),
('680841902', 'CfI45683', 'Technical Session–D2B3', 'Artificial Intelligence for Imaging Applications-03', '2023-09-07', '16:30:00', '17:30:00', 'offline', '', '', '274, 278, 284, 281', '', '', ''),
('686284883', 'CfI45683', 'Keynote Session-5', '', '2023-09-07', '11:45:00', '12:30:00', 'online', '', '', '', '', '', ''),
('729346635', 'CfI45683', 'Technical Session-D3C1', 'Data Science for Smart Applications–02', '2023-09-08', '09:00:00', '10:30:00', 'offline', '', '', '443, 448, 461, 465, 466, 468', '', '', ''),
('763653406', 'CfI45683', 'Prayer and lunch Break', '', '2023-09-08', '12:30:00', '14:30:00', 'offline', '', '', '', '', '', ''),
('777494700', 'CfI45683', 'Technical Session –D1D2', 'Machine Learning for Intelligent Applications-01', '2023-09-06', '14:30:00', '16:30:00', 'online', 'meet.google.com/saihdf', '', '391, 408, 409, 410, 425, 427', '', '', ''),
('781526644', 'CfI45683', 'Technical Session –D2A3', 'Machine Learning for Disease Detection-03', '2023-09-07', '16:30:00', '17:30:00', 'offline', '', '', '213, 221, 226, 246', '', '', ''),
('781778174', 'CfI45683', 'Refreshment and Prayer Break', '', '2023-09-08', '16:00:00', '16:30:00', 'both', '', '', '', '', '', ''),
('831823226', 'CfI45683', 'Registration and Kits Collection', '', '2023-09-08', '08:00:00', '09:00:00', 'offline', 'Registration Sub-committee', '', '', '', '', ''),
('861234119', 'CfI45683', 'Keynote Session-11', '', '2023-09-08', '17:15:00', '18:00:00', 'offline', '', '', '', '', '', ''),
('884886298', 'CfI45683', 'Technical Session –D2D3', 'Data Science for Smart Applications–01', '2023-09-07', '16:30:00', '17:30:00', 'offline', '', '', '260, 263, 265, 271', '', '', ''),
('896288739', 'CfI45683', 'Technical Session –D2D2', 'Data Science and Big Data-03', '2023-09-07', '14:30:00', '16:00:00', 'offline', '', '', '180, 232, 361, 379, 392, 436', '', '', ''),
('917328826', 'CfI45683', 'Refreshment', '', '2023-09-07', '10:30:00', '11:00:00', 'offline', '', '', '', '', '', ''),
('917328999', 'CfI45683', 'Refreshment', NULL, '2023-09-06', '10:30:00', '10:40:00', '', '', '', '', '', '', ''),
('934042840', 'CfI45683', 'Conference Dinner', '', '2023-09-08', '20:00:00', '22:00:00', 'offline', 'DIU', '', '', '', '', ''),
('976926449', 'CfI45683', 'Keynote Session-4', '', '2023-09-07', '11:00:00', '11:45:00', 'online', 'https://bdren.zoom.us/j/66330964728', '663 3096 4728', '', '', '', ''),
('976939864', 'CfI45683', 'Keynote Talk-3', '', '2023-09-06', '16:45:00', '17:30:00', '', '', '', '', '', '', ''),
('978727472', 'CfI45683', 'Refreshment', '', '2023-09-06', '16:00:00', '16:15:00', 'offline', '', '', '', '', '', ''),
('990395430', 'CfI45683', 'Invited Talk 7 and Technical Session–D3C2', 'Data Science for Smart Applications–03', '2023-09-08', '14:30:00', '16:00:00', 'offline', '', '', 'Four papers will be presented', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `site_stat`
--

CREATE TABLE `site_stat` (
  `id` varchar(20) NOT NULL,
  `visitor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_stat`
--

INSERT INTO `site_stat` (`id`, `visitor`) VALUES
('9876543210', '3');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `institute` varchar(150) NOT NULL,
  `position` varchar(100) NOT NULL,
  `country` varchar(50) NOT NULL,
  `state` varchar(30) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'img_default_avatar.jpg',
  `password` varchar(50) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mail`, `phone`, `institute`, `position`, `country`, `state`, `avatar`, `password`, `login_time`) VALUES
('187580', 'Md. Mezbaul Islam Zion', 'mezbazion@gmail.com', '01750458479', 'DIU', 'Lecturer', 'Bangladesh', 'Dhaka', 'img_default_avatar.jpg', '12345678', '2023-08-27 21:15:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `participants`
--
ALTER TABLE `participants`
  ADD PRIMARY KEY (`serial`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_stat`
--
ALTER TABLE `site_stat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `participants`
--
ALTER TABLE `participants`
  MODIFY `serial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
