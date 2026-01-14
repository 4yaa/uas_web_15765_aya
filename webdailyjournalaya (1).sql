-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2026 at 04:13 PM
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
-- Database: `webdailyjournalaya`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `judul` text DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `judul`, `isi`, `gambar`, `tanggal`, `username`) VALUES
(1, 'Foto Profil Utama', 'Ini adalah foto profil yang digunakan di halaman Home dan About Me.', 'orangcantik.jpeg', '2026-01-10 17:53:44', 'admin'),
(2, 'Lawang Sewu', 'Jalan-jalan ke ikon kota Semarang yang bersejarah.', 'lawangsewu.jpg', '2026-01-10 17:53:44', 'admin'),
(3, 'Kota Lama Semarang', 'Suasana klasik di Kota Lama memang nggak ada duanya.', 'kotalama.jpg', '2026-01-10 17:53:44', 'admin'),
(4, 'Simpang Lima', 'Pusat keramaian kota Semarang di malam hari.', 'simpang_lima.jpg', '2026-01-10 17:53:44', 'admin'),
(5, 'Masjid Agung', 'Keindahan arsitektur Masjid Agung Jawa Tengah.', 'masjidagung.jpg', '2026-01-10 17:53:44', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) DEFAULT NULL,
  `gambar` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `judul`, `gambar`, `tanggal`) VALUES
(1, 'Gedong Songo', 'bandungan1.jpg', '2026-01-14 10:50:08'),
(2, 'Alun-Alun Bandungan', 'bandungan2.jpg', '2026-01-14 10:50:08'),
(3, 'Cafe Tungku Bumi ', 'bandungan3.jpeg', '2026-01-14 10:50:08'),
(4, 'Pasar Bunga Bandungan', 'bandungan4.webp', '2026-01-14 10:50:08'),
(5, 'Susan Spa', 'bandungan5.jpg', '2026-01-14 10:50:08'),
(6, 'Curug Semirang', 'bandungan6.webp', '2026-01-14 10:50:08');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `foto`) VALUES
(1, 'admin', '123456', 'admin.jpeg'),
(2, 'danny', 'admin', 'dosen.jpeg'),
(3, 'celline', '123456', 'cantik1.jpeg'),
(4, 'milati', '123456', 'cantik2.jpeg'),
(5, 'fiefie', '123456', 'cantik3.jpeg'),
(6, 'aya', '123456', 'cantik4.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
