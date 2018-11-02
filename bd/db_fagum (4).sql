-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2018 a las 22:23:42
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
-- Estructura de tabla para la tabla `detalle_pago`
--

CREATE TABLE `detalle_pago` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `tipo_pago` varchar(255) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'tarjeta',
  `total` double DEFAULT NULL,
  `abono` double DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8_spanish2_ci NOT NULL DEFAULT 'Pendiente',
  `card_number` varchar(16) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `client_ip` varchar(30) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `card_brand` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `card_type` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `card_category` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `detalle_pago`
--

INSERT INTO `detalle_pago` (`id`, `id_venta`, `id_users`, `tipo_pago`, `total`, `abono`, `estado`, `card_number`, `email`, `client_ip`, `card_brand`, `card_type`, `card_category`, `created_at`, `updated_at`) VALUES
(1, 4, 15, 'Targeta', 245, 245, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 13:47:21', '2018-11-02 13:47:21'),
(2, 5, 15, 'Targeta', 245, 245, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 13:48:31', '2018-11-02 13:48:31'),
(3, 6, 15, 'Targeta', 368, 368, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 13:59:27', '2018-11-02 13:59:27'),
(4, 7, 15, 'Targeta', 368, 368, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:00:21', '2018-11-02 14:00:21'),
(5, 8, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:09:30', '2018-11-02 14:09:30'),
(6, 9, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:12:22', '2018-11-02 14:12:22'),
(7, 10, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:14:39', '2018-11-02 14:14:39'),
(8, 11, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:19:50', '2018-11-02 14:19:50'),
(9, 12, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:21:43', '2018-11-02 14:21:43'),
(10, 13, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:25:57', '2018-11-02 14:25:57'),
(11, 14, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'brillith@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:28:18', '2018-11-02 14:28:18'),
(12, 15, 15, 'Targeta', 123, 123, 'Pagado', '411111******1111', 'brillith@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 14:30:23', '2018-11-02 14:30:23'),
(13, 16, 15, 'Targeta', 122, 122, 'Pagado', '411111******1111', 'jhuaynatesc@gmail.com', '190.232.117.46', 'Visa', 'credito', 'Clásica', '2018-11-02 20:36:15', '2018-11-02 20:36:15'),
(18, 26, 10, 'Efectivo', 122, 122, 'Pagado', '0', '0', '0', '0', '0', '0', '2018-11-03 01:10:15', '2018-11-03 01:10:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_producto`
--

CREATE TABLE `detalle_producto` (
  `id` int(11) NOT NULL,
  `talla` varchar(30) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `modelo` varchar(50) DEFAULT NULL,
  `id_producto` int(11) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ventas`
--

CREATE TABLE `detalle_ventas` (
  `id` int(11) NOT NULL,
  `idProducto` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` float NOT NULL,
  `subtotal` float NOT NULL,
  `idVenta` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalle_ventas`
--

INSERT INTO `detalle_ventas` (`id`, `idProducto`, `cantidad`, `precio`, `subtotal`, `idVenta`, `created_at`, `updated_at`) VALUES
(1, 9, 1, 123, 123, 1, '2018-10-26 13:08:14', '2018-10-26 13:08:14'),
(2, 5, 4, 120, 480, 1, '2018-10-26 13:08:14', '2018-10-26 13:08:14'),
(3, 6, 9, 120, 1080, 1, '2018-10-26 13:08:14', '2018-10-26 13:08:14'),
(4, 1, 9, 10, 90, 1, '2018-10-26 13:08:14', '2018-10-26 13:08:14'),
(5, 9, 1, 123, 123, 2, '2018-10-26 13:14:47', '2018-10-26 13:14:47'),
(6, 5, 4, 120, 480, 2, '2018-10-26 13:14:47', '2018-10-26 13:14:47'),
(7, 6, 9, 120, 1080, 2, '2018-10-26 13:14:47', '2018-10-26 13:14:47'),
(8, 1, 9, 10, 90, 2, '2018-10-26 13:14:47', '2018-10-26 13:14:47'),
(9, 3, 1, 200, 200, 3, '2018-10-27 01:12:04', '2018-10-27 01:12:04'),
(10, 4, 1, 120, 120, 3, '2018-10-27 01:12:04', '2018-10-27 01:12:04'),
(11, 8, 1, 122, 122, 5, '2018-11-02 13:48:31', '2018-11-02 13:48:31'),
(12, 10, 1, 123, 123, 5, '2018-11-02 13:48:32', '2018-11-02 13:48:32'),
(13, 10, 1, 123, 123, 7, '2018-11-02 14:00:21', '2018-11-02 14:00:21'),
(14, 9, 1, 123, 123, 7, '2018-11-02 14:00:21', '2018-11-02 14:00:21'),
(15, 8, 1, 122, 122, 7, '2018-11-02 14:00:21', '2018-11-02 14:00:21'),
(16, 9, 1, 123, 123, 8, '2018-11-02 14:09:30', '2018-11-02 14:09:30'),
(17, 9, 1, 123, 123, 9, '2018-11-02 14:12:22', '2018-11-02 14:12:22'),
(18, 9, 1, 123, 123, 10, '2018-11-02 14:14:39', '2018-11-02 14:14:39'),
(19, 9, 1, 123, 123, 11, '2018-11-02 14:19:50', '2018-11-02 14:19:50'),
(20, 9, 1, 123, 123, 12, '2018-11-02 14:21:43', '2018-11-02 14:21:43'),
(21, 9, 1, 123, 123, 13, '2018-11-02 14:25:57', '2018-11-02 14:25:57'),
(22, 9, 1, 123, 123, 14, '2018-11-02 14:28:18', '2018-11-02 14:28:18'),
(23, 9, 1, 123, 123, 15, '2018-11-02 14:30:23', '2018-11-02 14:30:23'),
(24, 8, 1, 122, 122, 16, '2018-11-02 20:36:15', '2018-11-02 20:36:15'),
(25, 8, 1, 122, 122, 26, '2018-11-03 01:10:15', '2018-11-03 01:10:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrega`
--

CREATE TABLE `entrega` (
  `id` int(11) NOT NULL,
  `id_venta` int(11) DEFAULT NULL,
  `direccion` varchar(100) DEFAULT NULL,
  `numero` varchar(10) DEFAULT NULL,
  `adicionalinfo` varchar(100) DEFAULT NULL,
  `referencia` varchar(100) DEFAULT NULL,
  `ubigeo` varchar(10) NOT NULL,
  `encargado` varchar(255) NOT NULL,
  `numero_contacto` varchar(20) DEFAULT NULL,
  `costo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-28 21:26:16', '2018-09-28 21:26:16'),
(12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-29 00:06:40', '2018-09-29 00:06:40'),
(13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-29 00:09:52', '2018-09-29 00:09:52'),
(14, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-09-29 00:10:54', '2018-09-29 00:10:54'),
(15, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2018-10-26 12:29:30', '2018-10-26 12:29:30');

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
  `image` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `thumbnail` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `medium` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `large` varchar(150) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `codigo`, `nombre`, `stockactual`, `stockminimo`, `stockmaximo`, `precio`, `descripcion`, `idUsuario`, `idCategoria`, `condicion`, `image`, `thumbnail`, `medium`, `large`, `created_at`, `updated_at`) VALUES
(1, '0990099', 'Camisa plateada', 300, 10, 300, 200, 'Ninguna', NULL, 1, 1, 'Eo1Yzc5W2NvUWApe.jpg', 'Eo1Yzc5W2NvUWApe.jpg-150x84.333821376281.jpg', 'Eo1Yzc5W2NvUWApe.jpg-300x168.66764275256.jpg', 'Eo1Yzc5W2NvUWApe.jpg-1024x575.71888726208.jpg', '2018-10-04 10:18:07', '2018-10-04 15:18:07'),
(2, '0090909888', 'Gorra moderna', 100, 10, 100, 50, 'Ninguna', NULL, 3, 1, 'NAWST3KzjsW6I46Q.jpg', 'NAWST3KzjsW6I46Q.jpg-150x93.75.jpg', 'NAWST3KzjsW6I46Q.jpg-300x187.5.jpg', 'NAWST3KzjsW6I46Q.jpg-1024x640.jpg', '2018-10-04 10:17:50', '2018-10-04 15:17:50'),
(3, '11111', 'Pantalon yin', 200, 10, 200, 200, 'Ninguna', NULL, 2, 1, 'ptyDE8NWX8rwtGpv.jpg', 'ptyDE8NWX8rwtGpv.jpg-150x93.75.jpg', 'ptyDE8NWX8rwtGpv.jpg-300x187.5.jpg', 'ptyDE8NWX8rwtGpv.jpg-1024x640.jpg', '2018-10-04 10:17:39', '2018-10-04 15:17:39'),
(4, '09099', 'Camisa de lana', 100, 2, 100, 120, 'Ninguna', NULL, 1, 1, 'URbThIqTY3kS4yqu.jpg', 'URbThIqTY3kS4yqu.jpg-150x93.75.jpg', 'URbThIqTY3kS4yqu.jpg-300x187.5.jpg', 'URbThIqTY3kS4yqu.jpg-1024x640.jpg', '2018-10-04 10:17:27', '2018-10-04 15:17:27'),
(5, '1234', 'Camisa de', 1000, 10, 1000, 120, 'ninguna', NULL, 2, 1, 'KYvGjoxUiKBEpngW.jpg', 'KYvGjoxUiKBEpngW.jpg-150x93.75.jpg', 'KYvGjoxUiKBEpngW.jpg-300x187.5.jpg', 'KYvGjoxUiKBEpngW.jpg-1024x640.jpg', '2018-10-04 10:17:17', '2018-10-04 15:17:17'),
(6, '00039', 'Gorra de lana', 200, 10, 200, 120, 'Ninguna', NULL, 3, 1, 'I2YAVOJkCAdyfDKz.jpg', 'I2YAVOJkCAdyfDKz.jpg-150x93.75.jpg', 'I2YAVOJkCAdyfDKz.jpg-300x187.5.jpg', 'I2YAVOJkCAdyfDKz.jpg-1024x640.jpg', '2018-10-04 10:06:27', '2018-10-04 15:06:27'),
(7, '32423424', 'Paltalon de lana', 122, 12, 122, 122, 'Ninguna', NULL, 2, 1, 'lHOldRpGjEGAIwlY.jpg', 'lHOldRpGjEGAIwlY.jpg-150x112.5.jpg', 'lHOldRpGjEGAIwlY.jpg-300x225.jpg', 'lHOldRpGjEGAIwlY.jpg-1024x768.jpg', '2018-10-05 11:49:18', '2018-10-05 11:49:18'),
(8, '32423424', 'Paltalon de lana', 122, 12, 122, 122, 'Ninguna', NULL, 2, 1, 'HQckEAwJyEwxcjKq.jpg', 'HQckEAwJyEwxcjKq.jpg-150x112.5.jpg', 'HQckEAwJyEwxcjKq.jpg-300x225.jpg', 'HQckEAwJyEwxcjKq.jpg-1024x768.jpg', '2018-10-05 11:49:43', '2018-10-05 11:49:43'),
(9, '56465456', 'Gorra roja', 122, 12, 122, 123, 'Ninguna', NULL, 3, 1, 'ZacjImYXQ4Mkgwqt.jpg', 'ZacjImYXQ4Mkgwqt.jpg-150x112.5.jpg', 'ZacjImYXQ4Mkgwqt.jpg-300x225.jpg', 'ZacjImYXQ4Mkgwqt.jpg-1024x768.jpg', '2018-10-05 11:58:30', '2018-10-05 11:58:30'),
(10, '11124', 'Gorra verde', 112, 11, 112, 123, 'Ninguna', NULL, 3, 1, '9LVgI8A6TIbuZb6j.jpg', '9LVgI8A6TIbuZb6j.jpg-150x93.75.jpg', '9LVgI8A6TIbuZb6j.jpg-300x187.5.jpg', '9LVgI8A6TIbuZb6j.jpg-1024x640.jpg', '2018-10-05 12:00:59', '2018-10-05 12:00:59');

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
(1, 'admin', 'admin@gmail.com', '$2y$10$2lIGqEjEz6/xjNrb0rxwpe4fQXs1gw2HUs.xLnfDLQgStpJdSzqmS', 1, 'pzImzD7OTMxJyPJChEzQp8z4qZSyO2SABDIGNYp6ZYMXiW6Lok1vWyQUyKcY', 1, 1, '2018-09-22 01:12:46', '2018-09-22 01:12:46'),
(2, 'cliente', 'cliente@gmail.com', '$2y$10$J/xcXS/ifhGuZvPu2kiytOEB8cAbajJ0bG2lRrFirZ65euHgga7TK', 1, NULL, 3, 3, '2018-09-22 05:34:42', '2018-09-28 12:38:51'),
(9, 'jesucito', 'jesus@gmail.com', '$2y$10$vFkNfmVRo0rqR9Qn2TQXUOyI4oroPvhX1QijVvddV4vX5dA/CP2ym', 1, NULL, 4, 9, '2018-09-28 11:53:54', '2018-09-28 12:23:40'),
(10, 'juancito', 'jesus@gmail.com', '$2y$10$h0KZGz1gs.K9psrGSYm46.X4th3YmOXcMekqwn6yLVfS6D3K8nP/q', 1, NULL, 2, 10, '2018-09-28 12:05:44', '2018-09-28 12:34:25'),
(11, 'Rebe', 'rebe@gmail.com', '$2y$10$Iour9OAay9lySq6GFRTjUuT9Ocx60RLITDctKgeX1GP4CyUcmRP1W', 0, NULL, 3, 11, '2018-09-28 21:26:17', '2018-09-28 21:26:17'),
(12, 'rebeca', 'rebe2@gmail.com', '$2y$10$/tsXDqYh1SKos5Y7FTPfCO2ry1hcXIIb7qb7lbv1jDHdbBkbSYiXy', 0, NULL, 3, 12, '2018-09-29 00:06:40', '2018-09-29 00:06:40'),
(13, 'juan', 'juan@gmail.com', '$2y$10$8o9VMXg04KsiPIVnKWtmhO5zfGyeOA/7WU5Yz5y1fttuQC2EtyHGe', 0, NULL, 3, 13, '2018-09-29 00:09:52', '2018-09-29 00:09:52'),
(14, 'Rebeca', 'rebeca@gmail.com', '$2y$10$DA5SSb8Cl4DYPlEJa.ia0eyDM2ecFwLHSEncpdV3nwURFEQcz6f3C', 0, NULL, 3, 14, '2018-09-29 00:10:54', '2018-10-04 01:12:36'),
(15, 'jhuaynatesc', 'jhuaynatesc@gmail.com', '$2y$10$2lIGqEjEz6/xjNrb0rxwpe4fQXs1gw2HUs.xLnfDLQgStpJdSzqmS', 1, 'b2B8FKZhEIUY35vgawZKpbE8ydkwH5E9TMNLec6uEm3TZPBtOzjFk2d7dCvD', 3, 15, '2018-10-26 12:29:30', '2018-10-26 12:29:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `total` decimal(11,2) DEFAULT NULL,
  `monto_cobrar` decimal(11,2) DEFAULT NULL,
  `tipo_comprobante` varchar(5) NOT NULL,
  `serie` varchar(30) NOT NULL,
  `numero` varchar(30) DEFAULT NULL,
  `tipo_moneda` varchar(10) DEFAULT NULL,
  `igv` double DEFAULT NULL,
  `gravada` double DEFAULT NULL,
  `descuento` double DEFAULT NULL,
  `estado` bit(1) NOT NULL DEFAULT b'0',
  `tipoPago` varchar(30) DEFAULT NULL,
  `tipo_entrega` varchar(50) DEFAULT NULL,
  `payment_time` timestamp NULL DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `total`, `monto_cobrar`, `tipo_comprobante`, `serie`, `numero`, `tipo_moneda`, `igv`, `gravada`, `descuento`, `estado`, `tipoPago`, `tipo_entrega`, `payment_time`, `id_users`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, b'1', 'Efectivo', NULL, NULL, 15, '2018-10-26 13:08:14', '2018-10-26 13:08:14'),
(2, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, b'1', 'Efectivo', NULL, NULL, 15, '2018-10-26 13:14:47', '2018-10-26 13:14:47'),
(3, NULL, NULL, '', '', NULL, NULL, NULL, NULL, NULL, b'1', 'Efectivo', NULL, NULL, 15, '2018-10-27 01:12:03', '2018-10-27 01:12:03'),
(4, '245.00', '245.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '', '2018-11-02 13:47:21', 15, '2018-11-02 13:47:21', '2018-11-02 13:47:21'),
(5, '245.00', '245.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '', '2018-11-02 13:48:31', 15, '2018-11-02 13:48:31', '2018-11-02 13:48:31'),
(6, '368.00', '368.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 13:59:27', 15, '2018-11-02 13:59:27', '2018-11-02 13:59:27'),
(7, '368.00', '368.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:00:21', 15, '2018-11-02 14:00:21', '2018-11-02 14:00:21'),
(8, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:09:30', 15, '2018-11-02 14:09:30', '2018-11-02 14:09:30'),
(9, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:12:22', 15, '2018-11-02 14:12:22', '2018-11-02 14:12:22'),
(10, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:14:38', 15, '2018-11-02 14:14:38', '2018-11-02 14:14:38'),
(11, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:19:50', 15, '2018-11-02 14:19:50', '2018-11-02 14:19:50'),
(12, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:21:43', 15, '2018-11-02 14:21:43', '2018-11-02 14:21:43'),
(13, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:25:56', 15, '2018-11-02 14:25:56', '2018-11-02 14:25:56'),
(14, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:28:18', 15, '2018-11-02 14:28:18', '2018-11-02 14:28:18'),
(15, '123.00', '123.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '0', '2018-11-02 14:30:23', 15, '2018-11-02 14:30:23', '2018-11-02 14:30:23'),
(16, '122.00', '122.00', '03', 'F001', '0001', 'PEN', 0, 0, 0, b'1', 'Targeta', '1', '2018-11-02 20:36:15', 15, '2018-11-02 20:36:15', '2018-11-02 20:36:15'),
(26, '122.00', '122.00', '03', 'f002', '786785', 'PEN', 0, 0, 0, b'1', 'Efectivo', '0', '2018-11-03 01:10:15', 10, '2018-11-03 01:10:15', '2018-11-03 01:10:15');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `entrega`
--
ALTER TABLE `entrega`
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
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
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
-- AUTO_INCREMENT de la tabla `detalle_pago`
--
ALTER TABLE `detalle_pago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `detalle_producto`
--
ALTER TABLE `detalle_producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `detalle_ventas`
--
ALTER TABLE `detalle_ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `entrega`
--
ALTER TABLE `entrega`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
