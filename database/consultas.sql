-- inventario
SELECT ia.id    AS id_inventario,
       a.id     AS id_articulo,
       a.nombre AS nombre_articulo,
       CASE
           WHEN ia.serial IS NULL THEN 'NO APLICA'
           ELSE ia.serial
           END  AS serial,
       ia.cod_institucional,
       m.nombre AS nombre_marca,
       e.nombre AS nombre_estado,
       p.nombre AS nombre_procedencia,
       s.nombre AS nombre_sede,
       u.nombre AS nombre_ubicacion,
       ia.fecha_adquisicion,
       ia.fecha_ingreso,
       a.valor_unitario *ia.stock_inicio  AS valor_total,
       ia.stock_inicio,
       ia.stock_final
FROM inventario_anual ia
         INNER JOIN sibi.articulos a ON ia.articulo_id = a.id
         INNER JOIN sibi.marcas m ON a.marca_id = m.id
         INNER JOIN sibi.categorias c ON a.categoria_id = c.id
         INNER JOIN sibi.ubicaciones u ON ia.ubicacion_id = u.id
         INNER JOIN sibi.sedes s ON u.sede_id = s.id
         INNER JOIN sibi.estados e ON ia.estado_id = e.id
         INNER JOIN sibi.procedencias p ON ia.procedencia_id = p.id;




