-- Indices de la tabla `articulos`
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estado_id` (`estado_id`),
  ADD KEY `procedencia_id` (`procedencia_id`),
  ADD KEY `categoria_id` (`categoria_id`);

-- Indices de la tabla `asignaciones`
ALTER TABLE `asignaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `de_usuario_id` (`de_usuario_id`),
  ADD KEY `a_usuario_id` (`a_usuario_id`);

-- Indices de la tabla `categorias`
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `estados`
ALTER TABLE `estados`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `inventario_anual`
ALTER TABLE `inventario_anual`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ubicacion_id` (`ubicacion_id`);

-- Indices de la tabla `movimientos`
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`);

-- Indices de la tabla `perfiles`
ALTER TABLE `perfiles`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `procedencias`
ALTER TABLE `procedencias`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `sedes`
ALTER TABLE `sedes`
  ADD PRIMARY KEY (`id`);

-- Indices de la tabla `traslados`
ALTER TABLE `traslados`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articulo_id` (`articulo_id`),
  ADD KEY `de_ubicacion_id` (`de_ubicacion_id`),
  ADD KEY `a_ubicacion_id` (`a_ubicacion_id`),
  ADD KEY `trasladado_por` (`trasladado_por`);

-- Indices de la tabla `ubicaciones`
ALTER TABLE `ubicaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sede_id` (`sede_id`);

-- Indices de la tabla `usuarios`
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_id` (`perfil_id`);

-- Añadiendo auto_increment a las tablas
ALTER TABLE `articulos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `asignaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `categorias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `estados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `inventario_anual`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `movimientos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `perfiles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `procedencias`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `sedes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `traslados`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `ubicaciones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `usuarios`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
