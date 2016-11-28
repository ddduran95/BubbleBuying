-- phpMyAdmin SQL Dump
-- version 4.2.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 25, 2016 at 09:08 AM
-- Server version: 5.5.39
-- PHP Version: 5.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bubblebd`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `fecha` datetime NOT NULL,
  `mensaje` varchar(144) COLLATE utf8_spanish_ci NOT NULL,
  `id_producto` int(11) NOT NULL,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `comprador` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`fecha`, `mensaje`, `id_producto`, `vendedor`, `comprador`) VALUES
('2016-11-25 09:26:26', 'Hola me gusta tu taza jja saludos', 1, 'barajas', 'laserrraptor'),
('2016-11-25 08:43:42', 'Hola, quiero tu taza', 1, 'barajas', 'ddduran');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `precio` double NOT NULL,
  `foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
	`id_producto` int(11) NOT NULL,
  `vendedor` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`titulo`, `descripcion`, `precio`, `foto`, `id_producto`, `vendedor`) VALUES
('Taza Star Wars', 'Es una taza muy bonita casi sin usar', 15, 'img/taza.jpg', 1, 'barajas'),
('Alfombra', 'Alfombra bonita', 20, 'img/alfombrabonita.jpg', 2, 'ddduran'),
('Ordenador', 'Ordenador bueno', 200, 'img/ordenadorbueno.jpg', 3, 'laserrraptor');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `alias` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(128) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`nombre`, `alias`, `password`) VALUES
('Samuel Ramilo Conde', 'laserrraptor', 'root'),
('Ismael Vizcaya Somoza', 'barajas', 'root'),
('Daniel de Alonso Durán', 'ddduran', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
 ADD PRIMARY KEY (`fecha`,`id_producto`,`vendedor`,`comprador`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`alias`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
