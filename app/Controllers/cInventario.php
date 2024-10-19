<?php

namespace App\Controllers;

use App\Helpers\helpers;
use App\Models\ArticuloModel;
use App\Models\ComboboxModel;
use App\Models\GestionUsuariosModel;
use App\Models\InventarioModel;
use App\Models\MovimientosModel;
use App\Models\TrasladoModel;
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
        //log_message('debug', 'Session Data: ' . print_r($session->get(), true));

        if (!$session->get('login')) {
           // log_message('debug', 'Redirecting to login because session is not set.');
            return redirect()->to('/'); // Asegúrate de usar la ruta correcta para el login
        } else {
           // log_message('debug', 'User is logged in, loading INVENTARIO view.');

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
            $data['estados'] = $modelEstados->getTableData('estados', ['id' => [4, 5]]); // Asumiendo que getTableData obtiene datos de la tabla
            $data['procedencias'] = $modelProcedencias->getTableData('procedencias'); // Obtener datos de procedencias
            $data['ubicaciones'] = $modelUbicaciones->getTableData('ubicaciones', ['id' => [1, 3]]); // Obtener datos de ubicaciones
            $data['sedes'] = $modelSedes->getTableData('sedes'); // Obtener datos de sedes
            $data['marcas'] = $modelSedes->getTableData('marcas'); // Obtener datos de sedes

//            Pasar los datos a la vista
//            log_message('info', 'Resultados de inventario: ' . print_r($data['inventarios'], true));
//            log_message('info', 'Resultados de Articulos: ' . print_r($data['articulos'], true));
            //log_message('info', 'Resultados de todo: ' . print_r($data, true));
//
            return view('inventario', $data);
        }
    }

//    public function insertinventario()
//    {
//        log_message('info', 'Datos del inventario: ');
//
//        $model = new InventarioModel();
//        $validation = \Config\Services::validation();
//
//        $validation->setRules([
//            'articulo_id' => 'required|integer',
//            'estado_id' => 'required|integer',
//            'procedencia_id' => 'required|integer',
//        ]);
//
//        if (!$validation->withRequest($this->request)->run()) {
//            return redirect()->back()->withInput()->with('errors-open', $validation->getErrors());
//        }
//
//        $articulo_id = $this->request->getPost('articulo_id');
//        $estado_id = $this->request->getPost('estado_id');
//        $procedencia_id = $this->request->getPost('procedencia_id');
//
//        // Siempre se establece la ubicación a ID = 2
//        $ubicacion_id = 2;
//
//        $añoActual = date('Y'); // Obtener el año actual
//
//        // Verificar si ya existe un registro con los mismos datos y del año presente
//        $registroExistente = $model->where('articulo_id', $articulo_id)
//            ->where('ubicacion_id', $ubicacion_id)
//            ->where('estado_id', $estado_id)
//            ->where('procedencia_id', $procedencia_id)
//            ->where('YEAR(fecha_ingreso)', $añoActual)  // Extraer el año del TIMESTAMP
//            ->first();
//
//        // Si el registro ya existe en el año actual
//        if ($registroExistente) {
//            log_message('info', 'Datos del inventario: El registro ya existe.');
//
//            return redirect()->back()->withInput()->with('error', 'El registro con los datos proporcionados ya existe para el año presente.');
//        }
//
//        // Verificar si se han ingresado seriales
//        $seriales = $this->request->getPost('seriales'); // Asegúrate de que el nombre del campo de seriales sea 'seriales[]'
//
//        if ($seriales && is_array($seriales) && count($seriales) > 0) {
//            // Si hay seriales, guardarlos uno por uno
//            foreach ($seriales as $serial) {
//                $data = [
//                    'serial' => $serial, // Guardar el serial
//                    'articulo_id' => $articulo_id,
//                    'ubicacion_id' => $ubicacion_id,
//                    'estado_id' => $estado_id,
//                    'procedencia_id' => $procedencia_id,
//                    'stock_inicio' => 1, // Establecer cantidad en 1
//                ];
//
//                log_message('info', 'Datos del inventario: ' . print_r($data, true));
//
//                $model->insert($data);
//            }
//        } else {
//            // Si no hay seriales, guardar la cantidad ingresada
//            $data = [
//                'serial' => "", // Sin serial
//                'articulo_id' => $articulo_id,
//                'ubicacion_id' => $ubicacion_id,
//                'estado_id' => $estado_id,
//                'procedencia_id' => $procedencia_id,
//                'stock_inicio' => $this->request->getPost('quantity'), // Usar la cantidad ingresada
//            ];
//
//            log_message('info', 'Datos del inventario: ' . print_r($data, true));
//
//            $model->insert($data);
//        }
//
//        return redirect()->to('/inventario')->with('success', 'Agregado al inventario exitosamente.');
//    }
    public function insertinventario()
    {
        log_message('info', 'Inicio del proceso de inserción en el inventario.');
        $cod_instucional  = new helpers();
        $movimientosmodel = new MovimientosModel();
        $model = new InventarioModel();
        $validation = \Config\Services::validation();

        // Establecer reglas de validación
        $validation->setRules([
            'id_articulo' => 'required|integer',
            'estado_id' => 'required|integer',
            'procedencia_id' => 'required|integer',
        ]);

        // Validar los datos
        if (!$validation->withRequest($this->request)->run()) {
            log_message('error', 'Error en la validación: ' . print_r($validation->getErrors(), true));
            return redirect()->back()->withInput()->with('errors-open', $validation->getErrors());
        }

        // Obtener datos del formulario
        $articulo_id = $this->request->getPost('id_articulo');
        $estado_id = $this->request->getPost('estado_id');
        $procedencia_id = $this->request->getPost('procedencia_id');
        log_message('info', 'articulo_id: ' . $articulo_id);
        log_message('info', 'estado_id: ' . $estado_id);
        log_message('info', 'procedencia_id: ' . $procedencia_id);
        // Siempre se establece la ubicación a ID = 2
        $ubicacion_id = 2;

        // Obtener el año actual
        $añoActual = date('Y');
        log_message('info', 'Año actual: ' . $añoActual);
        // Verificar si se han ingresado seriales
        $seriales = $this->request->getPost('seriales'); // Asegúrate de que el nombre del campo de seriales sea 'seriales[]'

        log_message('info', 'Seriales recibidos: ' . print_r($seriales, true));


        if ($seriales && is_array($seriales) && count($seriales) > 0) {


            // Si hay seriales, guardarlos uno por uno
            foreach ($seriales as $serial) {
                $data = [
                    'cod_institucional' => $cod_instucional->generateRandomString(),
                    'serial' => $serial, // Guardar el serial
                    'articulo_id' => $articulo_id,
                    'ubicacion_id' => $ubicacion_id,
                    'estado_id' => $estado_id,
                    'procedencia_id' => $procedencia_id,
                    'stock_inicio' => 1, // Establecer cantidad en 1
                ];

                log_message('info', 'Guardando datos del inventario con serial: ' . print_r($data, true));
                log_message('info', 'Guardando datos del inventario con serial: ' . print_r($serial, true));

                $model->insert($data);
            }
            $serialcount= count($seriales);
            $data = [
                'articulo_id'=> $articulo_id,
                'tipo' => 'entrada',
                'cantidad' => $serialcount,
                'fecha' => date('Y-m-d H:i:s') // Ejemplo de salida: 2024-10-15 10:30:45

            ];
            $movimientosmodel ->insert($data);
        } else {

            // Verificar si ya existe un registro con los mismos datos y del año presente
            $registroExistente = $model->where('articulo_id', $articulo_id)
                ->where('ubicacion_id', $ubicacion_id)
                ->where('estado_id', $estado_id)
                ->where('procedencia_id', $procedencia_id)
                ->where('serial', null) // Verificar si la columna 'seria' es NULL

                ->first();

// Si el registro ya existe en el año actual
            if ($registroExistente) {
                log_message('info', 'Registro existente encontrado: ' . print_r($registroExistente, true));

                // Mensaje largo para la alerta
                $mensajeLargo = "El registro con los datos proporcionados ya existe. " .
                    "Por favor, busque el registro y utilice el botón 'Actualizar'. " .
                    "Si necesita más información, consulte el manual del usuario o póngase en contacto con el soporte técnico para resolver su consulta. " .
                    "Nuestro equipo está aquí para ayudarle.";

                return redirect()->back()->withInput()->with('mensaje', $mensajeLargo);
            } else {
                log_message('info', 'No se encontraron registros existentes. Continuando con la inserción.');
            }
            // Si no hay seriales, guardar la cantidad ingresada
            $cantidad = $this->request->getPost('quantity');
            $data = [
                'cod_institucional' => $cod_instucional->generateRandomString(),
                'serial' => null, // Sin serial
                'articulo_id' => $articulo_id,
                'ubicacion_id' => $ubicacion_id,
                'estado_id' => $estado_id,
                'procedencia_id' => $procedencia_id,
                'stock_inicio' => $cantidad, // Usar la cantidad ingresada
            ];

            log_message('info', 'Guardando datos del inventario sin serial: ' . print_r($data, true));
            $model->insert($data);

            $data = [
                'articulo_id'=> $articulo_id,
                'tipo' => 'ENTRADA',
                'cantidad' => $cantidad,
                'fecha' => date('Y-m-d H:i:s') // Ejemplo de salida: 2024-10-15 10:30:45

            ];
            $movimientosmodel ->insert($data);
        }

        log_message('info', 'Inserción en inventario completada exitosamente.');
        return redirect()->to('/inventario')->with('success', 'Agregado al inventario exitosamente.');
    }


    public function descargarInventarioExcel()
    {
        // Crear una instancia del modelo
        $inventarioModel = new InventarioModel();

        // Obtener los datos del inventario
        $inventarios = $inventarioModel->getInventarioConValorTotal();

        // Verificar si hay datos
        if (empty($inventarios)) {
            // Manejar el caso donde no hay datos
            return; // Salir del método si no hay datos
        }

        // Crear una nueva hoja de cálculo
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Nombrar la hoja de cálculo
        $sheet->setTitle('Inventario');

        // Agregar encabezados de columna
        $headers = [
            'Nombre Artículo', 'Descripción Artículo',
            'Categoría', 'Serial', 'Código Institucional', 'Marca',
            'Estado', 'Procedencia', 'Sede', 'Ubicación',
            'Fecha de Adquisición', 'Fecha de Ingreso',
            'Valor Unitario', 'Valor Total', 'Stock Inicio'
        ];
        foreach ($headers as $columnIndex => $header) {
            // Establecer el encabezado
            $sheet->setCellValue(chr(65 + $columnIndex) . '1', $header);

            // Aplicar el color de fondo a la celda
            $sheet->getStyle(chr(65 + $columnIndex) . '1')->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => '2A6322'],
                ],
                'font' => [
                    'color' => ['argb' => 'FFFFFF'], // Color de texto blanco
                    'bold' => true,
                ],
            ]);
        }

        // Rellenar los datos en la hoja de cálculo
        $row = 2; // Iniciar en la segunda fila porque la primera tiene los encabezados
        foreach ($inventarios as $item) {
            $sheet->setCellValue('A' . $row, $item->nombre_articulo);
            $sheet->setCellValue('B' . $row, $item->descripcion_articulo);
            $sheet->setCellValue('C' . $row, $item->categoria);
            $sheet->setCellValue('D' . $row, $item->serial);
            $sheet->setCellValue('E' . $row, $item->cod_institucional);
            $sheet->setCellValue('F' . $row, $item->nombre_marca);
            $sheet->setCellValue('G' . $row, $item->nombre_estado);
            $sheet->setCellValue('H' . $row, $item->nombre_procedencia);
            $sheet->setCellValue('I' . $row, $item->nombre_sede);
            $sheet->setCellValue('J' . $row, $item->nombre_ubicacion);
            $sheet->setCellValue('K' . $row, $item->fecha_adquisicion);
            $sheet->setCellValue('L' . $row, $item->fecha_ingreso);
            $sheet->setCellValue('M' . $row, $item->valor_unitario);
            $sheet->setCellValue('N' . $row, $item->valor_total);
            $sheet->setCellValue('O' . $row, $item->stock_inicio);
            $row++;
        }

        // Crear un escritor de Excel
        $writer = new Xlsx($spreadsheet);

        // Preparar la respuesta para la descarga
        $filename = 'inventario_' . date('Y-m-d_H-i') . '.xlsx'; // Nombre del archivo
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Guardar el archivo en la salida estándar
        $writer->save('php://output');
        exit();
    }

    public function dardebaja($id)
    {
        $id = intval($id);

        $trasladoModel = new TrasladoModel();
        $model = new InventarioModel();
        $asignado_en = date('Y-m-d'); // Fecha actual
        $cantidad = $this->request->getPost('cantidad');
        $ubicacion_dado_de_baja = '1';  // Nueva ubicación para dado de baja
        $estado_dado_de_baja = '4';     // Nuevo estado para dado de baja

        log_message('info', 'Datos del inventario: ' . $id . ' cantidad ' . $cantidad);

        // Obtener el registro del inventario por ID
        $result = $model->where('id', $id)->first();

        // Validar que el registro exista
        if (!$result) {
            return redirect()->back()->with('error', 'No se encontró el inventario.');
        }

        // Validar si la cantidad solicitada es mayor al stock inicial
        if ($result['stock_inicio'] < $cantidad ||  $cantidad == 0 ) {
            return redirect()->back()->withInput()->with('error', 'Stock insuficiente.');
        }

        // Si la cantidad es igual al stock inicial, actualizamos la ubicación y el estado
        if ($result['stock_inicio'] == $cantidad) {
            $data = [
                'ubicacion_id' => $ubicacion_dado_de_baja,
                'estado_id'    => $estado_dado_de_baja
            ];
            // Actualizar el registro del inventario
            $model->update($id, $data);
        } else {
            // Si no es igual, actualizamos el stock final y creamos un nuevo registro para la ubicación "préstamo"
            $nuevo_stock_inicial = $result['stock_inicio'] - $cantidad;

            // Actualizar el stock del registro existente
            $model->update($id, ['stock_inicio' => $nuevo_stock_inicial]);

            // Crear un nuevo registro de inventario con la cantidad dada de baja en la nueva ubicación
            $nuevoInventario = [
                'articulo_id'    => $result['articulo_id'],
                'ubicacion_id'   => $ubicacion_dado_de_baja,
                'estado_id'      => $estado_dado_de_baja,
                'procedencia_id' => $result['procedencia_id'],
                'stock_inicio'   => $cantidad,
                'fecha'          => $asignado_en,
            ];

            // Guardar el nuevo registro en el inventario
            $model->save($nuevoInventario);
        }

        // Registrar el traslado
        $session = session();
        $trasladoData = [
            'articulo_id'    => $result['articulo_id'],
            'de_ubicacion_id'=> $result['ubicacion_id'],
            'a_ubicacion_id' => $ubicacion_dado_de_baja,
            'trasladado_por' => $session->get('id_user'),
            'trasladado_en'  => $asignado_en,
        ];
        $trasladoModel->save($trasladoData);

        return redirect()->back()->with('success', 'El artículo se ha dado de baja correctamente.');
    }

    public function actualizar($id)
    {
        $id = intval($id);

        $model = new InventarioModel();
        $cantidad = $this->request->getPost('cantidad');

        // Obtener el registro por ID
        $result = $model->where('id', $id)->first();

        // Validar que el registro exista
        if (!$result) {
            return redirect()->back()->with('error', 'No se encontró el inventario.');
        }

        // Sumar la cantidad ingresada a la cantidad actual en la base de datos
        $cantidad_actual = $result['stock_inicio'];
        $nueva_cantidad = $cantidad_actual + $cantidad;

        // Validar si el nuevo stock es negativo
        if ($nueva_cantidad < 0) {
            return redirect()->back()->withInput()->with('error', 'El inventario no puede quedar en negativo.');
        }

        // Actualizar el stock en la base de datos
        $data = [
            'stock_inicio' => $nueva_cantidad,
            // Otros campos si es necesario
        ];

        $model->update($id, $data);

        return redirect()->back()->with('success', 'Inventario actualizado correctamente.');
    }





}
