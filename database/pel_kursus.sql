/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `pel_kursus` (
  `id_dafkur` bigint(20) NOT NULL AUTO_INCREMENT,
  `matrik` varchar(20) DEFAULT NULL,
  `kodkursus` varchar(20) NOT NULL,
  `sesi_sem` varchar(20) NOT NULL,
  `data_on` tinyint(1) DEFAULT 1 COMMENT '1:Subjek aktif;0:Subjek di drop',
  `ulang` tinyint(1) DEFAULT NULL,
  `kumpulan` varchar(50) DEFAULT '-',
  `carry_mark` double(7,3) DEFAULT 0.000,
  `final_mark` double(7,3) DEFAULT 0.000,
  `jummarkah` double(7,3) DEFAULT 0.000,
  `pemutihan` double(7,3) DEFAULT 0.000,
  `jummarkah_akhir` double(7,3) DEFAULT 0.000,
  `gred` varchar(4) NOT NULL DEFAULT '-',
  `gred_akhir` varchar(4) NOT NULL DEFAULT '-',
  `matagred` double(6,2) DEFAULT 0.00,
  `matagred_akhir` double(6,2) DEFAULT 0.00,
  `kredit` int(11) DEFAULT NULL,
  `user_add` varchar(30) DEFAULT NULL,
  `dt_add` datetime DEFAULT NULL,
  `user_edit` varchar(255) DEFAULT NULL,
  `dt_edit` time DEFAULT NULL,
  `kur_fee` double(7,2) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_dafkur`) USING BTREE,
  UNIQUE KEY `uniquekey` (`kodkursus`,`sesi_sem`,`data_on`,`id_dafkur`) USING BTREE,
  KEY `idxkodkursus` (`kodkursus`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=195 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;