-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-04-2018 a las 08:56:35
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
  `foto` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atendio` int(11) NOT NULL,
  `sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `adicionales`
--

INSERT INTO `adicionales` (`id`, `titular`, `vehiculo`, `nombre`, `domicilio`, `cp`, `telefono`, `foto`, `atendio`, `sucursal`) VALUES
(22, 73, 15, 'NOMBRE MUY PEROP MUY LARGO', 'hjkjkhjk', 'hjkhjkhjkjk', 'hjkhjk', 'fotografias/adicional_20180425193329.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `registro` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `logs`
--

INSERT INTO `logs` (`id`, `user`, `fecha`, `registro`) VALUES
(11, 1, '2018-04-25 19:06:58', 'SE ACTUALIZO INFORMACION DE TITULAR: DANIELA FAINUS NUMERO DE USUARIO: 72'),
(12, 1, '2018-04-25 19:07:08', 'SE ACTUALIZO INFORMACION DE TITULAR: ARLENE GARCIA AGUILAR NUMERO DE USUARIO: 72'),
(38, 2, '2018-04-25 20:04:31', 'USUARIO ACTUALIZO SU INFORMACION'),
(39, 1, '2018-04-25 20:04:39', 'USUARIO ACTUALIZO SU INFORMACION'),
(40, 1, '2018-04-26 07:01:39', 'ALTA TITULAR:  C3 B1LKOJKLJKLJKL'),
(41, 1, '2018-04-26 07:02:03', 'SE ACTUALIZO INFORMACION DE TITULAR:  C3 B1LKOJKLJKLJKL NUMERO DE USUARIO: 77'),
(42, 1, '2018-04-26 07:02:14', 'SE ELIMINO TITULAR: AAAAAAAAAA NUMERO DE USUARIO: 77'),
(43, 1, '2018-04-26 07:02:42', 'ALTA VEHICULO DE TITULAR CAROLINA MORAN NUMERO DE USUARIO: 76'),
(44, 1, '2018-04-26 07:03:09', 'SE ACTUALIZO INIFORMACION VEHICULO NO. 17'),
(45, 1, '2018-04-26 07:03:27', 'SE ELIMINO VEHICULO NO. 17'),
(46, 1, '2018-04-26 07:04:05', 'SE AGREGO ADICIONAL: OLIJHIKLJHKLIJKLJKL. AL VEHICULO NO: 16. TITULAR: BRENDA KELLERMAN'),
(47, 1, '2018-04-26 07:05:19', 'SE ACTUALIZO INFORMACION DE ADICIONAL: OLIJHIKLJHKLIJKLJKL NUMERO DE ADICIONAL: 23'),
(49, 1, '2018-04-26 07:05:58', 'SE ELIMINO REGISTRO: 48'),
(50, 1, '2018-04-26 07:51:23', 'USUARIO ACTUALIZO SU INFORMACION');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `id` int(11) NOT NULL,
  `nombre` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`id`, `nombre`, `direccion`, `telefono`) VALUES
(1, 'SUCURSAL NUMERO 1', 'DIRECCION DE LA SUCURSAL NUMERO 1', 'TELEFONO DE LA SUCURSAL'),
(2, 'OTRA SUCURSAL', 'DIRECCION', '4545');

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
  `fotografia` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atendio` int(11) NOT NULL,
  `sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `titulares`
--

INSERT INTO `titulares` (`id`, `nombre`, `domicilio`, `cp`, `telefono`, `fotografia`, `atendio`, `sucursal`) VALUES
(73, 'FRANCISCO EDUARDO ASCENCIO DOMINGUEZ', 'DOMICILIO', '96980', '9231200505', 'fotografias/20180425190921.jpg', 1, 1),
(74, 'DANIELA FAINUS', '', '', '', 'fotografias/20180425190934.jpg', 2, 1),
(75, 'BRENDA KELLERMAN', 'DOMICILIO', '', '', 'fotografias/20180425190943.jpg', 1, 1),
(76, 'CAROLINA MORAN', 'domiclio', '96980', '9234545', 'fotografias/20180425191003.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `add_titular` tinyint(1) NOT NULL DEFAULT '0',
  `edit_titular` tinyint(1) NOT NULL DEFAULT '0',
  `delete_titular` tinyint(1) NOT NULL DEFAULT '0',
  `add_vehicle` tinyint(1) NOT NULL DEFAULT '0',
  `edit_vehicle` tinyint(1) NOT NULL DEFAULT '0',
  `delete_vehicle` tinyint(1) NOT NULL DEFAULT '0',
  `add_adicional` tinyint(1) NOT NULL DEFAULT '0',
  `edit_adicional` tinyint(1) NOT NULL DEFAULT '0',
  `delete_adicional` tinyint(1) NOT NULL DEFAULT '0',
  `crud_users` tinyint(1) NOT NULL DEFAULT '0',
  `gen_reports` tinyint(1) NOT NULL DEFAULT '0',
  `delete_logs` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `add_titular`, `edit_titular`, `delete_titular`, `add_vehicle`, `edit_vehicle`, `delete_vehicle`, `add_adicional`, `edit_adicional`, `delete_adicional`, `crud_users`, `gen_reports`, `delete_logs`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 'FRANCISCO EDUARDO ASCENCIO DOMINGUEZ', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1),
(2, 'demo', 'demo', 'NUEVO NOMBRE', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
  `foto` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `atendio` int(11) NOT NULL,
  `sucursal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `vehiculos`
--

INSERT INTO `vehiculos` (`id`, `titular`, `serie`, `tipo`, `modelo`, `marca`, `cilindros`, `color`, `engomado`, `f_expedicion`, `f_vencimiento`, `estatus`, `foto`, `atendio`, `sucursal`) VALUES
(14, 74, '66565656565656565', '566545', '454', '545', '45', '45', '45', '2018-04-25', '2019-04-25', 1, 'fotografias/vehiculo_20180425191053.jpg', 1, 1),
(15, 73, 'lkjlkjkljkljkl', 'klj', 'kljkl', 'kljkl', 'jkl', 'jkl', 'jlk', '2018-04-25', '2019-04-25', 1, 'fotografias/vehiculo_20180425191307.jpg', 1, 1),
(16, 75, '665656565', 'hjkjkhjk', 'hjk', 'hjkhjk', 'hjk', 'hjkh', 'jkhjkhjk', '2018-04-24', '2019-04-24', 1, 'fotografias/vehiculo_20180425191905.jpg', 1, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adicionales`
--
ALTER TABLE `adicionales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adicional_vehiculo` (`vehiculo`),
  ADD KEY `titular_vehiculo` (`titular`),
  ADD KEY `atendio_adicional` (`atendio`),
  ADD KEY `suc_adicional` (`sucursal`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `log_user` (`user`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `titulares`
--
ALTER TABLE `titulares`
  ADD PRIMARY KEY (`id`),
  ADD KEY `atendio_titular` (`atendio`),
  ADD KEY `sucursal` (`sucursal`);

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
  ADD KEY `vehiculo_titular` (`titular`),
  ADD KEY `atendio_user` (`atendio`),
  ADD KEY `sucursal_` (`sucursal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adicionales`
--
ALTER TABLE `adicionales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `titulares`
--
ALTER TABLE `titulares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adicionales`
--
ALTER TABLE `adicionales`
  ADD CONSTRAINT `adicional_vehiculo` FOREIGN KEY (`vehiculo`) REFERENCES `vehiculos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `atendio_adicional` FOREIGN KEY (`atendio`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `suc_adicional` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `titular_vehiculo` FOREIGN KEY (`titular`) REFERENCES `titulares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `log_user` FOREIGN KEY (`user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `titulares`
--
ALTER TABLE `titulares`
  ADD CONSTRAINT `atendio_titular` FOREIGN KEY (`atendio`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  ADD CONSTRAINT `atendio_user` FOREIGN KEY (`atendio`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `sucursal_` FOREIGN KEY (`sucursal`) REFERENCES `sucursales` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vehiculo_titular` FOREIGN KEY (`titular`) REFERENCES `titulares` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
