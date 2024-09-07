--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `articulos`
--
ALTER TABLE `articulos`
  ADD CONSTRAINT `articulos_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

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
ADD CONSTRAINT `inventario_anual_ibfk_1` FOREIGN KEY (`ubicacion_id`) REFERENCES `ubicaciones` (`id`),
ADD CONSTRAINT `inventario_anual_ibfk_2` FOREIGN KEY (`articulo_id`) REFERENCES `articulos` (`id`),
ADD CONSTRAINT `inventario_anual_ibfk_3` FOREIGN KEY (`estado_id`) REFERENCES `estados` (`id`),
ADD CONSTRAINT `inventario_anual_ibfk_4` FOREIGN KEY (`procedencia_id`) REFERENCES `procedencias` (`id`);


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

