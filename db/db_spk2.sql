-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 09:15 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spk`
--

-- --------------------------------------------------------

--
-- Table structure for table `alternatif`
--

CREATE TABLE `alternatif` (
  `id` int(11) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alternatif`
--

INSERT INTO `alternatif` (`id`, `kode`, `nama`) VALUES
(33, 'A2', 'TBS Ramp Tani Jaya'),
(34, 'A3', 'TBS Bumdesa Syariah Usaha Bersama'),
(35, 'A4', 'TBS CV Restu Bangun Persada'),
(36, 'A5', 'TBS CV. Perwita Sari Abadi'),
(37, 'A6', 'TBS UD. Tani Berkah Bersama'),
(38, 'A1', 'TBS Ramp Budi Jaya');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `rangking` char(100) NOT NULL,
  `idAlternatif` int(11) NOT NULL,
  `bobot` char(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`rangking`, `idAlternatif`, `bobot`) VALUES
('1', 35, '0.36'),
('2', 36, '0.04'),
('3', 38, '0.04'),
('4', 33, '0.04'),
('5', 34, '-0.12'),
('6', 37, '-0.36');

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `idKriteria` int(11) NOT NULL,
  `kode` varchar(200) NOT NULL,
  `nama` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`idKriteria`, `kode`, `nama`) VALUES
(1, 'C1', 'Kandungan Minyak.'),
(2, 'C2', 'Tingkat Kematangan'),
(3, 'C3', 'Ukuran Buah'),
(4, 'C4', 'Berat Tandan'),
(5, 'C5', 'Kondisi Buah');

-- --------------------------------------------------------

--
-- Table structure for table `perhitungan`
--

CREATE TABLE `perhitungan` (
  `idAlternatif` varchar(20) NOT NULL,
  `idKriteria` varchar(20) NOT NULL,
  `idSubkriteria` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perhitungan`
--

INSERT INTO `perhitungan` (`idAlternatif`, `idKriteria`, `idSubkriteria`) VALUES
('33', '1', '2'),
('33', '2', '9'),
('33', '3', '12'),
('33', '4', '16'),
('33', '5', '22'),
('34', '1', '2'),
('34', '2', '9'),
('34', '3', '12'),
('34', '4', '18'),
('34', '5', '21'),
('35', '1', '3'),
('35', '2', '7'),
('35', '3', '11'),
('35', '4', '17'),
('35', '5', '21'),
('36', '1', '4'),
('36', '2', '6'),
('36', '3', '12'),
('36', '4', '16'),
('36', '5', '23'),
('37', '1', '1'),
('37', '2', '9'),
('37', '3', '13'),
('37', '4', '17'),
('37', '5', '25'),
('38', '1', '1'),
('38', '2', '8'),
('38', '3', '12'),
('38', '4', '18'),
('38', '5', '22');

-- --------------------------------------------------------

--
-- Table structure for table `subkriteria`
--

CREATE TABLE `subkriteria` (
  `idSubkriteria` int(11) NOT NULL,
  `idKriteria` char(200) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `bobot` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subkriteria`
--

INSERT INTO `subkriteria` (`idSubkriteria`, `idKriteria`, `nama`, `bobot`) VALUES
(1, '1', 'Sangat Baik', '5'),
(2, '1', 'Baik', '4'),
(3, '1', 'Cukup', '3'),
(4, '1', 'Buruk', '2'),
(5, '1', 'Sangat Buruk', '1'),
(6, '2', 'Sangat Baik', '5'),
(7, '2', 'Baik', '4'),
(8, '2', 'Cukup', '3'),
(9, '2', 'Buruk', '2'),
(10, '2', 'Sangat Buruk', '1'),
(11, '3', 'Sangat Baik', '5'),
(12, '3', 'Baik', '4'),
(13, '3', 'Cukup', '3'),
(14, '3', 'Buruk', '2'),
(15, '3', 'Sangat Buruk', '1'),
(16, '4', 'Sangat Baik', '5'),
(17, '4', 'Baik', '4'),
(18, '4', 'Cukup', '3'),
(19, '4', 'Buruk', '2'),
(20, '4', 'Sangat Buruk', '1'),
(21, '5', 'Sangat Baik', '5'),
(22, '5', 'Baik', '4'),
(23, '5', 'Cukup', '3'),
(24, '5', 'Buruk', '2'),
(25, '5', 'Sangat Buruk', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` char(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `level`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '1', '2024-07-10 17:00:00'),
(2, 'Super admin', 'superadmin@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2', '2024-07-10 17:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alternatif`
--
ALTER TABLE `alternatif`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`idKriteria`);

--
-- Indexes for table `subkriteria`
--
ALTER TABLE `subkriteria`
  ADD PRIMARY KEY (`idSubkriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alternatif`
--
ALTER TABLE `alternatif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `idKriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `subkriteria`
--
ALTER TABLE `subkriteria`
  MODIFY `idSubkriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
