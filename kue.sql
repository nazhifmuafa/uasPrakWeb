-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2022 at 02:03 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kue`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `jk` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`nama_lengkap`, `username`, `password`, `tgl_lahir`, `alamat`, `telepon`, `jk`) VALUES
('Nazhif Muafa R', 'admin1', '5f4dcc3b5aa765d61d8327deb882cf99', '2002-05-03', 'Jalan Margojoyo', '081234', 'L'),
('Nazhif M', 'admin2', '5f4dcc3b5aa765d61d8327deb882cf99', '2002-04-12', 'Jalan Sumbersari ', '082145', 'L'),
('Nazhif Muafa', 'admin3', '5f4dcc3b5aa765d61d8327deb882cf99', '2002-04-20', 'Jalan Sumberjaya', '082135', 'L'),
('Nazhif Muafa Roziqiin', 'admin4', '5f4dcc3b5aa765d61d8327deb882cf99', '2002-04-08', 'Sumbersekar', '081562', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(10) NOT NULL,
  `nama_bank` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `nama_bank`) VALUES
(2, 'BNI'),
(3, 'Mandiri'),
(4, 'BCA'),
(5, 'BTN');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) NOT NULL,
  `kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`) VALUES
(1, 'Kue Ulang Tahun'),
(2, 'Kue Tradisional');

-- --------------------------------------------------------

--
-- Table structure for table `masukan`
--

CREATE TABLE `masukan` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `komentar` text NOT NULL,
  `createdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masukan`
--

INSERT INTO `masukan` (`id`, `username`, `telepon`, `komentar`, `createdate`) VALUES
(1, 'member1', '082134567', 'Sangat Baikk', '2022-06-12 05:09:56'),
(2, 'member1', '082134567', 'Sangat Baik Lagi', '2022-06-12 05:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(150) NOT NULL,
  `asal_kota` varchar(25) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jk` enum('L','P') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`username`, `password`, `nama_lengkap`, `tgl_lahir`, `alamat`, `asal_kota`, `telepon`, `jk`) VALUES
('member1', 'aa08769cdcb26674c6706093503ff0a3', 'Muafa Nazhif', '2002-06-08', 'Jalan Blitar', 'Malang', '082356', 'L'),
('member3', 'aa08769cdcb26674c6706093503ff0a3', 'Nazhif Saja', '2002-04-08', 'Sumbersekar', 'Malang', '083452', 'L'),
('member4', 'aa08769cdcb26674c6706093503ff0a3', 'Nazhif Lagi', '2002-04-07', 'Jalan Raya', 'Malang', '096761', 'L');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `kode_order` varchar(20) CHARACTER SET utf8 NOT NULL,
  `id_bank` int(10) NOT NULL,
  `rekening` varchar(50) NOT NULL,
  `nama_rekening` varchar(50) NOT NULL,
  `tgl_transfer` datetime NOT NULL,
  `bukti` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `username`, `kode_order`, `id_bank`, `rekening`, `nama_rekening`, `tgl_transfer`, `bukti`) VALUES
('BYR001', 'member1', 'PSN001', 2, '20060544013', 'Nazhif Mu', '2022-06-12 00:00:00', '44-header-image.jpg'),
('BYR002', 'member1', 'PSN003', 3, '20060544013', 'Nazhif MR', '2022-06-12 00:00:00', '33-marcus-loke-8QRvzJGumSw-unsplash.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `kode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `username` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_kue` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` float NOT NULL,
  `keterangan` text NOT NULL,
  `status_pesanan` enum('sudah_dibayar','belum_dibayar') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`kode`, `username`, `tgl`, `id_kue`, `jumlah`, `total_bayar`, `keterangan`, `status_pesanan`) VALUES
('PSN001', 'member1', '2022-06-12', 6, 2, 40000, '', 'sudah_dibayar'),
('PSN002', 'member1', '2022-06-12', 12, 2, 40000, 'Ditambahi Tulisan \"Selamat Ulang Tahun\"', 'belum_dibayar'),
('PSN003', 'member1', '2022-06-12', 6, 1, 20000, '', 'sudah_dibayar'),
('PSN004', 'member4', '2022-06-13', 6, 2, 40000, '', 'belum_dibayar'),
('PSN005', 'member4', '2022-06-13', 12, 3, 60000, 'Baikk', 'belum_dibayar');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_kue` int(11) NOT NULL,
  `id_kategori` int(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` float NOT NULL,
  `status` enum('ada','kosong') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_kue`, `id_kategori`, `nama`, `keterangan`, `gambar`, `harga`, `status`) VALUES
(6, 1, 'Kue Ultah Warna Warni', 'Kue Enak', '986-kue ulang tahun.jpg', 20000, 'ada'),
(8, 2, 'Kue Klepon', 'HIjau dan Bulat berkelapa', '508-kuetra2.jpg', 12000, 'ada'),
(12, 1, 'Kue Coklat', 'Kue Ulang Tahun Coklat, Enak', '868-kue2.jpg', 20000, 'ada'),
(13, 1, 'Kue Kotak', 'Kue Ulang Tahun berbentuk kotak', '885-kue kotak.jpg', 21000, 'ada');

-- --------------------------------------------------------

--
-- Table structure for table `resep`
--

CREATE TABLE `resep` (
  `id` varchar(11) NOT NULL,
  `nama_resep` varchar(100) NOT NULL,
  `bahan` text NOT NULL,
  `cara_buat` text NOT NULL,
  `gambar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resep`
--

INSERT INTO `resep` (`id`, `nama_resep`, `bahan`, `cara_buat`, `gambar`) VALUES
('RSP001', 'Kue pukis', '- 200 gram tepung terigu\r\n- 3 butir telur ayam utuh\r\n- 2 kuning telur\r\n- 300 mili santan\r\n- 70 mili air hangat\r\n- 1 sendok makan ragi kue\r\n- 1 sendok makan garam\r\n- 150 gram gula pasir\r\n- 130 gram keju\r\n- 130 gram meisis cokelat ', '- Potong atau parut keju sebagai topingnya. Kemudian campurkan ragi kue dengan air hangat dan mengaduknya sampai larut. Setelah larut secara sempurna maka sisihkan.\r\n- Rebus santan, dengan diaduk terus agar santan tidak menggumpal atau pecah. Hal itu dilakukan sampai santan mendidih, setelah mendidih maka api dapat dimatikan dan biarkan santan menghangat.\r\n- Kemudian masukkan ragi kue ke dalam adonan tersebut dan masukkan santan hangat. Aduk lagi hingga semua bahan tersebut tercampur merata atau tidak ada gumpalan sekalipun kecil. Setelah itu diamkan sekitar 15 sampai 25 menit.\r\n- Siapkan cetakan kue pukis atau loyang di atas kompor dengan api kecil. Api besar wajib dihindari agar kue tidak gosong atau matang hanya sebagian.\r\n- Setelah itu oles cetakan kue dengan margarine. Maka adonan dapat di tuang ke cetakan sampai hampir penuh dan tutup sebentar. Setelah beberapa menit buka penutup tersebut dan berikan taburan keju atau meises maupun topping lain sesuai selara. Kemudian tutup kembali sampai matang.\r\n- Tatkala kue pukis dirasa sudah matang, maka angkat kue cubit dari cetakan. Lalu sajikan kue pukis sebagai teman keluarga atau persiapan untuk jualan maupun menyambut hari penting. ', '717-header-image.jpg'),
('RSP002', 'Bolu pisang', '- 300 Gram tepung terigu\r\n- 200 Gram gula pasir\r\n- 100 ml minyak goreng\r\n- 50 ml air putih\r\n- 4 Butir telur ayam\r\n- 2 Sendok teh perasa pisang\r\n- 1 Sendok SP\r\n- 1 Sendok teh vanili bubuk\r\n- Meses & cokelat masak putih secukupnya\r\n- Pewarna makanan kuning secukupnya ', '- Kocok telur, SP, gula pasir,vanili dengan mixer selama 10 menit.\r\n- Turunkan kecepatan mixer, masukkan tepung, minyak goreng & air. Kocok sampai rata.\r\n- Tambahkan perasa pisang dan pewarna kuning, kemudian aduk rata.\r\n- Tuang adonan ke dalam cetakan yang telah diolesi minyak goreng. Isi separuh saja, taburi meses, lalu tutup dengan adonan lagi hingga cetakan hampir penuh.\r\n- Panaskan kukusan, kemudian kukus selama 10 menit. Keluarkan dari cetakan dan tunggu sampai dingin.\r\n- Oles bagian ujung dan samping dengan cokelat masak putih yang sudah dilelehkan dan dicampur pewarna kuning.\r\n- Tunggu sampai cokelat mengeras, kemudian sajikan kue pisang. ', '793-kuetra1a.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `nama_toko` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `nama_toko`) VALUES
(1, 'toko_bahan_roti'),
(2, 'Toko A'),
(3, 'toko C');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `masukan`
--
ALTER TABLE `masukan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fk1` (`id_bank`),
  ADD UNIQUE KEY `id_order` (`kode_order`) USING BTREE;

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`kode`),
  ADD KEY `username` (`username`),
  ADD KEY `id_kue` (`id_kue`) USING BTREE;

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_kue`),
  ADD KEY `FK1` (`id_kategori`) USING BTREE;

--
-- Indexes for table `resep`
--
ALTER TABLE `resep`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `masukan`
--
ALTER TABLE `masukan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_kue` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `masukan`
--
ALTER TABLE `masukan`
  ADD CONSTRAINT `masukan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `member` (`username`);

--
-- Constraints for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id`),
  ADD CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`kode_order`) REFERENCES `pesanan` (`kode`);

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `member` (`username`),
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_kue`) REFERENCES `produk` (`id_kue`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
