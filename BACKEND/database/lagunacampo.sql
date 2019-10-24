-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2019 a las 23:09:48
-- Versión del servidor: 10.3.16-MariaDB
-- Versión de PHP: 7.3.7

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
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `peso` varchar(25) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `procedencia` varchar(20) NOT NULL,
  `hectarea` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caravanas`
--

INSERT INTO `caravanas` (`id_caravana`, `codigo`, `descripcion`, `peso`, `sexo`, `categoria`, `procedencia`, `hectarea`, `cantidad`) VALUES
(2, '55', 'caballo', '124', 'F', 'vaca', '2', 2, 10),
(10, 'fsfs', 'asdasf', '2342', 'M', 'asf', '2', 2, 10),
(12, '12ddasdas', 'vaca grande', '2345', 'M', 'adulta', '2', 4, 75),
(11, '12ddasdas', 'vaca grande', '2345', 'F', 'adulta', '2', 4, 89);

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimientos`
--

CREATE TABLE `establecimientos` (
  `id_establecimiento` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `latitud` double NOT NULL,
  `longitud` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `establecimientos`
--

INSERT INTO `establecimientos` (`id_establecimiento`, `nombre`, `latitud`, `longitud`) VALUES
(1, 'Laguna del Monte', 0, 0),
(2, 'Ceferino', 0, 0),
(3, 'Chacra', 0, 0),
(4, 'San Antonio', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_categorias`
--

CREATE TABLE `gastos_categorias` (
  `id_categoria` int(11) NOT NULL,
  `concepto` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_categorias`
--

INSERT INTO `gastos_categorias` (`id_categoria`, `concepto`) VALUES
(1, 'Sueldos y aguinaldo'),
(2, 'Cargas sociales'),
(3, 'compras de semilla'),
(4, 'Rollos'),
(5, 'Siembra'),
(6, 'combustible'),
(7, 'Veterinario'),
(8, 'Productos veterinario'),
(9, 'Mantenimiento Bienes de uso'),
(10, 'Comida Peones'),
(11, 'Fumigada'),
(12, 'Garrafas'),
(13, 'Limpieza acequias'),
(14, 'Riego'),
(15, 'Gastos varios');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_reales`
--

CREATE TABLE `gastos_reales` (
  `id_gasto` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `detalle` varchar(25) NOT NULL,
  `valor` float NOT NULL,
  `cantidad` int(11) DEFAULT NULL,
  `id_establecimiento` int(11) NOT NULL,
  `tipo_recibo` varchar(25) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_reales`
--

INSERT INTO `gastos_reales` (`id_gasto`, `fecha`, `id_categoria`, `detalle`, `valor`, `cantidad`, `id_establecimiento`, `tipo_recibo`, `total`) VALUES
(15, '2019-07-10', 2, 'asd', 234, 2, 1, 'd', 468),
(16, '2019-07-17', 8, 'dd', 234, 1, 2, 'dd', 234),
(17, '2019-09-03', 4, 'asd', 3, 4, 2, 'B', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hectareas`
--

CREATE TABLE `hectareas` (
  `id` int(11) NOT NULL,
  `id_establecimiento` int(11) NOT NULL,
  `numero` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hectareas`
--

INSERT INTO `hectareas` (`id`, `id_establecimiento`, `numero`) VALUES
(1, 1, '01'),
(2, 1, '02'),
(3, 1, '03'),
(4, 1, '04'),
(5, 1, '05'),
(6, 1, '06'),
(7, 1, '07'),
(8, 1, '08'),
(9, 1, '09'),
(10, 1, '1'),
(11, 1, '2'),
(12, 1, '3'),
(13, 1, '4'),
(14, 1, '5'),
(15, 1, '6'),
(16, 1, '7'),
(17, 1, '8'),
(18, 1, '9'),
(19, 1, '10'),
(20, 1, '11'),
(21, 1, '12'),
(22, 1, '00'),
(42, 2, '15'),
(43, 3, '44'),
(44, 4, '05');

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
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Estructura de tabla para la tabla `tareas`
--

CREATE TABLE `tareas` (
  `id_tareas` int(11) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `descrip` varchar(35) NOT NULL,
  `fecha` date NOT NULL,
  `id_establecimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tareas`
--

INSERT INTO `tareas` (`id_tareas`, `nombre`, `descrip`, `fecha`, `id_establecimiento`) VALUES
(2, 'nueva capac', 'nuevo curso de ruby', '2019-09-18', 2019),
(3, 'prueba', 'probando', '2019-10-01', 4),
(4, 'Carnear vacas', '100 cacas', '2019-10-04', 4),
(5, 'Sembrar', '100 metros', '2019-10-09', 1),
(6, 'sembrado', 'comprar 500.000 semillas', '2019-10-23', 1),
(7, 'cumpleaÃ±os', 'asdasd', '2019-11-21', 1),
(8, 'comprar', 'alfalfa', '2019-11-21', 1);

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
-- Indices de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  ADD PRIMARY KEY (`id_establecimiento`);

--
-- Indices de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `gastos_reales`
--
ALTER TABLE `gastos_reales`
  ADD PRIMARY KEY (`id_gasto`);

--
-- Indices de la tabla `hectareas`
--
ALTER TABLE `hectareas`
  ADD PRIMARY KEY (`id`);

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
-- Indices de la tabla `tareas`
--
ALTER TABLE `tareas`
  ADD PRIMARY KEY (`id_tareas`);

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
  MODIFY `id_caravana` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empleados`
--
ALTER TABLE `empleados`
  MODIFY `id_empleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `establecimientos`
--
ALTER TABLE `establecimientos`
  MODIFY `id_establecimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `gastos_categorias`
--
ALTER TABLE `gastos_categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `gastos_reales`
--
ALTER TABLE `gastos_reales`
  MODIFY `id_gasto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `hectareas`
--
ALTER TABLE `hectareas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
-- AUTO_INCREMENT de la tabla `tareas`
--
ALTER TABLE `tareas`
  MODIFY `id_tareas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
