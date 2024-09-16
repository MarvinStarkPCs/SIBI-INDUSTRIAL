<?php namespace App\Controllers;

use App\Models\AsignarArticuloModel;
use App\Models\ComboboxModel;
use App\Models\InventarioModel;
use App\Models\TrasladoModel;
use App\Models\GestionUsuariosModel;

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
        $usuariosModel = new GestionUsuariosModel();
        $estadosModel = new ComboboxModel();
        $ubicacionesModel = new ComboboxModel(); // Carga para las ubicaciones de destino
        $data = [
            'articulos' => $articulosModel-> getTableData('articulos'),
            'usuarios'  => $usuariosModel->getUsuariosConPerfiles(),
                    ];

        return view('asignararticulo', $data);
    }
    public function asignar()
    {
        $validation = \Config\Services::validation();

        // Configura las reglas de validación
        $validation->setRules([
            'articulo_id'      => 'required|is_not_unique[articulos.id]',
            'usuario_id'       => 'required|is_not_unique[usuarios.id]',
            'cantidad_otorgada'=> 'required|integer',
            'estado_id'        => 'required|is_not_unique[estados.id]',
        ]);

        // Valida los datos del formulario
        if (!$this->validate($validation->getRules())) {
            log_message('error', 'Validación fallida: ' . json_encode($validation->getErrors()));
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
$usuario=$this->request->getVar('usuario_id');
        $articulo_id = $this->request->getPost('articulo_id');
        $cantidad_otorgada = $this->request->getPost('cantidad_otorgada');
        $estado_id = $this->request->getPost('estado_id');
        $asignado_en = date('Y-m-d'); // Fecha actual
        $ubicacion_id = $this->request->getPost('id_ubicacion');
        $ubicacion_id_pretamo = "3"; // ID de ubicación de préstamo

        $inventarioModel = new InventarioModel();
        $trasladoModel = new TrasladoModel();
        $asignarModel = new AsignarArticuloModel();

        // Obtiene la información del inventario
        $inventario = $inventarioModel->where([
            'articulo_id' => $articulo_id,
            'estado_id' => $estado_id
        ])->first();

        // Verifica si hay suficiente inventario
        if ($inventario['stock_inicio'] < $cantidad_otorgada) {
            log_message('error', 'No hay suficiente inventario disponible para el artículo con ID ' . $articulo_id);
            return redirect()->back()->withInput()->with('error', 'No hay suficiente inventario disponible para el artículo seleccionado.');
        }

        // Verifica si la cantidad otorgada es igual al stock inicial
        if ($cantidad_otorgada == $inventario['stock_inicio']) {
            // Cambia la ubicación a 'préstamo'
            $inventarioModel->update(
                $inventario['id'],
                ['ubicacion_id' => $ubicacion_id_pretamo]
            );
        } else {
            // Actualiza el stock y guarda el ítem en la ubicación de préstamo
            $nuevo_stock_final = $inventario['stock_inicio'] - $cantidad_otorgada;
            $inventarioModel->update($inventario['id'], ['stock_inicio' => $nuevo_stock_final]);

            $nuevoInventario = [
                'articulo_id'      => $articulo_id,
                'ubicacion_id'     => $ubicacion_id_pretamo,
                'estado_id'        => $estado_id,
                'procedencia_id'   => $inventario['procedencia_id'],
                'stock_inicio'     => $cantidad_otorgada,
                'stock_final'      => $cantidad_otorgada,
                'fecha'            => $asignado_en,
            ];
            $inventarioModel->save($nuevoInventario);
        }

        $session = session(); // Obtén el objeto de sesión

        // Crea un nuevo registro en la tabla de traslados
        $trasladoData = [
            'articulo_id'    => $articulo_id,
            'de_ubicacion_id'=> $ubicacion_id,
            'a_ubicacion_id' => $ubicacion_id_pretamo,
            'trasladado_por' => $session->get('id_user'),
            'trasladado_en'  => $asignado_en,
        ];
        $trasladoModel->save($trasladoData);

        // Guarda la asignación
        $asignarData = [
            'articulo_id'      => $articulo_id,
            'de_usuario_id'    => $session->get('id_user'),
            'a_usuario_id'     => $usuario,
            'cantidad_otorgada'=> $cantidad_otorgada,
            'estado_id'        => $estado_id,
            'asignado_en'      => $asignado_en,
        ];
        $asignarModel->save($asignarData);

        log_message('info', 'Artículo con ID ' . $articulo_id . ' asignado con éxito a usuario con ID ' . $this->request->getPost('a_usuario_id'));

        return redirect()->to('/asignar-articulo')->with('success', 'Artículo asignado con éxito.');
    }

}
