/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `pel_pelajar` (
  `idpel` int(11) NOT NULL AUTO_INCREMENT,
  `matrik` varchar(15) NOT NULL DEFAULT '',
  `kppass_pel` varchar(25) DEFAULT NULL,
  `nama_pel` varchar(200) DEFAULT NULL,
  `kod_prog` varchar(200) DEFAULT NULL,
  `kod_progstruk` varchar(20) DEFAULT NULL,
  `yuranstruk_id` varchar(15) DEFAULT NULL,
  `gredskema_id` varchar(20) DEFAULT NULL,
  `status_pel` varchar(2) DEFAULT NULL,
  `tarikh_lahir` date DEFAULT NULL,
  `jantina` varchar(1) DEFAULT NULL,
  `user_upd` varchar(25) DEFAULT NULL,
  `dt_upd` datetime DEFAULT NULL,
  `warganegara` varchar(20) DEFAULT NULL,
  `status_wnegara` varchar(3) DEFAULT NULL,
  `bangsa` varchar(10) DEFAULT NULL,
  `agama` varchar(10) DEFAULT NULL,
  `taraf_kahwin` varchar(15) DEFAULT NULL,
  `almt1_pel` varchar(200) DEFAULT NULL,
  `almt2_pel` varchar(200) DEFAULT NULL,
  `pos_pel` varchar(20) DEFAULT NULL,
  `bandar_pel` varchar(150) DEFAULT NULL,
  `negeri_pel` varchar(150) DEFAULT NULL,
  `negara_pel` varchar(50) DEFAULT NULL,
  `notel_pel` varchar(25) DEFAULT NULL,
  `nohp_pel` varchar(25) DEFAULT NULL,
  `tarikh_daftar` date DEFAULT NULL,
  `sesi_daftar` varchar(15) DEFAULT NULL,
  `user_daftar` varchar(100) DEFAULT NULL,
  `dt_daftar` datetime DEFAULT NULL,
  `sesikonvo` char(15) DEFAULT NULL,
  `jangkatamat` varchar(15) DEFAULT NULL,
  `modstudy` varchar(2) DEFAULT '1' COMMENT 'F=FULLTIME; W=WEEKEND',
  `kelayakan_masuk` varchar(2) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `catatan` longtext DEFAULT NULL,
  `oku` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`idpel`) USING BTREE,
  UNIQUE KEY `idxidstud` (`idpel`) USING BTREE,
  KEY `idxkodprog` (`kod_prog`) USING BTREE,
  KEY `idxkp` (`kppass_pel`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1024 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;