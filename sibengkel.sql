-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2020 at 01:28 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sibengkel`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(30) NOT NULL,
  `kode_merk` varchar(3) NOT NULL,
  `kode_satuan` varchar(3) NOT NULL,
  `kode_jenis` varchar(3) NOT NULL,
  `nama_barang` varchar(50) NOT NULL,
  `stock` int(5) NOT NULL,
  `stock_limit` int(5) NOT NULL,
  `harga_pokok` int(10) NOT NULL,
  `harga_jual` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `kode_merk`, `kode_satuan`, `kode_jenis`, `nama_barang`, `stock`, `stock_limit`, `harga_pokok`, `harga_jual`) VALUES
('B0001', 'M02', 'S02', 'J01', 'Swallows', 80, 100, 70000, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `kode_customer` char(10) NOT NULL,
  `nama_customer` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`kode_customer`, `nama_customer`, `alamat`, `no_telp`) VALUES
('K0001', 'Erik', 'Jember', '08981231212'),
('K0002', 'Umum', '-', '-');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penggajian`
--

CREATE TABLE `detail_penggajian` (
  `kode_detail_penggajian` int(8) NOT NULL,
  `kode_pegawai` char(5) NOT NULL,
  `lama_kerja` int(3) NOT NULL,
  `lama_lembur` int(3) NOT NULL,
  `total_gaji` int(10) NOT NULL,
  `tanggal_penggajian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penggajian_m`
--

CREATE TABLE `detail_penggajian_m` (
  `kode_detail_pm` int(8) NOT NULL,
  `kode_mekanik` char(5) NOT NULL,
  `lama_kerja` int(3) NOT NULL,
  `lama_lembur` int(3) NOT NULL,
  `total_gaji` int(10) NOT NULL,
  `tanggal_penggajian` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_barang`
--

CREATE TABLE `detail_penjualan_barang` (
  `kode_detail_pb` int(11) NOT NULL,
  `no_faktur_penjualan` char(10) NOT NULL,
  `kode_barang` char(5) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `sub_total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan_barang`
--

INSERT INTO `detail_penjualan_barang` (`kode_detail_pb`, `no_faktur_penjualan`, `kode_barang`, `jumlah_barang`, `sub_total_harga`) VALUES
(22, 'FK000001', 'B0001', 10, 800000),
(23, 'FK000002', 'B0001', 1, 80000);

-- --------------------------------------------------------

--
-- Table structure for table `detail_penjualan_service`
--

CREATE TABLE `detail_penjualan_service` (
  `kode_detail_ps` int(11) NOT NULL,
  `kode_wo` char(10) NOT NULL,
  `kode_service` char(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_penjualan_service`
--

INSERT INTO `detail_penjualan_service` (`kode_detail_ps`, `kode_wo`, `kode_service`) VALUES
(11, 'WO0001', 'SV01');

-- --------------------------------------------------------

--
-- Table structure for table `detail_permintaan`
--

CREATE TABLE `detail_permintaan` (
  `kode_detail_permintaan` int(8) NOT NULL,
  `kode_permintaan` char(8) NOT NULL,
  `kode_barang` varchar(30) NOT NULL,
  `jumlah_barang` smallint(5) NOT NULL,
  `sub_total_harga` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_permintaan`
--

INSERT INTO `detail_permintaan` (`kode_detail_permintaan`, `kode_permintaan`, `kode_barang`, `jumlah_barang`, `sub_total_harga`) VALUES
(19, 'PB000001', 'B0001', 22, 1540000),
(20, 'PB000001', 'B0001', 11, 770000);

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `kode_jenis` varchar(3) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`kode_jenis`, `nama_jenis`) VALUES
('J01', 'Ban luar');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pegawai`
--

CREATE TABLE `jenis_pegawai` (
  `kode_jenis_p` char(4) NOT NULL,
  `nama_jenis_p` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_pegawai`
--

INSERT INTO `jenis_pegawai` (`kode_jenis_p`, `nama_jenis_p`) VALUES
('JP01', 'Admin'),
('JP02', 'Kasir'),
('JP03', 'Gudang'),
('JP04', 'Cs');

-- --------------------------------------------------------

--
-- Table structure for table `kendaraan`
--

CREATE TABLE `kendaraan` (
  `no_plat` char(10) NOT NULL,
  `nama_kendaraan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kendaraan`
--

INSERT INTO `kendaraan` (`no_plat`, `nama_kendaraan`) VALUES
('P 8728 UX', 'Kijang 2003');

-- --------------------------------------------------------

--
-- Table structure for table `mekanik`
--

CREATE TABLE `mekanik` (
  `kode_mekanik` char(5) NOT NULL,
  `nama_mekanik` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mekanik`
--

INSERT INTO `mekanik` (`kode_mekanik`, `nama_mekanik`, `alamat`, `no_telp`) VALUES
('MK001', 'Supriyadi', 'Lumajang', '08922235462');

-- --------------------------------------------------------

--
-- Table structure for table `merk`
--

CREATE TABLE `merk` (
  `kode_merk` varchar(3) NOT NULL,
  `nama_merk` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `merk`
--

INSERT INTO `merk` (`kode_merk`, `nama_merk`) VALUES
('M01', 'Yamaha'),
('M02', 'Honda'),
('M03', 'Banluar');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `kode_pegawai` char(5) NOT NULL,
  `kode_jenis_p` char(4) NOT NULL,
  `nama_pegawai` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `no_telp` varchar(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` char(60) NOT NULL,
  `status_login` char(1) NOT NULL,
  `session_id` varchar(26) NOT NULL DEFAULT 'kosong',
  `last_login` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`kode_pegawai`, `kode_jenis_p`, `nama_pegawai`, `alamat`, `no_telp`, `username`, `password`, `status_login`, `session_id`, `last_login`) VALUES
('PG001', 'JP01', 'Admin', 'Jember', '0897986985695', 'admin', '$2y$10$7iu93OUOh4eMeBiaj6TNlukLcWpXVFxlAv0X5nj2BtCmvOc6eTRC6', '1', 'mbtprcqui9k91l95o8arge5tt4', '2020-08-13 23:27:38'),
('PG002', 'JP03', 'Gudang', 'Lumajang', '08982827293', 'gudang', '$2y$10$rl/E1tukpYN08rQkvOdVNefLlBO/IMM2QXvRhJuPTmRdUkf4.WNXm', '0', '', '0000-00-00 00:00:00'),
('PG003', 'JP02', 'Kasir', 'Asdasda123', '0897765674', 'kasir', '$2y$10$rcBpHopudMljVRA3tadU6.tRhe638.VM/Renbbq4tOwNgLg/LwF5y', '0', 'kosong', '2019-08-29 09:57:19'),
('PG004', 'JP04', 'Cs', 'Bondowoso', '08362763728', 'cs', '$2y$10$UIRnus12hxGWHsrIpDU2OOAMpCDyX15qXVFxcmHzYPqSdGvlWQzvS', '0', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `no_faktur_pembelian` char(9) NOT NULL,
  `kode_pegawai` char(5) NOT NULL,
  `kode_suplier` char(4) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `sub_total` int(10) NOT NULL,
  `potongan` int(10) NOT NULL,
  `total_harga` int(10) NOT NULL,
  `bayar` int(10) NOT NULL,
  `kembalian` int(10) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`no_faktur_pembelian`, `kode_pegawai`, `kode_suplier`, `tgl_transaksi`, `sub_total`, `potongan`, `total_harga`, `bayar`, `kembalian`, `status`) VALUES
('NFP000001', 'PG003', 'S001', '2019-08-27 14:43:15', 2310000, 0, 2310000, 9000000, 6690000, '1');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `no_faktur_penjualan` char(10) NOT NULL,
  `kode_customer` char(10) NOT NULL,
  `kode_pegawai` char(5) NOT NULL,
  `tgl_transaksi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total_harga` int(11) NOT NULL,
  `potongan_harga` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `status` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`no_faktur_penjualan`, `kode_customer`, `kode_pegawai`, `tgl_transaksi`, `total_harga`, `potongan_harga`, `bayar`, `kembalian`, `status`) VALUES
('FK000001', 'K0002', 'PG003', '2019-08-27 14:18:25', 800000, 0, 900, 0, '0'),
('FK000002', 'K0001', 'PG003', '2019-08-27 14:24:08', 170000, 0, 20000, 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_wo`
--

CREATE TABLE `penjualan_wo` (
  `id_detail_service` int(11) NOT NULL,
  `no_faktur_penjualan` varchar(10) NOT NULL,
  `kode_wo` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penjualan_wo`
--

INSERT INTO `penjualan_wo` (`id_detail_service`, `no_faktur_penjualan`, `kode_wo`) VALUES
(6, 'FK000002', 'WO0001');

-- --------------------------------------------------------

--
-- Table structure for table `permintaan_barang`
--

CREATE TABLE `permintaan_barang` (
  `kode_permintaan` char(8) NOT NULL,
  `tgl_permintaan` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permintaan_barang`
--

INSERT INTO `permintaan_barang` (`kode_permintaan`, `tgl_permintaan`, `status`) VALUES
('PB000001', '2019-08-27 14:06:15', '1');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `kode_po` int(8) NOT NULL,
  `no_faktur_pembelian` char(9) NOT NULL,
  `kode_permintaan` char(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`kode_po`, `no_faktur_pembelian`, `kode_permintaan`) VALUES
(8, 'NFP000001', 'PB000001');

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `kode_satuan` varchar(3) NOT NULL,
  `nama_satuan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`kode_satuan`, `nama_satuan`) VALUES
('S01', 'Pcs'),
('S02', 'Lusin');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `kode_service` varchar(5) NOT NULL,
  `nama_service` varchar(30) NOT NULL,
  `tarif_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`kode_service`, `nama_service`, `tarif_harga`) VALUES
('SV01', 'Ganti ban', 90000);

-- --------------------------------------------------------

--
-- Table structure for table `suplier`
--

CREATE TABLE `suplier` (
  `kode_suplier` char(4) NOT NULL,
  `nama_suplier` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `kontak_person` text NOT NULL,
  `telp` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suplier`
--

INSERT INTO `suplier` (`kode_suplier`, `nama_suplier`, `alamat`, `kontak_person`, `telp`) VALUES
('S001', 'Wings', 'Jember', 'wing@gmail.com', '0897985875');

-- --------------------------------------------------------

--
-- Table structure for table `work_order`
--

CREATE TABLE `work_order` (
  `kode_wo` char(10) NOT NULL,
  `kode_customer` char(5) NOT NULL,
  `no_plat` char(10) NOT NULL,
  `kode_mekanik` char(5) NOT NULL,
  `tgl_wo` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_wo` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `work_order`
--

INSERT INTO `work_order` (`kode_wo`, `kode_customer`, `no_plat`, `kode_mekanik`, `tgl_wo`, `status_wo`) VALUES
('WO0001', 'K0001', 'P 8728 UX', 'MK001', '2019-08-27 14:24:09', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`kode_customer`);

--
-- Indexes for table `detail_penggajian`
--
ALTER TABLE `detail_penggajian`
  ADD PRIMARY KEY (`kode_detail_penggajian`);

--
-- Indexes for table `detail_penggajian_m`
--
ALTER TABLE `detail_penggajian_m`
  ADD PRIMARY KEY (`kode_detail_pm`);

--
-- Indexes for table `detail_penjualan_barang`
--
ALTER TABLE `detail_penjualan_barang`
  ADD PRIMARY KEY (`kode_detail_pb`);

--
-- Indexes for table `detail_penjualan_service`
--
ALTER TABLE `detail_penjualan_service`
  ADD PRIMARY KEY (`kode_detail_ps`);

--
-- Indexes for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  ADD PRIMARY KEY (`kode_detail_permintaan`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `jenis_pegawai`
--
ALTER TABLE `jenis_pegawai`
  ADD PRIMARY KEY (`kode_jenis_p`);

--
-- Indexes for table `kendaraan`
--
ALTER TABLE `kendaraan`
  ADD PRIMARY KEY (`no_plat`);

--
-- Indexes for table `mekanik`
--
ALTER TABLE `mekanik`
  ADD PRIMARY KEY (`kode_mekanik`);

--
-- Indexes for table `merk`
--
ALTER TABLE `merk`
  ADD PRIMARY KEY (`kode_merk`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`kode_pegawai`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`no_faktur_pembelian`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`no_faktur_penjualan`);

--
-- Indexes for table `penjualan_wo`
--
ALTER TABLE `penjualan_wo`
  ADD PRIMARY KEY (`id_detail_service`);

--
-- Indexes for table `permintaan_barang`
--
ALTER TABLE `permintaan_barang`
  ADD PRIMARY KEY (`kode_permintaan`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`kode_po`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`kode_satuan`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`kode_service`);

--
-- Indexes for table `suplier`
--
ALTER TABLE `suplier`
  ADD PRIMARY KEY (`kode_suplier`);

--
-- Indexes for table `work_order`
--
ALTER TABLE `work_order`
  ADD PRIMARY KEY (`kode_wo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_penggajian`
--
ALTER TABLE `detail_penggajian`
  MODIFY `kode_detail_penggajian` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_penggajian_m`
--
ALTER TABLE `detail_penggajian_m`
  MODIFY `kode_detail_pm` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_penjualan_barang`
--
ALTER TABLE `detail_penjualan_barang`
  MODIFY `kode_detail_pb` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `detail_penjualan_service`
--
ALTER TABLE `detail_penjualan_service`
  MODIFY `kode_detail_ps` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_permintaan`
--
ALTER TABLE `detail_permintaan`
  MODIFY `kode_detail_permintaan` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `penjualan_wo`
--
ALTER TABLE `penjualan_wo`
  MODIFY `id_detail_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `kode_po` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
