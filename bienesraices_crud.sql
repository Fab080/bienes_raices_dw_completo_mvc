-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 01-11-2024 a las 17:17:37
-- Versión del servidor: 8.0.30
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienesraices_crud`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `propiedades`
--

CREATE TABLE `propiedades` (
  `id` int NOT NULL,
  `titulo` varchar(45) DEFAULT NULL,
  `precio` decimal(13,2) DEFAULT NULL,
  `imagen` varchar(200) DEFAULT NULL,
  `descripcion` longtext,
  `habitaciones` int DEFAULT NULL,
  `wc` int DEFAULT NULL,
  `estacionamiento` int DEFAULT NULL,
  `creado` date DEFAULT NULL,
  `vendedorId` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `propiedades`
--

INSERT INTO `propiedades` (`id`, `titulo`, `precio`, `imagen`, `descripcion`, `habitaciones`, `wc`, `estacionamiento`, `creado`, `vendedorId`) VALUES
(8, 'Casa en el Bosque', 250000000.00, 'd4d38e09dc3e2eac326ab9fa08ffda8b.jpg', 'Casa en el BosqueCasa en el BosqueCasa en el BosqueCasa en el BosqueCasa en el BosqueCasa en el Bosque', 4, 2, 1, '2024-09-13', 2),
(9, 'Finca Hermosa', 400000000.00, 'b359085e4b66e0f728920fc3eced91eb.jpg', 'Finca HermosaFinca HermosaFinca HermosaFinca HermosaFinca Hermosa', 3, 2, 2, '2024-09-17', 1),
(10, 'Casa en el Bosque 3', 123000000.00, '5dac48dd9abd5edeae0bb64a7d3096de.jpg', 'Casa en el BosqueCasa en el BosqueCasa en el BosqueCasa en el BosqueCasa en el Bosque', 2, 2, 1, '2024-09-17', 2),
(11, 'Casa en la playa', 185999900.00, 'a4630377bb7bb43da4b5344007227b25.jpg', 'Casa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playaCasa en la playa', 3, 3, 2, '2024-09-17', 1),
(14, 'Hermosa Casa en el Lago', 123985000.00, '955264175beb8c985949cd86f2b0bf92.jpg', 'Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.', 3, 2, 3, '2024-10-17', 1),
(15, ' Hermosa Casa en el Lago', 123985000.00, 'f1a1ce28ca0841092f8040ca2a58ff62.jpg', 'Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.Casa en el Lago. Espectacular Vista.', 3, 2, 3, '2024-10-17', 1),
(18, ' Casa en el Bosque 4', 540900000.00, '2356e8600fc8f2b5d72bbcf618c1f08c.jpg', 'Hermosa Casa en el Bosque, con un ambiente super agradable.Hermosa Casa en el Bosque, con un ambiente super agradable.Hermosa Casa en el Bosque, con un ambiente super agradable.', 5, 3, 2, '2024-10-18', 2),
(19, ' Casa en la playa', 128000000.00, 'b2df90941a56a9b3ae87097890d7fec1.jpg', 'Casa en la playa con una majestuosa vista al mar. Perfecto Lugar para pasar tiempo en familia y con amigos', 4, 3, 2, '2024-10-18', 1),
(20, ' Casa en el Bosque 5 ACTUALIZADO en oferta', 520000000.00, 'f20607998bd7667bb33297f79bd813dc.jpg', 'Casa en el Bosque 5Casa en el Bosque 5Casa en el Bosque 5Casa en el Bosque 5Casa en el Bosque 5Casa en el Bosque 5', 4, 2, 2, '2024-10-19', 1),
(26, ' Casa en el Bosque 7', 123540000.00, '00ea13b581af120e36c76382a8470064.jpg', 'Hermosa casa en el bosque con espectacular ambiente, perfecto para comaprtir tiempo en familia y amigos.', 4, 3, 3, '2024-10-23', 4),
(27, ' Casa en el campo ACTUALIZADO', 530000000.00, '3bd656ee8aebb305de33f5644c28e4e8.jpg', 'Hermosa casa en el campo con un ambiente espectacular. Ideal para alejarse del alto estrés de la ciudad y poder disfrutar de la naturaleza ACTUALIZADO', 4, 2, 3, '2024-10-23', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `password`) VALUES
(4, 'correo@correo.com', '$2y$10$eoFPFBwFjgRBAI6dq8bbmObDQf0pk5wTJ7sCs9UeVPztJL/3FYNvu');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedores`
--

CREATE TABLE `vendedores` (
  `id` int NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `apellido` varchar(45) DEFAULT NULL,
  `telefono` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `vendedores`
--

INSERT INTO `vendedores` (`id`, `nombre`, `apellido`, `telefono`) VALUES
(1, 'Fabian ', 'Gomez', '3105879642'),
(2, 'Karen', 'Garcia', '3215478652'),
(4, 'Fabian Yesid', 'Sanabria Gomez', '3106508954');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_propiedades_vendedores_idx` (`vendedorId`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `propiedades`
--
ALTER TABLE `propiedades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vendedores`
--
ALTER TABLE `vendedores`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `propiedades`
--
ALTER TABLE `propiedades`
  ADD CONSTRAINT `fk_propiedades_vendedores` FOREIGN KEY (`vendedorId`) REFERENCES `vendedores` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
