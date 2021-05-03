-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-04-2021 a las 18:29:29
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `abm`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_pizza`
--

CREATE TABLE `venta_pizza` (
  `id_venta` int(5) NOT NULL,
  `usuario` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `cantidad` int(5) NOT NULL,
  `sabor` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `nroPedido` int(5) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `venta_pizza`
--

INSERT INTO `venta_pizza` (`id_venta`, `usuario`, `tipo`, `cantidad`, `sabor`, `nroPedido`, `fecha`) VALUES
(1, 'leandrodnog@gmail.com', 'molde', 2, 'muzzarella', 406, '2042-02-13'),
(2, 'leandrodnog@gmail.com', 'molde', 2, 'muzzarella', 298, '2042-02-13'),
(3, 'leandrodnog@gmail.com', 'molde', 1, 'roquefort', 162, '2042-02-13'),
(4, 'hola@hola.com', 'molde', 1, 'roquefort', 779, '2042-02-13'),
(5, 'leandrodnog@gmail.com', 'molde', 1, 'roquefort', 776, '2042-02-13'),
(6, 'leandrodnog@gmail.com', 'molde', 1, 'muzzarella', 229, '2042-02-13'),
(7, 'leandrodnog@gmail.com', 'molde', 1, 'muzzarella', 997, '2021-04-28');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `venta_pizza`
--
ALTER TABLE `venta_pizza`
  ADD PRIMARY KEY (`id_venta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `venta_pizza`
--
ALTER TABLE `venta_pizza`
  MODIFY `id_venta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
