<?php

namespace App\Controllers;
use App\Models\HistorialInventariomodel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class HistorialInventarioController extends BaseController
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
            $modelInventario = new HistorialInventariomodel();


            $data['inventarios'] = $modelInventario->getInventarioConValorTotal();

            return view('historialInventario', $data);
        }
    }
    public function descargarInventarioExcel(){

        // Crear una instancia del modelo
        $inventarioModel = new HistorialInventariomodel();

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
        $sheet->setCellValue('M1', 'Fecha de registro inventario');
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
        $filename = 'historial_inventario_' . date('Y-m-d_H-i') . '.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Guardar el archivo en la salida estándar
        $writer->save('php://output');
        exit();
    }


}