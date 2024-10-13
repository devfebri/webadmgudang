-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2024 at 03:26 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admgudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `no_surat` varchar(100) DEFAULT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `jml_barang` int(11) DEFAULT NULL,
  `file_surat` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id`, `item_id`, `no_surat`, `nama_supplier`, `nama_penerima`, `nama_pengirim`, `jml_barang`, `file_surat`, `status`, `created_at`, `updated_at`) VALUES
(2, 28, '2323', 'd2', '321321', '2121', 33, 'Screenshot 2024-10-13 183554.jpg-1728825732.jpg', NULL, '2024-10-13 13:22:12', '2024-10-13 06:22:12');

-- --------------------------------------------------------

--
-- Table structure for table `consumen`
--

CREATE TABLE `consumen` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consumen`
--

INSERT INTO `consumen` (`id`, `user_id`, `nama`, `nik`, `no_hp`, `jk`, `tgl_lahir`, `tmpt_lahir`, `alamat`, `created_at`, `updated_at`) VALUES
(11, 17, 'Leon', '233333', '08123', 'Laki-Laki', '2024-09-19', 'Jambi', 'test', '2024-09-29 11:23:29', '2024-09-29 04:23:29'),
(12, 18, 'adda', '123123', '1234', 'Laki-Laki', '2024-09-18', 'Jambi', 'dawad', '2024-09-29 13:50:09', '2024-09-29 06:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instalasi`
--

CREATE TABLE `instalasi` (
  `id` int(11) NOT NULL,
  `kode_instalasi` varchar(50) DEFAULT NULL,
  `teknisi_id` int(11) DEFAULT NULL,
  `consumen_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `harga_paket` varchar(100) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tgl_instalasi` date DEFAULT NULL,
  `nomor_internet` varchar(100) DEFAULT NULL,
  `layanan` varchar(15) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `jenis` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `supplier_id`, `nama`, `serial_number`, `type`, `stok`, `jenis`, `owner`, `status`, `created_at`, `updated_at`) VALUES
(28, NULL, 'FIBERHOME', NULL, 'ONT_FIBERHOME_HG6245N', 97, 'ONT', 'TELKOMSEL', 'Intech', '2024-10-13 12:21:11', '2024-10-13 06:24:56'),
(29, NULL, 'HUAWAI', NULL, 'ONT_HUAWEI_HG8145V5', 30, 'ONT', 'TELKOMSEL', 'Intech', '2024-10-13 12:22:13', '2024-10-13 05:22:13'),
(30, NULL, 'ZTE', NULL, 'ONT_ZTE_F670 V2.0', 50, 'ONT', 'TELKOMSEL', 'Intech', '2024-10-13 12:23:30', '2024-10-13 05:23:30'),
(31, NULL, 'FIBERHOME', NULL, 'SetTopBoxIPTV_FIBERHOME_HG680-P', 120, 'STB', 'TELKOMSEL', 'Intech', '2024-10-13 12:24:36', '2024-10-13 06:10:02');

-- --------------------------------------------------------

--
-- Table structure for table `item_supplier`
--

CREATE TABLE `item_supplier` (
  `id` int(11) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `item_supplier`
--

INSERT INTO `item_supplier` (`id`, `item_id`, `supplier_id`, `created_at`, `updated_at`) VALUES
(3, 28, 16, '2024-10-13 12:26:50', '2024-10-13 05:26:50'),
(4, 29, 16, '2024-10-13 12:26:50', '2024-10-13 05:26:50'),
(5, 31, 16, '2024-10-13 12:26:50', '2024-10-13 05:26:50'),
(6, 29, 17, '2024-10-13 13:02:11', '2024-10-13 06:02:11'),
(7, 30, 17, '2024-10-13 13:02:11', '2024-10-13 06:02:11'),
(8, 28, 18, '2024-10-13 13:03:20', '2024-10-13 06:03:20'),
(9, 31, 19, '2024-10-13 13:10:01', '2024-10-13 06:10:01'),
(10, 28, 20, '2024-10-13 13:24:56', '2024-10-13 06:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `id` int(11) NOT NULL,
  `nama_paket` varchar(100) DEFAULT NULL,
  `internet` varchar(30) DEFAULT NULL,
  `tv` varchar(30) DEFAULT NULL,
  `telpon` varchar(30) DEFAULT NULL,
  `harga` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`id`, `nama_paket`, `internet`, `tv`, `telpon`, `harga`, `created_at`, `updated_at`) VALUES
(2, 'PAKET HEMAT INTERNET + TELPON', '30 mbps', '-', 'Kesemua Telkomsem', '250000', '2024-09-01 06:55:00', '2024-08-31 23:55:00'),
(3, 'PAKET FAST INTERNET', '100 Mbps', '100+ chanel', '1000 menit', '500000', '2024-09-01 06:58:08', '2024-08-31 23:58:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pimpinan`
--

CREATE TABLE `pimpinan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nik` varchar(20) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tmpt_lahir` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pimpinan`
--

INSERT INTO `pimpinan` (`id`, `user_id`, `nama`, `nik`, `no_hp`, `jk`, `tgl_lahir`, `tmpt_lahir`, `alamat`, `created_at`, `updated_at`) VALUES
(2, 20, 'Febri', '12403030', '0999', 'Laki-Laki', '2024-10-11', '221312', 'dwada', '2024-10-12 08:39:46', '2024-10-12 01:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `no_surat` varchar(20) DEFAULT NULL,
  `nama_supplier` varchar(100) DEFAULT NULL,
  `nama_penerima` varchar(100) DEFAULT NULL,
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `jml_barang` int(11) DEFAULT NULL,
  `file_surat` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `no_surat`, `nama_supplier`, `nama_penerima`, `nama_pengirim`, `jml_barang`, `file_surat`, `status`, `created_at`, `updated_at`) VALUES
(16, 'se122121', 'TELKOMSEL', 'Budiman', 'Samsul', 10, 'Screenshot 2024-10-13 183554.jpg-1728822410.jpg', 1, '2024-10-13 12:26:50', '2024-10-13 05:26:50'),
(17, 'KC2032', 'Budiman', 'Febri', 'Sukiman', 20, 'Screenshot 2024-10-13 183554.jpg-1728824531.jpg', 1, '2024-10-13 13:02:11', '2024-10-13 06:02:11'),
(18, 'dadaw', 'dwadwa', 'dwadwa', 'dwadwa', 100, 'Screenshot 2024-10-13 183554.jpg-1728824600.jpg', 1, '2024-10-13 13:03:20', '2024-10-13 06:03:20'),
(19, 'KC2032', 'TELKOMSEL', 'adwadwa', '213', 100, 'Screenshot 2024-10-13 183554.jpg-1728825001.jpg', 1, '2024-10-13 13:10:01', '2024-10-13 06:10:01'),
(20, 'se122121', 'dwadaw', '2131', '232', 100, 'Screenshot 2024-10-13 183554.jpg-1728825896.jpg', 1, '2024-10-13 13:24:56', '2024-10-13 06:24:56');

-- --------------------------------------------------------

--
-- Table structure for table `teknisi`
--

CREATE TABLE `teknisi` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `no_hp` varchar(13) DEFAULT NULL,
  `jk` varchar(10) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `tmpt_lahir` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teknisi`
--

INSERT INTO `teknisi` (`id`, `user_id`, `nama`, `nik`, `no_hp`, `jk`, `tgl_lahir`, `tmpt_lahir`, `alamat`, `created_at`, `updated_at`) VALUES
(13, 15, 'Febriss', '1505012002000003', '085266911477', 'Laki-Laki', '2024-09-18', 'jambi', 'sd', '2024-09-29 08:11:31', '2024-10-10 08:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `avatar` text DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `email_verified_at`, `password`, `role`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin@admin.com', NULL, '$2y$10$V2zDWC67Cj9eNPSH13Rl8uIMs7XCbNSHz5ozsZm2uPnODiVIWHI7.', 'admin', NULL, NULL, '2024-07-21 07:37:43', '2024-07-21 07:37:43'),
(15, '085266911477', 'Febriss', NULL, NULL, '$2y$10$abN1t3xIUmaD58WD.No8NOVa8ZxQQEcxKO054/cMMOrqoGAK/CJgO', 'teknisi', NULL, NULL, '2024-09-29 01:11:31', '2024-10-10 08:13:08'),
(17, '08123', 'Leon', NULL, NULL, '$2y$10$eQA0SXKJSGfc/lhppoQAB.v0rRFTFwxhpoQcnEy9NetHq3Tv6sVt.', 'consumen', NULL, NULL, '2024-09-29 04:23:29', '2024-09-29 04:23:29'),
(18, '1234', 'adda', NULL, NULL, '$2y$10$y7pr2oQgkOrLwEhE1QAp7.O183FjG5Bgts6GSZERTfDz/W2s.7w6q', 'consumen', NULL, NULL, '2024-09-29 06:50:09', '2024-09-29 06:50:09'),
(20, '0999', 'Febri', NULL, NULL, '$2y$10$KjRWT0TvSRs2NuYd9vOlGOcQ4RbP9NWsMFAa8p9F7gGtjbxiE2fE.', 'pimpinan', NULL, NULL, '2024-10-12 01:39:46', '2024-10-12 01:39:46');

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `id` int(11) NOT NULL,
  `instalasi_id` int(11) DEFAULT NULL,
  `teknisi_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `nomor_wo` varchar(20) DEFAULT '0',
  `jenis_wo` varchar(100) DEFAULT NULL,
  `pesan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consumen`
--
ALTER TABLE `consumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instalasi`
--
ALTER TABLE `instalasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item_supplier`
--
ALTER TABLE `item_supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teknisi`
--
ALTER TABLE `teknisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `consumen`
--
ALTER TABLE `consumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instalasi`
--
ALTER TABLE `instalasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `item_supplier`
--
ALTER TABLE `item_supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pimpinan`
--
ALTER TABLE `pimpinan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teknisi`
--
ALTER TABLE `teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `work_order`
--
ALTER TABLE `work_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
