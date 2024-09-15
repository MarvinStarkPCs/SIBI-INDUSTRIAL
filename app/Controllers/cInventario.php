<?php

namespace App\Controllers;

use App\Models\ArticuloModel;
use App\Models\ComboboxModel;
use App\Models\GestionUsuariosModel;
use App\Models\InventarioModel;
use CodeIgniter\Controller;
require_once APPPATH . '../vendor/autoload.php'; // Nota: ../ mueve un directorio hacia arriba

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class CInventario extends Controller
{
    public function index()
    {
        $session = session();

        // Log de datos de la sesión
        log_message('debug', 'Session Data: ' . print_r($session->get(), true));

        if (!$session->get('login')) {
            log_message('debug', 'Redirecting to login because session is not set.');
            return redirect()->to('/'); // Asegúrate de usar la ruta correcta para el login
        } else {
            log_message('debug', 'User is logged in, loading INVENTARIO view.');

            // Cargar los modelos
            $modelInventario = new InventarioModel();
            $modelArticulo = new ArticuloModel();
            $modelEstados = new ComboboxModel();
            $modelProcedencias = new ComboboxModel();
            $modelUbicaciones = new ComboboxModel();
            $modelSedes = new ComboboxModel();

// Obtener los datos
            $data['inventarios'] = $modelInventario->getInventarioConValorTotal();
            $data['articulos'] = $modelArticulo->getArticulos(); // Asumiendo que estás obteniendo todos los artículos
            $data['estados'] = $modelEstados->getTableData('estados', ['id'=>[4,5]]); // Asumiendo que getTableData obtiene datos de la tabla
            $data['procedencias'] = $modelProcedencias->getTableData('procedencias'); // Obtener datos de procedencias
            $data['ubicaciones'] = $modelUbicaciones->getTableData('ubicaciones',['id'=>[1,3]]); // Obtener datos de ubicaciones
            $data['sedes'] = $modelSedes->getTableData('sedes'); // Obtener datos de sedes
            // Pasar los datos a la vista
            return view('inventario', $data);
        }
    }

    public function insertinventario()
    {
        $model = new InventarioModel();

        $validation = \Config\Services::validation();

        $validation->setRules([
            'quantity' => 'required|integer',
            'articulo_id' => 'required|integer',
            'estado_id' => 'required|integer',
            'procedencia_id' => 'required|integer',
            'ubicacion_id' => 'required|integer',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-open', $validation->getErrors());
        }

        $articulo_id = $this->request->getPost('articulo_id');
        $ubicacion_id = $this->request->getPost('ubicacion_id');
        $estado_id = $this->request->getPost('estado_id');
        $procedencia_id = $this->request->getPost('procedencia_id');

        // Verificar si el registro ya existe
        if ($model->exists($articulo_id, $ubicacion_id, $estado_id, $procedencia_id)) {
            log_message('info', 'Datos del inventario: ');

            return redirect()->back()->withInput()->with('error', 'El registro con los datos proporcionados ya existe.');

        }

        $data = [
            'articulo_id' => $articulo_id,
            'ubicacion_id' => $ubicacion_id,
            'estado_id' => $estado_id,
            'procedencia_id' => $procedencia_id,
            'stock_inicio' => $this->request->getPost('quantity'),
        ];

        log_message('info', 'Datos del inventario: ' . print_r($data, true));

        $model->insert($data);

        return redirect()->to('/inventario')->with('success', 'Agregado al inventario exitosamente.');
    }


    public function descargarInventarioExcel(){

        // Crear una instancia del modelo
        $inventarioModel = new InventarioModel();

        // Obtener los datos del inventario
        $inventarios = $inventarioModel->getInventarioConValorTotal(); // Asegúrate de que este método exista en el modelo

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Agregar encabezados de columna
        $sheet->setCellValue('A1', 'ID Artículo');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Marca');
        $sheet->setCellValue('D1', 'Descripción');
        $sheet->setCellValue('E1', 'Fecha de Adquisición');
        $sheet->setCellValue('F1', 'Valor Unitario');
        $sheet->setCellValue('G1', 'Estado');
        $sheet->setCellValue('H1', 'Procedencia');
        $sheet->setCellValue('I1', 'Categoría');
        $sheet->setCellValue('J1', 'Ubicación');
        $sheet->setCellValue('K1', 'Stock Inicio');
        $sheet->setCellValue('L1', 'Stock Final');
        $sheet->setCellValue('M1', 'Fecha');
        $sheet->setCellValue('N1', 'Precio Total');

        // Rellenar los datos en la hoja de cálculo
        $row = 2; // Iniciar en la segunda fila porque la primera tiene los encabezados
        foreach ($inventarios as $item) {
            $sheet->setCellValue('A' . $row, $item->articulo_id);
            $sheet->setCellValue('B' . $row, $item->articulo_nombre);
            $sheet->setCellValue('C' . $row, $item->articulo_marca);
            $sheet->setCellValue('D' . $row, $item->articulo_descripcion);
            $sheet->setCellValue('E' . $row, $item->articulo_fecha_adquisicion);
            $sheet->setCellValue('F' . $row, $item->articulo_valor_unitario);
            $sheet->setCellValue('G' . $row, $item->estado_nombre);
            $sheet->setCellValue('H' . $row, $item->procedencia_nombre);
            $sheet->setCellValue('I' . $row, $item->categoria_nombre);
            $sheet->setCellValue('J' . $row, $item->ubicacion_nombre);
            $sheet->setCellValue('K' . $row, $item->inventario_stock_inicio);
            $sheet->setCellValue('L' . $row, $item->inventario_stock_final);
            $sheet->setCellValue('M' . $row, $item->inventario_fecha);
            $sheet->setCellValue('N' . $row, $item->precio_total);
            $row++;
        }

        // Crear un escritor de Excel
        $writer = new Xlsx($spreadsheet);

        // Preparar la respuesta para la descarga
        $filename = 'inventario_' . date('Y-m-d_H-i') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Guardar el archivo en la salida estándar
        $writer->save('php://output');
        exit();
    }

}
