<?php

namespace App\Controllers;

use App\Models\AsignacionesModel;

class AsignacionesController extends BaseController
{
    public function index(){
        $session = session();
        if(!$session->get('login')){
            return redirect()->route('/');
        }else {
            $dadodebajaModel = new AsignacionesModel();
            // Obtener los datos
            $data['asignaciones'] = $dadodebajaModel->obtenerAsignaciones();
            // Cargar la vista con los datos
            return view('historialasignaciones', $data);

        }
    }


}