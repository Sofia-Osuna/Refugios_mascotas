-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 18-11-2025 a las 09:08:22
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `refugios_mascotas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `adopcion`
--

CREATE TABLE `adopcion` (
  `id_adopcion` int(11) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `estatus` enum('pendiente','en revision','rechazado','aceptado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo_refugio`
--

CREATE TABLE `correo_refugio` (
  `id_correo_refugio` int(11) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `fk_refugio` int(11) NOT NULL,
  `estatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `correo_usuario`
--

CREATE TABLE `correo_usuario` (
  `id_correo_usuario` int(11) NOT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `fk_usuario` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `correo_usuario`
--

INSERT INTO `correo_usuario` (`id_correo_usuario`, `correo`, `fk_usuario`, `estatus`) VALUES
(1, 'test3@gmail.com', 18, '0'),
(2, 'nochecuasaralbedo@gmail.com', 19, '1'),
(3, 'test3ACTUALIZADO@gmail.com', 20, '1'),
(4, 'test3ACTUALIZAAA@gmail.com', 18, '1'),
(5, 'osofia217@gmail.com', 21, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `datos_personales`
--

CREATE TABLE `datos_personales` (
  `id_datos_personales` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido_p` varchar(40) NOT NULL,
  `apellido_m` varchar(40) NOT NULL,
  `edad` char(2) DEFAULT NULL,
  `fecha_nacimiento` date NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `direccion`
--

CREATE TABLE `direccion` (
  `id_direccion` int(11) NOT NULL,
  `nombre_calle` varchar(40) NOT NULL,
  `numero_exterior` varchar(7) DEFAULT NULL,
  `numero_interior` varchar(7) DEFAULT NULL,
  `fk_colonia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `direccion`
--

INSERT INTO `direccion` (`id_direccion`, `nombre_calle`, `numero_exterior`, `numero_interior`, `fk_colonia`) VALUES
(1, 'calle x', '001', '01', 1888);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especie`
--

CREATE TABLE `especie` (
  `id_especie` int(11) NOT NULL,
  `nombre` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `especie`
--

INSERT INTO `especie` (`id_especie`, `nombre`) VALUES
(1, 'Perro'),
(3, 'Gato');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `clave` char(2) DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `fk_pais` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`id_estado`, `clave`, `nombre`, `fk_pais`, `estatus`) VALUES
(1, '09', 'Ciudad de México', 1, '1'),
(2, '01', 'Aguascalientes', 1, '1'),
(3, '02', 'Baja California', 1, '1'),
(4, '03', 'Baja California Sur', 1, '1'),
(5, '04', 'Campeche', 1, '1'),
(6, '05', 'Coahuila de Zaragoza', 1, '1'),
(7, '06', 'Colima', 1, '1'),
(8, '07', 'Chiapas', 1, '1'),
(9, '08', 'Chihuahua', 1, '1'),
(10, '10', 'Durango', 1, '1'),
(11, '11', 'Guanajuato', 1, '1'),
(12, '12', 'Guerrero', 1, '1'),
(13, '13', 'Hidalgo', 1, '1'),
(14, '14', 'Jalisco', 1, '1'),
(15, '15', 'México', 1, '1'),
(16, '16', 'Michoacán de Ocampo', 1, '1'),
(17, '17', 'Morelos', 1, '1'),
(18, '18', 'Nayarit', 1, '1'),
(19, '19', 'Nuevo León', 1, '1'),
(20, '20', 'Oaxaca', 1, '1'),
(21, '21', 'Puebla', 1, '1'),
(22, '22', 'Querétaro', 1, '1'),
(23, '23', 'Quintana Roo', 1, '1'),
(24, '24', 'San Luis Potosí', 1, '1'),
(25, '25', 'Sinaloa', 1, '1'),
(26, '26', 'Sonora', 1, '1'),
(27, '27', 'Tabasco', 1, '1'),
(28, '28', 'Tamaulipas', 1, '1'),
(29, '29', 'Tlaxcala', 1, '1'),
(30, '31', 'Yucatán', 1, '1'),
(31, '32', 'Zacatecas', 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formulario_adopcion`
--

CREATE TABLE `formulario_adopcion` (
  `id_formulario` int(11) NOT NULL,
  `pregunta` varchar(100) NOT NULL,
  `fK_adopcion` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historia_feliz`
--

CREATE TABLE `historia_feliz` (
  `id_historia_feliz` int(11) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `foto` varchar(60) NOT NULL,
  `fk_mascota` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas`
--

CREATE TABLE `mascotas` (
  `id_mascotas` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL,
  `fk_especie` int(11) NOT NULL,
  `fk_refugio` int(11) NOT NULL,
  `estatus` enum('disponible','adoptado','indisponible') NOT NULL,
  `foto` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascotas_adopcion`
--

CREATE TABLE `mascotas_adopcion` (
  `id_mascotas_adopcion` int(11) NOT NULL,
  `fk_mascota` int(11) NOT NULL,
  `fk_adopcion` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipio`
--

CREATE TABLE `municipio` (
  `id_municipio` int(11) NOT NULL,
  `nombre` varchar(60) DEFAULT NULL,
  `fk_estado` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `municipio`
--

INSERT INTO `municipio` (`id_municipio`, `nombre`, `fk_estado`, `estatus`) VALUES
(1, 'Álvaro Obregón', 1, '1'),
(2, 'Azcapotzalco', 1, '1'),
(3, 'Benito Juárez', 1, '1'),
(4, 'Coyoacán', 1, '1'),
(5, 'Cuajimalpa de Morelos', 1, '1'),
(6, 'Cuauhtémoc', 1, '1'),
(7, 'Gustavo A. Madero', 1, '1'),
(8, 'Iztacalco', 1, '1'),
(9, 'Iztapalapa', 1, '1'),
(10, 'La Magdalena Contreras', 1, '1'),
(11, 'Miguel Hidalgo', 1, '1'),
(12, 'Milpa Alta', 1, '1'),
(13, 'Tláhuac', 1, '1'),
(14, 'Tlalpan', 1, '1'),
(15, 'Venustiano Carranza', 1, '1'),
(16, 'Xochimilco', 1, '1'),
(17, 'Aguascalientes', 2, '1'),
(18, 'San Francisco de los Romo', 2, '1'),
(19, 'El Llano', 2, '1'),
(20, 'Rincón de Romos', 2, '1'),
(21, 'Cosío', 2, '1'),
(22, 'San José de Gracia', 2, '1'),
(23, 'Tepezalá', 2, '1'),
(24, 'Pabellón de Arteaga', 2, '1'),
(25, 'Asientos', 2, '1'),
(26, 'Calvillo', 2, '1'),
(27, 'Jesús María', 2, '1'),
(28, 'Mexicali', 3, '1'),
(29, 'Tecate', 3, '1'),
(30, 'San Felipe', 3, '1'),
(31, 'Tijuana', 3, '1'),
(32, 'Playas de Rosarito', 3, '1'),
(33, 'Ensenada', 3, '1'),
(34, 'San Quintín', 3, '1'),
(35, 'La Paz', 4, '1'),
(36, 'Los Cabos', 4, '1'),
(37, 'Comondú', 4, '1'),
(38, 'Loreto', 4, '1'),
(39, 'Mulegé', 4, '1'),
(40, 'Campeche', 5, '1'),
(41, 'Carmen', 5, '1'),
(42, 'Palizada', 5, '1'),
(43, 'Candelaria', 5, '1'),
(44, 'Escárcega', 5, '1'),
(45, 'Champotón', 5, '1'),
(46, 'Seybaplaya', 5, '1'),
(47, 'Hopelchén', 5, '1'),
(48, 'Calakmul', 5, '1'),
(49, 'Tenabo', 5, '1'),
(50, 'Hecelchakán', 5, '1'),
(51, 'Calkiní', 5, '1'),
(52, 'Dzitbalché', 5, '1'),
(53, 'Saltillo', 6, '1'),
(54, 'Arteaga', 6, '1'),
(55, 'Juárez', 6, '1'),
(56, 'Progreso', 6, '1'),
(57, 'Escobedo', 6, '1'),
(58, 'San Buenaventura', 6, '1'),
(59, 'Abasolo', 6, '1'),
(60, 'Candela', 6, '1'),
(61, 'Frontera', 6, '1'),
(62, 'Monclova', 6, '1'),
(63, 'Castaños', 6, '1'),
(64, 'Ramos Arizpe', 6, '1'),
(65, 'General Cepeda', 6, '1'),
(66, 'Piedras Negras', 6, '1'),
(67, 'Nava', 6, '1'),
(68, 'Acuña', 6, '1'),
(69, 'Múzquiz', 6, '1'),
(70, 'Jiménez', 6, '1'),
(71, 'Zaragoza', 6, '1'),
(72, 'Morelos', 6, '1'),
(73, 'Allende', 6, '1'),
(74, 'Villa Unión', 6, '1'),
(75, 'Guerrero', 6, '1'),
(76, 'Hidalgo', 6, '1'),
(77, 'Sabinas', 6, '1'),
(78, 'San Juan de Sabinas', 6, '1'),
(79, 'Torreón', 6, '1'),
(80, 'Matamoros', 6, '1'),
(81, 'Viesca', 6, '1'),
(82, 'Ocampo', 6, '1'),
(83, 'Nadadores', 6, '1'),
(84, 'Sierra Mojada', 6, '1'),
(85, 'Cuatro Ciénegas', 6, '1'),
(86, 'Lamadrid', 6, '1'),
(87, 'Sacramento', 6, '1'),
(88, 'San Pedro', 6, '1'),
(89, 'Francisco I. Madero', 6, '1'),
(90, 'Parras', 6, '1'),
(91, 'Colima', 7, '1'),
(92, 'Tecomán', 7, '1'),
(93, 'Manzanillo', 7, '1'),
(94, 'Armería', 7, '1'),
(95, 'Coquimatlán', 7, '1'),
(96, 'Comala', 7, '1'),
(97, 'Cuauhtémoc', 7, '1'),
(98, 'Ixtlahuacán', 7, '1'),
(99, 'Minatitlán', 7, '1'),
(100, 'Villa de Álvarez', 7, '1'),
(101, 'Tuxtla Gutiérrez', 8, '1'),
(102, 'San Fernando', 8, '1'),
(103, 'Berriozábal', 8, '1'),
(104, 'Ocozocoautla de Espinosa', 8, '1'),
(105, 'Suchiapa', 8, '1'),
(106, 'Chiapa de Corzo', 8, '1'),
(107, 'Osumacinta', 8, '1'),
(108, 'San Cristóbal de las Casas', 8, '1'),
(109, 'Chamula', 8, '1'),
(110, 'Ixtapa', 8, '1'),
(111, 'Zinacantán', 8, '1'),
(112, 'Acala', 8, '1'),
(113, 'Emiliano Zapata', 8, '1'),
(114, 'Chiapilla', 8, '1'),
(115, 'San Lucas', 8, '1'),
(116, 'Teopisca', 8, '1'),
(117, 'Amatenango del Valle', 8, '1'),
(118, 'Chanal', 8, '1'),
(119, 'Oxchuc', 8, '1'),
(120, 'Huixtán', 8, '1'),
(121, 'Tenejapa', 8, '1'),
(122, 'Mitontic', 8, '1'),
(123, 'Reforma', 8, '1'),
(124, 'Juárez', 8, '1'),
(125, 'Pichucalco', 8, '1'),
(126, 'Sunuapa', 8, '1'),
(127, 'Ostuacán', 8, '1'),
(128, 'Francisco León', 8, '1'),
(129, 'Ixtacomitán', 8, '1'),
(130, 'Solosuchiapa', 8, '1'),
(131, 'Ixtapangajoya', 8, '1'),
(132, 'Mezcalapa', 8, '1'),
(133, 'Tecpatán', 8, '1'),
(134, 'Copainalá', 8, '1'),
(135, 'Chicoasén', 8, '1'),
(136, 'Coapilla', 8, '1'),
(137, 'Pantepec', 8, '1'),
(138, 'Tapalapa', 8, '1'),
(139, 'Ocotepec', 8, '1'),
(140, 'Chapultenango', 8, '1'),
(141, 'Amatán', 8, '1'),
(142, 'Huitiupán', 8, '1'),
(143, 'Ixhuatán', 8, '1'),
(144, 'Tapilula', 8, '1'),
(145, 'Rayón', 8, '1'),
(146, 'Pueblo Nuevo Solistahuacán', 8, '1'),
(147, 'Rincón Chamula San Pedro', 8, '1'),
(148, 'Jitotol', 8, '1'),
(149, 'Bochil', 8, '1'),
(150, 'Soyaló', 8, '1'),
(151, 'San Juan Cancuc', 8, '1'),
(152, 'Sabanilla', 8, '1'),
(153, 'Simojovel', 8, '1'),
(154, 'San Andrés Duraznal', 8, '1'),
(155, 'El Bosque', 8, '1'),
(156, 'Chalchihuitán', 8, '1'),
(157, 'Larráinzar', 8, '1'),
(158, 'Santiago el Pinar', 8, '1'),
(159, 'Chenalhó', 8, '1'),
(160, 'Aldama', 8, '1'),
(161, 'Pantelhó', 8, '1'),
(162, 'Sitalá', 8, '1'),
(163, 'Salto de Agua', 8, '1'),
(164, 'Tila', 8, '1'),
(165, 'Tumbalá', 8, '1'),
(166, 'Yajalón', 8, '1'),
(167, 'Ocosingo', 8, '1'),
(168, 'Chilón', 8, '1'),
(169, 'Benemérito de las Américas', 8, '1'),
(170, 'Marqués de Comillas', 8, '1'),
(171, 'Palenque', 8, '1'),
(172, 'La Libertad', 8, '1'),
(173, 'Catazajá', 8, '1'),
(174, 'Comitán de Domínguez', 8, '1'),
(175, 'Tzimol', 8, '1'),
(176, 'Chicomuselo', 8, '1'),
(177, 'Bella Vista', 8, '1'),
(178, 'Frontera Comalapa', 8, '1'),
(179, 'La Trinitaria', 8, '1'),
(180, 'La Independencia', 8, '1'),
(181, 'Maravilla Tenejapa', 8, '1'),
(182, 'Las Margaritas', 8, '1'),
(183, 'Altamirano', 8, '1'),
(184, 'Venustiano Carranza', 8, '1'),
(185, 'Totolapa', 8, '1'),
(186, 'Nicolás Ruíz', 8, '1'),
(187, 'Las Rosas', 8, '1'),
(188, 'La Concordia', 8, '1'),
(189, 'Ángel Albino Corzo', 8, '1'),
(190, 'Montecristo de Guerrero', 8, '1'),
(191, 'Socoltenango', 8, '1'),
(192, 'Cintalapa de Figueroa', 8, '1'),
(193, 'Jiquipilas', 8, '1'),
(194, 'Arriaga', 8, '1'),
(195, 'Villaflores', 8, '1'),
(196, 'Tonalá', 8, '1'),
(197, 'Villa Corzo', 8, '1'),
(198, 'El Parral', 8, '1'),
(199, 'Pijijiapan', 8, '1'),
(200, 'Mapastepec', 8, '1'),
(201, 'Acapetahua', 8, '1'),
(202, 'Acacoyagua', 8, '1'),
(203, 'Escuintla', 8, '1'),
(204, 'Villa Comaltitlán', 8, '1'),
(205, 'Huixtla', 8, '1'),
(206, 'Mazatán', 8, '1'),
(207, 'Huehuetán', 8, '1'),
(208, 'Tuzantán', 8, '1'),
(209, 'Tapachula', 8, '1'),
(210, 'Suchiate', 8, '1'),
(211, 'Frontera Hidalgo', 8, '1'),
(212, 'Metapa', 8, '1'),
(213, 'Tuxtla Chico', 8, '1'),
(214, 'Unión Juárez', 8, '1'),
(215, 'Cacahoatán', 8, '1'),
(216, 'Motozintla', 8, '1'),
(217, 'Mazapa de Madero', 8, '1'),
(218, 'Amatenango de la Frontera', 8, '1'),
(219, 'Bejucal de Ocampo', 8, '1'),
(220, 'La Grandeza', 8, '1'),
(221, 'El Porvenir', 8, '1'),
(222, 'Siltepec', 8, '1'),
(223, 'Honduras de la Sierra', 8, '1'),
(224, 'Capitán Luis Ángel Vidal', 8, '1'),
(225, 'Chihuahua', 9, '1'),
(226, 'Cuauhtémoc', 9, '1'),
(227, 'Riva Palacio', 9, '1'),
(228, 'Aquiles Serdán', 9, '1'),
(229, 'Bachíniva', 9, '1'),
(230, 'Guerrero', 9, '1'),
(231, 'Nuevo Casas Grandes', 9, '1'),
(232, 'Ascensión', 9, '1'),
(233, 'Janos', 9, '1'),
(234, 'Casas Grandes', 9, '1'),
(235, 'Galeana', 9, '1'),
(236, 'Buenaventura', 9, '1'),
(237, 'Gómez Farías', 9, '1'),
(238, 'Ignacio Zaragoza', 9, '1'),
(239, 'Madera', 9, '1'),
(240, 'Namiquipa', 9, '1'),
(241, 'Temósachic', 9, '1'),
(242, 'Matachí', 9, '1'),
(243, 'Juárez', 9, '1'),
(244, 'Guadalupe', 9, '1'),
(245, 'Praxedis G. Guerrero', 9, '1'),
(246, 'Ahumada', 9, '1'),
(247, 'Coyame del Sotol', 9, '1'),
(248, 'Ojinaga', 9, '1'),
(249, 'Aldama', 9, '1'),
(250, 'Julimes', 9, '1'),
(251, 'Manuel Benavides', 9, '1'),
(252, 'Delicias', 9, '1'),
(253, 'Rosales', 9, '1'),
(254, 'Meoqui', 9, '1'),
(255, 'Dr. Belisario Domínguez', 9, '1'),
(256, 'Satevó', 9, '1'),
(257, 'San Francisco de Borja', 9, '1'),
(258, 'Nonoava', 9, '1'),
(259, 'Guachochi', 9, '1'),
(260, 'Bocoyna', 9, '1'),
(261, 'Cusihuiriachi', 9, '1'),
(262, 'Gran Morelos', 9, '1'),
(263, 'Santa Isabel', 9, '1'),
(264, 'Carichí', 9, '1'),
(265, 'Uruachi', 9, '1'),
(266, 'Ocampo', 9, '1'),
(267, 'Moris', 9, '1'),
(268, 'Chínipas', 9, '1'),
(269, 'Maguarichi', 9, '1'),
(270, 'Guazapares', 9, '1'),
(271, 'Batopilas de Manuel Gómez Morín', 9, '1'),
(272, 'Urique', 9, '1'),
(273, 'Morelos', 9, '1'),
(274, 'Guadalupe y Calvo', 9, '1'),
(275, 'San Francisco del Oro', 9, '1'),
(276, 'Rosario', 9, '1'),
(277, 'Huejotitán', 9, '1'),
(278, 'El Tule', 9, '1'),
(279, 'Balleza', 9, '1'),
(280, 'Santa Bárbara', 9, '1'),
(281, 'Camargo', 9, '1'),
(282, 'Saucillo', 9, '1'),
(283, 'Valle de Zaragoza', 9, '1'),
(284, 'La Cruz', 9, '1'),
(285, 'San Francisco de Conchos', 9, '1'),
(286, 'Hidalgo del Parral', 9, '1'),
(287, 'Allende', 9, '1'),
(288, 'López', 9, '1'),
(289, 'Matamoros', 9, '1'),
(290, 'Jiménez', 9, '1'),
(291, 'Coronado', 9, '1'),
(292, 'Durango', 10, '1'),
(293, 'Canatlán', 10, '1'),
(294, 'Nuevo Ideal', 10, '1'),
(295, 'Coneto de Comonfort', 10, '1'),
(296, 'San Juan del Río', 10, '1'),
(297, 'Canelas', 10, '1'),
(298, 'Topia', 10, '1'),
(299, 'Tamazula', 10, '1'),
(300, 'Santiago Papasquiaro', 10, '1'),
(301, 'Otáez', 10, '1'),
(302, 'San Dimas', 10, '1'),
(303, 'Guadalupe Victoria', 10, '1'),
(304, 'Peñón Blanco', 10, '1'),
(305, 'Pánuco de Coronado', 10, '1'),
(306, 'Poanas', 10, '1'),
(307, 'Nombre de Dios', 10, '1'),
(308, 'Vicente Guerrero', 10, '1'),
(309, 'Súchil', 10, '1'),
(310, 'Pueblo Nuevo', 10, '1'),
(311, 'Mezquital', 10, '1'),
(312, 'Gómez Palacio', 10, '1'),
(313, 'Lerdo', 10, '1'),
(314, 'Mapimí', 10, '1'),
(315, 'Tlahualilo', 10, '1'),
(316, 'Hidalgo', 10, '1'),
(317, 'Ocampo', 10, '1'),
(318, 'Guanaceví', 10, '1'),
(319, 'San Bernardo', 10, '1'),
(320, 'Indé', 10, '1'),
(321, 'San Pedro del Gallo', 10, '1'),
(322, 'Tepehuanes', 10, '1'),
(323, 'El Oro', 10, '1'),
(324, 'Nazas', 10, '1'),
(325, 'San Luis del Cordero', 10, '1'),
(326, 'Rodeo', 10, '1'),
(327, 'Cuencamé', 10, '1'),
(328, 'Santa Clara', 10, '1'),
(329, 'San Juan de Guadalupe', 10, '1'),
(330, 'General Simón Bolívar', 10, '1'),
(331, 'Guanajuato', 11, '1'),
(332, 'Silao de la Victoria', 11, '1'),
(333, 'Romita', 11, '1'),
(334, 'San Francisco del Rincón', 11, '1'),
(335, 'Purísima del Rincón', 11, '1'),
(336, 'Manuel Doblado', 11, '1'),
(337, 'Irapuato', 11, '1'),
(338, 'Salamanca', 11, '1'),
(339, 'Pueblo Nuevo', 11, '1'),
(340, 'Pénjamo', 11, '1'),
(341, 'Cuerámaro', 11, '1'),
(342, 'Abasolo', 11, '1'),
(343, 'Huanímaro', 11, '1'),
(344, 'León', 11, '1'),
(345, 'San Felipe', 11, '1'),
(346, 'Ocampo', 11, '1'),
(347, 'San Miguel de Allende', 11, '1'),
(348, 'Dolores Hidalgo Cuna de la Independencia Nacional', 11, '1'),
(349, 'San Diego de la Unión', 11, '1'),
(350, 'San Luis de la Paz', 11, '1'),
(351, 'Victoria', 11, '1'),
(352, 'Xichú', 11, '1'),
(353, 'Atarjea', 11, '1'),
(354, 'Santa Catarina', 11, '1'),
(355, 'Doctor Mora', 11, '1'),
(356, 'Tierra Blanca', 11, '1'),
(357, 'San José Iturbide', 11, '1'),
(358, 'Celaya', 11, '1'),
(359, 'Apaseo el Grande', 11, '1'),
(360, 'Comonfort', 11, '1'),
(361, 'Santa Cruz de Juventino Rosas', 11, '1'),
(362, 'Villagrán', 11, '1'),
(363, 'Cortazar', 11, '1'),
(364, 'Valle de Santiago', 11, '1'),
(365, 'Jaral del Progreso', 11, '1'),
(366, 'Apaseo el Alto', 11, '1'),
(367, 'Jerécuaro', 11, '1'),
(368, 'Coroneo', 11, '1'),
(369, 'Acámbaro', 11, '1'),
(370, 'Tarimoro', 11, '1'),
(371, 'Tarandacuao', 11, '1'),
(372, 'Moroleón', 11, '1'),
(373, 'Salvatierra', 11, '1'),
(374, 'Yuriria', 11, '1'),
(375, 'Santiago Maravatío', 11, '1'),
(376, 'Uriangato', 11, '1'),
(377, 'Chilpancingo de los Bravo', 12, '1'),
(378, 'General Heliodoro Castillo', 12, '1'),
(379, 'Leonardo Bravo', 12, '1'),
(380, 'Tixtla de Guerrero', 12, '1'),
(381, 'Ayutla de los Libres', 12, '1'),
(382, 'Ñuu Savi', 12, '1'),
(383, 'Mochitlán', 12, '1'),
(384, 'Quechultenango', 12, '1'),
(385, 'Tecoanapa', 12, '1'),
(386, 'Acapulco de Juárez', 12, '1'),
(387, 'Juan R. Escudero', 12, '1'),
(388, 'San Marcos', 12, '1'),
(389, 'Las Vigas', 12, '1'),
(390, 'Iguala de la Independencia', 12, '1'),
(391, 'Huitzuco de los Figueroa', 12, '1'),
(392, 'Tepecoacuilco de Trujano', 12, '1'),
(393, 'Eduardo Neri', 12, '1'),
(394, 'Taxco de Alarcón', 12, '1'),
(395, 'Buenavista de Cuéllar', 12, '1'),
(396, 'Tetipac', 12, '1'),
(397, 'Pilcaya', 12, '1'),
(398, 'Teloloapan', 12, '1'),
(399, 'Ixcateopan de Cuauhtémoc', 12, '1'),
(400, 'Pedro Ascencio Alquisiras', 12, '1'),
(401, 'General Canuto A. Neri', 12, '1'),
(402, 'Arcelia', 12, '1'),
(403, 'Apaxtla', 12, '1'),
(404, 'Cuetzala del Progreso', 12, '1'),
(405, 'Cocula', 12, '1'),
(406, 'Tlapehuala', 12, '1'),
(407, 'Cutzamala de Pinzón', 12, '1'),
(408, 'Pungarabato', 12, '1'),
(409, 'Tlalchapa', 12, '1'),
(410, 'Coyuca de Catalán', 12, '1'),
(411, 'Ajuchitlán del Progreso', 12, '1'),
(412, 'Zirándaro', 12, '1'),
(413, 'San Miguel Totolapan', 12, '1'),
(414, 'La Unión de Isidoro Montes de Oca', 12, '1'),
(415, 'Petatlán', 12, '1'),
(416, 'Coahuayutla de José María Izazaga', 12, '1'),
(417, 'Zihuatanejo de Azueta', 12, '1'),
(418, 'Técpan de Galeana', 12, '1'),
(419, 'Atoyac de Álvarez', 12, '1'),
(420, 'Benito Juárez', 12, '1'),
(421, 'Coyuca de Benítez', 12, '1'),
(422, 'Olinalá', 12, '1'),
(423, 'Atenango del Río', 12, '1'),
(424, 'Copalillo', 12, '1'),
(425, 'Cualác', 12, '1'),
(426, 'Chilapa de Álvarez', 12, '1'),
(427, 'José Joaquín de Herrera', 12, '1'),
(428, 'Ahuacuotzingo', 12, '1'),
(429, 'Zitlala', 12, '1'),
(430, 'Mártir de Cuilapan', 12, '1'),
(431, 'Huamuxtitlán', 12, '1'),
(432, 'Xochihuehuetlán', 12, '1'),
(433, 'Alpoyeca', 12, '1'),
(434, 'Tlapa de Comonfort', 12, '1'),
(435, 'Tlalixtaquilla de Maldonado', 12, '1'),
(436, 'Xalpatláhuac', 12, '1'),
(437, 'Zapotitlán Tablas', 12, '1'),
(438, 'Acatepec', 12, '1'),
(439, 'Atlixtac', 12, '1'),
(440, 'Copanatoyac', 12, '1'),
(441, 'Malinaltepec', 12, '1'),
(442, 'Santa Cruz del Rincón', 12, '1'),
(443, 'Iliatenco', 12, '1'),
(444, 'Tlacoapa', 12, '1'),
(445, 'Atlamajalcingo del Monte', 12, '1'),
(446, 'San Luis Acatlán', 12, '1'),
(447, 'Metlatónoc', 12, '1'),
(448, 'Cochoapa el Grande', 12, '1'),
(449, 'Alcozauca de Guerrero', 12, '1'),
(450, 'Ometepec', 12, '1'),
(451, 'Tlacoachistlahuaca', 12, '1'),
(452, 'Xochistlahuaca', 12, '1'),
(453, 'Florencio Villarreal', 12, '1'),
(454, 'Cuautepec', 12, '1'),
(455, 'Copala', 12, '1'),
(456, 'Azoyú', 12, '1'),
(457, 'Juchitán', 12, '1'),
(458, 'Marquelia', 12, '1'),
(459, 'Cuajinicuilapa', 12, '1'),
(460, 'San Nicolás', 12, '1'),
(461, 'Igualapa', 12, '1'),
(462, 'Pachuca de Soto', 13, '1'),
(463, 'Mineral del Chico', 13, '1'),
(464, 'Mineral del Monte', 13, '1'),
(465, 'Ajacuba', 13, '1'),
(466, 'San Agustín Tlaxiaca', 13, '1'),
(467, 'Mineral de la Reforma', 13, '1'),
(468, 'Zapotlán de Juárez', 13, '1'),
(469, 'Jacala de Ledezma', 13, '1'),
(470, 'Pisaflores', 13, '1'),
(471, 'Pacula', 13, '1'),
(472, 'La Misión', 13, '1'),
(473, 'Chapulhuacán', 13, '1'),
(474, 'Ixmiquilpan', 13, '1'),
(475, 'Zimapán', 13, '1'),
(476, 'Nicolás Flores', 13, '1'),
(477, 'Cardonal', 13, '1'),
(478, 'Tasquillo', 13, '1'),
(479, 'Alfajayucan', 13, '1'),
(480, 'Huichapan', 13, '1'),
(481, 'Tecozautla', 13, '1'),
(482, 'Nopala de Villagrán', 13, '1'),
(483, 'Actopan', 13, '1'),
(484, 'Santiago de Anaya', 13, '1'),
(485, 'San Salvador', 13, '1'),
(486, 'Francisco I. Madero', 13, '1'),
(487, 'El Arenal', 13, '1'),
(488, 'Mixquiahuala de Juárez', 13, '1'),
(489, 'Progreso de Obregón', 13, '1'),
(490, 'Chilcuautla', 13, '1'),
(491, 'Tezontepec de Aldama', 13, '1'),
(492, 'Tlahuelilpan', 13, '1'),
(493, 'Tula de Allende', 13, '1'),
(494, 'Tepeji del Río de Ocampo', 13, '1'),
(495, 'Chapantongo', 13, '1'),
(496, 'Tepetitlán', 13, '1'),
(497, 'Tetepango', 13, '1'),
(498, 'Tlaxcoapan', 13, '1'),
(499, 'Atitalaquia', 13, '1'),
(500, 'Atotonilco de Tula', 13, '1'),
(501, 'Huejutla de Reyes', 13, '1'),
(502, 'San Felipe Orizatlán', 13, '1'),
(503, 'Jaltocán', 13, '1'),
(504, 'Huautla', 13, '1'),
(505, 'Atlapexco', 13, '1'),
(506, 'Huazalingo', 13, '1'),
(507, 'Yahualica', 13, '1'),
(508, 'Xochiatipan', 13, '1'),
(509, 'Molango de Escamilla', 13, '1'),
(510, 'Tepehuacán de Guerrero', 13, '1'),
(511, 'Lolotla', 13, '1'),
(512, 'Tlanchinol', 13, '1'),
(513, 'Tlahuiltepa', 13, '1'),
(514, 'Juárez Hidalgo', 13, '1'),
(515, 'Zacualtipán de Ángeles', 13, '1'),
(516, 'Calnali', 13, '1'),
(517, 'Xochicoatlán', 13, '1'),
(518, 'Tianguistengo', 13, '1'),
(519, 'Atotonilco el Grande', 13, '1'),
(520, 'Eloxochitlán', 13, '1'),
(521, 'Metztitlán', 13, '1'),
(522, 'San Agustín Metzquititlán', 13, '1'),
(523, 'Metepec', 13, '1'),
(524, 'Huehuetla', 13, '1'),
(525, 'San Bartolo Tutotepec', 13, '1'),
(526, 'Agua Blanca de Iturbide', 13, '1'),
(527, 'Tenango de Doria', 13, '1'),
(528, 'Huasca de Ocampo', 13, '1'),
(529, 'Acatlán', 13, '1'),
(530, 'Omitlán de Juárez', 13, '1'),
(531, 'Epazoyucan', 13, '1'),
(532, 'Tulancingo de Bravo', 13, '1'),
(533, 'Acaxochitlán', 13, '1'),
(534, 'Cuautepec de Hinojosa', 13, '1'),
(535, 'Santiago Tulantepec de Lugo Guerrero', 13, '1'),
(536, 'Singuilucan', 13, '1'),
(537, 'Tizayuca', 13, '1'),
(538, 'Zempoala', 13, '1'),
(539, 'Tolcayuca', 13, '1'),
(540, 'Villa de Tezontepec', 13, '1'),
(541, 'Apan', 13, '1'),
(542, 'Tlanalapa', 13, '1'),
(543, 'Almoloya', 13, '1'),
(544, 'Emiliano Zapata', 13, '1'),
(545, 'Tepeapulco', 13, '1'),
(546, 'Guadalajara', 14, '1'),
(547, 'Zapopan', 14, '1'),
(548, 'San Cristóbal de la Barranca', 14, '1'),
(549, 'Ixtlahuacán del Río', 14, '1'),
(550, 'Tala', 14, '1'),
(551, 'El Arenal', 14, '1'),
(552, 'Amatitán', 14, '1'),
(553, 'Tonalá', 14, '1'),
(554, 'Zapotlanejo', 14, '1'),
(555, 'Acatic', 14, '1'),
(556, 'Cuquío', 14, '1'),
(557, 'San Pedro Tlaquepaque', 14, '1'),
(558, 'Tlajomulco de Zúñiga', 14, '1'),
(559, 'El Salto', 14, '1'),
(560, 'Acatlán de Juárez', 14, '1'),
(561, 'Villa Corona', 14, '1'),
(562, 'Zacoalco de Torres', 14, '1'),
(563, 'Atemajac de Brizuela', 14, '1'),
(564, 'Jocotepec', 14, '1'),
(565, 'Ixtlahuacán de los Membrillos', 14, '1'),
(566, 'Juanacatlán', 14, '1'),
(567, 'Chapala', 14, '1'),
(568, 'Poncitlán', 14, '1'),
(569, 'Zapotlán del Rey', 14, '1'),
(570, 'Huejuquilla el Alto', 14, '1'),
(571, 'Mezquitic', 14, '1'),
(572, 'Villa Guerrero', 14, '1'),
(573, 'Bolaños', 14, '1'),
(574, 'Totatiche', 14, '1'),
(575, 'Colotlán', 14, '1'),
(576, 'Santa María de los Ángeles', 14, '1'),
(577, 'Huejúcar', 14, '1'),
(578, 'Chimaltitán', 14, '1'),
(579, 'San Martín de Bolaños', 14, '1'),
(580, 'Tequila', 14, '1'),
(581, 'Hostotipaquillo', 14, '1'),
(582, 'Magdalena', 14, '1'),
(583, 'Etzatlán', 14, '1'),
(584, 'San Marcos', 14, '1'),
(585, 'San Juanito de Escobedo', 14, '1'),
(586, 'Ameca', 14, '1'),
(587, 'Ahualulco de Mercado', 14, '1'),
(588, 'Teuchitlán', 14, '1'),
(589, 'San Martín Hidalgo', 14, '1'),
(590, 'Guachinango', 14, '1'),
(591, 'Mixtlán', 14, '1'),
(592, 'Mascota', 14, '1'),
(593, 'San Sebastián del Oeste', 14, '1'),
(594, 'San Juan de los Lagos', 14, '1'),
(595, 'Jalostotitlán', 14, '1'),
(596, 'San Miguel el Alto', 14, '1'),
(597, 'San Julián', 14, '1'),
(598, 'Arandas', 14, '1'),
(599, 'San Ignacio Cerro Gordo', 14, '1'),
(600, 'Teocaltiche', 14, '1'),
(601, 'Villa Hidalgo', 14, '1'),
(602, 'Encarnación de Díaz', 14, '1'),
(603, 'Yahualica de González Gallo', 14, '1'),
(604, 'Mexticacán', 14, '1'),
(605, 'Cañadas de Obregón', 14, '1'),
(606, 'Valle de Guadalupe', 14, '1'),
(607, 'Lagos de Moreno', 14, '1'),
(608, 'Ojuelos de Jalisco', 14, '1'),
(609, 'Unión de San Antonio', 14, '1'),
(610, 'San Diego de Alejandría', 14, '1'),
(611, 'Tepatitlán de Morelos', 14, '1'),
(612, 'Tototlán', 14, '1'),
(613, 'Atotonilco el Alto', 14, '1'),
(614, 'Ocotlán', 14, '1'),
(615, 'Jamay', 14, '1'),
(616, 'La Barca', 14, '1'),
(617, 'Ayotlán', 14, '1'),
(618, 'Jesús María', 14, '1'),
(619, 'Degollado', 14, '1'),
(620, 'Unión de Tula', 14, '1'),
(621, 'Ayutla', 14, '1'),
(622, 'Atenguillo', 14, '1'),
(623, 'Cuautla', 14, '1'),
(624, 'Atengo', 14, '1'),
(625, 'Talpa de Allende', 14, '1'),
(626, 'Puerto Vallarta', 14, '1'),
(627, 'Cabo Corrientes', 14, '1'),
(628, 'Tomatlán', 14, '1'),
(629, 'Cocula', 14, '1'),
(630, 'Tecolotlán', 14, '1'),
(631, 'Tenamaxtlán', 14, '1'),
(632, 'Juchitlán', 14, '1'),
(633, 'Chiquilistlán', 14, '1'),
(634, 'Ejutla', 14, '1'),
(635, 'El Limón', 14, '1'),
(636, 'El Grullo', 14, '1'),
(637, 'Tonaya', 14, '1'),
(638, 'Tuxcacuesco', 14, '1'),
(639, 'Villa Purificación', 14, '1'),
(640, 'La Huerta', 14, '1'),
(641, 'Autlán de Navarro', 14, '1'),
(642, 'Casimiro Castillo', 14, '1'),
(643, 'Cuautitlán de García Barragán', 14, '1'),
(644, 'Cihuatlán', 14, '1'),
(645, 'Zapotlán el Grande', 14, '1'),
(646, 'Gómez Farías', 14, '1'),
(647, 'Concepción de Buenos Aires', 14, '1'),
(648, 'Atoyac', 14, '1'),
(649, 'Techaluta de Montenegro', 14, '1'),
(650, 'Teocuitatlán de Corona', 14, '1'),
(651, 'Sayula', 14, '1'),
(652, 'Tapalpa', 14, '1'),
(653, 'Amacueca', 14, '1'),
(654, 'Tizapán el Alto', 14, '1'),
(655, 'Tuxcueca', 14, '1'),
(656, 'La Manzanilla de la Paz', 14, '1'),
(657, 'Mazamitla', 14, '1'),
(658, 'Valle de Juárez', 14, '1'),
(659, 'Quitupan', 14, '1'),
(660, 'Zapotiltic', 14, '1'),
(661, 'Tamazula de Gordiano', 14, '1'),
(662, 'San Gabriel', 14, '1'),
(663, 'Tolimán', 14, '1'),
(664, 'Zapotitlán de Vadillo', 14, '1'),
(665, 'Tuxpan', 14, '1'),
(666, 'Tonila', 14, '1'),
(667, 'Pihuamo', 14, '1'),
(668, 'Tecalitlán', 14, '1'),
(669, 'Jilotlán de los Dolores', 14, '1'),
(670, 'Santa María del Oro', 14, '1'),
(671, 'Toluca', 15, '1'),
(672, 'Acambay de Ruíz Castañeda', 15, '1'),
(673, 'Aculco', 15, '1'),
(674, 'Temascalcingo', 15, '1'),
(675, 'Atlacomulco', 15, '1'),
(676, 'Timilpan', 15, '1'),
(677, 'Morelos', 15, '1'),
(678, 'El Oro', 15, '1'),
(679, 'San Felipe del Progreso', 15, '1'),
(680, 'San José del Rincón', 15, '1'),
(681, 'Jocotitlán', 15, '1'),
(682, 'Ixtlahuaca', 15, '1'),
(683, 'Jiquipilco', 15, '1'),
(684, 'Temoaya', 15, '1'),
(685, 'Almoloya de Juárez', 15, '1'),
(686, 'Villa Victoria', 15, '1'),
(687, 'Villa de Allende', 15, '1'),
(688, 'Donato Guerra', 15, '1'),
(689, 'Ixtapan del Oro', 15, '1'),
(690, 'Santo Tomás', 15, '1'),
(691, 'Otzoloapan', 15, '1'),
(692, 'Zacazonapan', 15, '1'),
(693, 'Valle de Bravo', 15, '1'),
(694, 'Amanalco', 15, '1'),
(695, 'Temascaltepec', 15, '1'),
(696, 'Zinacantepec', 15, '1'),
(697, 'Tejupilco', 15, '1'),
(698, 'Luvianos', 15, '1'),
(699, 'San Simón de Guerrero', 15, '1'),
(700, 'Amatepec', 15, '1'),
(701, 'Tlatlaya', 15, '1'),
(702, 'Sultepec', 15, '1'),
(703, 'Texcaltitlán', 15, '1'),
(704, 'Coatepec Harinas', 15, '1'),
(705, 'Villa Guerrero', 15, '1'),
(706, 'Zacualpan', 15, '1'),
(707, 'Almoloya de Alquisiras', 15, '1'),
(708, 'Ixtapan de la Sal', 15, '1'),
(709, 'Tonatico', 15, '1'),
(710, 'Zumpahuacán', 15, '1'),
(711, 'Lerma', 15, '1'),
(712, 'Xonacatlán', 15, '1'),
(713, 'Otzolotepec', 15, '1'),
(714, 'San Mateo Atenco', 15, '1'),
(715, 'Metepec', 15, '1'),
(716, 'Mexicaltzingo', 15, '1'),
(717, 'Calimaya', 15, '1'),
(718, 'Chapultepec', 15, '1'),
(719, 'San Antonio la Isla', 15, '1'),
(720, 'Tenango del Valle', 15, '1'),
(721, 'Rayón', 15, '1'),
(722, 'Joquicingo', 15, '1'),
(723, 'Tenancingo', 15, '1'),
(724, 'Malinalco', 15, '1'),
(725, 'Ocuilan', 15, '1'),
(726, 'Atizapán', 15, '1'),
(727, 'Almoloya del Río', 15, '1'),
(728, 'Texcalyacac', 15, '1'),
(729, 'Tianguistenco', 15, '1'),
(730, 'Xalatlaco', 15, '1'),
(731, 'Capulhuac', 15, '1'),
(732, 'Ocoyoacac', 15, '1'),
(733, 'Huixquilucan', 15, '1'),
(734, 'Atizapán de Zaragoza', 15, '1'),
(735, 'Naucalpan de Juárez', 15, '1'),
(736, 'Tlalnepantla de Baz', 15, '1'),
(737, 'Polotitlán', 15, '1'),
(738, 'Jilotepec', 15, '1'),
(739, 'Soyaniquilpan de Juárez', 15, '1'),
(740, 'Villa del Carbón', 15, '1'),
(741, 'Chapa de Mota', 15, '1'),
(742, 'Nicolás Romero', 15, '1'),
(743, 'Isidro Fabela', 15, '1'),
(744, 'Jilotzingo', 15, '1'),
(745, 'Tepotzotlán', 15, '1'),
(746, 'Coyotepec', 15, '1'),
(747, 'Huehuetoca', 15, '1'),
(748, 'Cuautitlán Izcalli', 15, '1'),
(749, 'Teoloyucan', 15, '1'),
(750, 'Cuautitlán', 15, '1'),
(751, 'Melchor Ocampo', 15, '1'),
(752, 'Tultitlán', 15, '1'),
(753, 'Tultepec', 15, '1'),
(754, 'Ecatepec de Morelos', 15, '1'),
(755, 'Zumpango', 15, '1'),
(756, 'Tequixquiac', 15, '1'),
(757, 'Apaxco', 15, '1'),
(758, 'Hueypoxtla', 15, '1'),
(759, 'Coacalco de Berriozábal', 15, '1'),
(760, 'Tecámac', 15, '1'),
(761, 'Jaltenco', 15, '1'),
(762, 'Tonanitla', 15, '1'),
(763, 'Nextlalpan', 15, '1'),
(764, 'Teotihuacán', 15, '1'),
(765, 'San Martín de las Pirámides', 15, '1'),
(766, 'Acolman', 15, '1'),
(767, 'Otumba', 15, '1'),
(768, 'Axapusco', 15, '1'),
(769, 'Nopaltepec', 15, '1'),
(770, 'Temascalapa', 15, '1'),
(771, 'Tezoyuca', 15, '1'),
(772, 'Chiautla', 15, '1'),
(773, 'Papalotla', 15, '1'),
(774, 'Tepetlaoxtoc', 15, '1'),
(775, 'Texcoco', 15, '1'),
(776, 'Chiconcuac', 15, '1'),
(777, 'Atenco', 15, '1'),
(778, 'Chimalhuacán', 15, '1'),
(779, 'Chicoloapan', 15, '1'),
(780, 'La Paz', 15, '1'),
(781, 'Ixtapaluca', 15, '1'),
(782, 'Chalco', 15, '1'),
(783, 'Valle de Chalco Solidaridad', 15, '1'),
(784, 'Temamatla', 15, '1'),
(785, 'Cocotitlán', 15, '1'),
(786, 'Tlalmanalco', 15, '1'),
(787, 'Ayapango', 15, '1'),
(788, 'Tenango del Aire', 15, '1'),
(789, 'Ozumba', 15, '1'),
(790, 'Juchitepec', 15, '1'),
(791, 'Tepetlixpa', 15, '1'),
(792, 'Amecameca', 15, '1'),
(793, 'Atlautla', 15, '1'),
(794, 'Ecatzingo', 15, '1'),
(795, 'Nezahualcóyotl', 15, '1'),
(796, 'Morelia', 16, '1'),
(797, 'Huaniqueo', 16, '1'),
(798, 'Coeneo', 16, '1'),
(799, 'Quiroga', 16, '1'),
(800, 'Tzintzuntzan', 16, '1'),
(801, 'Lagunillas', 16, '1'),
(802, 'Acuitzio', 16, '1'),
(803, 'Madero', 16, '1'),
(804, 'Puruándiro', 16, '1'),
(805, 'José Sixto Verduzco', 16, '1'),
(806, 'Angamacutiro', 16, '1'),
(807, 'Panindícuaro', 16, '1'),
(808, 'Zacapu', 16, '1'),
(809, 'Tlazazalca', 16, '1'),
(810, 'Purépero', 16, '1'),
(811, 'Jiménez', 16, '1'),
(812, 'Morelos', 16, '1'),
(813, 'Huandacareo', 16, '1'),
(814, 'Cuitzeo', 16, '1'),
(815, 'Chucándiro', 16, '1'),
(816, 'Copándaro', 16, '1'),
(817, 'Tarímbaro', 16, '1'),
(818, 'Santa Ana Maya', 16, '1'),
(819, 'Álvaro Obregón', 16, '1'),
(820, 'Zinapécuaro', 16, '1'),
(821, 'Indaparapeo', 16, '1'),
(822, 'Queréndaro', 16, '1'),
(823, 'Sahuayo', 16, '1'),
(824, 'Briseñas', 16, '1'),
(825, 'Cojumatlán de Régules', 16, '1'),
(826, 'Venustiano Carranza', 16, '1'),
(827, 'Pajacuarán', 16, '1'),
(828, 'Vista Hermosa', 16, '1'),
(829, 'Tanhuato', 16, '1'),
(830, 'Yurécuaro', 16, '1'),
(831, 'Ixtlán', 16, '1'),
(832, 'La Piedad', 16, '1'),
(833, 'Numarán', 16, '1'),
(834, 'Churintzio', 16, '1'),
(835, 'Zináparo', 16, '1'),
(836, 'Penjamillo', 16, '1'),
(837, 'Marcos Castellanos', 16, '1'),
(838, 'Jiquilpan', 16, '1'),
(839, 'Villamar', 16, '1'),
(840, 'Chavinda', 16, '1'),
(841, 'Zamora', 16, '1'),
(842, 'Ecuandureo', 16, '1'),
(843, 'Tangancícuaro', 16, '1'),
(844, 'Chilchota', 16, '1'),
(845, 'Jacona', 16, '1'),
(846, 'Tangamandapio', 16, '1'),
(847, 'Cotija', 16, '1'),
(848, 'Tocumbo', 16, '1'),
(849, 'Tingüindín', 16, '1'),
(850, 'Uruapan', 16, '1'),
(851, 'Charapan', 16, '1'),
(852, 'Paracho', 16, '1'),
(853, 'Cherán', 16, '1'),
(854, 'Nahuatzen', 16, '1'),
(855, 'Tingambato', 16, '1'),
(856, 'Los Reyes', 16, '1'),
(857, 'Peribán', 16, '1'),
(858, 'Tancítaro', 16, '1'),
(859, 'Nuevo Parangaricutiro', 16, '1'),
(860, 'Buenavista', 16, '1'),
(861, 'Tepalcatepec', 16, '1'),
(862, 'Aguililla', 16, '1'),
(863, 'Apatzingán', 16, '1'),
(864, 'Parácuaro', 16, '1'),
(865, 'Coahuayana', 16, '1'),
(866, 'Chinicuila', 16, '1'),
(867, 'Coalcomán de Vázquez Pallares', 16, '1'),
(868, 'Aquila', 16, '1'),
(869, 'Tumbiscatío', 16, '1'),
(870, 'Arteaga', 16, '1'),
(871, 'Lázaro Cárdenas', 16, '1'),
(872, 'Epitacio Huerta', 16, '1'),
(873, 'Contepec', 16, '1'),
(874, 'Tlalpujahua', 16, '1'),
(875, 'Hidalgo', 16, '1'),
(876, 'Maravatío', 16, '1'),
(877, 'Irimbo', 16, '1'),
(878, 'Senguio', 16, '1'),
(879, 'Charo', 16, '1'),
(880, 'Tzitzio', 16, '1'),
(881, 'Tiquicheo de Nicolás Romero', 16, '1'),
(882, 'Aporo', 16, '1'),
(883, 'Angangueo', 16, '1'),
(884, 'Tuxpan', 16, '1'),
(885, 'Ocampo', 16, '1'),
(886, 'Jungapeo', 16, '1'),
(887, 'Zitácuaro', 16, '1'),
(888, 'Tuzantla', 16, '1'),
(889, 'Juárez', 16, '1'),
(890, 'Susupuato', 16, '1'),
(891, 'Pátzcuaro', 16, '1'),
(892, 'Erongarícuaro', 16, '1'),
(893, 'Huiramba', 16, '1'),
(894, 'Tacámbaro', 16, '1'),
(895, 'Turicato', 16, '1'),
(896, 'Ziracuaretiro', 16, '1'),
(897, 'Taretan', 16, '1'),
(898, 'Gabriel Zamora', 16, '1'),
(899, 'Nuevo Urecho', 16, '1'),
(900, 'Múgica', 16, '1'),
(901, 'Salvador Escalante', 16, '1'),
(902, 'Ario', 16, '1'),
(903, 'La Huacana', 16, '1'),
(904, 'Churumuco', 16, '1'),
(905, 'Nocupétaro', 16, '1'),
(906, 'Carácuaro', 16, '1'),
(907, 'Huetamo', 16, '1'),
(908, 'San Lucas', 16, '1'),
(909, 'Cuernavaca', 17, '1'),
(910, 'Huitzilac', 17, '1'),
(911, 'Tepoztlán', 17, '1'),
(912, 'Tlalnepantla', 17, '1'),
(913, 'Tlayacapan', 17, '1'),
(914, 'Jiutepec', 17, '1'),
(915, 'Temixco', 17, '1'),
(916, 'Miacatlán', 17, '1'),
(917, 'Coatetelco', 17, '1'),
(918, 'Coatlán del Río', 17, '1'),
(919, 'Tetecala', 17, '1'),
(920, 'Mazatepec', 17, '1'),
(921, 'Amacuzac', 17, '1'),
(922, 'Puente de Ixtla', 17, '1'),
(923, 'Xoxocotla', 17, '1'),
(924, 'Ayala', 17, '1'),
(925, 'Yautepec', 17, '1'),
(926, 'Cuautla', 17, '1'),
(927, 'Emiliano Zapata', 17, '1'),
(928, 'Tlaltizapán de Zapata', 17, '1'),
(929, 'Zacatepec', 17, '1'),
(930, 'Xochitepec', 17, '1'),
(931, 'Tetela del Volcán', 17, '1'),
(932, 'Hueyapan', 17, '1'),
(933, 'Yecapixtla', 17, '1'),
(934, 'Totolapan', 17, '1'),
(935, 'Atlatlahucan', 17, '1'),
(936, 'Ocuituco', 17, '1'),
(937, 'Temoac', 17, '1'),
(938, 'Zacualpan de Amilpas', 17, '1'),
(939, 'Jojutla', 17, '1'),
(940, 'Tepalcingo', 17, '1'),
(941, 'Jonacatepec de Leandro Valle', 17, '1'),
(942, 'Axochiapan', 17, '1'),
(943, 'Jantetelco', 17, '1'),
(944, 'Tlaquiltenango', 17, '1'),
(945, 'Tepic', 18, '1'),
(946, 'Tuxpan', 18, '1'),
(947, 'Santiago Ixcuintla', 18, '1'),
(948, 'Acaponeta', 18, '1'),
(949, 'Tecuala', 18, '1'),
(950, 'Huajicori', 18, '1'),
(951, 'Del Nayar', 18, '1'),
(952, 'La Yesca', 18, '1'),
(953, 'Ruíz', 18, '1'),
(954, 'Rosamorada', 18, '1'),
(955, 'Compostela', 18, '1'),
(956, 'Bahía de Banderas', 18, '1'),
(957, 'San Blas', 18, '1'),
(958, 'Xalisco', 18, '1'),
(959, 'San Pedro Lagunillas', 18, '1'),
(960, 'Santa María del Oro', 18, '1'),
(961, 'Jala', 18, '1'),
(962, 'Ahuacatlán', 18, '1'),
(963, 'Ixtlán del Río', 18, '1'),
(964, 'Amatlán de Cañas', 18, '1'),
(965, 'Monterrey', 19, '1'),
(966, 'Anáhuac', 19, '1'),
(967, 'Lampazos de Naranjo', 19, '1'),
(968, 'Mina', 19, '1'),
(969, 'Bustamante', 19, '1'),
(970, 'Sabinas Hidalgo', 19, '1'),
(971, 'Villaldama', 19, '1'),
(972, 'Vallecillo', 19, '1'),
(973, 'Parás', 19, '1'),
(974, 'Salinas Victoria', 19, '1'),
(975, 'Ciénega de Flores', 19, '1'),
(976, 'Hidalgo', 19, '1'),
(977, 'Abasolo', 19, '1'),
(978, 'Higueras', 19, '1'),
(979, 'General Zuazua', 19, '1'),
(980, 'Agualeguas', 19, '1'),
(981, 'General Treviño', 19, '1'),
(982, 'Cerralvo', 19, '1'),
(983, 'Melchor Ocampo', 19, '1'),
(984, 'García', 19, '1'),
(985, 'General Escobedo', 19, '1'),
(986, 'Santa Catarina', 19, '1'),
(987, 'San Pedro Garza García', 19, '1'),
(988, 'San Nicolás de los Garza', 19, '1'),
(989, 'El Carmen', 19, '1'),
(990, 'Apodaca', 19, '1'),
(991, 'Pesquería', 19, '1'),
(992, 'Marín', 19, '1'),
(993, 'Doctor González', 19, '1'),
(994, 'Los Ramones', 19, '1'),
(995, 'Los Herreras', 19, '1'),
(996, 'Los Aldamas', 19, '1'),
(997, 'Doctor Coss', 19, '1'),
(998, 'General Bravo', 19, '1'),
(999, 'China', 19, '1'),
(1000, 'Guadalupe', 19, '1'),
(1001, 'Juárez', 19, '1'),
(1002, 'Santiago', 19, '1'),
(1003, 'Allende', 19, '1'),
(1004, 'General Terán', 19, '1'),
(1005, 'Cadereyta Jiménez', 19, '1'),
(1006, 'Montemorelos', 19, '1'),
(1007, 'Rayones', 19, '1'),
(1008, 'Linares', 19, '1'),
(1009, 'Iturbide', 19, '1'),
(1010, 'Galeana', 19, '1'),
(1011, 'Hualahuises', 19, '1'),
(1012, 'Doctor Arroyo', 19, '1'),
(1013, 'Aramberri', 19, '1'),
(1014, 'General Zaragoza', 19, '1'),
(1015, 'Mier y Noriega', 19, '1'),
(1016, 'Oaxaca de Juárez', 20, '1'),
(1017, 'Villa de Etla', 20, '1'),
(1018, 'San Juan Bautista Atatlahuca', 20, '1'),
(1019, 'San Jerónimo Sosola', 20, '1'),
(1020, 'San Juan Bautista Jayacatlán', 20, '1'),
(1021, 'San Francisco Telixtlahuaca', 20, '1'),
(1022, 'Santiago Tenango', 20, '1'),
(1023, 'San Pablo Huitzo', 20, '1'),
(1024, 'San Juan del Estado', 20, '1'),
(1025, 'Magdalena Apasco', 20, '1'),
(1026, 'Santiago Suchilquitongo', 20, '1'),
(1027, 'San Juan Bautista Guelache', 20, '1'),
(1028, 'Reyes Etla', 20, '1'),
(1029, 'Nazareno Etla', 20, '1'),
(1030, 'San Andrés Zautla', 20, '1'),
(1031, 'San Agustín Etla', 20, '1'),
(1032, 'Soledad Etla', 20, '1'),
(1033, 'Santo Tomás Mazaltepec', 20, '1'),
(1034, 'Guadalupe Etla', 20, '1'),
(1035, 'San Pablo Etla', 20, '1'),
(1036, 'San Felipe Tejalápam', 20, '1'),
(1037, 'San Lorenzo Cacaotepec', 20, '1'),
(1038, 'Santa María Peñoles', 20, '1'),
(1039, 'Santiago Tlazoyaltepec', 20, '1'),
(1040, 'Tlalixtac de Cabrera', 20, '1'),
(1041, 'San Jacinto Amilpas', 20, '1'),
(1042, 'San Andrés Huayápam', 20, '1'),
(1043, 'San Agustín Yatareni', 20, '1'),
(1044, 'Santo Domingo Tomaltepec', 20, '1'),
(1045, 'Santa María del Tule', 20, '1'),
(1046, 'San Juan Bautista Tuxtepec', 20, '1'),
(1047, 'Loma Bonita', 20, '1'),
(1048, 'San José Independencia', 20, '1'),
(1049, 'Cosolapa', 20, '1'),
(1050, 'Acatlán de Pérez Figueroa', 20, '1'),
(1051, 'San Miguel Soyaltepec', 20, '1'),
(1052, 'Ayotzintepec', 20, '1'),
(1053, 'San Pedro Ixcatlán', 20, '1'),
(1054, 'San José Chiltepec', 20, '1'),
(1055, 'San Felipe Jalapa de Díaz', 20, '1'),
(1056, 'Santa María Jacatepec', 20, '1'),
(1057, 'San Lucas Ojitlán', 20, '1'),
(1058, 'San Juan Bautista Valle Nacional', 20, '1'),
(1059, 'San Felipe Usila', 20, '1'),
(1060, 'Huautla de Jiménez', 20, '1'),
(1061, 'Santa María Chilchotla', 20, '1'),
(1062, 'Santa Ana Ateixtlahuaca', 20, '1'),
(1063, 'San Lorenzo Cuaunecuiltitla', 20, '1'),
(1064, 'San Francisco Huehuetlán', 20, '1'),
(1065, 'San Pedro Ocopetatillo', 20, '1'),
(1066, 'Santa Cruz Acatepec', 20, '1'),
(1067, 'Eloxochitlán de Flores Magón', 20, '1'),
(1068, 'Santiago Texcalcingo', 20, '1'),
(1069, 'Teotitlán de Flores Magón', 20, '1'),
(1070, 'Santa María Teopoxco', 20, '1'),
(1071, 'San Martín Toxpalan', 20, '1'),
(1072, 'San Jerónimo Tecóatl', 20, '1'),
(1073, 'Santa María la Asunción', 20, '1'),
(1074, 'Huautepec', 20, '1'),
(1075, 'San Juan Coatzóspam', 20, '1'),
(1076, 'San Lucas Zoquiápam', 20, '1'),
(1077, 'San Antonio Nanahuatípam', 20, '1'),
(1078, 'San José Tenango', 20, '1'),
(1079, 'San Mateo Yoloxochitlán', 20, '1'),
(1080, 'San Bartolomé Ayautla', 20, '1'),
(1081, 'Mazatlán Villa de Flores', 20, '1'),
(1082, 'San Juan de los Cués', 20, '1'),
(1083, 'Santa María Tecomavaca', 20, '1'),
(1084, 'Santa María Ixcatlán', 20, '1'),
(1085, 'San Juan Bautista Cuicatlán', 20, '1'),
(1086, 'Cuyamecalco Villa de Zaragoza', 20, '1'),
(1087, 'Santa Ana Cuauhtémoc', 20, '1'),
(1088, 'Chiquihuitlán de Benito Juárez', 20, '1'),
(1089, 'San Pedro Teutila', 20, '1'),
(1090, 'San Miguel Santa Flor', 20, '1'),
(1091, 'Santa María Tlalixtac', 20, '1'),
(1092, 'San Andrés Teotilálpam', 20, '1'),
(1093, 'San Francisco Chapulapa', 20, '1'),
(1094, 'Concepción Pápalo', 20, '1'),
(1095, 'Santos Reyes Pápalo', 20, '1'),
(1096, 'San Juan Bautista Tlacoatzintepec', 20, '1'),
(1097, 'Santa María Pápalo', 20, '1'),
(1098, 'San Juan Tepeuxila', 20, '1'),
(1099, 'San Pedro Sochiápam', 20, '1'),
(1100, 'Valerio Trujano', 20, '1'),
(1101, 'San Pedro Jocotipac', 20, '1'),
(1102, 'Santa María Texcatitlán', 20, '1'),
(1103, 'San Pedro Jaltepetongo', 20, '1'),
(1104, 'Santiago Nacaltepec', 20, '1'),
(1105, 'Natividad', 20, '1'),
(1106, 'San Juan Quiotepec', 20, '1'),
(1107, 'San Pedro Yólox', 20, '1'),
(1108, 'Santiago Comaltepec', 20, '1'),
(1109, 'Abejones', 20, '1'),
(1110, 'San Pablo Macuiltianguis', 20, '1'),
(1111, 'Ixtlán de Juárez', 20, '1'),
(1112, 'San Juan Atepec', 20, '1'),
(1113, 'San Pedro Yaneri', 20, '1'),
(1114, 'San Miguel Aloápam', 20, '1'),
(1115, 'Teococuilco de Marcos Pérez', 20, '1'),
(1116, 'Santa Ana Yareni', 20, '1'),
(1117, 'San Juan Evangelista Analco', 20, '1'),
(1118, 'Santa María Jaltianguis', 20, '1'),
(1119, 'San Miguel del Río', 20, '1'),
(1120, 'San Juan Chicomezúchil', 20, '1'),
(1121, 'Capulálpam de Méndez', 20, '1'),
(1122, 'Nuevo Zoquiápam', 20, '1'),
(1123, 'Santiago Xiacuí', 20, '1'),
(1124, 'Guelatao de Juárez', 20, '1'),
(1125, 'Santa Catarina Ixtepeji', 20, '1'),
(1126, 'San Miguel Yotao', 20, '1'),
(1127, 'Santa Catarina Lachatao', 20, '1'),
(1128, 'San Miguel Amatlán', 20, '1'),
(1129, 'Santa María Yavesía', 20, '1'),
(1130, 'Santiago Laxopa', 20, '1'),
(1131, 'San Ildefonso Villa Alta', 20, '1'),
(1132, 'Santiago Camotlán', 20, '1'),
(1133, 'San Juan Yaeé', 20, '1'),
(1134, 'Santiago Lalopa', 20, '1'),
(1135, 'San Juan Yatzona', 20, '1'),
(1136, 'Villa Talea de Castro', 20, '1'),
(1137, 'Tanetze de Zaragoza', 20, '1'),
(1138, 'San Juan Juquila Vijanos', 20, '1'),
(1139, 'San Cristóbal Lachirioag', 20, '1'),
(1140, 'Santa María Temaxcalapa', 20, '1'),
(1141, 'Santo Domingo Roayaga', 20, '1'),
(1142, 'Santa María Yalina', 20, '1'),
(1143, 'San Andrés Solaga', 20, '1'),
(1144, 'San Juan Tabaá', 20, '1'),
(1145, 'San Melchor Betaza', 20, '1'),
(1146, 'San Andrés Yaá', 20, '1'),
(1147, 'San Bartolomé Zoogocho', 20, '1'),
(1148, 'San Baltazar Yatzachi el Bajo', 20, '1'),
(1149, 'Santiago Zoochila', 20, '1'),
(1150, 'Villa Hidalgo Yalálag', 20, '1'),
(1151, 'San Francisco Cajonos', 20, '1'),
(1152, 'San Mateo Cajonos', 20, '1'),
(1153, 'San Pedro Cajonos', 20, '1'),
(1154, 'Santo Domingo Xagacía', 20, '1'),
(1155, 'San Pablo Yaganiza', 20, '1'),
(1156, 'Santiago Choápam', 20, '1'),
(1157, 'Santiago Jocotepec', 20, '1'),
(1158, 'San Juan Lalana', 20, '1'),
(1159, 'Santiago Yaveo', 20, '1'),
(1160, 'San Juan Petlapa', 20, '1'),
(1161, 'San Juan Comaltepec', 20, '1'),
(1162, 'Heroica Ciudad de Huajuapan de León', 20, '1'),
(1163, 'Villa de Santiago Chazumba', 20, '1'),
(1164, 'Cosoltepec', 20, '1'),
(1165, 'San Pedro y San Pablo Tequixtepec', 20, '1'),
(1166, 'San Juan Bautista Suchitepec', 20, '1'),
(1167, 'Santa Catarina Zapoquila', 20, '1'),
(1168, 'Santiago Miltepec', 20, '1'),
(1169, 'San Jerónimo Silacayoapilla', 20, '1'),
(1170, 'Zapotitlán Palmas', 20, '1'),
(1171, 'San Andrés Dinicuiti', 20, '1'),
(1172, 'Santiago Cacaloxtepec', 20, '1'),
(1173, 'Asunción Cuyotepeji', 20, '1'),
(1174, 'Santa María Camotlán', 20, '1'),
(1175, 'Santiago Huajolotitlán', 20, '1'),
(1176, 'Santiago Tamazola', 20, '1'),
(1177, 'San Juan Cieneguilla', 20, '1'),
(1178, 'Zapotitlán Lagunas', 20, '1'),
(1179, 'San Juan Ihualtepec', 20, '1'),
(1180, 'San Nicolás Hidalgo', 20, '1'),
(1181, 'Guadalupe de Ramírez', 20, '1'),
(1182, 'San Andrés Tepetlapa', 20, '1'),
(1183, 'San Miguel Ahuehuetitlán', 20, '1'),
(1184, 'San Mateo Nejápam', 20, '1'),
(1185, 'San Juan Bautista Tlachichilco', 20, '1'),
(1186, 'Tezoatlán de Segura y Luna', 20, '1'),
(1187, 'Fresnillo de Trujano', 20, '1'),
(1188, 'Santiago Ayuquililla', 20, '1'),
(1189, 'San José Ayuquila', 20, '1'),
(1190, 'San Martín Zacatepec', 20, '1'),
(1191, 'San Miguel Amatitlán', 20, '1'),
(1192, 'Mariscala de Juárez', 20, '1'),
(1193, 'Santa Cruz Tacache de Mina', 20, '1'),
(1194, 'San Simón Zahuatlán', 20, '1'),
(1195, 'San Marcos Arteaga', 20, '1'),
(1196, 'San Jorge Nuchita', 20, '1'),
(1197, 'Santos Reyes Yucuná', 20, '1'),
(1198, 'Santo Domingo Tonalá', 20, '1'),
(1199, 'Santo Domingo Yodohino', 20, '1'),
(1200, 'San Juan Bautista Coixtlahuaca', 20, '1'),
(1201, 'Tepelmeme Villa de Morelos', 20, '1'),
(1202, 'Concepción Buenavista', 20, '1'),
(1203, 'Santiago Ihuitlán Plumas', 20, '1'),
(1204, 'Tlacotepec Plumas', 20, '1'),
(1205, 'San Francisco Teopan', 20, '1'),
(1206, 'Santa Magdalena Jicotlán', 20, '1'),
(1207, 'San Mateo Tlapiltepec', 20, '1'),
(1208, 'San Miguel Tequixtepec', 20, '1'),
(1209, 'San Miguel Tulancingo', 20, '1'),
(1210, 'Santiago Tepetlapa', 20, '1'),
(1211, 'San Cristóbal Suchixtlahuaca', 20, '1'),
(1212, 'Santa María Nativitas', 20, '1'),
(1213, 'Silacayoápam', 20, '1'),
(1214, 'Santiago Yucuyachi', 20, '1'),
(1215, 'San Lorenzo Victoria', 20, '1'),
(1216, 'San Agustín Atenango', 20, '1'),
(1217, 'Calihualá', 20, '1'),
(1218, 'Santa Cruz de Bravo', 20, '1'),
(1219, 'Ixpantepec Nieves', 20, '1'),
(1220, 'San Francisco Tlapancingo', 20, '1'),
(1221, 'Santiago del Río', 20, '1'),
(1222, 'San Pedro y San Pablo Teposcolula', 20, '1'),
(1223, 'La Trinidad Vista Hermosa', 20, '1'),
(1224, 'Villa de Tamazulápam del Progreso', 20, '1'),
(1225, 'San Pedro Nopala', 20, '1'),
(1226, 'Teotongo', 20, '1'),
(1227, 'San Antonio Acutla', 20, '1'),
(1228, 'Villa Tejúpam de la Unión', 20, '1'),
(1229, 'Santo Domingo Tonaltepec', 20, '1'),
(1230, 'Villa de Chilapa de Díaz', 20, '1'),
(1231, 'San Antonino Monte Verde', 20, '1'),
(1232, 'San Andrés Lagunas', 20, '1'),
(1233, 'San Pedro Yucunama', 20, '1'),
(1234, 'San Juan Teposcolula', 20, '1'),
(1235, 'San Bartolo Soyaltepec', 20, '1'),
(1236, 'Santiago Yolomécatl', 20, '1'),
(1237, 'San Sebastián Nicananduta', 20, '1'),
(1238, 'Santo Domingo Tlatayápam', 20, '1'),
(1239, 'Santa María Nduayaco', 20, '1'),
(1240, 'San Vicente Nuñú', 20, '1'),
(1241, 'San Pedro Topiltepec', 20, '1'),
(1242, 'Santiago Nejapilla', 20, '1'),
(1243, 'Asunción Nochixtlán', 20, '1'),
(1244, 'San Miguel Huautla', 20, '1'),
(1245, 'San Miguel Chicahua', 20, '1'),
(1246, 'Santa María Apazco', 20, '1'),
(1247, 'Santiago Apoala', 20, '1'),
(1248, 'Santa María Chachoápam', 20, '1'),
(1249, 'San Pedro Coxcaltepec Cántaros', 20, '1'),
(1250, 'Santiago Huauclilla', 20, '1'),
(1251, 'Santo Domingo Yanhuitlán', 20, '1'),
(1252, 'San Andrés Sinaxtla', 20, '1'),
(1253, 'San Juan Yucuita', 20, '1'),
(1254, 'San Juan Sayultepec', 20, '1'),
(1255, 'Santiago Tillo', 20, '1'),
(1256, 'San Francisco Chindúa', 20, '1'),
(1257, 'San Mateo Etlatongo', 20, '1'),
(1258, 'Santa Inés de Zaragoza', 20, '1'),
(1259, 'Santiago Juxtlahuaca', 20, '1'),
(1260, 'San Miguel Tlacotepec', 20, '1'),
(1261, 'San Sebastián Tecomaxtlahuaca', 20, '1'),
(1262, 'Santos Reyes Tepejillo', 20, '1'),
(1263, 'San Juan Mixtepec -Dto. 08 -', 20, '1'),
(1264, 'San Martín Peras', 20, '1'),
(1265, 'Coicoyán de las Flores', 20, '1'),
(1266, 'Heroica Ciudad de Tlaxiaco', 20, '1'),
(1267, 'San Juan Ñumí', 20, '1'),
(1268, 'San Pedro Mártir Yucuxaco', 20, '1'),
(1269, 'San Martín Huamelúlpam', 20, '1'),
(1270, 'Santa Cruz Tayata', 20, '1'),
(1271, 'Santiago Nundiche', 20, '1'),
(1272, 'Santa María del Rosario', 20, '1'),
(1273, 'San Juan Achiutla', 20, '1'),
(1274, 'Santa Catarina Tayata', 20, '1'),
(1275, 'San Cristóbal Amoltepec', 20, '1'),
(1276, 'San Miguel Achiutla', 20, '1'),
(1277, 'San Martín Itunyoso', 20, '1'),
(1278, 'Magdalena Peñasco', 20, '1'),
(1279, 'San Bartolomé Yucuañe', 20, '1'),
(1280, 'Santa Cruz Nundaco', 20, '1'),
(1281, 'San Agustín Tlacotepec', 20, '1'),
(1282, 'Santo Tomás Ocotepec', 20, '1'),
(1283, 'San Antonio Sinicahua', 20, '1'),
(1284, 'San Mateo Peñasco', 20, '1'),
(1285, 'Santa María Tataltepec', 20, '1'),
(1286, 'San Pedro Molinos', 20, '1'),
(1287, 'Santa María Yosoyúa', 20, '1'),
(1288, 'San Juan Teita', 20, '1'),
(1289, 'Magdalena Jaltepec', 20, '1'),
(1290, 'Magdalena Yodocono de Porfirio Díaz', 20, '1'),
(1291, 'San Miguel Tecomatlán', 20, '1'),
(1292, 'Magdalena Zahuatlán', 20, '1'),
(1293, 'San Francisco Nuxaño', 20, '1'),
(1294, 'San Pedro Tidaá', 20, '1'),
(1295, 'San Francisco Jaltepetongo', 20, '1'),
(1296, 'Santiago Tilantongo', 20, '1'),
(1297, 'San Juan Diuxi', 20, '1'),
(1298, 'San Andrés Nuxiño', 20, '1'),
(1299, 'San Juan Tamazola', 20, '1'),
(1300, 'Santo Domingo Nuxaá', 20, '1'),
(1301, 'Yutanduchi de Guerrero', 20, '1'),
(1302, 'San Pedro Teozacoalco', 20, '1'),
(1303, 'San Miguel Piedras', 20, '1'),
(1304, 'San Mateo Sindihui', 20, '1'),
(1305, 'Juchitán de Zaragoza', 20, '1'),
(1306, 'Ciudad Ixtepec', 20, '1'),
(1307, 'El Espinal', 20, '1'),
(1308, 'Santo Domingo Ingenio', 20, '1'),
(1309, 'Santa María Xadani', 20, '1'),
(1310, 'Santiago Niltepec', 20, '1'),
(1311, 'San Dionisio del Mar', 20, '1'),
(1312, 'Asunción Ixtaltepec', 20, '1'),
(1313, 'San Francisco del Mar', 20, '1'),
(1314, 'Unión Hidalgo', 20, '1'),
(1315, 'San Miguel Chimalapa', 20, '1'),
(1316, 'Santo Domingo Zanatepec', 20, '1'),
(1317, 'Reforma de Pineda', 20, '1'),
(1318, 'San Francisco Ixhuatán', 20, '1'),
(1319, 'San Pedro Tapanatepec', 20, '1'),
(1320, 'Chahuites', 20, '1'),
(1321, 'Santiago Zacatepec', 20, '1'),
(1322, 'Santo Domingo Tepuxtepec', 20, '1'),
(1323, 'San Juan Cotzocón', 20, '1'),
(1324, 'San Juan Mazatlán', 20, '1'),
(1325, 'Totontepec Villa de Morelos', 20, '1'),
(1326, 'Mixistlán de la Reforma', 20, '1'),
(1327, 'Santa María Tlahuitoltepec', 20, '1'),
(1328, 'Santa María Alotepec', 20, '1'),
(1329, 'Santiago Atitlán', 20, '1'),
(1330, 'Tamazulápam del Espíritu Santo', 20, '1'),
(1331, 'San Pedro y San Pablo Ayutla', 20, '1'),
(1332, 'Santa María Tepantlali', 20, '1'),
(1333, 'San Miguel Quetzaltepec', 20, '1'),
(1334, 'Asunción Cacalotepec', 20, '1'),
(1335, 'San Pedro Ocotepec', 20, '1'),
(1336, 'San Lucas Camotlán', 20, '1'),
(1337, 'Santiago Ixcuintepec', 20, '1'),
(1338, 'Matías Romero Avendaño', 20, '1'),
(1339, 'San Juan Guichicovi', 20, '1'),
(1340, 'Santo Domingo Petapa', 20, '1'),
(1341, 'Santa María Chimalapa', 20, '1'),
(1342, 'Santa María Petapa', 20, '1'),
(1343, 'El Barrio de la Soledad', 20, '1'),
(1344, 'Tlacolula de Matamoros', 20, '1'),
(1345, 'San Sebastián Abasolo', 20, '1'),
(1346, 'Villa Díaz Ordaz', 20, '1'),
(1347, 'Santa María Guelacé', 20, '1'),
(1348, 'Teotitlán del Valle', 20, '1'),
(1349, 'San Francisco Lachigoló', 20, '1'),
(1350, 'San Sebastián Teitipac', 20, '1'),
(1351, 'Santa Ana del Valle', 20, '1'),
(1352, 'San Pablo Villa de Mitla', 20, '1'),
(1353, 'Santiago Matatlán', 20, '1'),
(1354, 'Santo Domingo Albarradas', 20, '1'),
(1355, 'Rojas de Cuauhtémoc', 20, '1'),
(1356, 'San Juan Teitipac', 20, '1'),
(1357, 'Santa Cruz Papalutla', 20, '1'),
(1358, 'Magdalena Teitipac', 20, '1'),
(1359, 'San Jerónimo Tlacochahuaya', 20, '1'),
(1360, 'San Juan Guelavía', 20, '1'),
(1361, 'San Lucas Quiaviní', 20, '1'),
(1362, 'San Juan del Río', 20, '1'),
(1363, 'San Bartolomé Quialana', 20, '1'),
(1364, 'San Lorenzo Albarradas', 20, '1'),
(1365, 'San Pedro Totolápam', 20, '1'),
(1366, 'San Pedro Quiatoni', 20, '1'),
(1367, 'Santa María Zoquitlán', 20, '1'),
(1368, 'San Dionisio Ocotepec', 20, '1'),
(1369, 'San Carlos Yautepec', 20, '1'),
(1370, 'San Juan Juquila Mixes', 20, '1'),
(1371, 'Nejapa de Madero', 20, '1'),
(1372, 'Santa Ana Tavela', 20, '1'),
(1373, 'San Juan Lajarcia', 20, '1'),
(1374, 'San Bartolo Yautepec', 20, '1'),
(1375, 'Santa María Ecatepec', 20, '1'),
(1376, 'Asunción Tlacolulita', 20, '1'),
(1377, 'San Pedro Mártir Quiechapa', 20, '1'),
(1378, 'Santa María Quiegolani', 20, '1'),
(1379, 'Santa Catarina Quioquitani', 20, '1'),
(1380, 'Santa Catalina Quierí', 20, '1'),
(1381, 'Salina Cruz', 20, '1'),
(1382, 'Santiago Lachiguiri', 20, '1'),
(1383, 'Santa María Jalapa del Marqués', 20, '1'),
(1384, 'Santa María Totolapilla', 20, '1'),
(1385, 'Santiago Laollaga', 20, '1'),
(1386, 'Guevea de Humboldt', 20, '1'),
(1387, 'Santo Domingo Chihuitán', 20, '1'),
(1388, 'Santa María Guienagati', 20, '1'),
(1389, 'Magdalena Tequisistlán', 20, '1'),
(1390, 'Magdalena Tlacotepec', 20, '1'),
(1391, 'San Pedro Comitancillo', 20, '1'),
(1392, 'Santa María Mixtequilla', 20, '1'),
(1393, 'Santo Domingo Tehuantepec', 20, '1'),
(1394, 'San Pedro Huamelula', 20, '1'),
(1395, 'San Pedro Huilotepec', 20, '1'),
(1396, 'San Mateo del Mar', 20, '1'),
(1397, 'Heroica Villa de San Blas Atempa', 20, '1'),
(1398, 'Santiago Astata', 20, '1'),
(1399, 'San Miguel Tenango', 20, '1'),
(1400, 'Miahuatlán de Porfirio Díaz', 20, '1'),
(1401, 'San Nicolás', 20, '1'),
(1402, 'San Simón Almolongas', 20, '1'),
(1403, 'San Luis Amatlán', 20, '1'),
(1404, 'San José Lachiguiri', 20, '1'),
(1405, 'Sitio de Xitlapehua', 20, '1'),
(1406, 'San Francisco Logueche', 20, '1'),
(1407, 'Santa Ana', 20, '1'),
(1408, 'Santa Cruz Xitla', 20, '1'),
(1409, 'Monjas', 20, '1'),
(1410, 'San Ildefonso Amatlán', 20, '1'),
(1411, 'Santa Catarina Cuixtla', 20, '1'),
(1412, 'San José del Peñasco', 20, '1'),
(1413, 'San Cristóbal Amatlán', 20, '1'),
(1414, 'San Juan Mixtepec -Dto. 26 -', 20, '1'),
(1415, 'San Pedro Mixtepec -Dto. 26 -', 20, '1'),
(1416, 'Santa Lucía Miahuatlán', 20, '1'),
(1417, 'San Jerónimo Coatlán', 20, '1'),
(1418, 'San Sebastián Coatlán', 20, '1'),
(1419, 'San Pablo Coatlán', 20, '1'),
(1420, 'San Mateo Río Hondo', 20, '1'),
(1421, 'Santo Tomás Tamazulapan', 20, '1'),
(1422, 'San Andrés Paxtlán', 20, '1'),
(1423, 'Santa María Ozolotepec', 20, '1'),
(1424, 'San Miguel Coatlán', 20, '1'),
(1425, 'San Sebastián Río Hondo', 20, '1'),
(1426, 'San Miguel Suchixtepec', 20, '1'),
(1427, 'Santo Domingo Ozolotepec', 20, '1'),
(1428, 'San Francisco Ozolotepec', 20, '1'),
(1429, 'Santiago Xanica', 20, '1'),
(1430, 'San Marcial Ozolotepec', 20, '1'),
(1431, 'San Juan Ozolotepec', 20, '1'),
(1432, 'San Pedro Pochutla', 20, '1'),
(1433, 'Santo Domingo de Morelos', 20, '1'),
(1434, 'Santa Catarina Loxicha', 20, '1'),
(1435, 'San Agustín Loxicha', 20, '1'),
(1436, 'San Baltazar Loxicha', 20, '1'),
(1437, 'Santa María Colotepec', 20, '1'),
(1438, 'San Bartolomé Loxicha', 20, '1'),
(1439, 'Santa María Tonameca', 20, '1'),
(1440, 'Candelaria Loxicha', 20, '1'),
(1441, 'Pluma Hidalgo', 20, '1'),
(1442, 'San Pedro el Alto', 20, '1'),
(1443, 'San Mateo Piñas', 20, '1'),
(1444, 'Santa María Huatulco', 20, '1'),
(1445, 'San Miguel del Puerto', 20, '1'),
(1446, 'Putla Villa de Guerrero', 20, '1'),
(1447, 'Constancia del Rosario', 20, '1'),
(1448, 'Mesones Hidalgo', 20, '1'),
(1449, 'Santa María Zacatepec', 20, '1'),
(1450, 'San Pedro Amuzgos', 20, '1'),
(1451, 'La Reforma', 20, '1'),
(1452, 'Santa María Ipalapa', 20, '1'),
(1453, 'Chalcatongo de Hidalgo', 20, '1'),
(1454, 'Santa María Yucuhiti', 20, '1'),
(1455, 'San Esteban Atatlahuca', 20, '1'),
(1456, 'Santa Catarina Ticuá', 20, '1'),
(1457, 'Santiago Nuyoó', 20, '1'),
(1458, 'Santa Catarina Yosonotú', 20, '1'),
(1459, 'San Miguel el Grande', 20, '1'),
(1460, 'Santo Domingo Ixcatlán', 20, '1'),
(1461, 'San Pablo Tijaltepec', 20, '1'),
(1462, 'Santa Cruz Tacahua', 20, '1'),
(1463, 'Santa Lucía Monteverde', 20, '1'),
(1464, 'San Andrés Cabecera Nueva', 20, '1'),
(1465, 'Santa María Yolotepec', 20, '1'),
(1466, 'Santiago Yosondúa', 20, '1'),
(1467, 'Santa Cruz Itundujia', 20, '1'),
(1468, 'Zimatlán de Álvarez', 20, '1'),
(1469, 'San Bernardo Mixtepec', 20, '1'),
(1470, 'Santa Cruz Mixtepec', 20, '1'),
(1471, 'San Miguel Mixtepec', 20, '1'),
(1472, 'Santa María Atzompa', 20, '1'),
(1473, 'San Andrés Ixtlahuaca', 20, '1'),
(1474, 'Santa Cruz Amilpas', 20, '1'),
(1475, 'Santa Cruz Xoxocotlán', 20, '1'),
(1476, 'Santa Lucía del Camino', 20, '1'),
(1477, 'San Pedro Ixtlahuaca', 20, '1'),
(1478, 'San Antonio de la Cal', 20, '1'),
(1479, 'San Agustín de las Juntas', 20, '1'),
(1480, 'San Pablo Huixtepec', 20, '1'),
(1481, 'Ánimas Trujano', 20, '1'),
(1482, 'San Jacinto Tlacotepec', 20, '1'),
(1483, 'San Raymundo Jalpan', 20, '1'),
(1484, 'Trinidad Zaachila', 20, '1'),
(1485, 'Santa María Coyotepec', 20, '1'),
(1486, 'San Bartolo Coyotepec', 20, '1'),
(1487, 'Santa Inés Yatzeche', 20, '1'),
(1488, 'Ciénega de Zimatlán', 20, '1'),
(1489, 'San Antonio Huitepec', 20, '1'),
(1490, 'Villa de Zaachila', 20, '1'),
(1491, 'San Sebastián Tutla', 20, '1'),
(1492, 'San Miguel Peras', 20, '1'),
(1493, 'San Pablo Cuatro Venados', 20, '1'),
(1494, 'Santa Inés del Monte', 20, '1'),
(1495, 'Santa Gertrudis', 20, '1'),
(1496, 'San Antonino el Alto', 20, '1'),
(1497, 'Magdalena Mixtepec', 20, '1'),
(1498, 'Santa Catarina Quiané', 20, '1'),
(1499, 'Ayoquezco de Aldama', 20, '1'),
(1500, 'Santa Ana Tlapacoyan', 20, '1'),
(1501, 'Santa Cruz Zenzontepec', 20, '1'),
(1502, 'San Francisco Cahuacuá', 20, '1'),
(1503, 'San Mateo Yucutindoo', 20, '1'),
(1504, 'Santiago Textitlán', 20, '1'),
(1505, 'Santiago Amoltepec', 20, '1'),
(1506, 'Santa María Zaniza', 20, '1'),
(1507, 'Santo Domingo Teojomulco', 20, '1'),
(1508, 'Cuilápam de Guerrero', 20, '1'),
(1509, 'Villa Sola de Vega', 20, '1'),
(1510, 'Santa María Lachixío', 20, '1'),
(1511, 'San Vicente Lachixío', 20, '1'),
(1512, 'San Lorenzo Texmelúcan', 20, '1'),
(1513, 'Santa María Sola', 20, '1'),
(1514, 'San Francisco Sola', 20, '1'),
(1515, 'San Ildefonso Sola', 20, '1'),
(1516, 'Santiago Minas', 20, '1'),
(1517, 'Heroica Ciudad de Ejutla de Crespo', 20, '1'),
(1518, 'San Martín Tilcajete', 20, '1'),
(1519, 'Santo Tomás Jalieza', 20, '1'),
(1520, 'San Juan Chilateca', 20, '1'),
(1521, 'Ocotlán de Morelos', 20, '1'),
(1522, 'Santa Ana Zegache', 20, '1'),
(1523, 'Santiago Apóstol', 20, '1'),
(1524, 'San Antonino Castillo Velasco', 20, '1'),
(1525, 'Asunción Ocotlán', 20, '1'),
(1526, 'San Pedro Mártir', 20, '1'),
(1527, 'San Dionisio Ocotlán', 20, '1'),
(1528, 'Magdalena Ocotlán', 20, '1'),
(1529, 'San Miguel Tilquiápam', 20, '1'),
(1530, 'Santa Catarina Minas', 20, '1'),
(1531, 'San Baltazar Chichicápam', 20, '1'),
(1532, 'San Pedro Apóstol', 20, '1'),
(1533, 'Santa Lucía Ocotlán', 20, '1');
INSERT INTO `municipio` (`id_municipio`, `nombre`, `fk_estado`, `estatus`) VALUES
(1534, 'San Jerónimo Taviche', 20, '1'),
(1535, 'San Andrés Zabache', 20, '1'),
(1536, 'San José del Progreso', 20, '1'),
(1537, 'Yaxe', 20, '1'),
(1538, 'San Pedro Taviche', 20, '1'),
(1539, 'San Martín de los Cansecos', 20, '1'),
(1540, 'San Martín Lachilá', 20, '1'),
(1541, 'La Pe', 20, '1'),
(1542, 'La Compañía', 20, '1'),
(1543, 'Coatecas Altas', 20, '1'),
(1544, 'San Juan Lachigalla', 20, '1'),
(1545, 'San Agustín Amatengo', 20, '1'),
(1546, 'Taniche', 20, '1'),
(1547, 'San Miguel Ejutla', 20, '1'),
(1548, 'Yogana', 20, '1'),
(1549, 'San Vicente Coatlán', 20, '1'),
(1550, 'Santiago Pinotepa Nacional', 20, '1'),
(1551, 'San Juan Cacahuatepec', 20, '1'),
(1552, 'San Juan Bautista Lo de Soto', 20, '1'),
(1553, 'Mártires de Tacubaya', 20, '1'),
(1554, 'San Sebastián Ixcapa', 20, '1'),
(1555, 'San Antonio Tepetlapa', 20, '1'),
(1556, 'Santa María Cortijo', 20, '1'),
(1557, 'Santiago Llano Grande', 20, '1'),
(1558, 'San Miguel Tlacamama', 20, '1'),
(1559, 'Santiago Tapextla', 20, '1'),
(1560, 'San José Estancia Grande', 20, '1'),
(1561, 'Santo Domingo Armenta', 20, '1'),
(1562, 'Santiago Jamiltepec', 20, '1'),
(1563, 'San Pedro Atoyac', 20, '1'),
(1564, 'San Juan Colorado', 20, '1'),
(1565, 'Santiago Ixtayutla', 20, '1'),
(1566, 'San Pedro Jicayán', 20, '1'),
(1567, 'Pinotepa de Don Luis', 20, '1'),
(1568, 'San Lorenzo', 20, '1'),
(1569, 'San Agustín Chayuco', 20, '1'),
(1570, 'San Andrés Huaxpaltepec', 20, '1'),
(1571, 'Santa Catarina Mechoacán', 20, '1'),
(1572, 'Santiago Tetepec', 20, '1'),
(1573, 'Santa María Huazolotitlán', 20, '1'),
(1574, 'Villa de Tututepec', 20, '1'),
(1575, 'Tataltepec de Valdés', 20, '1'),
(1576, 'San Juan Quiahije', 20, '1'),
(1577, 'San Miguel Panixtlahuaca', 20, '1'),
(1578, 'Santa Catarina Juquila', 20, '1'),
(1579, 'San Pedro Juchatengo', 20, '1'),
(1580, 'Santiago Yaitepec', 20, '1'),
(1581, 'San Juan Lachao', 20, '1'),
(1582, 'Santa María Temaxcaltepec', 20, '1'),
(1583, 'Santos Reyes Nopala', 20, '1'),
(1584, 'San Gabriel Mixtepec', 20, '1'),
(1585, 'San Pedro Mixtepec -Dto. 22 -', 20, '1'),
(1586, 'Puebla', 21, '1'),
(1587, 'Tlaltenango', 21, '1'),
(1588, 'San Miguel Xoxtla', 21, '1'),
(1589, 'Juan C. Bonilla', 21, '1'),
(1590, 'Coronango', 21, '1'),
(1591, 'Cuautlancingo', 21, '1'),
(1592, 'San Pedro Cholula', 21, '1'),
(1593, 'San Andrés Cholula', 21, '1'),
(1594, 'Ocoyucan', 21, '1'),
(1595, 'Amozoc', 21, '1'),
(1596, 'Francisco Z. Mena', 21, '1'),
(1597, 'Pantepec', 21, '1'),
(1598, 'Venustiano Carranza', 21, '1'),
(1599, 'Jalpan', 21, '1'),
(1600, 'Tlaxco', 21, '1'),
(1601, 'Tlacuilotepec', 21, '1'),
(1602, 'Xicotepec', 21, '1'),
(1603, 'Pahuatlán', 21, '1'),
(1604, 'Honey', 21, '1'),
(1605, 'Naupan', 21, '1'),
(1606, 'Huauchinango', 21, '1'),
(1607, 'Ahuazotepec', 21, '1'),
(1608, 'Juan Galindo', 21, '1'),
(1609, 'Tlaola', 21, '1'),
(1610, 'Zihuateutla', 21, '1'),
(1611, 'Jopala', 21, '1'),
(1612, 'Tlapacoya', 21, '1'),
(1613, 'Chignahuapan', 21, '1'),
(1614, 'Zacatlán', 21, '1'),
(1615, 'Chiconcuautla', 21, '1'),
(1616, 'Ahuacatlán', 21, '1'),
(1617, 'Tepetzintla', 21, '1'),
(1618, 'San Felipe Tepatlán', 21, '1'),
(1619, 'Amixtlán', 21, '1'),
(1620, 'Tepango de Rodríguez', 21, '1'),
(1621, 'Zongozotla', 21, '1'),
(1622, 'Hermenegildo Galeana', 21, '1'),
(1623, 'Olintla', 21, '1'),
(1624, 'Coatepec', 21, '1'),
(1625, 'Camocuautla', 21, '1'),
(1626, 'Hueytlalpan', 21, '1'),
(1627, 'Zapotitlán de Méndez', 21, '1'),
(1628, 'Huitzilan de Serdán', 21, '1'),
(1629, 'Xochitlán de Vicente Suárez', 21, '1'),
(1630, 'Huehuetla', 21, '1'),
(1631, 'Ixtepec', 21, '1'),
(1632, 'Atlequizayan', 21, '1'),
(1633, 'Tenampulco', 21, '1'),
(1634, 'Tuzamapan de Galeana', 21, '1'),
(1635, 'Caxhuacan', 21, '1'),
(1636, 'Jonotla', 21, '1'),
(1637, 'Zoquiapan', 21, '1'),
(1638, 'Nauzontla', 21, '1'),
(1639, 'Cuetzalan del Progreso', 21, '1'),
(1640, 'Ayotoxco de Guerrero', 21, '1'),
(1641, 'Hueytamalco', 21, '1'),
(1642, 'Acateno', 21, '1'),
(1643, 'Cuautempan', 21, '1'),
(1644, 'Aquixtla', 21, '1'),
(1645, 'Tetela de Ocampo', 21, '1'),
(1646, 'Xochiapulco', 21, '1'),
(1647, 'Zacapoaxtla', 21, '1'),
(1648, 'Zaragoza', 21, '1'),
(1649, 'Ixtacamaxtitlán', 21, '1'),
(1650, 'Zautla', 21, '1'),
(1651, 'Ocotepec', 21, '1'),
(1652, 'Libres', 21, '1'),
(1653, 'Teziutlán', 21, '1'),
(1654, 'Tlatlauquitepec', 21, '1'),
(1655, 'Yaonáhuac', 21, '1'),
(1656, 'Hueyapan', 21, '1'),
(1657, 'Teteles de Ávila Castillo', 21, '1'),
(1658, 'Atempan', 21, '1'),
(1659, 'Chignautla', 21, '1'),
(1660, 'Xiutetelco', 21, '1'),
(1661, 'Cuyoaco', 21, '1'),
(1662, 'Tepeyahualco', 21, '1'),
(1663, 'San Martín Texmelucan', 21, '1'),
(1664, 'Tlahuapan', 21, '1'),
(1665, 'San Matías Tlalancaleca', 21, '1'),
(1666, 'San Salvador el Verde', 21, '1'),
(1667, 'San Felipe Teotlalcingo', 21, '1'),
(1668, 'Chiautzingo', 21, '1'),
(1669, 'Huejotzingo', 21, '1'),
(1670, 'Domingo Arenas', 21, '1'),
(1671, 'Calpan', 21, '1'),
(1672, 'San Nicolás de los Ranchos', 21, '1'),
(1673, 'Atlixco', 21, '1'),
(1674, 'Nealtican', 21, '1'),
(1675, 'San Jerónimo Tecuanipan', 21, '1'),
(1676, 'San Gregorio Atzompa', 21, '1'),
(1677, 'Tochimilco', 21, '1'),
(1678, 'Tianguismanalco', 21, '1'),
(1679, 'Santa Isabel Cholula', 21, '1'),
(1680, 'Huaquechula', 21, '1'),
(1681, 'San Diego la Mesa Tochimiltzingo', 21, '1'),
(1682, 'Tepeojuma', 21, '1'),
(1683, 'Izúcar de Matamoros', 21, '1'),
(1684, 'Atzitzihuacán', 21, '1'),
(1685, 'Acteopan', 21, '1'),
(1686, 'Cohuecan', 21, '1'),
(1687, 'Tepemaxalco', 21, '1'),
(1688, 'Tlapanalá', 21, '1'),
(1689, 'Tepexco', 21, '1'),
(1690, 'Tilapa', 21, '1'),
(1691, 'Chietla', 21, '1'),
(1692, 'Atzala', 21, '1'),
(1693, 'Teopantlán', 21, '1'),
(1694, 'San Martín Totoltepec', 21, '1'),
(1695, 'Xochiltepec', 21, '1'),
(1696, 'Epatlán', 21, '1'),
(1697, 'Ahuatlán', 21, '1'),
(1698, 'Coatzingo', 21, '1'),
(1699, 'Santa Catarina Tlaltempan', 21, '1'),
(1700, 'Chigmecatitlán', 21, '1'),
(1701, 'Zacapala', 21, '1'),
(1702, 'Tepexi de Rodríguez', 21, '1'),
(1703, 'Teotlalco', 21, '1'),
(1704, 'Jolalpan', 21, '1'),
(1705, 'Huehuetlán el Chico', 21, '1'),
(1706, 'Chiautla', 21, '1'),
(1707, 'Cohetzala', 21, '1'),
(1708, 'Xicotlán', 21, '1'),
(1709, 'Chila de la Sal', 21, '1'),
(1710, 'Ixcamilpa de Guerrero', 21, '1'),
(1711, 'Albino Zertuche', 21, '1'),
(1712, 'Tulcingo', 21, '1'),
(1713, 'Tehuitzingo', 21, '1'),
(1714, 'Cuayuca de Andrade', 21, '1'),
(1715, 'Santa Inés Ahuatempan', 21, '1'),
(1716, 'Axutla', 21, '1'),
(1717, 'Chinantla', 21, '1'),
(1718, 'Ahuehuetitla', 21, '1'),
(1719, 'San Pablo Anicano', 21, '1'),
(1720, 'Tecomatlán', 21, '1'),
(1721, 'Piaxtla', 21, '1'),
(1722, 'Guadalupe', 21, '1'),
(1723, 'Ixcaquixtla', 21, '1'),
(1724, 'Coyotepec', 21, '1'),
(1725, 'Xayacatlán de Bravo', 21, '1'),
(1726, 'Totoltepec de Guerrero', 21, '1'),
(1727, 'Acatlán', 21, '1'),
(1728, 'San Jerónimo Xayacatlán', 21, '1'),
(1729, 'San Pedro Yeloixtlahuaca', 21, '1'),
(1730, 'Petlalcingo', 21, '1'),
(1731, 'San Miguel Ixitlán', 21, '1'),
(1732, 'Chila', 21, '1'),
(1733, 'Rafael Lara Grajales', 21, '1'),
(1734, 'San José Chiapa', 21, '1'),
(1735, 'Oriental', 21, '1'),
(1736, 'San Nicolás Buenos Aires', 21, '1'),
(1737, 'Guadalupe Victoria', 21, '1'),
(1738, 'Tlachichuca', 21, '1'),
(1739, 'Lafragua', 21, '1'),
(1740, 'Chilchotla', 21, '1'),
(1741, 'Quimixtlán', 21, '1'),
(1742, 'Chichiquila', 21, '1'),
(1743, 'Tepatlaxco de Hidalgo', 21, '1'),
(1744, 'Acajete', 21, '1'),
(1745, 'Nopalucan', 21, '1'),
(1746, 'Mazapiltepec de Juárez', 21, '1'),
(1747, 'Soltepec', 21, '1'),
(1748, 'Acatzingo', 21, '1'),
(1749, 'San Salvador el Seco', 21, '1'),
(1750, 'General Felipe Ángeles', 21, '1'),
(1751, 'Aljojuca', 21, '1'),
(1752, 'San Juan Atenco', 21, '1'),
(1753, 'Tepeaca', 21, '1'),
(1754, 'Cuautinchán', 21, '1'),
(1755, 'Tecali de Herrera', 21, '1'),
(1756, 'Mixtla', 21, '1'),
(1757, 'Santo Tomás Hueyotlipan', 21, '1'),
(1758, 'Tzicatlacoyan', 21, '1'),
(1759, 'Huehuetlán el Grande', 21, '1'),
(1760, 'La Magdalena Tlatlauquitepec', 21, '1'),
(1761, 'San Juan Atzompa', 21, '1'),
(1762, 'Huatlatlauca', 21, '1'),
(1763, 'Los Reyes de Juárez', 21, '1'),
(1764, 'Cuapiaxtla de Madero', 21, '1'),
(1765, 'San Salvador Huixcolotla', 21, '1'),
(1766, 'Quecholac', 21, '1'),
(1767, 'Tecamachalco', 21, '1'),
(1768, 'Palmar de Bravo', 21, '1'),
(1769, 'Chalchicomula de Sesma', 21, '1'),
(1770, 'Atzitzintla', 21, '1'),
(1771, 'Esperanza', 21, '1'),
(1772, 'Cañada Morelos', 21, '1'),
(1773, 'Tlanepantla', 21, '1'),
(1774, 'Tochtepec', 21, '1'),
(1775, 'Atoyatempan', 21, '1'),
(1776, 'Tepeyahualco de Cuauhtémoc', 21, '1'),
(1777, 'Huitziltepec', 21, '1'),
(1778, 'Molcaxac', 21, '1'),
(1779, 'Xochitlán Todos Santos', 21, '1'),
(1780, 'Yehualtepec', 21, '1'),
(1781, 'Tlacotepec de Benito Juárez', 21, '1'),
(1782, 'Juan N. Méndez', 21, '1'),
(1783, 'Tehuacán', 21, '1'),
(1784, 'Tepanco de López', 21, '1'),
(1785, 'Chapulco', 21, '1'),
(1786, 'Santiago Miahuatlán', 21, '1'),
(1787, 'Nicolás Bravo', 21, '1'),
(1788, 'Atexcal', 21, '1'),
(1789, 'San Antonio Cañada', 21, '1'),
(1790, 'Zapotitlán', 21, '1'),
(1791, 'San Gabriel Chilac', 21, '1'),
(1792, 'Caltepec', 21, '1'),
(1793, 'Vicente Guerrero', 21, '1'),
(1794, 'Ajalpan', 21, '1'),
(1795, 'Eloxochitlán', 21, '1'),
(1796, 'Zoquitlán', 21, '1'),
(1797, 'San Sebastián Tlacotepec', 21, '1'),
(1798, 'Altepexi', 21, '1'),
(1799, 'Zinacatepec', 21, '1'),
(1800, 'San José Miahuatlán', 21, '1'),
(1801, 'Coxcatlán', 21, '1'),
(1802, 'Coyomeapan', 21, '1'),
(1803, 'Querétaro', 22, '1'),
(1804, 'El Marqués', 22, '1'),
(1805, 'Colón', 22, '1'),
(1806, 'Pinal de Amoles', 22, '1'),
(1807, 'Jalpan de Serra', 22, '1'),
(1808, 'Landa de Matamoros', 22, '1'),
(1809, 'Arroyo Seco', 22, '1'),
(1810, 'Peñamiller', 22, '1'),
(1811, 'Cadereyta de Montes', 22, '1'),
(1812, 'San Joaquín', 22, '1'),
(1813, 'Tolimán', 22, '1'),
(1814, 'Ezequiel Montes', 22, '1'),
(1815, 'Pedro Escobedo', 22, '1'),
(1816, 'Tequisquiapan', 22, '1'),
(1817, 'San Juan del Río', 22, '1'),
(1818, 'Amealco de Bonfil', 22, '1'),
(1819, 'Corregidora', 22, '1'),
(1820, 'Huimilpan', 22, '1'),
(1821, 'Othón P. Blanco', 23, '1'),
(1822, 'Felipe Carrillo Puerto', 23, '1'),
(1823, 'Lázaro Cárdenas', 23, '1'),
(1824, 'Isla Mujeres', 23, '1'),
(1825, 'Benito Juárez', 23, '1'),
(1826, 'Puerto Morelos', 23, '1'),
(1827, 'Cozumel', 23, '1'),
(1828, 'Solidaridad', 23, '1'),
(1829, 'Tulum', 23, '1'),
(1830, 'José María Morelos', 23, '1'),
(1831, 'Bacalar', 23, '1'),
(1832, 'San Luis Potosí', 24, '1'),
(1833, 'Soledad de Graciano Sánchez', 24, '1'),
(1834, 'Cerro de San Pedro', 24, '1'),
(1835, 'Ahualulco del Sonido 13', 24, '1'),
(1836, 'Mexquitic de Carmona', 24, '1'),
(1837, 'Villa de Arriaga', 24, '1'),
(1838, 'Vanegas', 24, '1'),
(1839, 'Cedral', 24, '1'),
(1840, 'Catorce', 24, '1'),
(1841, 'Charcas', 24, '1'),
(1842, 'Salinas', 24, '1'),
(1843, 'Santo Domingo', 24, '1'),
(1844, 'Villa de Ramos', 24, '1'),
(1845, 'Matehuala', 24, '1'),
(1846, 'Villa de la Paz', 24, '1'),
(1847, 'Villa de Guadalupe', 24, '1'),
(1848, 'Guadalcázar', 24, '1'),
(1849, 'Moctezuma', 24, '1'),
(1850, 'Venado', 24, '1'),
(1851, 'Villa de Arista', 24, '1'),
(1852, 'Villa Hidalgo', 24, '1'),
(1853, 'Armadillo de los Infante', 24, '1'),
(1854, 'Ciudad Valles', 24, '1'),
(1855, 'Ebano', 24, '1'),
(1856, 'Tamuín', 24, '1'),
(1857, 'El Naranjo', 24, '1'),
(1858, 'Ciudad del Maíz', 24, '1'),
(1859, 'Alaquines', 24, '1'),
(1860, 'Cárdenas', 24, '1'),
(1861, 'Cerritos', 24, '1'),
(1862, 'Villa Juárez', 24, '1'),
(1863, 'San Nicolás Tolentino', 24, '1'),
(1864, 'Villa de Reyes', 24, '1'),
(1865, 'Zaragoza', 24, '1'),
(1866, 'Santa María del Río', 24, '1'),
(1867, 'Tierra Nueva', 24, '1'),
(1868, 'Rioverde', 24, '1'),
(1869, 'Ciudad Fernández', 24, '1'),
(1870, 'San Ciro de Acosta', 24, '1'),
(1871, 'Tamasopo', 24, '1'),
(1872, 'Rayón', 24, '1'),
(1873, 'Aquismón', 24, '1'),
(1874, 'Lagunillas', 24, '1'),
(1875, 'Santa Catarina', 24, '1'),
(1876, 'Tancanhuitz', 24, '1'),
(1877, 'Tanlajás', 24, '1'),
(1878, 'San Vicente Tancuayalab', 24, '1'),
(1879, 'San Antonio', 24, '1'),
(1880, 'Tanquián de Escobedo', 24, '1'),
(1881, 'Tampamolón Corona', 24, '1'),
(1882, 'Coxcatlán', 24, '1'),
(1883, 'Huehuetlán', 24, '1'),
(1884, 'Xilitla', 24, '1'),
(1885, 'Axtla de Terrazas', 24, '1'),
(1886, 'Tampacán', 24, '1'),
(1887, 'San Martín Chalchicuautla', 24, '1'),
(1888, 'Tamazunchale', 24, '1'),
(1889, 'Matlapa', 24, '1'),
(1890, 'Culiacán', 25, '1'),
(1891, 'Navolato', 25, '1'),
(1892, 'Badiraguato', 25, '1'),
(1893, 'Cosalá', 25, '1'),
(1894, 'Mocorito', 25, '1'),
(1895, 'Guasave', 25, '1'),
(1896, 'Ahome', 25, '1'),
(1897, 'Salvador Alvarado', 25, '1'),
(1898, 'Angostura', 25, '1'),
(1899, 'Choix', 25, '1'),
(1900, 'El Fuerte', 25, '1'),
(1901, 'Sinaloa', 25, '1'),
(1902, 'Mazatlán', 25, '1'),
(1903, 'Escuinapa', 25, '1'),
(1904, 'Concordia', 25, '1'),
(1905, 'Elota', 25, '1'),
(1906, 'Rosario', 25, '1'),
(1907, 'San Ignacio', 25, '1'),
(1908, 'Hermosillo', 26, '1'),
(1909, 'San Miguel de Horcasitas', 26, '1'),
(1910, 'Carbó', 26, '1'),
(1911, 'San Luis Río Colorado', 26, '1'),
(1912, 'Puerto Peñasco', 26, '1'),
(1913, 'General Plutarco Elías Calles', 26, '1'),
(1914, 'Caborca', 26, '1'),
(1915, 'Altar', 26, '1'),
(1916, 'Tubutama', 26, '1'),
(1917, 'Atil', 26, '1'),
(1918, 'Oquitoa', 26, '1'),
(1919, 'Sáric', 26, '1'),
(1920, 'Benjamín Hill', 26, '1'),
(1921, 'Trincheras', 26, '1'),
(1922, 'Pitiquito', 26, '1'),
(1923, 'Nogales', 26, '1'),
(1924, 'Imuris', 26, '1'),
(1925, 'Santa Cruz', 26, '1'),
(1926, 'Magdalena', 26, '1'),
(1927, 'Naco', 26, '1'),
(1928, 'Agua Prieta', 26, '1'),
(1929, 'Fronteras', 26, '1'),
(1930, 'Nacozari de García', 26, '1'),
(1931, 'Bavispe', 26, '1'),
(1932, 'Bacerac', 26, '1'),
(1933, 'Huachinera', 26, '1'),
(1934, 'Nácori Chico', 26, '1'),
(1935, 'Granados', 26, '1'),
(1936, 'Bacadéhuachi', 26, '1'),
(1937, 'Cumpas', 26, '1'),
(1938, 'Huásabas', 26, '1'),
(1939, 'Moctezuma', 26, '1'),
(1940, 'Villa Hidalgo', 26, '1'),
(1941, 'Santa Ana', 26, '1'),
(1942, 'Cananea', 26, '1'),
(1943, 'Arizpe', 26, '1'),
(1944, 'Cucurpe', 26, '1'),
(1945, 'Bacoachi', 26, '1'),
(1946, 'San Pedro de la Cueva', 26, '1'),
(1947, 'Divisaderos', 26, '1'),
(1948, 'Tepache', 26, '1'),
(1949, 'Villa Pesqueira', 26, '1'),
(1950, 'Opodepe', 26, '1'),
(1951, 'Huépac', 26, '1'),
(1952, 'Banámichi', 26, '1'),
(1953, 'Ures', 26, '1'),
(1954, 'Aconchi', 26, '1'),
(1955, 'Baviácora', 26, '1'),
(1956, 'San Felipe de Jesús', 26, '1'),
(1957, 'Rayón', 26, '1'),
(1958, 'Cajeme', 26, '1'),
(1959, 'Navojoa', 26, '1'),
(1960, 'Huatabampo', 26, '1'),
(1961, 'Bácum', 26, '1'),
(1962, 'Etchojoa', 26, '1'),
(1963, 'Benito Juárez', 26, '1'),
(1964, 'Empalme', 26, '1'),
(1965, 'Guaymas', 26, '1'),
(1966, 'San Ignacio Río Muerto', 26, '1'),
(1967, 'La Colorada', 26, '1'),
(1968, 'Mazatán', 26, '1'),
(1969, 'Suaqui Grande', 26, '1'),
(1970, 'Sahuaripa', 26, '1'),
(1971, 'San Javier', 26, '1'),
(1972, 'Soyopa', 26, '1'),
(1973, 'Bacanora', 26, '1'),
(1974, 'Arivechi', 26, '1'),
(1975, 'Rosario', 26, '1'),
(1976, 'Quiriego', 26, '1'),
(1977, 'Ónavas', 26, '1'),
(1978, 'Álamos', 26, '1'),
(1979, 'Yécora', 26, '1'),
(1980, 'Centro', 27, '1'),
(1981, 'Jalpa de Méndez', 27, '1'),
(1982, 'Nacajuca', 27, '1'),
(1983, 'Comalcalco', 27, '1'),
(1984, 'Huimanguillo', 27, '1'),
(1985, 'Cárdenas', 27, '1'),
(1986, 'Paraíso', 27, '1'),
(1987, 'Cunduacán', 27, '1'),
(1988, 'Macuspana', 27, '1'),
(1989, 'Centla', 27, '1'),
(1990, 'Jonuta', 27, '1'),
(1991, 'Teapa', 27, '1'),
(1992, 'Jalapa', 27, '1'),
(1993, 'Tacotalpa', 27, '1'),
(1994, 'Tenosique', 27, '1'),
(1995, 'Balancán', 27, '1'),
(1996, 'Emiliano Zapata', 27, '1'),
(1997, 'Victoria', 28, '1'),
(1998, 'Llera', 28, '1'),
(1999, 'Güémez', 28, '1'),
(2000, 'Casas', 28, '1'),
(2001, 'Matamoros', 28, '1'),
(2002, 'Valle Hermoso', 28, '1'),
(2003, 'San Fernando', 28, '1'),
(2004, 'Cruillas', 28, '1'),
(2005, 'San Nicolás', 28, '1'),
(2006, 'Soto la Marina', 28, '1'),
(2007, 'Jiménez', 28, '1'),
(2008, 'San Carlos', 28, '1'),
(2009, 'Abasolo', 28, '1'),
(2010, 'Padilla', 28, '1'),
(2011, 'Hidalgo', 28, '1'),
(2012, 'Mainero', 28, '1'),
(2013, 'Villagrán', 28, '1'),
(2014, 'Tula', 28, '1'),
(2015, 'Jaumave', 28, '1'),
(2016, 'Miquihuana', 28, '1'),
(2017, 'Bustamante', 28, '1'),
(2018, 'Palmillas', 28, '1'),
(2019, 'Ocampo', 28, '1'),
(2020, 'Nuevo Laredo', 28, '1'),
(2021, 'Miguel Alemán', 28, '1'),
(2022, 'Guerrero', 28, '1'),
(2023, 'Mier', 28, '1'),
(2024, 'Gustavo Díaz Ordaz', 28, '1'),
(2025, 'Camargo', 28, '1'),
(2026, 'Reynosa', 28, '1'),
(2027, 'Río Bravo', 28, '1'),
(2028, 'Méndez', 28, '1'),
(2029, 'Burgos', 28, '1'),
(2030, 'Tampico', 28, '1'),
(2031, 'Ciudad Madero', 28, '1'),
(2032, 'Altamira', 28, '1'),
(2033, 'Aldama', 28, '1'),
(2034, 'González', 28, '1'),
(2035, 'Xicoténcatl', 28, '1'),
(2036, 'Gómez Farías', 28, '1'),
(2037, 'El Mante', 28, '1'),
(2038, 'Antiguo Morelos', 28, '1'),
(2039, 'Nuevo Morelos', 28, '1'),
(2040, 'Tlaxcala', 29, '1'),
(2041, 'Ixtacuixtla de Mariano Matamoros', 29, '1'),
(2042, 'Santa Ana Nopalucan', 29, '1'),
(2043, 'Panotla', 29, '1'),
(2044, 'Totolac', 29, '1'),
(2045, 'Tepeyanco', 29, '1'),
(2046, 'Santa Isabel Xiloxoxtla', 29, '1'),
(2047, 'San Juan Huactzinco', 29, '1'),
(2048, 'Calpulalpan', 29, '1'),
(2049, 'Sanctórum de Lázaro Cárdenas', 29, '1'),
(2050, 'Benito Juárez', 29, '1'),
(2051, 'Hueyotlipan', 29, '1'),
(2052, 'Tlaxco', 29, '1'),
(2053, 'Nanacamilpa de Mariano Arista', 29, '1'),
(2054, 'Españita', 29, '1'),
(2055, 'Apizaco', 29, '1'),
(2056, 'Atlangatepec', 29, '1'),
(2057, 'Muñoz de Domingo Arenas', 29, '1'),
(2058, 'Tetla de la Solidaridad', 29, '1'),
(2059, 'Xaltocan', 29, '1'),
(2060, 'San Lucas Tecopilco', 29, '1'),
(2061, 'Yauhquemehcan', 29, '1'),
(2062, 'Xaloztoc', 29, '1'),
(2063, 'Tocatlán', 29, '1'),
(2064, 'Tzompantepec', 29, '1'),
(2065, 'San José Teacalco', 29, '1'),
(2066, 'Huamantla', 29, '1'),
(2067, 'Terrenate', 29, '1'),
(2068, 'Lázaro Cárdenas', 29, '1'),
(2069, 'Emiliano Zapata', 29, '1'),
(2070, 'Atltzayanca', 29, '1'),
(2071, 'Cuapiaxtla', 29, '1'),
(2072, 'El Carmen Tequexquitla', 29, '1'),
(2073, 'Ixtenco', 29, '1'),
(2074, 'Ziltlaltépec de Trinidad Sánchez Santos', 29, '1'),
(2075, 'Apetatitlán de Antonio Carvajal', 29, '1'),
(2076, 'Amaxac de Guerrero', 29, '1'),
(2077, 'Santa Cruz Tlaxcala', 29, '1'),
(2078, 'Cuaxomulco', 29, '1'),
(2079, 'Contla de Juan Cuamatzi', 29, '1'),
(2080, 'Tepetitla de Lardizábal', 29, '1'),
(2081, 'Natívitas', 29, '1'),
(2082, 'Santa Apolonia Teacalco', 29, '1'),
(2083, 'Tetlatlahuca', 29, '1'),
(2084, 'San Damián Texóloc', 29, '1'),
(2085, 'San Jerónimo Zacualpan', 29, '1'),
(2086, 'Zacatelco', 29, '1'),
(2087, 'San Lorenzo Axocomanitla', 29, '1'),
(2088, 'Santa Catarina Ayometla', 29, '1'),
(2089, 'Xicohtzinco', 29, '1'),
(2090, 'Papalotla de Xicohténcatl', 29, '1'),
(2091, 'Chiautempan', 29, '1'),
(2092, 'La Magdalena Tlaltelulco', 29, '1'),
(2093, 'San Francisco Tetlanohcan', 29, '1'),
(2094, 'Teolocholco', 29, '1'),
(2095, 'Acuamanala de Miguel Hidalgo', 29, '1'),
(2096, 'Santa Cruz Quilehtla', 29, '1'),
(2097, 'Mazatecochco de José María Morelos', 29, '1'),
(2098, 'Tenancingo', 29, '1'),
(2099, 'San Pablo del Monte', 29, '1'),
(2100, 'Mérida', 30, '1'),
(2101, 'Progreso', 30, '1'),
(2102, 'Chicxulub Pueblo', 30, '1'),
(2103, 'Ixil', 30, '1'),
(2104, 'Conkal', 30, '1'),
(2105, 'Yaxkukul', 30, '1'),
(2106, 'Hunucmá', 30, '1'),
(2107, 'Ucú', 30, '1'),
(2108, 'Kinchil', 30, '1'),
(2109, 'Tetiz', 30, '1'),
(2110, 'Celestún', 30, '1'),
(2111, 'Kanasín', 30, '1'),
(2112, 'Timucuy', 30, '1'),
(2113, 'Acanceh', 30, '1'),
(2114, 'Tixpéhual', 30, '1'),
(2115, 'Umán', 30, '1'),
(2116, 'Telchac Pueblo', 30, '1'),
(2117, 'Dzemul', 30, '1'),
(2118, 'Telchac Puerto', 30, '1'),
(2119, 'Cansahcab', 30, '1'),
(2120, 'Sinanché', 30, '1'),
(2121, 'Yobaín', 30, '1'),
(2122, 'Motul', 30, '1'),
(2123, 'Baca', 30, '1'),
(2124, 'Mocochá', 30, '1'),
(2125, 'Muxupip', 30, '1'),
(2126, 'Cacalchén', 30, '1'),
(2127, 'Bokobá', 30, '1'),
(2128, 'Tixkokob', 30, '1'),
(2129, 'Hoctún', 30, '1'),
(2130, 'Tahmek', 30, '1'),
(2131, 'Dzidzantún', 30, '1'),
(2132, 'Temax', 30, '1'),
(2133, 'Tekantó', 30, '1'),
(2134, 'Teya', 30, '1'),
(2135, 'Suma', 30, '1'),
(2136, 'Tepakán', 30, '1'),
(2137, 'Tekal de Venegas', 30, '1'),
(2138, 'Izamal', 30, '1'),
(2139, 'Hocabá', 30, '1'),
(2140, 'Xocchel', 30, '1'),
(2141, 'Seyé', 30, '1'),
(2142, 'Cuzamá', 30, '1'),
(2143, 'Homún', 30, '1'),
(2144, 'Sanahcat', 30, '1'),
(2145, 'Huhí', 30, '1'),
(2146, 'Dzilam González', 30, '1'),
(2147, 'Dzilam de Bravo', 30, '1'),
(2148, 'Panabá', 30, '1'),
(2149, 'San Felipe', 30, '1'),
(2150, 'Buctzotz', 30, '1'),
(2151, 'Sucilá', 30, '1'),
(2152, 'Cenotillo', 30, '1'),
(2153, 'Dzoncauich', 30, '1'),
(2154, 'Tunkás', 30, '1'),
(2155, 'Quintana Roo', 30, '1'),
(2156, 'Dzitás', 30, '1'),
(2157, 'Kantunil', 30, '1'),
(2158, 'Sudzal', 30, '1'),
(2159, 'Tekit', 30, '1'),
(2160, 'Sotuta', 30, '1'),
(2161, 'Tizimín', 30, '1'),
(2162, 'Río Lagartos', 30, '1'),
(2163, 'Espita', 30, '1'),
(2164, 'Temozón', 30, '1'),
(2165, 'Calotmul', 30, '1'),
(2166, 'Tinum', 30, '1'),
(2167, 'Chankom', 30, '1'),
(2168, 'Chichimilá', 30, '1'),
(2169, 'Tixcacalcupul', 30, '1'),
(2170, 'Kaua', 30, '1'),
(2171, 'Cuncunul', 30, '1'),
(2172, 'Tekom', 30, '1'),
(2173, 'Chemax', 30, '1'),
(2174, 'Valladolid', 30, '1'),
(2175, 'Uayma', 30, '1'),
(2176, 'Maxcanú', 30, '1'),
(2177, 'Samahil', 30, '1'),
(2178, 'Opichén', 30, '1'),
(2179, 'Chocholá', 30, '1'),
(2180, 'Kopomá', 30, '1'),
(2181, 'Tecoh', 30, '1'),
(2182, 'Abalá', 30, '1'),
(2183, 'Halachó', 30, '1'),
(2184, 'Muna', 30, '1'),
(2185, 'Sacalum', 30, '1'),
(2186, 'Maní', 30, '1'),
(2187, 'Dzan', 30, '1'),
(2188, 'Chapab', 30, '1'),
(2189, 'Ticul', 30, '1'),
(2190, 'Oxkutzcab', 30, '1'),
(2191, 'Santa Elena', 30, '1'),
(2192, 'Mama', 30, '1'),
(2193, 'Chumayel', 30, '1'),
(2194, 'Mayapán', 30, '1'),
(2195, 'Teabo', 30, '1'),
(2196, 'Cantamayec', 30, '1'),
(2197, 'Yaxcabá', 30, '1'),
(2198, 'Peto', 30, '1'),
(2199, 'Chikindzonot', 30, '1'),
(2200, 'Tahdziú', 30, '1'),
(2201, 'Tixméhuac', 30, '1'),
(2202, 'Chacsinkín', 30, '1'),
(2203, 'Tzucacab', 30, '1'),
(2204, 'Tekax', 30, '1'),
(2205, 'Akil', 30, '1'),
(2206, 'Zacatecas', 31, '1'),
(2207, 'Morelos', 31, '1'),
(2208, 'Vetagrande', 31, '1'),
(2209, 'Concepción del Oro', 31, '1'),
(2210, 'Melchor Ocampo', 31, '1'),
(2211, 'Mazapil', 31, '1'),
(2212, 'El Salvador', 31, '1'),
(2213, 'Juan Aldama', 31, '1'),
(2214, 'Miguel Auza', 31, '1'),
(2215, 'General Francisco R. Murguía', 31, '1'),
(2216, 'Río Grande', 31, '1'),
(2217, 'Villa de Cos', 31, '1'),
(2218, 'Cañitas de Felipe Pescador', 31, '1'),
(2219, 'Calera', 31, '1'),
(2220, 'Pánuco', 31, '1'),
(2221, 'General Enrique Estrada', 31, '1'),
(2222, 'Guadalupe', 31, '1'),
(2223, 'Trancoso', 31, '1'),
(2224, 'Genaro Codina', 31, '1'),
(2225, 'Cuauhtémoc', 31, '1'),
(2226, 'Ojocaliente', 31, '1'),
(2227, 'General Pánfilo Natera', 31, '1'),
(2228, 'Luis Moya', 31, '1'),
(2229, 'Loreto', 31, '1'),
(2230, 'Villa González Ortega', 31, '1'),
(2231, 'Noria de Ángeles', 31, '1'),
(2232, 'Villa García', 31, '1'),
(2233, 'Pinos', 31, '1'),
(2234, 'Villa Hidalgo', 31, '1'),
(2235, 'Fresnillo', 31, '1'),
(2236, 'Sombrerete', 31, '1'),
(2237, 'Sain Alto', 31, '1'),
(2238, 'Valparaíso', 31, '1'),
(2239, 'Chalchihuites', 31, '1'),
(2240, 'Jiménez del Teul', 31, '1'),
(2241, 'Jerez', 31, '1'),
(2242, 'Monte Escobedo', 31, '1'),
(2243, 'Susticacán', 31, '1'),
(2244, 'Villanueva', 31, '1'),
(2245, 'Tepetongo', 31, '1'),
(2246, 'El Plateado de Joaquín Amaro', 31, '1'),
(2247, 'Jalpa', 31, '1'),
(2248, 'Tabasco', 31, '1'),
(2249, 'Huanusco', 31, '1'),
(2250, 'Tlaltenango de Sánchez Román', 31, '1'),
(2251, 'Momax', 31, '1'),
(2252, 'Atolinga', 31, '1'),
(2253, 'Tepechitlán', 31, '1'),
(2254, 'Benito Juárez', 31, '1'),
(2255, 'Teúl de González Ortega', 31, '1'),
(2256, 'Santa María de la Paz', 31, '1'),
(2257, 'Trinidad García de la Cadena', 31, '1'),
(2258, 'Mezquital del Oro', 31, '1'),
(2259, 'Nochistlán de Mejía', 31, '1'),
(2260, 'Apulco', 31, '1'),
(2261, 'Apozol', 31, '1'),
(2262, 'Juchipila', 31, '1'),
(2263, 'Moyahua de Estrada', 31, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `id_pais` int(11) NOT NULL,
  `nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`id_pais`, `nombre`) VALUES
(1, 'México');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refugio`
--

CREATE TABLE `refugio` (
  `id_refugio` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `descripcion` text NOT NULL,
  `foto` varchar(60) NOT NULL,
  `estatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `refugio`
--

INSERT INTO `refugio` (`id_refugio`, `nombre`, `descripcion`, `foto`, `estatus`) VALUES
(1, 'la lomita', 'refugio de test', 'pendiente', '1'),
(2, 'test', 'test', 'pendiente', '1'),
(3, 'sdcsd', 'cdsdc', 'pendiente', '1'),
(4, 'prueba_insercion', 'insercion de prueva', 'pendiente', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `refugio_direcciones`
--

CREATE TABLE `refugio_direcciones` (
  `id_refugio_direcciones` int(11) NOT NULL,
  `fk_refugio` int(11) NOT NULL,
  `fk_direccion` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `refugio_direcciones`
--

INSERT INTO `refugio_direcciones` (`id_refugio_direcciones`, `fk_refugio`, `fk_direccion`, `estatus`) VALUES
(1, 4, 1, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_formulario`
--

CREATE TABLE `respuestas_formulario` (
  `id_respuestas_formulario` int(11) NOT NULL,
  `respuestas` text NOT NULL,
  `fk_pregunta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL,
  `rol` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `rol`) VALUES
(1, 'Admin'),
(2, 'Usuario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_refugio`
--

CREATE TABLE `telefono_refugio` (
  `id_telefono_refugio` int(11) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `fk_refugio` int(11) NOT NULL,
  `estatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono_usuario`
--

CREATE TABLE `telefono_usuario` (
  `id_telefono_usuario` int(11) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `fk_usuario` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `foto` varchar(60) DEFAULT NULL,
  `fk_rol` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nombre`, `password`, `foto`, `fk_rol`, `estatus`) VALUES
(1, 'usuario1test', '123', 'foto', 2, '1'),
(2, 'usuario2test', '1234', 'foto', 2, '1'),
(18, 'test3uwu', '3test', 'foto', 2, '1'),
(19, 'NocheisHuman', '1234', 'foto', 2, '1'),
(20, 'test3uwu', '3test', 'foto', 2, '0'),
(21, 'test', 'tkvgygfg', 'foto', 2, '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_direcciones`
--

CREATE TABLE `usuarios_direcciones` (
  `id_usuarios_direcciones` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fk_direccion` int(11) NOT NULL,
  `estatus` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_refugio`
--

CREATE TABLE `usuario_refugio` (
  `id_usuario_refugio` int(11) NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `fK_refugio` int(11) NOT NULL,
  `estatus` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD PRIMARY KEY (`id_adopcion`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Indices de la tabla `correo_refugio`
--
ALTER TABLE `correo_refugio`
  ADD PRIMARY KEY (`id_correo_refugio`),
  ADD KEY `fk_refugio` (`fk_refugio`);

--
-- Indices de la tabla `correo_usuario`
--
ALTER TABLE `correo_usuario`
  ADD PRIMARY KEY (`id_correo_usuario`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Indices de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD PRIMARY KEY (`id_datos_personales`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Indices de la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD PRIMARY KEY (`id_direccion`),
  ADD KEY `fk_direccion_colonia` (`fk_colonia`);

--
-- Indices de la tabla `especie`
--
ALTER TABLE `especie`
  ADD PRIMARY KEY (`id_especie`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`),
  ADD KEY `fk_pais` (`fk_pais`);

--
-- Indices de la tabla `formulario_adopcion`
--
ALTER TABLE `formulario_adopcion`
  ADD PRIMARY KEY (`id_formulario`),
  ADD KEY `fK_adopcion` (`fK_adopcion`);

--
-- Indices de la tabla `historia_feliz`
--
ALTER TABLE `historia_feliz`
  ADD PRIMARY KEY (`id_historia_feliz`),
  ADD KEY `fk_mascota` (`fk_mascota`);

--
-- Indices de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD PRIMARY KEY (`id_mascotas`),
  ADD KEY `fk_especie` (`fk_especie`),
  ADD KEY `fk_refugio` (`fk_refugio`);

--
-- Indices de la tabla `mascotas_adopcion`
--
ALTER TABLE `mascotas_adopcion`
  ADD PRIMARY KEY (`id_mascotas_adopcion`),
  ADD KEY `fk_mascota` (`fk_mascota`),
  ADD KEY `fk_adopcion` (`fk_adopcion`);

--
-- Indices de la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD PRIMARY KEY (`id_municipio`),
  ADD KEY `fk_estado` (`fk_estado`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id_pais`);

--
-- Indices de la tabla `refugio`
--
ALTER TABLE `refugio`
  ADD PRIMARY KEY (`id_refugio`);

--
-- Indices de la tabla `refugio_direcciones`
--
ALTER TABLE `refugio_direcciones`
  ADD PRIMARY KEY (`id_refugio_direcciones`),
  ADD KEY `fk_refugio` (`fk_refugio`),
  ADD KEY `fk_direccion` (`fk_direccion`);

--
-- Indices de la tabla `respuestas_formulario`
--
ALTER TABLE `respuestas_formulario`
  ADD PRIMARY KEY (`id_respuestas_formulario`),
  ADD KEY `fk_pregunta` (`fk_pregunta`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `telefono_refugio`
--
ALTER TABLE `telefono_refugio`
  ADD PRIMARY KEY (`id_telefono_refugio`),
  ADD KEY `fk_refugio` (`fk_refugio`);

--
-- Indices de la tabla `telefono_usuario`
--
ALTER TABLE `telefono_usuario`
  ADD PRIMARY KEY (`id_telefono_usuario`),
  ADD KEY `fk_usuario` (`fk_usuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_rol` (`fk_rol`);

--
-- Indices de la tabla `usuarios_direcciones`
--
ALTER TABLE `usuarios_direcciones`
  ADD PRIMARY KEY (`id_usuarios_direcciones`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_direccion` (`fk_direccion`);

--
-- Indices de la tabla `usuario_refugio`
--
ALTER TABLE `usuario_refugio`
  ADD PRIMARY KEY (`id_usuario_refugio`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fK_refugio` (`fK_refugio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adopcion`
--
ALTER TABLE `adopcion`
  MODIFY `id_adopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correo_refugio`
--
ALTER TABLE `correo_refugio`
  MODIFY `id_correo_refugio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `correo_usuario`
--
ALTER TABLE `correo_usuario`
  MODIFY `id_correo_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  MODIFY `id_datos_personales` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `direccion`
--
ALTER TABLE `direccion`
  MODIFY `id_direccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `especie`
--
ALTER TABLE `especie`
  MODIFY `id_especie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `formulario_adopcion`
--
ALTER TABLE `formulario_adopcion`
  MODIFY `id_formulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historia_feliz`
--
ALTER TABLE `historia_feliz`
  MODIFY `id_historia_feliz` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas`
--
ALTER TABLE `mascotas`
  MODIFY `id_mascotas` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mascotas_adopcion`
--
ALTER TABLE `mascotas_adopcion`
  MODIFY `id_mascotas_adopcion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `municipio`
--
ALTER TABLE `municipio`
  MODIFY `id_municipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2264;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `id_pais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `refugio`
--
ALTER TABLE `refugio`
  MODIFY `id_refugio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `refugio_direcciones`
--
ALTER TABLE `refugio_direcciones`
  MODIFY `id_refugio_direcciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `respuestas_formulario`
--
ALTER TABLE `respuestas_formulario`
  MODIFY `id_respuestas_formulario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `telefono_refugio`
--
ALTER TABLE `telefono_refugio`
  MODIFY `id_telefono_refugio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `telefono_usuario`
--
ALTER TABLE `telefono_usuario`
  MODIFY `id_telefono_usuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `usuarios_direcciones`
--
ALTER TABLE `usuarios_direcciones`
  MODIFY `id_usuarios_direcciones` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_refugio`
--
ALTER TABLE `usuario_refugio`
  MODIFY `id_usuario_refugio` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adopcion`
--
ALTER TABLE `adopcion`
  ADD CONSTRAINT `adopcion_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `correo_refugio`
--
ALTER TABLE `correo_refugio`
  ADD CONSTRAINT `correo_refugio_ibfk_1` FOREIGN KEY (`fk_refugio`) REFERENCES `refugio` (`id_refugio`);

--
-- Filtros para la tabla `correo_usuario`
--
ALTER TABLE `correo_usuario`
  ADD CONSTRAINT `correo_usuario_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `datos_personales`
--
ALTER TABLE `datos_personales`
  ADD CONSTRAINT `datos_personales_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `direccion`
--
ALTER TABLE `direccion`
  ADD CONSTRAINT `fk_direccion_colonia` FOREIGN KEY (`fk_colonia`) REFERENCES `colonia` (`id_colonia`);

--
-- Filtros para la tabla `estado`
--
ALTER TABLE `estado`
  ADD CONSTRAINT `estado_ibfk_1` FOREIGN KEY (`fk_pais`) REFERENCES `pais` (`id_pais`);

--
-- Filtros para la tabla `formulario_adopcion`
--
ALTER TABLE `formulario_adopcion`
  ADD CONSTRAINT `formulario_adopcion_ibfk_1` FOREIGN KEY (`fK_adopcion`) REFERENCES `adopcion` (`id_adopcion`);

--
-- Filtros para la tabla `historia_feliz`
--
ALTER TABLE `historia_feliz`
  ADD CONSTRAINT `historia_feliz_ibfk_1` FOREIGN KEY (`fk_mascota`) REFERENCES `mascotas` (`id_mascotas`);

--
-- Filtros para la tabla `mascotas`
--
ALTER TABLE `mascotas`
  ADD CONSTRAINT `mascotas_ibfk_1` FOREIGN KEY (`fk_especie`) REFERENCES `especie` (`id_especie`),
  ADD CONSTRAINT `mascotas_ibfk_2` FOREIGN KEY (`fk_refugio`) REFERENCES `refugio` (`id_refugio`);

--
-- Filtros para la tabla `mascotas_adopcion`
--
ALTER TABLE `mascotas_adopcion`
  ADD CONSTRAINT `mascotas_adopcion_ibfk_1` FOREIGN KEY (`fk_mascota`) REFERENCES `mascotas` (`id_mascotas`),
  ADD CONSTRAINT `mascotas_adopcion_ibfk_2` FOREIGN KEY (`fk_adopcion`) REFERENCES `adopcion` (`id_adopcion`);

--
-- Filtros para la tabla `municipio`
--
ALTER TABLE `municipio`
  ADD CONSTRAINT `municipio_ibfk_1` FOREIGN KEY (`fk_estado`) REFERENCES `estado` (`id_estado`);

--
-- Filtros para la tabla `refugio_direcciones`
--
ALTER TABLE `refugio_direcciones`
  ADD CONSTRAINT `refugio_direcciones_ibfk_1` FOREIGN KEY (`fk_refugio`) REFERENCES `refugio` (`id_refugio`),
  ADD CONSTRAINT `refugio_direcciones_ibfk_2` FOREIGN KEY (`fk_direccion`) REFERENCES `direccion` (`id_direccion`);

--
-- Filtros para la tabla `respuestas_formulario`
--
ALTER TABLE `respuestas_formulario`
  ADD CONSTRAINT `respuestas_formulario_ibfk_1` FOREIGN KEY (`fk_pregunta`) REFERENCES `formulario_adopcion` (`id_formulario`);

--
-- Filtros para la tabla `telefono_refugio`
--
ALTER TABLE `telefono_refugio`
  ADD CONSTRAINT `telefono_refugio_ibfk_1` FOREIGN KEY (`fk_refugio`) REFERENCES `refugio` (`id_refugio`);

--
-- Filtros para la tabla `telefono_usuario`
--
ALTER TABLE `telefono_usuario`
  ADD CONSTRAINT `telefono_usuario_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`fk_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `usuarios_direcciones`
--
ALTER TABLE `usuarios_direcciones`
  ADD CONSTRAINT `usuarios_direcciones_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuarios_direcciones_ibfk_2` FOREIGN KEY (`fk_direccion`) REFERENCES `direccion` (`id_direccion`);

--
-- Filtros para la tabla `usuario_refugio`
--
ALTER TABLE `usuario_refugio`
  ADD CONSTRAINT `usuario_refugio_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuario` (`id_usuario`),
  ADD CONSTRAINT `usuario_refugio_ibfk_2` FOREIGN KEY (`fK_refugio`) REFERENCES `refugio` (`id_refugio`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
