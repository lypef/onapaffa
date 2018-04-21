-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 21-04-2018 a las 07:27:54
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `onapaffa`
--
CREATE DATABASE IF NOT EXISTS `onapaffa` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `onapaffa`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adicionales`
--

CREATE TABLE `adicionales` (
  `id` int(11) NOT NULL,
  `titular` int(11) NOT NULL,
  `vehiculo` int(11) NOT NULL,
  `nombre` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adicionales`
--

INSERT INTO `adicionales` (`id`, `titular`, `vehiculo`, `nombre`, `domicilio`, `cp`, `telefono`, `foto`) VALUES
(14, 54, 11, 'FULANITO DE TAL', 'DOMICILIO EL MIRADOR', '98547', '2373553', 'fotografias/adicional_20180421071225.jpg'),
(16, 54, 11, 'NOMBRE DE ADICIONAL 3', 'DOMICILIO DEL ADICIONALK', '54652345', '92355787', 'fotografias/adicional_20180421071430.jpg'),
(17, 60, 10, 'ROSA ISELA PEREZ BAUTISTA', 'SI TIENE', '96980', '923155458', 'fotografias/adicional_20180421071440.jpg'),
(18, 60, 10, 'ADICIONAL 2', '', '', '', 'fotografias/adicional_20180421071540.jpg'),
(19, 60, 10, 'FRANCISCO EDUARDO ASCENCIO D', '20 DE NOVIEMBRE 306', '96980', '5555', 'fotografias/adicional_20180421071456.jpg'),
(20, 53, 6, 'ADICIONAL SHAKIRA', 'DOMICILIO', '58654654', '654', 'fotografias/adicional_20180421071554.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulares`
--

CREATE TABLE `titulares` (
  `id` int(11) NOT NULL,
  `nombre` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `domicilio` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cp` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fotografia` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `titulares`
--

INSERT INTO `titulares` (`id`, `nombre`, `domicilio`, `cp`, `telefono`, `fotografia`) VALUES
(48, 'FRANCISCO EDUARDO ASCENCIO D', '20 DE NOVIEMBRE 306', '96980', '9231200505', 'fotografias/20180419173001.jpg'),
(49, 'BRENDA KELLERMAN', 'DOMICILIO', '5865674', '5454754', 'fotografias/20180417010220.jpg'),
(51, 'ARLENE GARCIA AGUILAR', 'NO TIENE NADA', '96980', '44645454', 'fotografias/20180415192058.jpg'),
(53, 'SHAKI SHAKI', '', '', '', 'fotografias/20180415192121.jpg'),
(54, 'DANIELA FAINUS', 'DOMICILIO', '1241', '018008661', 'fotografias/20180417005150.jpg'),
(55, 'QUIEN', '', '', '', 'fotografias/20180414160613.jpg'),
(57, 'GABRIELA OCHARAN', 'domiclio de el fulano', '555', '922', 'fotografias/20180415171028.jpg'),
(58, 'S', '', '', '', 'fotografias/20180415184518.jpg'),
(59, 'SS', '', '', '', 'fotografias/20180415184926.jpg'),
(60, 'CAROLINA MORAN', 'DOMICILIO', '656569', '6545456', 'fotografias/20180417010015.jpg'),
(61, 'ESTTE ES UN TITULAR', '', '', '', 'fotografias/vehiculo_20180418062559.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 'FRANCISCO EDUARDO ASCENCIO DOMINGUEZ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehiculos`
--

CREATE TABLE `vehiculos` (
  `id` int(11) NOT NULL,
  `titular` int(11) NOT NULL,
  `serie` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipo` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cilindros` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `engomado` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `f_expedicion` date NOT NULL,
  `f_vencimiento` date NOT NULL,
  `estatus` tinyint(1) NOT NULL,
  `foto` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `titular`, `serie`, `tipo`, `modelo`, `marca`, `cilindros`, `color`, `engomado`, `f_expedicion`, `f_vencimiento`, `estatus`, `foto`) VALUES
(4, 53, 'serie', 'tipo', 'modelo', 'marca', 'cilindros', 'color', 'engomado', '2018-04-27', '2019-04-27', 1, 'fotografias/vehiculo_20180418073244.jpg'),
(5, 53, 'serie', 'tipo', 'modelo', 'marca', 'cilindros', 'color', 'engomado', '2018-04-27', '2019-04-27', 0, 'fotografias/vehiculo_20180418073244.jpg'),
(6, 53, 'serie', 'tipo', 'modelo', 'marca', 'cilindros', 'color', 'engomado', '2018-04-27', '2019-04-27', 1, 'fotografias/vehiculo_20180418073244.jpg'),
(7, 48, 'a7782hhd', 'CAMIONETA', 'FORD 150', 'FORD', '8', 'ROJO', 'AJEJD-44K', '2018-04-18', '2019-04-18', 1, 'fotografias/vehiculo_20180418170812.jpg'),
(8, 51, 'SLKJLIKYU7', 'LJLKJL', 'LKLKJKLJ', 'volkswagen', '2', 'NO SE ', 'LINLKJJNHKLNKL', '2018-04-18', '2019-04-18', 1, 'fotografias/vehiculo_20180418170930.jpg'),
(10, 60, 'K,JMNJK,NJKHJKHJK', 'JKHJKHJKJKH', 'JKHJKHJKHJKH', 'JKHJKJKHJK', 'HJKHJKHJKKJ', 'HJKJKHJKHJKH', 'JKHJKHJKHJK', '2018-04-18', '2019-04-18', 1, 'fotografias/vehiculo_20180418183144.jpg'),
(11, 54, 'SERIE NUEVA', 'TIPO', 'MODELOs', 'MARCA', 'CILINDROS', 'COLOR', 'ENGOMADO', '2018-04-18', '2019-04-18', 1, 'fotografias/vehiculo_20180418183100.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adicionales`
--
ALTER TABLE `adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adicional_vehiculo` (`vehiculo`),
  ADD KEY `titular_vehiculo` (`titular`);

--
-- Indices de la tabla `titulares`
--
ALTER TABLE `titulares`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehiculo_titular` (`titular`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adicionales`
--
ALTER TABLE `adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `titulares`
--
ALTER TABLE `titulares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adicionales`
--
ALTER TABLE `adicionales`
  ADD CONSTRAINT `adicional_vehiculo` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `titular_vehiculo` FOREIGN KEY (`titular`) REFERENCES `titulares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `vehiculo_titular` FOREIGN KEY (`titular`) REFERENCES `titulares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
