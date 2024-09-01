-- Inserciones para la tabla `perfiles`
INSERT INTO `perfiles` (`id`, `nombre`) VALUES
                                            (1, 'Administrador'),
                                            (2, 'Usuario');

-- Inserciones para la tabla `categorias`
INSERT INTO `categorias` (`id`, `nombre`) VALUES
                                              (2, 'Electrónica'),
                                              (3, 'Mobiliario'),
                                              (4, 'Oficina'),
                                              (5, 'Herramientas'),
                                              (6, 'Vehículos');

-- Inserciones para la tabla `estados`
INSERT INTO `estados` (`id`, `nombre`) VALUES
                                           (2, 'Nuevo'),
                                           (3, 'Usado'),
                                           (4, 'Dañado'),
                                           (5, 'Reparación');

-- Inserciones para la tabla `procedencias`
INSERT INTO `procedencias` (`id`, `nombre`, `nit_o_cc`, `direccion`, `telefono`, `representante`, `correo`) VALUES
                                                                                                                (2, 'Compra Directa', NULL, NULL, NULL, NULL, NULL),
                                                                                                                (3, 'Donación', NULL, NULL, NULL, NULL, NULL),
                                                                                                                (4, 'Transferencia', NULL, NULL, NULL, NULL, NULL);

-- Inserciones para la tabla `sedes`
INSERT INTO `sedes` (`id`, `nombre`) VALUES
                                         (2, 'Sede Central'),
                                         (3, 'Sede Norte'),
                                         (4, 'Sede Sur'),
                                         (5, 'Sede Este'),
                                         (6, 'Sede Oeste');

-- Inserciones para la tabla `ubicaciones`
INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
                                                          (2, 'Ubicación 1', 2),
                                                          (3, 'Ubicación 2', 3),
                                                          (4, 'Ubicación 3', 4),
                                                          (5, 'Ubicación 4', 5),
                                                          (6, 'Ubicación 5', 6);

-- Inserciones para la tabla `articulos`
INSERT INTO `articulos` (`id`, `nombre`, `marca`, `descripcion`, `fecha_adquisicion`, `valor_unitario`, `estado_id`, `procedencia_id`, `categoria_id`) VALUES
                                                                                                                                                           (1, 'Articulo 1', 'Marca A', 'Descripción del artículo 1', '2024-01-01', 100.00, 2, 2, 2),
                                                                                                                                                           (2, 'Articulo 2', 'Marca B', 'Descripción del artículo 2', '2024-02-01', 200.00, 3, 3, 3);

-- Inserciones para la tabla `usuarios`
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `identificacion`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil_id`) VALUES
                                                                                                                                          (1, 'Juan', 'Pérez', '12345678', '3000000000', 'Calle 1', 'juan.perez@example.com', 'hashed_password_1', 1),
                                                                                                                                          (2, 'Ana', 'García', '87654321', '3000000001', 'Calle 2', 'ana.garcia@example.com', 'hashed_password_2', 2);

-- Inserciones para la tabla `asignaciones`
INSERT INTO `asignaciones` (`id`, `articulo_id`, `de_usuario_id`, `a_usuario_id`, `cantidad_otorgada`, `asignado_en`) VALUES
    (1, 1, 1, 2, 10, '2024-09-01 12:00:00');

-- Inserciones para la tabla `inventario_anual`
INSERT INTO `inventario_anual` (`id`, `articulo_id`, `ubicacion_id`, `fecha`, `stock_inicio`, `stock_final`) VALUES
    (1, 1, 2, '2024-09-01 12:00:00', 50, 45);

-- Inserciones para la tabla `movimientos`
INSERT INTO `movimientos` (`id`, `articulo_id`, `tipo`, `cantidad`, `fecha`) VALUES
                                                                                 (1, 1, 'entrada', 50, '2024-09-01 12:00:00'),
                                                                                 (2, 1, 'salida', 5, '2024-09-01 12:00:00');

-- Inserciones para la tabla `traslados`
INSERT INTO `traslados` (`id`, `articulo_id`, `de_ubicacion_id`, `a_ubicacion_id`, `trasladado_por`, `trasladado_en`) VALUES
    (1, 1, 2, 3, 1, '2024-09-01 12:00:00');
