-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 09:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stokbarang`
--

-- --------------------------------------------------------

--
-- Table structure for table `keluar`
--

CREATE TABLE `keluar` (
  `idkeluar` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(25) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `penerima` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keluar`
--

INSERT INTO `keluar` (`idkeluar`, `idbarang`, `tanggal`, `keterangan`, `qty`, `penerima`) VALUES
(2, 16, '2022-07-03 01:14:32', 'Bimoli', '5', 'Pembeli'),
(3, 17, '2022-07-03 05:04:00', 'Daia Bunga', '15', 'Pembeli'),
(4, 18, '2022-07-03 05:47:28', 'Indomie', '5', 'Pembeli'),
(5, 18, '2022-07-04 12:01:46', 'sedap', '9', 'Pembeli'),
(6, 24, '2022-07-05 01:32:30', 'ABCD', '4', 'Pembeli'),
(7, 24, '2022-07-05 01:58:15', 'ABCD', '1', 'Bagian Gudang  Tata'),
(8, 24, '2022-07-05 01:58:32', 'ABCD', '3', 'Bagian Gudang Budi'),
(10, 26, '2022-07-05 14:07:56', 'sedap', '5', 'Bagian Gudang Budi'),
(11, 28, '2022-07-05 14:08:53', 'sedap', '5', 'Pembeli'),
(12, 28, '2022-07-05 14:09:50', 'sedap', '94', 'Pembeli'),
(13, 33, '2022-07-15 05:29:59', 'box', '5', 'Pembeli'),
(14, 33, '2022-07-15 06:01:11', 'box', '2', 'Bagian Gudang Budi'),
(15, 35, '2022-07-15 13:05:40', 'box', '100', 'Pembeli'),
(16, 35, '2022-07-15 13:06:14', 'box', '50', 'Pembeli'),
(17, 37, '2022-07-17 08:40:30', 'tabung', '5', 'Pembeli'),
(18, 46, '2022-07-21 04:21:05', 'Galon', '19', 'Pembeli'),
(20, 47, '2022-07-21 08:44:54', 'Tabung', '501', 'Pembeli'),
(21, 49, '2022-07-23 14:03:49', 'Jerigen', '1', 'Pembeli'),
(22, 49, '2022-07-24 06:52:54', 'Jerigen', '603', 'Pembeli'),
(23, 8, '2023-12-05 04:25:58', '1', '1', '1'),
(24, 11, '2023-12-05 14:26:44', 'rara', '1', 'rara'),
(25, 13, '2023-12-05 14:55:10', 'wad', '11', 'sad');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `iduser` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`iduser`, `email`, `password`, `level`) VALUES
(1, 'admin@gmail.com', '12345678', 'Admin'),
(3, 'KGbudiA@gmail.com', '987654321', 'Kepala Gudang'),
(19, 'hafiz@gmail.com', '12345678', 'Kepala Gudang');

-- --------------------------------------------------------

--
-- Table structure for table `masuk`
--

CREATE TABLE `masuk` (
  `idmasuk` int(11) NOT NULL,
  `idbarang` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` int(11) NOT NULL,
  `penerima` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `masuk`
--

INSERT INTO `masuk` (`idmasuk`, `idbarang`, `tanggal`, `keterangan`, `qty`, `penerima`) VALUES
(12, 16, '2022-07-03 01:14:02', 'Bimoli', 10, 'Bagian Gudang Budi'),
(13, 17, '2022-07-03 05:03:44', 'Daia Bunga', 20, 'Bagian Gudang  Tata'),
(14, 18, '2022-07-04 11:54:01', 'ABCD', 1, 'Pembeli'),
(15, 21, '2022-07-04 12:56:44', 'kapal Api', 6, 'Bagian Gudang Budi'),
(16, 22, '2022-07-04 13:00:15', 'Daia', 1, 'Bagian Gudang Budi'),
(17, 23, '2022-07-04 13:23:52', 'Ultramilk', 3, 'Bagian Gudang Budi'),
(18, 24, '2022-07-05 01:27:55', 'ABCD', 5, 'Bagian Gudang Budi'),
(19, 26, '2022-07-05 02:16:19', 'sedap', 5, 'Bagian Gudang Budi'),
(20, 27, '2022-07-05 10:35:26', 'ABCD', 5, 'Bagian Gudang Budi'),
(21, 26, '2022-07-05 14:07:17', 'sedap', 5, 'Bagian Gudang Budi'),
(22, 28, '2022-07-06 03:57:52', 'sedap', 9, 'Bagian Gudang  Tata'),
(23, 22, '2022-07-11 13:00:58', 'sedap', 5, 'Bagian Gudang Budi'),
(24, 0, '2022-07-12 14:57:57', 'ABCD', 5, 'Bagian Gudang Budi'),
(25, 0, '2022-07-12 14:57:57', 'ABCD', 5, 'Bagian Gudang Budi'),
(26, 0, '2022-07-12 14:58:20', 'su', 10, 'Bagian Gudang Budi'),
(27, 0, '2022-07-12 14:58:20', 'su', 10, 'Bagian Gudang Budi'),
(28, 33, '2022-07-15 05:29:31', 'dus', 5, 'Bagian Gudang Budi'),
(29, 33, '2022-07-16 12:38:48', 'box', 5, 'Bagian Gudang Budi'),
(30, 37, '2022-07-17 08:40:10', 'tabung', 10, 'Bagian Gudang Budi'),
(31, 46, '2022-07-21 04:20:24', 'Galon', 10, 'Bagian Gudang Budi'),
(32, 47, '2022-07-21 08:44:32', 'Tabung', 100, 'Bagian Gudang Budi'),
(33, 48, '2022-07-23 08:56:37', 'cek', 10, 'cek'),
(34, 47, '2022-07-23 08:57:11', 'ABCD', 10, 'cek'),
(35, 47, '2022-07-23 12:39:59', 'tes', 2, 'tes'),
(36, 47, '2022-07-23 14:02:04', 'Tabung', 11, 'Pembeli'),
(37, 47, '2022-07-24 06:49:39', 'Tabung', 10, 'Bagian Gudang Budi'),
(38, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(39, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(40, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(41, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(42, 47, '2022-07-24 06:49:40', 'Tabung', 10, 'Bagian Gudang Budi'),
(43, 47, '2022-07-24 06:49:41', 'Tabung', 10, 'Bagian Gudang Budi'),
(44, 49, '2022-07-24 06:50:43', 'Jerigen', 19, 'Bagian Gudang Budi'),
(45, 49, '2022-07-24 06:54:46', 'Jerigen', 5, 'Bagian Gudang Budi'),
(46, 50, '2022-07-24 06:55:20', 'tes', 2, 'tesssssssssssssssssssssss'),
(47, 10, '2023-12-05 13:26:17', 'wd', 1, 'adw'),
(48, 9, '2023-12-05 13:26:29', 'wadaw', 21, 'awd'),
(49, 11, '2023-12-05 14:26:34', 'rara rara2', 12, 'rara'),
(50, 12, '2023-12-05 14:47:19', 'asdasd', 221, 'fds'),
(51, 13, '2023-12-05 14:47:27', 'dasdas', 12, 'das');

-- --------------------------------------------------------

--
-- Table structure for table `po`
--

CREATE TABLE `po` (
  `idpo` int(150) NOT NULL,
  `idbarang` varchar(50) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `keterangan` varchar(50) NOT NULL,
  `qty` varchar(25) NOT NULL,
  `kode_transaksi` varchar(50) NOT NULL,
  `Status` int(11) NOT NULL,
  `penerima` varchar(150) NOT NULL,
  `Supplier` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `po`
--

INSERT INTO `po` (`idpo`, `idbarang`, `tanggal`, `keterangan`, `qty`, `kode_transaksi`, `Status`, `penerima`, `Supplier`) VALUES
(2, '9', '2023-12-05 13:31:57', 'sdasd', '1', 'PO-20231205240', 0, 'rara', 'rara'),
(3, '11', '2023-12-05 14:26:59', 'rara', '1', 'PO-20231205736', 0, 'raa', 'raa');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `idbarang` int(11) NOT NULL,
  `image` varchar(99) DEFAULT NULL,
  `namabarang` varchar(50) NOT NULL,
  `keterangan` varchar(50) NOT NULL,
  `stock` int(11) NOT NULL,
  `kadaluwarsa` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`idbarang`, `image`, `namabarang`, `keterangan`, `stock`, `kadaluwarsa`) VALUES
(12, '3dfc309f75d00cbcd68e4855e2ac2be2.jpg', 'siregar', 'mantap', 343, '2024-01-05'),
(13, '2a97364a647e4e3832171750e569be54.jpg', 'hafiz', 'aryan', 124, '2023-12-23'),
(14, 'b872c3ed97191d2adc2a0dc0bae23e42.jpg', 'adw', 'awdawd', 123, '2023-12-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `keluar`
--
ALTER TABLE `keluar`
  ADD PRIMARY KEY (`idkeluar`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`iduser`);

--
-- Indexes for table `masuk`
--
ALTER TABLE `masuk`
  ADD PRIMARY KEY (`idmasuk`);

--
-- Indexes for table `po`
--
ALTER TABLE `po`
  ADD PRIMARY KEY (`idpo`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idbarang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `keluar`
--
ALTER TABLE `keluar`
  MODIFY `idkeluar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `masuk`
--
ALTER TABLE `masuk`
  MODIFY `idmasuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `po`
--
ALTER TABLE `po`
  MODIFY `idpo` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
