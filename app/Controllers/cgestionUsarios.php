<?php

namespace App\Controllers;
use App\Models\GestionUsuariosModel;

use CodeIgniter\Controller;

class CgestionUsarios extends Controller
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        } else {
            $model = new GestionUsuariosModel();
            $data['usuarios'] = $model->getUsuariosConPerfiles();
            return view('gestionUsuarios', $data); // Carga la vista 'gestionUsuarios' con los datos de usuarios
        }
    }

    public function addusuario()
    {
        $model = new GestionUsuariosModel();

        // Recoge los datos enviados desde el formulario
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil_id'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Inserta los datos en la base de datos
        $model->insertUsuario($data);

        return redirect()->to('/gestionUsuarios');
    }

    public function editusuario($id)
    {
        $model = new GestionUsuariosModel();
        $data['usuario'] = $model->getUsuarioById($id);

        return view('editUsuarioModal', $data); // Carga el modal con los datos del usuario a editar
    }

    public function updateusuario($id)
    {
        $model = new GestionUsuariosModel();

        // Recoge los datos actualizados
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil_id'),
            // Solo actualiza la contraseña si se ha proporcionado una nueva
            'password' => $this->request->getPost('password') ? password_hash($this->request->getPost('password'), PASSWORD_DEFAULT) : null,
        ];

        // Filtra los campos vacíos (e.g., si no hay nueva contraseña)
        $data = array_filter($data);

        // Actualiza los datos del usuario
        $model->updateUsuario($id, $data);

        return redirect()->to('/gestionUsuarios');
    }

    public function deleteusuario($id)
    {
        $model = new GestionUsuariosModel();
        $model->deleteUsuario($id);

        if ($model->deleteUsuario($id)) {
            return redirect()->to('/gestion-usuarios')->with('message', 'Usuario eliminado correctamente.');
        } else {
            return redirect()->to('/gestion-usuarios')->with('error', 'No se pudo eliminar el usuario.');
        }
    }
}

