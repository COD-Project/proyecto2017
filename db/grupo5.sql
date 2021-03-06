-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 22-11-2017 a las 20:54:10
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `grupo5`
--
CREATE DATABASE IF NOT EXISTS `grupo5` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `grupo5`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `configuraciones`
--

DROP TABLE IF EXISTS `configuraciones`;
CREATE TABLE IF NOT EXISTS `configuraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_app` varchar(255) NOT NULL,
  `cantidad_por_pagina` tinyint(4) NOT NULL DEFAULT '7',
  `mail_contacto` varchar(63) NOT NULL,
  `descripcion` varchar(511) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `mantenimiento` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `controles_de_salud`
--

DROP TABLE IF EXISTS `controles_de_salud`;
CREATE TABLE IF NOT EXISTS `controles_de_salud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `peso` int(11) NOT NULL,
  `vacunas_completas` tinyint(1) NOT NULL DEFAULT '0',
  `vacunas_observaciones` varchar(255) NOT NULL,
  `maduracion_acorde` tinyint(1) NOT NULL DEFAULT '0',
  `maduracion_observacion` varchar(255) NOT NULL,
  `ex_fisico_normal` tinyint(1) NOT NULL DEFAULT '0',
  `ex_fisico_observaciones` varchar(255) NOT NULL,
  `pc` int(11) DEFAULT NULL,
  `ppc` int(11) DEFAULT NULL,
  `talla` int(11) DEFAULT NULL,
  `alimentacion` varchar(255) DEFAULT NULL,
  `observaciones_generales` varchar(255) DEFAULT NULL,
  `paciente_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `paciente_id` (`paciente_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_demograficos`
--

DROP TABLE IF EXISTS `datos_demograficos`;
CREATE TABLE IF NOT EXISTS `datos_demograficos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heladera` tinyint(1) NOT NULL DEFAULT '0',
  `electricidad` tinyint(1) NOT NULL DEFAULT '0',
  `mascota` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Para vos Ulises',
  `tipo_vivienda_id` int(11) NOT NULL,
  `tipo_calefaccion_id` int(11) NOT NULL,
  `tipo_agua_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_vivienda_id` (`tipo_vivienda_id`),
  KEY `tipo_calefaccion_id` (`tipo_calefaccion_id`),
  KEY `tipo_agua_id` (`tipo_agua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras_sociales`
--

DROP TABLE IF EXISTS `obras_sociales`;
CREATE TABLE IF NOT EXISTS `obras_sociales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `telefono` varchar(255) DEFAULT NULL,
  `fecha_nac` date NOT NULL,
  `genero` enum('Masculino','Femenino') NOT NULL,
  `datos_demograficos_id` int(11) DEFAULT NULL,
  `obra_social_id` int(11) DEFAULT NULL,
  `tipo_doc_id` int(11) NOT NULL,
  `numero_doc` int(11) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `tipo_doc_id` (`tipo_doc_id`),
  KEY `datos_demograficos_id` (`datos_demograficos_id`),
  KEY `obra_social_id` (`obra_social_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(22, 'control_salud_destroy'),
(18, 'control_salud_index'),
(20, 'control_salud_new'),
(19, 'control_salud_show'),
(21, 'control_salud_update'),
(17, 'debug_index'),
(16, 'log_index'),
(10, 'paciente_destroy'),
(6, 'paciente_index'),
(8, 'paciente_new'),
(7, 'paciente_show'),
(9, 'paciente_update'),
(15, 'rol_destroy'),
(11, 'rol_index'),
(13, 'rol_new'),
(12, 'rol_show'),
(14, 'rol_update'),
(5, 'usuario_destroy'),
(1, 'usuario_index'),
(3, 'usuario_new'),
(2, 'usuario_show'),
(4, 'usuario_update');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(3, 'Pediatra'),
(2, 'Recepcionista'),
(4, 'Superadministrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_tiene_permisos`
--

DROP TABLE IF EXISTS `rol_tiene_permisos`;
CREATE TABLE IF NOT EXISTS `rol_tiene_permisos` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  KEY `rol_id` (`rol_id`),
  KEY `permiso_id` (`permiso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `rol_tiene_permisos`
--

INSERT INTO `rol_tiene_permisos` (`rol_id`, `permiso_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(2, 6),
(2, 7),
(2, 8),
(2, 9),
(3, 6),
(3, 7),
(3, 8),
(3, 9),
(4, 10),
(4, 6),
(4, 8),
(4, 7),
(4, 9),
(4, 15),
(4, 11),
(4, 13),
(4, 12),
(4, 14),
(4, 5),
(4, 1),
(4, 3),
(4, 2),
(4, 4),
(4, 22),
(4, 18),
(4, 20),
(4, 19),
(4, 21),
(4, 17),
(4, 16),
(3, 18),
(3, 20),
(3, 19),
(3, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--

DROP TABLE IF EXISTS `tipos_documento`;
CREATE TABLE IF NOT EXISTS `tipos_documento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_agua`
--

DROP TABLE IF EXISTS `tipo_agua`;
CREATE TABLE IF NOT EXISTS `tipo_agua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_calefaccion`
--

DROP TABLE IF EXISTS `tipo_calefaccion`;
CREATE TABLE IF NOT EXISTS `tipo_calefaccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vivienda`
--

DROP TABLE IF EXISTS `tipo_vivienda`;
CREATE TABLE IF NOT EXISTS `tipo_vivienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `turnos`
--

DROP TABLE IF EXISTS `turnos`;
CREATE TABLE IF NOT EXISTS `turnos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `horario` time NOT NULL,
  `numero_doc` int(11) NOT NULL,
  `chat_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `activo` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `session` int(11) DEFAULT '0',
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `username`, `password`, `activo`, `created_at`, `updated_at`, `session`, `first_name`, `last_name`) VALUES
(2, 'admin@admin.com', 'admin', 'c9bf17bd5e274d7b883467f70ffb6087', 1, '2017-10-14 12:59:36', '2017-11-17 23:47:38', 0, 'Señor', 'Administrador'),
(3, 'recepcionista@hnrc.com', 'recepcionista', '0963abc8847487fe0875671fb980f838', 1, '2017-10-14 13:00:24', '2017-11-20 08:55:55', 0, 'Señor', 'Recepcionista'),
(4, 'pediatra@hnrg.com', 'pediatra', '2145344b74248f25ecf6047c5f271de5', 1, '2017-10-14 13:00:59', '2017-11-20 08:55:47', 0, 'Señor', 'Pediatra'),
(5, 'su@hnrg.com', 'su', '829b13db5a760c43b3a891734d68c7f5', 1, '2017-11-17 23:48:12', '2017-11-17 23:48:12', 0, 'Señor', 'Superadministrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_roles`
--

DROP TABLE IF EXISTS `usuario_tiene_roles`;
CREATE TABLE IF NOT EXISTS `usuario_tiene_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  KEY `usuario_id` (`usuario_id`),
  KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `usuario_tiene_roles`
--

INSERT INTO `usuario_tiene_roles` (`usuario_id`, `rol_id`) VALUES
(2, 1),
(4, 3),
(3, 2),
(5, 1),
(5, 4);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `configuraciones`
--
ALTER TABLE `configuraciones`
  ADD CONSTRAINT `configuraciones_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `controles_de_salud`
--
ALTER TABLE `controles_de_salud`
  ADD CONSTRAINT `controles_de_salud_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `controles_de_salud_ibfk_2` FOREIGN KEY (`paciente_id`) REFERENCES `pacientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `datos_demograficos`
--
ALTER TABLE `datos_demograficos`
  ADD CONSTRAINT `datos_demograficos_ibfk_1` FOREIGN KEY (`tipo_agua_id`) REFERENCES `tipo_agua` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `datos_demograficos_ibfk_2` FOREIGN KEY (`tipo_calefaccion_id`) REFERENCES `tipo_calefaccion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `datos_demograficos_ibfk_3` FOREIGN KEY (`tipo_vivienda_id`) REFERENCES `tipo_vivienda` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`datos_demograficos_id`) REFERENCES `datos_demograficos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`obra_social_id`) REFERENCES `obras_sociales` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pacientes_ibfk_3` FOREIGN KEY (`tipo_doc_id`) REFERENCES `tipos_documento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `rol_tiene_permisos`
--
ALTER TABLE `rol_tiene_permisos`
  ADD CONSTRAINT `rol_tiene_permisos_ibfk_1` FOREIGN KEY (`permiso_id`) REFERENCES `permisos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rol_tiene_permisos_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario_tiene_roles`
--
ALTER TABLE `usuario_tiene_roles`
  ADD CONSTRAINT `usuario_tiene_roles_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `usuario_tiene_roles_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
