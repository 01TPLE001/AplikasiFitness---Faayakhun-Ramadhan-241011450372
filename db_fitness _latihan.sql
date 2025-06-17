-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2025 at 08:44 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_fitness`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_telepon` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `tanggal_daftar` date NOT NULL,
  `tanggal_kadaluarsa` date NOT NULL,
  `status` enum('Aktif','Tidak Aktif') DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`id_member`, `nama`, `no_telepon`, `alamat`, `tanggal_daftar`, `tanggal_kadaluarsa`, `status`) VALUES
(1, 'Vincent Fabron', '08123456789', 'Jalan Raya Parung Bogor', '2025-06-02', '2025-08-02', 'Aktif'),
(2, 'Liam Bryne', '0838789123', 'Telaga Kahuripan', '2025-06-10', '2025-09-10', 'Aktif'),
(3, 'Jamie Adeyemi', '0899787878', 'Duta Pakis Residence', '2025-04-02', '2025-07-02', 'Aktif'),
(4, 'Alexander Novikov', '0856456089', 'Citra Raya', '2025-06-02', '2025-07-02', 'Aktif'),
(5, 'Ashly Burch', '0846000111', 'Perumahan Alam Parung', '2025-06-10', '2025-09-10', 'Aktif'),
(6, 'Karina Altamirano', '08881112233', 'Griya Wanara', '2025-06-10', '2025-06-02', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id_paket` int(11) NOT NULL,
  `nama_paket` varchar(50) NOT NULL,
  `durasi_bulan` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id_paket`, `nama_paket`, `durasi_bulan`, `harga`) VALUES
(1, 'P001', 1, '150000.00'),
(2, 'P002', 3, '400000.00');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_member` int(11) DEFAULT NULL,
  `id_paket` int(11) DEFAULT NULL,
  `tanggal_transaksi` date NOT NULL,
  `jenis_transaksi` enum('Daftar Baru','Perpanjangan') NOT NULL,
  `total_bayar` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_member`, `id_paket`, `tanggal_transaksi`, `jenis_transaksi`, `total_bayar`) VALUES
(1, 1, 1, '2025-06-02', 'Daftar Baru', '150000.00'),
(2, 1, 1, '2025-06-02', 'Daftar Baru', '150000.00'),
(3, 1, 1, '2025-06-02', 'Perpanjangan', '150000.00'),
(4, 2, 1, '2025-06-02', 'Perpanjangan', '150000.00'),
(5, 3, 1, '2025-06-02', 'Perpanjangan', '150000.00'),
(6, 4, 1, '2025-07-02', 'Perpanjangan', '150000.00'),
(7, 5, 2, '2025-06-10', 'Daftar Baru', '400000.00'),
(8, 2, 2, '2025-06-10', 'Daftar Baru', '400000.00'),
(9, 2, 1, '2025-06-10', 'Daftar Baru', '150000.00'),
(11, 5, 2, '2025-06-10', 'Daftar Baru', '400000.00'),
(12, 2, 2, '2025-06-10', 'Daftar Baru', '400000.00');

-- --------------------------------------------------------

--
-- Table structure for table `user_admin`
--

CREATE TABLE `user_admin` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Create user_admin default user(username: admin; password: admin)
--

INSERT INTO `user_admin` (`username`, `password`, `nama_lengkap`) VALUES
('admin', '$2y$10$wAiHKO2HCrO5aNS.S/zJPe/9QEa9KyDQbl1tnpm3Z6ewozWZmNJpm', 'Administrator');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id_paket`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_member` (`id_member`),
  ADD KEY `id_paket` (`id_paket`);

--
-- Indexes for table `user_admin`
--
ALTER TABLE `user_admin`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id_paket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_admin`
--
ALTER TABLE `user_admin`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_member`) REFERENCES `member` (`id_member`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_paket`) REFERENCES `paket` (`id_paket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
