<?php

namespace App\Controllers;

use App\Models\GestionUsuariosModel;
use CodeIgniter\Controller;

class CambioContrasena extends Controller
{
    public function index()
    {
        // Cargar la vista de cambio de contraseña
        return view('cambio_contrasena');
    }

    public function actualizar()
    {
        // Obtener los datos enviados por POST
        $idUsuario = $this->request->getPost('idUsuario');
        $nuevaContrasena = $this->request->getPost('nuevaContrasena');
        $confirmarContrasena = $this->request->getPost('confirmarContrasena');

        // Validar que las contraseñas coincidan
        if ($nuevaContrasena !== $confirmarContrasena) {
            return redirect()->back()->with('error', 'Las contraseñas no coinciden.');
        }

        // Validar que la contraseña tenga una longitud mínima
        if (strlen($nuevaContrasena) < 8) {
            return redirect()->back()->with('error', 'La contraseña debe tener al menos 8 caracteres.');
        }

        // Instanciar el modelo y cambiar la contraseña
        $gestionUsuariosModel = new GestionUsuariosModel();
        $resultado = $gestionUsuariosModel->cambiarContrasena($idUsuario, $nuevaContrasena);

        // Redirigir con un mensaje según el resultado
        if ($resultado) {
            return redirect()->back()->with('success', 'Contraseña actualizada correctamente.');
        } else {
            return redirect()->back()->with('error', 'No se pudo actualizar la contraseña.');
        }
    }
}
