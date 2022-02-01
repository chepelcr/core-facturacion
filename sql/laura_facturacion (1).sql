-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-01-2022 a las 19:10:22
-- Versión del servidor: 10.4.22-MariaDB
-- Versión de PHP: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laura_facturacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre_categoria` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre_categoria`, `created_at`, `updated_at`) VALUES
(0, 'Sin categoría', '2021-09-13 15:59:27', '2021-09-13 23:59:11'),
(1, 'Bebé', '2021-07-23 17:00:15', '2021-07-24 00:59:59'),
(2, 'Hogar', '2021-07-23 17:00:15', '2021-07-24 00:59:59'),
(3, 'Infantil', '2021-12-13 15:20:38', '2021-12-13 22:20:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `identificacion` varchar(12) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_tipo_identificacion` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `razon` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `nombre_comercial` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_ubicacion` int(11) NOT NULL,
  `otras_senas` varchar(160) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `telefono` int(20) NOT NULL,
  `cod_pais` int(11) NOT NULL,
  `correo` varchar(160) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id_cliente`, `id_empresa`, `identificacion`, `id_tipo_identificacion`, `razon`, `nombre_comercial`, `id_ubicacion`, `otras_senas`, `telefono`, `cod_pais`, `correo`, `estado`) VALUES
(2, 1, '3101143237', '02', 'Taller Gonzáles S.A', 'Taller Gonzáles S.A', 1763, '500M SUR DEL RESTAURANTE FIESTA DEL MAÍZ', 24874310, 52, 'jrodriguez081192@gmail.com', 1),
(3, 1, '3102007223', '02', 'CORPORACION DE SUPERMERCADOS UNIDOS SOCIEDAD DE RESPONSABILIDAD LIMITADA', 'Walmart', 1654, 'De Riteve El Coyol, 600m Oeste.', 99999925, 52, 'walmart.cr@einvoicing.signature-cloud.com', 1),
(4, 1, '116640506', '01', 'JOSE PABLO CAMPOS SOLANO', 'JP Network', 4907, 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 70391069, 52, 'chepelcr@outlook.com', 1),
(5, 1, '102440077', '01', 'VILMA CORELLA ARTAVIA', 'Modas Laura', 4907, 'Entrada al Vikings.', 89890512, 52, 'vilmacorella@yahoo.com', 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `clientes_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `clientes_view` (
`id_cliente` int(11)
,`id_empresa` int(11)
,`identificacion` varchar(12)
,`id_tipo_identificacion` varchar(2)
,`tipo_identificacion` varchar(25)
,`razon` varchar(100)
,`nombre` varchar(100)
,`nombre_comercial` varchar(80)
,`id_ubicacion` int(11)
,`cod_provincia` int(8)
,`provincia` varchar(10)
,`cod_canton` int(8)
,`canton` varchar(19)
,`cod_distrito` int(6)
,`distrito` varchar(28)
,`cod_barrio` int(5)
,`barrio` varchar(47)
,`otras_senas` varchar(160)
,`codigo_telefono` varchar(10)
,`telefono` int(20)
,`cod_pais` int(11)
,`correo` varchar(160)
,`estado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consecutivos`
--

CREATE TABLE `consecutivos` (
  `id_consecutivo` int(11) NOT NULL,
  `ambiente` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_documento` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `consecutivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `consecutivos`
--

INSERT INTO `consecutivos` (`id_consecutivo`, `ambiente`, `tipo_documento`, `consecutivo`) VALUES
(1, 'stag', '01', 11),
(2, 'prod', '01', 1),
(3, 'stag', '04', 15),
(4, 'prod', '04', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id_documento` int(11) NOT NULL,
  `consecutivo` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_documento` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `codigo_seguridad` int(8) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `emisor_cedula` varchar(12) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_nombre` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_tipo` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_comercial` varchar(80) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_id_provincia` varchar(1) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_id_canton` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_id_distrito` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_id_barrio` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `emisor_otras_senas` varchar(160) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `emisor_cod` int(3) NOT NULL,
  `emisor_telefono` int(20) NOT NULL,
  `emisor_correo` varchar(60) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `receptor_nombre` varchar(80) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_cedula` varchar(12) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_tipo` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_comercial` varchar(80) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_id_provincia` varchar(1) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_id_canton` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_id_distrito` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_id_barrio` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_otras_senas` varchar(160) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `receptor_cod` int(3) DEFAULT NULL,
  `receptor_telefono` int(20) DEFAULT NULL,
  `receptor_correo` varchar(60) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `condicion_venta` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `plazo_credito` varchar(10) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `medio_pago` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `moneda` varchar(3) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_cambio` decimal(18,5) NOT NULL,
  `servicios_gravados` decimal(18,5) NOT NULL,
  `servicios_exentos` decimal(18,5) NOT NULL,
  `servicios_exonerados` decimal(18,5) NOT NULL,
  `mercancias_gravadas` decimal(18,5) NOT NULL,
  `mercancias_exentas` decimal(18,5) NOT NULL,
  `mercancias_exoneradas` decimal(18,5) NOT NULL,
  `total_gravado` decimal(18,5) NOT NULL,
  `total_exento` decimal(18,5) NOT NULL,
  `total_exonerado` decimal(18,5) NOT NULL,
  `total_venta` decimal(18,5) NOT NULL,
  `total_descuentos` decimal(18,5) NOT NULL,
  `total_venta_neta` decimal(18,5) NOT NULL,
  `total_impuestos` decimal(18,5) NOT NULL,
  `total_comprobante` decimal(18,5) NOT NULL,
  `notas` varchar(500) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL DEFAULT 1,
  `id_cliente` int(11) NOT NULL DEFAULT 0,
  `id_caja` int(11) NOT NULL,
  `id_sucursal` int(11) NOT NULL DEFAULT 1,
  `envio_atv` int(1) NOT NULL,
  `valido_atv` int(1) NOT NULL,
  `fecha_envio` datetime DEFAULT NULL,
  `fecha_valido` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id_documento`, `consecutivo`, `tipo_documento`, `clave`, `codigo_seguridad`, `fecha`, `emisor_cedula`, `emisor_nombre`, `emisor_tipo`, `emisor_comercial`, `emisor_id_provincia`, `emisor_id_canton`, `emisor_id_distrito`, `emisor_id_barrio`, `emisor_otras_senas`, `emisor_cod`, `emisor_telefono`, `emisor_correo`, `receptor_nombre`, `receptor_cedula`, `receptor_tipo`, `receptor_comercial`, `receptor_id_provincia`, `receptor_id_canton`, `receptor_id_distrito`, `receptor_id_barrio`, `receptor_otras_senas`, `receptor_cod`, `receptor_telefono`, `receptor_correo`, `condicion_venta`, `plazo_credito`, `medio_pago`, `moneda`, `tipo_cambio`, `servicios_gravados`, `servicios_exentos`, `servicios_exonerados`, `mercancias_gravadas`, `mercancias_exentas`, `mercancias_exoneradas`, `total_gravado`, `total_exento`, `total_exonerado`, `total_venta`, `total_descuentos`, `total_venta_neta`, `total_impuestos`, `total_comprobante`, `notas`, `id_usuario`, `id_empresa`, `id_cliente`, `id_caja`, `id_sucursal`, `envio_atv`, `valido_atv`, `fecha_envio`, `fecha_valido`) VALUES
(1, '00100002010000000187', '01', '50614122100010244007700100002010000000187195243816', 95243816, '2021-12-14 09:41:20', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(2, '00100002010000000188', '01', '50614122100010244007700100002010000000188140368197', 40368197, '2021-12-14 09:53:33', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(3, '00100002010000000189', '01', '50614122100010244007700100002010000000189159301628', 59301628, '2021-12-14 09:53:50', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(4, '00100002010000000190', '01', '50614122100010244007700100002010000000190106574983', 6574983, '2021-12-14 09:55:49', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(5, '00100002010000000191', '01', '50614122100010244007700100002010000000191120631458', 20631458, '2021-12-14 09:57:46', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(6, '00100002010000000192', '01', '50614122100010244007700100002010000000192109271468', 9271468, '2021-12-14 10:06:19', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(7, '00100002010000000193', '01', '50614122100010244007700100002010000000193143695072', 43695072, '2021-12-14 10:12:04', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(8, '00100002010000000194', '01', '50614122100010244007700100002010000000194161429835', 61429835, '2021-12-14 10:16:31', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(9, '00100002010000000195', '01', '50614122100010244007700100002010000000195113465708', 13465708, '2021-12-14 10:17:45', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(10, '00100002010000000196', '01', '50614122100010244007700100002010000000196109814257', 9814257, '2021-12-14 10:18:12', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(11, '00100002010000000197', '01', '50614122100010244007700100002010000000197191048672', 91048672, '2021-12-14 10:19:09', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(12, '00100002010000000198', '01', '50614122100010244007700100002010000000198117205369', 17205369, '2021-12-14 10:20:39', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(13, '00100002010000000199', '01', '50614122100010244007700100002010000000199169218347', 69218347, '2021-12-14 10:28:03', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(14, '00100002010000000200', '01', '50614122100010244007700100002010000000200121670895', 21670895, '2021-12-14 10:30:19', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(15, '00100002010000000201', '01', '50614122100010244007700100002010000000201159768402', 59768402, '2021-12-14 10:31:59', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(16, '00100002010000000202', '01', '50614122100010244007700100002010000000202171586209', 71586209, '2021-12-14 10:33:35', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(17, '00100002010000000203', '01', '50614122100010244007700100002010000000203172360541', 72360541, '2021-12-14 10:38:05', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '0.00000', '0.00000', '124188.00000', '3725.64000', '120462.36000', '15660.11000', '136122.47000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(18, '00100002010000000204', '01', '50614122100010244007700100002010000000204152813607', 52813607, '2021-12-14 10:41:50', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '165728.00000', '0.00000', '0.00000', '165728.00000', '0.00000', '0.00000', '165728.00000', '4971.84000', '160756.16000', '20898.30000', '181654.46000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(19, '00100002010000000205', '01', '50614122100010244007700100002010000000205136948027', 36948027, '2021-12-14 10:44:02', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '100912.00000', '0.00000', '0.00000', '100912.00000', '0.00000', '0.00000', '100912.00000', '3027.36000', '97884.64000', '12725.00000', '110609.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(20, '00100002010000000206', '01', '50614122100010244007700100002010000000206113648952', 13648952, '2021-12-14 10:51:28', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '2835.06000', '91666.94000', '11916.70000', '103583.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(21, '00100002010000000207', '01', '50614122100010244007700100002010000000207103975864', 3975864, '2021-12-14 11:09:34', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '2835.06000', '91666.94000', '11916.70000', '103583.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(22, '00100002010000000208', '01', '50614122100010244007700100002010000000208138519642', 38519642, '2021-12-14 11:12:21', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '2835.06000', '91666.94000', '11916.70000', '103583.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(23, '00100002010000000209', '01', '50614122100010244007700100002010000000209132568497', 32568497, '2021-12-14 11:13:12', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '2835.06000', '91666.94000', '11916.70000', '103583.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(24, '00100002010000000210', '01', '50614122100010244007700100002010000000210109831475', 9831475, '2021-12-14 11:14:03', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '0.00000', '0.00000', '94502.00000', '2835.06000', '91666.94000', '11916.70000', '103583.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(25, '00100002010000000211', '01', '50614122100010244007700100002010000000211121507386', 21507386, '2021-12-14 11:44:16', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '52338.00000', '0.00000', '0.00000', '52338.00000', '0.00000', '0.00000', '52338.00000', '1579.14000', '50758.86000', '6598.66000', '57357.51000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(26, '00100002010000000212', '01', '50614122100010244007700100002010000000212137054691', 37054691, '2021-12-14 11:49:19', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '8459.00000', '0.00000', '0.00000', '8459.00000', '0.00000', '0.00000', '8459.00000', '253.77000', '8205.23000', '1066.68000', '9271.91000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(27, '00100002010000000213', '01', '50614122100010244007700100002010000000213162459031', 62459031, '2021-12-14 11:51:36', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '8459.00000', '0.00000', '0.00000', '8459.00000', '0.00000', '0.00000', '8459.00000', '0.00000', '8459.00000', '1099.67000', '9558.67000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(28, '00100002010000000214', '01', '50614122100010244007700100002010000000214185041937', 85041937, '2021-12-14 12:03:25', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '22560.00000', '0.00000', '0.00000', '22560.00000', '0.00000', '0.00000', '22560.00000', '676.80000', '21883.20000', '2844.82000', '24728.02000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(29, '00100002010000000215', '01', '50614122100010244007700100002010000000215131297846', 31297846, '2021-12-14 12:05:11', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '4333.00000', '0.00000', '0.00000', '4333.00000', '0.00000', '0.00000', '4333.00000', '0.00000', '4333.00000', '563.29000', '4896.29000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(30, '00100002010000000216', '01', '50614122100010244007700100002010000000216185412769', 85412769, '2021-12-14 12:25:43', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '27072.00000', '0.00000', '0.00000', '27072.00000', '0.00000', '0.00000', '27072.00000', '812.16000', '26259.84000', '3413.78000', '29673.62000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(31, '00100002010000000217', '01', '50614122100010244007700100002010000000217154209716', 54209716, '2021-12-14 12:40:57', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(32, '00100002010000000218', '01', '50614122100010244007700100002010000000218187239601', 87239601, '2021-12-14 12:44:46', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(33, '00100002010000000219', '01', '50614122100010244007700100002010000000219142913658', 42913658, '2021-12-14 12:47:23', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(34, '00100002010000000220', '01', '50614122100010244007700100002010000000220163574028', 63574028, '2021-12-14 12:50:47', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(35, '00100002010000000221', '01', '50614122100010244007700100002010000000221180142697', 80142697, '2021-12-14 12:51:29', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(36, '00100002010000000222', '01', '50614122100010244007700100002010000000222193467812', 93467812, '2021-12-14 12:53:55', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(37, '00100002010000000223', '01', '50614122100010244007700100002010000000223151279480', 51279480, '2021-12-14 12:55:28', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(38, '00100002010000000224', '01', '50614122100010244007700100002010000000224182419576', 82419576, '2021-12-14 12:56:15', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(39, '00100002010000000225', '01', '50614122100010244007700100002010000000225170692845', 70692845, '2021-12-14 12:59:32', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '0.00000', '0.00000', '6768.00000', '203.04000', '6564.96000', '853.44000', '7418.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(40, '00100002010000000226', '01', '50614122100010244007700100002010000000226119647250', 19647250, '2021-12-14 14:02:18', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '27072.00000', '0.00000', '0.00000', '27072.00000', '0.00000', '0.00000', '27072.00000', '0.00000', '27072.00000', '3519.36000', '30591.36000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(41, '00100002010000000227', '01', '50614122100010244007700100002010000000227165249780', 65249780, '2021-12-14 14:39:51', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '2256.00000', '293.28000', '2549.28000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(42, '00100002010000000228', '01', '50614122100010244007700100002010000000228106213975', 6213975, '2021-12-14 15:50:19', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '1.00000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '2256.00000', '293.28000', '2549.28000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(43, '00100002010000000004', '01', '50629122100010244007700100002010000000004115069237', 15069237, '2021-12-29 12:36:16', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(44, '00100002010000000005', '01', '50629122100010244007700100002010000000005181450269', 81450269, '2021-12-29 12:42:24', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(45, '00100002010000000006', '01', '50629122100010244007700100002010000000006194837562', 94837562, '2021-12-29 12:44:28', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(46, '00100002010000000007', '01', '50629122100010244007700100002010000000007159130267', 59130267, '2021-12-29 12:46:52', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(47, '00100002010000000009', '01', '50629122100010244007700100002010000000009161795240', 61795240, '2021-12-29 12:49:57', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(48, '00100002010000000010', '01', '50629122100010244007700100002010000000010115362497', 15362497, '2021-12-29 12:50:16', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(49, '00100002010000000011', '01', '50629122100010244007700100002010000000011125743691', 25743691, '2021-12-29 12:52:10', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(50, '00100002010000000012', '01', '50629122100010244007700100002010000000012148307125', 48307125, '2021-12-29 12:57:36', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(51, '00100002010000000013', '01', '50629122100010244007700100002010000000013125697138', 25697138, '2021-12-29 13:00:17', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(52, '00100002010000000014', '01', '50629122100010244007700100002010000000014161428075', 61428075, '2021-12-29 13:02:30', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(53, '00100002010000000015', '01', '50629122100010244007700100002010000000015101346987', 1346987, '2021-12-29 14:41:24', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '04', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '14890.58000', '0.00000', '0.00000', '14890.58000', '0.00000', '0.00000', '14890.58000', '0.00000', '14890.58000', '1935.78000', '16826.36000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(54, '00100002010000000016', '01', '50629122100010244007700100002010000000016112964785', 12964785, '2021-12-29 14:45:14', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '04', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '14890.58000', '0.00000', '0.00000', '14890.58000', '0.00000', '0.00000', '14890.58000', '0.00000', '14890.58000', '1935.78000', '16826.36000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(55, '00100002010000000017', '01', '50629122100010244007700100002010000000017178521403', 78521403, '2021-12-29 14:49:06', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '01', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '5098.00000', '662.74000', '5760.74000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(56, '00100002010000000018', '01', '50630122100010244007700100002010000000018152037164', 52037164, '2021-12-29 21:28:35', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '03', 'CRC', '638.94000', '0.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '0.00000', '5098.00000', '0.00000', '5098.00000', '662.74000', '5760.74000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(57, '00100002040000000000', '04', '50631122100010244007700100002040000000000151078642', 51078642, '2021-12-30 19:56:49', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '03', 'CRC', '638.75000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(58, '00100002040000000000', '04', '50631122100010244007700100002040000000000171963428', 71963428, '2021-12-30 20:17:56', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.75000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(59, '00100002040000000001', '04', '50631122100010244007700100002040000000001117043856', 17043856, '2021-12-30 20:22:19', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.75000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(60, '00100002040000000002', '04', '50631122100010244007700100002040000000002190261475', 90261475, '2021-12-30 20:23:52', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.75000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(61, '00100002040000000003', '04', '50631122100010244007700100002040000000003197501248', 97501248, '2021-12-31 10:16:23', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '639.06000', '0.00000', '0.00000', '0.00000', '4896.29000', '0.00000', '0.00000', '4896.29000', '0.00000', '0.00000', '4896.29000', '0.00000', '4896.29000', '636.52000', '5532.81000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(62, '00100002040000000004', '04', '50601012200010244007700100002040000000004127354608', 27354608, '2022-01-01 00:46:12', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '04', 'CRC', '639.06000', '0.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '0.00000', '2549.00000', '0.00000', '2549.00000', '331.37000', '2880.37000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(63, '00100002010000000003', '01', '50601012200010244007700100002010000000003179813425', 79813425, '2022-01-01 00:48:38', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '639.06000', '0.00000', '0.00000', '0.00000', '99539.48000', '0.00000', '0.00000', '99539.48000', '0.00000', '0.00000', '99539.48000', '0.00000', '99539.48000', '12940.13000', '112479.61000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(64, '00100002040000000005', '04', '50605012200010244007700100002040000000005171325068', 71325068, '2022-01-05 14:37:28', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '9353.75000', '0.00000', '0.00000', '9353.75000', '0.00000', '0.00000', '9353.75000', '0.00000', '9353.75000', '1215.99000', '10569.74000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(65, '00100002040000000006', '04', '50605012200010244007700100002040000000006132510948', 32510948, '2022-01-05 15:12:26', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '4333.00000', '0.00000', '0.00000', '4333.00000', '0.00000', '0.00000', '4333.00000', '129.99000', '4203.01000', '546.39000', '4749.40000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(66, '00100002040000000007', '04', '50605012200010244007700100002040000000007103825176', 3825176, '2022-01-05 15:18:15', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '67.68000', '2188.32000', '284.48000', '2472.80000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(67, '00100002010000000004', '01', '50605012200010244007700100002010000000004182415639', 82415639, '2022-01-05 15:21:39', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '03', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '1345.13000', '174.87000', '1520.00000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(68, '00100002040000000008', '04', '50605012200010244007700100002040000000008127105893', 27105893, '2022-01-05 15:27:57', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '03', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '1345.13000', '174.87000', '1520.00000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(69, '00100002010000000005', '01', '50605012200010244007700100002010000000005113709548', 13709548, '2022-01-05 15:30:34', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '03', 'CRC', '638.47000', '1345.13000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '1345.13000', '174.87000', '1520.00000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(70, '00100002040000000009', '04', '50605012200010244007700100002040000000009163042718', 63042718, '2022-01-05 15:33:57', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '6589.00000', '0.00000', '0.00000', '6589.00000', '0.00000', '0.00000', '6589.00000', '0.00000', '6589.00000', '856.57000', '7445.57000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(71, '00100002040000000010', '04', '50605012200010244007700100002040000000010131085724', 31085724, '2022-01-05 16:29:48', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '67.68000', '2188.32000', '284.48000', '2472.80000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(72, '00100002040000000011', '04', '50605012200010244007700100002040000000011190645712', 90645712, '2022-01-05 16:31:52', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '1128.00000', '0.00000', '0.00000', '1128.00000', '0.00000', '0.00000', '1128.00000', '0.00000', '1128.00000', '146.64000', '1274.64000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(73, '00100002040000000012', '04', '50606012200010244007700100002040000000012164125803', 64125803, '2022-01-05 20:06:00', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '2256.00000', '293.28000', '2549.28000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(74, '00100002040000000013', '04', '50606012200010244007700100002040000000013165412907', 65412907, '2022-01-05 20:32:41', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '04', 'CRC', '638.47000', '1345.13000', '0.00000', '0.00000', '0.00000', '0.00000', '0.00000', '1345.13000', '0.00000', '0.00000', '1345.13000', '0.00000', '1345.13000', '174.87000', '1520.00000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL),
(75, '00100002040000000014', '04', '50606012200010244007700100002040000000014149013726', 49013726, '2022-01-05 20:46:22', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01', '0', '01', 'CRC', '638.47000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '2256.00000', '293.28000', '2549.28000', '', 1, 1, 0, 0, 1, 0, 0, NULL, NULL);
INSERT INTO `documentos` (`id_documento`, `consecutivo`, `tipo_documento`, `clave`, `codigo_seguridad`, `fecha`, `emisor_cedula`, `emisor_nombre`, `emisor_tipo`, `emisor_comercial`, `emisor_id_provincia`, `emisor_id_canton`, `emisor_id_distrito`, `emisor_id_barrio`, `emisor_otras_senas`, `emisor_cod`, `emisor_telefono`, `emisor_correo`, `receptor_nombre`, `receptor_cedula`, `receptor_tipo`, `receptor_comercial`, `receptor_id_provincia`, `receptor_id_canton`, `receptor_id_distrito`, `receptor_id_barrio`, `receptor_otras_senas`, `receptor_cod`, `receptor_telefono`, `receptor_correo`, `condicion_venta`, `plazo_credito`, `medio_pago`, `moneda`, `tipo_cambio`, `servicios_gravados`, `servicios_exentos`, `servicios_exonerados`, `mercancias_gravadas`, `mercancias_exentas`, `mercancias_exoneradas`, `total_gravado`, `total_exento`, `total_exonerado`, `total_venta`, `total_descuentos`, `total_venta_neta`, `total_impuestos`, `total_comprobante`, `notas`, `id_usuario`, `id_empresa`, `id_cliente`, `id_caja`, `id_sucursal`, `envio_atv`, `valido_atv`, `fecha_envio`, `fecha_valido`) VALUES
(76, '00100002010000000007', '01', '50621012200010244007700100002010000000007137142085', 37142085, '2022-01-20 19:04:54', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '03', 'CRC', '629.68000', '0.00000', '0.00000', '0.00000', '100554.00000', '0.00000', '0.00000', '100554.00000', '0.00000', '0.00000', '100554.00000', '3016.62000', '97537.38000', '12679.86000', '110217.24000', '', 1, 1, 0, 0, 1, 1, 3, '2022-01-20 20:05:01', '2022-01-20 20:05:01'),
(77, '00100002010000000008', '01', '50621012200010244007700100002010000000008127984065', 27984065, '2022-01-20 19:09:31', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '04', 'CRC', '629.68000', '0.00000', '0.00000', '0.00000', '74556.00000', '0.00000', '0.00000', '74556.00000', '0.00000', '0.00000', '74556.00000', '2236.68000', '72319.32000', '9401.52000', '81720.84000', '', 1, 1, 0, 0, 1, 1, 3, '2022-01-20 20:09:37', '2022-01-20 20:09:37'),
(78, '00100002010000000009', '01', '50621012200010244007700100002010000000009150139846', 50139846, '2022-01-20 19:18:12', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'Walmart', '3102007223', '02', 'Walmart', '2', '1', '2', '19', 'De Riteve El Coyol, 600m Oeste.', 506, 99999925, 'walmart.cr@einvoicing.signature-cloud.com', '01', '0', '03', 'CRC', '629.68000', '0.00000', '0.00000', '0.00000', '43330.00000', '0.00000', '0.00000', '43330.00000', '0.00000', '0.00000', '43330.00000', '0.00000', '43330.00000', '5632.90000', '48962.90000', '', 1, 1, 0, 0, 1, 1, 3, '2022-01-20 20:18:27', '2022-01-20 20:18:27'),
(79, '00100002010000000010', '01', '50621012200010244007700100002010000000010170831246', 70831246, '2022-01-20 19:33:44', '102440077', 'CORELLA ARTAVIA VILMA', '01', 'Modas Laura', '4', '2', '2', '5', 'Barrio El Cocal', 506, 89890512, 'vilmacorella@yahoo.com', 'JP Network', '116640506', '01', 'JP Network', '6', '1', '1', '3', 'De la escuela Mora y Cañas, 150m oeste y 75m sur.', 506, 70391069, 'chepelcr@outlook.com', '01', '0', '03', 'CRC', '629.68000', '0.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '0.00000', '2256.00000', '0.00000', '2256.00000', '293.28000', '2549.28000', '', 1, 1, 0, 0, 1, 1, 1, '2022-01-20 20:33:52', '2022-01-20 20:33:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_detalles`
--

CREATE TABLE `documentos_detalles` (
  `id_detalle` int(11) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `linea` int(3) NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `cantidad` decimal(16,3) NOT NULL,
  `unidad_medida` varchar(15) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `detalle` varchar(160) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `precio_unidad` decimal(18,5) NOT NULL,
  `monto_total` decimal(18,5) NOT NULL,
  `monto_descuento` decimal(18,5) NOT NULL,
  `motivo_descuento` varchar(80) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `sub_total` decimal(18,5) NOT NULL,
  `codigo_impuesto` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `codigo_tarifa` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `tarifa` decimal(4,2) DEFAULT NULL,
  `monto_impuesto` decimal(18,5) DEFAULT NULL,
  `tipo_exoneracion` varchar(2) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `numero_exoneracion` varchar(40) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `institucion_exoneracion` varchar(160) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `fecha_exoneracion` varchar(255) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `porcentaje_exoneracion` int(3) DEFAULT NULL,
  `monto_exoneracion` decimal(18,5) DEFAULT NULL,
  `impuesto_neto` decimal(18,5) DEFAULT NULL,
  `total_linea` decimal(18,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `documentos_detalles`
--

INSERT INTO `documentos_detalles` (`id_detalle`, `id_documento`, `linea`, `codigo`, `cantidad`, `unidad_medida`, `detalle`, `precio_unidad`, `monto_total`, `monto_descuento`, `motivo_descuento`, `sub_total`, `codigo_impuesto`, `codigo_tarifa`, `tarifa`, `monto_impuesto`, `tipo_exoneracion`, `numero_exoneracion`, `institucion_exoneracion`, `fecha_exoneracion`, `porcentaje_exoneracion`, `monto_exoneracion`, `impuesto_neto`, `total_linea`) VALUES
(1, 1, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(2, 1, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(3, 2, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(4, 2, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(5, 3, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(6, 3, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(7, 4, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(8, 4, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(9, 5, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(10, 5, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(11, 6, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(12, 6, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(13, 7, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(14, 7, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(15, 8, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(16, 8, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(17, 9, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(18, 9, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(19, 10, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(20, 10, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(21, 11, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(22, 11, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(23, 12, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(24, 12, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(25, 13, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(26, 13, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(27, 14, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(28, 14, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(29, 15, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(30, 15, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(31, 16, 1, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(32, 16, 2, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(33, 17, 1, '2718000000100', '12.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Centralización', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(34, 17, 2, '2718000000100', '32.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '72192.00000', '2165.76000', 'Centralización', '70026.24000', '01', '08', '13.00', '9103.41000', NULL, NULL, NULL, NULL, NULL, NULL, '9103.41000', '79129.65000'),
(35, 18, 1, '2718000000100', '12.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '27072.00000', '812.16000', 'Centralización', '26259.84000', '01', '08', '13.00', '3413.78000', NULL, NULL, NULL, NULL, NULL, NULL, '3413.78000', '29673.62000'),
(36, 18, 2, '2718000000100', '32.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '138656.00000', '4159.68000', 'Centralización', '134496.32000', '01', '08', '13.00', '17484.52000', NULL, NULL, NULL, NULL, NULL, NULL, '17484.52000', '151980.84000'),
(37, 19, 1, '2718000000100', '14.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '31584.00000', '947.52000', 'Centralización', '30636.48000', '01', '08', '13.00', '3982.74000', NULL, NULL, NULL, NULL, NULL, NULL, '3982.74000', '34619.22000'),
(38, 19, 2, '2718000000100', '16.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '69328.00000', '2079.84000', 'Centralización', '67248.16000', '01', '08', '13.00', '8742.26000', NULL, NULL, NULL, NULL, NULL, NULL, '8742.26000', '75990.42000'),
(39, 20, 1, '2718000000100', '15.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '33840.00000', '1015.20000', 'Centralización', '32824.80000', '01', '08', '13.00', '4267.22000', NULL, NULL, NULL, NULL, NULL, NULL, '4267.22000', '37092.02000'),
(40, 20, 2, '2718000000100', '14.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '60662.00000', '1819.86000', 'Centralización', '58842.14000', '01', '08', '13.00', '7649.48000', NULL, NULL, NULL, NULL, NULL, NULL, '7649.48000', '66491.62000'),
(41, 21, 1, '2718000000100', '15.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '33840.00000', '1015.20000', 'Centralización', '32824.80000', '01', '08', '13.00', '4267.22000', NULL, NULL, NULL, NULL, NULL, NULL, '4267.22000', '37092.02000'),
(42, 21, 2, '2718000000100', '14.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '60662.00000', '1819.86000', 'Centralización', '58842.14000', '01', '08', '13.00', '7649.48000', NULL, NULL, NULL, NULL, NULL, NULL, '7649.48000', '66491.62000'),
(43, 22, 1, '2718000000100', '15.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '33840.00000', '1015.20000', 'Centralización', '32824.80000', '01', '08', '13.00', '4267.22000', NULL, NULL, NULL, NULL, NULL, NULL, '4267.22000', '37092.02000'),
(44, 22, 2, '2718000000100', '14.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '60662.00000', '1819.86000', 'Centralización', '58842.14000', '01', '08', '13.00', '7649.48000', NULL, NULL, NULL, NULL, NULL, NULL, '7649.48000', '66491.62000'),
(45, 23, 1, '2718000000100', '15.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '33840.00000', '1015.20000', 'Centralización', '32824.80000', '01', '08', '13.00', '4267.22000', NULL, NULL, NULL, NULL, NULL, NULL, '4267.22000', '37092.02000'),
(46, 23, 2, '2718000000100', '14.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '60662.00000', '1819.86000', 'Centralización', '58842.14000', '01', '08', '13.00', '7649.48000', NULL, NULL, NULL, NULL, NULL, NULL, '7649.48000', '66491.62000'),
(47, 24, 1, '2718000000100', '15.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '33840.00000', '1015.20000', 'Centralización', '32824.80000', '01', '08', '13.00', '4267.22000', NULL, NULL, NULL, NULL, NULL, NULL, '4267.22000', '37092.02000'),
(48, 24, 2, '2718000000100', '14.000', '', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '60662.00000', '1819.86000', 'Centralización', '58842.14000', '01', '08', '13.00', '7649.48000', NULL, NULL, NULL, NULL, NULL, NULL, '7649.48000', '66491.62000'),
(49, 25, 1, '2718000000100', '1.000', '', 'Almohada #2', '450.00000', '450.00000', '22.50000', 'Centralización', '427.50000', '01', '08', '13.00', '55.58000', NULL, NULL, NULL, NULL, NULL, NULL, '55.58000', '483.07000'),
(50, 25, 2, '2718000000100', '23.000', '', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '51888.00000', '1556.64000', 'Descuento de sistema', '50331.36000', '01', '08', '13.00', '6543.08000', NULL, NULL, NULL, NULL, NULL, NULL, '6543.08000', '56874.44000'),
(51, 26, 1, '2718000000100', '1.000', 'Unid ', 'ALMOH INF LAURA S-COL 60X40CM :: 6', '8459.00000', '8459.00000', '253.77000', 'Centralización', '8205.23000', '01', '08', '13.00', '1066.68000', NULL, NULL, NULL, NULL, NULL, NULL, '1066.68000', '9271.91000'),
(52, 27, 1, '2718000000100', '1.000', 'Unid', 'ALMOH INF LAURA S-COL 60X40CM :: 6', '8459.00000', '8459.00000', '0.00000', 'Descuento de sistema', '8459.00000', '01', '08', '13.00', '1099.67000', NULL, NULL, NULL, NULL, NULL, NULL, '1099.67000', '9558.67000'),
(53, 28, 1, '2718000000100', '10.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '22560.00000', '676.80000', 'Centralización', '21883.20000', '01', '08', '13.00', '2844.82000', NULL, NULL, NULL, NULL, NULL, NULL, '2844.82000', '24728.02000'),
(54, 29, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '4333.00000', '0.00000', '', '4333.00000', '01', '08', '13.00', '563.29000', NULL, NULL, NULL, NULL, NULL, NULL, '563.29000', '4896.29000'),
(55, 30, 1, '2718000000100', '12.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '27072.00000', '812.16000', 'Centralización', '26259.84000', '01', '08', '13.00', '3413.78000', NULL, NULL, NULL, NULL, NULL, NULL, '3413.78000', '29673.62000'),
(56, 31, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(57, 32, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(58, 33, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(59, 34, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(60, 35, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(61, 36, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(62, 37, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(63, 38, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(64, 39, 1, '2718000000100', '3.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '6768.00000', '203.04000', 'Centralización', '6564.96000', '01', '08', '13.00', '853.44000', NULL, NULL, NULL, NULL, NULL, NULL, '853.44000', '7418.40000'),
(65, 40, 1, '2718000000100', '12.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '27072.00000', '0.00000', '', '27072.00000', '01', '08', '13.00', '3519.36000', NULL, NULL, NULL, NULL, NULL, NULL, '3519.36000', '30591.36000'),
(66, 41, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', '', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000'),
(67, 42, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', '', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000'),
(68, 43, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(69, 43, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(70, 44, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(71, 44, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(72, 45, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(73, 45, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(74, 46, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(75, 46, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(76, 47, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(77, 47, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(78, 48, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(79, 48, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(80, 49, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(81, 49, 2, '', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(82, 50, 1, '1', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(83, 50, 2, '1', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(84, 51, 1, '1', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(85, 51, 2, '1', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(86, 52, 1, '1', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(87, 52, 2, '1', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(88, 53, 1, '1', '2.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '5098.00000', '0.00000', '', '5098.00000', '01', '08', '13.00', '662.74000', NULL, NULL, NULL, NULL, NULL, NULL, '662.74000', '5760.74000'),
(89, 53, 2, '1', '2.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4896.29000', '9792.58000', '0.00000', '', '9792.58000', '01', '08', '13.00', '1273.04000', NULL, NULL, NULL, NULL, NULL, NULL, '1273.04000', '11065.62000'),
(90, 53, 3, '1', '0.000', '', '', '0.00000', '0.00000', '0.00000', '', '0.00000', '01', '08', '0.00', '0.00000', NULL, NULL, NULL, NULL, NULL, NULL, '0.00000', '0.00000'),
(91, 54, 1, '2718000000100', '2.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '5098.00000', '0.00000', '', '5098.00000', '01', '08', '13.00', '662.74000', NULL, NULL, NULL, NULL, NULL, NULL, '662.74000', '5760.74000'),
(92, 54, 2, '2718000000100', '2.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4896.29000', '9792.58000', '0.00000', '', '9792.58000', '01', '08', '13.00', '1273.04000', NULL, NULL, NULL, NULL, NULL, NULL, '1273.04000', '11065.62000'),
(93, 55, 1, '2718000000100', '2.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '5098.00000', '0.00000', '', '5098.00000', '01', '08', '13.00', '662.74000', NULL, NULL, NULL, NULL, NULL, NULL, '662.74000', '5760.74000'),
(94, 56, 1, '2718000000100', '2.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '5098.00000', '0.00000', '', '5098.00000', '01', '08', '13.00', '662.74000', NULL, NULL, NULL, NULL, NULL, NULL, '662.74000', '5760.74000'),
(95, 57, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(96, 58, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(97, 59, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(98, 60, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(99, 61, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4896.29000', '4896.29000', '0.00000', '', '4896.29000', '01', '08', '13.00', '636.52000', NULL, NULL, NULL, NULL, NULL, NULL, '636.52000', '5532.81000'),
(100, 62, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2549.00000', '0.00000', '', '2549.00000', '01', '08', '13.00', '331.37000', NULL, NULL, NULL, NULL, NULL, NULL, '331.37000', '2880.37000'),
(101, 63, 1, '2718000000100', '12.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4896.29000', '58755.48000', '0.00000', '', '58755.48000', '01', '08', '13.00', '7638.21000', NULL, NULL, NULL, NULL, NULL, NULL, '7638.21000', '66393.69000'),
(102, 63, 2, '2718000000100', '16.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '40784.00000', '0.00000', '', '40784.00000', '01', '08', '13.00', '5301.92000', NULL, NULL, NULL, NULL, NULL, NULL, '5301.92000', '46085.92000'),
(103, 64, 1, '2714001010100', '1.000', 'Unid', 'FUNDA BEBE CUADRADA BLANCA DOCOMA :: 3', '3124.45000', '2765.00000', '0.00000', '', '2765.00000', '01', '08', '13.00', '359.45000', NULL, NULL, NULL, NULL, NULL, NULL, '359.45000', '3124.45000'),
(104, 64, 2, '2718000000100', '1.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4896.29000', '4333.00000', '0.00000', '', '4333.00000', '01', '08', '13.00', '563.29000', NULL, NULL, NULL, NULL, NULL, NULL, '563.29000', '4896.29000'),
(105, 64, 3, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2549.00000', '2255.75000', '0.00000', '', '2255.75000', '01', '08', '13.00', '293.25000', NULL, NULL, NULL, NULL, NULL, NULL, '293.25000', '2549.00000'),
(106, 65, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '4333.00000', '129.99000', '', '4203.01000', '01', '08', '13.00', '546.39000', NULL, NULL, NULL, NULL, NULL, NULL, '546.39000', '4749.40000'),
(107, 66, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '67.68000', 'Descuento de sistema', '2188.32000', '01', '08', '13.00', '284.48000', NULL, NULL, NULL, NULL, NULL, NULL, '284.48000', '2472.80000'),
(108, 67, 1, '2718000000100', '1.000', 'Cm ', 'Descuento por pronto pago', '1345.13000', '1345.13000', '0.00000', 'Descuento de sistema', '1345.13000', '01', '08', '13.00', '174.87000', NULL, NULL, NULL, NULL, NULL, NULL, '174.87000', '1520.00000'),
(109, 68, 1, '2718000000100', '1.000', 'Cm', 'Descuento por pronto pago', '1345.13000', '1345.13000', '0.00000', 'Descuento de sistema', '1345.13000', '01', '08', '13.00', '174.87000', NULL, NULL, NULL, NULL, NULL, NULL, '174.87000', '1520.00000'),
(110, 69, 1, '2718000000100', '1.000', 'Cm', 'Descuento por pronto pago', '1345.13000', '1345.13000', '0.00000', 'Descuento de sistema', '1345.13000', '01', '08', '13.00', '174.87000', NULL, NULL, NULL, NULL, NULL, NULL, '174.87000', '1520.00000'),
(111, 70, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '4333.00000', '0.00000', 'Descuento de sistema', '4333.00000', '01', '08', '13.00', '563.29000', NULL, NULL, NULL, NULL, NULL, NULL, '563.29000', '4896.29000'),
(112, 70, 2, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', 'Descuento de sistema', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000'),
(113, 71, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '67.68000', 'Descuento de sistema', '2188.32000', '01', '08', '13.00', '284.48000', NULL, NULL, NULL, NULL, NULL, NULL, '284.48000', '2472.80000'),
(114, 72, 1, '2718000000100', '0.500', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '1128.00000', '0.00000', 'Descuento de sistema', '1128.00000', '01', '08', '13.00', '146.64000', NULL, NULL, NULL, NULL, NULL, NULL, '146.64000', '1274.64000'),
(115, 73, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', 'Descuento de sistema', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000'),
(116, 74, 1, '2718000000100', '1.000', 'Cm', 'Descuento por pronto pago', '1345.13000', '1345.13000', '0.00000', 'Descuento de sistema', '1345.13000', '01', '08', '13.00', '174.87000', NULL, NULL, NULL, NULL, NULL, NULL, '174.87000', '1520.00000'),
(117, 75, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', 'Descuento de sistema', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000'),
(118, 77, 1, '2718000000100', '10.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '22560.00000', '676.80000', 'Descuento de sistema', '21883.20000', '01', '08', '13.00', '2844.82000', NULL, NULL, NULL, NULL, NULL, NULL, '2844.82000', '24728.02000'),
(119, 77, 2, '2718000000100', '12.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '51996.00000', '1559.88000', 'Descuento de sistema', '50436.12000', '01', '08', '13.00', '6556.70000', NULL, NULL, NULL, NULL, NULL, NULL, '6556.70000', '56992.82000'),
(120, 78, 1, '2718000000100', '10.000', 'Unid', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', '4333.00000', '43330.00000', '0.00000', 'Descuento de sistema', '43330.00000', '01', '08', '13.00', '5632.90000', NULL, NULL, NULL, NULL, NULL, NULL, '5632.90000', '48962.90000'),
(121, 79, 1, '2718000000100', '1.000', 'Unid', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', '2256.00000', '2256.00000', '0.00000', 'Descuento de sistema', '2256.00000', '01', '08', '13.00', '293.28000', NULL, NULL, NULL, NULL, NULL, NULL, '293.28000', '2549.28000');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_diarios`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_diarios` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_mes`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_mes` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_mes_anterior`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_mes_anterior` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_semana`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_semana` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_semanal`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_semanal` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_semana_anterior`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_semana_anterior` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `documentos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `documentos_view` (
`id_documento` int(11)
,`consecutivo` varchar(20)
,`tipo_documento` varchar(2)
,`clave` varchar(50)
,`codigo_seguridad` int(8)
,`fecha` datetime
,`emisor_cedula` varchar(12)
,`emisor_nombre` varchar(80)
,`emisor_tipo` varchar(2)
,`emisor_comercial` varchar(80)
,`emisor_id_provincia` varchar(1)
,`emisor_id_canton` varchar(2)
,`emisor_id_distrito` varchar(2)
,`emisor_id_barrio` varchar(2)
,`emisor_otras_senas` varchar(160)
,`emisor_cod` int(3)
,`emisor_telefono` int(20)
,`emisor_correo` varchar(60)
,`receptor_nombre` varchar(80)
,`receptor_cedula` varchar(12)
,`receptor_tipo` varchar(2)
,`receptor_comercial` varchar(80)
,`receptor_id_provincia` varchar(1)
,`receptor_id_canton` varchar(2)
,`receptor_id_distrito` varchar(2)
,`receptor_id_barrio` varchar(2)
,`receptor_otras_senas` varchar(160)
,`receptor_cod` int(3)
,`receptor_telefono` int(20)
,`receptor_correo` varchar(60)
,`condicion_venta` varchar(2)
,`plazo_credito` varchar(10)
,`medio_pago` varchar(2)
,`moneda` varchar(3)
,`tipo_cambio` decimal(18,5)
,`servicios_gravados` decimal(18,5)
,`servicios_exentos` decimal(18,5)
,`servicios_exonerados` decimal(18,5)
,`mercancias_gravadas` decimal(18,5)
,`mercancias_exentas` decimal(18,5)
,`mercancias_exoneradas` decimal(18,5)
,`total_gravado` decimal(18,5)
,`total_exento` decimal(18,5)
,`total_exonerado` decimal(18,5)
,`total_venta` decimal(18,5)
,`total_descuentos` decimal(18,5)
,`total_venta_neta` decimal(18,5)
,`total_impuestos` decimal(18,5)
,`total_comprobante` decimal(18,5)
,`notas` varchar(500)
,`id_usuario` int(11)
,`id_empresa` int(11)
,`envio_atv` int(1)
,`valido_atv` int(1)
,`fecha_envio` datetime
,`fecha_valido` datetime
,`dias_emitido` int(7)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `empresas_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `empresas_view` (
`id_empresa` int(11)
,`identificacion` varchar(12)
,`id_tipo_identificacion` varchar(2)
,`tipo_identificacion` varchar(25)
,`razon` varchar(100)
,`nombre` varchar(100)
,`nombre_comercial` varchar(80)
,`cod_actividad` int(11)
,`id_ubicacion` int(11)
,`cod_provincia` int(8)
,`cod_canton` int(8)
,`cod_distrito` int(6)
,`cod_barrio` int(5)
,`provincia` varchar(10)
,`canton` varchar(19)
,`distrito` varchar(28)
,`barrio` varchar(47)
,`otras_senas` varchar(160)
,`telefono` int(20)
,`cod_pais` int(3)
,`codigo_telefono` varchar(10)
,`nombre_pais` varchar(80)
,`correo` varchar(160)
,`estado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(15) NOT NULL,
  `id_unidad` int(15) NOT NULL,
  `unidad_empaque` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `codigo_cabys` varchar(15) NOT NULL,
  `codigo_venta` varchar(15) NOT NULL,
  `codigo_interno` varchar(250) NOT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `impuesto` int(11) NOT NULL,
  `descuento` double(10,2) NOT NULL DEFAULT 0.00,
  `porcentaje_descuento` int(11) NOT NULL DEFAULT 0,
  `valor_unitario` double(10,2) NOT NULL,
  `valor_impuesto` double(10,2) NOT NULL,
  `valor_total` double(10,2) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `fecha_eliminacion` datetime DEFAULT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `id_unidad`, `unidad_empaque`, `id_categoria`, `id_empresa`, `codigo_cabys`, `codigo_venta`, `codigo_interno`, `descripcion`, `impuesto`, `descuento`, `porcentaje_descuento`, `valor_unitario`, `valor_impuesto`, `valor_total`, `fecha_creacion`, `fecha_modificacion`, `fecha_eliminacion`, `estado`) VALUES
(3, 85, 6, 3, 1, '2718000000100', '17441119600437', '2202849', 'ALMOH INF LAURA S-COL 60X40CM :: 6', 13, 0.00, 0, 8459.00, 1099.67, 9558.67, '2021-12-13 15:23:10', '2021-12-13 15:23:10', NULL, 1),
(4, 85, 3, 1, 1, '2718000000100', '7441119600768', '2647973', 'ALMOHADA BEBE SENCILLA ESTAMPADA DOCOMA :: 3', 13, 0.00, 0, 2256.00, 293.28, 2549.00, '2021-12-13 15:51:29', '2021-12-13 15:51:29', NULL, 1),
(5, 85, 3, 1, 1, '2718000000100', '7441119600652', '2645516', 'ALMOHADA Y FUNDA BEBE COLORES SURTIDOS DOCOMA :: 3', 13, 0.00, 0, 4333.00, 563.29, 4896.29, '2021-12-13 15:53:32', '2021-12-13 15:53:32', NULL, 1),
(6, 85, 1, 2, 1, '2714099009900', '17441119600444', '2022659', 'DELANTAL CARNICERO SURTIDO COLOR ARMY', 13, 0.00, 0, 1500.00, 195.00, 1695.00, '2021-12-13 15:56:21', '2021-12-13 15:56:21', NULL, 1),
(7, 3, 1, 0, 1, '2718000000100', '001', '001', 'Descuento por pronto pago', 13, 0.00, 0, 1345.13, 174.87, 1520.00, '2021-12-13 15:57:22', '2021-12-13 16:33:50', NULL, 1),
(8, 85, 3, 1, 1, '2714001010100', '7441119600157', '2645628', 'FUNDA BEBE CUADRADA AMARILLA DOCOMA :: 3', 13, 0.00, 0, 2765.00, 359.45, 3124.45, '2021-12-13 16:36:03', '2021-12-13 16:36:03', NULL, 1),
(9, 85, 3, 1, 1, '2714001010100', '7441119600164', '2648015', 'FUNDA BEBE CUADRADA BLANCA DOCOMA :: 3', 13, 0.00, 0, 2765.00, 359.45, 3124.45, '2021-12-13 16:37:25', '2021-12-13 16:37:25', NULL, 1),
(10, 85, 3, 1, 1, '2714001010100', '7441119600171', '2645649', 'FUNDA BEBE CUADRADA CELESTE DOCOMA :: 3', 13, 0.00, 0, 2765.00, 359.45, 3124.45, '2021-12-13 16:38:46', '2021-12-13 16:38:46', NULL, 1),
(11, 85, 3, 1, 1, '2714001010100', '7441119600188', '2645635', 'FUNDA BEBE CUADRADA ROSADA DOCOMA :: 3', 13, 0.00, 0, 2765.00, 359.45, 3124.45, '2021-12-13 16:39:44', '2021-12-13 16:39:44', NULL, 1),
(12, 85, 15, 2, 1, '2718000000100', '17441119600505', '2210395', 'FUNDA INDIVID GR SURT COL DOCOM :: 15', 13, 0.00, 0, 17116.00, 2225.08, 19341.08, '2021-12-13 16:41:25', '2021-12-13 16:41:25', NULL, 1),
(13, 85, 18, 2, 1, '2718000000100', '17441119600697', '2210388', 'FUNDA INDIVIDUAL BLANCA :: 18', 13, 0.00, 0, 20540.00, 2670.20, 23210.20, '2021-12-13 16:42:15', '2021-12-13 16:42:15', NULL, 1),
(14, 85, 3, 1, 1, '2718000000100', '1447451547414', '2145141', 'ALMOHADA Y FUNDA AMARILLA', 13, 0.00, 0, 4514.00, 586.82, 5100.82, '2021-12-15 09:54:34', '2021-12-15 09:54:34', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `productos_view`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `productos_view` (
`id_producto` int(15)
,`id_unidad` int(15)
,`unidad_empaque` int(11)
,`id_categoria` int(11)
,`nombre_categoria` varchar(50)
,`simbolo_unidad` varchar(10)
,`nombre_unidad` varchar(30)
,`id_empresa` int(11)
,`codigo_cabys` varchar(15)
,`codigo_venta` varchar(15)
,`codigo_interno` varchar(250)
,`descripcion` varchar(100)
,`impuesto` int(11)
,`valor_unitario` double(10,2)
,`valor_impuesto` double(10,2)
,`valor_total` double(10,2)
,`descuento` double(10,2)
,`porcentaje_descuento` int(11)
,`fecha_creacion` datetime
,`fecha_modificacion` datetime
,`fecha_eliminacion` datetime
,`estado` tinyint(1)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos_documentos`
--

CREATE TABLE `tipos_documentos` (
  `id_tipo_documento` varchar(2) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `tipo_documento` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `tipos_documentos`
--

INSERT INTO `tipos_documentos` (`id_tipo_documento`, `tipo_documento`, `fecha_creacion`, `estado`) VALUES
('01', 'Factura electrónica ', '2021-12-13 09:56:07', 1),
('02', 'Nota de débito electrónica', '2021-12-13 09:56:07', 1),
('03', 'Nota de crédito electrónica ', '2021-12-13 09:56:07', 1),
('04', 'Tiquete electrónico', '2021-12-13 09:56:07', 1),
('05', 'Nota de despacho', '2021-12-13 09:56:07', 1),
('06', 'Contrato', '2021-12-13 09:56:07', 1),
('07', 'Procedimiento', '2021-12-13 09:56:07', 1),
('08', 'Comprobante emitido en contingencia', '2021-12-13 09:56:07', 1),
('09', 'Devolución mercadería', '2021-12-13 09:56:07', 1),
('10', 'Sustituye factura rechazada por el Ministerio \r\nde Hacienda', '2021-12-13 09:56:07', 1),
('11', 'Sustituye factura rechazada por el Receptor \r\ndel comprobante', '2021-12-13 09:56:07', 1),
('12', 'Sustituye Factura de exportación', '2021-12-13 09:56:07', 1),
('13', 'Facturación mes vencido', '2021-12-13 09:56:07', 1),
('14', 'Comprobante aportado por contribuyente \r\ndel Régimen de Tributación Simplificado', '2021-12-13 09:56:07', 1),
('15', 'Sustituye una Factura electrónica de \r\nCompra', '2021-12-13 09:56:07', 1),
('99', 'Otros', '2021-12-13 09:56:07', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidades_medida`
--

CREATE TABLE `unidades_medida` (
  `id_unidad` int(11) NOT NULL,
  `simbolo` varchar(10) COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `descripcion` varchar(30) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `unidades_medida`
--

INSERT INTO `unidades_medida` (`id_unidad`, `simbolo`, `descripcion`) VALUES
(1, 'Al', 'Alquiler de uso habitacional '),
(2, 'Alc', 'Alquiler de uso comercial '),
(3, 'Cm', 'Comisiones '),
(4, 'I', 'Intereses '),
(5, 'Os', 'Otro tipo de servicio '),
(6, 'Sp', 'Servicios Profesionales '),
(7, 'Spe', 'Servicios personales '),
(8, 'St', 'Servicios técnicos '),
(9, '1', 'uno (índice de refracción) '),
(10, '\'', 'minuto '),
(11, '\'\'', 'segundo '),
(12, '°C', 'grado Celsius '),
(13, '1/m', '1 por metro '),
(14, 'A', 'Ampere '),
(15, 'A/m', 'ampere por metro '),
(16, 'A/m^2', 'ampere por metro cuadrado '),
(17, 'B', 'bel '),
(18, 'Bq', 'Becquerel '),
(19, 'C', 'coulomb '),
(20, 'C/kg', 'coulomb por kilogramo '),
(21, 'C/m^2', 'coulomb por metro cuadrado '),
(22, 'C/m^3', 'coulomb por metro cúbico '),
(23, 'cd', 'Candela '),
(24, 'cd/m^2', 'candela por metro cuadrado '),
(25, 'cm', 'centímetro '),
(26, 'd', 'día '),
(27, 'eV', 'electronvolt '),
(28, 'F', 'farad '),
(29, 'F/m', 'farad por metro '),
(30, 'g', 'Gramo '),
(31, 'Gal', 'Galón '),
(32, 'Gy', 'gray '),
(33, 'Gy/s', 'gray por segundo '),
(34, 'H', 'henry '),
(35, 'h', 'hora '),
(36, 'H/m', 'henry por metro '),
(37, 'Hz', 'hertz '),
(38, 'J', 'Joule '),
(39, 'J/(kg*K)', 'joule por kilogramo kelvin '),
(40, 'J/(mol*K)', 'joule por mol kelvin '),
(41, 'J/K', 'joule por kelvin '),
(42, 'J/kg', 'joule por kilogramo '),
(43, 'J/m^3', 'joule por metro cúbico '),
(44, 'J/mol', 'joule por mol '),
(45, 'K', 'Kelvin '),
(46, 'kat', 'katal '),
(47, 'kat/m^3', 'katal por metro cúbico '),
(48, 'kg', 'Kilogramo '),
(49, 'kg/m^3', 'kilogramo por metro cúbico '),
(50, 'Km', 'Kilometro '),
(51, 'Kw', 'kilovatios '),
(52, 'L', 'litro '),
(53, 'lm', 'lumen '),
(54, 'ln', 'pulgada '),
(55, 'lx', 'lux '),
(56, 'm', 'Metro '),
(57, 'm/s', 'metro por segundo '),
(58, 'm/s^2', 'metro por segundo cuadrado '),
(59, 'm^2', 'metro cuadrado '),
(60, 'm^3', 'metro cúbico '),
(61, 'min', 'minuto '),
(62, 'mL', 'mililitro '),
(63, 'mm', 'Milímetro '),
(64, 'mol', 'Mol '),
(65, 'mol/m^3', 'mol por metro cúbico '),
(66, 'N', 'newton '),
(67, 'N/m', 'newton por metro '),
(68, 'N?m', 'newton metro '),
(69, 'Np', 'neper '),
(70, '°', 'grado '),
(71, 'Oz', 'Onzas '),
(72, 'Pa', 'pascal '),
(73, 'Pa*s', 'pascal segundo '),
(74, 'rad', 'radián '),
(75, 'rad/s', 'radián por segundo '),
(76, 'rad/s^2', 'radián por segundo cuadrado '),
(77, 's', 'Segundo '),
(78, 'S', 'siemens '),
(79, 'sr', 'estereorradián '),
(80, 'Sv', 'sievert '),
(81, 'T', 'tesla '),
(82, 't', 'tonelada '),
(83, 'u', 'unidad de masa atómica unifica'),
(84, 'ua', 'unidad astronómica '),
(85, 'Unid', 'Unidad '),
(86, 'V', 'volt '),
(87, 'V/m', 'volt por metro '),
(88, 'W', 'Watt '),
(89, 'W/(m*K)', 'watt por metro kevin '),
(90, 'W/(m^2*sr)', 'watt por metro cuadrado estere'),
(91, 'W/m?', 'watt por metro cuadrado '),
(92, 'W/sr', 'watt por estereorradián '),
(93, 'Wb', 'weber '),
(94, 'Ω', 'ohm '),
(95, 'Otros', 'Se debe indicar la descripción');

-- --------------------------------------------------------

--
-- Estructura para la vista `clientes_view`
--
DROP TABLE IF EXISTS `clientes_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `clientes_view`  AS SELECT `clientes`.`id_cliente` AS `id_cliente`, `clientes`.`id_empresa` AS `id_empresa`, `clientes`.`identificacion` AS `identificacion`, `clientes`.`id_tipo_identificacion` AS `id_tipo_identificacion`, `laura_seguridad`.`tipos_identificaciones`.`tipo_identificacion` AS `tipo_identificacion`, `clientes`.`razon` AS `razon`, `clientes`.`razon` AS `nombre`, `clientes`.`nombre_comercial` AS `nombre_comercial`, `clientes`.`id_ubicacion` AS `id_ubicacion`, `laura_seguridad`.`ubicaciones`.`cod_provincia` AS `cod_provincia`, `laura_seguridad`.`ubicaciones`.`provincia` AS `provincia`, `laura_seguridad`.`ubicaciones`.`cod_canton` AS `cod_canton`, `laura_seguridad`.`ubicaciones`.`canton` AS `canton`, `laura_seguridad`.`ubicaciones`.`cod_distrito` AS `cod_distrito`, `laura_seguridad`.`ubicaciones`.`distrito` AS `distrito`, `laura_seguridad`.`ubicaciones`.`cod_barrio` AS `cod_barrio`, `laura_seguridad`.`ubicaciones`.`barrio` AS `barrio`, `clientes`.`otras_senas` AS `otras_senas`, `laura_seguridad`.`codigos_paises`.`codigo_telefono` AS `codigo_telefono`, `clientes`.`telefono` AS `telefono`, `clientes`.`cod_pais` AS `cod_pais`, `clientes`.`correo` AS `correo`, `clientes`.`estado` AS `estado` FROM (((`clientes` join `laura_seguridad`.`tipos_identificaciones` on(`laura_seguridad`.`tipos_identificaciones`.`id_tipo_identificacion` = `clientes`.`id_tipo_identificacion`)) join `laura_seguridad`.`codigos_paises` on(`laura_seguridad`.`codigos_paises`.`cod_pais` = `clientes`.`cod_pais`)) join `laura_seguridad`.`ubicaciones` on(`clientes`.`id_ubicacion` = `laura_seguridad`.`ubicaciones`.`id_ubicacion`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_diarios`
--
DROP TABLE IF EXISTS `documentos_diarios`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_diarios`  AS SELECT `documentos_view`.`id_documento` AS `id_documento`, `documentos_view`.`consecutivo` AS `consecutivo`, `documentos_view`.`tipo_documento` AS `tipo_documento`, `documentos_view`.`clave` AS `clave`, `documentos_view`.`codigo_seguridad` AS `codigo_seguridad`, `documentos_view`.`fecha` AS `fecha`, `documentos_view`.`emisor_cedula` AS `emisor_cedula`, `documentos_view`.`emisor_nombre` AS `emisor_nombre`, `documentos_view`.`emisor_tipo` AS `emisor_tipo`, `documentos_view`.`emisor_comercial` AS `emisor_comercial`, `documentos_view`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos_view`.`emisor_id_canton` AS `emisor_id_canton`, `documentos_view`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos_view`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos_view`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos_view`.`emisor_cod` AS `emisor_cod`, `documentos_view`.`emisor_telefono` AS `emisor_telefono`, `documentos_view`.`emisor_correo` AS `emisor_correo`, `documentos_view`.`receptor_nombre` AS `receptor_nombre`, `documentos_view`.`receptor_cedula` AS `receptor_cedula`, `documentos_view`.`receptor_tipo` AS `receptor_tipo`, `documentos_view`.`receptor_comercial` AS `receptor_comercial`, `documentos_view`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos_view`.`receptor_id_canton` AS `receptor_id_canton`, `documentos_view`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos_view`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos_view`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos_view`.`receptor_cod` AS `receptor_cod`, `documentos_view`.`receptor_telefono` AS `receptor_telefono`, `documentos_view`.`receptor_correo` AS `receptor_correo`, `documentos_view`.`condicion_venta` AS `condicion_venta`, `documentos_view`.`plazo_credito` AS `plazo_credito`, `documentos_view`.`medio_pago` AS `medio_pago`, `documentos_view`.`moneda` AS `moneda`, `documentos_view`.`tipo_cambio` AS `tipo_cambio`, `documentos_view`.`servicios_gravados` AS `servicios_gravados`, `documentos_view`.`servicios_exentos` AS `servicios_exentos`, `documentos_view`.`servicios_exonerados` AS `servicios_exonerados`, `documentos_view`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos_view`.`mercancias_exentas` AS `mercancias_exentas`, `documentos_view`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos_view`.`total_gravado` AS `total_gravado`, `documentos_view`.`total_exento` AS `total_exento`, `documentos_view`.`total_exonerado` AS `total_exonerado`, `documentos_view`.`total_venta` AS `total_venta`, `documentos_view`.`total_descuentos` AS `total_descuentos`, `documentos_view`.`total_venta_neta` AS `total_venta_neta`, `documentos_view`.`total_impuestos` AS `total_impuestos`, `documentos_view`.`total_comprobante` AS `total_comprobante`, `documentos_view`.`notas` AS `notas`, `documentos_view`.`id_usuario` AS `id_usuario`, `documentos_view`.`id_empresa` AS `id_empresa`, `documentos_view`.`envio_atv` AS `envio_atv`, `documentos_view`.`valido_atv` AS `valido_atv`, `documentos_view`.`fecha_envio` AS `fecha_envio`, `documentos_view`.`fecha_valido` AS `fecha_valido` FROM `documentos_view` WHERE `documentos_view`.`dias_emitido` = 0 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_mes`
--
DROP TABLE IF EXISTS `documentos_mes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_mes`  AS SELECT `documentos`.`id_documento` AS `id_documento`, `documentos`.`consecutivo` AS `consecutivo`, `documentos`.`tipo_documento` AS `tipo_documento`, `documentos`.`clave` AS `clave`, `documentos`.`codigo_seguridad` AS `codigo_seguridad`, `documentos`.`fecha` AS `fecha`, `documentos`.`emisor_cedula` AS `emisor_cedula`, `documentos`.`emisor_nombre` AS `emisor_nombre`, `documentos`.`emisor_tipo` AS `emisor_tipo`, `documentos`.`emisor_comercial` AS `emisor_comercial`, `documentos`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos`.`emisor_id_canton` AS `emisor_id_canton`, `documentos`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos`.`emisor_cod` AS `emisor_cod`, `documentos`.`emisor_telefono` AS `emisor_telefono`, `documentos`.`emisor_correo` AS `emisor_correo`, `documentos`.`receptor_nombre` AS `receptor_nombre`, `documentos`.`receptor_cedula` AS `receptor_cedula`, `documentos`.`receptor_tipo` AS `receptor_tipo`, `documentos`.`receptor_comercial` AS `receptor_comercial`, `documentos`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos`.`receptor_id_canton` AS `receptor_id_canton`, `documentos`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos`.`receptor_cod` AS `receptor_cod`, `documentos`.`receptor_telefono` AS `receptor_telefono`, `documentos`.`receptor_correo` AS `receptor_correo`, `documentos`.`condicion_venta` AS `condicion_venta`, `documentos`.`plazo_credito` AS `plazo_credito`, `documentos`.`medio_pago` AS `medio_pago`, `documentos`.`moneda` AS `moneda`, `documentos`.`tipo_cambio` AS `tipo_cambio`, `documentos`.`servicios_gravados` AS `servicios_gravados`, `documentos`.`servicios_exentos` AS `servicios_exentos`, `documentos`.`servicios_exonerados` AS `servicios_exonerados`, `documentos`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos`.`mercancias_exentas` AS `mercancias_exentas`, `documentos`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos`.`total_gravado` AS `total_gravado`, `documentos`.`total_exento` AS `total_exento`, `documentos`.`total_exonerado` AS `total_exonerado`, `documentos`.`total_venta` AS `total_venta`, `documentos`.`total_descuentos` AS `total_descuentos`, `documentos`.`total_venta_neta` AS `total_venta_neta`, `documentos`.`total_impuestos` AS `total_impuestos`, `documentos`.`total_comprobante` AS `total_comprobante`, `documentos`.`notas` AS `notas`, `documentos`.`id_usuario` AS `id_usuario`, `documentos`.`id_empresa` AS `id_empresa`, `documentos`.`envio_atv` AS `envio_atv`, `documentos`.`valido_atv` AS `valido_atv`, `documentos`.`fecha_envio` AS `fecha_envio`, `documentos`.`fecha_valido` AS `fecha_valido` FROM `documentos` WHERE date_format(`documentos`.`fecha`,'%Y-%m') = date_format(current_timestamp() - interval 0 month,'%Y-%m') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_mes_anterior`
--
DROP TABLE IF EXISTS `documentos_mes_anterior`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_mes_anterior`  AS SELECT `documentos`.`id_documento` AS `id_documento`, `documentos`.`consecutivo` AS `consecutivo`, `documentos`.`tipo_documento` AS `tipo_documento`, `documentos`.`clave` AS `clave`, `documentos`.`codigo_seguridad` AS `codigo_seguridad`, `documentos`.`fecha` AS `fecha`, `documentos`.`emisor_cedula` AS `emisor_cedula`, `documentos`.`emisor_nombre` AS `emisor_nombre`, `documentos`.`emisor_tipo` AS `emisor_tipo`, `documentos`.`emisor_comercial` AS `emisor_comercial`, `documentos`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos`.`emisor_id_canton` AS `emisor_id_canton`, `documentos`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos`.`emisor_cod` AS `emisor_cod`, `documentos`.`emisor_telefono` AS `emisor_telefono`, `documentos`.`emisor_correo` AS `emisor_correo`, `documentos`.`receptor_nombre` AS `receptor_nombre`, `documentos`.`receptor_cedula` AS `receptor_cedula`, `documentos`.`receptor_tipo` AS `receptor_tipo`, `documentos`.`receptor_comercial` AS `receptor_comercial`, `documentos`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos`.`receptor_id_canton` AS `receptor_id_canton`, `documentos`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos`.`receptor_cod` AS `receptor_cod`, `documentos`.`receptor_telefono` AS `receptor_telefono`, `documentos`.`receptor_correo` AS `receptor_correo`, `documentos`.`condicion_venta` AS `condicion_venta`, `documentos`.`plazo_credito` AS `plazo_credito`, `documentos`.`medio_pago` AS `medio_pago`, `documentos`.`moneda` AS `moneda`, `documentos`.`tipo_cambio` AS `tipo_cambio`, `documentos`.`servicios_gravados` AS `servicios_gravados`, `documentos`.`servicios_exentos` AS `servicios_exentos`, `documentos`.`servicios_exonerados` AS `servicios_exonerados`, `documentos`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos`.`mercancias_exentas` AS `mercancias_exentas`, `documentos`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos`.`total_gravado` AS `total_gravado`, `documentos`.`total_exento` AS `total_exento`, `documentos`.`total_exonerado` AS `total_exonerado`, `documentos`.`total_venta` AS `total_venta`, `documentos`.`total_descuentos` AS `total_descuentos`, `documentos`.`total_venta_neta` AS `total_venta_neta`, `documentos`.`total_impuestos` AS `total_impuestos`, `documentos`.`total_comprobante` AS `total_comprobante`, `documentos`.`notas` AS `notas`, `documentos`.`id_usuario` AS `id_usuario`, `documentos`.`id_empresa` AS `id_empresa`, `documentos`.`envio_atv` AS `envio_atv`, `documentos`.`valido_atv` AS `valido_atv`, `documentos`.`fecha_envio` AS `fecha_envio`, `documentos`.`fecha_valido` AS `fecha_valido` FROM `documentos` WHERE date_format(`documentos`.`fecha`,'%Y-%m') = date_format(current_timestamp() - interval 1 month,'%Y-%m') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_semana`
--
DROP TABLE IF EXISTS `documentos_semana`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_semana`  AS SELECT `documentos`.`id_documento` AS `id_documento`, `documentos`.`consecutivo` AS `consecutivo`, `documentos`.`tipo_documento` AS `tipo_documento`, `documentos`.`clave` AS `clave`, `documentos`.`codigo_seguridad` AS `codigo_seguridad`, `documentos`.`fecha` AS `fecha`, `documentos`.`emisor_cedula` AS `emisor_cedula`, `documentos`.`emisor_nombre` AS `emisor_nombre`, `documentos`.`emisor_tipo` AS `emisor_tipo`, `documentos`.`emisor_comercial` AS `emisor_comercial`, `documentos`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos`.`emisor_id_canton` AS `emisor_id_canton`, `documentos`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos`.`emisor_cod` AS `emisor_cod`, `documentos`.`emisor_telefono` AS `emisor_telefono`, `documentos`.`emisor_correo` AS `emisor_correo`, `documentos`.`receptor_nombre` AS `receptor_nombre`, `documentos`.`receptor_cedula` AS `receptor_cedula`, `documentos`.`receptor_tipo` AS `receptor_tipo`, `documentos`.`receptor_comercial` AS `receptor_comercial`, `documentos`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos`.`receptor_id_canton` AS `receptor_id_canton`, `documentos`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos`.`receptor_cod` AS `receptor_cod`, `documentos`.`receptor_telefono` AS `receptor_telefono`, `documentos`.`receptor_correo` AS `receptor_correo`, `documentos`.`condicion_venta` AS `condicion_venta`, `documentos`.`plazo_credito` AS `plazo_credito`, `documentos`.`medio_pago` AS `medio_pago`, `documentos`.`moneda` AS `moneda`, `documentos`.`tipo_cambio` AS `tipo_cambio`, `documentos`.`servicios_gravados` AS `servicios_gravados`, `documentos`.`servicios_exentos` AS `servicios_exentos`, `documentos`.`servicios_exonerados` AS `servicios_exonerados`, `documentos`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos`.`mercancias_exentas` AS `mercancias_exentas`, `documentos`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos`.`total_gravado` AS `total_gravado`, `documentos`.`total_exento` AS `total_exento`, `documentos`.`total_exonerado` AS `total_exonerado`, `documentos`.`total_venta` AS `total_venta`, `documentos`.`total_descuentos` AS `total_descuentos`, `documentos`.`total_venta_neta` AS `total_venta_neta`, `documentos`.`total_impuestos` AS `total_impuestos`, `documentos`.`total_comprobante` AS `total_comprobante`, `documentos`.`notas` AS `notas`, `documentos`.`id_usuario` AS `id_usuario`, `documentos`.`id_empresa` AS `id_empresa`, `documentos`.`envio_atv` AS `envio_atv`, `documentos`.`valido_atv` AS `valido_atv`, `documentos`.`fecha_envio` AS `fecha_envio`, `documentos`.`fecha_valido` AS `fecha_valido` FROM `documentos` WHERE yearweek(`documentos`.`fecha`,1) = yearweek(current_timestamp() - interval 0 week,1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_semanal`
--
DROP TABLE IF EXISTS `documentos_semanal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_semanal`  AS SELECT `documentos_view`.`id_documento` AS `id_documento`, `documentos_view`.`consecutivo` AS `consecutivo`, `documentos_view`.`tipo_documento` AS `tipo_documento`, `documentos_view`.`clave` AS `clave`, `documentos_view`.`codigo_seguridad` AS `codigo_seguridad`, `documentos_view`.`fecha` AS `fecha`, `documentos_view`.`emisor_cedula` AS `emisor_cedula`, `documentos_view`.`emisor_nombre` AS `emisor_nombre`, `documentos_view`.`emisor_tipo` AS `emisor_tipo`, `documentos_view`.`emisor_comercial` AS `emisor_comercial`, `documentos_view`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos_view`.`emisor_id_canton` AS `emisor_id_canton`, `documentos_view`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos_view`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos_view`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos_view`.`emisor_cod` AS `emisor_cod`, `documentos_view`.`emisor_telefono` AS `emisor_telefono`, `documentos_view`.`emisor_correo` AS `emisor_correo`, `documentos_view`.`receptor_nombre` AS `receptor_nombre`, `documentos_view`.`receptor_cedula` AS `receptor_cedula`, `documentos_view`.`receptor_tipo` AS `receptor_tipo`, `documentos_view`.`receptor_comercial` AS `receptor_comercial`, `documentos_view`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos_view`.`receptor_id_canton` AS `receptor_id_canton`, `documentos_view`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos_view`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos_view`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos_view`.`receptor_cod` AS `receptor_cod`, `documentos_view`.`receptor_telefono` AS `receptor_telefono`, `documentos_view`.`receptor_correo` AS `receptor_correo`, `documentos_view`.`condicion_venta` AS `condicion_venta`, `documentos_view`.`plazo_credito` AS `plazo_credito`, `documentos_view`.`medio_pago` AS `medio_pago`, `documentos_view`.`moneda` AS `moneda`, `documentos_view`.`tipo_cambio` AS `tipo_cambio`, `documentos_view`.`servicios_gravados` AS `servicios_gravados`, `documentos_view`.`servicios_exentos` AS `servicios_exentos`, `documentos_view`.`servicios_exonerados` AS `servicios_exonerados`, `documentos_view`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos_view`.`mercancias_exentas` AS `mercancias_exentas`, `documentos_view`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos_view`.`total_gravado` AS `total_gravado`, `documentos_view`.`total_exento` AS `total_exento`, `documentos_view`.`total_exonerado` AS `total_exonerado`, `documentos_view`.`total_venta` AS `total_venta`, `documentos_view`.`total_descuentos` AS `total_descuentos`, `documentos_view`.`total_venta_neta` AS `total_venta_neta`, `documentos_view`.`total_impuestos` AS `total_impuestos`, `documentos_view`.`total_comprobante` AS `total_comprobante`, `documentos_view`.`notas` AS `notas`, `documentos_view`.`id_usuario` AS `id_usuario`, `documentos_view`.`id_empresa` AS `id_empresa`, `documentos_view`.`envio_atv` AS `envio_atv`, `documentos_view`.`valido_atv` AS `valido_atv`, `documentos_view`.`fecha_envio` AS `fecha_envio`, `documentos_view`.`fecha_valido` AS `fecha_valido` FROM `documentos_view` WHERE `documentos_view`.`dias_emitido` <= 7 AND `documentos_view`.`dias_emitido` > 0 ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_semana_anterior`
--
DROP TABLE IF EXISTS `documentos_semana_anterior`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `documentos_semana_anterior`  AS SELECT `documentos`.`id_documento` AS `id_documento`, `documentos`.`consecutivo` AS `consecutivo`, `documentos`.`tipo_documento` AS `tipo_documento`, `documentos`.`clave` AS `clave`, `documentos`.`codigo_seguridad` AS `codigo_seguridad`, `documentos`.`fecha` AS `fecha`, `documentos`.`emisor_cedula` AS `emisor_cedula`, `documentos`.`emisor_nombre` AS `emisor_nombre`, `documentos`.`emisor_tipo` AS `emisor_tipo`, `documentos`.`emisor_comercial` AS `emisor_comercial`, `documentos`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos`.`emisor_id_canton` AS `emisor_id_canton`, `documentos`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos`.`emisor_cod` AS `emisor_cod`, `documentos`.`emisor_telefono` AS `emisor_telefono`, `documentos`.`emisor_correo` AS `emisor_correo`, `documentos`.`receptor_nombre` AS `receptor_nombre`, `documentos`.`receptor_cedula` AS `receptor_cedula`, `documentos`.`receptor_tipo` AS `receptor_tipo`, `documentos`.`receptor_comercial` AS `receptor_comercial`, `documentos`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos`.`receptor_id_canton` AS `receptor_id_canton`, `documentos`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos`.`receptor_cod` AS `receptor_cod`, `documentos`.`receptor_telefono` AS `receptor_telefono`, `documentos`.`receptor_correo` AS `receptor_correo`, `documentos`.`condicion_venta` AS `condicion_venta`, `documentos`.`plazo_credito` AS `plazo_credito`, `documentos`.`medio_pago` AS `medio_pago`, `documentos`.`moneda` AS `moneda`, `documentos`.`tipo_cambio` AS `tipo_cambio`, `documentos`.`servicios_gravados` AS `servicios_gravados`, `documentos`.`servicios_exentos` AS `servicios_exentos`, `documentos`.`servicios_exonerados` AS `servicios_exonerados`, `documentos`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos`.`mercancias_exentas` AS `mercancias_exentas`, `documentos`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos`.`total_gravado` AS `total_gravado`, `documentos`.`total_exento` AS `total_exento`, `documentos`.`total_exonerado` AS `total_exonerado`, `documentos`.`total_venta` AS `total_venta`, `documentos`.`total_descuentos` AS `total_descuentos`, `documentos`.`total_venta_neta` AS `total_venta_neta`, `documentos`.`total_impuestos` AS `total_impuestos`, `documentos`.`total_comprobante` AS `total_comprobante`, `documentos`.`notas` AS `notas`, `documentos`.`id_usuario` AS `id_usuario`, `documentos`.`id_empresa` AS `id_empresa`, `documentos`.`envio_atv` AS `envio_atv`, `documentos`.`valido_atv` AS `valido_atv`, `documentos`.`fecha_envio` AS `fecha_envio`, `documentos`.`fecha_valido` AS `fecha_valido` FROM `documentos` WHERE yearweek(`documentos`.`fecha`,1) = yearweek(current_timestamp() - interval 1 week,1) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `documentos_view`
--
DROP TABLE IF EXISTS `documentos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `documentos_view`  AS SELECT `documentos`.`id_documento` AS `id_documento`, `documentos`.`consecutivo` AS `consecutivo`, `documentos`.`tipo_documento` AS `tipo_documento`, `documentos`.`clave` AS `clave`, `documentos`.`codigo_seguridad` AS `codigo_seguridad`, `documentos`.`fecha` AS `fecha`, `documentos`.`emisor_cedula` AS `emisor_cedula`, `documentos`.`emisor_nombre` AS `emisor_nombre`, `documentos`.`emisor_tipo` AS `emisor_tipo`, `documentos`.`emisor_comercial` AS `emisor_comercial`, `documentos`.`emisor_id_provincia` AS `emisor_id_provincia`, `documentos`.`emisor_id_canton` AS `emisor_id_canton`, `documentos`.`emisor_id_distrito` AS `emisor_id_distrito`, `documentos`.`emisor_id_barrio` AS `emisor_id_barrio`, `documentos`.`emisor_otras_senas` AS `emisor_otras_senas`, `documentos`.`emisor_cod` AS `emisor_cod`, `documentos`.`emisor_telefono` AS `emisor_telefono`, `documentos`.`emisor_correo` AS `emisor_correo`, `documentos`.`receptor_nombre` AS `receptor_nombre`, `documentos`.`receptor_cedula` AS `receptor_cedula`, `documentos`.`receptor_tipo` AS `receptor_tipo`, `documentos`.`receptor_comercial` AS `receptor_comercial`, `documentos`.`receptor_id_provincia` AS `receptor_id_provincia`, `documentos`.`receptor_id_canton` AS `receptor_id_canton`, `documentos`.`receptor_id_distrito` AS `receptor_id_distrito`, `documentos`.`receptor_id_barrio` AS `receptor_id_barrio`, `documentos`.`receptor_otras_senas` AS `receptor_otras_senas`, `documentos`.`receptor_cod` AS `receptor_cod`, `documentos`.`receptor_telefono` AS `receptor_telefono`, `documentos`.`receptor_correo` AS `receptor_correo`, `documentos`.`condicion_venta` AS `condicion_venta`, `documentos`.`plazo_credito` AS `plazo_credito`, `documentos`.`medio_pago` AS `medio_pago`, `documentos`.`moneda` AS `moneda`, `documentos`.`tipo_cambio` AS `tipo_cambio`, `documentos`.`servicios_gravados` AS `servicios_gravados`, `documentos`.`servicios_exentos` AS `servicios_exentos`, `documentos`.`servicios_exonerados` AS `servicios_exonerados`, `documentos`.`mercancias_gravadas` AS `mercancias_gravadas`, `documentos`.`mercancias_exentas` AS `mercancias_exentas`, `documentos`.`mercancias_exoneradas` AS `mercancias_exoneradas`, `documentos`.`total_gravado` AS `total_gravado`, `documentos`.`total_exento` AS `total_exento`, `documentos`.`total_exonerado` AS `total_exonerado`, `documentos`.`total_venta` AS `total_venta`, `documentos`.`total_descuentos` AS `total_descuentos`, `documentos`.`total_venta_neta` AS `total_venta_neta`, `documentos`.`total_impuestos` AS `total_impuestos`, `documentos`.`total_comprobante` AS `total_comprobante`, `documentos`.`notas` AS `notas`, `documentos`.`id_usuario` AS `id_usuario`, `documentos`.`id_empresa` AS `id_empresa`, `documentos`.`envio_atv` AS `envio_atv`, `documentos`.`valido_atv` AS `valido_atv`, `documentos`.`fecha_envio` AS `fecha_envio`, `documentos`.`fecha_valido` AS `fecha_valido`, to_days(current_timestamp()) - to_days(`documentos`.`fecha`) AS `dias_emitido` FROM `documentos` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `empresas_view`
--
DROP TABLE IF EXISTS `empresas_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `empresas_view`  AS SELECT `e`.`id_empresa` AS `id_empresa`, `e`.`identificacion` AS `identificacion`, `e`.`id_tipo_identificacion` AS `id_tipo_identificacion`, `t`.`tipo_identificacion` AS `tipo_identificacion`, `e`.`razon` AS `razon`, `e`.`razon` AS `nombre`, `e`.`nombre_comercial` AS `nombre_comercial`, `e`.`cod_actividad` AS `cod_actividad`, `e`.`id_ubicacion` AS `id_ubicacion`, `u`.`cod_provincia` AS `cod_provincia`, `u`.`cod_canton` AS `cod_canton`, `u`.`cod_distrito` AS `cod_distrito`, `u`.`cod_barrio` AS `cod_barrio`, `u`.`provincia` AS `provincia`, `u`.`canton` AS `canton`, `u`.`distrito` AS `distrito`, `u`.`barrio` AS `barrio`, `e`.`otras_senas` AS `otras_senas`, `e`.`telefono` AS `telefono`, `e`.`cod_pais` AS `cod_pais`, `c`.`codigo_telefono` AS `codigo_telefono`, `c`.`nombre` AS `nombre_pais`, `e`.`correo` AS `correo`, `e`.`estado` AS `estado` FROM (((`laura_seguridad`.`empresas` `e` join `laura_seguridad`.`tipos_identificaciones` `t` on(`e`.`id_tipo_identificacion` = `t`.`id_tipo_identificacion`)) join `laura_seguridad`.`codigos_paises` `c` on(`e`.`cod_pais` = `c`.`cod_pais`)) join `laura_seguridad`.`ubicaciones` `u` on(`e`.`id_ubicacion` = `u`.`id_ubicacion`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `productos_view`
--
DROP TABLE IF EXISTS `productos_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY INVOKER VIEW `productos_view`  AS SELECT `productos`.`id_producto` AS `id_producto`, `productos`.`id_unidad` AS `id_unidad`, `productos`.`unidad_empaque` AS `unidad_empaque`, `productos`.`id_categoria` AS `id_categoria`, `categorias`.`nombre_categoria` AS `nombre_categoria`, `unidades_medida`.`simbolo` AS `simbolo_unidad`, `unidades_medida`.`descripcion` AS `nombre_unidad`, `productos`.`id_empresa` AS `id_empresa`, `productos`.`codigo_cabys` AS `codigo_cabys`, `productos`.`codigo_venta` AS `codigo_venta`, `productos`.`codigo_interno` AS `codigo_interno`, `productos`.`descripcion` AS `descripcion`, `productos`.`impuesto` AS `impuesto`, `productos`.`valor_unitario` AS `valor_unitario`, `productos`.`valor_impuesto` AS `valor_impuesto`, `productos`.`valor_total` AS `valor_total`, `productos`.`descuento` AS `descuento`, `productos`.`porcentaje_descuento` AS `porcentaje_descuento`, `productos`.`fecha_creacion` AS `fecha_creacion`, `productos`.`fecha_modificacion` AS `fecha_modificacion`, `productos`.`fecha_eliminacion` AS `fecha_eliminacion`, `productos`.`estado` AS `estado` FROM ((`productos` join `unidades_medida` on(`productos`.`id_unidad` = `unidades_medida`.`id_unidad`)) join `categorias` on(`productos`.`id_categoria` = `categorias`.`id_categoria`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `fk_clientes_ubicaciones` (`id_ubicacion`),
  ADD KEY `fk_clientes_cod_pais` (`cod_pais`),
  ADD KEY `fk_clientes_tipo_identificaciones` (`id_tipo_identificacion`),
  ADD KEY `fk_empresas` (`id_empresa`);

--
-- Indices de la tabla `consecutivos`
--
ALTER TABLE `consecutivos`
  ADD PRIMARY KEY (`id_consecutivo`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id_documento`),
  ADD UNIQUE KEY `clave` (`clave`);

--
-- Indices de la tabla `documentos_detalles`
--
ALTER TABLE `documentos_detalles`
  ADD PRIMARY KEY (`id_detalle`),
  ADD KEY `id_documento` (`id_documento`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `fk_empresa` (`id_empresa`),
  ADD KEY `fk_unidad` (`id_unidad`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- Indices de la tabla `tipos_documentos`
--
ALTER TABLE `tipos_documentos`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `unidades_medida`
--
ALTER TABLE `unidades_medida`
  ADD PRIMARY KEY (`id_unidad`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `consecutivos`
--
ALTER TABLE `consecutivos`
  MODIFY `id_consecutivo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id_documento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de la tabla `documentos_detalles`
--
ALTER TABLE `documentos_detalles`
  MODIFY `id_detalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fk_clientes_cod_pais` FOREIGN KEY (`cod_pais`) REFERENCES `laura_seguridad`.`codigos_paises` (`cod_pais`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_clientes_ubicaciones` FOREIGN KEY (`id_ubicacion`) REFERENCES `laura_seguridad`.`ubicaciones` (`id_ubicacion`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_empresas` FOREIGN KEY (`id_empresa`) REFERENCES `laura_seguridad`.`empresas` (`id_empresa`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipo_identificacion` FOREIGN KEY (`id_tipo_identificacion`) REFERENCES `laura_seguridad`.`tipos_identificaciones` (`id_tipo_identificacion`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos_detalles`
--
ALTER TABLE `documentos_detalles`
  ADD CONSTRAINT `documentos_detalles_ibfk_1` FOREIGN KEY (`id_documento`) REFERENCES `documentos` (`id_documento`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `fk_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`),
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `laura_seguridad`.`empresas` (`id_empresa`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
