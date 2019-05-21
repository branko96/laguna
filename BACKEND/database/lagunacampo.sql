-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 21-05-2019 a las 01:48:41
-- Versión del servidor: 5.7.26
-- Versión de PHP: 7.2.18

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

DROP TABLE IF EXISTS `caravanas`;
CREATE TABLE IF NOT EXISTS `caravanas` (
  `id_caravana` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(11) NOT NULL,
  `descripcion` varchar(25) NOT NULL,
  `peso` varchar(25) NOT NULL,
  `sexo` varchar(20) NOT NULL,
  `categoria` varchar(25) NOT NULL,
  `procedencia` varchar(20) NOT NULL,
  PRIMARY KEY (`id_caravana`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `caravanas`
--

INSERT INTO `caravanas` (`id_caravana`, `codigo`, `descripcion`, `peso`, `sexo`, `categoria`, `procedencia`) VALUES
(2, '55', 'caballo', '124', 'femenino', 'potrilloddsa', 'chubut'),
(4, '12', 'vaca grande', '2345', 'femenino', 'adulta', 'neuquen'),
(10, 'fsfs', 'asdasf', '2342', 'asf', 'asf', 'asf'),
(8, 'affffe', 'asdfas', '324', 'asdadsdq', 'fefe', 'fasdas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(25) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleados`
--

DROP TABLE IF EXISTS `empleados`;
CREATE TABLE IF NOT EXISTS `empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `puesto` varchar(25) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `sueldo` double NOT NULL,
  `email` varchar(25) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `cuil` int(25) NOT NULL,
  `cod_postal` int(15) NOT NULL,
  `fecha_fin` date NOT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `establecimientos`
--

DROP TABLE IF EXISTS `establecimientos`;
CREATE TABLE IF NOT EXISTS `establecimientos` (
  `id_establecimiento` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  PRIMARY KEY (`id_establecimiento`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `establecimientos`
--

INSERT INTO `establecimientos` (`id_establecimiento`, `nombre`) VALUES
(1, 'Laguna del Monte'),
(2, 'Ceferino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_categorias`
--

DROP TABLE IF EXISTS `gastos_categorias`;
CREATE TABLE IF NOT EXISTS `gastos_categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `concepto` varchar(30) NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos_reales`
--

DROP TABLE IF EXISTS `gastos_reales`;
CREATE TABLE IF NOT EXISTS `gastos_reales` (
  `id_gasto` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `detalle` varchar(25) NOT NULL,
  `valor` float NOT NULL,
  `id_establecimiento` int(11) NOT NULL,
  `tipo_recibo` varchar(25) NOT NULL,
  PRIMARY KEY (`id_gasto`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `gastos_reales`
--

INSERT INTO `gastos_reales` (`id_gasto`, `fecha`, `id_categoria`, `detalle`, `valor`, `id_establecimiento`, `tipo_recibo`) VALUES
(2, '2019-05-09', 2, 'gasto por vacunas', 15354.6, 0, 'fact a'),
(3, '2001-11-11', 15, 'edit gasto', 11, 0, 'A'),
(4, '2019-05-09', 24, 'semillas 2', 3412, 0, 'fact b'),
(5, '2019-05-11', 24, 'semillas 2', 3412, 0, 'fact b'),
(6, '2019-05-11', 24, 'semillas 2', 3412, 0, 'fact b'),
(7, '2019-05-21', 0, 'det', 1545, 0, 'A'),
(8, '2019-05-21', 0, 'det', 200, 0, 'A'),
(9, '2019-05-30', 33, 'dett', 22, 0, 'b'),
(10, '2019-05-22', 33, 'det', 2, 0, 'A');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE IF NOT EXISTS `movimientos` (
  `id_mov` int(11) NOT NULL AUTO_INCREMENT,
  `id_caravana` int(11) NOT NULL,
  `fecha_mov` date NOT NULL,
  `cantidad` int(11) NOT NULL,
  `tipo_mov` varchar(15) NOT NULL,
  PRIMARY KEY (`id_mov`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id_mov`, `id_caravana`, `fecha_mov`, `cantidad`, `tipo_mov`) VALUES
(2, 125, '2019-02-21', 344, 'entrada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `id_caravana` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `pass` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `pass`) VALUES
(1, 'administrador', 'admin', 'admin', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

DROP TABLE IF EXISTS `ventas`;
CREATE TABLE IF NOT EXISTS `ventas` (
  `id_ventas` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `num_fact` varchar(25) NOT NULL,
  `cabezas` int(10) NOT NULL,
  `kg` float NOT NULL,
  `peso_x_kg` float NOT NULL,
  `bruto` float NOT NULL,
  `iva` float NOT NULL,
  `neto` float NOT NULL,
  `retencion` float NOT NULL,
  PRIMARY KEY (`id_ventas`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_ventas`, `fecha`, `num_fact`, `cabezas`, `kg`, `peso_x_kg`, `bruto`, `iva`, `neto`, `retencion`) VALUES
(9, '2019-03-08', '0fdsf', 38, 15354.6, 1557.78, 0, 0, 0, 0),
(10, '2019-03-08', '0fdda', 45, 45, 44, 0, 0, 0, 0),
(11, '2019-03-08', 'fact 23', 15, 15, 15, 15, 15, 15, 15);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
