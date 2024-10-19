<?php
namespace App\Controllers;
use App\Models\AjaxPrestamosModel;

class AjaxPrestamosController extends BaseController
{
    public function obtenerEstadoUbicacion()
    {
        if ($this->request->isAJAX()) {
            $articuloId = $this->request->getPost('articulo_id');
            $modelo = new AjaxPrestamosModel();
            $resultado = $modelo->obtenerEstadoUbicacionPorArticulo($articuloId);
            return $this->response->setJSON($resultado);
        }
        return redirect()->to('/');
    }
}
