-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 04:07 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_gudang`
--
CREATE DATABASE IF NOT EXISTS `db_gudang` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `db_gudang`;

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(40) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `lokasi` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `jumlah`, `lokasi`) VALUES
(1, 'Puisi Kita', 55, 'A1'),
(2, 'Terbitlah Terang', 29, '2B'),
(3, 'Terbitlah Terang 2', 60, 'A7'),
(12, 'Buku Tua', 47, 'F5'),
(13, 'Pahlawan Bertopeng', 0, 'R2'),
(14, 'Shincan', 0, 'G2'),
(18, 'Terbitlah Terang3', 0, 'Z4'),
(20, 'Terbitlah Terang4', 0, '2B'),
(21, 'Shincan 2', 77, 'F5'),
(22, 'Buku Tua 4', 0, 'A7'),
(23, 'Terbitlah Terang 8', 0, 'A5'),
(24, 'Doraemon', 0, 'G2'),
(26, 'Doraemon 2', 0, 'F5'),
(27, 'Doraemon 3', 0, 'I2');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukan`
--

CREATE TABLE `pemasukan` (
  `id_surat_jalan` int(11) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemasukan`
--

INSERT INTO `pemasukan` (`id_surat_jalan`, `id_buku`, `id_supplier`, `tanggal`, `jumlah`) VALUES
(1001, '1', 1, '2018-11-01 00:00:00', 10),
(1100, '1', 1, '2018-11-24 16:23:36', 35),
(1102, '', 1, '2018-11-26 23:32:15', 47),
(1103, '', 1, '2018-11-26 23:31:17', 35),
(1106, '3', 1, '2018-11-26 23:44:07', 77),
(1111, '', 1, '2018-11-26 23:34:55', 77),
(1112, '', 1, '2018-11-26 23:38:29', 77),
(1234, '12', 2, '2018-11-28 00:15:39', 13),
(2222, '2', 2, '2018-11-26 23:58:37', 29),
(2251, '21', 2, '2018-11-28 00:50:43', 77),
(5555, '12', 2, '2018-11-28 00:21:55', 47);

--
-- Triggers `pemasukan`
--
DELIMITER $$
CREATE TRIGGER `masuk` AFTER INSERT ON `pemasukan` FOR EACH ROW UPDATE buku SET jumlah=jumlah+NEW.jumlah WHERE id_buku=NEW.id_buku
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_surat_keluar` int(11) NOT NULL,
  `id_buku` varchar(10) NOT NULL,
  `id_user` varchar(11) NOT NULL,
  `tanggal` datetime NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_surat_keluar`, `id_buku`, `id_user`, `tanggal`, `jumlah`) VALUES
(1, '3', 'vero97', '2018-11-27 00:28:05', 13),
(1111, '12', 'vero97', '2018-11-28 00:19:37', 13),
(1124, '3', 'jack94', '2018-11-27 00:29:54', 4);

--
-- Triggers `pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `pengeluaran` AFTER INSERT ON `pengeluaran` FOR EACH ROW UPDATE buku SET jumlah=jumlah-NEW.jumlah WHERE id_buku=NEW.id_buku
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `telp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `alamat`, `telp`) VALUES
(1, 'Sukses Jaya Mandiri', 'Batam Bengkong 3 no 25', 455352),
(2, 'Mandiri Sukses', 'Batam Center, Kav 5422 no 12', 422515);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` varchar(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `name`, `password`) VALUES
('jack94', 'jacky', '1234'),
('vero97', 'Veronika', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `judul` (`judul`);

--
-- Indexes for table `pemasukan`
--
ALTER TABLE `pemasukan`
  ADD PRIMARY KEY (`id_surat_jalan`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_surat_keluar`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
