-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-12-2016 a las 11:22:19
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bubblebd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

CREATE TABLE `chat` (
  `chat` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `comprador` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `chat`
--

INSERT INTO `chat` (`chat`, `producto`, `vendedor`, `comprador`) VALUES
(1, 1, 'barajas', 'ddduran'),
(2, 2, 'barajas', 'laserraptor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensajes`
--

CREATE TABLE `mensajes` (
  `chat` int(11) NOT NULL,
  `autor` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  `tiempo` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `mensaje` varchar(150) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `mensajes`
--

INSERT INTO `mensajes` (`chat`, `autor`, `tiempo`, `mensaje`) VALUES
(1, 'barajas', '2016-12-01 20:41:15', 'Mensaje 1 '),
(1, 'ddduran', '2016-12-01 20:42:04', 'Mensaje 3'),
(2, 'barajas', '2016-12-01 20:42:18', 'Mensaje 2'),
(2, 'laserraptor', '2016-12-01 20:42:18', 'Mensaje 4');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `categoria` ENUM('Tecnologia', 'Libros', 'Cosas de casa', 'Videojuegos', 'Niños', 'Electrodomesticos', 'Ropa', 'Motor', 'Deportes') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`titulo`, `descripcion`, `precio`, `foto`, `id_producto`, `vendedor`, `categoria`) VALUES
('Taza Star Wars', 'Es una taza muy bonita casi sin usar', 15, 'taza.jpg', 1, 'barajas', 'Cosas de casa'),
('Moto', 'Corre a toda velocidad', 20, 'moto.jpg', 2, 'ddduran', 'Motor'),
('Iphone', 'Buen movil si no fuera porque es un Iphone.', 600, 'iphone.jpg', 3, 'laserraptor', 'Tecnologia'),
('Figura Sora', 'Figura de Sora, personaje principal de la saga kingdom hearts. Buen estado. Chulísima.', 600, 'figurasora.jpg', 4, 'laserraptor', 'Videojuegos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `alias` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_spanish_ci NOT NULL,
  `perfil` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`nombre`, `alias`, `password`, `perfil`) VALUES
('Samuel Ramilo Conde', 'laserraptor', 'root', 'luky.png'),
('Ismael Vizcaya Somoza', 'barajas', 'root', 'vader.png'),
('Daniel de Alonso Durán', 'ddduran', 'root', 'hansolo.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat`);

--
-- Indices de la tabla `mensajes`
--
ALTER TABLE `mensajes`
  ADD PRIMARY KEY (`chat`,`tiempo`,`mensaje`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`alias`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
