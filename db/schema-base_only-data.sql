-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 22-11-2017 a las 19:05:57
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

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(3, 'Pediatra'),
(2, 'Recepcionista'),
(4, 'Superadministrador');

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

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `username`, `password`, `activo`, `created_at`, `updated_at`, `session`, `first_name`, `last_name`) VALUES
(2, 'admin@admin.com', 'admin', 'c9bf17bd5e274d7b883467f70ffb6087', 1, '2017-10-14 12:59:36', '2017-11-17 23:47:38', 0, 'Señor', 'Administrador'),
(3, 'recepcionista@hnrc.com', 'recepcionista', '0963abc8847487fe0875671fb980f838', 1, '2017-10-14 13:00:24', '2017-11-20 08:55:55', 0, 'Señor', 'Recepcionista'),
(4, 'pediatra@hnrg.com', 'pediatra', '2145344b74248f25ecf6047c5f271de5', 1, '2017-10-14 13:00:59', '2017-11-20 08:55:47', 0, 'Señor', 'Pediatra'),
(5, 'su@hnrg.com', 'su', '829b13db5a760c43b3a891734d68c7f5', 1, '2017-11-17 23:48:12', '2017-11-17 23:48:12', 0, 'Señor', 'Superadministrador');

--
-- Volcado de datos para la tabla `usuario_tiene_roles`
--

INSERT INTO `usuario_tiene_roles` (`usuario_id`, `rol_id`) VALUES
(2, 1),
(4, 3),
(3, 2),
(5, 1),
(5, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
