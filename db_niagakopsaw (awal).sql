-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Jul 2024 pada 04.28
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_niagakopsaw`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `merk` varchar(255) NOT NULL,
  `harga_beli` varchar(255) NOT NULL,
  `harga_jual` varchar(255) NOT NULL,
  `satuan_barang` varchar(255) NOT NULL,
  `stok` text NOT NULL,
  `tgl_input` varchar(255) NOT NULL,
  `tgl_update` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `id_barang`, `id_kategori`, `id_satuan`, `nama_barang`, `merk`, `harga_beli`, `harga_jual`, `satuan_barang`, `stok`, `tgl_input`, `tgl_update`) VALUES
(10, 'BR001', 6, 14, 'ciki', '', '800', '1500', '14', '1', '13 May 2024, 12:54', '16 May 2024, 10:03'),
(11, 'BR002', 5, 14, 'Lux', '', '3000', '4000', '14', '11', '13 May 2024, 14:40', '16 May 2024, 16:22'),
(12, 'BR003', 5, 14, 'qwe', '', '123', '123', '14', '103', '14 May 2024, 8:00', NULL),
(13, 'BR004', 11, 13, 'Coba', '', '2000', '5000', '13', '14', '29 May 2024, 12:08', NULL),
(14, 'BR005', 5, 14, 'febi', '', '1000', '2000', '14', '18', '20 June 2024, 7:04', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `statusdata` enum('AKTIF','TIDAK') DEFAULT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `statusdata`, `waktudata`) VALUES
(5, 'Sabun', NULL, '2024-04-17 21:31:57'),
(6, 'Jajanan/Makanan Ringan', NULL, '2024-04-18 21:32:01'),
(7, 'Minuman', NULL, '2024-04-21 21:32:05'),
(9, 'Makanan Berat', 'AKTIF', '2024-04-22 21:33:53'),
(11, 'Lain-Lain', 'AKTIF', '2024-05-06 09:16:06'),
(12, 'Rokok', 'AKTIF', '2024-05-06 09:20:22'),
(13, 'ATK', 'AKTIF', '2024-05-30 00:30:26');

-- --------------------------------------------------------

--
-- Struktur dari tabel `ksw_pelanggan`
--

CREATE TABLE `ksw_pelanggan` (
  `id_pelanggan` varchar(6) NOT NULL,
  `nm_pelanggan` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `identitas` varchar(150) DEFAULT NULL,
  `statusdata` enum('AKTIF','TIDAK') DEFAULT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `ksw_pelanggan`
--

INSERT INTO `ksw_pelanggan` (`id_pelanggan`, `nm_pelanggan`, `telepon`, `identitas`, `statusdata`, `waktudata`) VALUES
('PW0004', 'Febi Robiana', '08888888', '003', 'TIDAK', '2024-05-06 09:17:00'),
('PW0003', 'Meto', '088888888', '001', 'AKTIF', '2024-05-06 09:16:41'),
('PW0005', 'Wildan', '99999', '002', 'AKTIF', '2024-05-30 00:32:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `login`
--

CREATE TABLE `login` (
  `id_login` int(11) NOT NULL,
  `user` varchar(255) NOT NULL,
  `pass` char(32) NOT NULL,
  `id_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `login`
--

INSERT INTO `login` (`id_login`, `user`, `pass`, `id_member`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 1),
(24, 'Febi', '202cb962ac59075b964b07152d234b70', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `member`
--

CREATE TABLE `member` (
  `id_member` int(11) NOT NULL,
  `nm_member` varchar(255) NOT NULL,
  `alamat_member` text NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `NIK` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `member`
--

INSERT INTO `member` (`id_member`, `nm_member`, `alamat_member`, `telepon`, `email`, `gambar`, `NIK`) VALUES
(1, 'Kopsaw', 'Bappelitbangda Kab. Tasikmalaya', '085161584626', 'example@gmail.com', 'unnamed.jpg', '-'),
(2, 'Febi', '-', '-', '-', 'unnamed.jpg', '-');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nota`
--

CREATE TABLE `nota` (
  `id_nota` varchar(14) NOT NULL COMMENT 'TRXMMYYY.0001',
  `id_member` int(11) NOT NULL,
  `id_pelanggan` varchar(6) DEFAULT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `bayar` bigint(20) DEFAULT NULL,
  `kembalian` bigint(20) DEFAULT NULL,
  `status_nota` enum('Lunas','Hutang') DEFAULT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp(),
  `periode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `nota`
--

INSERT INTO `nota` (`id_nota`, `id_member`, `id_pelanggan`, `jumlah`, `total`, `bayar`, `kembalian`, `status_nota`, `waktudata`, `periode`) VALUES
('TRX052024.0001', 1, 'PW0005', '3', '4500', 5000, 500, 'Lunas', '2024-05-28 14:23:45', '05-2024'),
('TRX052024.0002', 1, 'PW0003', '1', '4000', 5000, 0, 'Lunas', '2024-05-29 08:35:38', '05-2024'),
('TRX052024.0003', 1, 'PW0005', '2', '5500', 10000, 4500, 'Lunas', '2024-05-29 08:40:38', '05-2024'),
('TRX052024.0004', 1, 'PW0005', '7', '3615', 5000, 1385, 'Lunas', '2024-05-29 10:10:21', '05-2024'),
('TRX052024.0005', 1, 'PW0003', '3', '15000', 25000, 0, 'Lunas', '2024-05-29 12:09:35', '05-2024'),
('TRX052024.0006', 1, 'PW0005', '1', '5000', 5000, 0, 'Lunas', '2024-05-29 15:56:16', '05-2024'),
('TRX052024.0007', 1, 'PW0004', '1', '5000', 0, 0, 'Hutang', '2024-05-29 15:59:37', '05-2024'),
('TRX052024.0008', 1, 'PW0005', '2', '9000', 0, 0, 'Hutang', '2024-05-31 10:54:05', '05-2024'),
('TRX052024.0009', 1, 'PW0003', '2', '3000', 4000, 1000, 'Lunas', '2024-05-31 10:55:24', '05-2024'),
('TRX062024.0001', 1, '', '1', '1500', 0, 0, 'Hutang', '2024-06-02 13:59:11', '06-2024'),
('TRX062024.0002', 1, 'PW0004', '3', '9500', 50000, 40500, 'Lunas', '2024-06-02 14:00:04', '06-2024'),
('TRX062024.0003', 1, '', '1', '1500', 1500, -1000, 'Lunas', '2024-06-02 14:20:35', '06-2024'),
('TRX062024.0004', 1, 'PW0005', '5', '7500', 10000, 2500, 'Lunas', '2024-06-02 14:27:47', '06-2024'),
('TRX062024.0005', 1, 'PW0004', '1', '1500', 1000, -500, '', '2024-06-07 08:49:00', '06-2024'),
('TRX062024.0006', 1, 'PW0004', '1', '4000', 4000, -1000, 'Hutang', '2024-06-07 08:49:58', '06-2024'),
('TRX062024.0007', 1, 'PW0004', '1', '4000', 3000, -1000, '', '2024-06-07 08:53:27', '06-2024'),
('TRX062024.0008', 1, 'PW0003', '2', '3000', 3000, 0, 'Hutang', '2024-06-07 08:57:47', '06-2024'),
('TRX062024.0009', 1, 'PW0003', '7', '11200', 11200, 0, 'Lunas', '2024-06-10 15:19:20', '06-2024'),
('TRX062024.0010', 1, 'PW0005', '14', '15915', 15915, 0, 'Lunas', '2024-06-10 15:22:56', '06-2024'),
('TRX062024.0011', 1, 'PW0003', '15', '30800', 30800, 0, 'Lunas', '2024-06-10 15:49:58', '06-2024'),
('TRX062024.0012', 1, 'PW0004', '1', '1500', 2000, 500, 'Lunas', '2024-06-19 00:36:53', '06-2024'),
('TRX062024.0013', 1, 'PW0005', '3', '4500', 4500, 0, 'Lunas', '2024-06-19 19:32:20', '06-2024'),
('TRX062024.0014', 2, 'PW0005', '2', '3000', 0, 0, 'Hutang', '2024-06-25 13:39:30', '06-2024');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penjualan`
--

CREATE TABLE `penjualan` (
  `id_penjualan` varchar(13) NOT NULL COMMENT 'PJMMYYY.0001',
  `id_barang` varchar(255) NOT NULL,
  `harga_satuan_beli` varchar(255) NOT NULL,
  `harga_satuan_jual` varchar(255) NOT NULL,
  `id_member` int(11) NOT NULL,
  `id_nota` varchar(14) DEFAULT NULL,
  `jumlah` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `penjualan`
--

INSERT INTO `penjualan` (`id_penjualan`, `id_barang`, `harga_satuan_beli`, `harga_satuan_jual`, `id_member`, `id_nota`, `jumlah`, `total`, `waktudata`) VALUES
('PJ052024.0001', 'BR001', '800', '1500', 1, 'TRX052024.0001', '3', '4500', '2024-05-28 14:23:45'),
('PJ052024.0002', 'BR002', '3000', '4000', 1, 'TRX052024.0002', '1', '4000', '2024-05-29 08:35:38'),
('PJ052024.0003', 'BR002', '3000', '4000', 1, 'TRX052024.0003', '1', '4000', '2024-05-29 08:40:37'),
('PJ052024.0004', 'BR001', '800', '1500', 1, 'TRX052024.0003', '1', '1500', '2024-05-29 08:40:38'),
('PJ052024.0005', 'BR001', '800', '1500', 1, 'TRX052024.0004', '2', '3000', '2024-05-29 10:10:21'),
('PJ052024.0006', 'BR003', '123', '123', 1, 'TRX052024.0004', '5', '615', '2024-05-29 10:10:21'),
('PJ052024.0007', 'BR004', '2000', '5000', 1, 'TRX052024.0005', '3', '15000', '2024-05-29 12:09:35'),
('PJ052024.0008', 'BR004', '2000', '5000', 1, 'TRX052024.0006', '1', '5000', '2024-05-29 15:56:16'),
('PJ052024.0009', 'BR004', '2000', '5000', 1, 'TRX052024.0007', '1', '5000', '2024-05-29 15:59:37'),
('PJ052024.0010', 'BR004', '2000', '5000', 1, 'TRX052024.0008', '1', '5000', '2024-05-31 10:54:05'),
('PJ052024.0011', 'BR002', '3000', '4000', 1, 'TRX052024.0008', '1', '4000', '2024-05-31 10:54:05'),
('PJ052024.0012', 'BR001', '800', '1500', 1, 'TRX052024.0009', '2', '3000', '2024-05-31 10:55:24'),
('PJ062024.0001', 'BR001', '800', '1500', 1, 'TRX062024.0001', '1', '1500', '2024-06-02 13:59:11'),
('PJ062024.0002', 'BR001', '800', '1500', 1, 'TRX062024.0002', '1', '1500', '2024-06-02 14:00:03'),
('PJ062024.0003', 'BR002', '3000', '4000', 1, 'TRX062024.0002', '2', '8000', '2024-06-02 14:00:03'),
('PJ062024.0004', 'BR001', '800', '1500', 1, 'TRX062024.0003', '1', '1500', '2024-06-02 14:20:34'),
('PJ062024.0005', 'BR001', '800', '1500', 1, 'TRX062024.0004', '5', '7500', '2024-06-02 14:27:46'),
('PJ062024.0006', 'BR001', '800', '1500', 1, 'TRX062024.0005', '1', '1500', '2024-06-07 08:49:00'),
('PJ062024.0007', 'BR002', '3000', '4000', 1, 'TRX062024.0006', '1', '4000', '2024-06-07 08:49:58'),
('PJ062024.0008', 'BR002', '3000', '4000', 1, 'TRX062024.0007', '1', '4000', '2024-06-07 08:53:27'),
('PJ062024.0009', 'BR001', '800', '1500', 1, 'TRX062024.0008', '2', '3000', '2024-06-07 08:57:47'),
('PJ062024.0010', 'BR001', '800', '1500', 1, 'TRX062024.0009', '7', '11200', '2024-06-10 15:19:20'),
('PJ062024.0011', 'BR001', '800', '1700', 1, 'TRX062024.0010', '9', '15300', '2024-06-10 15:22:56'),
('PJ062024.0012', 'BR003', '123', '123', 1, 'TRX062024.0010', '5', '615', '2024-06-10 15:22:56'),
('PJ062024.0013', 'BR001', '800', '1700', 1, 'TRX062024.0011', '14', '26600', '2024-06-10 15:49:58'),
('PJ062024.0014', 'BR002', '3000', '4000', 1, 'TRX062024.0011', '1', '4200', '2024-06-10 15:49:58'),
('PJ062024.0015', 'BR001', '800', '1500', 1, 'TRX062024.0012', '1', '1500', '2024-06-19 00:36:52'),
('PJ062024.0016', 'BR001', '800', '1500', 1, 'TRX062024.0013', '3', '4500', '2024-06-19 19:32:20'),
('PJ062024.0017', 'BR001', '800', '1500', 2, 'TRX062024.0014', '2', '3000', '2024-06-25 13:39:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rincian`
--

CREATE TABLE `rincian` (
  `id_rincian` int(11) NOT NULL,
  `id_nota` varchar(255) NOT NULL,
  `id_barang` varchar(255) NOT NULL,
  `jumlah_beli_barang` varchar(255) NOT NULL,
  `total_pembelian` varchar(255) NOT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `rincian`
--

INSERT INTO `rincian` (`id_rincian`, `id_nota`, `id_barang`, `jumlah_beli_barang`, `total_pembelian`, `waktudata`) VALUES
(6, 'TRX052024.0001', 'BR001', '0', '4500', '2024-05-28 14:23:45'),
(7, 'TRX052024.0002', 'BR002', '0', '4000', '2024-05-29 08:35:38'),
(8, 'TRX052024.0003', 'BR002', '0', '4000', '2024-05-29 08:40:38'),
(9, 'TRX052024.0003', 'BR001', '0', '1500', '2024-05-29 08:40:38'),
(10, 'TRX052024.0004', 'BR001', '0', '3000', '2024-05-29 10:10:21'),
(11, 'TRX052024.0004', 'BR003', '0', '615', '2024-05-29 10:10:21'),
(12, 'TRX052024.0005', 'BR004', '0', '15000', '2024-05-29 12:09:35'),
(13, 'TRX052024.0006', 'BR004', '0', '5000', '2024-05-29 15:56:16'),
(14, 'TRX052024.0007', 'BR004', '0', '5000', '2024-05-29 15:59:38'),
(15, 'TRX052024.0008', 'BR004', '0', '5000', '2024-05-31 10:54:05'),
(16, 'TRX052024.0008', 'BR002', '0', '4000', '2024-05-31 10:54:05'),
(17, 'TRX052024.0009', 'BR001', '0', '3000', '2024-05-31 10:55:24'),
(18, 'TRX062024.0001', 'BR001', '0', '1500', '2024-06-02 13:59:11'),
(19, 'TRX062024.0002', 'BR001', '0', '1500', '2024-06-02 14:00:04'),
(20, 'TRX062024.0002', 'BR002', '0', '8000', '2024-06-02 14:00:04'),
(21, 'TRX062024.0003', 'BR001', '0', '1500', '2024-06-02 14:20:35'),
(22, 'TRX062024.0004', 'BR001', '0', '7500', '2024-06-02 14:27:47'),
(23, 'TRX062024.0005', 'BR001', '0', '1500', '2024-06-07 08:49:00'),
(24, 'TRX062024.0006', 'BR002', '0', '4000', '2024-06-07 08:49:58'),
(25, 'TRX062024.0007', 'BR002', '0', '4000', '2024-06-07 08:53:27'),
(26, 'TRX062024.0008', 'BR001', '0', '3000', '2024-06-07 08:57:47'),
(27, 'TRX062024.0009', 'BR001', '0', '11200', '2024-06-10 15:19:21'),
(28, 'TRX062024.0010', 'BR001', '0', '15300', '2024-06-10 15:22:56'),
(29, 'TRX062024.0010', 'BR003', '0', '615', '2024-06-10 15:22:56'),
(30, 'TRX062024.0011', 'BR001', '', '26600', '2024-06-10 15:49:58'),
(31, 'TRX062024.0011', 'BR002', '', '4200', '2024-06-10 15:49:58'),
(32, 'TRX062024.0012', 'BR001', '', '1500', '2024-06-19 00:36:53'),
(33, 'TRX062024.0013', 'BR001', '', '4500', '2024-06-19 19:32:20'),
(34, 'TRX062024.0014', 'BR001', '', '3000', '2024-06-25 13:39:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `nama_satuan` varchar(255) NOT NULL,
  `status_satuan` enum('AKTIF','TIDAK') NOT NULL,
  `tgl_input` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`, `status_satuan`, `tgl_input`) VALUES
(14, 'PCS', 'AKTIF', '2024-05-02 11:00:51'),
(15, 'BKS', 'AKTIF', '2024-05-06 09:18:38'),
(16, 'BTL', 'AKTIF', '2024-05-06 09:18:41'),
(17, 'DUS', 'AKTIF', '2024-05-06 09:18:49'),
(18, 'RIM', 'AKTIF', '2024-05-06 09:18:52'),
(19, 'LBR', 'AKTIF', '2024-05-06 09:18:57'),
(20, 'GLS', 'AKTIF', '2024-05-30 00:31:08');

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` varchar(255) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL,
  `telepon` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `telepon`, `alamat`, `status`) VALUES
('1f16856eaf4327b1926dab9deade02aac21d902c', 'Toko', '8989', 'jalan', 'TIDAK AKTIF'),
('8238ba91e52bfe1b41db220716beb44cb8e64f17', 'Pasar', '2222', 'Pasar Singaparna', 'TIDAK AKTIF'),
('fcc969dd99162b60b3aa893e75db35b89b3db552', 'Satu', '1214', 'cipicung', 'TIDAK AKTIF');

-- --------------------------------------------------------

--
-- Struktur dari tabel `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(255) NOT NULL,
  `alamat_toko` text NOT NULL,
  `tlp` varchar(255) NOT NULL,
  `nama_pemilik` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `toko`
--

INSERT INTO `toko` (`id_toko`, `nama_toko`, `alamat_toko`, `tlp`, `nama_pemilik`) VALUES
(1, 'KPRI Sawangan', 'Bappelitbangda Kab. Tasikmalaya', '085161584626', 'Kopsaw Bappelitbangda Kab. Tasikmalaya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `_temp_penjualan`
--

CREATE TABLE `_temp_penjualan` (
  `id_temp` varchar(12) NOT NULL COMMENT 'TEMMYYY.001',
  `id_barang` varchar(255) DEFAULT NULL,
  `id_member` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga_jual` int(11) NOT NULL,
  `total` int(11) DEFAULT NULL,
  `waktudata` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `ksw_pelanggan`
--
ALTER TABLE `ksw_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id_login`);

--
-- Indeks untuk tabel `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`id_member`);

--
-- Indeks untuk tabel `nota`
--
ALTER TABLE `nota`
  ADD PRIMARY KEY (`id_nota`);

--
-- Indeks untuk tabel `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id_penjualan`);

--
-- Indeks untuk tabel `rincian`
--
ALTER TABLE `rincian`
  ADD PRIMARY KEY (`id_rincian`);

--
-- Indeks untuk tabel `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indeks untuk tabel `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `login`
--
ALTER TABLE `login`
  MODIFY `id_login` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `member`
--
ALTER TABLE `member`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `rincian`
--
ALTER TABLE `rincian`
  MODIFY `id_rincian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
