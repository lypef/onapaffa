-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 03-05-2018 a las 18:59:54
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
(1, 'SUCURSAL NUMERO 1', 'DIRECCION DE LA SUCURSAL NUMERO 1', 'TELEFONO DE LA SUCURSAL');

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
  `delete_logs` tinyint(1) NOT NULL DEFAULT '0',
  `gest_sucursales` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `name`, `add_titular`, `edit_titular`, `delete_titular`, `add_vehicle`, `edit_vehicle`, `delete_vehicle`, `add_adicional`, `edit_adicional`, `delete_adicional`, `crud_users`, `gen_reports`, `delete_logs`, `gest_sucursales`) VALUES
(1, 'root', '63a9f0ea7bb98050796b649e85481845', 'FRANCISCO EDUARDO ASCENCIO DOMINGUEZ', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

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
  `sucursal` int(11) NOT NULL,
  `linea` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `titulares`
--
ALTER TABLE `titulares`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vehiculos`
--
ALTER TABLE `vehiculos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
