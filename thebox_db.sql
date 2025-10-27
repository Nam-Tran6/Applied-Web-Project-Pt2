-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 01:08 PM
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
-- Database: `thebox_db`
--
CREATE DATABASE IF NOT EXISTS `thebox_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `thebox_db`;

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
(6, 'D4E5F', 'Nam', 'Tran', '2004-03-09', 'Male', '01 Swinburne Street', 'St Albans', 'VIC', '3012', '104555355@student.swin.edu.au', '0400000000', 'Programming', '', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `funfacts`
--

CREATE TABLE `funfacts` (
  `id` int(11) NOT NULL,
  `member` varchar(50) NOT NULL,
  `dream_job` varchar(30) DEFAULT NULL,
  `coding_snacks` varchar(20) DEFAULT NULL,
  `hometown` varchar(15) DEFAULT NULL,
  `sport` varchar(20) DEFAULT NULL,
  `movie` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `funfacts`
--

INSERT INTO `funfacts` (`id`, `member`, `dream_job`, `coding_snacks`, `hometown`, `sport`, `movie`) VALUES
(1, 'Kha Nam Tran', 'Teacher', 'Lollies', 'St Albans', 'Nerds don\'t do sport', 'The Martian'),
(2, 'Sothearith Kuy', 'Developer', 'Chip', 'Siem Reap', 'Soccer', 'John Wick'),
(3, 'Sokna David Heang', 'Software Engineer', 'Chocolate', 'Phnom Penh', 'Basketball', 'Spiderman');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `ref` varchar(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `reporting_line` varchar(255) DEFAULT NULL,
  `key_responsibilities` text DEFAULT NULL,
  `essential_requirements` text DEFAULT NULL,
  `preferable` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `ref`, `title`, `short_description`, `salary`, `reporting_line`, `key_responsibilities`, `essential_requirements`, `preferable`, `created_at`) VALUES
(1, 'A1B2C', 'Senior Product Designer', 'Lead product experiences across core flows — from discovery to design handoff. Balance craft with pragmatic delivery.', 'AUD 120,000 - 150,000 + Employee Equity', 'Reports to Head of Product', '1. Drive end-to-end design for one product vertical (user research → prototype → handoff).\n2. Create and maintain reusable components and patterns in our design system.\n3. Partner with PMs and engineers to define metrics and measure impact of UX changes.\n4. Mentor junior designers through critiques and usability sessions.', '• 5+ years in product design with shipped SaaS products.\n• Strong prototyping skills (Figma interactive prototypes) and practical research experience.\n• Experience contributing to or maintaining a design system.\n• Excellent cross-functional communication and a portfolio demonstrating outcomes (not just screens).', '• Familiarity with HTML/CSS or React component thinking.\n• Experience in developer tooling, analytics, or B2B workflow products.', '2025-10-20 22:12:54'),
(2, 'D4E5F', 'Frontend Engineer, Design Systems', 'Build and maintain the design system and component library used by product teams; reduce design-to-code friction.', 'AUD 140,000 - 170,000 + Employee Equity', 'Reports to Engineering Manager (Platform)', '1. Implement accessible, testable UI components as a shared library (React + TypeScript).\n2. Integrate design tokens and automate releases for designers and product teams.\n3. Collaborate with designers to translate patterns into code and improve documentation/examples.\n4. Maintain CI, visual regression tests, and versioning for the component library.', '• 4+ years building production React component libraries in TypeScript.\n• Experience with Storybook, unit testing, and CSS-in-JS or utility-first approaches.\n• Clear communicator who can partner with designers to iterate on accessibility and behavior.', '• Experience exporting design tokens from Figma or similar tools.\n• Worked at early-stage startups or on infra teams focused on developer UX.', '2025-10-20 22:12:54');

-- --------------------------------------------------------

--
-- Table structure for table `member_contri`
--

CREATE TABLE `member_contri` (
  `name` varchar(50) NOT NULL,
  `contribution` varchar(200) NOT NULL,
  `quote` varchar(50) NOT NULL,
  `fav_lag` varchar(20) NOT NULL,
  `translation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_contri`
--

INSERT INTO `member_contri` (`name`, `contribution`, `quote`, `fav_lag`, `translation`) VALUES
('Kha Nam Tran - Front End Lead', 'Coded index.php, style.css + SQL databases funfacts, member_contri (Part 1,2,7)', '\"Viciously Coding\"', 'French', 'Codage vicieux'),
('Sothearith Kuy— Front-end Engineer', 'Coded job.php, login.php, manage.php + SQL databases jobs, users (Part 5,6)', '\"Code Breaker\"', 'Spanish', 'descifrador de códigos'),
('Sokna David Heang — Front-end Engineer', 'Coded about.php, apply.php, process.php + SQL databases eoi', '\"Eat, Sleep, Code, Repeat\"', 'German', 'Essen, Schlafen, Code, Wiederholen'),
('Rakibul Hasan — N/A', 'N/A', 'N/A', 'N/A', 'N/A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Manager', '$2y$10$n.hlo3kytoYsRf6ID8vVWO.lbKBxOa31y50Db6LbBMyoTIFpKsfhm'),
(2, 'Admin', '$2y$10$n.hlo3kytoYsRf6ID8vVWO.lbKBxOa31y50Db6LbBMyoTIFpKsfhm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOInumber`);

--
-- Indexes for table `funfacts`
--
ALTER TABLE `funfacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref` (`ref`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOInumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `funfacts`
--
ALTER TABLE `funfacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
