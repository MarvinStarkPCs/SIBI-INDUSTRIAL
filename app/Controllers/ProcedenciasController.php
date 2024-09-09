<?php

namespace App\Controllers;

use App\Models\ProcedenciasModel;
use CodeIgniter\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ProcedenciasController extends BaseController
{
    public function index()
    {
        $session = session();
        if (!$session->get('login')) {
            return redirect()->to('/'); // Redirige al login si no está logueado
        }

        $model = new ProcedenciasModel();
        $data['procedencias'] = $model->findAll();

        return view('gestion_de_extras/procedencias', $data);
    }

    public function store()
    {
        $model = new ProcedenciasModel();
        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombre' => 'required|string|max_length[100]',
            'nit_o_cc' => 'required|string|max_length[20]',
            'direccion' => 'required|string|max_length[255]',
            'telefono' => 'required|string|max_length[20]',
            'representante' => 'required|string|max_length[100]',
            'correo' => 'required|valid_email',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-insert', $validation->getErrors());
        }

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'nit_o_cc' => $this->request->getPost('nit_o_cc'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'representante' => $this->request->getPost('representante'),
            'correo' => $this->request->getPost('correo'),
        ];

        if ($model->save($data)) {
            return redirect()->to('/procedencias')->with('success', 'Procedencia agregada con éxito.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Hubo un problema al guardar la procedencia.');
        }
    }

    public function update($id)
    {
        $model = new ProcedenciasModel();

        $validation = \Config\Services::validation();

        $validation->setRules([
            'nombre' => 'required|string|max_length[100]',
            'nit_o_cc' => 'required|string|max_length[20]',
            'direccion' => 'required|string|max_length[255]',
            'telefono' => 'required|string|max_length[20]',
            'representante' => 'required|string|max_length[100]',
            'correo' => 'required|valid_email',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors-edit', $validation->getErrors());
        }

        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'nit_o_cc' => $this->request->getPost('nit_o_cc'),
            'direccion' => $this->request->getPost('direccion'),
            'telefono' => $this->request->getPost('telefono'),
            'representante' => $this->request->getPost('representante'),
            'correo' => $this->request->getPost('correo'),
        ];

        if ($model->update($id, $data)) {
            return redirect()->to('/procedencias')->with('success', 'Procedencia actualizada con éxito.');
        } else {
            return redirect()->back()->with('error', 'Hubo un problema al actualizar la procedencia.');
        }
    }

    public function delete($id)
    {
        $model = new ProcedenciasModel();

        if (!is_numeric($id) || $id <= 0) {
            return redirect()->to('/procedencias')->with('error', 'ID de procedencia inválido.');
        }

        try {
            if (!$model->find($id)) {
                return redirect()->to('/procedencias')->with('error', 'La procedencia no existe.');
            }

            if ($model->delete($id)) {
                return redirect()->to('/procedencias')->with('success', 'Procedencia eliminada correctamente.');
            } else {
                return redirect()->to('/procedencias')->with('error', 'No se pudo eliminar la procedencia.');
            }
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            if (strpos($e->getMessage(), 'Cannot delete or update a parent row: a foreign key constraint fails') !== false) {
                return redirect()->to('/procedencias')->with('error', 'No se puede eliminar la procedencia porque está asociada a otros registros.');
            }

            return redirect()->to('/procedencias')->with('error', 'Ocurrió un error al intentar eliminar la procedencia.');
        }
    }

    public function procedenciasExcel()
    {
        $model = new ProcedenciasModel();
        $procedencias = $model->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nombre');
        $sheet->setCellValue('C1', 'NIT O CC');
        $sheet->setCellValue('D1', 'Dirección');
        $sheet->setCellValue('E1', 'Teléfono');
        $sheet->setCellValue('F1', 'Representante');
        $sheet->setCellValue('G1', 'Correo');

        $row = 2;
        foreach ($procedencias as $procedencia) {
            $sheet->setCellValue('A' . $row, $procedencia['id']);
            $sheet->setCellValue('B' . $row, $procedencia['nombre']);
            $sheet->setCellValue('C' . $row, $procedencia['nit_o_cc']);
            $sheet->setCellValue('D' . $row, $procedencia['direccion']);
            $sheet->setCellValue('E' . $row, $procedencia['telefono']);
            $sheet->setCellValue('F' . $row, $procedencia['representante']);
            $sheet->setCellValue('G' . $row, $procedencia['correo']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'procedencias_' . date('Y-m-d_H-i') . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}
