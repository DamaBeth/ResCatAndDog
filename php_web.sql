-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-12-2020 a las 02:28:52
-- Versión del servidor: 10.4.16-MariaDB
-- Versión de PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `php_web`
--
DROP DATABASE IF EXISTS `php_web`;
CREATE DATABASE IF NOT EXISTS `php_web` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `php_web`;

-- --------------------------------------------------------
--
-- Estructura de tabla para la tabla `usuario`
--
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(70) NOT NULL,
  `calle` varchar(70) NOT NULL,
  `colonia` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `noExterior` varchar(10) NOT NULL,
  `noInterior` varchar(10) DEFAULT NULL,
  `correo` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `telefono` varchar(13) NOT NULL,
  `username` varchar(25) NOT NULL,
  `tipo` enum('A','B','C') NOT NULL DEFAULT 'B'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `calle`, `colonia`, `estado`, `noExterior`, `noInterior`, `correo`, `password`, `telefono`, `username`,`tipo`) VALUES
(1, 'Ariel', 'Amapolas', 'Centro', 'Puebla', '94A', NULL, 'ariB@hotmail.com', '123456', '2446882172', 'AriB','B'),
(2, 'Rodrigo', 'Fresas', 'Analco', 'Puebla', '10A', NULL, 'rodri@hotmail.com', '1234', '2461264152', 'ricardo','C'),
(3, 'Alejandro', 'Av. 5 de mayo', 'Centro', 'Puebla', '101', NULL, 'alex@hotmail.com', '1234', '22247896512', 'alejandro','B'),
(4, 'Lluvia Naomy Carmona Avewndaño', 'Hidalgo', 'Centro', 'Tlaxcala', '513', 's/N', 'lluvia_naomy@hotmail.com', '12345', '+522411107411', 'NaomySinHYConY','A'),
(5, 'Damaris Lizbeth Quiroz Cuautle','Av. del Prado','Valle Real','Puebla','94A',NULL,'owl_dmth@hotmail.com','uwu','26565362','Dama','A');

--
-- Estructura de tabla para la tabla `adoptante`
--

DROP TABLE IF EXISTS `adoptante`;
CREATE TABLE `adoptante` (
  `idAdoptante` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `adoptante`
--

INSERT INTO `adoptante` (`idAdoptante`, `idUsuario`) VALUES
(1, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `name`) VALUES
(1, 'Todos'),
(2, 'Perros'),
(3, 'Gatos'),
(4, 'Hámsters'),
(5, 'Hurones'),
(6, 'Loros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidador`
--

DROP TABLE IF EXISTS `cuidador`;
CREATE TABLE `cuidador` (
  `idCuidador` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cuidador`
--

INSERT INTO `cuidador` (`idCuidador`, `idUsuario`) VALUES
(1, 1),
(2, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota`
--

DROP TABLE IF EXISTS `mascota`;
CREATE TABLE `mascota` (
  `idMascota` int(11) NOT NULL,
  `comentarios` varchar(350) NOT NULL,
  `edad` int(11) NOT NULL,
  `foto` varchar(150) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `sexo` varchar(20) NOT NULL COMMENT 'Hembra/Macho',
  `categoria` int(11) NOT NULL,
  `estado` varchar(20) NOT NULL COMMENT 'activo/inactivo',
  `cuidador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `mascota`
--

INSERT INTO `mascota` (`idMascota`, `comentarios`, `edad`, `foto`, `tipo`, `nombre`, `sexo`, `categoria`, `estado`, `cuidador`) VALUES
(1, 'Beagle cachorro, le gusta salir a pasear', 5, 'beagle.jpg', 'Beagle', 'Chispa', 'Hembra', 2, 'activo', 2),
(2, 'Husky cachorro, le gusta comer mucho', 5, 'husky.png', 'Husky', 'Max', 'Macho', 2, 'activo', 1),
(3, 'Bien portado, le gusta jugar mucho xD', 6, 'bulldog_Frances.png', 'Bulldog', 'Zeus', 'Macho', 2, 'activo', 1),
(4, 'Es algo agresivo xD', 13, 'chihuahua.png', 'Chihuahua', 'Ozzy', 'Macho', 2, 'activo', 2),
(5, 'Es muy tierno ', 2, 'labrador.png', 'Labrador', 'Toby', 'Macho', 2, 'activo', 2),
(6, 'Es muy juguetón', 9, 'pitbull.png', 'Pitbull', 'Rayo', 'Macho', 2, 'activo', 2),
(7, 'Es un gato muy tranquilo', 24, 'persa.png', 'Persa', 'Ramsés', 'Macho', 3, 'activo', 2),
(8, 'Es una gata inquieta, pero muy cariñosa.', 7, 'siamés.png', 'Siamés', 'Bonnie', 'Hembra', 3, 'activo', 2),
(9, 'Es muy tranquila y come mucho', 12, 'himalayo.png', 'Himalayo', 'Frida', 'Hembra', 3, 'activo', 1),
(10, 'Es tranquila y le gusta dormir mucho', 14, 'ragdoll.png', 'Ragdoll', 'Mina', 'Hembra', 3, 'activo', 2),
(11, 'Perro juguetón y muy travieso', 5, 'san_bernardo.png', 'San Bernardo', 'Milo', 'Macho', 2, 'inactivo', 1),
(12, 'Es tierno :3', 1, 'gato.png', 'Raza desconocida', 'Nala', 'Hembra', 3, 'activo', 1),
(13, 'Es muy activo y le encanta jugar con la pelota', 10, 'pastor_aleman.png', 'Pastor Alemán', 'Skar', 'Macho', 2, 'activo', 2),
(14, 'Es muy juguetón y cariñoso', 5, 'pug.png', 'Pug', 'Chachito', 'Macho', 2, 'activo', 1),
(15, 'Hámster pequeño, pero muy travieso', 24, 'hamsterChino.png', 'Hámster Chino', 'Pancho', 'Macho', 4, 'activo', 2),
(16, 'Hámster tranquilo, aunque come mucho', 29, 'hamsterSirio.png', 'Hámster Sirio', 'Pluto', 'Macho', 4, 'activo', 1),
(17, 'Hámster traviesa, pero es muy cariñosa', 16, 'hamsterRuso.png', 'Hámster Ruso', 'Niebla', 'Hembra', 4, 'activo', 1),
(18, 'Este pequeño hurón es muy lindo y travieso', 10, 'huronAlbino.png', 'Hurón Albino', 'Eros', 'Macho', 5, 'activo', 1),
(19, 'Le gusta esconderse mucho, es muy traviesa', 20, 'huronSableNegro.png', 'Hurón Sable Negro', 'Gala', 'Hembra', 5, 'activo', 2),
(20, 'Hámster pequeño, pero muy travieso...', 14, 'huronChocolate.png', 'Hurón Chocolate', 'Zuri', 'Hembra', 5, 'activo', 2),
(21, 'Loro exótico, sabe imitar varios sonidos', 42, 'loroArcoiris.png', 'Loro Acoíris', 'Harry', 'Macho', 6, 'activo', 1),
(22, 'Loro de diferentes colores, le gusta imitar canciones', 54, 'loroCariamarillo.png', 'Loro Cariamarillo', 'Lady', 'Hembra', 6, 'activo', 1),
(23, 'Sabe imitar algunas frases en español e inglés', 34, 'loroGris.png', 'Loro Gris', 'Osiris', 'Macho', 6, 'activo', 2),
(24, 'Pequeño hámster, juguetón y travieso', 4, 'hamsterPanda.png', 'Hásmter Panda', 'Ulises', 'Macho', 4, 'activo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mp_pages`
--

DROP TABLE IF EXISTS `mp_pages`;
CREATE TABLE `mp_pages` (
  `page_id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_desc` text DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `sort_order` int(11) NOT NULL DEFAULT 0,
  `parent` varchar(255) NOT NULL DEFAULT '0',
  `status` enum('A','I') NOT NULL DEFAULT 'A',
  `page_alias` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mp_pages`
--

INSERT INTO `mp_pages` (`page_id`, `page_title`, `page_desc`, `meta_keywords`, `meta_desc`, `sort_order`, `parent`, `status`, `page_alias`) VALUES
(1, '¡Bienvenido!', '<span style=\\\"font-size: large;\\\">En <span style=\\\"font-weight: bold;\\\">ResCat&amp;Dog </span>queremos que esta experiencia sea lo mejor para adoptantes, cuidadores y huellitas, y como sabemos que tener una huellita en casa no es un juego, te compartimos algunos tips útiles para disfrutar al máximo el tiempo que una huellita pase contigo.</span><div style=\\\"\\\"><span style=\\\"font-size: x-large;\\\"><br></span></div><h2 style=\\\"\\\"><span style=\\\"font-size: x-large;\\\">Guía del humano responsable</span></h2><div style=\\\"\\\"><span style=\\\"font-size: x-large;\\\"><br></span></div><h2 style=\\\"\\\"><span style=\\\"font-size: x-large;\\\">Cachorros:</span></h2><div style=\\\"font-size: 10pt;\\\"><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 5px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Collar ligero</label>&nbsp;de lona sín ganchos e ir cambiando como va creciendo con&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">plaquita de identificación:</label>&nbsp;nombre, dirección y teléfono, y/o chip-tatuaje.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Desparasitar</label>&nbsp;recién llegado y cada 6 meses aprox.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">– Tener&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">agua limpia disponible</label>&nbsp;siempre (24 horas al día).</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Vacunarlo</label>&nbsp;y no pasearlo en áreas públicas hasta terminar con todas. Después del año, la séxtuple cada siguiente.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">La esterilización</label>&nbsp;es fundamental por seguridad y responsabilidad. (Recordar no hacerlo hasta pasar 15 días después de su última vacuna). Después de los 6 meses de edad.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Comer cuatro veces</label>&nbsp;al día o más.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Baño como máximo</label>&nbsp;1 vez cada 2 semanas (a no ser que sea necesario) sugerencia: jabón de avena “grisi” o shampoo Epi Sooth.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">– Destinar&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">juguetes</label>&nbsp;en un lugar especial, limpiar, guardar y cambiar. (trapos, cuerdas, mordederas, pelotas rellenables “Kongs”, carnaza etc).</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Separar tres áreas</label>: Comer, dormir y hacer.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">¡No golpes!</label>&nbsp;Aprenden asociando ideas y con palabras como “¡No!” o “¡Bien!” y cambio en nuestra actitud.</span></p><p style=\\\"box-sizing: border-box; margin: 0px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Recompensas</label>&nbsp;y cariños como premios.</span></p><p style=\\\"box-sizing: border-box; margin: 0px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\"><br></span></p><h2><span style=\\\"font-size: x-large;\\\">Adulto joven en adelante:</span></h2><p style=\\\"box-sizing: border-box; margin: 0px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\"><br></span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 5px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Collar ligero</label>&nbsp;de lona sín ganchos e ir cambiando como va creciendo con&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">plaquita de identificación</label>: nombre, dirección y teléfono, y/o chip-tatuaje.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Desparasitar</label>&nbsp;recién llegado y cada 6 meses aproximadamente.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Vacunar</label>&nbsp;la séxtuple cada año todos los siguientes.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Esterilizar</label>&nbsp;es fundamental por salud y seguridad. En cuanto recupere peso y siempre después de 15 días o más de su última vacunación.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">– Tener&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">agua limpia disponible</label>&nbsp;siempre (24 horas al día).</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Comer 2 veces al día</label>&nbsp;alimento DE CORDERO seco y/o mezclado con caldo, arroz o lata (no más de 10%, retirar sobrante refrigerar).</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Salir a pasear con correa y placa de identificación</label>&nbsp;por lo menos 2 veces al día, por salud, limpieza y reconocimiento de su territorio (chip, tatuaje).</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Bañar como máximo 1 vez cada 2 semanas,</label>&nbsp;en promedio sugerencia: jabón de avena “Grisi”, parasiticida tópico como Revolution, Advantage o Frontline.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">– Destinar&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">juguetes</label>&nbsp;lugar especial: limpiar, cambiar y guardar, carnaza, pelotas rellenables “Kongs”, trapos, cuerdas, mordederas etc.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Separar tres áreas</label>, comer dormir (camita o cojín) y hacer.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">¡No golpes!</label>, aprenden asociando ideas y diciendo “¡No!” o “¡Bien!” (cambio tono de voz y actitud) Recompensas y cariños, como premios (pedacitos de salchicha, tocinetas, palmadas, etc.).</span></p><p style=\\\"box-sizing: border-box; margin: 0px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"font-size: large;\\\">–&nbsp;<label class=\\\"negritas\\\" style=\\\"box-sizing: border-box; margin: auto auto 0px; display: inline; max-width: 100%; font-weight: bold; font-family: Raleway, sans-serif; font-stretch: normal; line-height: 1.54; text-align: left;\\\">Entrenamiento básico</label>, fácil de aprender a cualquier edad y muy necesario en perros activos y jóvenes siempre con premio y estimulo.</span></p><p style=\\\"box-sizing: border-box; margin: 0px; line-height: 1.8em; font-family: \\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" font-size:=\\\"\\\" 13px;=\\\"\\\" text-align:=\\\"\\\" justify;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><br></p></div>', 'visitantes', 'inicio visitantes', 0, '-1', 'A', 'index'),
(2, 'Nosotros', '<p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em;\\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"box-sizing: border-box; margin-bottom: 0px; font-size: large;\\\"><span style=\\\"box-sizing: border-box; font-weight: 700; margin-bottom: 0px;\\\">ResCat&amp;Dog</span>&nbsp;nació por la falta de alternativas de ayuda al abandono de perros y gatos de la ciudad hace ya más de diez años.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em;\\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"box-sizing: border-box; margin-bottom: 0px; font-size: large;\\\">Debido a que el gobierno los extermina como fauna nociva y los albergues, refugios y antirrábicos tienen sobre población grave, con terrible atención.</span></p><p style=\\\"box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em;\\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"box-sizing: border-box; margin-bottom: 0px;\\\">&nbsp;La&nbsp; difusión de persona a persona&nbsp; es tan valiosa que puede significar una oportunidad de vida para ellos.&nbsp; <span style=\\\"font-size: large;\\\">Evitando pasar por esos lugares que a menudo representan su maltrato y muerte.</span></span></p><p style=\\\"font-size: 10pt; box-sizing: border-box; margin: 0px 0px 10px; line-height: 1.8em;\\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"box-sizing: border-box; margin-bottom: 0px; font-size: large;\\\">Consideramos que las causas más directas a esta problemática son:</span></p><ul style=\\\"font-size: 10pt;\\\"><li><span style=\\\"font-size: large; background-color: rgb(255, 255, 255); font-family: Raleway, sans-serif;\\\">Falta de información de cuidado.</span></li><li><span style=\\\"font-size: large; background-color: rgb(255, 255, 255); font-family: Raleway, sans-serif;\\\">Mitos y explotación veterinaria.</span></li><li><span style=\\\"font-size: large; background-color: rgb(255, 255, 255); font-family: Raleway, sans-serif;\\\">Abandono por mal comportamiento, falta de tiempo, cambio de domicilio, alergia, etc.</span></li><li><span style=\\\"font-size: large; background-color: rgb(255, 255, 255); font-family: Raleway, sans-serif;\\\">Comercialización&nbsp; sin regulación alguna.</span></li><li><span style=\\\"font-size: large; background-color: rgb(255, 255, 255); font-family: Raleway, sans-serif;\\\">Falta de apoyo&nbsp; y concientización de esterilización por comercio de reproducción.</span></li></ul><p style=\\\"font-size: 10pt; box-sizing: border-box; margin: 0px; line-height: 1.8em;\\\" open=\\\"\\\" sans\\\",=\\\"\\\" sans-serif;=\\\"\\\" background-color:=\\\"\\\" rgb(255,=\\\"\\\" 255,=\\\"\\\" 255);\\\"=\\\"\\\"><span style=\\\"box-sizing: border-box; margin-bottom: 0px; font-size: large;\\\">Haciendo conciencia de la realidad que ellos viven se logra detener en gran medida el exterminio indiscriminado que es en su mayoría, abandono familiar.</span></p>', 'about us', 'ResCatAndDog', 1, '-1', 'A', 'about-us'),
(3, 'Iniciar sesión', '<span style=\\\"font-weight: bold;\\\">Regístrate y sé parte de nuestra comunidad :) <br><br></div>', 'Baulphp', 'Baulphp', 3, '-1', 'A', 'login'),
(4, 'Catálogo', 'Aquí van todos los perritos y gatitos y eso uvur', 'category', 'description goes here', 1, '-1', 'A', 'catalog'),
(5, 'PHP', 'PHP is a server-side scripting language designed for web development but also used as a general-purpose programming language. PHP is now installed on more than 244 million websites and 2.1 million web servers Originally created by Rasmus Lerdorf in 1995, the reference implementation of PHP is now produced by The PHP Group. While PHP originally stood for Personal Home Page, it now stands for PHP: Hypertext Preprocessor, a recursive acronym<br><br>PHP code is interpreted by a web server with a PHP processor module, which generates the resulting web page: PHP commands can be embedded directly into an HTML source document rather than calling an external file to process data. It has also evolved to include a command-line interface capability and can be used in standalone graphical applications<br>', '', '', 1, '9', 'A', 'php'),
(6, 'Mysql', 'MySQL officially, but also called My Seque is (as of July 2013) the world\'s second most widely used open-source relational database management system (RDBMS). It is named after co-founder Michael Widenius\'s daughterThe SQL phrase stands for Structured Query Language<br><br>The default port of Mysql is 3306. The MySQL development project has made its source code available under the terms of the GNU General Public License, as well as under a variety of proprietary agreements. MySQL was owned and sponsored by a single for-profit firm, the Swedish company MySQL AB, now owned by Oracle Corporation<br><br>MySQL is a popular choice of database for use in web applications, and is a central component of the widely used LAMP open source web application software stack (and other \'AMP\' stacks). LAMP is an acronym for \"Linux, Apache, MySQL, Perl/PHP/Python.\" Free-software-open source projects that require a full-featured database management system often use MySQL.<br><br>', '', '', 2, '9', 'A', 'mysql'),
(7, 'Ajax', 'Ajax (an acronym for Asynchronous JavaScript and XML) is a group of interrelated web development techniques used on the client-side to create asynchronous web applications. With Ajax, web applications can send data to, and retrieve data from, a server asynchronously (in the background) without interfering with the display and behavior of the existing page. Data can be retrieved using the XMLHttpRequest object. Despite the name, the use of XML is not required (JSON is often used instead. See AJAJ), and the requests do not need to be asynchronous.<br><br>Ajax is not a single technology, but a group of technologies. HTML and CSS can be used in combination to mark up and style information. The DOM is accessed with JavaScript to dynamically display, and allow the user to interact with, the information presented. JavaScript and the XMLHttpRequest object provide a method for exchanging data asynchronously between browser and server to avoid full page reloads.<br><br>', '', '', 2, '9', 'A', 'ajax'),
(8, 'Registrarse', '<font face=\\\"Arial, Verdana\\\" style=\\\"font-size: x-large;\\\">Por favor, ingresa los datos que te son solicitados</font>', 'pruebas', 'pruebas', 1, '-1', 'A', 'signin'),
(9, 'Ver Mascota', '<span style=\\\"font-size: 13.3333px;\\\">Aquí se ven los detalles de la mascota seleccionada.</span>', 'ver mascota', '', 2, '9', 'A', 'ver-mascota'),
(10, 'Admin Catalogo', 'Aquí el administrador puede realizar un CRUD en el catálogo', 'admin catalogo', '', 3, '-1', 'A', 'admin-catalogo'),
(11, 'Modificar Mascota', 'Aquí se pueden modificar los datos de una mascota', 'modificar mascota', '', 3, '-1', 'A', 'modificar-mascota'),
(12, 'Agregar Mascota', 'Aquí se puede agregar una nueva mascota&nbsp;', 'agregar mascota', '', 3, '-1', 'A', 'agregar-mascota'),
(13, 'Cuidador Catalogo', 'Aquí el usuario \\\'Cuidador\\\', puede agregar, modificar, visualizar y eliminar sus mascotas', 'cuidador catalogo', '', 3, '-1', 'A', 'cuidador-catalogo'),
(14, 'Nueva solicitud', '', '', '', 0, '-1', 'A', 'creaSolicitud'),
(15, 'Ver solicitudes', '', '', '', 0, '-1', 'A', 'verSolicitudes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mp_tagline`
--

DROP TABLE IF EXISTS `mp_tagline`;
CREATE TABLE `mp_tagline` (
  `id` int(11) NOT NULL,
  `tagline1` varchar(255) DEFAULT NULL,
  `tagline2` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `mp_tagline`
--

INSERT INTO `mp_tagline` (`id`, `tagline1`, `tagline2`) VALUES
(1, 'www.rescatanddog.com', 'ResCat&Dog');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

DROP TABLE IF EXISTS `solicitud`;
CREATE TABLE `solicitud` (
  `idSolicitud` int(11) NOT NULL,
  `comentarios` varchar(500) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idCuidador` int(11) NOT NULL,
  `idAdoptante` int(11) NOT NULL,
  `idMascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `solicitud`
--

INSERT INTO `solicitud` (`idSolicitud`, `comentarios`, `fecha`, `idCuidador`, `idAdoptante`, `idMascota`) VALUES
(1, 'Me gustaría adoptar esta huellita ', '2020-12-02 19:08:56', 1, 1, 3);

-- --------------------------------------------------------


--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `adoptante`
--
ALTER TABLE `adoptante`
  ADD PRIMARY KEY (`idAdoptante`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cuidador`
--
ALTER TABLE `cuidador`
  ADD PRIMARY KEY (`idCuidador`),
  ADD KEY `fk_cuidador_usuario1_idx` (`idUsuario`);

--
-- Indices de la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`idMascota`),
  ADD KEY `categoria` (`categoria`),
  ADD KEY `cuidador` (`cuidador`);

--
-- Indices de la tabla `mp_pages`
--
ALTER TABLE `mp_pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_name` (`page_alias`);

--
-- Indices de la tabla `mp_tagline`
--
ALTER TABLE `mp_tagline`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `idCuidador` (`idCuidador`),
  ADD KEY `idAdoptante` (`idAdoptante`),
  ADD KEY `idMascota` (`idMascota`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `adoptante`
--
ALTER TABLE `adoptante`
  MODIFY `idAdoptante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `cuidador`
--
ALTER TABLE `cuidador`
  MODIFY `idCuidador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `mascota`
--
ALTER TABLE `mascota`
  MODIFY `idMascota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `mp_pages`
--
ALTER TABLE `mp_pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `mp_tagline`
--
ALTER TABLE `mp_tagline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `adoptante`
--
ALTER TABLE `adoptante`
  ADD CONSTRAINT `adoptante_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `cuidador`
--
ALTER TABLE `cuidador`
  ADD CONSTRAINT `cuidador_ibfk_1` FOREIGN KEY (`idCuidador`) REFERENCES `mascota` (`cuidador`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_cuidador_usuario1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `mascota_ibfk_1` FOREIGN KEY (`categoria`) REFERENCES `categorias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`idAdoptante`) REFERENCES `adoptante` (`idAdoptante`),
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`idCuidador`) REFERENCES `cuidador` (`idCuidador`),
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`idMascota`) REFERENCES `mascota` (`idMascota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
