<?php
namespace App\Controllers;

use App\Models\ComboboxModel;
use App\Models\UbicacionesModels;
use App\Models\InventarioModel;
use App\Models\TrasladoModel; // Asegúrate de tener este modelo
use CodeIgniter\Controller;

class AsignarArticuloController extends Controller
{
    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        }

        // Cargar el modelo de ubicaciones y otros datos
        $ubicacionesModel = new UbicacionesModels();
        $modelEstados = new ComboboxModel();

        // Obtener las ubicaciones con las sedes
        $data['ubicaciones'] = $ubicacionesModel->getUbicacionesWithSedes();
        $data['estados'] = $modelEstados->getTableData('estados', ['id' => [4, 5]]);

        // Pasar los datos a la vista
        return view('asignararticulo', $data);
    }

    public function actualizarUbicacion()
    {
        // Obtener los datos de la solicitud POST
        $origen_id = $this->request->getPost('origen_id');
        $destino_id = $this->request->getPost('destino_id');
        $seriales = $this->request->getPost('seriales'); // Esto debe ser un array de seriales

        // Validar que los campos necesarios estén presentes
        if (empty($origen_id) || empty($destino_id) || empty($seriales)) {
            return $this->response->setJSON(['error' => 'Por favor, asegúrate de que todos los campos estén completos.']);
        }

        if ($origen_id === $destino_id) {
            return $this->response->setJSON(['error' => 'Las ubicaciones de origen y destino no pueden ser iguales.']);
        }

        // Cargar los modelos
        $inventarioModel = new InventarioModel();
        $trasladoModel = new TrasladoModel(); // Asegúrate de tener este modelo

        // Iniciar la transacción
        $db = \Config\Database::connect();
        $db->transStart();

        // Actualizar la ubicación de cada serial y registrar el traslado
        foreach ($seriales as $serial) {
            // Obtener el artículo según el serial y la ubicación de origen
            $articulo = $inventarioModel->where('serial', $serial)
                ->where('ubicacion_id', $origen_id)
                ->first();

            if ($articulo) {
                // Actualizar la ubicación
                $inventarioModel->update($articulo['id'], ['ubicacion_id' => $destino_id]);

                // Registrar el traslado
                $session = session(); // Obtener el ID del usuario en sesión
                $trasladoData = [
                    'articulo_id'    => $articulo['articulo_id'],
                    'de_ubicacion_id'=> $origen_id,
                    'a_ubicacion_id' => $destino_id,
                    'trasladado_por' => $session->get('id_user'),
                    'trasladado_en'  => date('Y-m-d H:i:s'), // Fecha y hora actual
                ];

                $trasladoModel->save($trasladoData);
            }
        }

        // Finalizar la transacción
        $db->transComplete();

        if ($db->transStatus() === FALSE) {
            return $this->response->setJSON(['error' => 'Hubo un problema al actualizar la ubicación.']);
        }

        return $this->response->setJSON(['success' => 'Las ubicaciones se han actualizado correctamente.']);
    }
}
