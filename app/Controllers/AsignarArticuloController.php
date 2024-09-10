<?php namespace App\Controllers;

use App\Models\AsignarArticuloModel;
use App\Models\ComboboxModel;
use App\Models\InventarioModel;
use App\Models\TrasladoModel;
use CodeIgniter\Controller;

class AsignarArticuloController extends Controller
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        }

        // Cargar los datos necesarios para el formulario
        $articulosModel = new ComboboxModel();
        $usuariosModel = new ComboboxModel();
        $estadosModel = new ComboboxModel();
        $ubicacionesModel = new ComboboxModel(); // Carga para las ubicaciones de destino

        $data = [
            'articulos' => $articulosModel->getTableData('articulos'),
            'usuarios'  => $usuariosModel->getTableData('usuarios'),
            'estados'   => $estadosModel->getTableData('estados'),
            'ubicaciones' => $ubicacionesModel->getTableData('ubicaciones'), // Agrega al formulario las ubicaciones
        ];

        return view('asignararticulo', $data);
    }

    public function asignar()
    {
        $validation = \Config\Services::validation();

        $validation->setRules([
            'articulo_id' => 'required|is_not_unique[articulos.id]',
            'de_usuario_id' => 'required|is_not_unique[usuarios.id]',
            'a_usuario_id' => 'required|is_not_unique[usuarios.id]',
            'cantidad_otorgada' => 'required|integer',
            'estado_id' => 'required|is_not_unique[estados.id]',
            'a_ubicacion_id' => 'required|is_not_unique[ubicaciones.id]', // Agrega validación para la ubicación de destino
            'asignado_en' => 'required|valid_date[Y-m-d]',
        ]);

        if (!$this->validate($validation->getRules())) {
            log_message('error', 'Validación fallida: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $articulo_id = $this->request->getPost('articulo_id');
        $cantidad_otorgada = $this->request->getPost('cantidad_otorgada');
        $estado_id = $this->request->getPost('estado_id');
        $asignado_en = date('Y-m-d'); // Establece la fecha actual
        $ubicacion_id = $this->request->getPost('a_ubicacion_id');

        $inventarioModel = new InventarioModel();
        $trasladoModel = new TrasladoModel();
        $asignarModel = new AsignarArticuloModel();

        // Verifica si el artículo está disponible en el estado y ubicación actual
        $inventario = $inventarioModel->where([
            'articulo_id' => $articulo_id,
            'estado_id' => $estado_id
        ])->first();

        if (!$inventario) {
            log_message('error', 'El artículo con ID ' . $articulo_id . ' no se encontró en el estado con ID ' . $estado_id);
            return redirect()->back()->withInput()->with('error', 'Artículo no encontrado.');
        }

        if ($inventario['stock_final'] < $cantidad_otorgada) {
            log_message('error', 'No hay suficiente inventario disponible para el artículo con ID ' . $articulo_id);
            return redirect()->back()->withInput()->with('error', 'No hay suficiente inventario disponible para el artículo seleccionado.');
        }

        // Actualiza el stock del inventario
        $nuevo_stock_final = $inventario['stock_final'] - $cantidad_otorgada;
        $inventarioModel->update($inventario['id'], ['stock_final' => $nuevo_stock_final]);

        // Crea un nuevo registro en traslados
        $trasladoData = [
            'articulo_id'    => $articulo_id,
            'de_ubicacion_id'=> $inventario['ubicacion_id'],
            'a_ubicacion_id' => $ubicacion_id,
            'trasladado_por' => $this->request->getPost('de_usuario_id'),
            'trasladado_en'  => $asignado_en,
        ];
        $trasladoModel->save($trasladoData);

        // Crea un nuevo registro en el inventario para la ubicación de préstamo
        $nuevoInventario = [
            'articulo_id'      => $articulo_id,
            'ubicacion_id'     => $ubicacion_id,
            'estado_id'        => $estado_id,
            'procedencia_id'   => $inventario['procedencia_id'],
            'stock_inicio'     => $cantidad_otorgada,
            'stock_final'      => $cantidad_otorgada,
            'fecha'            => $asignado_en,
        ];
        $inventarioModel->save($nuevoInventario);

        // Guarda la asignación
        $asignarData = [
            'articulo_id'      => $articulo_id,
            'de_usuario_id'    => $this->request->getPost('de_usuario_id'),
            'a_usuario_id'     => $this->request->getPost('a_usuario_id'),
            'cantidad_otorgada'=> $cantidad_otorgada,
            'estado_id'        => $estado_id,
            'asignado_en'      => $asignado_en,
        ];
        $asignarModel->save($asignarData);

        log_message('info', 'Artículo con ID ' . $articulo_id . ' asignado con éxito a usuario con ID ' . $this->request->getPost('a_usuario_id'));

        return redirect()->to('/asignar-articulo')->with('message', 'Artículo asignado con éxito.');
    }
}
