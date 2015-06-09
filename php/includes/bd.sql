-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 09-06-2015 a las 11:51:44
-- Versión del servidor: 5.5.43-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `congreso`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Actividad`
--

CREATE TABLE IF NOT EXISTS `Actividad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` text COLLATE utf8_spanish_ci,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` text COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id`, `nombre`, `fecha`, `hora`, `foto`, `precio`, `descripcion`) VALUES
(1, 'Campeonato de LOL', '2015-06-05', '9:00', 'images/actividades/lol.png', 1, '¿Quien dijo que Wordpad estaba obsoleto?, ¿Alguien cree que es una herramienta con poca utilidad?.\r\n\r\nEn el taller de Wordpad comprenderas el mundo de esta maravillosa herramienta, en la que podrás escribir texto (y números!!) además, a diferencia de las ya antiguas máquinas de escribir, podrás borrar lo escrito (sin manchas!!)\r\n\r\nPara el taller se requiere un ordenador con Windows 95\r\n'),
(2, 'Picnic en sala de ordenadores', '2015-06-05', '14:00', 'images/actividades/picnic.png', 2, 'Un bonito picnic en la sala de ordenadores (no hemos encontrado otro sitio)'),
(3, 'Campeonato futbolin', '2015-06-05', '16:00', 'images/actividades/futbolin.jpg', 5, 'La pareja ganadora conseguira gratis un ticket por un cafe en la cafetería (a compartir entre los dos)'),
(4, 'Partido de futbol', '2015-06-05', '18:00', 'images/actividades/futbol.jpg', 2, 'Tendrá lugar un encuentro entre el Galactic Empire F.C. y Los Rebeldes de Endor, el ganador recibirá una galaxia muy,muy lejana.\r\n'),
(5, 'Taller: Introduccion a WordPad', '2015-06-05', '18:00', 'images/actividades/wordpad.jpg', 1, '\r\n\r\nEn el taller de Wordpad comprenderas el mundo de esta maravillosa herramienta, en la que podrás escribir texto (y números!!) además, a diferencia de las ya antiguas máquinas de escribir, podrás borrar lo escrito (sin manchas!!)\r\n\r\nPara el taller se requiere un ordenador con Windows 95\r\n'),
(6, 'Viaje a Sierra Nevada', '2015-06-06', '09:00', 'images/actividades/sierra.jpg', 20, 'Rodeada de parajes de excepción, Sierra Nevada es la joya nevada del Sur de España. Altas montañas, reservas y parques naturales, picos impresionantes... Su paisaje dibuja una inigualable belleza, donde la naturaleza ofrece bosques, lagunas y una gran riqueza en flora y fauna. Unas características que la han llevado a ser declarada Reserva de la Biosfera y Parque Nacional.'),
(7, 'Visita Alhambra', '2015-06-06', '16:00', 'images/actividades/alhambra.jpg', 15, 'Castillo y fortaleza, palacio real y ciudad, jardines y retiro de verano, la Alhambra es todo eso y mucho más.\r\nen Granada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuota`
--

CREATE TABLE IF NOT EXISTS `Cuota` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(512) NOT NULL,
  `importe` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tipo` (`tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Volcado de datos para la tabla `Cuota`
--

INSERT INTO `Cuota` (`id`, `tipo`, `importe`) VALUES
(1, 'estudiante', 10),
(2, 'profesor', 15),
(3, 'inivitado', 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuotas_Actividades`
--

CREATE TABLE IF NOT EXISTS `Cuotas_Actividades` (
  `id_cuota` int(10) unsigned NOT NULL DEFAULT '0',
  `id_actividad` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cuota`,`id_actividad`),
  KEY `id_actividad` (`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Cuotas_Actividades`
--

INSERT INTO `Cuotas_Actividades` (`id_cuota`, `id_actividad`) VALUES
(1, 2),
(2, 2),
(2, 4),
(3, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participante`
--

CREATE TABLE IF NOT EXISTS `Participante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `nombreUsuario` varchar(512) NOT NULL,
  `apellido` text NOT NULL,
  `tipo` varchar(512) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo` (`tipo`),
  KEY `nombreUsuario` (`nombreUsuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `Participante`
--

INSERT INTO `Participante` (`id`, `nombre`, `nombreUsuario`, `apellido`, `tipo`) VALUES
(1, 'antonio', 'antonio', 'jimenez', 'estudiante'),
(11, 'antonio', 'antonio', 'jimenez martinez', 'estudiante'),
(12, 'aaa', 'antonio', 'jimenez', 'profesor'),
(13, 'antonio', 'antonio', 'jimenez', 'estudiante'),
(16, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(17, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(18, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(19, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(20, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(21, 'sdfasf', 'antonio', 'sdfasdsa', 'inivitado'),
(22, 'asdfdsf', 'antonio', 'sdfsdfs', 'profesor'),
(23, 'antonio', 'antonio', 'sdf', 'inivitado'),
(24, 'juan', 'antonio', 'pepe', 'profesor'),
(25, 'dsgsa', 'antonio', 'sdgas', 'inivitado'),
(26, 'antonio', 'antonio', 'jimenez', 'profesor'),
(27, 'antonio3', 'antonio', 'jimenez', 'profesor'),
(28, 'antonio3', 'antonio', 'jimenez', 'profesor'),
(29, 'antonio', 'antonio', 'sdf', 'estudiante'),
(30, 'antonio', 'antonio', 'jimenez', 'estudiante'),
(31, 'antonio', 'antonio', 'jimenez', 'profesor'),
(32, 'b', 'antonio', 'jimenez', 'estudiante'),
(33, 'b', 'antonio', 'jimenez', 'estudiante'),
(34, 'b', 'antonio', 'jimenez', 'estudiante'),
(35, 'antonio', 'antonio', 'jimenez', 'profesor'),
(36, 'a', 'antonio', 'a', 'estudiante'),
(37, 'antonio', 'antonio', 'jimenez', 'estudiante'),
(38, 'antonio', 'antonio', 'a', 'estudiante'),
(39, 'juan', 'antonio', 'fsdfsa', 'inivitado'),
(40, 'antonio', 'antonio', 'jimenez', 'inivitado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participante_Actividades`
--

CREATE TABLE IF NOT EXISTS `Participante_Actividades` (
  `id_participante` int(10) unsigned NOT NULL DEFAULT '0',
  `id_actividad` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_participante`,`id_actividad`),
  KEY `id_actividad` (`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Participante_Actividades`
--

INSERT INTO `Participante_Actividades` (`id_participante`, `id_actividad`) VALUES
(11, 2),
(12, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(11, 3),
(24, 3),
(25, 3),
(11, 4),
(24, 4),
(26, 4),
(27, 4),
(28, 4),
(31, 4),
(35, 4),
(39, 7),
(40, 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `password` text NOT NULL,
  `email` text NOT NULL,
  `rol` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nombre` (`nombre`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Volcado de datos para la tabla `Usuario`
--

INSERT INTO `Usuario` (`id`, `nombre`, `password`, `email`, `rol`) VALUES
(1, 'antonio', 'antonio', 'jm94antonio@correo.ugr.es', 'admin'),
(2, 'andres', 'andres', 'andres@correo.es', 'admin'),
(7, 'juan', 'juan', 'juan@corre.ugr.es', 'normal'),
(9, 'pepe', 'pepe', 'pepe@correo.es', 'normal'),
(10, 'a', 'a', 'a@correo.ugr.es', 'admin'),
(12, 'b', 'b', 'sjadsaja@afa.es', 'normal');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Cuotas_Actividades`
--
ALTER TABLE `Cuotas_Actividades`
  ADD CONSTRAINT `Cuotas_Actividades_ibfk_1` FOREIGN KEY (`id_cuota`) REFERENCES `Cuota` (`id`),
  ADD CONSTRAINT `Cuotas_Actividades_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id`);

--
-- Filtros para la tabla `Participante`
--
ALTER TABLE `Participante`
  ADD CONSTRAINT `Participante_ibfk_1` FOREIGN KEY (`nombreUsuario`) REFERENCES `Usuario` (`nombre`),
  ADD CONSTRAINT `Participante_ibfk_2` FOREIGN KEY (`tipo`) REFERENCES `Cuota` (`tipo`);

--
-- Filtros para la tabla `Participante_Actividades`
--
ALTER TABLE `Participante_Actividades`
  ADD CONSTRAINT `Participante_Actividades_ibfk_1` FOREIGN KEY (`id_participante`) REFERENCES `Participante` (`id`),
  ADD CONSTRAINT `Participante_Actividades_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
