<?php
namespace App\Models;

use CodeIgniter\Model;

class GestionUsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'identificacion', 'correo', 'contrasena', 'perfil_id'];
    protected $returnType = 'array';
    protected $useTimestamps = false;

    // Obtener todos los usuarios
    public function getUsuarios()
    {
        return $this->findAll();
    }

    // // Obtener todos los usuarios con sus perfiles
    // public function getUsuariosConPerfiles()
    // {
    //     return $this->select('usuarios.id, usuarios.nombre, usuarios.identificacion, usuarios.correo, perfiles.nombre as perfil')
    //                 ->join('perfiles', 'usuarios.perfil_id = perfiles.id')
    //                 ->findAll();
    // }

    public function getUsuariosConPerfiles()
{
    // Realizar la consulta
    $usuarios = $this->select('usuarios.id, usuarios.nombre, usuarios.identificacion, usuarios.correo, perfiles.nombre as perfil')
                     ->join('perfiles', 'usuarios.perfil_id = perfiles.id')
                     ->findAll();

    // Registrar los resultados de la consulta en el log
    log_message('info', 'Resultados de la consulta getUsuariosConPerfiles: ' . json_encode($usuarios));

    return $usuarios;
}


    // Obtener un usuario por ID
    public function getUsuarioById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    // Crear un nuevo usuario
    public function createUsuario($data)
    {
        return $this->insert($data);
    }

    // Actualizar un usuario existente
    public function updateUsuario($id, $data)
    {
        return $this->update($id, $data);
    }

    // Eliminar un usuario por ID
    public function deleteUsuario($id)
    {
        return $this->delete($id);
    }
    public function cambiarContrasena($idUsuario, $nuevaContrasena)
{
    $hashedPassword = password_hash($nuevaContrasena, PASSWORD_DEFAULT);

    $data = [
        'contrasena' => $hashedPassword,
    ];

    return $this->update($idUsuario, $data);
}

}
