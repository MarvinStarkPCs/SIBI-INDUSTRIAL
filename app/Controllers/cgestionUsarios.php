<?php

namespace App\Controllers;
use App\Models\GestionUsuariosModel;
use App\Models\ComboboxModel;
use CodeIgniter\Database\Exceptions\DatabaseException;

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
            $modelUsuarios = new GestionUsuariosModel();
            $modelPerfiles = new ComboboxModel();
            $data['usuarios'] = $modelUsuarios->getUsuariosConPerfiles();
            $data['perfiles']=  $modelPerfiles->getTableData('perfiles');
            return view('gestionUsuarios', $data); // Carga la vista 'gestionUsuarios' con los datos de usuarios
        }
    }

    public function addusuario()
    {
        $model = new GestionUsuariosModel();
        // Recoge los datos enviados desde el formulario
        $data = [
            'nombres' => $this->request->getPost('nombre'),
            'email' => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil_id'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        // Inserta los datos en la base de datos
        $model->insertUsuario($data);

        return redirect()->to('/gestionUsuarios');
    }


    public function updateusuario($id)
    {
        $model = new GestionUsuariosModel();

        // Recoge los datos actualizados
        $data = [
            'nombres' => $this->request->getPost('nombre'),
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

        try {
            $resultado = $model->deleteUsuario($id);

            if ($resultado) {
                return redirect()->to('/gestion-usuarios')->with('success', 'Usuario eliminado correctamente.');
            } else {
                return redirect()->to('/gestion-usuarios')->with('error', 'No se pudo eliminar el usuario.');
            }
        } catch (DatabaseException $e) {
            // Manejo del error específico
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/gestion-usuarios')->with('error', 'No se puede eliminar el usuario porque está asociado a otros registros o asignación.');
            }

            // Otros errores
            return redirect()->to('/gestion-usuarios')->with('error', 'Ocurrió un error al intentar eliminar el usuario.');
        }
    }

}

