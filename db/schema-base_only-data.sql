-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 11-10-2017 a las 20:30:27
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

--
-- Volcado de datos para la tabla `obras_sociales`
--

INSERT INTO `obras_sociales` (`id`, `nombre`) VALUES
(1, 'IOMA'),
(2, 'OSECAC');

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
(13, 'datos_demograficos_destroy'),
(11, 'datos_demograficos_index'),
(12, 'datos_demograficos_new'),
(15, 'datos_demograficos_show'),
(14, 'datos_demograficos_update'),
(3, 'paciente_destroy'),
(1, 'paciente_index'),
(2, 'paciente_new'),
(5, 'paciente_show'),
(4, 'paciente_update'),
(8, 'usuario_destroy'),
(6, 'usuario_index'),
(7, 'usuario_new'),
(10, 'usuario_show'),
(9, 'usuario_update');

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(3, 'Pediatra'),
(2, 'Recepcionista');

--
-- Volcado de datos para la tabla `rol_tiene_permisos`
--

INSERT INTO `rol_tiene_permisos` (`rol_id`, `permiso_id`) VALUES
(1, 3),
(1, 1),
(2, 1),
(2, 5),
(2, 2),
(3, 2),
(2, 4),
(3, 4),
(3, 1),
(3, 5),
(1, 13),
(1, 11),
(3, 11),
(3, 12),
(3, 15),
(3, 14),
(2, 11),
(2, 12),
(2, 15),
(2, 14),
(1, 8),
(1, 6),
(1, 10),
(1, 9);

--
-- Volcado de datos para la tabla `tipos_documento`
--

INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES
(1, 'DNI');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
