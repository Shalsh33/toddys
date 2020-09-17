-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-09-2020 a las 15:12:11
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bloque_de_todos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comisiones`
--

CREATE TABLE `comisiones` (
  `id_comision` int(11) NOT NULL,
  `nombre_comision` varchar(30) NOT NULL,
  `fecha_de_reunion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comisiones`
--

INSERT INTO `comisiones` (`id_comision`, `nombre_comision`, `fecha_de_reunion`) VALUES
(1, 'Hacienda', 'Lunes 11:00 hs'),
(2, 'Turismo', '1° y 3° Martes 11:00 hs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `concejales`
--

CREATE TABLE `concejales` (
  `id_concejal` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `desc` varchar(350) NOT NULL,
  `foto` varchar(60) DEFAULT 'none.png',
  `presidente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `concejales`
--

INSERT INTO `concejales` (`id_concejal`, `nombre`, `periodo`, `desc`, `foto`, `presidente`) VALUES
(1, 'Persona 1', '2017 - 2021', '', 'asdd.png', 0),
(2, 'Persona 2', '2019 - 2023', 'asd', 'asd.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relaciones`
--

CREATE TABLE `relaciones` (
  `id_concejal` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `cargo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  ADD PRIMARY KEY (`id_comision`);

--
-- Indices de la tabla `concejales`
--
ALTER TABLE `concejales`
  ADD PRIMARY KEY (`id_concejal`);

--
-- Indices de la tabla `relaciones`
--
ALTER TABLE `relaciones`
  ADD KEY `id_concejal` (`id_concejal`),
  ADD KEY `id_comision` (`id_comision`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comisiones`
--
ALTER TABLE `comisiones`
  MODIFY `id_comision` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `concejales`
--
ALTER TABLE `concejales`
  MODIFY `id_concejal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `relaciones`
--
ALTER TABLE `relaciones`
  ADD CONSTRAINT `relaciones_ibfk_1` FOREIGN KEY (`id_concejal`) REFERENCES `concejales` (`id_concejal`),
  ADD CONSTRAINT `relaciones_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comisiones` (`id_comision`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
