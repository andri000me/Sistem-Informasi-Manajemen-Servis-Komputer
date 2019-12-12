/*
SQLyog Professional v12.4.1 (64 bit)
MySQL - 10.1.37-MariaDB : Database - kp
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`kp` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `kp`;

/*Table structure for table `barang` */

DROP TABLE IF EXISTS `barang`;

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  `keluhan` varchar(30) DEFAULT NULL,
  `tgl_masuk` datetime DEFAULT NULL,
  `tgl_keluar` datetime DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `tgl_garansi` date DEFAULT NULL,
  `status_garansi` varchar(15) DEFAULT NULL,
  `total_biaya` int(11) DEFAULT NULL,
  `hapus` tinyint(1) DEFAULT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_barang`),
  KEY `id_pelanggan` (`id_pelanggan`),
  KEY `id_teknisi` (`id_teknisi`),
  KEY `username` (`username`),
  CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`id_teknisi`) REFERENCES `teknisi` (`id_teknisi`),
  CONSTRAINT `barang_ibfk_3` FOREIGN KEY (`username`) REFERENCES `pengelola` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `barang` */

/*Table structure for table `jasa` */

DROP TABLE IF EXISTS `jasa`;

CREATE TABLE `jasa` (
  `id_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `keterangan` varchar(30) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `jasa` */

/*Table structure for table `pelanggan` */

DROP TABLE IF EXISTS `pelanggan`;

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pelanggan` varchar(30) DEFAULT NULL,
  `notelp_pelanggan` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pelanggan` */

/*Table structure for table `pengelola` */

DROP TABLE IF EXISTS `pengelola`;

CREATE TABLE `pengelola` (
  `username` varchar(20) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  `level` varchar(1) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pengelola` */

/*Table structure for table `suku_cadang` */

DROP TABLE IF EXISTS `suku_cadang`;

CREATE TABLE `suku_cadang` (
  `id_suku_cadang` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  `jenis` varchar(20) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `untung` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_suku_cadang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `suku_cadang` */

/*Table structure for table `teknisi` */

DROP TABLE IF EXISTS `teknisi`;

CREATE TABLE `teknisi` (
  `id_teknisi` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(20) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `notelp` varchar(13) DEFAULT NULL,
  `status` varchar(15) DEFAULT NULL,
  `avatar` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_teknisi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `teknisi` */

/*Table structure for table `trans_jasa` */

DROP TABLE IF EXISTS `trans_jasa`;

CREATE TABLE `trans_jasa` (
  `id_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `subtotal_jasa` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_jasa`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `trans_jasa_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  CONSTRAINT `trans_jasa_ibfk_2` FOREIGN KEY (`id_jasa`) REFERENCES `jasa` (`id_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_jasa` */

/*Table structure for table `trans_sukucadang` */

DROP TABLE IF EXISTS `trans_sukucadang`;

CREATE TABLE `trans_sukucadang` (
  `id_suku_cadang` int(11) NOT NULL AUTO_INCREMENT,
  `id_barang` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `subtotal_sukucadang` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_suku_cadang`),
  KEY `id_barang` (`id_barang`),
  CONSTRAINT `trans_sukucadang_ibfk_1` FOREIGN KEY (`id_suku_cadang`) REFERENCES `suku_cadang` (`id_suku_cadang`),
  CONSTRAINT `trans_sukucadang_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_sukucadang` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
