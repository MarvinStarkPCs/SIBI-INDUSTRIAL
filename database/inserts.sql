-- Inserciones en `categorias`
INSERT INTO `categorias` (`id`, `nombre`) VALUES
                                              (1, 'Electrónica'),
                                              (2, 'Mobiliario'),
                                              (3, 'Papelería');

-- Inserciones en `perfiles`
INSERT INTO `perfiles` (`id`, `nombre`) VALUES
                                            (1, 'Super Administrador'),
                                            (2, 'Directivo'),
                                            (3, 'Administrativo'),
                                            (4, 'Docente');

-- Inserciones en `sedes`
INSERT INTO `sedes` (`id`, `nombre`) VALUES
                                         (1, 'Sede La Primavera'),
                                         (2, 'Sede Marabel'),
                                         (3, 'Sede El Carmen'),
                                         (4, 'Sede Cristo Rey');

-- Inserciones en `ubicaciones`
INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
                                                          (1, 'Dados de Bajas', 1),
                                                          (2, 'Pagaduria', 1),
                                                          (3, 'En Prestamo', 1),
                                                          (4, 'Salon 201', 2),
                                                          (5, 'Salon 202', 2),
                                                          (6, 'Taller de Ebanisteria', 2),
                                                          (7, 'Salon 301', 3),
                                                          (8, 'Salon 302', 3),
                                                          (9, 'Laboratorio de Electronica', 3),
                                                          (10, 'Salon 401', 4),
                                                          (11, 'Salon 402', 4),
                                                          (12, 'Laboratorio de Sistemas', 4);

-- Inserciones en `articulos`
INSERT INTO `articulos` (`id`, `nombre`, `marca`, `descripcion`, `fecha_adquisicion`, `valor_unitario`, `categoria_id`) VALUES
                                                                                                                            (1, 'Computadora', 'HP', 'Modelo Z200', '2024-01-10', 1500.00, 1),
                                                                                                                            (2, 'Silla de Oficina', 'ErgoChair', 'Silla ergonómica', '2024-02-15', 200.00, 2),
                                                                                                                            (3, 'Proyector', 'Epson', 'Modelo X123', '2023-05-20', 700.00, 1),
                                                                                                                            (4, 'Mesa de Oficina', 'OfficePro', 'Mesa de madera', '2023-06-10', 300.00, 2),
                                                                                                                            (5, 'Escáner', 'Canon', 'Escáner multifuncional', '2024-08-15', 400.00, 1),
                                                                                                                            (6, 'Silla Ergonómica', 'ComfortPlus', 'Silla ergonómica con soporte lumbar', '2024-08-20', 250.00, 2);

-- Inserciones en `usuarios`
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `identificacion`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil_id`) VALUES
                                                                                                                                          (1, 'Juan', 'Pérez', '12345678', '555-1234', 'Calle 123', 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1),
                                                                                                                                          (2, 'Ana', 'Gómez', '87654321', '555-5678', 'Avenida 456', 'ana@example.com', 'password_hash', 2);

-- Inserciones en `procedencias`
INSERT INTO `procedencias` (`id`, `nombre`, `nit_o_cc`, `direccion`, `telefono`, `representante`, `correo`) VALUES
                                                                                                                (1, 'Universidad UFPSO', '121414714-5', 'Vía Universidad Francisco de Paula Santander', '32215154445', 'GERMAN ALONSO OSORIO ALVAREZ', 'german.osorio@ufpso.edu.co'),
                                                                                                                (2, 'Universidad Nacional', '221546789-3', 'Carrera 45 #26-85, Bogotá', '3106541234', 'JUAN PEREZ GOMEZ', 'juan.perez@unal.edu.co'),
                                                                                                                (3, 'Universidad de los Andes', '331547891-4', 'Carrera 1 #18A-12, Bogotá', '3201234567', 'MARTA LOPEZ GARCIA', 'marta.lopez@uniandes.edu.co'),
                                                                                                                (4, 'Universidad Javeriana', '451265987-2', 'Carrera 7 #40-62, Bogotá', '3119876543', 'CARLOS RAMIREZ TORRES', 'carlos.ramirez@javeriana.edu.co'),
                                                                                                                (5, 'Universidad del Rosario', '512487963-9', 'Calle 12C #6-25, Bogotá', '3007654321', 'ANA MARIA RODRIGUEZ', 'ana.rodriguez@urosario.edu.co'),
                                                                                                                (6, 'Universidad del Norte', '614798563-1', 'Km 5 Vía Puerto Colombia, Barranquilla', '3119871234', 'PEDRO GUTIERREZ PEREZ', 'pedro.gutierrez@uninorte.edu.co'),
                                                                                                                (7, 'Universidad Pontificia Bolivariana', '745698745-6', 'Circular 1 #70-01, Medellín', '3017894561', 'LUCIA MORALES DIAZ', 'lucia.morales@upb.edu.co'),
                                                                                                                (8, 'Universidad de Antioquia', '895647321-8', 'Calle 67 #53-108, Medellín', '3206549871', 'ANDRES FELIPE GARCIA', 'andres.garcia@udea.edu.co'),
                                                                                                                (9, 'Universidad Industrial de Santander', '951236478-4', 'Carrera 27 Calle 9, Bucaramanga', '3156789543', 'PABLO CASTRO RIVERA', 'pablo.castro@uis.edu.co'),
                                                                                                                (10, 'Universidad del Valle', '103216547-9', 'Calle 13 #100-00, Cali', '3224567890', 'DIANA RUIZ MARTINEZ', 'diana.ruiz@univalle.edu.co');

-- Inserciones en `estados`
INSERT INTO `estados` (`id`, `nombre`) VALUES
                                           (1, 'BUENO'),
                                           (2, 'REGULAR'),
                                           (3, 'MAL'),
                                           (4, 'DADO DE BAJA'),
                                           (5, 'EXTRAVIADO');

-- Inserciones en `inventario_anual`
INSERT INTO `inventario_anual` (`id`, `articulo_id`, `ubicacion_id`, `estado_id`, `procedencia_id`, `fecha`, `stock_inicio`, `stock_final`) VALUES
                                                                                                                                                (1, 1, 1, 1, 1, '2024-09-01', 10, 8),
                                                                                                                                                (2, 2, 2, 2, 2, '2024-09-01', 5, 5),
                                                                                                                                                (3, 3, 1, 4, 1, '2024-09-02', 8, 0),
                                                                                                                                                (4, 4, 1, 4, 2, '2024-09-02', 5, 0),
                                                                                                                                                (5, 5, 4, 1, 1, '2024-09-03', 15, 15),
                                                                                                                                                (6, 6, 4, 1, 2, '2024-09-03', 10, 10);

-- Inserciones en `asignaciones`
INSERT INTO `asignaciones` (`id`, `articulo_id`, `de_usuario_id`, `a_usuario_id`, `cantidad_otorgada`, `asignado_en`) VALUES
                                                                                                                          (1, 1, 1, 2, 2, '2024-09-01 10:00:00'),
                                                                                                                          (2, 2, 2, 1, 1, '2024-09-01 11:00:00');

-- Inserciones en `traslados`
INSERT INTO `traslados` (`id`, `articulo_id`, `de_ubicacion_id`, `a_ubicacion_id`, `trasladado_por`, `trasladado_en`) VALUES
                                                                                                                          (1, 1, 1, 2, 1, '2024-09-02 09:00:00'),
                                                                                                                          (2, 2, 2, 1, 2, '2024-09-02 10:00:00'),
                                                                                                                          (3, 3, 3, 1, 1, '2024-09-03 12:00:00'),
                                                                                                                          (4, 4, 3, 1, 2, '2024-09-03 13:00:00'),
                                                                                                                          (5, 5, 4, 4, 1, '2024-09-04 09:30:00'),
                                                                                                                          (6, 6, 4, 4, 2, '2024-09-04 10:00:00');
