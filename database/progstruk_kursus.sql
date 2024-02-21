/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `progstruk_kursus` (
  `id_kur` bigint(20) NOT NULL AUTO_INCREMENT,
  `kod_progstruk` varchar(30) NOT NULL,
  `CATATAN_TEMP` varchar(200) DEFAULT NULL,
  `kodkursus` varchar(20) NOT NULL DEFAULT '',
  `sem` varchar(5) DEFAULT '',
  `kredit` int(11) DEFAULT 0,
  `kod_katkur` varchar(25) DEFAULT NULL COMMENT 'refer table pilih_katkur',
  `data_on` tinyint(1) DEFAULT 1,
  `user_add` varchar(20) DEFAULT NULL,
  `dt_add` datetime DEFAULT NULL,
  `user_edit` varchar(20) DEFAULT NULL,
  `dt_upd` datetime DEFAULT NULL,
  `tahun` tinyint(1) DEFAULT NULL,
  `warga` tinyint(1) DEFAULT NULL COMMENT '0: ALL; 1: Malaysian; 2: International',
  PRIMARY KEY (`id_kur`) USING BTREE,
  KEY `idx` (`kodkursus`,`sem`) USING BTREE,
  KEY `idx_idstruk` (`data_on`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=457 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci ROW_FORMAT=DYNAMIC;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;