-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 17-08-2018 a las 14:22:25
-- Versión del servidor: 5.7.19
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `reservas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `reservation_id` int(11) NOT NULL,
  `type_user` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id_notification`, `reservation_id`, `type_user`, `user_id`) VALUES
(46, 33, 'Especialista', 20),
(44, 32, 'Especialista', 20),
(43, 32, 'Usuario', 19),
(42, 31, 'Especialista', 20),
(45, 33, 'Usuario', 22);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_specialist` int(5) NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) DEFAULT NULL,
  `id_client` int(5) NOT NULL,
  `cost` varchar(20) NOT NULL,
  `specialist` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `client` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `id_specialist`, `title`, `start`, `end`, `id_client`, `cost`, `specialist`, `client`) VALUES
(31, 20, 'Consulta numero 1', '2018-08-17T09:00:00', '2018-08-17T09:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(33, 20, 'reserva rosmery', '2018-08-17T11:30:00', '2018-08-17T12:00:00', 22, '23$', 'jose perez', 'rosmery'),
(32, 20, 'consulta numero 2', '2018-08-17T13:00:00', '2018-08-17T13:30:00', 19, '23$', 'jose perez', 'Johangel leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialist_info`
--

DROP TABLE IF EXISTS `specialist_info`;
CREATE TABLE IF NOT EXISTS `specialist_info` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `active` tinyint(1) NOT NULL,
  `specialistField` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `cmd` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish_ci NOT NULL,
  `salary` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `specialist_info`
--

INSERT INTO `specialist_info` (`id`, `user_id`, `active`, `specialistField`, `cmd`, `salary`) VALUES
(14, 20, 0, 'Odontologia', '1231231', 23);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_info`
--

DROP TABLE IF EXISTS `user_info`;
CREATE TABLE IF NOT EXISTS `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `rol` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `genero` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `edad` int(3) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `tipo_sangre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  `Dni` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `rol`, `genero`, `edad`, `fecha_nacimiento`, `tipo_sangre`, `Dni`) VALUES
(6, 20, 'Especialista', 'Hombre', 27, '2018-08-16', 'A Negativo', '231242231'),
(5, 19, 'usuario', 'Hombre', 23, '2018-08-08', 'B Positivo', '123123'),
(4, 18, 'Administrador', NULL, NULL, NULL, NULL, NULL),
(7, 21, 'Usuario', 'Mujer', 25, '2018-08-30', 'AB Positivo', '123123'),
(8, 22, 'usuario', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `correo` varchar(250) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `clave` varchar(40) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `nombre`, `clave`) VALUES
(19, 'johangel@gmail.com', 'Johangel leon', 'secret'),
(18, 'Pepe@gmail.com', 'Pepe', 'secret'),
(20, 'jose@gmail.com', 'jose perez', 'secret'),
(21, 'maria@gmail.com', 'maria lucia', 'secret'),
(22, 'rosmery@gmail.com', 'rosmery', 'secret');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
