<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarioModel extends Model
{
    protected $table = 'inventario_anual'; // Tabla principal (no se usa directamente, pero se debe definir)
    protected $primaryKey = 'id'; // Cambia esto si tienes una clave primaria en la tabla `inventario_anual`

    // Puedes definir los campos que se pueden actualizar si lo necesitas
    protected $allowedFields = ['articulo_id', 'stock_inicio'];

    // Métodos para ejecutar la consulta
    public function getInventarioConValorTotal()
    {
        $builder = $this->db->table('inventario_anual ia');
        $builder->select([
            'a.nombre AS articulo_nombre',
            'a.marca AS articulo_marca',
            'a.descripcion AS articulo_descripcion',
            'a.fecha_adquisicion',
            'a.valor_unitario',
            'e.nombre AS estado_nombre',
            'p.nombre AS procedencia_nombre',
            'c.nombre AS categoria_nombre',
            'u.nombre AS ubicacion_nombre',
            's.nombre AS sede_nombre',
            'ia.stock_inicio',
            '(ia.stock_inicio * a.valor_unitario) AS valor_total_stock'
        ]);
        $builder->join('articulos a', 'ia.articulo_id = a.id');
        $builder->join('estados e', 'a.estado_id = e.id');
        $builder->join('procedencias p', 'a.procedencia_id = p.id');
        $builder->join('categorias c', 'a.categoria_id = c.id');
        $builder->join('ubicaciones u', 'a.ubicacion_id = u.id');
        $builder->join('sedes s', 'u.sede_id = s.id');

        $query = $builder->get();
        return $query->getResult();
    }
}
