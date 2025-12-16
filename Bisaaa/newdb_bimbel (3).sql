-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2025 at 10:28 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newdb_bimbel`
--

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `sub_bab` varchar(100) DEFAULT NULL,
  `pertanyaan` text DEFAULT NULL,
  `a` varchar(255) DEFAULT NULL,
  `b` varchar(255) DEFAULT NULL,
  `c` varchar(255) DEFAULT NULL,
  `d` varchar(255) DEFAULT NULL,
  `jawaban` char(1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id`, `mentor_id`, `sub_bab`, `pertanyaan`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`) VALUES
(1, 1, 'Pweb', '2 + 3 =....', 'f', '5', '3', 'sepuluh', 'B', '2025-12-16 18:48:14'),
(2, 1, 'Biologi', 'apa itu angin?', 'hewan', 'benda', 'manusia', 'ga tau ngab', 'B', '2025-12-16 19:25:28'),
(3, 1, 'Biologi', 'hewan apa yang tidur?', 's', 'l', 'f', 'sapi', 'D', '2025-12-16 19:35:40');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `jenis` enum('pdf','video') DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jadwal` varchar(100) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id`, `nama`, `jk`, `email`, `telp`, `tgl_lahir`, `jadwal`, `mapel`, `kelas`) VALUES
(1, 'Nadya Putri Anindya', 'Perempuan', 'nadya.biologi@elearning.com', '081357892134', '1994-03-18', 'Senin & Rabu, 09.00–10.30', 'Biologi', 'X IPA 1, XI IPA 2');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `kuis_id` int(11) NOT NULL,
  `nilai` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `kuis_id` int(11) NOT NULL,
  `selected_option` char(1) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `attempt_id`, `kuis_id`, `selected_option`, `is_correct`) VALUES
(1, 1, 2, 'B', 1),
(2, 1, 3, 'D', 1),
(3, 2, 2, 'B', 1),
(4, 2, 3, 'D', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sub_bab` varchar(100) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `total_correct` int(11) DEFAULT NULL,
  `total_wrong` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `sub_bab`, `score`, `total_correct`, `total_wrong`, `created_at`) VALUES
(1, 1, 'Biologi', 20, 2, 0, '2025-12-16 21:10:03'),
(2, 1, 'Biologi', 20, 2, 0, '2025-12-16 21:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `total_points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `username`, `kelas`, `email`, `password`, `total_points`, `created_at`) VALUES
(1, 'Shifa Amelia Putri', 'Perempuan', 'Shifaaa_amel', 'Kelas XII', 'shifa1234@gmail.com', '$2y$10$h.lPJPqf/WZc95NNXYF7muZ/aGWd7n4zsoRTuPmk/F/Q5/aV56h82', 0, '2025-12-16 20:29:01');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meeting`
--

CREATE TABLE `zoom_meeting` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `start_url` text DEFAULT NULL,
  `join_url` text DEFAULT NULL,
  `status` enum('live','ended') DEFAULT 'live',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indexes for table `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `kuis_id` (`kuis_id`);

--
-- Indexes for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `zoom_meeting`
--
ALTER TABLE `zoom_meeting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `zoom_meeting`
--
ALTER TABLE `zoom_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `materi`
--
ALTER TABLE `materi`
  ADD CONSTRAINT `materi_ibfk_1` FOREIGN KEY (`mentor_id`) REFERENCES `mentor` (`id`);

--
-- Constraints for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `quiz_answers_ibfk_1` FOREIGN KEY (`attempt_id`) REFERENCES `quiz_attempts` (`id`),
  ADD CONSTRAINT `quiz_answers_ibfk_2` FOREIGN KEY (`kuis_id`) REFERENCES `kuis` (`id`);

--
-- Constraints for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
