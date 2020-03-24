-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 10:53 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_laundry`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail`
--

CREATE TABLE `detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_jenis` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detail`
--

INSERT INTO `detail` (`id`, `id_transaksi`, `id_jenis`, `subtotal`, `qty`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 15000, 5, '2020-02-21 00:38:44', '2020-02-21 00:38:44'),
(2, 1, 1, 15000, 3, '2020-02-23 23:50:37', '2020-02-24 00:01:37'),
(3, 1, 2, 75000, 5, '2020-02-26 00:21:51', '2020-02-26 00:21:51'),
(4, 3, 2, 75000, 5, '2020-02-28 00:23:13', '2020-02-28 00:23:13'),
(5, 4, 2, 45000, 3, '2020-03-03 23:37:36', '2020-03-03 23:37:36'),
(6, 5, 3, 35000, 5, '2020-03-22 23:42:30', '2020-03-22 23:42:30');

-- --------------------------------------------------------

--
-- Table structure for table `jeniscuci`
--

CREATE TABLE `jeniscuci` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_jenis` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_perkilo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jeniscuci`
--

INSERT INTO `jeniscuci` (`id`, `nama_jenis`, `harga_perkilo`, `created_at`, `updated_at`) VALUES
(1, 'Cuci kering', '10000', '2020-02-18 23:09:58', '2020-02-18 23:09:58'),
(2, 'cuci kering setrika', '15000', '2020-02-18 23:10:18', '2020-02-18 23:11:31'),
(3, 'cuci basah', '7000', '2020-02-28 01:01:47', '2020-02-28 01:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_02_17_070137_create_table_pelanggan', 1),
(2, '2020_02_17_070825_create_table_petugas', 1),
(3, '2020_02_17_071237_create_table_jeniscuci', 1),
(4, '2020_02_17_071904_create_table_transaksi', 1),
(5, '2020_02_17_072336_create_table_detail', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `telp`, `created_at`, `updated_at`) VALUES
(1, 'Kandiya', 'Malang', '0864246874', '2020-02-17 23:08:54', '2020-02-17 23:10:48'),
(2, 'Della', 'Sawojajar', '08456734', '2020-02-18 23:13:21', '2020-02-18 23:13:21'),
(3, 'Niansa', 'jalanin aja', '086345678', '2020-02-28 00:04:33', '2020-02-28 00:04:33'),
(5, 'Heni', 'Sawojajar', '082345678', '2020-03-03 23:31:34', '2020-03-03 23:31:34');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_petugas` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telp` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` enum('admin','petugas') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_petugas`, `telp`, `username`, `password`, `level`, `created_at`, `updated_at`) VALUES
(1, 'Aulia', '081456788', 'aulia', '$2y$10$8beht9ttAZFkfBKc9yo7yuH8HhbwqsP0OywLufxOlQy/xdIY5Gr/.', 'petugas', '2020-02-17 23:03:19', '2020-02-17 23:03:19'),
(2, 'Aulia', '081456788', 'aulia', '$2y$10$4BSIQHAcOsDDVlzZ3zJgVuP.bIddcsI6XwyF2BZIpEIjSRJtUXjza', 'petugas', '2020-02-17 23:04:08', '2020-02-17 23:04:08'),
(3, 'Aulia', '081456788', 'aulia', '$2y$10$GXTsfNCx4hPbY9q88I/v4OhmKZDn0LLP7kBNuUQUvcqzWB8MsE7ZG', 'petugas', '2020-02-17 23:05:26', '2020-02-17 23:05:26'),
(4, 'Rizky', '08456789', 'rizky', '$2y$10$x/ga21R3cnHjqvO2ytzXCuf20twjDsCzc5s5vXskWxqALYQnYHq9i', 'admin', '2020-02-28 00:42:54', '2020-02-28 00:42:54'),
(5, 'Rizki', '08456789', 'rizki', '$2y$10$swQ63kv5L3oJmCM27mPOeeS6a3r.mhJhAAZ301F0kZAO9eCCqv5bq', 'admin', '2020-03-03 23:28:18', '2020-03-03 23:28:18');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `tgl_selesai` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_pelanggan`, `id_petugas`, `tgl_transaksi`, `tgl_selesai`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2020-02-19', '2020-02-21', '2020-02-18 23:36:59', '2020-02-18 23:36:59'),
(2, 2, 1, '2020-02-09', '2020-02-11', '2020-02-18 23:41:12', '2020-02-18 23:41:12'),
(3, 3, 1, '2020-02-27', '2020-03-01', '2020-02-28 00:18:07', '2020-02-28 00:18:07'),
(4, 3, 1, '2020-03-01', '2020-03-03', '2020-03-03 23:35:10', '2020-03-03 23:35:10'),
(5, 4, 1, '2020-03-23', '2020-03-26', '2020-03-22 23:32:45', '2020-03-22 23:35:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail`
--
ALTER TABLE `detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_jenis` (`id_jenis`);

--
-- Indexes for table `jeniscuci`
--
ALTER TABLE `jeniscuci`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail`
--
ALTER TABLE `detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jeniscuci`
--
ALTER TABLE `jeniscuci`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
