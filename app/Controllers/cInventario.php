<?php

namespace App\Controllers;

use App\Models\InventarioModel;
use CodeIgniter\Controller;

class CInventario extends Controller
{
    public function index()
    {
        $session = session();

        // Log de datos de la sesión
        log_message('debug', 'Session Data: ' . print_r($session->get(), true));

        if (!$session->get('login')) {
            log_message('debug', 'Redirecting to login because session is not set.');
            return redirect()->to('/'); // Asegúrate de usar la ruta correcta para el login
        } else {
            log_message('debug', 'User is logged in, loading INVENTARIO view.');

            // Cargar el modelo
            $model = new InventarioModel();

            // Obtener los datos
            $data['inventarios'] = $model->getInventarioConValorTotal();

            // Pasar los datos a la vista
            return view('inventario', $data);
        }
    }
}
