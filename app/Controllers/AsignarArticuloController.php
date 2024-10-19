<?php

namespace App\Controllers;
use App\Models\ComboboxModel;
use App\Models\UbicacionesModels;
use CodeIgniter\Controller;
class AsignarArticuloController extends Controller
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        } else {;
            // Cargar el modelo de ubicaciones
            $ubicacionesModel = new UbicacionesModels();

            // Obtener las ubicaciones con las sedes
            $data['ubicaciones'] = $ubicacionesModel->getUbicacionesWithSedes();

            // Pasar los datos a la vista
            return view('asignararticulo', $data);
        }
    }
}

