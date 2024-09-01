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
            $data['perfiles'] = $modelPerfiles->getTableData('perfiles');
            return view('gestionUsuarios', $data); // Carga la vista 'gestionUsuarios' con los datos de usuarios
        }
    }

    public function addusuario()
    {
        $validation = \Config\Services::validation();
        $model = new GestionUsuariosModel();

        // Definir las reglas de validación

        $rules = [
            'nombres' => 'required|min_length[2]|max_length[20]',
            'apellidos' => 'required|min_length[2]|max_length[100]',
            'identidad' => 'required|numeric|min_length[5]',
            'email' => 'required|valid_email|max_length[100]',
            'telefono' => 'required|numeric|min_length[8]|max_length[15]',
            'direccion' => 'required|max_length[200]',
            'perfil_id' => 'required|numeric',
        ];

        // Validar las reglas definidas
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
        }

        // Verificar unicidad del correo electrónico y del número de documento
        $identidad = $this->request->getPost('identidad');
        $email = $this->request->getPost('email');

        // Verificar si el número de documento ya está registrado
        if ($model->where('identificacion', $identidad)->first()) {
            return redirect()->back()->withInput()->with('errors-insert', ['identidad' => 'El número de documento ya está registrado.']);
        }

        // Verificar si el correo electrónico ya está registrado
        if ($model->where('correo', $email)->first()) {
            return redirect()->back()->withInput()->with('errors-insert', ['email' => 'El correo electrónico ya está registrado.']);
        }

        // Si la validación es exitosa, recoger los datos y proceder
        $data = [
            'nombres' => $this->request->getPost('nombres'),
            'apellidos' => $this->request->getPost('apellidos'),
            'identificacion' => $this->request->getPost('identidad'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion'),
            'correo' => $this->request->getPost('email'),
            'perfil_id' => $this->request->getPost('perfil_id'),
            'contrasena' => password_hash("SIBI2024", PASSWORD_DEFAULT),
        ];

        $model->insert($data);

        return redirect()->to('/gestion-usuarios')->with('success', 'Usuario agregado correctamente');
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

