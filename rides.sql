-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-11-2015 a las 00:42:11
-- Versión del servidor: 5.5.45
-- Versión de PHP: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rides`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `id_ruta` int(5) NOT NULL,
  `nom_ruta` varchar(100) NOT NULL,
  `anfitrion` varchar(35) NOT NULL,
  `origen_x` varchar(40) NOT NULL,
  `origen_y` varchar(40) NOT NULL,
  `destino_x` varchar(50) NOT NULL,
  `destino_y` varchar(50) NOT NULL,
  `ubicacion` varchar(150) NOT NULL,
  `dias` varchar(50) NOT NULL,
  `horario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`id_ruta`, `nom_ruta`, `anfitrion`, `origen_x`, `origen_y`, `destino_x`, `destino_y`, `ubicacion`, `dias`, `horario`) VALUES
(32, 'Ride desde 3 caminos', 'ax', '25.6664863', '-100.1830521', '25.7238862', '-100.31285739999998', 'nardo 626, 3 caminos, guadalupe, nuevo leon', 'Lunes, Martes, Viernes', '11:00 am'),
(33, 'Guadalupe a mederos ', 'ax', '25.6775595', '-100.2596935', '25.61415077', '-100.28184056', 'guadalupe, nuevo leon, mexico', 'Martes, Miercoles', '11:00 am'),
(34, 'San nico a universidad', 'admin', '25.7493469', '-100.2868973', '25.7238862', '-100.31285739999998', 'San nicolas de los garza, nuevo leon', 'Lunes, Viernes', '9:00 am'),
(35, 'Ruta cercana', 'ramiro', '25.7197913', '-100.3593782', '25.7238862', '-100.31285739999998', 'valle del dorado, valle de las mitras, nuevo leon', 'Miercoles, Jueves', '9:05 am'),
(36, 'mitras a uni', 'ramiro', '25.7082524', '-100.3471257', '25.7238862', '-100.31285739999998', 'orizaba, mitras norte, monterrey', 'Lunes, Viernes', '11:00 am'),
(37, 'jardin a uni', 'admin', '25.7151229', '-100.3539075', '25.7238862', '-100.31285739999998', 'Jardin de Versalles, Jardin de las Mitras', 'Lunes', '6;00PM'),
(38, 'Juares a universidad', 'admin', '25.6516471', '-100.1059194', '25.7238862', '-100.31285739999998', 'juares, nuevo leon, ', 'Martes, Miercoles, Sabado', '3:00 pm'),
(39, 'Apodaca a cd. universitaria', 'admin', '25.7815621', '-100.1875974', '25.7238862', '-100.31285739999998', 'Apodaca, Nuevo Leon', 'Lunes, Sabado', '2:00 pm'),
(40, 'Mision santa fe a universidad', 'admin', '25.6487751', '-100.1771835', '25.7238862', '-100.31285739999998', 'Mision santa fe, juares, nuevo leon', 'Miercoles, Jueves', '3:00 pm'),
(41, '3 caminos a mederos', 'admin', '25.6668463', '-100.1829999', '25.61415077', '-100.28184056', 'Flor de Liz 627, Tres Caminos 2o Sector, 67190 Guadalupe, N.L., MÃ©xico', 'Martes, Viernes', '12:00 pm'),
(42, '3 caminos a hospital', 'admin', '25.6668463', '-100.1829999', '25.69185015', '-100.34884214', 'Flor de Liz 627, Tres Caminos 2o Sector, 67190 Guadalupe, N.L., MÃ©xico', 'Martes, Miercoles', '3:00 pm'),
(43, 'santa catarina a mederos', 'admin', '25.6769684', '-100.4508956', '25.61415077', '-100.28184056', 'santa catarina, nuevo leon', 'Lunes', '11:00 am'),
(44, 'san pedro a hospital', 'admin', '25.6573447', '-100.4017501', '25.69185015', '-100.34884214', 'san pedro garza garcia, nuevo leon', 'Martes', '4:00PM'),
(45, 'santiago a nuevo leon', 'admin', '25.4166153', '-100.1591213', '25.7238862', '-100.31285739999998', 'santiago, nuevo leon', 'Miercoles', '5:00 AM'),
(46, 'San Pedro a Cd. Universitaria', 'admin', '25.6794414', '-100.4110912', '25.7238862', '-100.31285739999998', 'Gral. Francisco Villa 108B, RevoluciÃ³n 4o Sector, 66219 San Pedro Garza GarcÃ­a, N.L., MÃ©xico', 'Lunes, Miercoles, Viernes', '8:00 am'),
(47, 'San Pedro a Cd. Universitaria', 'admin', '25.6794293', '-100.411031', '25.7238862', '-100.31285739999998', 'Gral. Francisco Villa 108C, RevoluciÃ³n 4o Sector, 66219 San Pedro Garza GarcÃ­a, N.L., MÃ©xico', 'Lunes, Sabado', '11:00 am'),
(48, 'San pedro 400 a uni', 'admin', '25.6819653', '-100.4102898', '25.7238862', '-100.31285739999998', 'Luis cabrera, RevoluciÃ³n 4o Sector, 66219 San Pedro Garza GarcÃ­a, N.L., MÃ©xico', 'Lunes, Viernes', '6:00 PM'),
(49, '227', 'admin', '25.6794293', '-100.411031', '25.7238862', '-100.31285739999998', 'Gral. Francisco Villa 108C, RevoluciÃ³n 4o Sector, 66219 San Pedro Garza GarcÃ­a, N.L., MÃ©xico', 'Lunes, Martes, Miercoles, Viernes', '4:00PM');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes`
--

CREATE TABLE `solicitudes` (
  `id` int(15) NOT NULL,
  `ruta` varchar(100) NOT NULL,
  `anfitrion` varchar(35) NOT NULL,
  `solicitante` varchar(35) NOT NULL,
  `notificado` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `solicitudes`
--

INSERT INTO `solicitudes` (`id`, `ruta`, `anfitrion`, `solicitante`, `notificado`) VALUES
(1, '', '', '', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_user` int(5) NOT NULL,
  `user` varchar(30) NOT NULL,
  `pass` varchar(35) NOT NULL,
  `matricula` varchar(10) NOT NULL,
  `correo` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_user`, `user`, `pass`, `matricula`, `correo`) VALUES
(1, 'admin', 'admin', '0000001', 'admin@administrado.com'),
(8, 'ramiro', 'uva', '1523649', 'uvalle@gmail.com'),
(9, 'katysepulv', 'perritobeagle1', '1598959', 'katia_brs1@hotmail.com'),
(10, 'karen', '123456', '1560462', 'a.karen.rdz@gmail.com');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id_ruta`);

--
-- Indices de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user` (`user`),
  ADD UNIQUE KEY `matricula` (`matricula`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id_ruta` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT de la tabla `solicitudes`
--
ALTER TABLE `solicitudes`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
