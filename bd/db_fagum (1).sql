-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-09-2018 a las 19:40:11
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_fagum`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `condicion`, `created_at`, `updated_at`) VALUES
(1, 'Camisa', NULL, 1, '2018-09-28 08:14:19', '2018-09-28 13:15:47'),
(2, 'Pantalon', NULL, 1, '2018-09-28 08:14:19', '2018-09-28 13:15:40'),
(3, 'Gorra', NULL, 1, '2018-09-28 13:16:17', '2018-09-28 13:16:17'),
(4, 'Polos', NULL, 1, '2018-09-28 14:00:07', '2018-09-28 14:00:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido_paterno` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `apellido_materno` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` char(2) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo_documento` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `numero_documento` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `telefono` varchar(15) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `apellido_paterno`, `apellido_materno`, `fecha_nacimiento`, `genero`, `tipo_documento`, `numero_documento`, `direccion`, `telefono`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-22 01:12:45', '2018-09-22 01:12:45'),
(2, 'cliente', 'cliente', 'cliente', NULL, 'M', 'DNI', '00000000', 'Real', '99998889', '2018-09-22 05:34:15', '2018-09-28 12:35:54'),
(3, 'Cliente', 'Cliente', 'Cliente', '1998-09-28', 'M', 'DNI', '89898789', 'Real', '99998887', '2018-09-22 05:34:42', '2018-09-28 12:38:51'),
(9, 'Jesus', 'Valverde', 'Rojas', NULL, NULL, 'DNI', '78767876', 'Real #444', '99990099', '2018-09-28 11:53:54', '2018-09-28 11:53:54'),
(10, 'Juan', 'Valverde', 'Rojas', NULL, 'M', 'DNI', '78767876', 'Real #444', '99990099', '2018-09-28 12:05:44', '2018-09-28 12:34:25'),
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-28 21:26:16', '2018-09-28 21:26:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nombre` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `stockactual` int(11) DEFAULT NULL,
  `stockminimo` tinyint(4) DEFAULT NULL,
  `stockmaximo` int(11) DEFAULT NULL,
  `precio` float DEFAULT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `idUsuario` int(11) DEFAULT NULL,
  `idCategoria` int(11) DEFAULT NULL,
  `condicion` tinyint(1) DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `stockactual`, `stockminimo`, `stockmaximo`, `precio`, `descripcion`, `idUsuario`, `idCategoria`, `condicion`, `created_at`, `updated_at`) VALUES
(1, '0990099', 'Camisa plateada', 300, 10, 300, 200, 'Ninguna', NULL, 1, 1, '2018-09-28 08:58:24', '2018-09-28 13:58:24'),
(2, '0090909888', 'Gorra moderna', 100, 10, 100, 50, 'Ninguna', NULL, 3, 1, '2018-09-28 08:57:57', '2018-09-28 13:57:57'),
(3, '11111', 'Pantalon yin', 200, 10, 200, 200, 'Ninguna', NULL, 2, 1, '2018-09-28 08:57:04', '2018-09-28 13:57:04');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `condicion` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id`, `nombre`, `descripcion`, `condicion`) VALUES
(1, 'Administrador', NULL, 1),
(2, 'Personal', NULL, 1),
(3, 'Cliente', NULL, 1),
(4, 'Proveedor', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `usuario` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idRol` int(11) NOT NULL,
  `idPersona` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `usuario`, `correo`, `password`, `estado`, `remember_token`, `idRol`, `idPersona`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', '$2y$10$2lIGqEjEz6/xjNrb0rxwpe4fQXs1gw2HUs.xLnfDLQgStpJdSzqmS', 1, 'IxErllbWhq6f23UdwVq7TticI77urT8lz00cueh9LVjDPzgjr1fSjhhsJIX7', 1, 1, '2018-09-22 01:12:46', '2018-09-22 01:12:46'),
(2, 'cliente', 'cliente@gmail.com', '$2y$10$J/xcXS/ifhGuZvPu2kiytOEB8cAbajJ0bG2lRrFirZ65euHgga7TK', 1, NULL, 3, 3, '2018-09-22 05:34:42', '2018-09-28 12:38:51'),
(9, 'jesucito', 'jesus@gmail.com', '$2y$10$vFkNfmVRo0rqR9Qn2TQXUOyI4oroPvhX1QijVvddV4vX5dA/CP2ym', 1, NULL, 4, 9, '2018-09-28 11:53:54', '2018-09-28 12:23:40'),
(10, 'juancito', 'jesus@gmail.com', '$2y$10$h0KZGz1gs.K9psrGSYm46.X4th3YmOXcMekqwn6yLVfS6D3K8nP/q', 1, NULL, 2, 10, '2018-09-28 12:05:44', '2018-09-28 12:34:25'),
(11, 'Rebe', 'rebe@gmail.com', '$2y$10$Iour9OAay9lySq6GFRTjUuT9Ocx60RLITDctKgeX1GP4CyUcmRP1W', 0, NULL, 3, 11, '2018-09-28 21:26:17', '2018-09-28 21:26:17');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
