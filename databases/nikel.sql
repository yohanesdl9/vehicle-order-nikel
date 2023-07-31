-- MariaDB dump 10.19  Distrib 10.4.22-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: nikel
-- ------------------------------------------------------
-- Server version	10.4.22-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_users`
--

DROP TABLE IF EXISTS `cms_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cms_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `privileges` enum('admin','verificator') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cms_users`
--

LOCK TABLES `cms_users` WRITE;
/*!40000 ALTER TABLE `cms_users` DISABLE KEYS */;
INSERT INTO `cms_users` VALUES (1,'Admin','admin','$2y$10$nYIuhZlkit2ORXmgm9m.K.nYD6YRX1LjhOb5cuqP79tNNrEElGOxq','admin','2023-07-31 11:23:16','2023-07-31 17:59:18',NULL),(2,'Verifikator 1','verificator1','$2y$10$WDfZAELULr2aD9vNIPmVm.bBt/UYGaQ4qCieJVOPKQnW6PH.FramG','verificator','2023-07-31 11:23:43','2023-07-31 14:38:09',NULL),(3,'Admin 2','admin','$2y$10$F5wM5Y2wwJKT2ajCmqoMF.vj0rTOj.rHSdhnnRgjQ18F9L6pgiyva','admin','2023-07-31 17:59:27',NULL,'2023-07-31 17:59:34'),(4,'Admin 2','admin','$2y$10$5zyEbref8C.J5dGssBtJZe7sTerH9OScAHsEMnxoAbotdEy0GoQ2O','admin','2023-07-31 18:00:24',NULL,'2023-07-31 18:00:58'),(5,'Admin 2','admin','$2y$10$MSTu8SSJwPMlNQLHzO2wg.fT77ISWQp0tFuuAozO.g4Bgur7rji2y','admin','2023-07-31 18:01:09',NULL,'2023-07-31 18:01:16'),(6,'Admin 2','admin','$2y$10$2tDNwFwKWsdXKsAMAeQ87.6wtrfIPfD2TsYm7RjmFU0PTKgpaLCKi','admin','2023-07-31 18:01:41',NULL,'2023-07-31 18:02:02'),(7,'Admin 2','admin','$2y$10$RF605LknBDYFrga4Ha1KB.p8nKkGLoQEJ80WXWl0cB0hgL5gjyI4.','admin','2023-07-31 18:02:33',NULL,'2023-07-31 18:03:15'),(8,'Admin 1','admin','$2y$10$JWPGRqgJvArGsHbz4FOUGuE9VDcXlZ/ARTY/1n7S3oU1SpBC8NrFu','admin','2023-07-31 18:03:24',NULL,'2023-07-31 18:03:31'),(9,'Admin','admin2','$2y$10$k896WgEzeF4rLOLQTGMneeihlbXDmccPtSqVVLHNEsK6DMZqgMOP6','admin','2023-07-31 18:08:59','2023-07-31 18:24:41',NULL),(10,'Admin 3','admin3','$2y$10$AhTMV0YVvbvT0tFfuUir2eEtlQq1Kxge8zvGOH3kRXZXW/V8K6xh6','admin','2023-07-31 18:24:55',NULL,NULL);
/*!40000 ALTER TABLE `cms_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kendaraan`
--

DROP TABLE IF EXISTS `tb_kendaraan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merek_kendaraan` varchar(50) DEFAULT NULL,
  `model_kendaraan` varchar(100) DEFAULT NULL,
  `nomor_polisi` varchar(20) DEFAULT NULL,
  `nomor_rangka` varchar(100) DEFAULT NULL,
  `nomor_mesin` varchar(100) DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `jenis_angkutan` enum('orang','barang') DEFAULT NULL,
  `tipe_kepemilikan` enum('perusahaan','sewa') DEFAULT NULL,
  `id_perusahaan` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_perusahaan` (`id_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kendaraan`
--

LOCK TABLES `tb_kendaraan` WRITE;
/*!40000 ALTER TABLE `tb_kendaraan` DISABLE KEYS */;
INSERT INTO `tb_kendaraan` VALUES (1,'Mitsubishi','Fuso','B8764UA','MH28J29990439','JB438888821',2019,'barang','perusahaan',NULL,'2023-07-31 19:04:29',NULL,NULL,'Admin',NULL,NULL),(2,'Hino','RF30009','B8574UA',NULL,NULL,2019,'barang','perusahaan',NULL,'2023-07-31 19:05:08',NULL,'2023-07-31 19:30:21','Admin',NULL,'Admin'),(3,'Hino','Dutro','B8765UA',NULL,NULL,2015,'barang','perusahaan',NULL,'2023-07-31 19:09:29',NULL,NULL,'Admin',NULL,NULL),(4,'Mitsubishi','Pajero Sport','B3667BRR',NULL,NULL,2022,'orang','sewa',1,'2023-07-31 19:28:04',NULL,NULL,'Admin',NULL,NULL);
/*!40000 ALTER TABLE `tb_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kendaraan_jadwal_service`
--

DROP TABLE IF EXISTS `tb_kendaraan_jadwal_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kendaraan_jadwal_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) DEFAULT NULL,
  `tanggal_service` date DEFAULT NULL,
  `keterangan_service` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`id_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kendaraan_jadwal_service`
--

LOCK TABLES `tb_kendaraan_jadwal_service` WRITE;
/*!40000 ALTER TABLE `tb_kendaraan_jadwal_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_kendaraan_jadwal_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_kendaraan_konsumsi_bbm`
--

DROP TABLE IF EXISTS `tb_kendaraan_konsumsi_bbm`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_kendaraan_konsumsi_bbm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kendaraan` int(11) DEFAULT NULL,
  `tanggal_check` date DEFAULT NULL,
  `jarak_tempuh` double DEFAULT NULL,
  `konsumsi_bbm` double DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kendaraan` (`id_kendaraan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_kendaraan_konsumsi_bbm`
--

LOCK TABLES `tb_kendaraan_konsumsi_bbm` WRITE;
/*!40000 ALTER TABLE `tb_kendaraan_konsumsi_bbm` DISABLE KEYS */;
/*!40000 ALTER TABLE `tb_kendaraan_konsumsi_bbm` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_log`
--

DROP TABLE IF EXISTS `tb_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cms_users` int(11) DEFAULT NULL,
  `timestamp` datetime DEFAULT NULL,
  `log` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cms_users` (`id_cms_users`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_log`
--

LOCK TABLES `tb_log` WRITE;
/*!40000 ALTER TABLE `tb_log` DISABLE KEYS */;
INSERT INTO `tb_log` VALUES (4,1,'2023-07-31 13:47:09','Menambahkan data perusahaan rental kendaraan'),(5,1,'2023-07-31 13:48:28','Mengubah data perusahaan rental kendaraan dengan id = 1'),(6,1,'2023-07-31 14:02:29','Menambahkan data pegawai'),(7,1,'2023-07-31 14:02:59','Menambahkan data pegawai'),(8,1,'2023-07-31 14:03:47','Menambahkan data pegawai'),(9,1,'2023-07-31 14:04:11','Menambahkan data pegawai'),(10,1,'2023-07-31 14:08:05','Mengubah data pegawai dengan id = 4'),(11,1,'2023-07-31 14:37:51','Mengubah data user dengan id = 2'),(12,1,'2023-07-31 14:38:09','Mengubah data user dengan id = 2'),(13,1,'2023-07-31 14:38:18','Mengubah data user dengan id = 1'),(14,1,'2023-07-31 14:38:25','Mengubah data user dengan id = 1'),(15,1,'2023-07-31 14:41:32','Mengubah data user dengan id = 1'),(16,1,'2023-07-31 14:44:31','Mengubah data user dengan id = 1'),(17,1,'2023-07-31 14:44:37','Mengubah data user dengan id = 1'),(18,1,'2023-07-31 17:59:18','Mengubah data user dengan id = 1'),(19,1,'2023-07-31 17:59:27','Menambahkan data user'),(20,1,'2023-07-31 17:59:34','Menghapus data user dengan id = 3'),(21,1,'2023-07-31 18:00:24','Menambahkan data user'),(22,1,'2023-07-31 18:00:58','Menghapus data user dengan id = 4'),(23,1,'2023-07-31 18:01:09','Menambahkan data user'),(24,1,'2023-07-31 18:01:16','Menghapus data user dengan id = 5'),(25,1,'2023-07-31 18:01:41','Menambahkan data user'),(26,1,'2023-07-31 18:02:02','Menghapus data user dengan id = 6'),(27,1,'2023-07-31 18:02:33','Menambahkan data user'),(28,1,'2023-07-31 18:03:15','Menghapus data user dengan id = 7'),(29,1,'2023-07-31 18:03:24','Menambahkan data user'),(30,1,'2023-07-31 18:03:31','Menghapus data user dengan id = 8'),(31,1,'2023-07-31 18:08:59','Menambahkan data user'),(32,1,'2023-07-31 18:24:31','Mengubah data user dengan id = 9'),(33,1,'2023-07-31 18:24:41','Mengubah data user dengan id = 9'),(34,1,'2023-07-31 18:24:55','Menambahkan data user'),(35,1,'2023-07-31 19:04:29','Menambahkan data kendaraan'),(36,1,'2023-07-31 19:05:08','Menambahkan data kendaraan'),(37,1,'2023-07-31 19:09:29','Menambahkan data kendaraan'),(38,1,'2023-07-31 19:28:04','Menambahkan data kendaraan'),(39,1,'2023-07-31 19:30:21','Menghapus data kendaraan dengan id = 2'),(40,1,'2023-07-31 23:22:04','Menambahkan data pemesanan'),(41,1,'2023-07-31 23:23:15','Menambahkan data pemesanan'),(42,1,'2023-07-31 23:24:59','Menambahkan data pemesanan');
/*!40000 ALTER TABLE `tb_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pegawai`
--

DROP TABLE IF EXISTS `tb_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pegawai`
--

LOCK TABLES `tb_pegawai` WRITE;
/*!40000 ALTER TABLE `tb_pegawai` DISABLE KEYS */;
INSERT INTO `tb_pegawai` VALUES (1,'Muhammad Bachtiar Aldiansyah','Jl. Raya Ngijo no. 20 Ngijo, Karangploso, Kabupaten Malang','087899809981','2023-07-31 14:02:29',NULL,NULL,'Admin',NULL,NULL),(2,'Awang Setyanda','Jl. Kemantren Gg. Soekarno Hatta no. 10 Sukun, Kota Malang','085677829918','2023-07-31 14:02:59',NULL,NULL,'Admin',NULL,NULL),(3,'Sa\'ad Ubaidillah','Jl. K.H. Yusuf no. 180 Tasikmadu, Lowokwaru, Kota Malang','085788491182','2023-07-31 14:03:47',NULL,NULL,'Admin',NULL,NULL),(4,'Dimas Bintang','Jl. Soekarno-Hatta no. 28 Pasuruan, Jawa Timur','081398478851','2023-07-31 14:04:11','2023-07-31 14:08:05',NULL,'Admin','Admin',NULL);
/*!40000 ALTER TABLE `tb_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_pemesanan_kendaraan`
--

DROP TABLE IF EXISTS `tb_pemesanan_kendaraan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_pemesanan_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_pesan` varchar(50) DEFAULT NULL,
  `id_pegawai` int(11) DEFAULT NULL,
  `id_kendaraan` int(11) DEFAULT NULL,
  `id_driver` int(11) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_mulai` date DEFAULT NULL,
  `tanggal_selesai` date DEFAULT NULL,
  `verifikator` int(11) DEFAULT NULL,
  `status_approval_verifikator` tinyint(4) DEFAULT NULL,
  `status_approval_final` tinyint(4) DEFAULT NULL,
  `reason_rejected_verifikator` text DEFAULT NULL,
  `reason_rejected_final` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pegawai` (`id_pegawai`),
  KEY `id_driver` (`id_driver`),
  KEY `verifikator` (`verifikator`),
  KEY `id_kendaraan` (`id_kendaraan`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_pemesanan_kendaraan`
--

LOCK TABLES `tb_pemesanan_kendaraan` WRITE;
/*!40000 ALTER TABLE `tb_pemesanan_kendaraan` DISABLE KEYS */;
INSERT INTO `tb_pemesanan_kendaraan` VALUES (1,'ORD/2023000001',2,3,1,'Kunjungan ke tambang nikel A','2023-08-02','2023-08-02',2,0,0,NULL,NULL,'2023-07-31 21:39:06',NULL,NULL,'Admin',NULL,NULL),(3,'ORD/2023000002',1,3,1,'Pengantaran material hasil tambang nikel ke kantor cabang','2023-08-04','2023-08-04',2,0,0,NULL,NULL,'2023-07-31 23:23:15',NULL,NULL,'Admin',NULL,NULL),(4,'ORD/2023000003',3,4,1,'Mengantarkan tamu dari Arab Saudi untuk perjalanan demo tambang nikel','2023-08-10','2023-08-12',2,0,0,NULL,NULL,'2023-07-31 23:24:59',NULL,NULL,'Admin',NULL,NULL);
/*!40000 ALTER TABLE `tb_pemesanan_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_perusahaan_sewa_kendaraan`
--

DROP TABLE IF EXISTS `tb_perusahaan_sewa_kendaraan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_perusahaan_sewa_kendaraan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_perusahaan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `updated_by` varchar(50) DEFAULT NULL,
  `deleted_by` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_perusahaan_sewa_kendaraan`
--

LOCK TABLES `tb_perusahaan_sewa_kendaraan` WRITE;
/*!40000 ALTER TABLE `tb_perusahaan_sewa_kendaraan` DISABLE KEYS */;
INSERT INTO `tb_perusahaan_sewa_kendaraan` VALUES (1,'Autonet Rent Car','Jl. Perusahaan Raya no. 28 Banjararum, Singosari, Kabupaten Malang','088822224890','2023-07-31 13:47:09','2023-07-31 13:48:28',NULL,'Admin',NULL,NULL);
/*!40000 ALTER TABLE `tb_perusahaan_sewa_kendaraan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-31 23:51:49
