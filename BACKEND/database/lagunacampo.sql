-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2019 a las 21:06:55
-- Versión del servidor: 10.1.9-MariaDB
-- Versión de PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `lagunacampo`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caravanas`
--

CREATE TABLE `caravanas` (
  `id_caravana` int(11) NOT NULL,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `peso` varchar(25) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `procedencia` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caravanas`
--

INSERT INTO `caravanas` (`id_caravana`, `codigo`, `descripcion`, `peso`, `sexo`, `categoria`, `procedencia`) VALUES
(2, '55', 'caballo', '124', 'femenino', 'potrilloddsa', 'chubut'),
(4, '12', 'vaca grande', '2345', 'femenino', 'adulta', 'neuquen'),
(5, '56456', 'sdsffsd', '546', 'sdf', 'dsfg', 'ffff'),
(6, '4445', 'ffsd', '675', 'afasfadd', 'sdfsd', 'fsdf'),
(10, 'fsfs', 'asdasf', '2342', 'asf', 'asf', 'asf'),
(8, 'affffe', 'asdfas', '324', 'asdadsdq', 'fefe', 'fasdas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

CREATE TABLE `empleados` (
  `id_empleado` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `puesto` varchar(25) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `sueldo` double NOT NULL,
  `email` varchar(25) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cuil` int(25) NOT NULL,
  `cod_postal` int(15) NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `puesto`, `fecha_inicio`, `sueldo`, `email`, `dni`, `cuil`, `cod_postal`, `fecha_fin`) VALUES
(6, 'nuevo', 'edicion', 'peonero', '2019-02-08', 350.56, 'fefefe@hotmail.com', '34534', 345345, 1212, '2019-03-30'),
(18, 'asd', 'fwfw', 'adad', '2019-03-07', 123.4, 'fede@hotmail.com', '124', 1234, 123, '2019-01-02'),
(21, 'asdasd', 'asdasf', 'sdf', '2019-03-08', 435, 'fede@ad', '345345', 345, 43, '2019-03-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id_mov` int(11) NOT NULL,
  `id_caravana` int(11) NOT NULL,
  `fecha_mov` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_mov` varchar(15) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_mov`, `id_caravana`, `fecha_mov`, `cantidad`, `tipo_mov`) VALUES
(2, 125, '2019-02-21', 344, 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `id_caravana` int(11) NOT NULL,
  `total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `pass`) VALUES
(1, 'administrador', 'admin', 'admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `num_fact` varchar(25) NOT NULL,
  `cabezas` int(10) NOT NULL,
  `kg` float NOT NULL,
  `peso_x_kg` float NOT NULL,
  `bruto` float NOT NULL,
  `iva` float NOT NULL,
  `neto` float NOT NULL,
  `retencion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha`, `num_fact`, `cabezas`, `kg`, `peso_x_kg`, `bruto`, `iva`, `neto`, `retencion`) VALUES
(3, '2001-11-11', 'fc 1243', 1244, 12412.6, 32555600, 12, 34534, 12, 12),
(4, '2019-02-21', 'fc 15654', 38443534, 15354.7, 1557.78, 1, 1, 1, 1),
(5, '2019-03-07', '0', 38, 15354.6, 1557.78, 45, 0, 0, 56),
(6, '2019-03-07', '0', 38, 15354.6, 1557.78, 0, 0, 0, 0),
(7, '2019-03-07', '0', 38, 15354.6, 1557.78, 0, 0, 0, 0),
(8, '2019-03-07', '0', 38, 15354.6, 1557.78, 0, 0, 0, 0),
(9, '2019-03-08', '0fdsf', 38, 15354.6, 1557.78, 0, 0, 0, 0),
(10, '2019-03-08', '0fdda', 45, 45, 44, 0, 0, 0, 0),
(11, '2019-03-08', 'fact 23', 15, 15, 15, 15, 15, 15, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caravanas`
--
ALTER TABLE `caravanas`
  ADD PRIMARY KEY (`id_caravana`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `empleados`
--
ALTER TABLE `empleados`
  ADD PRIMARY KEY (`id_empleado`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id_mov`);

--
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_ventas`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `caravanas`
--
ALTER TABLE `caravanas`
  MODIFY `id_caravana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id_mov` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
