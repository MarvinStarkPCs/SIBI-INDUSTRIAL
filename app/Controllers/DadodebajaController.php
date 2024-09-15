<?php

namespace App\Controllers;

use App\Models\DadodebajaModel;

class DadodebajaController extends BaseController
{
    public function index(){
        $session = session();
        if(!$session->has('login')){
            return redirect()->route('/');
        }else {
            $dadodebajaModel = new DadodebajaModel();

            // Obtener los datos
            $data['asignaciones'] = $dadodebajaModel->obtenerAsignaciones();

            // Cargar la vista con los datos
            return view('historialdadasdebaja', $data);

        }
    }


}