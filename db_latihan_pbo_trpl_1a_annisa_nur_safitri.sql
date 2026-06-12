-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2026 at 02:18 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latihan_pbo_trpl 1a_annisa nur safitri`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_tiket`
--

CREATE TABLE `tabel_tiket` (
  `id_tiket` varchar(10) NOT NULL,
  `nama_film` varchar(100) NOT NULL,
  `jadwal_tayang` datetime NOT NULL,
  `jumlah_kursi` int NOT NULL,
  `harga_dasar_tiket` decimal(10,2) NOT NULL,
  `jenis_studio` enum('regular','max','velvet') NOT NULL,
  `tipe_studio` varchar(20) DEFAULT NULL,
  `lokasi_baris` varchar(20) DEFAULT NULL,
  `kacamata_3d_id` varchar(10) DEFAULT NULL,
  `efek_gerak_fitur` varchar(50) DEFAULT NULL,
  `bantal_selimut_pack` varchar(10) DEFAULT NULL,
  `layanan_butler` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_tiket`
--

INSERT INTO `tabel_tiket` (`id_tiket`, `nama_film`, `jadwal_tayang`, `jumlah_kursi`, `harga_dasar_tiket`, `jenis_studio`, `tipe_studio`, `lokasi_baris`, `kacamata_3d_id`, `efek_gerak_fitur`, `bantal_selimut_pack`, `layanan_butler`) VALUES
('TKT-MAX01', 'Avatar 3', '2026-06-15 18:00:00', 1, '75000.00', 'max', 'IMAX 3D', 'Row VIP-1', 'GLS-3D01', 'Motion Vibration', NULL, NULL),
('TKT-MAX02', 'Avatar 3', '2026-06-15 18:00:00', 1, '75000.00', 'max', 'IMAX 3D', 'Row VIP-2', 'GLS-3D02', 'Motion Vibration', NULL, NULL),
('TKT-MAX03', 'The Avengers 5', '2026-06-16 14:00:00', 2, '70000.00', 'max', 'IMAX 2D', 'Row B', NULL, 'Wind Effect', NULL, NULL),
('TKT-MAX04', 'The Avengers 5', '2026-06-16 14:00:00', 2, '70000.00', 'max', 'IMAX 2D', 'Row B', NULL, 'Wind Effect', NULL, NULL),
('TKT-MAX05', 'Interstellar', '2026-06-17 10:00:00', 1, '80000.00', 'max', 'IMAX Laser', 'Row Screen', NULL, 'Full Motion', NULL, NULL),
('TKT-MAX06', 'Interstellar', '2026-06-17 10:00:00', 1, '80000.00', 'max', 'IMAX Laser', 'Row Screen', NULL, 'Full Motion', NULL, NULL),
('TKT-MAX07', 'Avatar 3', '2026-06-17 14:00:00', 3, '75000.00', 'max', 'IMAX 3D', 'Row VIP-3', 'GLS-3D03', 'Motion Vibration', NULL, NULL),
('TKT-REG01', 'Gundala 2', '2026-06-15 13:00:00', 1, '40000.00', 'regular', 'Standard', 'Row E', NULL, NULL, NULL, NULL),
('TKT-REG02', 'Gundala 2', '2026-06-15 13:00:00', 2, '40000.00', 'regular', 'Standard', 'Row F', NULL, NULL, NULL, NULL),
('TKT-REG03', 'Avatar 3', '2026-06-15 15:30:00', 1, '45000.00', 'regular', 'Dolby Atmos', 'Row G', NULL, NULL, NULL, NULL),
('TKT-REG04', 'Avatar 3', '2026-06-15 15:30:00', 4, '45000.00', 'regular', 'Dolby Atmos', 'Row H', NULL, NULL, NULL, NULL),
('TKT-REG05', 'KKN Di Desa Penari 2', '2026-06-16 19:00:00', 2, '40000.00', 'regular', 'Standard', 'Row C', NULL, NULL, NULL, NULL),
('TKT-REG06', 'KKN Di Desa Penari 2', '2026-06-16 19:00:00', 1, '40000.00', 'regular', 'Standard', 'Row D', NULL, NULL, NULL, NULL),
('TKT-REG07', 'The Batman II', '2026-06-17 21:00:00', 2, '45000.00', 'regular', 'Dolby Atmos', 'Row A', NULL, NULL, NULL, NULL),
('TKT-VLV01', 'The Batman II', '2026-06-15 20:00:00', 2, '150000.00', 'velvet', 'Velvet Suite', 'Sofa 01', NULL, NULL, 'Premium A', 'Personal Butler'),
('TKT-VLV02', 'The Batman II', '2026-06-15 20:00:00', 2, '150000.00', 'velvet', 'Velvet Suite', 'Sofa 01', NULL, NULL, 'Premium A', 'Personal Butler'),
('TKT-VLV03', 'Inception 2', '2026-06-16 21:30:00', 2, '130000.00', 'velvet', 'Velvet Lounge', 'Sofa 05', NULL, NULL, 'Gold Pack', 'On-Call Butler'),
('TKT-VLV04', 'Inception 2', '2026-06-16 21:30:00', 1, '130000.00', 'velvet', 'Velvet Lounge', 'Sofa 05', NULL, NULL, 'Gold Pack', 'On-Call Butler'),
('TKT-VLV05', 'Gundala 2', '2026-06-17 16:00:00', 2, '150000.00', 'velvet', 'Velvet Suite', 'Sofa 02', NULL, NULL, 'Premium A', 'Personal Butler'),
('TKT-VLV06', 'Gundala 2', '2026-06-17 16:00:00', 2, '150000.00', 'velvet', 'Velvet Suite', 'Sofa 02', NULL, NULL, 'Premium A', 'Personal Butler');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_tiket`
--
ALTER TABLE `tabel_tiket`
  ADD PRIMARY KEY (`id_tiket`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
