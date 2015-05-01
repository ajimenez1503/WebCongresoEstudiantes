-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 01-05-2015 a las 11:51:30
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
  `nombre` text NOT NULL,
  `fecha` date DEFAULT NULL,
  `hora` text,
  `foto` text NOT NULL,
  `precio` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Volcado de datos para la tabla `Actividad`
--

INSERT INTO `Actividad` (`id`, `nombre`, `fecha`, `hora`, `foto`, `precio`, `descripcion`) VALUES
(1, 'Campeonato de LOL', '2015-06-05', '9:00', 'images/actividades/lol.png', 5, 'Se realizará un campeonato del popular juego LOL (League of Lettuces), El premio estará dotado en una subscripción por un año a la revista "Lactuca sativa"'),
(2, 'Picnic en sala de ordenadores', '2015-06-05', '14:00', 'images/actividades/picnic.png', 2, 'Un bonito picnic en la sala de ordenadores (no hemos encontrado otro sitio)'),
(3, 'Campeonato futbolin', '2015-06-05', '16:00', 'images/actividades/futbolin.jpg', 5, 'La pareja ganadora conseguira gratis un ticket por un cafe en la cafetería (a compartir entre los dos)'),
(4, 'Partido de futbol', '2015-06-05', '18:00', 'images/actividades/futbol.jpg', 2, 'Tendrá lugar un encuentro entre el Galactic Empire F.C. y Los Rebeldes de Endor, el ganador recibirá una galaxia muy,muy lejana.\r\n'),
(5, 'Taller: Introducción a WordPad', '2015-06-05', '18:00', 'images/actividades/wordpad.jpg', 1, '¿Quien dijo que Wordpad estaba obsoleto?, ¿Alguien cree que es una herramienta con poca utilidad?.\r\n\r\nEn el taller de Wordpad comprenderas el mundo de esta maravillosa herramienta, en la que podrás escribir texto (y números!!) además, a diferencia de las ya antiguas máquinas de escribir, podrás borrar lo escrito (sin manchas!!)\r\n\r\nPara el taller se requiere un ordenador con Windows 95\r\n'),
(6, 'Viaje a Sierra Nevada', '2015-06-06', '09:00', 'images/actividades/sierra.jpg', 20, 'Rodeada de parajes de excepción, Sierra Nevada es la joya nevada del Sur de España. Altas montañas, reservas y parques naturales, picos impresionantes... Su paisaje dibuja una inigualable belleza, donde la naturaleza ofrece bosques, lagunas y una gran riqueza en flora y fauna. Unas características que la han llevado a ser declarada Reserva de la Biosfera y Parque Nacional.'),
(7, 'Visita Alhambra', '2015-06-06', '16:00', 'images/actividades/alhambra.jpg', 15, 'Castillo y fortaleza, palacio real y ciudad, jardines y retiro de verano, la Alhambra es todo eso y mucho más.\r\nen Granada.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Cuota`
--

CREATE TABLE IF NOT EXISTS `Cuota` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` text NOT NULL,
  `importe` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Participante`
--

CREATE TABLE IF NOT EXISTS `Participante` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` text NOT NULL,
  `nombreUsuario` varchar(512) NOT NULL,
  `apellido` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nombreUsuario` (`nombreUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Usuario`
--

CREATE TABLE IF NOT EXISTS `Usuario` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(512) NOT NULL,
  `contraseña` text NOT NULL,
  `email` text NOT NULL,
  `rol` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Participante`
--
ALTER TABLE `Participante`
  ADD CONSTRAINT `Participante_ibfk_1` FOREIGN KEY (`nombreUsuario`) REFERENCES `Usuario` (`nombre`);

--
-- Filtros para la tabla `Participante_Actividades`
--
ALTER TABLE `Participante_Actividades`
  ADD CONSTRAINT `Participante_Actividades_ibfk_1` FOREIGN KEY (`id_participante`) REFERENCES `Participante` (`id`),
  ADD CONSTRAINT `Participante_Actividades_ibfk_2` FOREIGN KEY (`id_actividad`) REFERENCES `Actividad` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
