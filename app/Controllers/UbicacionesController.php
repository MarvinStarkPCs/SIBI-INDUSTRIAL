<?php

namespace App\Controllers;

use App\Models\ArticuloModel;
use App\Models\ComboboxModel;
use App\Models\UbicacionModel;

class UbicacionesController extends BaseController
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        } else {
            $model = new ubicacionModel();
            $modelcombo = new ComboboxModel();
            $data['ubicaciones'] = $model->getUbicacionesOrdenadasPorSede();
            $data['sedes'] = $modelcombo->getTableData('sedes');
            // Imprimir en el log
            log_message('info', 'Datos de ubicaciones obtenidos: ' . json_encode($data['ubicaciones']));
            log_message('info', 'Datos de sedes obtenidos: ' . json_encode($data['sedes']));
            return view('gestion_de_extras/ubicaciones', $data);
        }
    }

    public function create()
    {
        return view('ubicacion_create');
    }

    public function store()
    {
        $ubicacionModel = new UbicacionModel();
        $ubicacionModel->save([
            'nombre' => $this->request->getPost('nombre'),
            'sede_id' => $this->request->getPost('sede_id')
        ]);
        return redirect()->to('/ubicaciones');
    }

    public function edit($id)
    {
        $ubicacionModel = new UbicacionModel();
        $data['ubicacion'] = $ubicacionModel->find($id);
        return view('ubicacion_edit', $data);
    }

    public function update($id)
    {
        $ubicacionModel = new UbicacionModel();
        $ubicacionModel->update($id, [
            'nombre' => $this->request->getPost('nombre'),
            'sede_id' => $this->request->getPost('sede_id')
        ]);
        return redirect()->to('/ubicaciones');
    }

    public function delete($id)
    {
        $ubicacionModel = new UbicacionModel();
        $ubicacionModel->delete($id);
        return redirect()->to('/ubicaciones');
    }
}
