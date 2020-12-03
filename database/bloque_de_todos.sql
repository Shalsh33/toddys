-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2020 a las 20:17:04
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
(2, 'Turismo', '1° y 3° Martes 11:00 hs'),
(3, 'Legislacion', '1º y 3º Miercoles 11:00 hs'),
(4, 'Familia', '2º y 4º Martes 11:00 hs'),
(5, 'Obras Publicas y Seguridad', '2º y 4º Miercoles 11:00 hs'),
(6, 'Accion Social y Medio Ambiente', '2º y 4º Jueves 11:00 hs');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` datetime NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `edited` tinyint(1) DEFAULT 0,
  `date_edit` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `content`, `date`, `id_user`, `id_persona`, `edited`, `date_edit`) VALUES
(5, 'akjsdhjkashdjaks', '2020-11-30 18:39:52', 1, 1, 0, NULL),
(7, '12344412', '2020-12-02 23:30:47', 1, 1, 0, NULL),
(9, 'asdasa112ewq', '2020-12-02 23:33:39', 1, 1, 0, NULL),
(15, '123asdqweq', '2020-12-02 23:36:04', 1, 1, 0, NULL),
(16, '123asdqweq', '2020-12-02 23:36:04', 1, 1, 0, NULL),
(17, '123asdqweqwqesad', '2020-12-02 23:36:07', 1, 1, 0, NULL),
(18, 'asdasdas', '2020-12-03 12:22:59', 1, 1, 0, NULL),
(21, 'asdasdas', '2020-12-03 12:23:00', 1, 1, 0, NULL),
(22, 'asdasdas', '2020-12-03 12:23:01', 1, 1, 0, NULL),
(23, 'asdasdas', '2020-12-03 12:23:01', 1, 1, 0, NULL),
(24, 'a123', '2020-12-03 12:23:11', 1, 1, 0, NULL),
(25, 'a12asdasdaaw212312', '2020-12-03 12:23:13', 1, 1, 1, '2020-12-03 15:47:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `id_persona` int(11) NOT NULL,
  `principal` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `nombre`, `id_persona`, `principal`) VALUES
(25, 'includes/img/uploaded/5fc7dc4fe40ad0.87345514.jpeg', 2, 0),
(26, 'includes/img/uploaded/5fc7dc4ff1f8d0.40181710.jpeg', 2, 0),
(27, 'includes/img/uploaded/5fc7dd0ebd1cf9.75924877.png', 2, 1),
(28, 'includes/img/uploaded/5fc7dd296d4387.22201783.png', 3, 1),
(29, 'includes/img/uploaded/5fc7dd322546a7.34566121.png', 4, 1),
(30, 'includes/img/uploaded/5fc7dd3c9f4d10.38061211.png', 5, 1),
(32, 'includes/img/uploaded/5fc7de03e30e13.34759978.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `periodo` varchar(50) NOT NULL,
  `descripcion` varchar(350) DEFAULT 'No hay descripcion.',
  `presidente` tinyint(1) NOT NULL,
  `normalizedName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `nombre`, `periodo`, `descripcion`, `presidente`, `normalizedName`) VALUES
(1, 'Martín Garate', '2019 - 2023', 'asd', 1, 'Martin+Garate'),
(2, 'Tatiana Lescano', '2017 - 2021', 'taati', 0, 'Tatiana+Lescano'),
(3, 'Graciela Callegari', '2019 - 2023', '', 0, 'Graciela+Callegari'),
(4, 'Andrea Montenegro', '2017 - 2021', '', 0, 'Andrea+Montenegro'),
(5, 'Sebastían Suhit', '2017 - 2021', '', 0, 'Sebastian+Suhit'),
(6, 'Juan Gutierrez', '2019 - 2023', 'Juan E.', 0, 'Juan+Gutierrez'),
(7, 'Sergio Pescader', '2019 - 2023', 'No hay descripcion.', 0, 'Sergio+Pescader');

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
(3, 2),
(4, 2),
(4, 5),
(3, 3),
(4, 4),
(5, 4),
(2, 4),
(2, 5),
(6, 5),
(6, 6),
(6, 4),
(7, 5),
(7, 4),
(7, 6),
(2, 2),
(5, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `star`
--

CREATE TABLE `star` (
  `id` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_persona` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `star`
--

INSERT INTO `star` (`id`, `valor`, `id_user`, `id_persona`) VALUES
(1, 5, 1, 1);

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
(1, 'admin@TOD☼S', '$2y$10$YS6DOGLwCbJSBkQ5KYvRpeXrpje4hTB7hM9hW6iIdwoHfGdytQCx.', 'admin@admin', 'super admin'),
(2, 'francoS', '$2y$10$.k3eg84SH6sWIujY1u1E.uf9rkPkzbyrNXxQJTINwKiH9z3NgtqmK', 'francoS@todos.com.ar', 'admin'),
(3, 'marianoM', '$2y$10$mfsDYqqTU6dQ5M7UepdkKOTAyGTeLKxwbUNSWXSh/tQLu8D94p5v2', 'marianoM@todos.com.ar', 'super admin'),
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
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`),
  ADD KEY `id_user` (`id_user`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_persona` (`id_persona`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `persona_comision`
--
ALTER TABLE `persona_comision`
  ADD KEY `id_concejal` (`id_persona`),
  ADD KEY `id_comision` (`id_comision`);

--
-- Indices de la tabla `star`
--
ALTER TABLE `star`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_persona` (`id_persona`);

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
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `star`
--
ALTER TABLE `star`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona_comision`
--
ALTER TABLE `persona_comision`
  ADD CONSTRAINT `persona_comision_ibfk_1` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`),
  ADD CONSTRAINT `persona_comision_ibfk_2` FOREIGN KEY (`id_comision`) REFERENCES `comision` (`id`);

--
-- Filtros para la tabla `star`
--
ALTER TABLE `star`
  ADD CONSTRAINT `star_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `star_ibfk_2` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
