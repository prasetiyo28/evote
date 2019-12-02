-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 27 Des 2017 pada 01.38
-- Versi Server: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_voting`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id` int(1) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `calon`
--

CREATE TABLE `calon` (
  `id` int(1) NOT NULL,
  `nama_ketua` varchar(30) NOT NULL,
  `prodi_ketua` varchar(25) NOT NULL,
  `nama_wakil` varchar(30) NOT NULL,
  `prodi_wakil` varchar(25) NOT NULL,
  `angkatan_ketua` year(4) NOT NULL,
  `angkatan_wakil` year(4) NOT NULL,
  `visi` text NOT NULL,
  `misi` text NOT NULL,
  `slogan` varchar(150) NOT NULL,
  `foto` varchar(50) NOT NULL,
  `terhapus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `calon`
--

INSERT INTO `calon` (`id`, `nama_ketua`, `prodi_ketua`, `nama_wakil`, `prodi_wakil`, `angkatan_ketua`, `angkatan_wakil`, `visi`, `misi`, `slogan`, `foto`, `terhapus`) VALUES
(1, 'Anies Baswedan', 'D4-Teknik Informatika', 'Sandiaga Uno', 'D3-Akuntansi', 2016, 2016, 'Berjayalah', 'mandirilah', 'kita mahasiswa ', '1.jpg', 0),
(3, 'Basuki Thaja Purnama', 'D4-Teknik Informatika', 'Djarot Syaiful Hidayat', 'D3-Farmasi', 2017, 2017, 'Indonesia Bebas Prostitusi 2018', 'Tutup Alexis', 'Majulah Indonesiaku', '48986.jpg', 0),
(7, 'Bayu Adi Prasetiyo', 'D4-Teknik Informatika', 'Kukuh Yulian Santoso', 'D4-Teknik Informatika', 2015, 2015, 'Mencerdaskan Kehidupan Berbangsa dan Bertanah Air tahun 2018', 'Meningkatkan Diskusi tentang cinta tanah air dan berbangsa', 'Mencerdaskan Kehidupan Berbangsa dan Bertanah Air tahun 2018', 'backward.png', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `hasil`
--

CREATE TABLE `hasil` (
  `id` int(4) NOT NULL,
  `nim` varchar(8) NOT NULL,
  `id_grup` int(1) NOT NULL,
  `tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `hasil`
--

INSERT INTO `hasil` (`id`, `nim`, `id_grup`, `tanggal`) VALUES
(1, '15090067', 3, '2017-11-08 10:20:16'),
(2, '14090067', 1, '2017-11-08 10:21:26'),
(3, '14090067', 3, '2017-11-08 12:11:18'),
(4, '14090067', 7, '2017-12-24 07:11:09'),
(5, '14090067', 7, '2017-12-24 07:11:13'),
(6, '15090090', 3, '2017-12-23 17:54:59'),
(7, '15090011', 1, '2017-12-24 08:07:31'),
(8, '15090080', 3, '2017-12-27 05:47:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `activity` varchar(255) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `log_activity`
--

INSERT INTO `log_activity` (`id`, `user`, `activity`, `date_time`) VALUES
(1, '15090090', 'Login', '2017-12-23 18:32:16'),
(2, '15090090', 'Logout', '2017-12-23 18:40:12'),
(3, '1', 'Logout', '2017-12-24 04:39:47'),
(4, 'admin', 'Login', '2017-12-24 04:42:43'),
(5, '1', 'Logout', '2017-12-24 04:45:42'),
(6, 'admin', 'Login', '2017-12-24 04:45:47'),
(7, 'admin', 'Login', '2017-12-24 04:46:02'),
(8, 'admin', 'Login', '2017-12-24 04:48:04'),
(9, 'admin', 'Login', '2017-12-24 04:48:44'),
(10, '1', 'Logout', '2017-12-24 04:48:54'),
(11, 'admin', 'Login', '2017-12-24 04:49:48'),
(12, 'admin', 'Login', '2017-12-24 04:50:11'),
(13, 'admin', 'Login', '2017-12-24 04:52:54'),
(14, 'admin', 'Logout', '2017-12-24 04:52:58'),
(15, 'admin', 'Login', '2017-12-24 04:56:24'),
(16, 'admin', '$admin menambahkan data pemilih dengan nim $nim', '2017-12-24 05:13:57'),
(17, 'admin', '15090088', '2017-12-24 05:15:43'),
(18, 'admin', '\'admin menambahkan data pemilih dengan nim 15090099\'', '2017-12-24 05:21:16'),
(19, 'admin', 'admin menambahkan data pemilih dengan nim 15090099', '2017-12-24 05:25:07'),
(20, 'admin', 'Logout', '2017-12-24 06:42:45'),
(21, '15090011', 'Login', '2017-12-24 08:06:03'),
(22, 'admin', 'Login', '2017-12-24 08:27:05'),
(23, '15090011', 'Logout', '2017-12-24 09:12:33'),
(24, '15090090', 'Login', '2017-12-24 09:13:32'),
(25, '15090090', 'Logout', '2017-12-24 15:33:34'),
(26, '15090090', 'Login', '2017-12-24 15:33:40'),
(27, '15090090', 'Logout', '2017-12-24 15:37:14'),
(28, '15090099', 'Login', '2017-12-24 16:44:57'),
(29, '15090099', 'Logout', '2017-12-24 16:45:25'),
(30, 'admin', 'Login', '2017-12-25 08:26:49'),
(31, '15090099', 'Login', '2017-12-25 12:04:01'),
(32, '15090099', 'Logout', '2017-12-25 12:05:21'),
(33, '15090090', 'Login', '2017-12-25 12:32:36'),
(34, '15090090', 'Logout', '2017-12-25 12:39:22'),
(35, '15090090', 'Login', '2017-12-25 12:39:33'),
(36, '15090090', 'Logout', '2017-12-25 12:49:27'),
(37, 'admin', 'Login', '2017-12-25 13:08:02'),
(38, 'admin', 'Logout', '2017-12-25 13:28:07'),
(39, 'admin', 'Login', '2017-12-25 13:36:05'),
(40, 'admin', 'Logout', '2017-12-25 13:36:32'),
(41, 'admin', 'Login', '2017-12-25 13:38:15'),
(42, '15090090', 'Login', '2017-12-27 05:45:26'),
(43, '15090090', 'Logout', '2017-12-27 05:45:40'),
(44, 'admin', 'Login', '2017-12-27 05:45:49'),
(45, '15090080', 'Login', '2017-12-27 05:47:07'),
(46, '15090080', 'Logout', '2017-12-27 05:50:09'),
(47, '15090080', 'Login', '2017-12-27 05:50:24'),
(48, '15090080', 'Logout', '2017-12-27 05:51:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemilih`
--

CREATE TABLE `pemilih` (
  `nim` varchar(8) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `kelas` varchar(30) NOT NULL,
  `prodi` varchar(25) NOT NULL,
  `password` varchar(30) NOT NULL,
  `enc_password` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `terhapus` int(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pemilih`
--

INSERT INTO `pemilih` (`nim`, `nama`, `kelas`, `prodi`, `password`, `enc_password`, `email`, `status`, `terhapus`, `created_at`, `update_at`) VALUES
('14090067', 'kukuh yulian santoso', '5C', 'D4-Teknik Informatika', '5cQAqUKC', '1', 'kukuhyulian@gmail.com', 1, 0, '2017-12-24 04:54:49', '0000-00-00 00:00:00'),
('15090001', 'Nama Mahasiswa A', '3C', 'D3-Akuntansi', 'ddMbiDfG', '915c176c3811eae53899ca312358e904', 'mahasiswaA-28@gmail.com', 0, 1, '2017-12-24 04:58:00', '0000-00-00 00:00:00'),
('15090011', 'abcdaedea', '3C', 'D4-Teknik Informatika', 'hGVFLxKM', 'ad7e336a038f7e60d161b64f922180e3', 'emailkue@gmail.com', 1, 0, '2017-12-24 05:13:57', '0000-00-00 00:00:00'),
('15090079', 'Bayu Adi Prasetiyo', '5C', 'D4-Teknik Informatika', 'password', '1', 'bayu28.bap@gmail.com', 1, 0, '2017-12-24 04:54:49', '0000-00-00 00:00:00'),
('15090080', 'Dio Surandito', '5C', 'D4-Teknik Informatika', 'olsg6XBy', 'aa2e44a8f3c7f4d5559d74915b9cdcd0', 'dio.surandito@gmail.com', 1, 0, '2017-12-24 04:54:49', '2017-12-27 05:46:59'),
('15090088', 'asjasdjh', '3D', 'D3-Akuntansi', 'AeObzkki', '15d0a412636d2c88b4a9b06f8dabd813', 'ashdj@gmail.com', 0, 0, '2017-12-24 05:15:43', '0000-00-00 00:00:00'),
('15090090', 'Acd', '5A', 'D4-Teknik Informatika', '34fxCgOH', '072da8f96f6aac3a805063e78b51856b', 'bayu-28@live.com', 1, 0, '2017-12-24 04:54:49', '2017-12-24 16:30:07'),
('15090099', 'Lanny Nadia Liu', '5C', 'D4-Teknik Informatika', '5eR2gmIx', '072da8f96f6aac3a805063e78b51856b', 'Lanny@gmail.com', 0, 0, '2017-12-24 04:54:49', '2017-12-25 12:32:20');

-- --------------------------------------------------------

--
-- Struktur dari tabel `utility`
--

CREATE TABLE `utility` (
  `mulai` date NOT NULL,
  `selesai` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `utility`
--

INSERT INTO `utility` (`mulai`, `selesai`) VALUES
('2017-12-26', '2017-12-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`nim`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
