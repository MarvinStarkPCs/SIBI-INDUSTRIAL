-- Inserciones en `perfiles`
INSERT INTO `perfiles` (`id`, `nombre`) VALUES
                                            (1, 'SUPER ADMINISTRADOR'),
                                            (2, 'DIRECTIVO'),
                                            (3, 'ADMINISTRATIVO'),
                                            (4, 'DOCENTE');

-- Inserciones en `sedes`
INSERT INTO `sedes` (`id`, `nombre`) VALUES
                                         (1, 'SEDE LA PRIMAVERA'),
                                         (2, 'SEDE MARABEL'),
                                         (3, 'SEDE CRISTO REY');

-- Inserciones en `ubicaciones`
INSERT INTO `ubicaciones` (`id`, `nombre`, `sede_id`) VALUES
                                                          (1, 'DADOS DE BAJAS', 1),
                                                          (2, 'PAGADURIA', 1),
                                                          (3, 'EN PRESTAMO', 1);
;


-- Inserciones en `usuarios`
INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `identificacion`, `telefono`, `direccion`, `correo`, `contrasena`, `perfil_id`) VALUES
                                                                                                                                          (1, 'Juan', 'Pérez', '12345678', '555-1234', 'Calle 123', 'admin@admin.com', '$2y$10$xdHFXhYoOaUbqjip72qvj.3489G7unuXyD7gHL/XTwcUsDTFyMj6G', 1),
                                                                                                                                          (2, 'Ana', 'Gómez', '87654321', '555-5678', 'Avenida 456', 'ana@example.com', 'password_hash', 2);
-- Inserciones en `estados`
INSERT INTO `estados` (`id`, `nombre`) VALUES
                                           (1, 'BUENO'),
                                           (2, 'REGULAR'),
                                           (3, 'MAL'),
                                           (4, 'DADO DE BAJA'),
                                           (5, 'EXTRAVIADO');

INSERT INTO marcas (id, nombre)
VALUES
    (1, 'GENERICO'),
    (2, 'DELL'),
    (3, 'HP'),
    (4, 'LENOVO'),
    (5, 'ASUS'),
    (6, 'ACER'),
    (7, 'MSI'),
    (8, 'MICROSOFT'),
    (9, 'SAMSUNG'),
    (10, 'RAZER');
