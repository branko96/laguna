-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-02-2019 a las 00:22:47
-- Versión del servidor: 10.1.37-MariaDB
-- Versión de PHP: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `codigo` int(11) NOT NULL,
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
(2, 55, 'caballo', '124', 'femenino', 'potrillo', 'chubut'),
(3, 45, 'prueba', '123', 'masculino', 'novillo', 'bs as'),
(4, 12, 'vaca grande', '2345', 'femenino', 'adulta', 'neuquen');

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
  `dni` int(20) NOT NULL,
  `cuil` int(25) NOT NULL,
  `cod_postal` int(15) NOT NULL,
  `fecha_fin` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleados`
--

INSERT INTO `empleados` (`id_empleado`, `nombre`, `apellido`, `puesto`, `fecha_inicio`, `sueldo`, `email`, `dni`, `cuil`, `cod_postal`, `fecha_fin`) VALUES
(3, 'nuevo', 'edicion', 'peonero', '2019-01-15', 350.56, 'fefefe@hotmail.com', 124, 1234, 1212, '2019-01-03'),
(12, 'Juan', 'Moran', 'empleado', '2019-02-17', 45234, 'alfre.89@hotmail.com', 3538934, 203414312, 8000, '0000-00-00'),
(6, 'Branko', 'ottavianelli', 'dsfdfs', '2019-02-08', 324324, '', 21321231, 2313, 8000, '2019-02-06'),
(7, 'Branko', 'ottavianelli', '123', '2019-02-08', 1232, '', 12321, 1232, 8000, '2019-02-05'),
(9, 'Branko', 'ottavianelli', '3424', '2019-02-08', 423, '', 0, 0, 8000, '2019-02-05'),
(10, 'Branko', 'ottavianelli', '3', '2019-02-12', 34, '', 34, 54354, 8000, '2019-02-04'),
(11, 'asd', 'fwfw', 'adad', '2019-02-13', 123.4, 'fede@hotmail.com', 124, 1234, 123, '2019-01-02'),
(13, 'Juan', 'Moran', 'empleado', '2019-02-17', 45234, 'alfre.89@hotmail.com', 3538934, 203414312, 8000, '2019-02-19');

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
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_ventas` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `num_fact` int(25) NOT NULL,
  `cabezas` int(10) NOT NULL,
  `kg` float NOT NULL,
  `peso_x_kg` float NOT NULL,
  `bruto` float NOT NULL,
  `IVA` float NOT NULL,
  `neto` float NOT NULL,
  `retencion` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indices de la tabla `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`);

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
  MODIFY `id_caravana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_ventas` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
