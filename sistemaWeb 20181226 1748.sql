-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema sistemaweb
--

CREATE DATABASE IF NOT EXISTS sistemaweb;
USE sistemaweb;

--
-- Definition of table `asig_roles`
--

DROP TABLE IF EXISTS `asig_roles`;
CREATE TABLE `asig_roles` (
  `id_asigr` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_asig` date NOT NULL,
  PRIMARY KEY (`id_asigr`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `asig_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `asig_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles_1` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `asig_roles`
--

/*!40000 ALTER TABLE `asig_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `asig_roles` ENABLE KEYS */;


--
-- Definition of table `asignar_roltra`
--

DROP TABLE IF EXISTS `asignar_roltra`;
CREATE TABLE `asignar_roltra` (
  `id_art` int(11) NOT NULL AUTO_INCREMENT,
  `id_gt` int(11) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `id_asigr` int(11) NOT NULL,
  `rol` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_art`),
  KEY `id_gt` (`id_gt`),
  KEY `id_trabajo` (`id_trabajo`),
  KEY `id_asigr` (`id_asigr`),
  CONSTRAINT `asignar_roltra_ibfk_1` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`),
  CONSTRAINT `asignar_roltra_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`),
  CONSTRAINT `asignar_roltra_ibfk_3` FOREIGN KEY (`id_asigr`) REFERENCES `asig_roles` (`id_asigr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `asignar_roltra`
--

/*!40000 ALTER TABLE `asignar_roltra` DISABLE KEYS */;
/*!40000 ALTER TABLE `asignar_roltra` ENABLE KEYS */;


--
-- Definition of table `congreso`
--

DROP TABLE IF EXISTS `congreso`;
CREATE TABLE `congreso` (
  `id_con` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `temas` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `congreso`
--

/*!40000 ALTER TABLE `congreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `congreso` ENABLE KEYS */;


--
-- Definition of table `d_congreso`
--

DROP TABLE IF EXISTS `d_congreso`;
CREATE TABLE `d_congreso` (
  `id_dcongreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `observaciones` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `notas` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `rubricas` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_dcongreso`),
  KEY `id_con` (`id_con`),
  KEY `id_trabajo` (`id_trabajo`),
  CONSTRAINT `d_congreso_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `congreso` (`id_con`),
  CONSTRAINT `d_congreso_ibfk_3` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `d_congreso`
--

/*!40000 ALTER TABLE `d_congreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_congreso` ENABLE KEYS */;


--
-- Definition of table `d_tesis`
--

DROP TABLE IF EXISTS `d_tesis`;
CREATE TABLE `d_tesis` (
  `id_dtesis` int(11) NOT NULL AUTO_INCREMENT,
  `id_tesis` int(11) NOT NULL,
  `id_gt` int(11) NOT NULL,
  `id_art` int(11) NOT NULL,
  `fecha_revision` date NOT NULL,
  `observaciones` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `notas` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_final` date NOT NULL,
  `estado` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_extra` date DEFAULT NULL,
  `url_doc` varchar(300) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_dtesis`),
  KEY `id_tesis` (`id_tesis`),
  KEY `id_gt` (`id_gt`),
  KEY `id_art` (`id_art`),
  CONSTRAINT `d_tesis_ibfk_1` FOREIGN KEY (`id_tesis`) REFERENCES `tesis` (`id`),
  CONSTRAINT `d_tesis_ibfk_2` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`),
  CONSTRAINT `d_tesis_ibfk_3` FOREIGN KEY (`id_art`) REFERENCES `asignar_roltra` (`id_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `d_tesis`
--

/*!40000 ALTER TABLE `d_tesis` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_tesis` ENABLE KEYS */;


--
-- Definition of table `d_trabajo`
--

DROP TABLE IF EXISTS `d_trabajo`;
CREATE TABLE `d_trabajo` (
  `id_dtrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabajo` int(11) NOT NULL,
  `id_asigr` int(11) NOT NULL,
  `url_doc` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `estado` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `id_gt` int(11) NOT NULL,
  PRIMARY KEY (`id_dtrabajo`),
  KEY `id_trabajo` (`id_trabajo`),
  KEY `id_asigr` (`id_asigr`),
  KEY `id_gt` (`id_gt`),
  CONSTRAINT `d_trabajo_ibfk_1` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`),
  CONSTRAINT `d_trabajo_ibfk_2` FOREIGN KEY (`id_asigr`) REFERENCES `asig_roles` (`id_asigr`),
  CONSTRAINT `d_trabajo_ibfk_3` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `d_trabajo`
--

/*!40000 ALTER TABLE `d_trabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `d_trabajo` ENABLE KEYS */;


--
-- Definition of table `grupo_trabajo`
--

DROP TABLE IF EXISTS `grupo_trabajo`;
CREATE TABLE `grupo_trabajo` (
  `id_gt` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario1` int(11) NOT NULL,
  `id_usuario2` int(11) DEFAULT NULL,
  `id_usuario3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_gt`),
  KEY `id_usuario1` (`id_usuario1`),
  KEY `id_usuario2` (`id_usuario2`),
  KEY `id_usuario3` (`id_usuario3`),
  CONSTRAINT `grupo_trabajo_ibfk_1` FOREIGN KEY (`id_usuario1`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `grupo_trabajo_ibfk_2` FOREIGN KEY (`id_usuario2`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `grupo_trabajo_ibfk_3` FOREIGN KEY (`id_usuario3`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `grupo_trabajo`
--

/*!40000 ALTER TABLE `grupo_trabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `grupo_trabajo` ENABLE KEYS */;


--
-- Definition of table `lineas_inv`
--

DROP TABLE IF EXISTS `lineas_inv`;
CREATE TABLE `lineas_inv` (
  `id_li` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lineas` varchar(200) CHARACTER SET latin1 NOT NULL,
  `otros` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_li`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `lineas_inv`
--

/*!40000 ALTER TABLE `lineas_inv` DISABLE KEYS */;
/*!40000 ALTER TABLE `lineas_inv` ENABLE KEYS */;


--
-- Definition of table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) NOT NULL,
  `id_user` varchar(45) NOT NULL,
  `accion_realizada` varchar(500) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` (`id`,`nombre_tabla`,`id_user`,`accion_realizada`,`updated_at`,`created_at`) VALUES 
 (1,'tabla Usuario','5','Usuario modificado','2018-12-26 14:45:04','2018-12-26 14:45:04'),
 (2,'tabla Usuario','5','Usuario modificado','2018-12-26 14:54:20','2018-12-26 14:54:20'),
 (3,'tabla Usuario','1','Usuario eliminado','2018-12-26 14:55:41','2018-12-26 14:55:41'),
 (4,'tabla Usuario','1','Usuario modificado con id18','2018-12-26 15:12:33','2018-12-26 15:12:33');
/*!40000 ALTER TABLE `log` ENABLE KEYS */;


--
-- Definition of table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`migration`,`batch`) VALUES 
 ('2014_10_12_000000_create_users_table',1),
 ('2014_10_12_100000_create_password_resets_table',1),
 ('2015_01_20_084450_create_roles_table',1),
 ('2015_01_20_084525_create_role_user_table',1),
 ('2015_01_24_080208_create_permissions_table',1),
 ('2015_01_24_080433_create_permission_role_table',1),
 ('2015_12_04_003040_add_special_role_column',1),
 ('2018_10_31_193728_add_files_to_users',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;


--
-- Definition of table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;


--
-- Definition of table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission_role`
--

/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;


--
-- Definition of table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;


--
-- Definition of table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_user`
--

/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;


--
-- Definition of table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `special` enum('all-access','no-access') COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`),
  UNIQUE KEY `roles_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;


--
-- Definition of table `roles_1`
--

DROP TABLE IF EXISTS `roles_1`;
CREATE TABLE `roles_1` (
  `id_rol` int(10) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `roles_1`
--

/*!40000 ALTER TABLE `roles_1` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles_1` ENABLE KEYS */;


--
-- Definition of table `tesis`
--

DROP TABLE IF EXISTS `tesis`;
CREATE TABLE `tesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `nombre` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_con` (`id_con`),
  KEY `id_trabajo` (`id_trabajo`),
  CONSTRAINT `tesis_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `congreso` (`id_con`),
  CONSTRAINT `tesis_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `tesis`
--

/*!40000 ALTER TABLE `tesis` DISABLE KEYS */;
/*!40000 ALTER TABLE `tesis` ENABLE KEYS */;


--
-- Definition of table `trabajo`
--

DROP TABLE IF EXISTS `trabajo`;
CREATE TABLE `trabajo` (
  `id_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `id_li` int(11) NOT NULL,
  PRIMARY KEY (`id_trabajo`),
  KEY `id_li` (`id_li`),
  CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`id_li`) REFERENCES `lineas_inv` (`id_li`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `trabajo`
--

/*!40000 ALTER TABLE `trabajo` DISABLE KEYS */;
/*!40000 ALTER TABLE `trabajo` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otros_estudios` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `dui` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `telefonos` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `otros_email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`apellidos`,`email`,`password`,`direccion`,`titulo`,`otros_estudios`,`fecha_nac`,`dui`,`telefonos`,`otros_email`,`remember_token`,`created_at`,`updated_at`) VALUES 
 (1,'Melvin F.','Jimenez','melvin.jtej@gmail.com','$2y$10$UIMWkbq7cwW8/RfEBrnY3OYNjem/2VO9qbGvKpTfc2puq6KI14nK6','Sonsonate','Estudiante Ingenieria en Sistemas','Técnico en Computación','1990-11-22','12345678-9','2222-2222 2222-2222','mfrancisco.tejada@gmail.com',NULL,'2018-12-14 18:05:14','2018-12-26 14:54:20'),
 (2,'Francisco','Tejada','mfrancisco.tejada@gmail.com','$2y$10$s6vGPcVg2fV1aSKOgWEUE.7xE8ivKmOyIDX/P2M1nqkNcsvmeYDvi','Sonsonate','Ingeniero en Sistemas','Bachiller','1990-11-22','12345678-9','2222-2222','',NULL,'2018-12-14 18:23:20','2018-12-16 00:47:59'),
 (5,'prueba','uno','uno@uno.com','$2y$10$/OsvdiMABXlGHNyowfz78uA87cROP4UHS3lzSMzLZg1GK5KbrHSQq','direccion','titulo','','1980-01-01','12345678-9','2222-2222','','8P3chNU8vbCjSUvmLJthuVoRgBVY45E64tHAwp9X2PQbzErR9gwrb00iXcOj','2018-12-16 00:51:26','2018-12-26 14:54:54'),
 (7,'uu','ww','uno5@uno5.com','$2y$10$0xEX5Eccmc8KEn3ZrQPoPO65UX5C.SrJGHQduINsjf8UIrC0wz4Qm','dir','titu','','1980-01-01','22','22','',NULL,'2018-12-26 14:14:34','2018-12-26 14:14:34'),
 (8,'u','u','uno6@uno6.com','$2y$10$Tvb2XWCklpBrEvKH3HmrfOdZvwI1W/1ie0h0hvrh4E0tUQe.HcRqm','dir','titu','','1980-01-01','12','22','',NULL,'2018-12-26 14:16:56','2018-12-26 14:16:56'),
 (9,'uu','ii','uno7@uno7.com','$2y$10$gYCcHOzCiFUEI7gANpeJ5uQ3d./hoARE.I9l7YvV9nIO2/AtjMWYm','dir','titu','','1980-01-01','22','22','',NULL,'2018-12-26 14:19:25','2018-12-26 14:19:25'),
 (10,'jorge','barney','uno12@uno12.com','$2y$10$uNmMWtqkPxnVJPo.EOWu2esm/QC1szzaddjtsVoGDzh/5gfhb9XIG','di','ti','','1980-01-01','22','22','',NULL,'2018-12-26 14:21:11','2018-12-26 14:21:11'),
 (11,'domingo','shunico','uno11@uno11.com','$2y$10$BU9dxmLYSdeTK3Nx.0jL1.5fZ7sPllEgn7ng.jIqEIQ8UuQ2nrcr6','dir','dir','','1980-01-01','22','22','',NULL,'2018-12-26 14:23:43','2018-12-26 14:23:43'),
 (12,'uno','uno','uno14@uno14.com','$2y$10$RbCsSF0SK9hNsc3JD.fTIOnZmG2UOGyis0fSKElCaj8FQ0NUoFfGi','dir','tit','','1980-01-01','22','22','',NULL,'2018-12-26 14:26:12','2018-12-26 14:26:12'),
 (13,'uno','uno','uno121@uno122.com','$2y$10$2jQiLXQie4bvEEK.6SxsPOuRcaFt3BkuPEZOsnWp0NbCYeIZkrfem','dir','dir','','1980-01-01','2','3','',NULL,'2018-12-26 14:28:42','2018-12-26 14:28:42'),
 (14,'uno','uno','uno1234@uno.com','$2y$10$hic.Wg9axUy7Z8oa0JQr6.3uuKXXDGzn8RiMzaX.a0OjQt1rYQoOa','dir','ti','','1980-01-01','22','22','',NULL,'2018-12-26 14:31:29','2018-12-26 14:31:29'),
 (15,'uno','dos','uno12345@uno.com','$2y$10$qu1Dq3MbiUDdT.7VRWR4cOneepdhcKnFPoc5Wd7gNVFHJZJ0Yu/2.','dir','ti','','1980-01-01','2','22','',NULL,'2018-12-26 14:33:53','2018-12-26 14:33:53'),
 (16,'prueba','ya casi','uno1212@uno.com','$2y$10$LQKnr0vMSaA1EnSuTWXYYOiH/hrxbZIfgnKJzm9Hbz3cA8ecEa4Le','dir','ti','','1980-01-01','22','22','',NULL,'2018-12-26 14:35:42','2018-12-26 14:35:42'),
 (17,'uno','creo q si ','uno12124@uno.com','$2y$10$Wi4VINfEWjW0hRxWkj2X6O6fOlFz/oB1LRIyxGXF4CpdvVvRrkcpm','dir','ti','','0000-00-00','22','22','',NULL,'2018-12-26 14:38:05','2018-12-26 14:38:05'),
 (18,'Principal','hoy o si','uno12123@uno.com','$2y$10$3jZK34xhqGx10loidM.oieAVu9UYp4tStmh8cEKrbEE8BGRvTcUEu','dir','ti','','1980-01-01','22','22','',NULL,'2018-12-26 14:39:57','2018-12-26 15:12:32');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


--
-- Definition of table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(100) CHARACTER SET latin1 NOT NULL,
  `apellidos` varchar(100) CHARACTER SET latin1 NOT NULL,
  `cod_usuario` varchar(100) CHARACTER SET latin1 NOT NULL,
  `pass` varchar(100) CHARACTER SET latin1 NOT NULL,
  `direccion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `titulos` varchar(100) CHARACTER SET latin1 NOT NULL,
  `otros_estudios` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `dui` varchar(10) CHARACTER SET latin1 NOT NULL,
  `telefonos` varchar(20) CHARACTER SET latin1 NOT NULL,
  `correos_elec` varchar(300) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Dumping data for table `usuario`
--

/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;


--
-- Definition of table `usuario_tesis`
--

DROP TABLE IF EXISTS `usuario_tesis`;
CREATE TABLE `usuario_tesis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tesis_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `usuario_tesis`
--

/*!40000 ALTER TABLE `usuario_tesis` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_tesis` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
