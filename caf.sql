-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 22-08-2023 a las 05:41:48
-- Versión del servidor: 8.0.17
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `caf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudad`
--

CREATE TABLE `ciudad` (
  `idciudad` bigint(11) NOT NULL,
  `nombre_ciudad` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `postal` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `provincia_id` bigint(11) NOT NULL,
  `estatus` bigint(11) NOT NULL DEFAULT '1',
  `usuario_id` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `ciudad`
--

INSERT INTO `ciudad` (`idciudad`, `nombre_ciudad`, `postal`, `provincia_id`, `estatus`, `usuario_id`) VALUES
(1, 'Karmus', '23714', 1, 1, 1),
(2, 'El Cairo', '4240101', 4, 1, 1),
(3, 'Ciudad xyn', '1211234', 2, 1, 1),
(4, 'Ben Freja', '6298910', 5, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(11) NOT NULL,
  `usuario` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `clave` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `usuario`, `clave`, `estatus`) VALUES
(1, 'user123', 'user123', 1),
(2, 'danielito123', 'danielito123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE `opciones` (
  `id_opciones` int(11) NOT NULL,
  `pregunta_id` int(11) NOT NULL,
  `opcion_text` varchar(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `correcta` tinyint(1) NOT NULL,
  `estatus` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `opciones`
--

INSERT INTO `opciones` (`id_opciones`, `pregunta_id`, `opcion_text`, `correcta`, `estatus`) VALUES
(1, 1, 'El Cairo', 1, 1),
(2, 1, 'Argel', 0, 1),
(3, 1, 'Ciudad del Cabo', 0, 1),
(4, 1, 'Tokio', 0, 1),
(5, 2, 'Madrid', 0, 1),
(6, 2, 'Argel', 1, 1),
(7, 2, 'El Cairo', 0, 1),
(8, 2, 'Tunicia', 0, 1),
(9, 3, 'Dólar', 0, 1),
(10, 3, 'Dinar', 0, 1),
(11, 3, 'Rand', 1, 1),
(12, 3, 'Sol', 0, 1),
(13, 4, 'Koshari', 1, 1),
(14, 4, 'Trapeshka', 0, 1),
(15, 4, 'Tumbulo', 0, 1),
(16, 4, 'Encebollado', 0, 1),
(17, 5, 'Dólar argelino', 0, 1),
(18, 5, 'Sol argelino', 0, 1),
(19, 5, 'Libra argelina', 0, 1),
(20, 5, 'Dinar argelino', 1, 1),
(21, 6, 'Sinaloa', 0, 1),
(22, 6, 'Nazareth', 0, 1),
(23, 6, 'Alejandría', 1, 1),
(24, 6, 'Junín', 0, 1),
(25, 7, 'Dieli', 0, 1),
(26, 7, 'Biltong', 1, 1),
(27, 7, 'Cuscush', 0, 1),
(28, 7, 'Ceviche', 0, 1),
(29, 8, 'Johannesburgo', 1, 1),
(30, 8, 'Moscú', 0, 1),
(31, 8, 'Mar de Plata', 0, 1),
(32, 8, 'Camberra', 0, 1),
(33, 9, 'Sudáfrica', 0, 1),
(34, 9, 'Egipto', 0, 1),
(35, 9, 'Israel', 0, 1),
(36, 9, 'Argelia', 1, 1),
(37, 10, 'Argelia', 0, 1),
(38, 10, 'Palestina', 0, 1),
(39, 10, 'Egipto', 1, 1),
(40, 10, 'Nigeria', 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `idpais` bigint(11) NOT NULL,
  `nombrepais` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `capital` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `moneda` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `plato` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `date_add` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto` text COLLATE utf8mb4_swedish_ci NOT NULL,
  `usuario_id` bigint(11) NOT NULL,
  `estatus` bigint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`idpais`, `nombrepais`, `capital`, `moneda`, `plato`, `date_add`, `foto`, `usuario_id`, `estatus`) VALUES
(1, 'Egipto', 'El Cairo', 'Libra egipcia', 'Koshari', '2023-08-14 22:38:33', 'img_fcf8ab8d490cb3ba6d9d2e09e68e0f03.jpg', 1, 1),
(2, 'Sudáfrica', 'Ciudad del Cabo', 'Rand', 'Biltong', '2023-08-14 23:07:31', 'img_4b1964cdb710cd3f7ae28d2d18a2eb61.jpg', 1, 1),
(3, 'Argelia', 'Argel', 'Dinar argelino', 'Couscous', '2023-08-14 23:09:01', 'img_2d715f920aabe9b564f1ba9bbcddeda9.jpg', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pregunta`
--

CREATE TABLE `pregunta` (
  `id_pregunta` int(11) NOT NULL,
  `pregunta_text` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL,
  `estatus` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pregunta`
--

INSERT INTO `pregunta` (`id_pregunta`, `pregunta_text`, `estatus`) VALUES
(1, '¿Cuál es la capital de Egipto?', 1),
(2, '¿Cuál es la capital de Argelia?', 1),
(3, '¿Cuál es la moneda de Sudáfrica?', 1),
(4, '¿Cuál es el plato típico de Egipto?', 1),
(5, '¿Cuál es la moneda de Argelia?', 1),
(6, '¿Cuál de estas provincias pertenece a Egipto?', 1),
(7, '¿Cuál es el plato típico de Sudáfrica?', 1),
(8, '¿Cuál de estas ciudades pertenece a Sudáfrica?', 1),
(9, '¿A qué país pertenece esta descripción?\r\nEs un país de África del Norte con una costa en el Mediterráneo y un interior en el desierto del Sahara. Muchos imperios dejaron su legado aquí, como las antiguas ruinas romanas en Tipasa, junto al mar', 1),
(10, '¿A qué país pertenece esta descripción?\r\nTiene monumentos de milenios de antigüedad ubicados junto al fértil valle del río Nilo, incluidas las colosales pirámides de Guiza y la Gran Esfinge, al igual que las tumbas del Valle de los Reyes y el Templo de Karnak bordeado de jeroglíficos en Luxor', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincia`
--

CREATE TABLE `provincia` (
  `idprovincia` bigint(11) NOT NULL,
  `nombre_provincia` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `usuario_id` bigint(11) NOT NULL,
  `pais_id` bigint(11) NOT NULL,
  `estatus` bigint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `provincia`
--

INSERT INTO `provincia` (`idprovincia`, `nombre_provincia`, `usuario_id`, `pais_id`, `estatus`) VALUES
(1, 'Alejandría', 1, 1, 1),
(2, 'Gauteng', 1, 2, 1),
(3, 'Adrar', 1, 3, 1),
(4, 'El Cairo', 1, 1, 1),
(5, 'Blida', 1, 3, 1),
(6, 'Batna', 1, 3, 1),
(7, 'Luxor', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(11) NOT NULL,
  `rol` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `rol`) VALUES
(1, 'Administrador'),
(2, 'Supervisor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idusuario` bigint(11) NOT NULL,
  `nombre` varchar(60) COLLATE utf8mb4_swedish_ci NOT NULL,
  `usuario` varchar(20) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefono` varchar(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `clave` varchar(30) COLLATE utf8mb4_swedish_ci NOT NULL,
  `rol` bigint(11) NOT NULL,
  `estatus` bigint(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idusuario`, `nombre`, `usuario`, `telefono`, `clave`, `rol`, `estatus`) VALUES
(1, 'Administrador', 'admin', '0987654321', 'admin', 1, 1),
(2, 'Daniel Enriquez', 'dani123', '1231231233', 'e10adc3949ba59abbe56e057f20f88', 1, 1),
(3, 'Lionel Messi', 'leo123', '0912712610', '827ccb0eea8a706c4c34a16891f84e', 2, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD PRIMARY KEY (`idciudad`),
  ADD KEY `provincia_id` (`provincia_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indices de la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD PRIMARY KEY (`id_opciones`),
  ADD KEY `pregunta_id` (`pregunta_id`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`idpais`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  ADD PRIMARY KEY (`id_pregunta`);

--
-- Indices de la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD PRIMARY KEY (`idprovincia`),
  ADD KEY `pais_id` (`pais_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idusuario`),
  ADD KEY `rol` (`rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ciudad`
--
ALTER TABLE `ciudad`
  MODIFY `idciudad` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `opciones`
--
ALTER TABLE `opciones`
  MODIFY `id_opciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `idpais` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pregunta`
--
ALTER TABLE `pregunta`
  MODIFY `id_pregunta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `provincia`
--
ALTER TABLE `provincia`
  MODIFY `idprovincia` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idusuario` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ciudad`
--
ALTER TABLE `ciudad`
  ADD CONSTRAINT `ciudad_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ciudad_ibfk_2` FOREIGN KEY (`provincia_id`) REFERENCES `provincia` (`idprovincia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `opciones`
--
ALTER TABLE `opciones`
  ADD CONSTRAINT `opciones_ibfk_1` FOREIGN KEY (`pregunta_id`) REFERENCES `pregunta` (`id_pregunta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pais`
--
ALTER TABLE `pais`
  ADD CONSTRAINT `pais_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincia`
--
ALTER TABLE `provincia`
  ADD CONSTRAINT `provincia_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provincia_ibfk_2` FOREIGN KEY (`pais_id`) REFERENCES `pais` (`idpais`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`rol`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
