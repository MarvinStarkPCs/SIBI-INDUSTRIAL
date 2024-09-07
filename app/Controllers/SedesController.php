<?php
namespace App\Controllers;

use App\Models\ComboboxModel;

class SedesController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        }

        $model = new ComboboxModel();
        $data['sedes'] = $model->getTableData('sedes');

        return view('gestion_de_extras/sedes', $data);
    }
}
