<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarioModel extends Model
{
    protected $table = 'inventario_anual'; // Aunque no se usa directamente, sigue siendo importante definirla
    protected $primaryKey = 'id'; // Cambia esto si tienes una clave primaria en la tabla `inventario_anual`

    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    // Puedes definir los campos que se pueden actualizar si lo necesitas
    protected $allowedFields = ['articulo_id', 'stock_inicio', 'stock_final', 'fecha'];
    // Métodos para ejecutar la consulta
    public function getInventarioConValorTotal()
    {
        $builder = $this->db->table('inventario_anual i');
        $builder->select([
            'a.id AS articulo_id',
            'a.nombre AS articulo_nombre',
            'a.marca AS articulo_marca',
            'a.descripcion AS articulo_descripcion',
            'a.fecha_adquisicion AS articulo_fecha_adquisicion',
            'a.valor_unitario AS articulo_valor_unitario',
            'e.nombre AS estado_nombre',
            'p.nombre AS procedencia_nombre',
            'c.nombre AS categoria_nombre',
            'u.nombre AS ubicacion_nombre',
            'i.stock_inicio AS inventario_stock_inicio',
            'i.stock_final AS inventario_stock_final',
            'i.fecha AS inventario_fecha',
            '(a.valor_unitario * i.stock_inicio) AS precio_total'
        ]);
        $builder->join('articulos a', 'i.articulo_id = a.id');
        $builder->join('estados e', 'a.estado_id = e.id');
        $builder->join('procedencias p', 'a.procedencia_id = p.id');
        $builder->join('categorias c', 'a.categoria_id = c.id');
        $builder->join('ubicaciones u', 'i.ubicacion_id = u.id');

        $builder->orderBy('a.nombre', 'ASC');
        $builder->orderBy('i.fecha', 'DESC');

        $query = $builder->get();
        return $query->getResult();
    }
}
