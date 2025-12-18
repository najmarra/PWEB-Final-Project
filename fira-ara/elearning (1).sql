-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 18, 2025 at 06:59 PM
-- Server version: 8.0.40
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elearning`
--

-- --------------------------------------------------------

--
-- Table structure for table `kuis`
--

CREATE TABLE `kuis` (
  `id` int NOT NULL,
  `mentor_id` int DEFAULT NULL,
  `sub_bab` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pertanyaan` text COLLATE utf8mb4_general_ci,
  `a` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `b` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `c` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `d` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jawaban` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kuis`
--

INSERT INTO `kuis` (`id`, `mentor_id`, `sub_bab`, `pertanyaan`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`) VALUES
(4, 1, 'Matematika', '1+1', '2', '3', '4', '5', 'A', '2025-12-18 06:45:42'),
(5, 1, 'Matematika', '5+7', '10', '11', '12', '13', 'C', '2025-12-18 06:46:10'),
(6, 1, 'Matematika', '2+3', '4', '5', '6', '7', 'B', '2025-12-18 06:46:40'),
(7, 1, 'biologi', 'hewan berkaki 2', 'kucing', 'gajah', 'ikan', 'ayam', 'D', '2025-12-18 07:22:56'),
(8, 1, 'biologi', 'hewan tidak berkaki', 'kucing', 'gajah', 'ikan', 'ayam', 'C', '2025-12-18 07:23:18'),
(10, 1, 'bahasa indonesia', 'orang berjalan pakai', 'kaki', 'tangan', 'terbang', 'berenang', 'A', '2025-12-18 13:42:43'),
(11, 1, 'Matematika', '6+1', '5', '6', '7', '8', 'C', '2025-12-18 17:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `materi`
--

CREATE TABLE `materi` (
  `id` int NOT NULL,
  `mentor_id` int DEFAULT NULL,
  `judul` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jenis` enum('pdf','video') COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materi`
--

INSERT INTO `materi` (`id`, `mentor_id`, `judul`, `deskripsi`, `jenis`, `file`, `created_at`) VALUES
(2, 2, 'pweb', 'final project', 'pdf', 'uploads/1766035751_Studi_Kasus.pdf', '2025-12-18 05:29:11'),
(3, 2, 'jarkom', 'final praktikum', 'video', 'https://drive.google.com/file/d/1kN0HR8oAjwKgxgyiL9F23r23OHJXlZZu/view?usp=drive_link', '2025-12-18 05:32:55'),
(4, 2, 'alin', 'final quiz', 'pdf', 'uploads/1766036617_Studi_Kasus.pdf', '2025-12-18 05:43:37'),
(5, 2, 'biologi', 'kelas 10', 'pdf', 'uploads/1766065318_Latihan_Soal_EAS_KKA_2023_copy.pdf', '2025-12-18 13:41:58');

-- --------------------------------------------------------

--
-- Table structure for table `mentor`
--

CREATE TABLE `mentor` (
  `id` int NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `jk` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `telp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jadwal` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `mapel` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mentor`
--

INSERT INTO `mentor` (`id`, `nama`, `jk`, `email`, `password`, `telp`, `tgl_lahir`, `jadwal`, `mapel`, `kelas`) VALUES
(1, 'Andi Pratama', 'L', 'andi@mentor.com', '12345', '081234567890', '1995-03-12', 'Senin & Rabu', 'Matematika', 'X IPA 1'),
(2, 'Siti Aisyah', 'Perempuan', 'siti@mentor.com', '123456', '082345678901', '1996-07-25', 'Selasa & Jumat', 'Bahasa Indonesia', 'XI IPS'),
(3, 'Najma Lail Arazy', 'Perempuan', 'najmaarra00@gmail.com', 'najmalail', '085713841855', '2025-12-18', 'Jumat', 'Kimia', 'XII IPA');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int NOT NULL,
  `attempt_id` int NOT NULL,
  `kuis_id` int NOT NULL,
  `selected_option` char(1) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `attempt_id`, `kuis_id`, `selected_option`, `is_correct`) VALUES
(5, 3, 4, 'A', 1),
(6, 3, 5, 'C', 1),
(7, 3, 6, 'B', 1),
(8, 4, 7, 'D', 1),
(9, 4, 8, 'C', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quiz_attempts`
--

CREATE TABLE `quiz_attempts` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `sub_bab` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `score` int DEFAULT NULL,
  `total_correct` int DEFAULT NULL,
  `total_wrong` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `sub_bab`, `score`, `total_correct`, `total_wrong`, `created_at`) VALUES
(3, 3, 'Matematika', 30, 3, 0, '2025-12-18 06:49:18'),
(4, 3, 'biologi', 20, 2, 0, '2025-12-18 07:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `kelas` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_points` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `username`, `kelas`, `email`, `password`, `total_points`, `created_at`) VALUES
(3, 'Dewi Lestari', 'Perempuan', 'Dewi', 'XI IPS', 'dewi@siswa.com', 'dewi123', 0, '2025-12-18 06:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `zoom_meetings`
--

CREATE TABLE `zoom_meetings` (
  `id` int NOT NULL,
  `mentor_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `zoom_meeting_id` varchar(50) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `duration` int DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `start_url` text,
  `join_url` text,
  `status` enum('scheduled','started','ended') DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zoom_meetings`
--

INSERT INTO `zoom_meetings` (`id`, `mentor_id`, `title`, `zoom_meeting_id`, `start_time`, `duration`, `timezone`, `start_url`, `join_url`, `status`, `created_at`) VALUES
(9, 2, 'Siti Aisyah (Bahasa Indonesia) - 19 Dec 2025 00:55', '87140705137', NULL, NULL, NULL, 'https://us05web.zoom.us/s/87140705137?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NzE0MDcwNTEzNyIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjBkN2RjYzJhZThiMTRhOTM5YTRmMzQzODcxOTUzZTBkIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MDg3NzMzLCJpYXQiOjE3NjYwODA1MzMsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.ofTpRqeI-rFd3No8FNlfGuMRxI-uiyp8IYqP4EHb4TY', 'https://us05web.zoom.us/j/87140705137?pwd=WVYMHVRVW0WCm7D2OaJJu8qxUOLGj6.1', 'started', '2025-12-18 17:55:32'),
(10, 2, 'biologi', '84603680118', '2025-12-31 15:00:00', 60, 'Asia/Jakarta', 'https://us05web.zoom.us/s/84603680118?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NDYwMzY4MDExOCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjFkZWVjNWI5ZWI3MDQ1MGQ4MjgwODBhNDI4ZDdmYWU4Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MDg3ODI1LCJpYXQiOjE3NjYwODA2MjUsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.wZVU3saLYUH3_SgRr1eO4BH1nL11yE8iz66E_1Us3P4', 'https://us05web.zoom.us/j/84603680118?pwd=Ejmu2aOblb787ObfMm2b2iZbJMNmDQ.1', 'scheduled', '2025-12-18 17:57:04');

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `zoom_meetings`
--
ALTER TABLE `zoom_meetings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
