-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2024 at 06:43 AM
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
-- Database: `college_reg_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT curtime(),
  `role` varchar(15) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `birth_date` date NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `region` varchar(100) NOT NULL,
  `shs_name` varchar(100) NOT NULL,
  `college` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `major` varchar(100) NOT NULL,
  `submitted` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `pwd`, `created_at`, `role`, `first_name`, `middle_name`, `last_name`, `birth_date`, `gender`, `email`, `phone_number`, `street_address`, `barangay`, `city`, `province`, `region`, `shs_name`, `college`, `course`, `major`, `submitted`, `archived`) VALUES
(22, 'lemon', '$2y$12$yi1b5MWp8F33tGU/gZULwOjisjsFUjfUU03U10VYbMRRXqHgD9NE.', '2024-05-27 03:47:07', 'applicant', 'Lemon', 'lemon lemon', 'Lemonade', '2024-05-03', 'male', 'khentalba1@gmail.com', '9123123123', 'asdasd', 'BALINTAD', 'BAUNGON', 'BUKIDNON', 'REGION X', 'asdasd', 'College of Computer and Information Sciences (CCIS)', 'Bachelor of Science in Computer Science (BSCS)', 'hidden', 1, 0),
(25, 'lemon1', '$2y$12$4XZ67B0hmq4D64A0LVkaMumqB5LtoFpRNqdr9FvKMBxOV/81sgT4C', '2024-05-27 04:08:14', 'applicant', 'Khent', 'David Roscoe A.', 'Alba', '2024-05-10', 'male', 'khentalba1@gmail.com', '9123123123', 'asdasd', 'BALINTAD', 'BAUNGON', 'BUKIDNON', 'REGION X', 'asdasd', 'Open University System (OUS)', 'Bachelor of Science in Entrepreneurship (BSENTREP)', 'hidden', 1, 0),
(26, 'lemon2', '$2y$12$OzUArMHsZJ5Sv3h1hvDffuCk/GXolWIt1VdXNKeh7V/tcwbf7iwYW', '2024-05-27 04:11:20', 'applicant', 'Khent', 'David Roscoe A.', 'Alba', '2024-05-09', 'male', 'khentalba1@gmail.com', '9123123123', 'asdasd', 'BALINTAD', 'BAUNGON', 'BUKIDNON', 'REGION X', 'asdasdasd', 'Open University System (OUS)', 'Bachelor of Science in Entrepreneurship (BSENTREP)', 'hidden', 1, 0),
(28, 'admin', '$2y$12$9F5.inNoYhDp./DExrA.BOjWcdXCzJt7swEYILf5BzV8KL/hyZp5.', '2024-05-27 16:25:35', 'admin', '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', 0, 0),
(29, 'lemon3', '$2y$12$54GkXZwVfjQi7MOEYEbe2O9zuyFehegMTtfmAerxUPnxsMGSXtNEO', '2024-05-28 03:24:55', 'applicant', 'Sample', 'Sample MN', 'Sample FN', '2024-05-23', 'male', 'khentalba1@gmail.com', '9123123123', 'asdasd', 'ANLOGAN', 'CABANGLASAN', 'BUKIDNON', 'REGION X', 'asdasdasd', 'College of Accountancy and Finance (CAF)', 'Bachelor of Science in Accountancy (BSA)', 'hidden', 1, 0),
(39, 'lemon4', '$2y$12$45pitHs7mEpNfKKjR9orRuHT/nkly8UOz2NXUmhOw9wmqROUMmDBK', '2024-05-31 12:39:07', 'applicant', 'Sample FN', 'Sample MN', 'Sample LN', '2024-05-31', 'male', 'sample@example.com', '9123123123', 'sample address', 'CEBULANO', 'CARMEN', 'DAVAO (DAVAO DEL NORTE)', 'REGION XI', 'Sample SHS', 'College of Architecture, Design and the Built Environment (CADBE)', 'Bachelor of Science in Interior Design (BSID)', 'hidden', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
