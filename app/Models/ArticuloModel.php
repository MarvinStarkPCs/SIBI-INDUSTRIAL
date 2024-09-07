<?php namespace App\Models;

use CodeIgniter\Model;

class ArticuloModel extends Model
{
    protected $table = 'articulos';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'nombre', 'marca','serial','modelo', 'serial','cod_institucional', 'descripcion', 'fecha_adquisicion',
        'valor_unitario', 'categoria_id'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getArticulos()
    {
        return $this->select('
        articulos.id, 
        articulos.nombre, 
        articulos.marca,
        articulos.serial, 
        articulos.cod_institucional, 
        articulos.descripcion, 
        articulos.fecha_adquisicion, 
        articulos.valor_unitario, 
        categorias.nombre as categoria, 
        categorias.id as categoria_id
    ')
            ->join('categorias', 'articulos.categoria_id = categorias.id')
            ->findAll();
    }

}
