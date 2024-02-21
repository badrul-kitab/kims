/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `pel_transkrip` (
  `id_trans` int(11) NOT NULL AUTO_INCREMENT,
  `matrik` varchar(15) NOT NULL DEFAULT '-',
  `sesi_sem` varchar(20) NOT NULL,
  `semester` varchar(5) NOT NULL DEFAULT '0.0',
  `prog_id` varchar(200) DEFAULT NULL,
  `j_mata` float(7,3) DEFAULT NULL,
  `j_kredit` int(11) DEFAULT NULL,
  `png` float(7,3) DEFAULT NULL,
  `kptsan_sms` varchar(120) DEFAULT NULL,
  `mata_kumpul` float(7,3) DEFAULT NULL,
  `kredit_kumpul` int(11) DEFAULT NULL,
  `pngk` float(7,3) DEFAULT NULL,
  `kptsan_lps` varchar(80) DEFAULT '',
  `status_view` tinyint(1) DEFAULT 0,
  `catatan` varchar(30) DEFAULT NULL,
  `aktif` tinyint(1) DEFAULT 1,
  `exam_category` varchar(15) DEFAULT 'NORMAL',
  `jana_slip` tinyint(1) DEFAULT 0,
  `dtime_jana` datetime DEFAULT NULL,
  PRIMARY KEY (`id_trans`) USING BTREE,
  KEY `idxsesi` (`sesi_sem`) USING BTREE,
  KEY `idxsem` (`semester`) USING BTREE,
  KEY `idxkpt` (`kptsan_sms`) USING BTREE,
  KEY `idxkodprog` (`prog_id`) USING BTREE,
  KEY `idxcat` (`exam_category`) USING BTREE,
  KEY `idxindex` (`sesi_sem`,`semester`,`aktif`,`prog_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;