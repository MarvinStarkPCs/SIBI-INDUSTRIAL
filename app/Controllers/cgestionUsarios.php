<?php

namespace App\Controllers;
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
            return view('gestionUsuarios'); // Carga la vista 'gestionUsuarios'
        }
    }
}
