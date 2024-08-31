-- Insertar datos en la tabla `categorias`
INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Electrónica'),
(2, 'Muebles'),
(3, 'Herramientas');

-- Insertar datos en la tabla `estados`
INSERT INTO `estados` (`id`, `nombre`) VALUES
(1, 'Nuevo'),
(2, 'Usado'),
(3, 'Reparado');

-- Insertar datos en la tabla `procedencias`
INSERT INTO `procedencias` (`id`, `nombre`, `nit_o_cc`, `direccion`, `telefono`, `representante`, `correo`) VALUES
(1, 'Proveedor A', '123456789', 'Calle 1', '1234567890', 'Juan Pérez', 'juan@example.com'),
(2, 'Proveedor B', '987654321', 'Calle 2', '0987654321', 'Ana Gómez', 'ana@example.com');

-- Insertar datos en la tabla `sedes`
INSERT INTO `sedes` (`id`, `nombre`) VALUES
(1, 'Sede Central'),
(2, 'Sucursal Norte'),
(3, 'Sucursal Sur');

-- Insertar datos en la tabla `ubicaciones`
INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
(1, 'Oficina 1', 1),
(2, 'Oficina 2', 1),
(3, 'Taller Norte', 2),
(4, 'Taller Sur', 3);

-- Insertar datos en la tabla `perfiles`
INSERT INTO `perfiles` (`id`, `nombre`) VALUES
(1, 'Administrador'),
(2, 'Empleado'),
(3, 'Supervisor');

-- Insertar datos en la tabla `usuarios`
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `identificacion`, `telefono`,`direccion`,`correo`, `contrasena`, `perfil_id`) VALUES
(1, 'Carlos','méndez', '1234567890','3122212312','crr2332 -222 ', 'admin@admin.com', 'admin', 1),
(2, 'Laura','Martinez', '0987654321','3122121212','crr 25 -05 barrio cristorey', 'laura@example.com', 'password456', 2);

-- Insertar datos en la tabla `articulos`
INSERT INTO `articulos` (`id`, `nombre`, `marca`, `descripcion`, `fecha_adquisicion`, `valor_unitario`, `estado_id`, `procedencia_id`, `categoria_id`) VALUES
(1, 'Laptop', 'Dell', 'Laptop de alta gama', '2024-01-15', 1200.00, 1, 1, 1),
(2, 'Silla Ergonomica', 'IKEA', 'Silla cómoda y ajustable', '2024-02-01', 150.00, 2, 2, 2);

-- Insertar datos en la tabla `movimientos`
INSERT INTO `movimientos` (`id`, `articulo_id`, `tipo`, `cantidad`, `fecha`) VALUES
(1, 1, 'entrada', 10, '2024-01-16 10:00:00'),
(2, 2, 'salida', 1, '2024-02-02 09:30:00');

-- Insertar datos en la tabla `asignaciones`
INSERT INTO `asignaciones` (`id`, `articulo_id`, `de_usuario_id`, `a_usuario_id`, `cantidad_otorgada`, `asignado_en`) VALUES
(1, 1, 1, 2, 1, '2024-01-20 15:00:00'),
(2, 2, 1, 2, 1, '2024-02-05 11:00:00');

-- Insertar datos en la tabla `inventario_anual`
INSERT INTO `inventario_anual` (`id`, `ubicacion_id`, `ano`, `stock_inicio`, `stock_final`) VALUES
(1, 1, 2024, 10, 9),
(2, 2, 2024, 5, 4);

-- Insertar datos en la tabla `traslados`
INSERT INTO `traslados` (`id`, `articulo_id`, `de_ubicacion_id`, `a_ubicacion_id`, `trasladado_por`, `trasladado_en`) VALUES
(1, 1, 1, 2, 1, '2024-02-10 14:00:00'),
(2, 2, 2, 3, 2, '2024-02-12 10:00:00');
