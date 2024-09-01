<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloModel extends Model
{
    protected $table = 'articulos';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nombre', 'marca', 'descripcion', 'fecha_adquisicion',
        'valor_unitario', 'estado_id', 'procedencia_id', 'categoria_id'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getArticulos()
    {
        return $this->select('articulos.id, articulos.nombre, articulos.marca, articulos.descripcion, articulos.fecha_adquisicion, articulos.valor_unitario, estados.nombre as estado, estados.id as estado_id, procedencias.nombre as procedencia, categorias.nombre as categoria, categorias.id as categoria_id')
            ->join('estados', 'articulos.estado_id = estados.id')
            ->join('procedencias', 'articulos.procedencia_id = procedencias.id')
            ->join('categorias', 'articulos.categoria_id = categorias.id')
            ->findAll();
    }
}
