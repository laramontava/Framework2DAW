-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2016 a las 15:15:51
-- Versión del servidor: 5.5.49-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` varchar(8) NOT NULL DEFAULT '',
  `name` varchar(20) DEFAULT NULL,
  `description` varchar(300) DEFAULT NULL,
  `condition1` varchar(20) DEFAULT NULL,
  `datepicker1` varchar(20) DEFAULT NULL,
  `datepicker2` varchar(20) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL,
  `stock` varchar(20) DEFAULT NULL,
  `category` varchar(20) DEFAULT NULL,
  `horror` varchar(2) DEFAULT NULL,
  `thriller` varchar(2) DEFAULT NULL,
  `adventure` varchar(2) DEFAULT NULL,
  `drama` varchar(2) DEFAULT NULL,
  `pais` varchar(20) DEFAULT NULL,
  `provincia` varchar(20) DEFAULT NULL,
  `poblacion` varchar(20) DEFAULT NULL,
  `avatar` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `condition1`, `datepicker1`, `datepicker2`, `price`, `stock`, `category`, `horror`, `thriller`, `adventure`, `drama`, `pais`, `provincia`, `poblacion`, `avatar`) VALUES
('12312312', 'Prueba', 'Asd asd', 'New', '03/10/2016', '19/10/2016', '123', '123', 'Array', '1', '1', '0', '0', 'AM', 'DEFAULT_PROVINCIA', 'DEFAULT_POBLACION', 'media/1020040457-flowers.png'),
('12341543', 'Silla', 'Asdasd', 'Used', '03/10/2016', '29/10/2016', '1', '123', 'Array', '1', '1', '0', '0', 'ES', '23', 'ARBUNIEL', 'media/1020040457-flowers.png'),
('32132132', 'Prueba', 'ASd', 'Used', '11/10/2016', '27/10/2016', '312', '321', 'Array', '0', '0', '1', '1', 'ES', '08', 'CALDES DE MONTBUI', 'media/1020040457-flowers.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;