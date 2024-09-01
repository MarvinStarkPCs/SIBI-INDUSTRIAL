-- articulos

SELECT
a.id,
a.nombre,
a.marca,
a.descripcion,
a.fecha_adquisicion,
a.valor_unitario,
e.nombre as estado,
p.nombre as procedencia,
c.nombre as categoria
FROM articulos a
INNER JOIN sibi.estados e on a.estado_id = e.id
INNER JOIN sibi.procedencias p on a.procedencia_id = p.id
INNER JOIN sibi.categorias c on a.categoria_id = c.id;
-- articulos

