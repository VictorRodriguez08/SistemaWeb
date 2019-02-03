-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 03-02-2019 a las 02:29:58
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemaweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_tesis`
--

DROP TABLE IF EXISTS `archivos_tesis`;
CREATE TABLE IF NOT EXISTS `archivos_tesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tesis_id` int(11) NOT NULL,
  `nombre_archivo` varchar(100) NOT NULL,
  `tipo` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_archivo_tesis_idx` (`tesis_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `archivos_tesis`
--

INSERT INTO `archivos_tesis` (`id`, `tesis_id`, `nombre_archivo`, `tipo`, `created_at`, `updated_at`) VALUES
(18, 16, 'CARTA CONSEJO.docx', 3, '2019-02-03 01:07:08', '2019-02-03 01:07:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignar_roltra`
--

DROP TABLE IF EXISTS `asignar_roltra`;
CREATE TABLE IF NOT EXISTS `asignar_roltra` (
  `id_art` int(11) NOT NULL AUTO_INCREMENT,
  `id_gt` int(11) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `id_asigr` int(11) NOT NULL,
  `rol` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_art`),
  KEY `id_gt` (`id_gt`),
  KEY `id_trabajo` (`id_trabajo`),
  KEY `id_asigr` (`id_asigr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asig_roles`
--

DROP TABLE IF EXISTS `asig_roles`;
CREATE TABLE IF NOT EXISTS `asig_roles` (
  `id_asigr` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `fecha_asig` date NOT NULL,
  PRIMARY KEY (`id_asigr`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_rol` (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `congreso`
--

DROP TABLE IF EXISTS `congreso`;
CREATE TABLE IF NOT EXISTS `congreso` (
  `id_con` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `fecha_entrega` date NOT NULL,
  `descripcion` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `temas` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_con`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_congreso`
--

DROP TABLE IF EXISTS `d_congreso`;
CREATE TABLE IF NOT EXISTS `d_congreso` (
  `id_dcongreso` int(11) NOT NULL AUTO_INCREMENT,
  `id_con` int(11) NOT NULL,
  `id_trabajo` int(11) NOT NULL,
  `observaciones` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `notas` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `rubricas` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id_dcongreso`),
  KEY `id_con` (`id_con`),
  KEY `id_trabajo` (`id_trabajo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_tesis`
--

DROP TABLE IF EXISTS `d_tesis`;
CREATE TABLE IF NOT EXISTS `d_tesis` (
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
  KEY `id_art` (`id_art`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `d_trabajo`
--

DROP TABLE IF EXISTS `d_trabajo`;
CREATE TABLE IF NOT EXISTS `d_trabajo` (
  `id_dtrabajo` int(11) NOT NULL AUTO_INCREMENT,
  `id_trabajo` int(11) NOT NULL,
  `id_asigr` int(11) NOT NULL,
  `url_doc` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  `estado` varchar(1) CHARACTER SET latin1 DEFAULT NULL,
  `id_gt` int(11) NOT NULL,
  PRIMARY KEY (`id_dtrabajo`),
  KEY `id_trabajo` (`id_trabajo`),
  KEY `id_asigr` (`id_asigr`),
  KEY `id_gt` (`id_gt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

DROP TABLE IF EXISTS `estados`;
CREATE TABLE IF NOT EXISTS `estados` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `estado` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Perfil', NULL, NULL),
(2, 'Anteproyecto', NULL, NULL),
(3, 'Tesis', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `grupo_trabajo`
--

DROP TABLE IF EXISTS `grupo_trabajo`;
CREATE TABLE IF NOT EXISTS `grupo_trabajo` (
  `id_gt` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario1` int(11) NOT NULL,
  `id_usuario2` int(11) DEFAULT NULL,
  `id_usuario3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_gt`),
  KEY `id_usuario1` (`id_usuario1`),
  KEY `id_usuario2` (`id_usuario2`),
  KEY `id_usuario3` (`id_usuario3`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lineas_inv`
--

DROP TABLE IF EXISTS `lineas_inv`;
CREATE TABLE IF NOT EXISTS `lineas_inv` (
  `id_li` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_lineas` varchar(200) CHARACTER SET latin1 NOT NULL,
  `otros` varchar(200) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_li`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre_tabla` varchar(100) NOT NULL,
  `id_user` varchar(45) NOT NULL,
  `accion_realizada` varchar(500) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `log`
--

INSERT INTO `log` (`id`, `nombre_tabla`, `id_user`, `accion_realizada`, `updated_at`, `created_at`) VALUES
(1, 'tabla tesis', '1', 'Usuario creado con id: 7', '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(2, 'tabla tesis', '1', 'Usuario creado con id: 8', '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(3, 'tabla tesis', '1', 'Usuario creado con id: 9', '2019-01-25 23:56:16', '2019-01-25 23:56:16'),
(4, 'tabla Tesis', '1', 'Tesis creada con id: 17', '2019-02-02 20:59:45', '2019-02-02 20:59:45'),
(5, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 114', '2019-02-02 20:59:45', '2019-02-02 20:59:45'),
(6, 'tabla Tesis', '1', 'Tesis actualizada con id: 17', '2019-02-02 21:10:39', '2019-02-02 21:10:39'),
(7, 'tabla Tesis', '1', 'Tesis actualizada con id: 17', '2019-02-02 21:10:39', '2019-02-02 21:10:39'),
(8, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 115', '2019-02-02 21:10:39', '2019-02-02 21:10:39'),
(9, 'tabla Tesis', '1', 'Tesis actualizada con id: 16', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(10, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 116', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(11, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 117', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(12, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 118', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(13, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 119', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(14, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 120', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(15, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 121', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(16, 'tabla usuarioTesis', '1', 'UsuarioTesis creado con id: 122', '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(17, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 1', '2019-02-03 00:33:42', '2019-02-03 00:33:42'),
(18, 'tabla Tesis', '1', 'Tesis eliminado con id: 17', '2019-02-03 00:33:42', '2019-02-03 00:33:42'),
(19, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 7', '2019-02-03 00:44:26', '2019-02-03 00:44:26'),
(20, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 6', '2019-02-03 00:46:21', '2019-02-03 00:46:21'),
(21, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 16', '2019-02-03 00:47:21', '2019-02-03 00:47:21'),
(22, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 9', '2019-02-03 00:47:44', '2019-02-03 00:47:44'),
(23, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 11', '2019-02-03 00:49:59', '2019-02-03 00:49:59'),
(24, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 8', '2019-02-03 00:50:10', '2019-02-03 00:50:10'),
(26, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 12', '2019-02-03 00:54:12', '2019-02-03 00:54:12'),
(27, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 13', '2019-02-03 00:55:25', '2019-02-03 00:55:25'),
(28, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 14', '2019-02-03 00:55:52', '2019-02-03 00:55:52'),
(29, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 15', '2019-02-03 00:56:49', '2019-02-03 00:56:49'),
(30, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 16', '2019-02-03 00:58:37', '2019-02-03 00:58:37'),
(31, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 17', '2019-02-03 00:59:05', '2019-02-03 00:59:05'),
(32, 'tabla Archivos Tesis', '1', 'Archivo eliminado con id: 19', '2019-02-03 01:09:57', '2019-02-03 01:09:57');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_01_20_084450_create_roles_table', 1),
('2015_01_20_084525_create_role_user_table', 1),
('2015_01_24_080208_create_permissions_table', 1),
('2015_01_24_080433_create_permission_role_table', 1),
('2015_12_04_003040_add_special_role_column', 1),
('2018_10_31_193728_add_files_to_users', 1),
('2018_12_16_133129_crear_usuario_tesis', 2),
('2018_12_16_134159_crear_tabla_estados', 2),
('2018_12_16_134914_actualizar_tabla_estados', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_slug_unique` (`slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_1`
--

DROP TABLE IF EXISTS `roles_1`;
CREATE TABLE IF NOT EXISTS `roles_1` (
  `id_rol` int(10) NOT NULL AUTO_INCREMENT,
  `rol` varchar(30) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_user`
--

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE IF NOT EXISTS `role_user` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_user_role_id_index` (`role_id`),
  KEY `role_user_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tesis`
--

DROP TABLE IF EXISTS `tesis`;
CREATE TABLE IF NOT EXISTS `tesis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `estado_id` int(11) NOT NULL,
  `fecha_ini` date NOT NULL,
  `fecha_fin` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_estado` (`estado_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tesis`
--

INSERT INTO `tesis` (`id`, `titulo`, `estado_id`, `fecha_ini`, `fecha_fin`, `created_at`, `updated_at`) VALUES
(4, 'test 4', 1, '2018-12-26', '2018-12-27', '2018-12-26 19:46:56', '2018-12-26 19:46:56'),
(5, 'investigacion', 3, '2019-01-25', '2019-01-26', '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(7, 'academica', 3, '2019-01-26', '2019-03-27', '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(8, 'inestigacion', 3, '2019-01-26', '2019-01-29', '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(9, 'Tesis Informatica', 1, '2019-01-26', '2019-05-30', '2019-01-25 23:56:16', '2019-02-02 20:56:13'),
(13, 'catedra', 3, '2019-02-09', '2019-02-27', '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(14, 'test tesis', 1, '2019-02-02', NULL, '2019-02-02 18:04:47', '2019-02-02 18:04:47'),
(15, 'TESIS PRUEBA 2', 1, '2019-02-02', NULL, '2019-02-02 18:31:22', '2019-02-02 18:31:22'),
(16, 'tesis fecha fin nula', 3, '2019-02-02', NULL, '2019-02-02 18:34:23', '2019-02-02 20:32:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `trabajo`
--

DROP TABLE IF EXISTS `trabajo`;
CREATE TABLE IF NOT EXISTS `trabajo` (
  `id_trabajo` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `id_li` int(11) NOT NULL,
  PRIMARY KEY (`id_trabajo`),
  KEY `id_li` (`id_li`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
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
  `estado` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `apellidos`, `email`, `password`, `direccion`, `titulo`, `otros_estudios`, `fecha_nac`, `dui`, `telefonos`, `otros_email`, `remember_token`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Melvin', 'Jimenez', 'melvin.jtej@gmail.com', '$2y$10$Zys/Fx09eik77b.jR9FN5OivFU0MM/893Z8H2JTVr8q9qQ8IN/avm', 'Sonsonate', 'Estudiante Ingenieria en Sistemas', 'Técnico en Computación', '1990-11-22', '12345678-9', '2222-2222 2222-2222', 'mfrancisco.tejada@gmail.com', '4Y0bbxPuyARQEkQo6qi8xhjvkVvNcH0S5jhnzpLwYRQssOZscuUzBS4qnyHw', 0, '2018-12-15 00:05:14', '2019-01-08 00:47:05'),
(2, 'Francisco', 'Tejada', 'mfrancisco.tejada@gmail.com', '$2y$10$s6vGPcVg2fV1aSKOgWEUE.7xE8ivKmOyIDX/P2M1nqkNcsvmeYDvi', 'Sonsonate', 'Ingeniero en Sistemas', 'Bachiller', '1990-11-22', '12345678-9', '2222-2222', '', NULL, 0, '2018-12-15 00:23:20', '2018-12-16 06:47:59'),
(5, 'prueba', 'uno', 'uno@uno.com', '$2y$10$/OsvdiMABXlGHNyowfz78uA87cROP4UHS3lzSMzLZg1GK5KbrHSQq', 'direccion', 'titulo', '', '1980-01-01', '12345678-9', '2222-2222', '', NULL, 0, '2018-12-16 06:51:26', '2018-12-16 06:51:26'),
(6, 'Victor', 'Rodriguez Sanchez', 'vers0891@gmail.com', '$2y$10$iAbFVt5Mz1GszphRKeX6qOa2igxlXHm2T0ByQSLZJ8v14MVHO3rci', 'Sonsonate', 'Ingenieria en Sistemas', '', '0000-00-00', '12345678-9', '2117-1234', '', NULL, 0, '2018-12-17 22:15:36', '2018-12-21 02:13:55'),
(7, 'Juan', 'Perez', 'j.perez@hotmail.com', '$2y$10$bUxX0AsxT0XD5TNb2mKnL.6FU79KARX0iMSwAWqcA6j2kdu9COCce', 'Sonzacate', 'Ingenieria Electrica', '', '1990-12-24', '12345678-9', '1234-5678', '', NULL, 0, '2018-12-17 22:17:08', '2018-12-17 22:17:08'),
(8, 'Armando', 'Casas', 'a.casa@gmail.com', '$2y$10$RuOUsSLtjm1VdIdrDqxOxOYuiIda0A3IjQPApUlGRSYKzvozY44rq', 'Nahuizalco', 'Ingeniero Industrial', '', '1980-01-01', '12345678-0', '1234-5678', '', NULL, 0, '2018-12-17 22:20:20', '2018-12-17 22:20:20'),
(9, 'Pedro', 'Picapiedra', 'pedro_rocas@hotmail.com', '$2y$10$hpUGrFbcXI0/SnvO9zQe2.o9mqyx/bZm9hXwiaUq5FTno6oUDV9Hu', 'Santo Domingo', 'Ingeniero Agronomo', '', '1988-10-31', '12345678-9', '12345-6789', '', NULL, 0, '2018-12-17 22:22:08', '2018-12-21 02:13:05'),
(10, 'test', 'email', 'email@email.com', '$2y$10$S6y1xa.gnCyhv.h6TQ0WpOMabIov.QBrTIT7oZNHCwmI3M1hH7apG', 'asdads', 'asdasdasd', 'asdasd', '1980-01-01', '0', '1', '1', NULL, 0, '2018-12-27 01:03:36', '2018-12-27 01:03:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tesis`
--

DROP TABLE IF EXISTS `usuario_tesis`;
CREATE TABLE IF NOT EXISTS `usuario_tesis` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tesis_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rol` smallint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_tesis_tesis_id_index` (`tesis_id`),
  KEY `usuario_tesis_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario_tesis`
--

INSERT INTO `usuario_tesis` (`id`, `tesis_id`, `user_id`, `rol`, `created_at`, `updated_at`) VALUES
(11, 4, 1, 1, '2018-12-26 19:46:56', '2018-12-26 19:46:56'),
(12, 4, 2, 1, '2018-12-26 19:46:56', '2018-12-26 19:46:56'),
(13, 4, 5, 1, '2018-12-26 19:46:56', '2018-12-26 19:46:56'),
(22, 5, 1, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(23, 5, 2, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(24, 5, 7, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(25, 5, 9, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(26, 5, 10, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(27, 5, 8, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(28, 5, 5, 1, '2019-01-24 21:49:11', '2019-01-24 21:49:11'),
(36, 7, 1, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(37, 7, 2, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(38, 7, 8, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(39, 7, 6, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(40, 7, 7, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(41, 7, 9, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(42, 7, 10, 1, '2019-01-24 21:56:37', '2019-01-24 21:56:37'),
(43, 8, 1, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(44, 8, 6, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(45, 8, 2, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(46, 8, 5, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(47, 8, 7, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(48, 8, 8, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(49, 8, 9, 1, '2019-01-25 22:42:08', '2019-01-25 22:42:08'),
(57, 13, 1, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(58, 13, 2, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(59, 13, 5, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(60, 13, 6, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(61, 13, 7, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(62, 13, 8, 1, '2019-02-01 22:02:28', '2019-02-01 22:02:28'),
(63, 14, 5, 1, '2019-02-02 18:04:47', '2019-02-02 18:04:47'),
(64, 15, 6, 1, '2019-02-02 18:31:22', '2019-02-02 18:31:22'),
(111, 9, 1, 1, '2019-02-02 20:56:13', '2019-02-02 20:56:13'),
(112, 9, 2, 1, '2019-02-02 20:56:13', '2019-02-02 20:56:13'),
(113, 9, 6, 1, '2019-02-02 20:56:13', '2019-02-02 20:56:13'),
(116, 16, 8, 1, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(117, 16, 6, 1, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(118, 16, 2, 2, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(119, 16, 5, 1, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(120, 16, 9, 3, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(121, 16, 10, 3, '2019-02-02 21:11:52', '2019-02-02 21:11:52'),
(122, 16, 7, 3, '2019-02-02 21:11:52', '2019-02-02 21:11:52');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asignar_roltra`
--
ALTER TABLE `asignar_roltra`
  ADD CONSTRAINT `asignar_roltra_ibfk_1` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`),
  ADD CONSTRAINT `asignar_roltra_ibfk_2` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`),
  ADD CONSTRAINT `asignar_roltra_ibfk_3` FOREIGN KEY (`id_asigr`) REFERENCES `asig_roles` (`id_asigr`);

--
-- Filtros para la tabla `asig_roles`
--
ALTER TABLE `asig_roles`
  ADD CONSTRAINT `asig_roles_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `asig_roles_ibfk_2` FOREIGN KEY (`id_rol`) REFERENCES `roles_1` (`id_rol`);

--
-- Filtros para la tabla `d_congreso`
--
ALTER TABLE `d_congreso`
  ADD CONSTRAINT `d_congreso_ibfk_1` FOREIGN KEY (`id_con`) REFERENCES `congreso` (`id_con`),
  ADD CONSTRAINT `d_congreso_ibfk_3` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`);

--
-- Filtros para la tabla `d_tesis`
--
ALTER TABLE `d_tesis`
  ADD CONSTRAINT `d_tesis_ibfk_1` FOREIGN KEY (`id_tesis`) REFERENCES `tesis` (`id`),
  ADD CONSTRAINT `d_tesis_ibfk_2` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`),
  ADD CONSTRAINT `d_tesis_ibfk_3` FOREIGN KEY (`id_art`) REFERENCES `asignar_roltra` (`id_art`);

--
-- Filtros para la tabla `d_trabajo`
--
ALTER TABLE `d_trabajo`
  ADD CONSTRAINT `d_trabajo_ibfk_1` FOREIGN KEY (`id_trabajo`) REFERENCES `trabajo` (`id_trabajo`),
  ADD CONSTRAINT `d_trabajo_ibfk_2` FOREIGN KEY (`id_asigr`) REFERENCES `asig_roles` (`id_asigr`),
  ADD CONSTRAINT `d_trabajo_ibfk_3` FOREIGN KEY (`id_gt`) REFERENCES `grupo_trabajo` (`id_gt`);

--
-- Filtros para la tabla `grupo_trabajo`
--
ALTER TABLE `grupo_trabajo`
  ADD CONSTRAINT `grupo_trabajo_ibfk_1` FOREIGN KEY (`id_usuario1`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `grupo_trabajo_ibfk_2` FOREIGN KEY (`id_usuario2`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `grupo_trabajo_ibfk_3` FOREIGN KEY (`id_usuario3`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `trabajo`
--
ALTER TABLE `trabajo`
  ADD CONSTRAINT `trabajo_ibfk_1` FOREIGN KEY (`id_li`) REFERENCES `lineas_inv` (`id_li`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
