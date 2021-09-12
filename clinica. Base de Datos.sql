-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-09-2021 a las 20:53:46
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `clinica`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `add_user_paciente` (IN `id_pa` INT)  begin
	INSERT INTO `pacientes`( `apellido`, `nombre`, `documento`, `telefono`, `direccion`, `correo`, `usuario`, `clave`, `rol`) 
	SELECT `apellido`, `nombre`, `documento`, `telefono`, `direccion`, `correo`, `usuario`, `clave`, 'Paciente' from paciente_temp WHERE id = id_pa;
	delete from paciente_temp where id = id_pa;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administradores`
--

CREATE TABLE `administradores` (
  `id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `rol` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `administradores`
--

INSERT INTO `administradores` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `foto`, `rol`) VALUES
(1, 'admin', '123', 'User', 'Admin1', 'Vistas/img/Usuarios/A-344.png', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(11) NOT NULL,
  `id_doctor` int(11) NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `id_paciente` int(11) NOT NULL,
  `nyaP` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `inicio` datetime NOT NULL,
  `fin` datetime NOT NULL,
  `tiempoa` time NOT NULL,
  `tiempob` time NOT NULL,
  `fechaC` date NOT NULL,
  `metodoP` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pago` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `id_doctor`, `id_consultorio`, `id_paciente`, `nyaP`, `documento`, `inicio`, `fin`, `tiempoa`, `tiempob`, `fechaC`, `metodoP`, `pago`) VALUES
(367, 21, 7, 14, 'Joel  de la cruz', '84848848', '2021-09-03 08:00:00', '2021-09-03 09:00:00', '08:00:00', '09:00:00', '2021-09-03', 's', 1),
(370, 21, 7, 11, 'Jose  Almonte', '29324234', '2021-09-03 14:00:00', '2021-09-03 15:00:00', '14:00:00', '15:00:00', '2021-09-03', 's', 1),
(371, 23, 8, 14, 'Joel  de la cruz', 'sfasafs', '2021-09-09 09:00:00', '2021-09-09 10:00:00', '09:00:00', '10:00:00', '2021-09-09', 's', 0),
(372, 23, 8, 10, 'Elian Ezequiel Martinez Hernandez', '95959959', '2021-09-09 12:00:00', '2021-09-09 13:00:00', '12:00:00', '13:00:00', '2021-09-09', 's', 1),
(373, 23, 8, 19, 'Joel Matos', '43242424242', '2021-09-09 15:00:00', '2021-09-09 16:00:00', '15:00:00', '16:00:00', '2021-09-09', 'e', 0),
(374, 23, 8, 17, 'RhodeMega  Games', '40230542785', '2021-09-15 10:00:00', '2021-09-15 11:00:00', '10:00:00', '11:00:00', '2021-09-15', 's', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultorios`
--

CREATE TABLE `consultorios` (
  `id` int(11) NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `consultorios`
--

INSERT INTO `consultorios` (`id`, `nombre`) VALUES
(7, 'Cardiologia'),
(8, 'Dermatologia'),
(13, 'Fisioterapia'),
(14, 'Cirugia General'),
(15, 'Cirugía Plástica'),
(16, 'Ginecología'),
(17, 'Cirugía Bariátrica'),
(18, 'Psicologia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `id` int(11) NOT NULL,
  `id_consultorio` int(11) NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `sexo` text COLLATE utf8_spanish_ci NOT NULL,
  `horarioE` time NOT NULL,
  `horarioS` time NOT NULL,
  `rol` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `doctores`
--

INSERT INTO `doctores` (`id`, `id_consultorio`, `apellido`, `nombre`, `foto`, `usuario`, `clave`, `sexo`, `horarioE`, `horarioS`, `rol`) VALUES
(18, 15, 'Almonte', 'Fatima', 'Vistas/img/Doctores/Doc-710.png', 'fatima1', '123', 'Femenino', '10:00:00', '17:00:00', 'Doctor'),
(19, 14, 'Asilis', 'Jose', 'Vistas/img/Doctores/Doc-105.png', 'jose1', '123', 'Masculino', '08:00:00', '16:00:00', 'Doctor'),
(20, 13, 'Marrero', 'Jaqueline', 'Vistas/img/Doctores/Doc-615.png', 'jaqueline1', '123', 'Femenino', '08:00:00', '17:20:00', 'Doctor'),
(21, 7, 'Valentin', 'Nicolas', 'Vistas/img/Doctores/Doc-592.png', 'nicolas1', '123', 'Masculino', '08:00:00', '17:00:00', 'Doctor'),
(22, 17, 'Alfonso', 'Edgar', 'Vistas/img/Doctores/Doc-944.png', 'edgar1', '123', 'Masculino', '08:00:00', '15:00:00', 'Doctor'),
(23, 8, 'Yinola', 'Anna', 'Vistas/img/Doctores/Doc-342.png', 'anna1', '123', 'Femenino', '09:00:00', '18:00:00', 'Doctor'),
(24, 16, 'Perez', 'Carlos', 'Vistas/img/Doctores/Doc-824.png', 'carlos1', '123', 'Masculino', '11:00:00', '18:00:00', 'Doctor'),
(25, 18, 'Barria', 'Daniel', 'Vistas/img/Doctores/Doc-655.png', 'daniel1', '123', 'Masculino', '08:00:00', '15:00:00', 'Doctor'),
(29, 0, 'Apelliodes', 'Affreewq', 'Vistas/img/Doctores/Doc-655.png', '123', '123', 'Masculino', '00:00:00', '00:00:00', 'Doctor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id` int(11) NOT NULL,
  `intro` text COLLATE utf8_spanish_ci NOT NULL,
  `horaE` time NOT NULL,
  `horaS` time NOT NULL,
  `telefono` text COLLATE utf8_spanish_ci NOT NULL,
  `correo` text COLLATE utf8_spanish_ci NOT NULL,
  `direccion` text COLLATE utf8_spanish_ci NOT NULL,
  `logo` text COLLATE utf8_spanish_ci NOT NULL,
  `favicon` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id`, `intro`, `horaE`, `horaS`, `telefono`, `correo`, `direccion`, `logo`, `favicon`) VALUES
(1, 'Bienvenido a CECIP', '08:00:00', '18:00:00', '(809) 686-7290', 'CECIP@clinica.com', 'Calle Manuel María Castillo 20, Santo Domingo', 'Vistas/img/logo.png', 'Vistas/img/favicon.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones`
--

CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tabla` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `mensaje` varchar(500) COLLATE utf32_spanish2_ci NOT NULL,
  `leido` tinyint(1) NOT NULL DEFAULT 0,
  `datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `notificaciones`
--

INSERT INTO `notificaciones` (`id`, `id_usuario`, `tabla`, `mensaje`, `leido`, `datetime`) VALUES
(229, 21, 'Doctor', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 10:00:00', 1, '2021-08-31 00:13:00'),
(230, 4, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 10:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 00:13:00'),
(231, 5, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 10:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 00:13:00'),
(233, 21, 'Doctor', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 09:00:00', 1, '2021-08-31 00:14:42'),
(234, 4, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 09:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 00:14:42'),
(235, 5, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 09:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 00:14:42'),
(237, 21, 'Doctor', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 08:00:00', 1, '2021-08-31 00:32:17'),
(238, 4, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 08:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 00:32:17'),
(239, 5, 'Secretaria', 'El paciente Joel Matos 19 ha cancelado la cita del 2021-08-30 : 08:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 00:32:17'),
(241, 21, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-30 : 09:00:00', 1, '2021-08-31 00:33:17'),
(242, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-30 : 09:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 00:33:17'),
(243, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-30 : 09:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 00:33:17'),
(245, 21, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00', 0, '2021-08-31 14:27:18'),
(246, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 14:27:18'),
(247, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 14:27:18'),
(249, 21, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00', 0, '2021-08-31 14:46:40'),
(250, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 14:46:40'),
(251, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 08:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 14:46:40'),
(253, 23, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 13:00:00', 0, '2021-08-31 14:55:08'),
(254, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 13:00:00 Del doctor Anna Yinola', 1, '2021-08-31 14:55:08'),
(255, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 13:00:00 Del doctor Anna Yinola', 0, '2021-08-31 14:55:08'),
(257, 23, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00', 0, '2021-08-31 14:55:11'),
(258, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00 Del doctor Anna Yinola', 1, '2021-08-31 14:55:11'),
(259, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00 Del doctor Anna Yinola', 0, '2021-08-31 14:55:11'),
(261, 21, 'Doctor', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00', 0, '2021-08-31 14:55:15'),
(262, 4, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00 Del doctor Nicolas Valentin', 1, '2021-08-31 14:55:15'),
(263, 5, 'Secretaria', 'El paciente Joel Matos ID:19 ha cancelado la cita del 2021-08-31 : 12:00:00 Del doctor Nicolas Valentin', 0, '2021-08-31 14:55:15'),
(265, 4, 'Secretaria', 'Usuario ELIAN D01-157793 ID:50 en lista de espera para aprobación', 1, '2021-08-31 22:08:46'),
(266, 5, 'Secretaria', 'Usuario ELIAN D01-157793 ID:50 en lista de espera para aprobación', 0, '2021-08-31 22:08:46'),
(268, 21, 'Doctor', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 12:00:00', 0, '2021-09-01 02:29:57'),
(269, 4, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Nicolas Valentin', 1, '2021-09-01 02:29:57'),
(270, 5, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Nicolas Valentin', 0, '2021-09-01 02:29:57'),
(271, 6, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Nicolas Valentin', 1, '2021-09-01 02:29:57'),
(272, 11, 'Paciente', 'Su cita del 2021-09-01 15:00:00 con el doctor Nicolas Valentin fue cambiada para el miércoles, 1 de septiembre de 2021 9:00', 1, '2021-09-02 22:13:56'),
(273, 11, 'Paciente', 'Se ha cancelado la cita del 2021-09-03 11:00:00', 1, '2021-09-03 00:19:41'),
(274, 11, 'Paciente', 'Se ha cancelado la cita del 2021-09-01 12:00:00', 1, '2021-09-03 00:20:02'),
(275, 11, 'Paciente', 'Se ha cancelado la cita del 2021-09-01 09:00:00', 1, '2021-09-03 00:20:17'),
(276, 11, 'Paciente', 'Se ha cancelado la cita del 2021-09-01 14:00:00', 1, '2021-09-03 00:20:22'),
(277, 14, 'Paciente', 'Se ha cancelado la cita del 2021-09-02 09:00:00', 0, '2021-09-03 00:20:30'),
(278, 20, 'Doctor', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 08:00:00', 0, '2021-09-03 00:20:52'),
(279, 4, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 08:00:00 Del doctor Jaqueline Marrero', 1, '2021-09-03 00:20:52'),
(280, 5, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 08:00:00 Del doctor Jaqueline Marrero', 0, '2021-09-03 00:20:52'),
(281, 6, 'Secretaria', 'El paciente Jose Almonte ID:11 ha cancelado la cita del 2021-09-01 : 08:00:00 Del doctor Jaqueline Marrero', 1, '2021-09-03 00:20:52'),
(282, 11, 'Paciente', 'Su cita del 2021-09-03 09:00:00 con el doctor Nicolas Valentin fue cambiada para el viernes, 3 de septiembre de 2021 14:00', 1, '2021-09-03 00:22:34'),
(283, 17, 'Paciente', 'Su cita del 2021-09-01 09:00:00 con el doctor Anna Yinola fue cambiada para el miércoles, 1 de septiembre de 2021 12:00', 1, '2021-09-12 00:39:10'),
(284, 23, 'Doctor', 'El paciente RhodeMega Games ID:17 ha cancelado la cita del 2021-09-01 : 12:00:00', 0, '2021-09-12 00:41:02'),
(285, 4, 'Secretaria', 'El paciente RhodeMega Games ID:17 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Anna Yinola', 1, '2021-09-12 00:41:02'),
(286, 5, 'Secretaria', 'El paciente RhodeMega Games ID:17 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Anna Yinola', 0, '2021-09-12 00:41:02'),
(287, 6, 'Secretaria', 'El paciente RhodeMega Games ID:17 ha cancelado la cita del 2021-09-01 : 12:00:00 Del doctor Anna Yinola', 0, '2021-09-12 00:41:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `documento` text COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci DEFAULT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `rol` text COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`id`, `apellido`, `nombre`, `documento`, `telefono`, `direccion`, `foto`, `correo`, `usuario`, `clave`, `rol`) VALUES
(9, 'Montero', 'Luiyi', '111', '8096810988', 'direccion', '', 'correo2@gmail.com', 'luiyi1', '123', 'Paciente'),
(10, 'Martinez Hernandez', 'Elian Ezequiel', '40230542785', '59865656565', 'direccion', '', 'juanito@gmail.com', 'user1', 'masade123', 'Paciente'),
(11, 'Almonte', 'Jose', '29324234', '1025689878', 'direccion1', '', 'jose123@gmail.com', 'user123', 'masa', 'Paciente'),
(12, 'D01-157793', 'Elian', '40230542785', '3055993939', '1603 N.W. 79th Ave', '', 'elianmartinez157@gmail.com', 'elian123', 'masade123', 'Paciente'),
(14, 'de la cruz', 'Joel ', '40230542785', '809-658-1022', 'Real del Makhlouf No. 183', '', 'elianmartinez157@gmail.com', 'elian66', '123', 'Paciente'),
(16, 'Ramirez', 'Joselito', '5959598484', '8089494', 'eweweww', NULL, 'elianmartinez157@gmail.com', 'klk22', '123', 'Paciente'),
(17, 'Games', 'RhodeMega', '40230542785', '3055993939', 'Real del Makhlouf No. 183', NULL, 'elianmartinez157@gmail.com', 'cuartopoder5', '123456', 'Paciente'),
(18, 'Games', 'RhodeMega', '40230542785', '3055993939', 'Real del Makhlouf No. 183', NULL, 'elianmartinez157@gmail.com', 'jjij', '123', 'Paciente'),
(19, 'Matos', 'Joel', '5959595959599', '8095226669', 'Dirección 11', NULL, 'elianmaertinez157@hotmail.com', 'joel123', 'joel', 'Paciente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente_temp`
--

CREATE TABLE `paciente_temp` (
  `id` int(11) NOT NULL,
  `apellido` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `documento` varchar(50) COLLATE utf32_spanish2_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf32_spanish2_ci NOT NULL,
  `direccion` varchar(200) COLLATE utf32_spanish2_ci NOT NULL,
  `correo` varchar(200) COLLATE utf32_spanish2_ci NOT NULL,
  `usuario` varchar(35) COLLATE utf32_spanish2_ci NOT NULL,
  `clave` varchar(35) COLLATE utf32_spanish2_ci NOT NULL,
  `verificode` int(4) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_spanish2_ci;

--
-- Volcado de datos para la tabla `paciente_temp`
--

INSERT INTO `paciente_temp` (`id`, `apellido`, `nombre`, `documento`, `telefono`, `direccion`, `correo`, `usuario`, `clave`, `verificode`, `Estado`) VALUES
(38, 'D01-157793', 'Elian', '40230542785', '8296589878', 'direccion 1', 'elianmartinez157@gmail.com', 'admin2', '123', 6933, 0),
(40, 'Almonte', 'Brayan', '78958484', '', '', 'elianmartinez157@gmail.com', 'uase1', '123', 6591, 0),
(41, 'Perez', 'Augusto', '40230542785', '3055993939', 'Alma rosa, nicolas sifo canario', 'elianmartinez157@gmail.com', 'admin3', '123', 4429, 0),
(42, 'D01-157793', 'Elian', '40230542785', '3055993939', '1603 N.W. 79th Ave\nD01-157793', 'elianmartinez157@gmail.com', 'cuartopoder', '123', 4214, 0),
(43, 'Games', 'RhodeMega', '40230542785', '3055993939', 'Real del Makhlouf No. 183', 'elianmartinez157@gmail.com', 'eli123', '123', 4085, 0),
(44, 'D01-157793', 'Elian', '1231321', '3055993939', '1603 N.W. 79th Ave\nD01-157793', 'elianmartinez157@gmail.com', 'user1', '123', 2854, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `secretarias`
--

CREATE TABLE `secretarias` (
  `id` int(11) NOT NULL,
  `usuario` text COLLATE utf8_spanish_ci NOT NULL,
  `clave` text COLLATE utf8_spanish_ci NOT NULL,
  `nombre` text COLLATE utf8_spanish_ci NOT NULL,
  `apellido` text COLLATE utf8_spanish_ci NOT NULL,
  `foto` text COLLATE utf8_spanish_ci NOT NULL,
  `rol` text COLLATE utf8_spanish_ci NOT NULL,
  `id_consultorio` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `secretarias`
--

INSERT INTO `secretarias` (`id`, `usuario`, `clave`, `nombre`, `apellido`, `foto`, `rol`, `id_consultorio`) VALUES
(4, 'ruth', '123', 'ruth', 'Otoña', '', 'Secretaria', 8),
(5, 'jo', '123', 'Joselita', 'Ramirez', '', 'Secretaria', 8),
(6, 'est123', '123', 'Estefany', 'Almonte', '', 'Secretaria', 7);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administradores`
--
ALTER TABLE `administradores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_doctor` (`id_doctor`),
  ADD KEY `id_consultorio` (`id_consultorio`),
  ADD KEY `id_paciente` (`id_paciente`);

--
-- Indices de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_consultorio` (`id_consultorio`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paciente_temp`
--
ALTER TABLE `paciente_temp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- Indices de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administradores`
--
ALTER TABLE `administradores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=375;

--
-- AUTO_INCREMENT de la tabla `consultorios`
--
ALTER TABLE `consultorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `notificaciones`
--
ALTER TABLE `notificaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=288;

--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de la tabla `paciente_temp`
--
ALTER TABLE `paciente_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `secretarias`
--
ALTER TABLE `secretarias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
