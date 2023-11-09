<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Ssp;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;

class AsignacionOficina extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\AsignacionOficinaModel');
    }

    public function index(): string
    {
        return view('asignacion/index');
    }

    public function listadoAsignacionAjax(): ResponseInterfaceAlias
    {
        $table = "vista_asignaciones";
        $primaryKey = 'id_asignacion_oficina';
        $where = null;
        $columns = [
            ['db' => 'id_asignacion_oficina', 'dt' => 0],
            ['db' => 'persona', 'dt' => 1],
            ['db' => 'nombre_oficina', 'dt' => 2],
            ['db' => 'cargo', 'dt' => 3],
            ['db' => 'fecha_inicio', 'dt' => 4],
            ['db' => 'fecha_fin', 'dt' => 5],
            ['db' => 'estado', 'dt' => 6, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">FINALIZADO</span>';
            }],
            [
                'db' => 'id_asignacion_oficina',
                'dt' => 7,
                'formatter' => function ($d, $row) {
                    $editarButton = '<button class="btn btn-sm btn-warning btn-editar" data-id="' . $d . '">Editar</button>';
                    $finalizarButton = ' <button class="btn btn-sm btn-danger btn-finalizar" data-id="' . $d . '">Finalizar</button>';

                    return $row['estado'] == 'REGISTRADO' ? $editarButton . $finalizarButton : $editarButton;
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
        $personas = model('App\Models\PersonaModel')->where('estado', 'REGISTRADO')->findAll();
        $oficinas = model('App\Models\OficinaModel')->where('estado', 'REGISTRADO')->findAll();
        $vista = view('asignacion/agregar', [
            'personas' => $personas,
            'oficinas' => $oficinas
        ]);
        return $this->response->setJSON([
            'vista' => $vista]);
    }

    public function store(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_persona' => 'required',
            'id_oficina' => 'required',
            'grado_academico' => 'required',
            'cargo' => 'required',
            'fecha_inicio' => 'required|valid_date',
            'fecha_fin' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->model->insert([
            'id_persona' => $this->request->getVar('id_persona'),
            'id_oficina' => $this->request->getVar('id_oficina'),
            'grado_academico' => $this->request->getVar('grado_academico'),
            'cargo' => $this->request->getVar('cargo'),
            'fecha_inicio' => $this->request->getVar('fecha_inicio'),
            'fecha_fin' => $this->request->getVar('fecha_fin'),
            'estado' => 'REGISTRADO'
        ]);

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente la asignación']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar la asignación']);

    }

    public function edit(): ResponseInterfaceAlias
    {
        $id_asignacion_oficina = $this->request->getVar('id');
        $asignacion_oficina = $this->model->find($id_asignacion_oficina);
        $personas = model('App\Models\PersonaModel')->where('estado', 'REGISTRADO')->findAll();
        $oficinas = model('App\Models\OficinaModel')->where('estado', 'REGISTRADO')->findAll();
        $vista = view('asignacion/editar', [
            'asignacion_oficina' => $asignacion_oficina,
            'personas' => $personas,
            'oficinas' => $oficinas
        ]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function update(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_asignacion_oficina' => 'required',
            'id_persona' => 'required',
            'id_oficina' => 'required',
            'grado_academico' => 'required',
            'cargo' => 'required',
            'fecha_inicio' => 'required|valid_date',
            'fecha_fin' => 'required|valid_date'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->model->update(
            $this->request->getVar('id_asignacion_oficina'),[
            'id_persona' => $this->request->getVar('id_persona'),
            'id_oficina' => $this->request->getVar('id_oficina'),
            'grado_academico' => $this->request->getVar('grado_academico'),
            'cargo' => $this->request->getVar('cargo'),
            'fecha_inicio' => $this->request->getVar('fecha_inicio'),
            'fecha_fin' => $this->request->getVar('fecha_fin'),
            'estado' => 'REGISTRADO'
        ]);

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro modificado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al modificar el registro']);

    }

    /**
     * @throws \ReflectionException
     */
    public function finalizar(): ResponseInterfaceAlias
    {
        $id_asignacion_oficina = $this->request->getVar('id');
        $respuesta = $this->model->update(
            $id_asignacion_oficina,[
            'estado' => 'FINALIZADO'
        ]);

        if($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro finalizado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al finalizar el registro']);
    }
}
