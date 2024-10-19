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
        a.id AS id_articulo,
        a.nombre,
        a.modelo,
        a.descripcion,
        a.valor_unitario,
        m.nombre AS nombre_marca,
        m.id AS id_marca,
        c.nombre AS nombre_categoria,
        c.id AS id_categoria
    ')
            ->from('articulos a')
            ->join('marcas m', 'a.marca_id = m.id')
            ->join('categorias c', 'a.categoria_id = c.id')
            ->groupBy('a.id') // Agrupar por el ID del artículo para evitar duplicados
            ->findAll();
    }

}
