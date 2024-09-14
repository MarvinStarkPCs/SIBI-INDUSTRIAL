<?php
namespace App\Controllers;
use App\Models\AjaxAsignarModel;

class AjaxAsignarController extends BaseController
{
    public function obtenerEstadoUbicacion()
    {
        if ($this->request->isAJAX()) {
            $articuloId = $this->request->getPost('articulo_id');
            $modelo = new AjaxAsignarModel();
            $resultado = $modelo->obtenerEstadoUbicacionPorArticulo($articuloId);
            return $this->response->setJSON($resultado);
        }
        return redirect()->to('/');
    }
}
