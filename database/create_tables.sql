--Elimina la Base de Datos si Existe
DROP DATABASE IF EXISTS `sibi`;
-- Crea la base de datos
CREATE DATABASE `sibi`;
USE `sibi`;

-- Estructura de tabla para la tabla `articulos`
CREATE TABLE `articulos` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `marca` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_adquisicion` date NOT NULL,
  `valor_unitario` decimal(10,2) NOT NULL,
  `estado_id` bigint(20) DEFAULT NULL,
  `procedencia_id` bigint(20) DEFAULT NULL,
  `categoria_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_general_ci;

-- Estructura de tabla para la tabla `asignaciones`
CREATE TABLE `asignaciones` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) DEFAULT NULL,
  `de_usuario_id` bigint(20) DEFAULT NULL,
  `a_usuario_id` bigint(20) DEFAULT NULL,
  `cantidad_otorgada` int(11) DEFAULT NULL,
  `asignado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `categorias`
CREATE TABLE `categorias` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `estados`
CREATE TABLE `estados` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `inventario_anual`
CREATE TABLE `inventario_anual` (
  `id` bigint(20) NOT NULL,
  `ubicacion_id` bigint(20) NOT NULL,
  `ano` year(4) NOT NULL,
  `stock_inicio` int(11) NOT NULL,
  `stock_final` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `movimientos`
CREATE TABLE `movimientos` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) NOT NULL,
  `tipo` enum('entrada','salida') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `perfiles`
CREATE TABLE `perfiles` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `procedencias`
CREATE TABLE `procedencias` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `nit_o_cc` varchar(60) DEFAULT NULL,
  `direccion` varchar(60) DEFAULT NULL,
  `telefono` varchar(60) DEFAULT NULL,
  `representante` varchar(60) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `sedes`
CREATE TABLE `sedes` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `traslados`
CREATE TABLE `traslados` (
  `id` bigint(20) NOT NULL,
  `articulo_id` bigint(20) DEFAULT NULL,
  `de_ubicacion_id` bigint(20) DEFAULT NULL,
  `a_ubicacion_id` bigint(20) DEFAULT NULL,
  `trasladado_por` bigint(20) DEFAULT NULL,
  `trasladado_en` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `ubicaciones`
CREATE TABLE `ubicaciones` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `sede_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Estructura de tabla para la tabla `usuarios`
CREATE TABLE `usuarios` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `identificacion` varchar(100) NOT NULL,
  `correo` varchar(255) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `perfil_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
