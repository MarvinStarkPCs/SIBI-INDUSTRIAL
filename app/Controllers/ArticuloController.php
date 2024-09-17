<?php namespace App\Controllers;

use App\Helpers\helpers;
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

            return view('gestion_de_extras/articulos', $data);
        }
    }
    public function store()
    {
        $model = new ArticuloModel();
        $cod_instucional  = new helpers();

        // Obtén el servicio de validación
        $validation = \Config\Services::validation();

        // Reglas de validación
        $validation->setRules([
            'nombre' => 'required|string|max_length[20]',
            'marca' => 'required|string|max_length[7]',
            'modelo' => 'required|string|max_length[20]',
            'serial' => 'required|string|max_length[20]',
            'descripcion' => 'required|string',
            'fecha_adquisicion' => 'required|valid_date',
            'valor_unitario' => 'required|decimal',
            'categoria_id' => 'required|integer',
        ]);

        // Validar los datos del formulario
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
        }

        // Recoge los datos del formulario
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'marca' => $this->request->getPost('marca'),
            'modelo' => $this->request->getPost('modelo'),
            'serial' => $this->request->getPost('serial'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_adquisicion' => $this->request->getPost('fecha_adquisicion'),
            'valor_unitario' => $this->request->getPost('valor_unitario'),
            'categoria_id' => $this->request->getPost('categoria_id'),
            'cod_institucional' => $cod_instucional->generateRandomString()
        ];
        log_message('info', 'Datos del formulario: ' . print_r($data, true));
        // Insertar el artículo en la base de datos
        if ($model->save($data)) {
            return redirect()->to('/articulos')->with('success', 'Artículo agregado con éxito.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Hubo un problema al guardar el artículo.');
        }
    }
    public function update($id)
    {
        $model = new ArticuloModel();
        $validation = \Config\Services::validation();
    
        log_message('info', 'Entrando en la función update');
    
        // Reglas de validación para actualizar un artículo
        $validation->setRules([
            'nombre' => 'required|string|max_length[100]',
            'marca' => 'required|string|max_length[50]',
            'descripcion' => 'required|string',
            'fecha_adquisicion' => 'required|valid_date',
            'valor_unitario' => 'required|decimal',
            'categoria_id' => 'required|integer',
        ]);
    
        // Validar los datos del formulario
        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Errores de validación: ' . print_r($validation->getErrors(), true));
            // Si la validación falla, redirige de vuelta con los errores
            return redirect()->back()->withInput()->with('errors-edit', $validation->getErrors());
        }
    
        log_message('info', 'Validación pasada con éxito');
    
        // Si la validación pasa, preparar los datos para actualizar el artículo
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'marca' => $this->request->getPost('marca'),
            'descripcion' => $this->request->getPost('descripcion'),
            'fecha_adquisicion' => $this->request->getPost('fecha_adquisicion'),
            'valor_unitario' => $this->request->getPost('valor_unitario'),
            'categoria_id' => $this->request->getPost('categoria_id'),
        ];
    
        log_message('info', 'Datos para actualizar: ' . print_r($data, true));
    
        // Actualizar el artículo
        if ($model->update($id, $data)) {
            log_message('info', 'Artículo actualizado con éxito');
            // Redirigir con un mensaje de éxito
            return redirect()->to('/articulos')->with('success', 'Artículo actualizado con éxito.');
        } else {
            log_message('error', 'Error al actualizar el artículo');
            // Redirigir con un mensaje de error
            return redirect()->back()->with('error', 'Hubo un problema al actualizar el artículo.');
        }
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
    public function ArticuloExcel()
    {
        $model = new ArticuloModel();
        $articulos = $model->getArticulos(); // Usa tu método para obtener los datos

        // Crear un nuevo Spreadsheet
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Añadir encabezados
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Marca');
        $sheet->setCellValue('D1', 'Serial');
        $sheet->setCellValue('E1', 'Código Institucional');
        $sheet->setCellValue('F1', 'Descripción');
        $sheet->setCellValue('G1', 'Fecha de Adquisición');
        $sheet->setCellValue('H1', 'Valor Unitario');
        $sheet->setCellValue('I1', 'Categoría');

        // Añadir datos
        $row = 2;
        foreach ($articulos as $articulo) {
            $sheet->setCellValue('A' . $row, $articulo['id']);
            $sheet->setCellValue('B' . $row, $articulo['nombre']);
            $sheet->setCellValue('C' . $row, $articulo['marca']);
            $sheet->setCellValue('D' . $row, $articulo['serial']);
            $sheet->setCellValue('E' . $row, $articulo['cod_institucional']);
            $sheet->setCellValue('F' . $row, $articulo['descripcion']);
            $sheet->setCellValue('G' . $row, $articulo['fecha_adquisicion']);
            $sheet->setCellValue('H' . $row, $articulo['valor_unitario']);
            $sheet->setCellValue('I' . $row, $articulo['categoria']);
            $row++;
        }

        // Crear un archivo Excel y enviar al navegador
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $filename = 'articulos_' . date('Y-m-d_H-i') . '.xlsx';


        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

}
