-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2023 at 03:24 AM
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
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` varchar(100) NOT NULL,
  `barang_code` varchar(100) NOT NULL,
  `barang_name` varchar(100) NOT NULL,
  `barang_deskripsi` varchar(100) NOT NULL,
  `barang_stock` int(11) NOT NULL,
  `tanggal` text DEFAULT NULL,
  `rak_id` varchar(100) NOT NULL,
  `jenis_barang_id` varchar(100) NOT NULL,
  `satuan_barang_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` varchar(100) NOT NULL,
  `barang_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` varchar(25) NOT NULL,
  `no_bulan` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuk`
--

CREATE TABLE `barang_masuk` (
  `id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL,
  `barang_id` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `tanggal` varchar(25) NOT NULL,
  `no_bulan` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bulan_statis`
--

CREATE TABLE `bulan_statis` (
  `id` varchar(100) NOT NULL,
  `bulan` varchar(18) DEFAULT NULL,
  `no` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `bulan_statis`
--

INSERT INTO `bulan_statis` (`id`, `bulan`, `no`) VALUES
('15438512-de28-421c-9116-ee9b67a15b94', 'Agustus', 8),
('29596d6c-f9c0-42cf-860c-196b16f33d2a', 'Februari', 2),
('3951e17e-2aaa-4bde-90b4-004ac9f74205', 'November', 11),
('4923cffb-ecb5-4e59-a261-c8d4addf2bca', 'Januari', 1),
('56fb55ce-2fc4-4209-9ac1-f7aa45f34dab', 'Mei', 5),
('59f00d56-3341-4b61-a2b3-ba4466e52ff7', 'April', 4),
('692fbc22-8ff9-4673-90f2-30c5321d9431', 'Desember', 12),
('7655b9c0-87ab-4d82-9ad5-39d5ecf585bb', 'Juni', 6),
('a7759bc0-1214-4b74-98e6-a3542318bfee', 'Maret', 3),
('ace28df1-9fe8-4db1-97e4-d6e51d929668', 'September', 9),
('e5df56b9-39c9-4054-a2ef-65f86489b4c8', 'Oktober', 10),
('e7babd17-8a31-4736-b676-581a3482a2f2', 'Juli', 7);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_email` varchar(100) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `customer_phone` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2023-01-22-165020', 'App\\Database\\Migrations\\User', 'default', 'App', 1674407957, 1),
(2, '2023-01-22-165434', 'App\\Database\\Migrations\\Role', 'default', 'App', 1674407957, 1),
(3, '2023-01-22-165558', 'App\\Database\\Migrations\\Supplier', 'default', 'App', 1674407957, 1),
(4, '2023-01-22-165755', 'App\\Database\\Migrations\\Customer', 'default', 'App', 1674407957, 1),
(5, '2023-01-22-165932', 'App\\Database\\Migrations\\Bulan', 'default', 'App', 1674407958, 1),
(6, '2023-01-22-170112', 'App\\Database\\Migrations\\SatuanBarang', 'default', 'App', 1674407958, 1),
(7, '2023-01-22-170202', 'App\\Database\\Migrations\\Rak', 'default', 'App', 1674407958, 1),
(8, '2023-01-22-170316', 'App\\Database\\Migrations\\JenisBarang', 'default', 'App', 1674407958, 1),
(9, '2023-01-22-170401', 'App\\Database\\Migrations\\BarangMasuk', 'default', 'App', 1674407959, 1),
(10, '2023-01-22-170734', 'App\\Database\\Migrations\\BarangKeluar', 'default', 'App', 1674407959, 1),
(11, '2023-01-22-171042', 'App\\Database\\Migrations\\Barang', 'default', 'App', 1674407959, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` varchar(100) NOT NULL,
  `rak_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
('29a3e981-4adf-4cb0-8bd9-8956c291c4d9', 'admin'),
('afe5c0e9-97c4-49bd-87a9-0a5d962eeef0', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_email` varchar(100) DEFAULT NULL,
  `supplier_address` text DEFAULT NULL,
  `supplier_phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `role_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `role_id`) VALUES
('1e3848c5-384d-4fd2-b0cd-6bb35b8792fa', 'Sensei', 'sensei', '$2y$10$qIr1nYDps3nO7GYKdrT7VuzxPYiU8oV9fI6PvSXuxveE83xGjbeGS', '082155901835', 'afe5c0e9-97c4-49bd-87a9-0a5d962eeef0'),
('3591e77a-0f6d-484f-8fcb-c9d3cf57012e', 'Hotaru Ichijou', 'hotaru', '$2y$10$n3H7T4fM.aEPW4ZN.w27TeFRsaufkZ5DiSFNsoLZ3.qqe9Ee5uQWK', '085624804713', '29a3e981-4adf-4cb0-8bd9-8956c291c4d9'),
('3a88e068-8d05-46bb-94c7-aeba06feb718', 'Sakamoto', 'petugas', '$2y$10$OwlHXdFJI5f/cA1PXMsl9OYO4jLXfZxr/UGs77jiZWz9CmVlt9HAu', '082155901835', 'afe5c0e9-97c4-49bd-87a9-0a5d962eeef0'),
('e42313ff-efa4-482d-94bd-e0aa4f687820', 'Vivy Diva', 'admin', '$2y$10$QP8v51jomcEFuMw2NwOCHeWSooE2.i1CjMNNGRejXrFw3AxAtqG0C', '085624804713', '29a3e981-4adf-4cb0-8bd9-8956c291c4d9');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `barang_masuk`
--
ALTER TABLE `barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulan_statis`
--
ALTER TABLE `bulan_statis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
