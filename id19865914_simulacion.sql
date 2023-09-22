-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-09-2023 a las 02:43:00
-- Versión del servidor: 10.5.20-MariaDB
-- Versión de PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `id19865914_simulacion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alumnos`
--

CREATE TABLE `alumnos` (
  `id_alumno` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `alumnos`
--

INSERT INTO `alumnos` (`id_alumno`, `id_usuario`, `id_clase`) VALUES
(1, 2, 1),
(2, 5, 3),
(3, 7, 4),
(4, 8, 4),
(5, 9, 4),
(6, 11, 4),
(7, 12, 4),
(8, 13, 4),
(9, 15, 5),
(10, 16, 10),
(11, 17, 10),
(12, 21, 14),
(13, 22, 14),
(14, 23, 16),
(15, 25, 19),
(16, 28, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clases`
--

CREATE TABLE `clases` (
  `id_clase` int(11) NOT NULL,
  `id_profesor` int(11) NOT NULL,
  `codigo` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clases`
--

INSERT INTO `clases` (`id_clase`, `id_profesor`, `codigo`) VALUES
(1, 1, 'L7KV15WA9R'),
(2, 3, '9VJX5THIAK'),
(3, 4, 'C9FWAP38QY'),
(4, 6, 'J19NQBPH3S'),
(5, 14, 'LXH8TVYQ42'),
(6, 3, 'JXCVM8KEA2'),
(7, 10, '5WBGR7UDAV'),
(8, 14, 'LQAXH2UNCP'),
(9, 14, 'ZWS82ML5TR'),
(10, 14, 'ATM3P7YO8I'),
(11, 10, 'Q57CA4HR8N'),
(12, 19, 'WO893F0HVR'),
(13, 20, 'BHERQ9N3CX'),
(14, 20, 'HVQ0XU6FDE'),
(15, 3, 'MNJRYIT7GC'),
(16, 3, 'K38761QDAY'),
(17, 10, 'S28CO6WAX4'),
(18, 24, 'SYDW71RMCO'),
(19, 3, 'C8JDATYNXI'),
(20, 3, '0NYC3RQL12'),
(21, 27, '2HB3ULPDTV'),
(22, 29, 'Y1C4GIEJSH');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `simulaciones`
--

CREATE TABLE `simulaciones` (
  `id_simulacion` int(11) NOT NULL,
  `id_creador` int(11) NOT NULL,
  `id_clase` int(11) NOT NULL,
  `datos_iniciales` varchar(128) NOT NULL DEFAULT '53,90,135,120,220',
  `fecha_subida` date NOT NULL DEFAULT current_timestamp(),
  `nombre` varchar(254) NOT NULL DEFAULT 'Sin nombre',
  `intentos` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `simulaciones`
--

INSERT INTO `simulaciones` (`id_simulacion`, `id_creador`, `id_clase`, `datos_iniciales`, `fecha_subida`, `nombre`, `intentos`) VALUES
(1, 1, 1, '91,94,201,117,220', '2022-11-17', 'Simulación general 1', 0),
(2, 2, 1, '53,90,135,120,220', '2022-11-17', 'Probando alumnos web', 0),
(3, 3, 2, '202,100,302,109,150', '2022-11-17', 'Probando', 7),
(4, 4, 3, '53,90,135,120,220', '2022-11-18', '', 0),
(5, 5, 3, '66,268,201,55,261', '2022-11-18', 'Prueba PEpin', 2),
(6, 5, 3, '67,109,200,101,260', '2022-11-18', 'Prueba Crear simulación', 0),
(7, 5, 3, '71,90,192,120,301', '2022-11-18', 'NOse', 0),
(8, 6, 4, '52,24,136,120,221', '2022-11-18', 'Prueba', 0),
(9, 5, 3, '53,90,135,120,220', '2022-11-19', 'Valores de inicio', 0),
(10, 9, 4, '54,90,252,120,251', '2022-11-21', 'Prueba 1', 0),
(11, 9, 4, '20,184,71,93,150', '2022-11-21', 'Prueba 2', 1),
(12, 14, 5, '54,90,136,120,220', '2022-11-22', 'Chance estoy loco', 0),
(13, 16, 10, '53,90,135,120,220', '2022-11-22', 'Me gusta', 0),
(14, 3, 2, '53,90,135,120,220', '2022-11-22', '', 0),
(15, 10, 7, '54,90,136,120,220', '2022-11-22', 'Prueba Diagramas', 0),
(16, 19, 12, '53,90,135,120,220', '2022-11-23', 'Prueba de simulación', 0),
(17, 20, 13, '82,60,202,250,220', '2022-11-23', 'Prueba de simulación', 0),
(18, 21, 14, '10,-0,136,114,50', '2022-11-23', 'Prueba de Lis', 0),
(19, 11, 4, '54,58,136,130,220', '2022-11-26', '', 0),
(20, 24, 18, '30,79,252,131,351', '2022-12-07', 'Prueba 1', 1),
(21, 3, 2, '54,102,136,113,225', '2023-01-16', 'Croquetas', 0),
(22, 25, 19, '53,90,135,120,220', '2023-01-16', 'sdsdf', 0),
(23, 27, 21, '53,90,135,120,220', '2023-02-17', 'Prueba', 0),
(24, 27, 21, '53,90,135,120,220', '2023-02-17', 'prueba', 0),
(25, 29, 22, '54,90,136,120,220', '2023-09-15', 'Probando todo', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(254) NOT NULL,
  `password` varchar(254) NOT NULL,
  `es_profesor` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `password`, `es_profesor`) VALUES
(1, 'Miriam', 'Probando Servidor', 1),
(2, 'Marco Chavez', 'Admin', 0),
(3, 'Gixarde3', 'Admin', 1),
(4, 'Roger', '123', 1),
(5, 'Pepito', '123', 0),
(6, 'Suleing', '1234', 1),
(7, 'Lizeth', '123', 0),
(8, 'Juan', '123', 0),
(9, 'Pepito', '123', 0),
(10, 'Profesor 1', '12345', 1),
(11, 'Alumno 1', '123', 0),
(12, 'Probando administrador', '123', 0),
(13, 'Vamos a ver que pedo', '123', 0),
(14, 'Probar con otra clase', '123', 1),
(15, 'Ya no deja', '123', 0),
(16, 'Nuevo alumno', '123', 0),
(17, 'Alumno 2', '12345', 0),
(18, 'Marco', '1234', 1),
(19, 'Matias', '123', 1),
(20, 'Agusto', '123', 1),
(21, 'Lisandra', '1234', 0),
(22, 'Pedrito Sola', 'Und3rt4le!', 0),
(23, 'Rogelio el wapo', 'Und3rt4le!', 0),
(24, 'Diego', '123', 1),
(25, 'Probando nuevo alumno', 'Und3rt4le!', 0),
(26, 'Mike', '67maha', 1),
(27, 'User1', '12345', 1),
(28, 'Axel', 'f567', 0),
(29, 'Gixarde3', 'admin', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`id_alumno`),
  ADD KEY `id_clase` (`id_clase`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `clases`
--
ALTER TABLE `clases`
  ADD PRIMARY KEY (`id_clase`),
  ADD KEY `id_profesor` (`id_profesor`);

--
-- Indices de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD PRIMARY KEY (`id_simulacion`),
  ADD KEY `id_creador` (`id_creador`),
  ADD KEY `id_clase` (`id_clase`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `alumnos`
--
ALTER TABLE `alumnos`
  MODIFY `id_alumno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `clases`
--
ALTER TABLE `clases`
  MODIFY `id_clase` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  MODIFY `id_simulacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `clases`
--
ALTER TABLE `clases`
  ADD CONSTRAINT `clases_ibfk_1` FOREIGN KEY (`id_profesor`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `simulaciones`
--
ALTER TABLE `simulaciones`
  ADD CONSTRAINT `simulaciones_ibfk_1` FOREIGN KEY (`id_creador`) REFERENCES `usuarios` (`id_usuario`) ON UPDATE CASCADE,
  ADD CONSTRAINT `simulaciones_ibfk_2` FOREIGN KEY (`id_clase`) REFERENCES `clases` (`id_clase`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
