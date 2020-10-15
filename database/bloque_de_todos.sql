-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 15-10-2020 a las 22:30:52
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
(2, 'Turismo', '1° y 3° Martes 11:00 hs'),
(3, 'Legislacion', '1º y 3º Miercoles 11:00 hs'),
(4, 'Familia', '2º y 4º Martes 11:00 hs'),
(5, 'Obras Publicas y Seguridad', '2º y 4º Miercoles 11:00 hs'),
(6, 'Accion Social y Medio Ambiente', '2º y 4º Jueves 11:00 hs');

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
(1, 'Martín Garate', '2019 - 2023', 'asd', 'none.png', 1),
(2, 'Tatiana Lescano', '2017 - 2021', '', 'tati.png', 0),
(3, 'Graciela Callegari', '2019 - 2023', '', 'grace.png', 0),
(4, 'Andrea Montenegro', '2017 - 2021', '', 'andre.png', 0),
(5, 'Sebastían Suhit', '2017 - 2021', '', 'Seba.png', 0),
(6, 'Juan Gutierrez', '2019 - 2023', '', 'none.png', 0),
(7, 'Sergio Pescader', '2019 - 2023', 'No hay descripcion.', 'none.png', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona_comision`
--

CREATE TABLE `persona_comision` (
  `id_persona` int(11) NOT NULL,
  `id_comision` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona_comision`
--

INSERT INTO `persona_comision` (`id_persona`, `id_comision`) VALUES
(1, 3),
(1, 2),
(1, 4),
(1, 5),
(1, 1),
(2, 1),
(3, 1),
(3, 2),
(4, 2),
(5, 2),
(4, 5),
(4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `role`) VALUES
(1, 'admin', '$2y$10$YS6DOGLwCbJSBkQ5KYvRpeXrpje4hTB7hM9hW6iIdwoHfGdytQCx.', 'admin@admin.com', 'super admin'),
(2, 'francoS', '$2y$10$.k3eg84SH6sWIujY1u1E.uf9rkPkzbyrNXxQJTINwKiH9z3NgtqmK', 'francoS@todos.com.ar', 'admin'),
(3, 'marianoM', '$2y$10$mfsDYqqTU6dQ5M7UepdkKOTAyGTeLKxwbUNSWXSh/tQLu8D94p5v2', 'marianoM@todos.com.ar', 'admin'),
(4, 'julioR', '$2y$10$SQVs6S868erTpYWqCNuPtecKZcqv/vPzwf1KYXSXA.01w6QbVtMcq', 'julioR@todos.com.ar', 'user');

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
  ADD KEY `id_concejal` (`id_persona`),
  ADD KEY `id_comision` (`id_comision`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comision`
--
ALTER TABLE `comision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `persona_comision`
--
ALTER TABLE `persona_comision`
  ADD CONSTRAINT `persona_comision_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `persona_comision_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comision` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
