/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `kur_tawar` (
  `id_twr` bigint(20) NOT NULL AUTO_INCREMENT,
  `sesi_sem` varchar(15) NOT NULL DEFAULT '',
  `kodkursus` varchar(10) NOT NULL DEFAULT '',
  `kod_prog` varchar(20) NOT NULL DEFAULT '',
  `est_bilpel` int(11) DEFAULT 0 COMMENT 'anggaran pelajar yang bakal mendaftar',
  `twr_on` tinyint(1) DEFAULT 1,
  `user_add` varchar(20) DEFAULT NULL,
  `dt_add` datetime DEFAULT NULL,
  `user_upd` varchar(20) DEFAULT NULL,
  `dt_upd` datetime DEFAULT NULL,
  PRIMARY KEY (`id_twr`) USING BTREE,
  UNIQUE KEY `idxkur_prog` (`kodkursus`,`kod_prog`,`sesi_sem`)
) ENGINE=InnoDB AUTO_INCREMENT=38808 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;