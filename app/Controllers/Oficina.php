<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Ssp;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;
use ReflectionException;

class Oficina extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\OficinaModel');
    }

    public function index(): string
    {
        return view('oficina/index');
    }

    public function listadoOficinasAjax(): ResponseInterfaceAlias
    {
        $table = "oficinas";
        $primaryKey = 'id_oficina';
        $where = "estado='REGISTRADO'";
        $columns = [
            ['db' => 'id_oficina', 'dt' => 0],
            ['db' => 'nombre', 'dt' => 1],
            ['db' => 'descripcion', 'dt' => 2],
            ['db' => 'creado_el', 'dt' => 3],
            ['db' => 'estado', 'dt' => 4, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_oficina',
                'dt' => 5,
                'formatter' => function ($d, $row) {
                    return '<button class="btn btn-sm btn-warning btn-editar" data-id="' . $d . '">Editar</button>';
                }
            ]
        ];

        $db = \Config\Database::connect();

        $sql_details = array(
            'user' => $db->username,
            'pass' => $db->password,
            'db' => $db->database,
            'host' => $db->hostname
        );

        return $this->response->setJSON(
            json_encode(SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where))
        );
    }

    public function vistaAgregar(): ResponseInterfaceAlias
    {
        $vista = view('oficina/agregar');
        return $this->response->setJSON(['vista' => $vista]);
    }


    public function store(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|is_unique[oficinas.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $id_oficina = $this->model->insert([
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'descripcion' => mb_convert_case(trim($this->request->getVar('descripcion')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        if ($id_oficina)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente la persona']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar la persona']);

    }

    public function edit(): ResponseInterfaceAlias
    {
        $id_oficina = $this->request->getVar('id');
        $oficina = $this->model->find($id_oficina);
        $vista = view('oficina/editar', ['oficina' => $oficina]);
        return $this->response->setJSON(['vista' => $vista]);
    }


    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nombre' => 'required|is_unique_nombre_oficina_edit[oficinas.nombre]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->model->update(
            $this->request->getVar('id_oficina'),
            [
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'descripcion' => mb_convert_case(trim($this->request->getVar('descripcion')), MB_CASE_UPPER, "UTF-8"),
            ]
        );

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro modificado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al modificar el registro']);

    }
}
