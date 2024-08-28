-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-08-2024 a las 22:15:03
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sibi`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulos`
--

CREATE TABLE `articulos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_adquisicion` date NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `estado_id` bigint(20) DEFAULT NULL,
  `procedencia_id` bigint(20) DEFAULT NULL,
  `categoria_id` bigint(20) DEFAULT NULL,
  `ubicacion_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

--
-- Volcado de datos para la tabla `articulos`
--

INSERT INTO `articulos` (`id`, `nombre`, `marca`, `descripcion`, `fecha_adquisicion`, `valor_unitario`, `estado_id`, `procedencia_id`, `categoria_id`, `ubicacion_id`) VALUES
(1, 'Laptop', 'HP', 'Laptop con 8GB RAM', '2024-01-15', 800.00, 1, 1, 1, 1),
(2, 'Escritorio', 'IKEA', 'Escritorio de madera', '2024-03-20', 150.00, 1, 2, 2, 2),
(3, 'Teclado', 'Logitech', 'Teclado mecánico', '2024-07-10', 50.00, 1, 1, 1, 1),
(4, 'Monitor', 'Dell', 'Monitor 24 pulgadas', '2024-06-25', 200.00, 2, 2, 1, 2),
(5, 'Silla', 'Herman Miller', 'Silla ergonómica', '2024-05-30', 300.00, 1, 2, 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaciones`
--

CREATE TABLE `asignaciones` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) DEFAULT NULL,
  `de_usuario_id` bigint(20) DEFAULT NULL,
  `a_usuario_id` bigint(20) DEFAULT NULL,
  `cantidad_otorgada` int(11) DEFAULT NULL,
  `asignado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asignaciones`
--

INSERT INTO `asignaciones` (`id`, `articulo_id`, `de_usuario_id`, `a_usuario_id`, `cantidad_otorgada`, `asignado_en`) VALUES
(1, 1, 1, 2, 1, '2024-08-15 13:56:21'),
(2, 2, 1, 2, 1, '2024-08-18 16:30:00'),
(3, 3, 2, 1, 2, '2024-08-19 21:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Electronica'),
(2, 'Mobiliario'),
(3, 'Oficina'),
(4, 'Electrodomésticos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Nuevo'),
(2, 'Usado'),
(3, 'Obsoleto'),
(4, 'En reparación'),
(5, 'Reciclaje');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario_anual`
--

CREATE TABLE `inventario_anual` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) NOT NULL,
  `ano` year(4) NOT NULL,
  `stock_inicio` int(11) NOT NULL,
  `stock_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario_anual`
--

INSERT INTO `inventario_anual` (`id`, `articulo_id`, `ano`, `stock_inicio`, `stock_final`) VALUES
(1, 1, '2024', 10, 8),
(2, 2, '2024', 5, 4),
(3, 3, '2024', 15, 12),
(4, 4, '2024', 8, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) NOT NULL,
  `tipo` enum('entrada','salida') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `articulo_id`, `tipo`, `cantidad`, `fecha`) VALUES
(2, 5, 'entrada', 3, '2024-08-15 09:00:00'),
(3, 4, 'salida', 1, '2024-08-16 11:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfiles`
--

CREATE TABLE `perfiles` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `perfiles`
--

INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Usuario'),
(3, 'Supervisor'),
(4, 'Técnico');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedencias`
--

CREATE TABLE `procedencias` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nit_o_cc` varchar(60) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `resentante` varchar(60) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `procedencias`
--

INSERT INTO `procedencias` (`id`, `nombre`, `nit_o_cc`, `direccion`, `telefono`, `resentante`, `correo`) VALUES
(1, 'Compra directa', NULL, NULL, NULL, NULL, NULL),
(2, 'Donacion', NULL, NULL, NULL, NULL, NULL),
(3, 'Herencia', NULL, NULL, NULL, NULL, NULL),
(4, 'Compra en línea', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sedes`
--

CREATE TABLE `sedes` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sedes`
--

INSERT INTO `sedes` (`id`, `nombre`) VALUES
(1, 'Sede Central'),
(2, 'Sede Norte'),
(3, 'Sede Este'),
(4, 'Sede Sur');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `traslados`
--

CREATE TABLE `traslados` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) DEFAULT NULL,
  `de_ubicacion_id` bigint(20) DEFAULT NULL,
  `a_ubicacion_id` bigint(20) DEFAULT NULL,
  `trasladado_por` bigint(20) DEFAULT NULL,
  `trasladado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `traslados`
--

INSERT INTO `traslados` (`id`, `articulo_id`, `de_ubicacion_id`, `a_ubicacion_id`, `trasladado_por`, `trasladado_en`) VALUES
(1, 1, 1, 2, 1, '2024-08-15 13:56:21'),
(2, 4, 2, 1, 2, '2024-08-17 20:45:00'),
(3, 5, 1, 2, 1, '2024-08-18 22:30:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicaciones`
--

CREATE TABLE `ubicaciones` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `sede_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ubicaciones`
--

INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
(1, 'Almacen 1', 1),
(2, 'Almacen 2', 2),
(3, 'Almacen 3', 3),
(4, 'Oficina Principal', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `perfil_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `identificacion`, `correo`, `contrasena`, `perfil_id`) VALUES
(1, 'Juan Perez', '123456789', 'admin@admin.com', 'admin', 1),
(2, 'Ana Gomez', '987654321', 'ana.gomez@example.com', 'password456', 2),
(3, 'Luis Martinez', '321654987', 'luis.martinez@example.com', 'luispass', 2),
(4, 'Marta Fernandez', '159753486', 'marta.fernandez@example.com', 'martapass', 3);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `procedencia_id` (`procedencia_id`),
  ADD KEY `categoria_id` (`categoria_id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`);

--
-- Indices de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `de_usuario_id` (`de_usuario_id`),
  ADD KEY `a_usuario_id` (`a_usuario_id`);

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario_anual`
--
ALTER TABLE `inventario_anual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_articulo_ano` (`articulo_id`,`ano`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`);

--
-- Indices de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `sedes`
--
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `de_ubicacion_id` (`de_ubicacion_id`),
  ADD KEY `a_ubicacion_id` (`a_ubicacion_id`),
  ADD KEY `trasladado_por` (`trasladado_por`);

--
-- Indices de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identificacion` (`identificacion`),
  ADD UNIQUE KEY `correo` (`correo`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `estados`
--
ALTER TABLE `estados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `perfiles`
--
ALTER TABLE `perfiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `procedencias`
--
ALTER TABLE `procedencias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sedes`
--
ALTER TABLE `sedes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `traslados`
--
ALTER TABLE `traslados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
  ADD CONSTRAINT `articulos_ibfk_2` FOREIGN KEY (`procedencia_id`) REFERENCES `procedencias` (`id`),
  ADD CONSTRAINT `articulos_ibfk_3` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`),
  ADD CONSTRAINT `articulos_ibfk_4` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`);

--
-- Filtros para la tabla `asignaciones`
--
ALTER TABLE `asignaciones`
  ADD CONSTRAINT `asignaciones_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `asignaciones_ibfk_2` FOREIGN KEY (`de_usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `asignaciones_ibfk_3` FOREIGN KEY (`a_usuario_id`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `inventario_anual`
--
ALTER TABLE `inventario_anual`
  ADD CONSTRAINT `inventario_anual_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`);

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`);

--
-- Filtros para la tabla `traslados`
--
ALTER TABLE `traslados`
  ADD CONSTRAINT `traslados_ibfk_1` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
  ADD CONSTRAINT `traslados_ibfk_2` FOREIGN KEY (`de_ubicacion_id`) REFERENCES `ubicaciones` (`id`),
  ADD CONSTRAINT `traslados_ibfk_3` FOREIGN KEY (`a_ubicacion_id`) REFERENCES `ubicaciones` (`id`),
  ADD CONSTRAINT `traslados_ibfk_4` FOREIGN KEY (`trasladado_por`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `ubicaciones`
--
ALTER TABLE `ubicaciones`
  ADD CONSTRAINT `ubicaciones_ibfk_1` FOREIGN KEY (`sede_id`) REFERENCES `sedes` (`id`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `perfiles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
