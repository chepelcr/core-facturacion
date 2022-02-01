-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-01-2022 a las 00:36:31
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
-- Base de datos: `laura_costos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_lotes`
--

CREATE TABLE `detalle_lotes` (
  `id_detalle_lote` int(20) NOT NULL,
  `id_lote` int(20) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `valor_unitario` int(10) NOT NULL,
  `valor_lineal` int(10) NOT NULL,
  `cantidad` double(100,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_productos`
--

CREATE TABLE `detalle_productos` (
  `id_detalle` int(20) NOT NULL,
  `id_producto` int(20) NOT NULL,
  `id_materia_prima` int(20) NOT NULL,
  `cantidad_requerida` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes`
--

CREATE TABLE `lotes` (
  `id_lote` int(20) NOT NULL,
  `tipo_lote` varchar(1) NOT NULL,
  `fecha_creacion` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_modificacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `valor_total` double(40,2) NOT NULL,
  `estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_compra_view`
--

CREATE TABLE `lotes_compra_view` (
  `id_lote` int(20) DEFAULT NULL,
  `tipo_lote` varchar(1) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `valor_total` double(40,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotes_produccion_view`
--

CREATE TABLE `lotes_produccion_view` (
  `id_lote` int(20) DEFAULT NULL,
  `tipo_lote` varchar(1) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `valor_total` double(40,2) DEFAULT NULL,
  `estado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
