<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nombre', 'identificacion', 'correo', 'contrasena', 'perfil_id'];
    protected $useTimestamps = false;

    // Verifica si el usuario existe y la contraseña es correcta
    public function login($email, $password)
    {
        $user = $this->where('correo', $email)->first();

//        if ($user && password_verify($password,$user['contrasena'])) {
//            return $user;
//        }

        if ($user && $password==$user['contrasena']) {
            return $user;
        }

        return false;
    }
}
