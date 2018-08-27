-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 26-08-2018 a las 19:08:45
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
-- Estructura de tabla para la tabla `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transmiter_id` varchar(4) NOT NULL,
  `receptor_id` varchar(4) NOT NULL,
  `message_body` text CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `time` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `messages`
--

INSERT INTO `messages` (`id`, `transmiter_id`, `receptor_id`, `message_body`, `time`) VALUES
(1, '19', '21', 'sdf', '2018-08-19T22:10:25-04:00'),
(2, '19', '21', 'nuevo mensaje para lucia', '2018-08-19T22:12:33-04:00'),
(3, '19', '20', 'Nuevo mensaje para Joseito', '2018-08-19T22:12:42-04:00'),
(4, '20', '19', 'mensaje de especialista', '2018-08-19T22:12:50-04:00'),
(5, '19', '20', 'tercer mensaje de johangel', '2018-08-19T22:37:47-04:00'),
(6, '19', '20', 'mensaje largo pero perron para demostrar que la vaina funciona de hecho de manera perrona', '2018-08-19T22:55:38-04:00'),
(7, '20', '19', 'Hola johangel, esta vaina es un beta', '2018-08-19T23:05:15-04:00'),
(8, '19', '20', 'Hola johangelito, como estas.', '2018-08-19T23:14:03-04:00'),
(9, '20', '19', 'Bien don jose.', '2018-08-19T23:14:08-04:00'),
(10, '20', '19', 'l', '2018-08-19T23:24:41-04:00'),
(11, '19', '20', 'aja', '2018-08-20T08:56:26-04:00'),
(12, '19', '21', 'alo', '2018-08-20T13:08:55-04:00'),
(13, '19', '20', 'aja', '2018-08-20T13:09:07-04:00'),
(14, '19', '20', 'que lo que', '2018-08-23T08:32:37-04:00'),
(15, '19', '20', 'nuevo mensaje de johangel para jose', '2018-08-23T09:31:12-04:00'),
(16, '19', '20', 'dds', '2018-08-25T17:44:36-04:00'),
(17, '20', '19', 'sd', '2018-08-26T08:21:00-04:00'),
(18, '20', '19', 'aja', '2018-08-26T08:31:25-04:00'),
(19, '20', '19', 'fgd', '2018-08-26T08:31:47-04:00'),
(20, '20', '19', 'prueba', '2018-08-26T08:32:29-04:00'),
(21, '19', '21', 'panocha', '2018-08-26T08:55:26-04:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id_notification`, `reservation_id`, `type_user`, `user_id`) VALUES
(58, 39, 'Especialista', 21),
(57, 39, 'Usuario', 19),
(56, 38, 'Especialista', 23),
(55, 38, 'Usuario', 19),
(48, 34, 'Especialista', 20),
(50, 35, 'Especialista', 21),
(54, 37, 'Especialista', 21),
(52, 36, 'Especialista', 20),
(53, 37, 'Usuario', 19),
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
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `id_specialist`, `title`, `start`, `end`, `id_client`, `cost`, `specialist`, `client`) VALUES
(31, 20, 'Consulta numero 1', '2018-08-17T09:00:00', '2018-08-17T09:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(36, 20, 'Consulta dolor higado', '2018-08-25T12:00:00', '2018-08-25T12:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(33, 20, 'reserva rosmery', '2018-08-17T11:30:00', '2018-08-17T12:00:00', 22, '23$', 'jose perez', 'rosmery'),
(34, 20, 'me duele la muela', '2018-07-30T08:00:00', '2018-07-30T08:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(35, 21, 'prueba', '2018-08-20T09:00:00', '2018-08-20T09:30:00', 19, '15$', 'maria lucia', 'Johangel leon'),
(32, 20, 'consulta numero 2', '2018-08-17T13:00:00', '2018-08-17T13:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(38, 23, 'consulta prueba', '2018-08-26T10:00:00', '2018-08-26T10:30:00', 19, '5$', 'El perro caliente', 'Johangel leon'),
(39, 21, 'reserva prueba maria', '2018-08-26T10:00:00', '2018-08-26T10:30:00', 19, '15$', 'maria lucia', 'Johangel leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialist_field`
--

DROP TABLE IF EXISTS `specialist_field`;
CREATE TABLE IF NOT EXISTS `specialist_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `specialist_field`
--

INSERT INTO `specialist_field` (`id`, `Name`) VALUES
(2, 'Traumatologia'),
(13, 'Emergencia'),
(7, 'Odontologia');

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
  `days` varchar(40) NOT NULL,
  `hoursFrom` varchar(100) NOT NULL,
  `hoursTo` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `specialist_info`
--

INSERT INTO `specialist_info` (`id`, `user_id`, `active`, `specialistField`, `cmd`, `salary`, `days`, `hoursFrom`, `hoursTo`) VALUES
(15, 21, 1, 'Traumatologia', '123123', 15, '0,1,2,3,4,5,6', '8:00', '17:00'),
(14, 20, 1, 'Odontologia', '1231231', 22, '1,4,6', '11:00', '17:00'),
(18, 23, 1, 'Traumatologia', '12', 5, '0,1,2,3,4,5,6', '8:00', '17:00');

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
  `profile_img` varchar(70) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `rol`, `genero`, `edad`, `fecha_nacimiento`, `tipo_sangre`, `Dni`, `profile_img`) VALUES
(6, 20, 'Especialista', 'Hombre', 27, '2018-08-16', 'A Negativo', '231242231', '23_08_2018_13_33_00firmaPrueba.png'),
(5, 19, 'usuario', 'Hombre', 23, '2018-08-08', 'B Positivo', '123123', '23_08_2018_12_32_30img_muestra.jpg'),
(4, 18, 'Administrador', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 21, 'Especialista', 'Mujer', 25, '2018-08-30', 'AB Positivo', '123123', '19_08_2018_15_00_29img_muestra.jpg'),
(8, 22, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 23, 'Especialista', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 38, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL);

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
  `validated` varchar(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `nombre`, `clave`, `validated`) VALUES
(19, 'johangel@gmail.com', 'Johangel leon', 'secret', '1'),
(18, 'Pepe@gmail.com', 'Pepe', 'secret', '1'),
(20, 'jose@gmail.com', 'jose perez', 'secret', '1'),
(21, 'maria@gmail.com', 'maria lucia', 'secret', '1'),
(22, 'rosmery@gmail.com', 'rosmery', 'secret', '1'),
(23, 'perro@gmail.com', 'El perro caliente', 'secret', '1'),
(38, 'johangel2807@gmail.com', 'Johangel Leon', 'secret', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `validation_keys`
--

DROP TABLE IF EXISTS `validation_keys`;
CREATE TABLE IF NOT EXISTS `validation_keys` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `validation_key` varchar(50) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
