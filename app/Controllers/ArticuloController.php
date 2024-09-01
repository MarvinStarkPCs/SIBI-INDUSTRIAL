<?php namespace App\Controllers;

use App\Models\ArticuloModel;
use App\Models\ComboboxModel;

class ArticuloController extends BaseController
{

    public function index()
    {
        $session = session();
        // Verifica si la sesión 'login' está activa
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        } else {
            $model = new ArticuloModel();
            $modelcombo = new ComboboxModel();
            $data['articulos'] = $model->getArticulos();
            $data['categorias'] = $modelcombo->getTableData('categorias');
            $data['estados'] = $modelcombo->getTableData('estados');

            return view('gestion_de_extras/articulos', $data);
        }
    }

    public function store()
    {
        $model = new ArticuloModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'marca' => $this->request->getPost('marca'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_adquisicion' => $this->request->getPost('fecha_adquisicion'),
            'valor_unitario' => $this->request->getPost('valor_unitario'),
            'estado_id' => $this->request->getPost('estado_id'),
            'procedencia_id' => $this->request->getPost('procedencia_id'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ];

        $model->save($data);

        return redirect()->to('/articulos');
    }

    public function update($id)
    {
        $model = new ArticuloModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'marca' => $this->request->getPost('marca'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_adquisicion' => $this->request->getPost('fecha_adquisicion'),
            'valor_unitario' => $this->request->getPost('valor_unitario'),
            'estado_id' => $this->request->getPost('estado_id'),
            'procedencia_id' => $this->request->getPost('procedencia_id'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ];

        $model->update($id, $data);

        return redirect()->to('/articulos');
    }
    public function delete($id)
    {
        $model = new ArticuloModel();

        // Validar si el ID es válido
        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/articulos')->with('error', 'ID de artículo inválido.');
        }

        try {
            // Verificar si el artículo existe antes de intentar eliminarlo
            if (!$model->find($id)) {
                return redirect()->to('/articulos')->with('error', 'El artículo no existe.');
            }

            $resultado = $model->delete($id);

            if ($resultado) {
                return redirect()->to('/articulos')->with('success', 'Artículo eliminado correctamente.');
            } else {
                return redirect()->to('/articulos')->with('error', 'No se pudo eliminar el artículo.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            // Manejo del error específico
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/articulos')->with('error', 'No se puede eliminar el artículo porque está asociado a otros registros o al inventario.');
            }

            // Otros errores
            return redirect()->to('/articulos')->with('error', 'Ocurrió un error al intentar eliminar el artículo.');
        }
    }

}
