<?php

namespace App\Models;

use CodeIgniter\Model;

class UbicacionesModels extends Model
{
    protected $table = 'ubicaciones'; // The table you're working with
    protected $primaryKey = 'id'; // The primary key in the table
    protected $allowedFields = ['nombre', 'sede_id']; // List of allowed fields

    public function getUbicacionesWithSedes()
    {
        // Build the query
        $builder = $this->db->table($this->table . ' u');
        $builder->select('u.id as id_ubicacion, u.nombre as nombre_ubicacion, s.id as id_sede, s.nombre as nombre_sede');
        $builder->join('sibi.sedes s', 'u.sede_id = s.id', 'inner');

        // Exclude ubicaciones with id 1 and 3
        $builder->whereNotIn('u.id', [1, 3]);

        // Execute the query and return the results
        return $builder->get()->getResult();
    }
}
