-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-10-2023 a las 03:27:24
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `socios`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `socios`
--

CREATE TABLE `socios` (
  `id_socio` int(9) NOT NULL,
  `nombre_socio` varchar(25) NOT NULL,
  `contraseña_socio` varchar(78) NOT NULL,
  `email_socio` varchar(50) NOT NULL,
  `tipo_subscripcion` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `socios`
--

INSERT INTO `socios` (`id_socio`, `nombre_socio`, `contraseña_socio`, `email_socio`, `tipo_subscripcion`) VALUES
(8, 'Enzo garcia', '$2y$10$xr3AfiMEmLcy3I1sxRKAcu7lOdMgMPeAFFBipgQ.8wCg8mmAIembm', 'enzogarcia96@gmail.com', '5');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscripciones`
--

CREATE TABLE `subscripciones` (
  `tipo_subscripcion_id` varchar(12) NOT NULL,
  `nombre_subscripcion` varchar(12) NOT NULL,
  `caracteristicas` varchar(100) NOT NULL,
  `precio` int(11) NOT NULL,
  `duracion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `subscripciones`
--

INSERT INTO `subscripciones` (`tipo_subscripcion_id`, `nombre_subscripcion`, `caracteristicas`, `precio`, `duracion`) VALUES
('1', 'FAN', '12 ENTRADAS A PARTIDOS LOCALES - POPULAR\r\n', 750, 1),
('2', 'SUPER FAN', '18 ENTRADAS A PARTIDOS LOCALES - POPULAR', 1800, 2),
('3', 'MEGA FAN', '26 ENTRADAS A PARTIDOS LOCALES - PLATEA', 2500, 2),
('4', 'BOSTERO', 'ENTRADA A TODOS LOS PARTIDOS LOCALES - PLATEA', 7500, 5),
('5', 'MEGA BOSTERO', 'ENTRADA A TODOS LOS PARTIDOS LOCALES - PALCO VIP', 25000, 20);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `socios`
--
ALTER TABLE `socios`
  ADD PRIMARY KEY (`id_socio`),
  ADD KEY `tipo_subscripcion` (`tipo_subscripcion`);

--
-- Indices de la tabla `subscripciones`
--
ALTER TABLE `subscripciones`
  ADD PRIMARY KEY (`tipo_subscripcion_id`),
  ADD KEY `tipo_subscripcion_id` (`tipo_subscripcion_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `socios`
--
ALTER TABLE `socios`
  MODIFY `id_socio` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `socios`
--
ALTER TABLE `socios`
  ADD CONSTRAINT `socios_ibfk_1` FOREIGN KEY (`tipo_subscripcion`) REFERENCES `subscripciones` (`tipo_subscripcion_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
