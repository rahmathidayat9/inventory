-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2023 at 05:47 PM
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
  `barang_deskripsi` varchar(100) DEFAULT NULL,
  `tanggal` varchar(100) DEFAULT NULL,
  `barang_stock` int(11) NOT NULL,
  `rak_id` varchar(100) NOT NULL,
  `jenis_barang_id` varchar(100) NOT NULL,
  `satuan_barang_id` varchar(100) NOT NULL,
  `supplier_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id` varchar(100) NOT NULL,
  `barang_id` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal` varchar(50) NOT NULL,
  `no_bulan` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `tanggal` varchar(50) NOT NULL,
  `no_bulan` varchar(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bulan_statis`
--

CREATE TABLE `bulan_statis` (
  `id` varchar(100) NOT NULL,
  `bulan` varchar(18) DEFAULT NULL,
  `no` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bulan_statis`
--

INSERT INTO `bulan_statis` (`id`, `bulan`, `no`) VALUES
('3bc174b8-d0b6-4ba2-9a73-6bf6c31e1994', 'Desember', 12),
('42538846-aced-4d31-8833-089b3ab87712', 'Januari', 1),
('4554214c-4201-468f-9bd1-724218d1c06d', 'November', 11),
('6bffe588-422a-45f0-9504-0e43a56ca982', 'Mei', 5),
('6e687795-a01c-4996-831a-d46c03796fa5', 'Februari', 2),
('8ce7b6fc-8d9e-4f49-82c3-32f3a7e231ef', 'Agustus', 8),
('976e1983-bddb-46b6-8fe8-dc5a19701408', 'Oktober', 10),
('99099db8-9b9c-4e0e-8fa1-4ecb9bdc5c3d', 'Juli', 7),
('9ec35e7b-5092-4673-adcd-e5d00aeae877', 'September', 9),
('a2f90dd6-3970-4fa9-9b0d-a250472caef2', 'Juni', 6),
('ac3ff406-644d-4296-b093-164bd058d372', 'Maret', 3),
('ef4a0449-e23b-4cff-b71e-eb3375b862b0', 'April', 4);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` varchar(100) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `customer_phone` varchar(15) DEFAULT NULL,
  `customer_email` varchar(50) DEFAULT NULL,
  `customer_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id` varchar(100) NOT NULL,
  `jenis` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id`, `jenis`) VALUES
('156b63be-97ff-4fba-958d-22c88ed1d62d', 'Mainan'),
('184430e2-43c1-4cd0-9a1d-33741ef11d47', 'Konsumsi'),
('34c30854-32d5-499e-b491-811f8de87ed5', 'Makanan'),
('81dac732-42f7-42ca-8a4b-95cac03bbbe0', 'Elektronik'),
('e09056c7-a208-46a5-b062-e82c547cb3ad', 'Pakaian'),
('e4ddb311-c8a3-4cc7-a661-4e40eade8e0f', 'Alat Tulis'),
('ff18ffc8-2eeb-4851-b3d4-d3955e635bf9', 'Kertas');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` varchar(100) NOT NULL,
  `rak_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `rak_name`) VALUES
('1a34ca03-875c-4a6e-b941-c256792d6746', 'RAK-003'),
('4c99e9c0-48d1-4e67-b735-2c3b5549ce82', 'RAK-001'),
('5272b21d-cc76-49a5-945e-4afd92522035', 'RAK-004'),
('ac8ce144-db4f-4abd-85c2-e5b48c5c31af', 'RAK-005'),
('ede50667-fd02-4428-aa8a-a6b6d21fa727', 'RAK-002');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` varchar(100) NOT NULL,
  `role` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
('7432022b-4120-4754-93a5-ff74a2ced0f3', 'petugas'),
('966dde03-c90e-42aa-b218-001a02c76385', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id` varchar(100) NOT NULL,
  `satuan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id`, `satuan`) VALUES
('2694c8a8-1551-45a9-945e-8f428905fdf5', 'Kg'),
('3051fbd0-836f-450d-b551-9ec6f5ec416f', 'Pack'),
('4a944200-3563-4de2-a00b-1f00cdc0336e', 'Pcs'),
('4b5808f7-a76f-4793-9a75-d3bb760b9d3e', 'Dus');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` varchar(100) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_email` varchar(100) DEFAULT NULL,
  `supplier_address` varchar(100) DEFAULT NULL,
  `supplier_phone` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `phone`, `role_id`) VALUES
('1ded8147-c4d1-487b-ad03-edaf134e380e', 'Sensei', 'sensei', '$2y$10$A/JCO1cOiC9H5pEj2rC5yu4MntCtKYcxaK7.3WVGjebDMrtVHAQza', '08576812432', '7432022b-4120-4754-93a5-ff74a2ced0f3'),
('3d6f0589-3ba8-441b-a842-9bebea6a3bd0', 'Sakamoto', 'petugas', '$2y$10$QhSGAupCJkDq6BIiIeRPyuTzWMl7doplgyfvUTw4.Uwm84SRebeOm', '082155901835', '7432022b-4120-4754-93a5-ff74a2ced0f3'),
('6bc19aff-b4bb-4d90-9de1-e4b5404f3f24', 'Vivy Diva', 'admin', '$2y$10$VTTXMjMOVy7tgRC970C3wuiMGpW330MfUXqA.9bhxbTY5OrT0xyS.', '085624804713', '966dde03-c90e-42aa-b218-001a02c76385');

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
