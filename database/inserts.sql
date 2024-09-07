-- Inserción en `categorias`
INSERT INTO `categorias` (`id`, `nombre`) VALUES
                                              (1, 'Electrónica'),
                                              (2, 'Mobiliario'),
                                              (3, 'Papelería');

-- Inserción en `perfiles`
INSERT INTO `perfiles` (`id`, `nombre`) VALUES
                                            (1, 'Administrador'),
                                            (2, 'Usuario');

-- Inserción en `sedes`
INSERT INTO `sedes` (`id`, `nombre`) VALUES
                                         (1, 'Sede Cristo Rey'),
                                         (2, 'Sede Marabel'),
                                         (3, 'Sede El Carmen'),
                                         (4, 'Sede La Primavera');


-- Inserción en `ubicaciones`
INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
                                                          (1, 'Salon 101', 1),
                                                          (2, 'Salon 102', 1),
                                                          (3, 'Laboratorio de Fisica', 1),
                                                          (4, 'Salon 201', 2),
                                                          (5, 'Salon 202', 2),
                                                          (6, 'Taller de Ebanisteria', 2),
                                                          (7, 'Salon 301', 3),
                                                          (8, 'Salon 302', 3),
                                                          (9, 'Laboratorio de Electronica', 3),
                                                          (10, 'Salon 401', 4),
                                                          (11, 'Salon 402', 4),
                                                          (12, 'Laboratorio de Sistemas', 4);

-- Inserción en `articulos`
INSERT INTO `articulos` (`id`, `nombre`, `marca`, `descripcion`, `fecha_adquisicion`, `valor_unitario`, `categoria_id`) VALUES
                                                                                                                            (1, 'Computadora', 'HP', 'Modelo Z200', '2024-01-10', 1500.00, 1),
                                                                                                                            (2, 'Silla de Oficina', 'ErgoChair', 'Silla ergonómica', '2024-02-15', 200.00, 2);

-- Inserción en `usuarios`
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `identificacion`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil_id`) VALUES
                                                                                                                                          (1, 'Juan', 'Pérez', '12345678', '555-1234', 'Calle 123', 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1),
                                                                                                                                          (2, 'Ana', 'Gómez', '87654321', '555-5678', 'Avenida 456', 'ana@example.com', 'password_hash', 2);

-- Inserción en `procedencias`
INSERT INTO `procedencias` (`id`, `nombre`) VALUES
                                                (1, 'Comprado'),
                                                (2, 'Donado');

-- Inserción en `estados`
INSERT INTO `estados` (`id`, `nombre`) VALUES
                                           (1, 'BUENO'),
                                           (2, 'REGULAR'),
                                           (3, 'MAL'),
                                           (4, 'DADO DE BAJA'),
                                           (5  , 'EXATRAVIADO');


-- Inserción en `inventario_anual`
INSERT INTO `inventario_anual` (`id`, `articulo_id`, `ubicacion_id`, `estado_id`, `procedencia_id`, `fecha`, `stock_inicio`, `stock_final`) VALUES
                                                                                                                                                (1, 1, 1, 1, 1, '2024-09-01', 10, 8),
                                                                                                                                                (2, 2, 2, 2, 2, '2024-09-01', 5, 5);

-- Inserción en `asignaciones`
INSERT INTO `asignaciones` (`id`, `articulo_id`, `de_usuario_id`, `a_usuario_id`, `cantidad_otorgada`, `asignado_en`) VALUES
                                                                                                                          (1, 1, 1, 2, 2, '2024-09-01 10:00:00'),
                                                                                                                          (2, 2, 2, 1, 1, '2024-09-01 11:00:00');

-- Inserción en `traslados`
INSERT INTO `traslados` (`id`, `articulo_id`, `de_ubicacion_id`, `a_ubicacion_id`, `trasladado_por`, `trasladado_en`) VALUES
                                                                                                                          (1, 1, 1, 2, 1, '2024-09-02 09:00:00'),
                                                                                                                          (2, 2, 2, 1, 2, '2024-09-02 10:00:00');
