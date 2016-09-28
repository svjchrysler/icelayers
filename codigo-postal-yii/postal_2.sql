-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-07-2016 a las 16:11:37
-- Versión del servidor: 5.6.21
-- Versión de PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `postal_2`
--
CREATE DATABASE IF NOT EXISTS `postal_2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `postal_2`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `departamento`
--

DROP TABLE IF EXISTS `departamento`;
CREATE TABLE IF NOT EXISTS `departamento` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `departamento`
--

INSERT INTO `departamento` (`id`, `nombre`, `direccion`, `activo`) VALUES
(1, 'GLOBAL', 'S/N', 1),
(2, 'MENSAJEROS', 's\\n', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `despacho`
--

DROP TABLE IF EXISTS `despacho`;
CREATE TABLE IF NOT EXISTS `despacho` (
`id` int(11) NOT NULL,
  `repartidor_id` int(11) NOT NULL,
  `pedido_id` int(11) NOT NULL,
  `fecha_despacho` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `despacho`
--

INSERT INTO `despacho` (`id`, `repartidor_id`, `pedido_id`, `fecha_despacho`) VALUES
(1, 1, 1, '2016-07-20');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

DROP TABLE IF EXISTS `pedido`;
CREATE TABLE IF NOT EXISTS `pedido` (
`id` int(11) NOT NULL,
  `detalle` varchar(200) NOT NULL,
  `cod_postal` varchar(200) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `nombre_persona_destino` varchar(200) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`id`, `detalle`, `cod_postal`, `direccion`, `nombre_persona_destino`, `telefono`, `status`) VALUES
(1, 'correo', 'BO-231564', 's\\n', 'Tamara Landivar', '76315489', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puntos`
--

DROP TABLE IF EXISTS `puntos`;
CREATE TABLE IF NOT EXISTS `puntos` (
`id` int(11) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `direccion` varchar(80) NOT NULL,
  `lat` float NOT NULL,
  `lng` float NOT NULL,
  `tipo` varchar(30) NOT NULL,
  `cpostal` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `puntos`
--

INSERT INTO `puntos` (`id`, `nombre`, `direccion`, `lat`, `lng`, `tipo`, `cpostal`) VALUES
(1, 'Mariana Landivar', 'calle 4 av centenario entre 2do y 3er anilo', -17.7775, -63.1993, 'vivienda', 'BO-123456');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `repartidor`
--

DROP TABLE IF EXISTS `repartidor`;
CREATE TABLE IF NOT EXISTS `repartidor` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT '0',
  `departament_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `repartidor`
--

INSERT INTO `repartidor` (`id`, `nombre`, `direccion`, `telefono`, `email`, `activo`, `departament_id`) VALUES
(1, 'Carlos Justiniano', '4to anillo Santos Dumont C/2 #12', '73174012', 'cjustiniano@prueba.com', 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE IF NOT EXISTS `status` (
`id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `status`
--

INSERT INTO `status` (`id`, `nombre`) VALUES
(1, 'ALMACEN'),
(2, 'DESPACHADO'),
(3, 'ENTREGADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubications`
--

DROP TABLE IF EXISTS `ubications`;
CREATE TABLE IF NOT EXISTS `ubications` (
`id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `profession` varchar(200) NOT NULL,
  `latitute` varchar(200) NOT NULL,
  `length` varchar(200) NOT NULL,
  `codePostal` varchar(200) NOT NULL,
  `streetName` varchar(200) NOT NULL,
  `nameImage` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubications`
--

INSERT INTO `ubications` (`id`, `name`, `profession`, `latitute`, `length`, `codePostal`, `streetName`, `nameImage`) VALUES
(1, 'Tamara Landivar', 'Contadora', '-17.777403', '-63.199275', 'BO-231564', 'calle 4', 'ninguno'),
(2, 'Esteban Quito', 'Ing Civil', '-17.75073305052026', '-63.17223880234724', 'BO-456123', 'Calle nueva', 'no image');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `auth_key` varchar(32) NOT NULL,
  `password_hash` text NOT NULL,
  `password_reset_token` text NOT NULL,
  `email` varchar(50) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'uQ6fWZkmqg0kU0oAqtYuE2ZWN8WD2yv8', '$2y$13$K7SkU17fAJEVjAvT9zuAZOLCzfA1g8G3ogO3QBSt/t63XC5U4nw0u', '', 'nitramdemente@gmail.com', 10, 1468267897, 1468267897);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `departamento`
--
ALTER TABLE `departamento`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `despacho`
--
ALTER TABLE `despacho`
 ADD PRIMARY KEY (`id`), ADD KEY `repartidor_id` (`repartidor_id`,`pedido_id`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
 ADD PRIMARY KEY (`id`), ADD KEY `status` (`status`);

--
-- Indices de la tabla `puntos`
--
ALTER TABLE `puntos`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `repartidor`
--
ALTER TABLE `repartidor`
 ADD PRIMARY KEY (`id`), ADD KEY `departament_id` (`departament_id`);

--
-- Indices de la tabla `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ubications`
--
ALTER TABLE `ubications`
 ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `departamento`
--
ALTER TABLE `departamento`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `despacho`
--
ALTER TABLE `despacho`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `puntos`
--
ALTER TABLE `puntos`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `repartidor`
--
ALTER TABLE `repartidor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `status`
--
ALTER TABLE `status`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `ubications`
--
ALTER TABLE `ubications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
ADD CONSTRAINT `fk_status_id` FOREIGN KEY (`status`) REFERENCES `status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `repartidor`
--
ALTER TABLE `repartidor`
ADD CONSTRAINT `fk_departament_id` FOREIGN KEY (`departament_id`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
