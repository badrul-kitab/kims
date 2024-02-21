/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE `pel_semester` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `matrik` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `count_semester` tinyint(1) DEFAULT 1,
  `semester` float(4,1) DEFAULT NULL,
  `sesi_sem` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `aktif_semasa` tinyint(1) DEFAULT 1 COMMENT 'row terkini bagi satu sesi pengajian',
  `kodstatus_pel` varchar(5) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `catatan_status` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `prog_id` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `apv_reg` tinyint(1) DEFAULT 0,
  `apv_exam` tinyint(1) DEFAULT 0,
  `apv_result` tinyint(1) DEFAULT 0,
  `user_apvresult` varchar(50) DEFAULT NULL,
  `user_apvreg` varchar(50) DEFAULT NULL,
  `user_apvexam` varchar(50) DEFAULT NULL,
  `user_apvsem` varchar(50) DEFAULT NULL,
  `catatan_apvreg` mediumtext DEFAULT NULL,
  `catatan_apvexam` mediumtext DEFAULT NULL,
  `catatan_apvsem` mediumtext DEFAULT NULL,
  `catatan_apvresult` mediumtext DEFAULT NULL,
  `print_slipexam` tinyint(1) DEFAULT 0 COMMENT '0=belum print ; 1 =dah print',
  `dt_print_slipexam` datetime DEFAULT NULL,
  `user_printslipexam` varchar(50) DEFAULT NULL,
  `user_aktifpel` varchar(50) DEFAULT NULL,
  `dt_aktifpel` datetime DEFAULT NULL,
  `data_on` tinyint(1) DEFAULT 1,
  `user_add` varchar(30) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dt_add` datetime DEFAULT NULL,
  `user_upd` varchar(30) DEFAULT NULL,
  `dt_upd` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`sesi_sem`) USING BTREE,
  UNIQUE KEY `idxid` (`id`) USING BTREE,
  KEY `idxstud` (`matrik`) USING BTREE,
  KEY `idxsem` (`semester`) USING BTREE,
  KEY `idxsesi` (`sesi_sem`) USING BTREE,
  KEY `idxstatus` (`kodstatus_pel`) USING BTREE,
  KEY `idxaktif` (`data_on`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=158390 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;