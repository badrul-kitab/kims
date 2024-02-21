/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `kur_kursus` (
  `id_kur` int(11) NOT NULL AUTO_INCREMENT,
  `kodkursus` varchar(10) NOT NULL DEFAULT '',
  `namakur_MY` varchar(255) DEFAULT NULL,
  `namakur_EN` varchar(255) DEFAULT NULL,
  `kredit` int(11) DEFAULT NULL,
  `kod_pp` varchar(10) DEFAULT NULL,
  `staf_penyelaras` varchar(10) DEFAULT NULL,
  `yuran_local` double(8,2) DEFAULT -1.00,
  `yuran_int` double(8,2) DEFAULT -1.00,
  `kod_tahap` varchar(1) DEFAULT NULL,
  `kur_on` tinyint(1) DEFAULT 1,
  `jad_kelas` tinyint(1) DEFAULT 1,
  `user_add` varchar(50) DEFAULT NULL,
  `dt_add` datetime DEFAULT NULL,
  `user_edit` varchar(50) DEFAULT NULL,
  `dt_edit` datetime DEFAULT NULL,
  PRIMARY KEY (`id_kur`) USING BTREE,
  UNIQUE KEY `kodkursus_idx` (`kodkursus`) USING BTREE,
  KEY `kod_kul_idx` (`kod_pp`),
  KEY `idx1` (`kodkursus`,`namakur_MY`,`kod_pp`)
) ENGINE=InnoDB AUTO_INCREMENT=515 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;