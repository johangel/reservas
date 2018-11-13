-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 09-10-2018 a las 17:48:30
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
-- Estructura de tabla para la tabla `info_notifications`
--

DROP TABLE IF EXISTS `info_notifications`;
CREATE TABLE IF NOT EXISTS `info_notifications` (
  `id_notification` int(4) NOT NULL AUTO_INCREMENT,
  `user_id` int(4) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `info_notifications`
--

INSERT INTO `info_notifications` (`id_notification`, `user_id`, `message`) VALUES
(7, 22, 'El especialista jose perez cambio sus horas de ejercicio, verificar si las reservas con dicho profesional permanecen en horas validas'),
(3, 22, 'El especialista jose perez cambio sus horas de ejercicio, verificar si las reservas con dicho profesional permanecen en horas validas'),
(5, 22, 'El especialista jose perez cambio sus horas de ejercicio, verificar si las reservas con dicho profesional permanecen en horas validas'),
(10, 22, 'El especialista jose perez cambio sus horas de ejercicio, verificar si las reservas con dicho profesional permanecen en horas validas');

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
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

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
(21, '19', '21', 'panocha', '2018-08-26T08:55:26-04:00'),
(22, '19', '20', 'aja', '2018-08-28T09:39:11-04:00'),
(23, '19', '20', 'nueva notificacion', '2018-08-28T09:51:41-04:00'),
(24, '19', '20', 'otra mas', '2018-08-28T09:52:24-04:00'),
(25, '19', '20', 'tercera nueva notificacion', '2018-08-28T09:52:55-04:00'),
(26, '19', '20', 'cuarta notificacion', '2018-08-28T09:53:44-04:00'),
(27, '20', '22', 'y ahora que', '2018-08-28T10:24:02-04:00'),
(28, '22', '20', 'ahora tu tienes una notificacion ', '2018-08-28T10:25:28-04:00'),
(29, '20', '19', 'hola johangel vengo a dejarte unas notificaciones ', '2018-08-28T10:38:24-04:00'),
(30, '20', '19', 'segunda notificacion', '2018-08-28T10:38:31-04:00'),
(31, '19', '23', 'sd', '2018-08-28T10:39:27-04:00'),
(32, '19', '20', 'Nuevo mensaje de prueba', '2018-08-28T12:23:10-04:00'),
(33, '20', '19', 'a', '2018-08-28T12:23:36-04:00'),
(34, '20', '19', 's', '2018-08-28T12:23:36-04:00'),
(35, '20', '19', 'd', '2018-08-28T12:23:37-04:00'),
(36, '20', '19', 's', '2018-08-28T12:23:37-04:00'),
(37, '20', '19', 'w', '2018-08-28T12:23:38-04:00'),
(38, '19', '23', 'ddsf', '2018-08-29T14:00:10-04:00'),
(39, '19', '23', 'sdf', '2018-08-29T14:00:44-04:00'),
(40, '19', '20', 'dfg', '2018-08-31T16:56:13-04:00'),
(41, '19', '20', 's', '2018-08-31T16:56:22-04:00'),
(42, '19', '20', 'df', '2018-08-31T16:56:23-04:00'),
(43, '19', '20', 'df', '2018-08-31T16:56:24-04:00'),
(44, '19', '20', 'nuevo mensaje', '2018-09-01T09:00:39-04:00'),
(45, '19', '20', 'mensaje de prueba', '2018-10-01T07:32:11-04:00'),
(46, '19', '20', ' ', '2018-10-06T20:55:49-04:00'),
(47, '19', '20', '     ', '2018-10-06T20:55:52-04:00'),
(48, '19', '20', '   ', '2018-10-06T20:57:44-04:00'),
(49, '19', '20', '  ', '2018-10-06T20:57:51-04:00'),
(50, '19', '20', '   ', '2018-10-06T21:00:40-04:00'),
(51, '19', '21', 'sd', '2018-10-06T21:01:57-04:00'),
(52, '19', '21', '  ', '2018-10-06T21:02:00-04:00'),
(53, '19', '23', '   ', '2018-10-06T21:04:17-04:00'),
(54, '19', '23', 'asda', '2018-10-06T21:04:20-04:00'),
(55, '19', '23', ' ', '2018-10-06T21:04:21-04:00'),
(56, '19', '23', '    ', '2018-10-06T21:06:27-04:00'),
(57, '19', '23', '  ', '2018-10-06T21:08:34-04:00'),
(58, '19', '23', 'sda', '2018-10-06T21:10:01-04:00'),
(59, '', '', '', ''),
(60, '19', '20', 'terte', '2018-10-07T13:19:09-04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `message_notification`
--

DROP TABLE IF EXISTS `message_notification`;
CREATE TABLE IF NOT EXISTS `message_notification` (
  `id_notification` int(11) NOT NULL AUTO_INCREMENT,
  `id_receptor` int(4) NOT NULL,
  `id_transmiter` int(4) NOT NULL,
  `amount` int(4) NOT NULL,
  PRIMARY KEY (`id_notification`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `message_notification`
--

INSERT INTO `message_notification` (`id_notification`, `id_receptor`, `id_transmiter`, `amount`) VALUES
(1, 20, 19, 12),
(2, 22, 20, 2),
(3, 20, 22, 1),
(4, 19, 20, 0),
(5, 23, 19, 6),
(6, 21, 19, 2);

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
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `notifications`
--

INSERT INTO `notifications` (`id_notification`, `reservation_id`, `type_user`, `user_id`) VALUES
(64, 42, 'Especialista', 20),
(76, 48, 'Especialista', 20),
(62, 41, 'Especialista', 21),
(70, 45, 'Especialista', 21),
(60, 40, 'Especialista', 20),
(59, 40, 'Usuario', 19),
(58, 39, 'Especialista', 21),
(74, 47, 'Especialista', 20),
(56, 38, 'Especialista', 23),
(48, 34, 'Especialista', 20),
(50, 35, 'Especialista', 21),
(54, 37, 'Especialista', 21),
(72, 46, 'Especialista', 20),
(53, 37, 'Usuario', 19),
(42, 31, 'Especialista', 20),
(45, 33, 'Usuario', 22),
(75, 48, 'Usuario', 19),
(67, 44, 'Usuario', 19),
(68, 44, 'Especialista', 21);

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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservations`
--

INSERT INTO `reservations` (`id`, `id_specialist`, `title`, `start`, `end`, `id_client`, `cost`, `specialist`, `client`) VALUES
(31, 20, 'Consulta numero 1', '2018-08-17T09:00:00', '2018-08-17T09:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(36, 20, 'Consulta dolor higado', '2018-08-25T12:00:00', '2018-08-25T12:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(33, 20, 'reserva rosmery', '2018-08-17T11:30:00', '2018-08-17T12:00:00', 22, '23$', 'jose perez', 'rosmery'),
(34, 20, 'me duele la muela', '2018-08-10T08:00:00', '2018-08-10T08:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(35, 21, 'prueba', '2018-08-20T09:00:00', '2018-08-20T09:30:00', 19, '15$', 'maria lucia', 'Johangel leon'),
(32, 20, 'consulta numero 2', '2018-08-17T13:00:00', '2018-08-17T13:30:00', 19, '23$', 'jose perez', 'Johangel leon'),
(38, 23, 'consulta prueba', '2018-08-26T10:00:00', '2018-08-26T10:30:00', 19, '5$', 'El perro caliente', 'Johangel leon'),
(39, 21, 'reserva prueba maria', '2018-08-26T10:00:00', '2018-08-26T10:30:00', 19, '15$', 'maria lucia', 'Johangel leon'),
(42, 20, 'reserva prueba 2', '2018-08-27T10:30:00', '2018-08-27T11:00:00', 19, '22$', 'jose perez', 'Johangel leon'),
(41, 21, 'descripcion prueba 4', '2018-08-29T09:30:00', '2018-08-29T10:00:00', 19, '15$', 'maria lucia', 'Johangel leon'),
(43, 20, 'perro', '2018-08-30T11:30:00', '2018-08-30T12:00:00', 19, '22$', 'jose perez', 'Johangel leon'),
(47, 20, 'reserva de prueba', '2018-09-08T10:00:00', '2018-09-08T10:30:00', 19, '22$', 'jose perez', 'Johangel leon'),
(46, 20, 'sd', '2018-09-01T11:00:00', '2018-09-01T11:30:00', 19, '22$', 'jose perez', 'Johangel leon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `specialist_field`
--

DROP TABLE IF EXISTS `specialist_field`;
CREATE TABLE IF NOT EXISTS `specialist_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `specialist_info`
--

INSERT INTO `specialist_info` (`id`, `user_id`, `active`, `specialistField`, `cmd`, `salary`, `days`, `hoursFrom`, `hoursTo`) VALUES
(15, 21, 1, 'Emergencia', '656', 15, '3', '8:00', '17:00'),
(14, 20, 1, 'Odontologia', '123549', 22, '1,3', '8:00', '17:00'),
(19, 39, 1, 'Traumatologia', '213123', 34, '2,4,5', '8:00', '16:00'),
(18, 23, 1, 'Traumatologia', '12', 5, '0,1,2,3,4,5,6', '8:00', '17:00'),
(20, 18, 1, 'Traumatologia', '34', 2342, '2', '12:00', '13:00');

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
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `rol`, `genero`, `edad`, `fecha_nacimiento`, `tipo_sangre`, `Dni`, `profile_img`) VALUES
(6, 20, 'Especialista', 'Hombre', 27, '2018-08-16', 'A Negativo', '231242231', '07_10_2018_21_44_11240px-Logo-UJAP2.jpg'),
(5, 19, 'usuario', 'Hombre', 21, '2018-08-08', 'B Positivo', '123123', '07_10_2018_17_16_39240px-Logo-UJAP2.jpg'),
(4, 18, 'Administrador', NULL, NULL, NULL, NULL, NULL, NULL),
(7, 21, 'Especialista', 'Mujer', 25, '2018-08-30', 'AB Positivo', '123123', '19_08_2018_15_00_29img_muestra.jpg'),
(8, 22, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 23, 'Especialista', NULL, NULL, NULL, NULL, NULL, NULL),
(27, 41, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(26, 40, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(25, 39, 'Especialista', NULL, NULL, NULL, NULL, NULL, NULL),
(29, 43, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(28, 42, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(24, 38, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL),
(30, 44, 'usuario', NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

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
(44, 'rosmery.torres10@gmail.com', 'rt', 'secret', '0'),
(39, 'enrique@gmail.com', 'enrique', 'secret', '0'),
(42, 'rosmery.torres10@gmail.com', 'rt', 'secret', '0'),
(43, 'rosmery.torres10@gmail.com', 'rt', 'secret', '0'),
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
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `validation_keys`
--

INSERT INTO `validation_keys` (`id`, `user_id`, `validation_key`, `user_email`) VALUES
(17, 42, 'validation05_09_2018_11_51_09', 'rosmery.torres10@gmail.com'),
(14, 39, 'validation01_09_2018_12_44_46', 'enrique@gmail.com'),
(18, 43, 'validation05_09_2018_11_52_19', 'rosmery.torres10@gmail.com'),
(19, 44, 'validation05_09_2018_12_01_17', 'rosmery.torres10@gmail.com');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
