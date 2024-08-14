<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'users';

    // Clave primaria de la tabla
    protected $primaryKey = 'id';

    // Campos que se pueden insertar o actualizar
    protected $allowedFields = ['email', 'password', 'name'];

    // Si usas timestamps en tu tabla
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Reglas de validación
    protected $validationRules = [
        'email'    => 'required|valid_email',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [
        'email' => [
            'required'    => 'El correo electrónico es obligatorio.',
            'valid_email' => 'Debe ingresar un correo electrónico válido.'
        ],
        'password' => [
            'required'     => 'La contraseña es obligatoria.',
            'min_length'   => 'La contraseña debe tener al menos 8 caracteres.'
        ]
    ];

    // Método para buscar un usuario por su correo electrónico
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    // Método para verificar las credenciales del usuario
    public function validateCredentials($email, $password)
    {
        $user = $this->getUserByEmail($email);
        
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        
        return false;
    }

    // Método para crear un nuevo usuario
    public function createUser($data)
    {
        // Asegúrate de que la contraseña esté cifrada
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }
    
    // Método para actualizar la información del usuario
    public function updateUser($id, $data)
    {
        if (isset($data['password'])) {
            // Asegúrate de que la contraseña esté cifrada
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }
        return $this->update($id, $data);
    }
}
