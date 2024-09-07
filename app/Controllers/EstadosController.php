<?php namespace App\Controllers;

use App\Models\EstadosModel;
use App\Helpers\helpers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EstadosController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        }

        $model = new EstadosModel();
        $data['estados'] = $model->findAll();

        return view('gestion_de_extras/estados', $data);
    }

    public function store()
    {
        $model = new EstadosModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombre' => 'required|string|max_length[100]',
            'descripcion' => 'permit_empty|string',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
        }

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/estados')->with('success', 'Categoría agregada con éxito.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Hubo un problema al guardar la categoría.');
        }
    }

    public function update($id)
    {
        $model = new EstadosModel();

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'descripcion' => $this->request->getPost('descripcion'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/estados')->with('success', 'Categoría actualizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar la categoría.');
        }
    }

    public function delete($id)
    {
        $model = new EstadosModel();

        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/estados')->with('error', 'ID de categoría inválido.');
        }

        try {
            if (!$model->find($id)) {
                return redirect()->to('/estados')->with('error', 'La categoría no existe.');
            }

            if ($model->delete($id)) {
                return redirect()->to('/estados')->with('success', 'Categoría eliminada correctamente.');
            } else {
                return redirect()->to('/estados')->with('error', 'No se pudo eliminar la categoría.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/estados')->with('error', 'No se puede eliminar la categoría porque está asociada a otros registros.');
            }

            return redirect()->to('/estados')->with('error', 'Ocurrió un error al intentar eliminar la categoría.');
        }
    }

    public function EstadosExcel()
    {
        $model = new EstadosModel();
        $estados = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'Descripción');

        $row = 2;
        foreach ($estados as $Estados) {
            $sheet->setCellValue('A' . $row, $Estados['id']);
            $sheet->setCellValue('B' . $row, $Estados['nombre']);
            $sheet->setCellValue('C' . $row, $Estados['descripcion']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'estados_' . date('Y-m-d_H-i') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
