-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 26-06-2021 a las 01:35:17
-- Versión del servidor: 8.0.25
-- Versión de PHP: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id` int NOT NULL,
  `imagen` varchar(1000) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `cedula` varchar(25) NOT NULL,
  `nacionalidad` varchar(25) NOT NULL,
  `raza` varchar(25) NOT NULL,
  `ocupacion` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `sexo` varchar(25) NOT NULL,
  `serie` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `estado` varchar(25) NOT NULL,
  `biografia` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id`, `imagen`, `nombre`, `apellido`, `cedula`, `nacionalidad`, `raza`, `ocupacion`, `sexo`, `serie`, `estado`, `biografia`) VALUES
(83, '1624501706_Madara.png', 'madara', 'uchija', '12355553', 'Konoj4', 'madara', 'madar4', 'hombree', 'Naruto', 'Solteroo', 'Este man es el mismo finalito '),
(85, '1624505942_lufy.png', 'Lufy', 'Monkey D\'', '2651133135', 'Eats Blue', 'Lufy', 'Lufy', 'hombre', 'One piece', 'Soltero', 'Este man es el mismo finalito '),
(86, '1624505115_Minato.png', 'Minato', 'Kamikase', '12358555', 'Konoja', 'Minato', 'Minato', 'hombre', 'Naruto', 'casado', 'Este man es el mismo finalito uhyj'),
(87, '1624505536_eren.png', 'eren', 'jaeger', '12355567', 'shingeki', 'eren', 'eren', 'hombre', 'Shingueki no kioyin', 'Soltero', 'Este man es el mismo finalito '),
(88, '1624506240_goku.png', 'Goku', 'Son Goku', '1235555645', 'planeta Vegeta', 'Goku', 'Sayajin', 'hombre', 'Dragon ball', 'casado', 'Este man es el mismo finalito '),
(89, '1624591219_meliodas.png', 'Meliodas', 'Capitan', '8456458', 'Inframundiano', 'Meliodas', 'Meliodas', 'hombre', 'Los siete pecados capitales', 'casado', 'Este man es el mismo finalito ');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
