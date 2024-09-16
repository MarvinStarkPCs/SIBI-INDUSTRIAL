<?php

namespace App\Controllers;

use App\Models\UbicacionModel;
use App\Models\ComboboxModel;

class UbicacionesController extends BaseController
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        } else {
            $model = new UbicacionModel();
            $modelcombo = new ComboboxModel();
            $data['ubicaciones'] = $model->getUbicacionesOrdenadasPorSede();
            $data['sedes'] = $modelcombo->getTableData('sedes');
            // Imprimir en el log
            log_message('info', 'Datos de ubicaciones obtenidos: ' . json_encode($data['ubicaciones']));
            log_message('info', 'Datos de sedes obtenidos: ' . json_encode($data['sedes']));
            return view('gestion_de_extras/ubicaciones', $data);
        }
    }



    public function store()
    {
        $ubicacionModel = new UbicacionModel();
        $ubicacionModel->save([
            'nombre' => $this->request->getPost('nombre_ubicacion'),
            'sede_id' => $this->request->getPost('sede_id')
        ]);
            return redirect()->to('/ubicaciones')->with('success', 'Ubicación agregada con éxito.');
    }


    public function update($id)
    {
        $ubicacionModel = new UbicacionModel();
        $ubicacionModel->update($id, [
            'nombre' => $this->request->getPost('nombre_ubicacion'),
            'sede_id' => $this->request->getPost('sede_id')
        ]);
        return redirect()->to('/ubicaciones')->with('success', 'Ubicación actualizada con éxito.');
    }

    public function delete($id)
    {
        $ubicacionModel = new UbicacionModel();

        // Validar si el ID es válido
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/ubicaciones')->with('error', 'ID de ubicación inválido.');
        }

        try {
            // Verificar si la ubicación existe antes de intentar eliminarla
            if (!$ubicacionModel->find($id)) {
                return redirect()->to('/ubicaciones')->with('error', 'La ubicación no existe.');
            }

            $ubicacionModel->delete($id);
            return redirect()->to('/ubicaciones')->with('success', 'Ubicación eliminada correctamente.');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Manejo del error específico
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/ubicaciones')->with('error', 'No se puede eliminar la ubicación porque está asociada a otros registros.');
            }

            // Otros errores
            return redirect()->to('/ubicaciones')->with('error', 'Ocurrió un error al intentar eliminar la ubicación.');
        }
    }
}
