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
  `FECHA` datetime NOT NULL,
  `MENSAJE` varchar(144) COLLATE utf8_spanish_ci NOT NULL,
  `ID_PRODUCTO` int(11) NOT NULL,
  `VENDEDOR` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `COMPRADOR` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`FECHA`, `MENSAJE`, `ID_PRODUCTO`, `VENDEDOR`, `COMPRADOR`) VALUES
('2016-11-25 09:26:26', 'Hola me gusta tu taza jja saludos', 1, 'barajas', 'laserrraptor'),
('2016-11-25 08:43:42', 'Hola, quiero tu taza', 1, 'barajas', 'ddduran');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `TITULO` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `DESCRIPCION` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `PRECIO` double NOT NULL,
  `FOTO` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
`ID` int(11) NOT NULL,
  `VENDEDOR` varchar(45) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`TITULO`, `DESCRIPCION`, `PRECIO`, `FOTO`, `ID`, `VENDEDOR`) VALUES
('Taza Star Wars', 'Es una taza muy bonita casi sin usar', 15, 'img/taza.jpg', 1, 'barajas'),
('Alfombra', 'Alfombra bonita', 20, 'img/alfombrabonita.jpg', 2, 'ddduran'),
('Ordenador', 'Ordenador bueno', 200, 'img/ordenadorbueno.jpg', 3, 'laserrraptor');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `NOMBRE_COMPLETO` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `ALIAS` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `PASSWORD` varchar(128) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`NOMBRE_COMPLETO`, `ALIAS`, `PASSWORD`) VALUES
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
 ADD PRIMARY KEY (`FECHA`,`ID_PRODUCTO`,`VENDEDOR`,`COMPRADOR`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
 ADD PRIMARY KEY (`ALIAS`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
