-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-08-2018 a las 19:09:42
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `specialist_info`
--

INSERT INTO `specialist_info` (`id`, `user_id`, `active`, `specialistField`, `cmd`, `salary`) VALUES
(9, 16, 1, 'Especializacion 1', '12345674', 10),
(10, 17, 1, 'Especializacion 3', '12312', 12),
(11, 15, 1, 'Especializacion 2', '123', 3);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user_info`
--

INSERT INTO `user_info` (`id`, `user_id`, `rol`, `genero`, `edad`, `fecha_nacimiento`, `tipo_sangre`, `Dni`) VALUES
(1, 15, 'Especialista', 'Hombre', 1, '2018-08-30', 'AB Negativo', 'qwwqe'),
(2, 16, 'Especialista', 'Hombre', 19, '1995-07-28', 'AB Negativo', '123123123'),
(3, 17, 'Especialista', 'Hombre', 7, '2018-08-08', 'B Positivo', '123123');

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `nombre`, `clave`) VALUES
(16, 'johangel2@mail.com', 'Johangel Leon', 'secret'),
(15, 'asdasd@gmail.com', 'sadas', '123123'),
(17, 'macoisito@gmail.com', 'Macoisito', 'secret');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
