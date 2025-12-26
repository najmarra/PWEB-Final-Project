-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql110.infinityfree.com
-- Waktu pembuatan: 26 Des 2025 pada 08.03
-- Versi server: 11.4.7-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_40695714_bimbel_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(3, 'Zahran_', '$2y$10$gp3EyCw7OaLHfp6ggRkSMuZDoghhzvlSCrcKWGJ.TWDtVpQpUEBqm');

-- --------------------------------------------------------

--
-- Struktur dari tabel `classes`
--

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `mentor_id` int(11) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `time` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `classes`
--

INSERT INTO `classes` (`id`, `subject_id`, `mentor_id`, `description`, `start_date`, `end_date`, `time`) VALUES
(2, 7, 3, 'Atom', '2025-12-30', '2025-12-31', '20:00'),
(4, 6, 5, 'Pertumbuhan & perkembangan', '2025-12-04', '2025-12-05', '20:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kuis`
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
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `kuis`
--

INSERT INTO `kuis` (`id`, `mentor_id`, `sub_bab`, `pertanyaan`, `a`, `b`, `c`, `d`, `jawaban`, `created_at`) VALUES
(1, 1, 'Pweb', '2 + 3 =....', 'f', '5', '3', 'sepuluh', 'B', '2025-12-17 02:48:14'),
(2, 1, 'Biologi', 'apa itu angin?', 'hewan', 'benda', 'manusia', 'ga tau ngab', 'B', '2025-12-17 03:25:28'),
(3, 1, 'Biologi', 'hewan apa yang tidur?', 's', 'l', 'f', 'sapi', 'D', '2025-12-17 03:35:40'),
(7, 1, 'Matematika', '1+1', '1', '2', '3', '4', 'B', '2025-12-20 23:54:10'),
(8, 1, 'Matematika', '1+2', '1', '2', '3', '4', 'C', '2025-12-20 23:54:32');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login_logs_siswa`
--

CREATE TABLE `login_logs_siswa` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `login_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `login_logs_siswa`
--

INSERT INTO `login_logs_siswa` (`id`, `siswa_id`, `email`, `ip_address`, `user_agent`, `login_time`) VALUES
(1, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '0000-00-00 00:00:00'),
(2, 13, 'Ijat01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '0000-00-00 00:00:00'),
(3, 11, 'Zunaira01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '0000-00-00 00:00:00'),
(4, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '0000-00-00 00:00:00'),
(5, 6, 'Zean@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 05:53:01'),
(6, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 06:37:13'),
(7, 11, 'Zunaira01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 06:42:55'),
(8, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 06:52:44'),
(9, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 07:02:58'),
(10, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 07:06:26'),
(11, 11, 'Zunaira01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 07:08:18'),
(12, 2, 'sagara01@gmail.com', '114.10.134.251', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-18 07:28:02'),
(13, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 06:46:13'),
(14, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 07:10:28'),
(15, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 07:28:16'),
(16, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 08:04:35'),
(17, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 08:12:55'),
(18, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 09:34:17'),
(19, 11, 'Zunaira01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 09:34:38'),
(20, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 09:36:46'),
(21, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 09:38:56'),
(22, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 09:50:50'),
(23, 14, 'dewi@siswa.com', '157.10.8.176', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 16:06:07'),
(24, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 17:31:50'),
(25, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-20 18:01:11'),
(26, 6, 'Zean@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 07:00:14'),
(27, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 07:00:27'),
(28, 11, 'Zunaira01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 07:00:42'),
(29, 12, 'Gilang01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 07:01:09'),
(30, 5, 'Septi@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 07:01:47'),
(31, 16, 'Safamashita12345@gmail.com', '182.6.80.101', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-25 09:35:12'),
(32, 2, 'sagara01@gmail.com', '140.213.217.37', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', '2025-12-26 03:45:29');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) DEFAULT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `jenis` enum('pdf','video') DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id`, `mentor_id`, `judul`, `deskripsi`, `jenis`, `file`, `created_at`) VALUES
(2, 1, 'Jarkom', '', 'video', 'https://drive.google.com/file/d/1lV-nVVbEhvlVwCUfh41l-KXo9v9yekuG/view?usp=sharing', '2025-12-17 06:02:49'),
(4, 1, 'Jarkom', 'ini jarkom yaa', 'video', 'https://drive.google.com/file/d/1lV-nVVbEhvlVwCUfh41l-KXo9v9yekuG/view?usp=drive_link', '2025-12-17 12:26:44'),
(6, 5, 'Nilai Eigen', 'final quiz', 'pdf', 'uploads/materi/pdf/1766041635_Studi_Kasus.pdf', '2025-12-18 07:07:15'),
(14, 6, 'SPL', 'Sistem Persamaan Linier', 'pdf', 'uploads/materi/pdf/1766274649_Final_Project_Tahajud_Tiap_Hari.pdf', '2025-12-20 23:50:49'),
(16, 6, 'Faktorisasi', 'Pembahasan', 'video', 'https://drive.google.com/file/d/1kN0HR8oAjwKgxgyiL9F23r23OHJXlZZu/view?usp=drivesdk', '2025-12-20 23:53:06'),
(17, 3, 'Latsol EAS KKA', 'BFS', 'pdf', 'uploads/materi/pdf/1766282221_1766065318_Latihan_Soal_EAS_KKA_2023_copy.pdf', '2025-12-21 01:57:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mentor`
--

CREATE TABLE `mentor` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jk` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `telp` varchar(20) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jadwal` varchar(100) DEFAULT NULL,
  `mapel` varchar(100) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `mentor`
--

INSERT INTO `mentor` (`id`, `nama`, `jk`, `email`, `password`, `telp`, `tgl_lahir`, `jadwal`, `mapel`, `kelas`) VALUES
(1, 'Nadya Putri Anindya', 'Perempuan', 'nadya.biologi@elearning.com', '', '081357892134', '1994-03-18', 'Senin & Rabu, 09.00–10.30', 'Biologi', 'X IPA 1, XI IPA 2'),
(3, 'Aidan', 'Laki-laki', 'Aidan01@gmail.com', '$2y$10$n/h6QGEKphVSvEqmVq/C5eGxrPv5gVpyIJLekwK3/7IQxUAgTUjyS', '081987654352', '2025-12-24', 'Senin', 'IPA', 'Kelas XII'),
(4, 'Himawan Rakha abdi', 'Laki-laki', 'Himawanrakha88@gmail.com', '$2y$10$IzWBhF3dlH7nh6fxCZWV1u6qvfBWgKwz0P81NfJ6jLw21wy.LVbaC', '0856773412', '2025-12-17', 'Senin-Kamis', 'Matematika', 'Kelas X'),
(5, 'Najma Lail Arazy', 'Perempuan', 'najmaarra00@gmail.com', '$2y$10$RS2NdROlmdWyEbN1p3wnwOgDziZYESrSz/48DV.dSTKf/Phxg2/1.', '085713841855', '2025-12-18', 'Jumat 10.00 - 11.00', 'Biologi', '10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nilai`
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
-- Struktur dari tabel `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `attempt_id` int(11) NOT NULL,
  `kuis_id` int(11) NOT NULL,
  `selected_option` char(1) DEFAULT NULL,
  `is_correct` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `attempt_id`, `kuis_id`, `selected_option`, `is_correct`) VALUES
(1, 1, 2, 'B', 1),
(2, 1, 3, 'D', 1),
(3, 2, 2, 'B', 1),
(4, 2, 3, 'D', 1),
(5, 1, 2, 'D', 0),
(6, 1, 3, 'D', 1),
(7, 2, 1, 'B', 1),
(8, 3, 7, 'B', 1),
(9, 3, 8, 'C', 1),
(10, 4, 2, 'A', 0),
(11, 4, 3, 'D', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `quiz_attempts`
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
-- Dumping data untuk tabel `quiz_attempts`
--

INSERT INTO `quiz_attempts` (`id`, `user_id`, `sub_bab`, `score`, `total_correct`, `total_wrong`, `created_at`) VALUES
(1, 2, 'Biologi', 10, 1, 1, '2025-12-20 16:11:46'),
(2, 2, 'Pweb', 10, 1, 0, '2025-12-20 17:51:08'),
(4, 16, 'Biologi', 10, 1, 1, '2025-12-25 17:36:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(1, 'Matematika'),
(2, 'Fisika'),
(3, 'Bahasa Indonesia'),
(4, 'Bahasa Inggris'),
(5, 'Informatika'),
(6, 'Biologi'),
(7, 'Kimia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `kelas` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `total_points` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `username`, `kelas`, `email`, `password`, `total_points`, `created_at`) VALUES
(1, 'Zahira', 'Perempuan', 'Zahira_', 'Kelas X', 'zahira01@gmail.com', '$2y$10$urEJ4SWB/vGCSMC2XTxc2O/aXz7OItC3VtB4hWSKKWQOeEWX5vJ4O', 0, '2025-12-16 14:55:46'),
(2, 'Sagara', 'Laki-laki', 'Sagara01', 'Kelas XI', 'sagara01@gmail.com', '$2y$10$6.0QPS5dfLe4E4yg4loFQe60BGKXQIls3aJUyAAQjAnHv5wwDXfI2', 0, '2025-12-16 14:58:56'),
(3, 'Ayu', 'Perempuan', 'Ayu01', 'Kelas X', 'Ayu@gmail.com', '$2y$10$QPerjFz1C9QaF6/LiTmxnewbzZq42XzXDqs2adur8zzb.FQ3gUrSS', 0, '2025-12-16 15:22:38'),
(4, 'Shafira Nauraishma Zahida', 'Perempuan', 'Shafira99', 'Kelas XII', 'shafiranz240905@gmail.com', '$2y$10$j/RcahlGKGjIV1DbNvp95eSb/DpkV0yEVqHDrOVtJrTLgU20s5t5y', 0, '2025-12-16 15:26:26'),
(5, 'Hidayah Nur Septiani', 'Perempuan', 'Septi', 'Kelas XII', 'Septi@gmail.com', '$2y$10$dLFQsedYa6kwHV.pxejNQOFAxYnGqQZY1OWiLYe2rhIKlwlU0SXWS', 0, '2025-12-16 18:46:25'),
(6, 'Zean', 'Laki-laki', 'Zean_', 'Kelas X', 'Zean@gmail.com', '$2y$10$gTEGYbVeVjKlwCDgY/JbX.dYDRDROihBrRM4rQpahMlcbyxKoJtvO', 0, '2025-12-17 06:41:57'),
(7, 'Rifat Qurrata\'aini', 'Perempuan', 'Rifatqurrata_00', 'Kelas XIi', 'Rifatqurata123@gmail.com', '$2y$10$bXoPKxQbbQQ4.uJV1Qx98ec0fWX/8AWtlpD/cSjoLP6v1He161HMa', 0, '2025-12-17 16:22:12'),
(8, 'Shifa Amelia Putri', 'Perempuan', 'Shifaa99', 'Kelas XII', 'shifaameliaputri123@gmail.com', '$2y$10$1Ygx.96ymreE05j2/FwoIuH3GyZxRRVzdlCbTmxjndGkDLmMHzWIe', 0, '2025-12-17 16:32:02'),
(9, 'Safa Mashita', 'Perempuan', 'Safamashita_45', 'Kelas XII', 'Safamashita2345@gmail.com', '$2y$10$vxUJs4g8XgEtTidPTcCKmuOShyTYB2layo/EQvZsx9toAgff1nS46', 0, '2025-12-17 17:09:35'),
(10, 'siska', 'Perempuan', 'siska', '10', 'najma.lail44@sma.belajar.id', '$2y$10$1XbZd1K7g2ccXDbdqivzlOiWRvUEjd8ZSsxQ.uJcUu7POXhU84gA2', 0, '2025-12-18 04:02:01'),
(11, 'Zunaira', 'Perempuan', 'Zunaira01', 'Kelas X', 'Zunaira01@gmail.com', '$2y$10$AWhqHaWtG5mvtHleL4W4VOoVQlYtEK2d63bx6..pSjAQQj5MX7j.K', 0, '2025-12-18 07:27:24'),
(12, 'Gilang', 'Laki-laki', 'Gilang01', 'Kelas XI', 'Gilang01@gmail.com', '$2y$10$.Y4ewx3BtFHfHFHSsUp.BORdrTum.NWEV7KhlfowZ5lgB9tUh72Ba', 0, '2025-12-18 07:30:56'),
(16, 'Safa Mashita', 'Perempuan', 'Safamashita_45', 'Kelas XII', 'Safamashita12345@gmail.com', '$2y$10$N5sW/ZjQsb4VihzISG7cj.M25029GbfflBrqV.7AwKUBVVrYxKjym', 0, '2025-12-25 17:35:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_classes`
--

CREATE TABLE `user_classes` (
  `user_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `user_classes`
--

INSERT INTO `user_classes` (`user_id`, `class_id`) VALUES
(2, 2),
(16, 2),
(16, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `zoom_meeting`
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
-- Dumping data untuk tabel `zoom_meeting`
--

INSERT INTO `zoom_meeting` (`id`, `mentor_id`, `title`, `start_url`, `join_url`, `status`, `created_at`) VALUES
(1, 1, 'Live Class Mentor', 'https://us05web.zoom.us/s/87442509190?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NzQ0MjUwOTE5MCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjlkZTFiMDZiNWUwMDQ4MWJiOGM3NTJlNDI2NWJkOTc4Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY1OTU0NDExLCJpYXQiOjE3NjU5NDcyMTEsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.kSacK0vO4o8IZ2iTBrr41FvTCmDEQUdgLg45JO2mNOI', 'https://us05web.zoom.us/j/87442509190?pwd=i6ClBOEs5xiOcqXOxDFYx9qdWUbbw2.1', 'live', '2025-12-17 12:53:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `zoom_meetings`
--

CREATE TABLE `zoom_meetings` (
  `id` int(11) NOT NULL,
  `mentor_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `zoom_meeting_id` varchar(50) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `start_url` text DEFAULT NULL,
  `join_url` text DEFAULT NULL,
  `status` enum('scheduled','started','ended') DEFAULT 'scheduled',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `zoom_meetings`
--

INSERT INTO `zoom_meetings` (`id`, `mentor_id`, `title`, `zoom_meeting_id`, `start_time`, `duration`, `timezone`, `start_url`, `join_url`, `status`, `created_at`) VALUES
(9, 2, 'Siti Aisyah (Bahasa Indonesia) - 19 Dec 2025 00:55', '87140705137', NULL, NULL, NULL, 'https://us05web.zoom.us/s/87140705137?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NzE0MDcwNTEzNyIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjBkN2RjYzJhZThiMTRhOTM5YTRmMzQzODcxOTUzZTBkIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MDg3NzMzLCJpYXQiOjE3NjYwODA1MzMsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.ofTpRqeI-rFd3No8FNlfGuMRxI-uiyp8IYqP4EHb4TY', 'https://us05web.zoom.us/j/87140705137?pwd=WVYMHVRVW0WCm7D2OaJJu8qxUOLGj6.1', 'started', '2025-12-19 01:55:32'),
(10, 2, 'biologi', '84603680118', '2025-12-31 15:00:00', 60, 'Asia/Jakarta', 'https://us05web.zoom.us/s/84603680118?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NDYwMzY4MDExOCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjFkZWVjNWI5ZWI3MDQ1MGQ4MjgwODBhNDI4ZDdmYWU4Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MDg3ODI1LCJpYXQiOjE3NjYwODA2MjUsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.wZVU3saLYUH3_SgRr1eO4BH1nL11yE8iz66E_1Us3P4', 'https://us05web.zoom.us/j/84603680118?pwd=Ejmu2aOblb787ObfMm2b2iZbJMNmDQ.1', 'scheduled', '2025-12-19 01:57:04'),
(0, 6, 'siti aminah (Matematika) - 21 Dec 2025 06:55', '89914680924', NULL, NULL, NULL, 'https://us05web.zoom.us/s/89914680924?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4OTkxNDY4MDkyNCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjFhNDY4ZmQ2NTUwMDRlMjVhZDY3YzQ1ZjZlYWU5NWNlIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MjgyMTM3LCJpYXQiOjE3NjYyNzQ5MzcsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.VTf_ZYRAQDdyZogXO-0xtktT61EZx4OOcBSTJL0VrqU', 'https://us05web.zoom.us/j/89914680924?pwd=A5cB6PvMC3eK6tBOj3C5aP2vbHaujI.1', 'started', '2025-12-20 23:55:37'),
(0, 6, 'Matematika', '89892970490', '2025-12-25 07:00:00', 60, 'Asia/Jakarta', 'https://us05web.zoom.us/s/89892970490?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4OTg5Mjk3MDQ5MCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6IjNjNzQ3YjM0NDJhNzQ2OGY4ODZjYzE3ZGRhODQ4Y2Q1Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MjgyMTg3LCJpYXQiOjE3NjYyNzQ5ODcsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.d78qyLKtK_6GSCzY6Vspo1853bFY4M-ktvyQLUcWt_w', 'https://us05web.zoom.us/j/89892970490?pwd=w5wseEsiu08k99Lo8AdoXq7dHruZkV.1', 'scheduled', '2025-12-20 23:56:27'),
(0, 3, 'Aidan (IPA) - 21 Dec 2025 08:32', '84902985085', NULL, NULL, NULL, 'https://us05web.zoom.us/s/84902985085?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NDkwMjk4NTA4NSIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6ImFhNmRhMjc4YWVkYTQxZDU5OTZjZWMxM2Y0ZWViMjZiIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2Mjg3OTQ5LCJpYXQiOjE3NjYyODA3NDksImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.fnQGKBqdwX7vj-0t4FRNqre0x6hAloGB3Yd2hFGTME4', 'https://us05web.zoom.us/j/84902985085?pwd=hyAQh2Z1vAqJpkVbI4HvagdB2bHJHS.1', 'started', '2025-12-21 01:32:29'),
(0, 3, 'Aidan (IPA) - 21 Dec 2025 08:32', '88280419955', NULL, NULL, NULL, 'https://us05web.zoom.us/s/88280419955?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4ODI4MDQxOTk1NSIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6ImNhZDQzMWRjNjBhMDQ4MGRiMjE4OTE4Y2Y0NmRkNmFiIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2Mjg3OTUwLCJpYXQiOjE3NjYyODA3NTAsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.YyA0VvhwaLWmPkgkTQ3PjINg_fwZGAqkTcCpiTMg7ps', 'https://us05web.zoom.us/j/88280419955?pwd=1fYVOa7nN8wRyjClKPDaBmMGAWCmiI.1', 'started', '2025-12-21 01:32:30'),
(0, 3, 'pweb', '82194824619', '2025-12-04 09:16:00', 60, 'Asia/Jakarta', 'https://us05web.zoom.us/s/82194824619?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4MjE5NDgyNDYxOSIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6ImQyMTEzOTBmMTI1ZjRjZDJiNzNjYjA3MDU1ZTM0ODAxIiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MjkwNTgyLCJpYXQiOjE3NjYyODMzODIsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.nYmxJjm3suR1ImJv4zG_qotnRu-PF471Q3pfmWTkWow', 'https://us05web.zoom.us/j/82194824619?pwd=GPzu1uGNadaSaElG93pJATBkyK5IFb.1', 'scheduled', '2025-12-21 02:16:22'),
(0, 3, 'Aidan (IPA) - 21 Dec 2025 09:16', '89143542685', NULL, NULL, NULL, 'https://us05web.zoom.us/s/89143542685?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4OTE0MzU0MjY4NSIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6Ijc1MDViNGEwNzE2MjQ4M2RhZDY3MGViMDA4MGQzYTc0Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2MjkwNTg4LCJpYXQiOjE3NjYyODMzODgsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.N-qzwvpDy9rE7MsZDfrfKM9iJDHqFNdQ9YBRqSWl3Fw', 'https://us05web.zoom.us/j/89143542685?pwd=dvGmDzilwu2ar1i6ouaartBfk7vNcT.1', 'started', '2025-12-21 02:16:28'),
(0, 6, 'siti aminah (Matematika) - 23 Dec 2025 21:25', '84528922540', NULL, NULL, NULL, 'https://us05web.zoom.us/s/84528922540?zak=eyJ0eXAiOiJKV1QiLCJzdiI6IjAwMDAwMiIsInptX3NrbSI6InptX28ybSIsImFsZyI6IkhTMjU2In0.eyJpc3MiOiJ3ZWIiLCJjbHQiOjAsIm1udW0iOiI4NDUyODkyMjU0MCIsImF1ZCI6ImNsaWVudHNtIiwidWlkIjoiQWRzY3pvRTVSZWlZeVd0VXhuZk1sUSIsInppZCI6ImNhOGY1YjY2ZDJjNTRhNjliYTQzOTQ5NmI1MDkzYjM5Iiwic2siOiIwIiwic3R5IjoxLCJ3Y2QiOiJ1czA1IiwiZXhwIjoxNzY2NTA3MTI4LCJpYXQiOjE3NjY0OTk5MjgsImFpZCI6Im80ZjFLZWF1UVctdmE4aHNiblE5dUEiLCJjaWQiOiIifQ.pPisTsPQ0MBqkXzsWgdjWhqkx_usinWoHxTEo1dpB1w', 'https://us05web.zoom.us/j/84528922540?pwd=xEqqmLgZbjLCr5z9axnn619nWrGf2N.1', 'started', '2025-12-23 14:25:28');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `idx_mentor_id` (`mentor_id`);

--
-- Indeks untuk tabel `kuis`
--
ALTER TABLE `kuis`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `login_logs_siswa`
--
ALTER TABLE `login_logs_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_login_siswa` (`siswa_id`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mentor_id` (`mentor_id`);

--
-- Indeks untuk tabel `mentor`
--
ALTER TABLE `mentor`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempt_id` (`attempt_id`),
  ADD KEY `kuis_id` (`kuis_id`);

--
-- Indeks untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_classes`
--
ALTER TABLE `user_classes`
  ADD PRIMARY KEY (`user_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indeks untuk tabel `zoom_meeting`
--
ALTER TABLE `zoom_meeting`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `kuis`
--
ALTER TABLE `kuis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `login_logs_siswa`
--
ALTER TABLE `login_logs_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `mentor`
--
ALTER TABLE `mentor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `zoom_meeting`
--
ALTER TABLE `zoom_meeting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `fk_classes_mentor` FOREIGN KEY (`mentor_id`) REFERENCES `mentor` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `quiz_attempts`
--
ALTER TABLE `quiz_attempts`
  ADD CONSTRAINT `quiz_attempts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `user_classes`
--
ALTER TABLE `user_classes`
  ADD CONSTRAINT `user_classes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `user_classes_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
