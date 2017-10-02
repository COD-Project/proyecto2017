-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 02-10-2017 a las 15:55:35
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
-- Estructura de tabla para la tabla `controles_de_salud`
--
-- Creación: 02-10-2017 a las 15:51:05
--

DROP TABLE IF EXISTS `controles_de_salud`;
CREATE TABLE IF NOT EXISTS `controles_de_salud` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edad` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `peso` int(11) NOT NULL,
  `vacunas_completas` tinyint(1) NOT NULL,
  `maduracion_acorde` tinyint(1) NOT NULL,
  `ex_fisico_normal` tinyint(1) NOT NULL,
  `ex_fisico_observaciones` varchar(255) NOT NULL,
  `pc` int(11) DEFAULT NULL,
  `ppc` int(11) DEFAULT NULL,
  `talla` int(11) DEFAULT NULL,
  `alimentacion` varchar(255) NOT NULL,
  `observaciones_generales` varchar(255) NOT NULL,
  `paciente_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `paciente_id` (`paciente_id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_demograficos`
--
-- Creación: 02-10-2017 a las 15:52:11
--

DROP TABLE IF EXISTS `datos_demograficos`;
CREATE TABLE IF NOT EXISTS `datos_demograficos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heladera` tinyint(1) NOT NULL DEFAULT '0',
  `electricidad` tinyint(1) NOT NULL DEFAULT '0',
  `mascota` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Para vos Ulises',
  `tipo_vivienda_id` int(11) DEFAULT NULL,
  `tipo_calefaccion_id` int(11) DEFAULT NULL,
  `tipo_agua_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo_vivienda_id` (`tipo_vivienda_id`),
  UNIQUE KEY `tipo_calefaccion_id` (`tipo_calefaccion_id`),
  UNIQUE KEY `tipo_agua_id` (`tipo_agua_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `obras_sociales`
--
-- Creación: 02-10-2017 a las 15:51:00
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
-- Creación: 02-10-2017 a las 15:51:07
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `apellido` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `domicilio` varchar(255) NOT NULL,
  `telefono` varchar(255) NOT NULL,
  `fecha_nac` date NOT NULL,
  `genero` tinytext NOT NULL,
  `datos_demograficos_id` int(11) DEFAULT NULL,
  `obra_social_id` int(11) DEFAULT NULL,
  `tipo_doc_id` int(11) DEFAULT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `datos_demograficos_id` (`datos_demograficos_id`),
  UNIQUE KEY `obra_social_id` (`obra_social_id`),
  UNIQUE KEY `tipo_doc_id` (`tipo_doc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--
-- Creación: 02-10-2017 a las 15:50:54
--

DROP TABLE IF EXISTS `permisos`;
CREATE TABLE IF NOT EXISTS `permisos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--
-- Creación: 02-10-2017 a las 15:50:55
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol_tiene_permisos`
--
-- Creación: 02-10-2017 a las 15:55:07
--

DROP TABLE IF EXISTS `rol_tiene_permisos`;
CREATE TABLE IF NOT EXISTS `rol_tiene_permisos` (
  `rol_id` int(11) NOT NULL,
  `permiso_id` int(11) NOT NULL,
  UNIQUE KEY `rol_id` (`rol_id`),
  UNIQUE KEY `permiso_id` (`permiso_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documento`
--
-- Creación: 02-10-2017 a las 15:51:02
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
-- Creación: 02-10-2017 a las 15:51:03
--

DROP TABLE IF EXISTS `tipo_agua`;
CREATE TABLE IF NOT EXISTS `tipo_agua` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_calefaccion`
--
-- Creación: 02-10-2017 a las 15:51:03
--

DROP TABLE IF EXISTS `tipo_calefaccion`;
CREATE TABLE IF NOT EXISTS `tipo_calefaccion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_vivienda`
--
-- Creación: 02-10-2017 a las 15:51:04
--

DROP TABLE IF EXISTS `tipo_vivienda`;
CREATE TABLE IF NOT EXISTS `tipo_vivienda` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--
-- Creación: 02-10-2017 a las 15:51:05
-- Última actualización: 02-10-2017 a las 15:51:04
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
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_tiene_roles`
--
-- Creación: 02-10-2017 a las 15:54:31
--

DROP TABLE IF EXISTS `usuario_tiene_roles`;
CREATE TABLE IF NOT EXISTS `usuario_tiene_roles` (
  `usuario_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  UNIQUE KEY `usuario_id` (`usuario_id`),
  UNIQUE KEY `rol_id` (`rol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Restricciones para tablas volcadas
--

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
