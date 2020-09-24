-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-09-2020 a las 00:57:01
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
-- Estructura de tabla para la tabla `comision`
--

CREATE TABLE `comision` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha_de_reunion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comision`
--

INSERT INTO `comision` (`id`, `nombre`, `fecha_de_reunion`) VALUES
(1, 'Hacienda', 'Lunes 11:00 hs'),
(2, 'Turismo', '1° y 3° Martes 11:00 hs');
(3, 'Legislación', '1º y 3º Miércoles 11:00 hs');
(4, 'Familia', '2º y 4º Martes 11:00 hs');
(5, 'Obras Públicas y Seguridad', '2º y 4º Miércoles 11:00 hs');
(6, 'Acción Social y Medio Ambiente', '2º y 4º Jueves 11:00 hs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `descripcion` varchar(350) DEFAULT 'No hay descripcion.',
  `foto` varchar(60) DEFAULT 'none.png',
  `presidente` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `periodo`, `descripcion`, `foto`, `presidente`) VALUES
(1, 'Martín Garate', '2019-2023', 'soy M.G.', 'garate.png', 1),
(2, 'Tatiana Lescano', '2019 - 2023', 'Tati', 'tati.png', 0),
(3, 'Graciela Callegari', '2019-2023', 'Tía Grace', 'grace.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_comision`
--

CREATE TABLE `persona_comision` (
  `id_concejal` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL,
  `cargo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comision`
--
ALTER TABLE `comision`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `persona_comision`
--
ALTER TABLE `persona_comision`
  ADD KEY `id_concejal` (`id_concejal`),
  ADD KEY `id_comision` (`id_comision`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comision`
--
ALTER TABLE `comision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona_comision`
--
ALTER TABLE `persona_comision`
  ADD CONSTRAINT `persona_comision_ibfk_1` FOREIGN KEY (`id_concejal`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `persona_comision_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comision` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
