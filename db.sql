-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 19, 2021 at 10:58 AM
-- Server version: 10.2.36-MariaDB-cll-lve
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `surh6545_telkom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) CHARACTER SET utf8mb4 NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('2','1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `nama_lengkap`, `instansi`, `password`, `status`) VALUES
(29, 'Adelia', 'Adelia Yasmin', 'Pegawai', '$2y$10$YDKSQ3UXDgstr3pe638laOzZpEkZXHl0oPIJDpgpeytrT91/SmLHO', '2'),
(24, 'admin', 'Administrator', 'HRD', '$2y$10$nBI506o3mYkZzbs15oBYjendLldqy7TkQmHwBIZ7PESbIIHCHXIOC', '0'),
(23, 'admin2', 'Admin 2', 'admin', '$2y$10$8SA.jixDHmUGsajuJl3hfertoKI2vER7COcRFQbULotnTo7p9gSRC', '0'),
(27, 'dede', 'dede rf', 'pegawai', '$2y$10$Qta1qaybdsbWfgebo9T2C.ijhbucV3p7XKRll6LNxpUekdCFtZzWy', '2'),
(26, 'dederodhatul', 'dede rodhatul farida', 'HRD', '$2y$10$pX5Kl2GmMXsqwByjx7ZzSOfDINzwhaoepsBqh7gO5OWBFpJF.KTFe', '1'),
(22, 'Hakim', 'Muhammad Abdul Hakim', 'Testing', '$2y$10$JSolmFBiIheR4rRoJQNkr.7OrUHtYakDK9Bcfr2KbrqN39hZhkrm6', '2'),
(25, 'superuser', 'Super User', 'Pegawai', '$2y$10$JajbxujGj/ALukFP8unKM.k44wDdaT7GM/.rSLRnoqNizJg7g211G', '1'),
(30, 'user', 'User Testing', 'Pegawai', '$2y$10$lN.u58ddcsyB/YKTrQQ/1eWdBQb1zVTO9o1zJICaOq6pRQFDowJiS', '2');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `tgl_buat` date NOT NULL,
  `judul_laporan` varchar(50) NOT NULL,
  `jenis` enum('semua','tolak','verif','tunggu') NOT NULL,
  `tgl_awal` date DEFAULT NULL,
  `tgl_akhir` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `surat`
--

CREATE TABLE `surat` (
  `id` int(11) NOT NULL,
  `judul_surat` varchar(255) NOT NULL,
  `no_surat` varchar(255) NOT NULL,
  `username` varchar(25) NOT NULL,
  `nama_pengirim` varchar(50) NOT NULL,
  `nama_penerima` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `note` longtext DEFAULT NULL,
  `verifikasi` date NOT NULL,
  `diverifikasi` date DEFAULT NULL,
  `keterangan` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`),
  ADD KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat`
--
ALTER TABLE `surat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- AUTO_INCREMENT for table `surat`
--
ALTER TABLE `surat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `surat`
--
ALTER TABLE `surat`
  ADD CONSTRAINT `surat_ibfk_1` FOREIGN KEY (`username`) REFERENCES `admin` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
