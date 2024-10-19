<?php

namespace App\Controllers;

use App\Models\AjaxAsignarArticuloModel;
use CodeIgniter\Controller;

class AjaxAsignarArticuloController extends Controller
{
    public function obtenerInventarioPorSerial(){
        if ($this->request->isAJAX()) {
            $serial = $this->request->getPost('serial');
            $idUbicacion = $this->request->getPost('ubicacion_id_origen'); // Obtener el ID de la ubicación

            $modelo = new AjaxAsignarArticuloModel();
            $resultado = $modelo->getInventarioConValorTotal($serial, $idUbicacion);

            log_message('info', 'Serial: ' . $serial);
            log_message('info', 'Ubicación ID: ' . $idUbicacion);
            // Validar si se encontró el artículo en la ubicación
            if (empty($resultado)) {
                return $this->response->setJSON(['error' => 'Este artículo no se encuentra en la ubicación seleccionada.']);
            }

            return $this->response->setJSON($resultado);
        }
        return redirect()->to('/');
    }
}
