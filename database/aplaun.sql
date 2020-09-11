-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 11, 2020 at 05:45 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `aplaun`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` varchar(255) NOT NULL,
  `order_user` int(10) NOT NULL,
  `order_paket` int(10) NOT NULL,
  `order_pelanggan` int(10) NOT NULL,
  `order_tglmulai` date NOT NULL,
  `order_tglselesai` date NOT NULL,
  `order_biayatambahan` int(20) DEFAULT NULL,
  `order_diskon` int(10) DEFAULT NULL,
  `order_status` enum('Baru','Proses','Selesai','Diambil') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_user`, `order_paket`, `order_pelanggan`, `order_tglmulai`, `order_tglselesai`, `order_biayatambahan`, `order_diskon`, `order_status`) VALUES
('CIL202009061530', 3, 4, 2, '2020-09-06', '2020-09-16', 5000, 9, 'Baru'),
('CIL202009064003', 3, 4, 4, '2020-09-06', '2020-09-11', 0, 0, 'Selesai'),
('CIL202009071725', 3, 4, 4, '2020-09-07', '2020-09-09', 0, 0, 'Selesai'),
('CIL202009080219', 3, 4, 4, '2020-09-08', '2020-09-09', 0, 0, 'Baru'),
('CIL202009080911', 3, 8, 8, '2020-09-08', '2020-09-10', 0, 0, 'Baru'),
('CIL202009083901', 5, 6, 7, '2020-09-08', '2020-09-12', 10000, 10, 'Selesai'),
('CIL202009105041', 3, 6, 10, '2020-09-10', '2020-09-15', 10000, 0, 'Baru');

--
-- Triggers `orders`
--
DELIMITER $$
CREATE TRIGGER `orders_delete_transaksi` AFTER DELETE ON `orders` FOR EACH ROW DELETE FROM transaksi WHERE transaksi.transaksi_order = old.order_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `outlet`
--

CREATE TABLE `outlet` (
  `outlet_id` int(10) NOT NULL,
  `outlet_nama` varchar(140) NOT NULL,
  `outlet_email` varchar(140) NOT NULL,
  `outlet_notelp` varchar(16) NOT NULL,
  `outlet_alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `outlet`
--

INSERT INTO `outlet` (`outlet_id`, `outlet_nama`, `outlet_email`, `outlet_notelp`, `outlet_alamat`) VALUES
(5, 'Outlet Yogyakarta', 'Yogyakarta@yogyakarta.com', '08239238232323', 'Yogyakarta'),
(6, 'Outlet Kulon Progo', 'kulprog@gmail.com', '087346348734', 'Kulon Progo'),
(8, 'Outlet Bantul', 'bantul@gmail.com', '0837436437643', 'Bantul'),
(9, 'Outlet Sleman', 'sleman@gmail.com', '08874327555555', 'Sleman');

--
-- Triggers `outlet`
--
DELIMITER $$
CREATE TRIGGER `outlet_delete_paket` AFTER DELETE ON `outlet` FOR EACH ROW DELETE FROM paket WHERE paket.paket_outlet = old.outlet_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `outlet_delete_pelanggan` AFTER DELETE ON `outlet` FOR EACH ROW DELETE FROM pelanggan WHERE pelanggan.pelanggan_outlet = old.outlet_id
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `outlet_delete_user` AFTER DELETE ON `outlet` FOR EACH ROW DELETE FROM user WHERE user.user_outlet = old.outlet_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `paket`
--

CREATE TABLE `paket` (
  `paket_id` int(10) NOT NULL,
  `paket_nama` varchar(140) NOT NULL,
  `paket_outlet` int(10) NOT NULL,
  `paket_jenis` varchar(255) NOT NULL,
  `paket_tarif` int(255) NOT NULL,
  `paket_ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paket`
--

INSERT INTO `paket` (`paket_id`, `paket_nama`, `paket_outlet`, `paket_jenis`, `paket_tarif`, `paket_ket`) VALUES
(6, 'Paket Dry Clean', 5, 'Kiloan', 20000, ''),
(10, 'Paket Komplit', 8, 'Kiloan', 65000, '');

--
-- Triggers `paket`
--
DELIMITER $$
CREATE TRIGGER `paket_delete_transaksi` AFTER DELETE ON `paket` FOR EACH ROW DELETE FROM transaksi WHERE transaksi.transaksi_paket = old.paket_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `pelanggan_id` int(10) NOT NULL,
  `pelanggan_noktp` varchar(30) NOT NULL,
  `pelanggan_nama` varchar(140) NOT NULL,
  `pelanggan_email` varchar(140) NOT NULL,
  `pelanggan_notelp` varchar(16) NOT NULL,
  `pelanggan_jk` enum('L','P') NOT NULL,
  `pelanggan_outlet` int(10) NOT NULL,
  `pelanggan_alamat` text NOT NULL,
  `pelanggan_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`pelanggan_id`, `pelanggan_noktp`, `pelanggan_nama`, `pelanggan_email`, `pelanggan_notelp`, `pelanggan_jk`, `pelanggan_outlet`, `pelanggan_alamat`, `pelanggan_created`) VALUES
(6, '934383933', 'Ihsan', 'ihsan@gmail.com', '082323621', 'L', 5, 'Bantul', '2020-09-10 20:26:24'),
(7, '9348348', 'Hadi', 'hadi@gmail.com', '08329423743', 'L', 5, 'Sewon', '2020-09-02 20:26:39'),
(8, '093483432', 'Anna', 'anna@gmail.com', '0823273241', 'P', 5, 'Sewon', '2020-09-02 20:26:47'),
(10, '453987834783434', 'Ammar', 'ammar@gmail.com', '089436273423', 'L', 5, 'Kasihan', '2020-09-08 20:26:57'),
(11, '64656348723873', 'Hanif', 'hanif@gmail.com', '0838434762324', 'L', 5, 'Yogyakarta', '2020-09-07 20:27:02'),
(13, '3333333333', 'xxxxx', 'xxxxx@xxx.xx', '0882277232', 'P', 6, 'sasd', '2020-09-10 20:25:31'),
(14, '983638374345454', 'Zakir SS', 'zakir@gmail.com', '083628362362', 'L', 8, 'Sewon', '2020-09-10 21:45:00');

--
-- Triggers `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `pelanggan_delete_orders` AFTER DELETE ON `pelanggan` FOR EACH ROW DELETE FROM orders WHERE orders.order_pelanggan = old.pelanggan_id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `transaksi_id` int(10) NOT NULL,
  `transaksi_order` varchar(255) NOT NULL,
  `transaksi_paket` int(10) NOT NULL,
  `transaksi_qty` int(10) NOT NULL,
  `transaksi_totalbiaya` float NOT NULL,
  `transaksi_totalbayar` int(20) DEFAULT NULL,
  `transaksi_tglbayar` date DEFAULT NULL,
  `transaksi_status` enum('Belum','Terbayar') NOT NULL,
  `transaksi_ket` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`transaksi_id`, `transaksi_order`, `transaksi_paket`, `transaksi_qty`, `transaksi_totalbiaya`, `transaksi_totalbayar`, `transaksi_tglbayar`, `transaksi_status`, `transaksi_ket`) VALUES
(8, 'CIL202009083901', 6, 9, 90000, 90000, '2020-09-08', 'Terbayar', ''),
(9, 'CIL202009105041', 6, 9, 190000, 190000, '2020-09-11', 'Terbayar', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `user_nama` varchar(140) NOT NULL,
  `user_uname` varchar(140) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_notelp` varchar(16) NOT NULL,
  `user_email` varchar(140) NOT NULL,
  `user_outlet` int(10) DEFAULT NULL,
  `user_level` enum('admin','kasir','owner') NOT NULL,
  `user_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_uname`, `user_pass`, `user_notelp`, `user_email`, `user_outlet`, `user_level`, `user_created`) VALUES
(3, 'Admin', 'admin', '$2y$10$2NWZljsrV5xsXbUJqR9LKO5R68D/yUDsVpLndVgwYDFOOeQUQUKi2', '0888888887', 'admin@admin.com', NULL, 'admin', '2020-09-03 21:22:59'),
(4, 'Owner', 'owner', '$2y$10$rYhmgy2aU2mnm0z/8dNuROZJozVVObvSIIiOgX7r.5vOvQHpy.lki', '0811133312220', 'owner@owner.com', 5, 'owner', '2020-09-04 21:23:13'),
(5, 'Kasir', 'kasir', '$2y$10$oGq5xxQThIf.V/1lTDHmHews9Sn8qadqr.ZTIDb5tjzH2EnArtbzO', '082763263', 'kasir@kasir.com', 5, 'kasir', '2020-09-05 21:23:18'),
(8, 'Marya', 'marya', '$2y$10$DsmK1AgKVHo/b7DaFDIB/uMJwR3rQ9RcEyFM2TcxI7l0XoKZakVj.', '083473421111133', 'marya@gmail.com', 8, 'owner', '2020-09-06 21:23:21'),
(9, 'Ron', 'ron', '$2y$10$/OHdjBBK1k.ac1.rJJ/5d.OBQZAD4.pcSIfSGh8tluFVO175Rc/re', '08437348754', 'ron@gmail.com', 8, 'kasir', '2020-09-07 21:23:25'),
(10, 'nina', 'nina', '$2y$10$uFAFKXuYGDAH9bDUnkv8Q.GT0fNhnZZBtXNHnfCMWGBiJKv8ySdyW', '085434234', 'nina@gmail.com', 6, 'owner', '2020-09-08 21:23:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `order_paket` (`order_paket`),
  ADD KEY `order_user` (`order_user`);

--
-- Indexes for table `outlet`
--
ALTER TABLE `outlet`
  ADD PRIMARY KEY (`outlet_id`);

--
-- Indexes for table `paket`
--
ALTER TABLE `paket`
  ADD PRIMARY KEY (`paket_id`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`pelanggan_id`),
  ADD KEY `pelanggan_outlet` (`pelanggan_outlet`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`transaksi_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `outlet`
--
ALTER TABLE `outlet`
  MODIFY `outlet_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `paket`
--
ALTER TABLE `paket`
  MODIFY `paket_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `pelanggan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `transaksi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
