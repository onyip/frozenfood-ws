-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.6.7-MariaDB-2ubuntu1 - Ubuntu 22.04
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table toko_online.cabang
DROP TABLE IF EXISTS `cabang`;
CREATE TABLE IF NOT EXISTS `cabang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` varchar(255) DEFAULT '',
  `kota` varchar(255) DEFAULT '',
  `propinsi` varchar(255) DEFAULT '',
  `kodepos` varchar(6) DEFAULT '',
  `telp` varchar(20) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table toko_online.cabang: ~0 rows (approximately)
DELETE FROM `cabang`;
INSERT INTO `cabang` (`id`, `userid`, `nama`, `alamat`, `kota`, `propinsi`, `kodepos`, `telp`, `email`) VALUES
	(4, 'cabang', 'Cabang Pusat', 'Jakarta Pusat', 'Jakarta Pusat', '', '', '085712729478', 'cabangpusat@frozenfood.com');

-- Dumping structure for table toko_online.carousel
DROP TABLE IF EXISTS `carousel`;
CREATE TABLE IF NOT EXISTS `carousel` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idproduk` int(11) DEFAULT NULL,
  `judul` varchar(255) DEFAULT '',
  `thumbnail` varchar(255) DEFAULT '',
  `st` varchar(1) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table toko_online.carousel: ~7 rows (approximately)
DELETE FROM `carousel`;
INSERT INTO `carousel` (`id`, `idproduk`, `judul`, `thumbnail`, `st`) VALUES
	(1, 1, 'Promo Samsung Murah', '/dist/carousel/1.jpg', '1'),
	(2, 2, 'Dapatkan Harga Terbaik', '/dist/carousel/2.jpg', '1'),
	(3, 3, 'Shoplink 11 : 11', '/dist/carousel/3.jpg', '1'),
	(12, 1, 'Bulan Penuk Berkah', '/dist/carousel/image_picker5309826714810817411.jpg', '1'),
	(13, 5, 'poooooooo', '/dist/carousel/image_picker8434591335363379792.jpg', '1'),
	(16, 80, 'Gratis Ongkir', '/dist/carousel/image_picker6098916154903828330.jpg', '1'),
	(17, 81, 'Gratis Ongkir', '/dist/carousel/image_picker8025152126211394556.jpg', '1'),
	(18, 82, 'Gratis Ongkir', '/dist/carousel/image_picker2520173313643113763.jpg', '1');

-- Dumping structure for table toko_online.conter
DROP TABLE IF EXISTS `conter`;
CREATE TABLE IF NOT EXISTS `conter` (
  `jual` bigint(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.conter: ~0 rows (approximately)
DELETE FROM `conter`;
INSERT INTO `conter` (`jual`) VALUES
	(78);

-- Dumping structure for table toko_online.favorite
DROP TABLE IF EXISTS `favorite`;
CREATE TABLE IF NOT EXISTS `favorite` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) DEFAULT '',
  `idproduk` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.favorite: ~2 rows (approximately)
DELETE FROM `favorite`;
INSERT INTO `favorite` (`id`, `userid`, `idproduk`) VALUES
	(38, 'user', 2),
	(39, 'user', 5);

-- Dumping structure for table toko_online.gambarlain
DROP TABLE IF EXISTS `gambarlain`;
CREATE TABLE IF NOT EXISTS `gambarlain` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idproduk` bigint(20) DEFAULT NULL,
  `images` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.gambarlain: ~8 rows (approximately)
DELETE FROM `gambarlain`;
INSERT INTO `gambarlain` (`id`, `idproduk`, `images`) VALUES
	(22, 55, '/dist/images/wakanda33phpm7YC6K.jpg'),
	(23, 55, '/dist/images/wakanda33phpksdJi1.jpg'),
	(24, 55, '/dist/images/wakanda33phpCwyIMa.jpg'),
	(25, 56, '/dist/images/esdogerphp1LL6DK.jpg'),
	(26, 57, '/dist/images/BeraslelephpTuDRwO.jpg'),
	(27, 57, '/dist/images/BeraslelephpzTqdY9.jpg'),
	(28, 57, '/dist/images/BeraslelephpGzDo3P.jpg'),
	(29, 58, '/dist/images/anuphpxVtSMs.jpg');

-- Dumping structure for table toko_online.kategori
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE IF NOT EXISTS `kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.kategori: ~4 rows (approximately)
DELETE FROM `kategori`;
INSERT INTO `kategori` (`id`, `nama`) VALUES
	(33, 'Frozen Food Goreng'),
	(34, 'Frozen Food Rebus'),
	(35, 'Sayuran'),
	(36, 'Daging'),
	(37, 'Ikan & Seafood');

-- Dumping structure for table toko_online.pelanggan
DROP TABLE IF EXISTS `pelanggan`;
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `alamat` varchar(255) DEFAULT '',
  `kota` varchar(255) DEFAULT '',
  `propinsi` varchar(255) DEFAULT '',
  `kodepos` varchar(6) DEFAULT '',
  `telp` varchar(20) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.pelanggan: ~2 rows (approximately)
DELETE FROM `pelanggan`;
INSERT INTO `pelanggan` (`id`, `userid`, `nama`, `alamat`, `kota`, `propinsi`, `kodepos`, `telp`, `email`) VALUES
	(1, 'user', 'Rahman Hidayat', 'Jl Pemudaxxx', 'Semarang', 'Jawa Tengah', '', '0811223389988', 'user@gmail.com');

-- Dumping structure for table toko_online.penjualan
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE IF NOT EXISTS `penjualan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nota` varchar(255) DEFAULT '',
  `tanggal` datetime DEFAULT NULL,
  `idproduk` int(255) DEFAULT NULL,
  `judul` varchar(255) DEFAULT '',
  `harga` double(10,0) DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT '',
  `jumlah` int(11) DEFAULT NULL,
  `userid` varchar(100) DEFAULT '',
  `idcabang` int(11) DEFAULT NULL,
  `st` varchar(1) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table toko_online.penjualan: ~4 rows (approximately)
DELETE FROM `penjualan`;
INSERT INTO `penjualan` (`id`, `nota`, `tanggal`, `idproduk`, `judul`, `harga`, `thumbnail`, `jumlah`, `userid`, `idcabang`, `st`, `flag`) VALUES
	(5, '220622/0073J', '2022-06-22 23:08:49', 80, 'Sayap Ayam Kampung 250gr', 20000, '/dist/images/Sayap Ayam Kampung 250gr.20220622222017.jpeg', 1, '4', 4, '1', '1'),
	(6, '220622/0074J', '2022-06-22 23:12:05', 81, 'Tenderloin Sapi Japan 250gr', 250000, '/dist/images/tenderloin.jpg', 2, 'user', 4, NULL, NULL),
	(7, '220622/0075J', '2022-06-22 23:12:35', 80, 'Sayap Ayam Kampung 250gr', 20000, '/dist/images/Sayap Ayam Kampung 250gr.20220622222017.jpeg', 1, 'user', 4, '1', 's'),
	(8, '220623/0076J', '2022-06-23 00:08:19', 80, 'Sayap Ayam Kampung 250gr', 20000, '/dist/images/Sayap Ayam Kampung 250gr.20220622222017.jpeg', 2, '', 4, NULL, NULL),
	(9, '220623/0077J', '2022-06-23 00:08:41', 81, 'Tenderloin Sapi Japan 250gr', 250000, '/dist/images/tenderloin.jpg', 1, 'user', 4, NULL, NULL);

-- Dumping structure for table toko_online.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idkategori` int(11) DEFAULT NULL,
  `idsubkategori` int(11) DEFAULT NULL,
  `kategori` varchar(255) DEFAULT '',
  `subkategori` varchar(255) DEFAULT '',
  `judul` varchar(255) DEFAULT '',
  `deskripsi` text DEFAULT NULL,
  `harga` double(10,0) DEFAULT 0,
  `thumbnail` varchar(255) DEFAULT '',
  `st` varchar(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.produk: ~9 rows (approximately)
DELETE FROM `produk`;
INSERT INTO `produk` (`id`, `idkategori`, `idsubkategori`, `kategori`, `subkategori`, `judul`, `deskripsi`, `harga`, `thumbnail`, `st`) VALUES
	(80, 36, 34, 'Daging', 'Daging Ayam', 'Sayap Ayam Kampung 250gr', 'Sayap ayam kampung segar yang di sembelih dengan dengan tatacara islam yang di jamin kehalalannya', 20000, '/dist/images/Sayap Ayam Kampung 250gr.20220622222017.jpeg', '1'),
	(81, 36, 33, 'Daging', 'Daging Sapi', 'Tenderloin Sapi Japan 250gr', 'Tenderloin Sapi segar dari japan yang di sembelih dengan tatacara islam yang di jamin kehalalannya', 250000, '/dist/images/tenderloin.jpg', '1'),
	(82, 36, 34, 'Daging', 'Daging Ayam', 'Dada Ayam Fillet 250gr', 'Dada ayam negri fillet yang di sembelih dengan tatacara islam yang di jamin kehalalannya', 300000, '/dist/images/dada.jpg', '1'),
	(83, 35, 30, 'Sayuran', 'Jamur', 'Jamur Enoki 100gr', 'Jamur enoki segar yang di tanam dengan tatacara islam yang di jamin kehalalannya', 40000, '/dist/images/enoki.jpg', '1'),
	(84, 35, 32, 'Sayuran', 'Kacang-Kacangan', 'Kacang Polong 500gr', 'Kacang polong segar yang di tanam dengan tatacara islam yang di jamin kehalalannya', 50000, '/dist/images/polong.jpg', '1'),
	(85, 35, 32, 'Sayuran', 'Sayuran Hijau', 'Vegetable mix paket diet 500gr', 'Vegetable mix paket diet segar yang di tanam dengan tatacara islam yang di jamin kehalalannya', 35000, '/dist/images/vegetable.jpeg', '1'),
	(86, 37, 35, 'Ikan & Seafood', 'Ikan Laut', 'Kepiting Laut Segar 500gr', 'Kepiting Laut Segar segar yang di cari dengan tatacara islam yang di jamin kehalalannya', 100000, '/dist/images/kepiting.jpg', '1'),
	(87, 37, 35, 'Ikan & Seafood', 'Ikan Laut', 'Lobster Laut Segar 500gr', 'Lobster Laut Segar segar yang di cari dengan tatacara islam yang di jamin kehalalannya', 100000, '/dist/images/lobster.jpg', '1'),
	(88, 37, 35, 'Ikan & Seafood', 'Ikan Laut', 'Salmon Fille Segar 100gr', 'Salmon Fille Segar segar yang di cari dengan tatacara islam yang di jamin kehalalannya', 150000, '/dist/images/salmon.jpg', '1');

-- Dumping structure for table toko_online.signin
DROP TABLE IF EXISTS `signin`;
CREATE TABLE IF NOT EXISTS `signin` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `userid` varchar(100) DEFAULT '',
  `pass` varchar(100) DEFAULT '',
  `nama` varchar(255) DEFAULT '',
  `level` varchar(1) DEFAULT '',
  `email` varchar(255) DEFAULT '',
  `foto` varchar(255) DEFAULT '',
  `token` varchar(255) DEFAULT '',
  `token2` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table toko_online.signin: ~2 rows (approximately)
DELETE FROM `signin`;
INSERT INTO `signin` (`id`, `userid`, `pass`, `nama`, `level`, `email`, `foto`, `token`, `token2`) VALUES
	(1, 'sa', 'sa', 'Adminitrator', '1', 'sa@gmail.com', '', '', ''),
	(4, 'user', 'user', 'Rahman Hidayat', '3', 'user@gmail.com', '', '', ''),
	(13, 'cabang', 'cabang', 'Cabang Pusat', '2', 'cabangpusat@frozenfood.com', '', '', '');

-- Dumping structure for table toko_online.stokcabang
DROP TABLE IF EXISTS `stokcabang`;
CREATE TABLE IF NOT EXISTS `stokcabang` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `idcabang` int(11) DEFAULT NULL,
  `idproduk` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table toko_online.stokcabang: ~9 rows (approximately)
DELETE FROM `stokcabang`;
INSERT INTO `stokcabang` (`id`, `idcabang`, `idproduk`) VALUES
	(57, 4, 80),
	(58, 4, 81),
	(59, 4, 82),
	(60, 4, 83),
	(61, 4, 84),
	(62, 4, 85),
	(63, 4, 86),
	(64, 4, 87),
	(65, 4, 88);

-- Dumping structure for table toko_online.subkategori
DROP TABLE IF EXISTS `subkategori`;
CREATE TABLE IF NOT EXISTS `subkategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idkategori` int(11) DEFAULT 0,
  `nama` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table toko_online.subkategori: ~12 rows (approximately)
DELETE FROM `subkategori`;
INSERT INTO `subkategori` (`id`, `idkategori`, `nama`) VALUES
	(23, 33, 'Instan'),
	(24, 33, 'Berbahan Dasar Daging'),
	(25, 33, 'Berbahan Dasar Sayur'),
	(27, 34, 'Instan'),
	(28, 34, 'Berbahan Dasar Daging'),
	(29, 34, 'Berbahan Dasar Sayur'),
	(30, 35, 'Jamur'),
	(31, 35, 'Sayuran Hijau'),
	(32, 35, 'Kacang-Kacangan'),
	(33, 36, 'Daging Sapi'),
	(34, 36, 'Daging Ayam'),
	(35, 37, 'Ikan Laut'),
	(37, 37, 'Ikan Air Tawar');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
