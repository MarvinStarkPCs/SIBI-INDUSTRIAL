<?php

namespace App\Models;

use CodeIgniter\Model;
class AjaxAsignarModel extends Model
{
    protected $table = 'inventario_anual';

    public function obtenerEstadoUbicacionPorArticulo($articuloId)
    {
        // Consulta para obtener estado y ubicación según el artículo
        return $this->db->table($this->table)
            ->select('e.id AS id_estado, e.nombre AS estado, u.id AS id_ubicacion, u.nombre AS ubicacion, s.nombre as sede,inventario_anual.stock_inicio')
            ->join('sibi.articulos a', 'inventario_anual.articulo_id = a.id')
            ->join('sibi.estados e', 'inventario_anual.estado_id = e.id')
            ->join('sibi.ubicaciones u', 'inventario_anual.ubicacion_id = u.id')
            ->join('sibi.sedes s', 'u.sede_id = s.id')
            ->where('inventario_anual.articulo_id', $articuloId)
            ->get()
            ->getResultArray();
    }
}
