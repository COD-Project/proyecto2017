-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: db
-- Tiempo de generación: 14-10-2017 a las 15:01:59
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
(3, 'GALLENO'),
(1, 'IOMA'),
(2, 'OSDE'),
(7, 'OSECAC'),
(6, 'OSPEPBA'),
(4, 'OSPIC'),
(5, 'PAMI');

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`id`, `nombre`) VALUES
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
(2, 'Recepcionista');

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
(3, 9);

--
-- Volcado de datos para la tabla `tipos_documento`
--

INSERT INTO `tipos_documento` (`id`, `nombre`) VALUES
(2, 'CI'),
(1, 'DNI'),
(4, 'LC'),
(3, 'LI');

--
-- Volcado de datos para la tabla `tipo_agua`
--

INSERT INTO `tipo_agua` (`id`, `nombre`) VALUES
(1, 'Corriente'),
(3, 'No tiene'),
(2, 'Pozo');

--
-- Volcado de datos para la tabla `tipo_calefaccion`
--

INSERT INTO `tipo_calefaccion` (`id`, `nombre`) VALUES
(2, 'Eléctrico'),
(1, 'Gas'),
(3, 'Leña'),
(4, 'No tiene');

--
-- Volcado de datos para la tabla `tipo_vivienda`
--

INSERT INTO `tipo_vivienda` (`id`, `nombre`) VALUES
(2, 'Casas unifamiliares'),
(3, 'Conventillos'),
(4, 'Departamento dúplex'),
(1, 'Edificio de departamentos'),
(6, 'P.H'),
(5, 'Vivienda tipo tríplex');

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `username`, `password`, `activo`, `created_at`, `updated_at`, `session`, `first_name`, `last_name`) VALUES
(1, 'admin@admin.com', 'admin', '0b1c78bc8b5b71f6f49e0f29c36db73c', 1, '2017-10-14 11:56:57', '2017-10-14 11:56:57', 0, 'Señor', 'Administrador'),
(2, 'recepcionista@hnrc.com', 'recepcionista', 'd1d038d9d63b86431fc00d944e1ac852', 1, '2017-10-14 11:58:08', '2017-10-14 11:58:08', 0, 'Señor', 'Recepcionista'),
(3, 'pediatra@hnrc.com', 'pediatra', '10616abba48177479b2b2c7411eb4021', 1, '2017-10-14 11:59:21', '2017-10-14 11:59:21', 0, 'Señor', 'Pediatra');

--
-- Volcado de datos para la tabla `usuario_tiene_roles`
--

INSERT INTO `usuario_tiene_roles` (`usuario_id`, `rol_id`) VALUES
(1, 1),
(2, 2),
(3, 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
