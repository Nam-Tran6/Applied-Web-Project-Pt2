-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2025 at 04:02 AM
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
-- Database: `expression_of_interest`
--

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOInumber` int(11) NOT NULL,
  `job_ref_num` varchar(5) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `address` varchar(100) NOT NULL,
  `suburb` varchar(50) NOT NULL,
  `state` enum('VIC','NSW','QLD','NT','WA','SA','TAS','ACT') NOT NULL,
  `postcode` varchar(4) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `skills` text NOT NULL,
  `others` text DEFAULT NULL,
  `status` enum('New','Current','Final','') NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eoi`
--

INSERT INTO `eoi` (`EOInumber`, `job_ref_num`, `first_name`, `last_name`, `dob`, `gender`, `address`, `suburb`, `state`, `postcode`, `email`, `phone_number`, `skills`, `others`, `status`) VALUES
(1, 'FN123', 'Doe', 'John', '2005-12-30', 'Male', 'STREET A HOUSE 152', 'Phnom Penh', 'NSW', '1208', 'johndoe005@gmail.com', '31414144', 'Programming, Web Development', '', 'New'),
(2, 'FN123', 'Doe', 'John', '2005-12-30', 'Male', 'STREET A HOUSE 152', 'Phnom Penh', 'NSW', '1208', 'johndoe005@gmail.com', '31414144', 'Programming, Web Development', '', 'New'),
(3, 'Ah123', 'Mariah', 'Carey', '2005-12-30', 'Female', 'STREET A HOUSE 152', 'Phnom Penh', 'VIC', '1208', 'mariah005@gmail.com', '131313133', 'Programming, Web Development, Data Analysis, Project Management', '', 'New'),
(4, '12222', 'John', 'DOe', '2020-12-20', 'Female', 'STREET A HOUSE 152', 'Phnom Penh', 'QLD', '1208', 'soknadavid005@gmail.com', '121212122', 'Programming, Web Development, Data Analysis', '', 'New'),
(5, 'Ah123', 'Taylor', 'Swift', '2015-12-20', 'Male', 'STREET A HOUSE 152', 'Phnom Penh', 'VIC', '1208', 'manager@gmail.com', '31414144', 'Programming, Web Development, Data Analysis, Project Management, Cybersecurity, AI and Machine Learning', 'dadbabdjakbsdjkabdba', 'New'),
(6, 'Ah123', 'Taylor', 'Swift', '2015-12-20', 'Male', 'STREET A HOUSE 152', 'Phnom Penh', 'VIC', '1208', 'manager@gmail.com', '121213111', 'Programming, Web Development, Data Analysis, Project Management, Cybersecurity, AI and Machine Learning', 'dadbabdjakbsdjkabdba', 'New'),
(7, 'Ah123', 'Taylor', 'Swift', '2015-12-20', 'Male', 'STREET A HOUSE 152', 'Phnom Penh', 'VIC', '1208', 'manager@gmail.com', '12121111', 'Programming, Web Development, Data Analysis, Project Management, Cybersecurity, Cloud Computing, AI and Machine Learning, Other', 'dadbabdjakbsdjkabdba', 'New'),
(8, '12222', 'Taylor', 'Swift', '2020-12-20', 'Female', 'STREET A HOUSE 152', 'Phnom Penh', 'NSW', '1208', 'Soknadavid005@gmail.com', '12121245', 'Programming, Data Analysis', '', 'New'),
(9, '122oo', 'Taylor', 'Swift', '2005-12-30', 'Female', 'STREET A HOUSE 152', 'Phnom Penh', 'NSW', '1208', 'soknadavid005@gmail.com', '31414144', 'Programming, Web Development', '', 'New');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
