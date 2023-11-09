<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;
use ReflectionException;

class Persona extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\PersonaModel');
    }

    public function index(): string
    {
        return view('personas/index');
    }

    public function listadoPersonasAjax(): ResponseInterfaceAlias
    {
        $table = "vista_personas";
        $primaryKey = 'id_persona';
        $where = "estado='REGISTRADO'";
        $columns = [
            ['db' => 'id_persona', 'dt' => 0],
            ['db' => 'ci', 'dt' => 1],
            ['db' => 'nombres', 'dt' => 2],
            ['db' => 'fecha_nacimiento', 'dt' => 3],
            ['db' => 'celular', 'dt' => 4],
            ['db' => 'correo_electronico', 'dt' => 5],
            ['db' => 'estado', 'dt' => 6, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_persona',
                'dt' => 7,
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

    public function VerificarPersona(): ResponseInterfaceAlias
    {
        $ci = trim($this->request->getVar('ci'));
        $persona = $this->model->where('ci', $ci)->first();
        if ($persona)
            return $this->response->setJSON(['exito' => true, 'msg' => 'La persona ya se encuentra registrada']);
        else
            return $this->response->setJSON(['exito' => false]);
    }

    /**
     * @throws ReflectionException
     */
    public function store(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'ci' => 'required|numeric|is_unique[personas.ci]',
            'expedido' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|numeric|is_unique[personas.celular]',
            'correo_electronico' => 'required|valid_email|is_unique[personas.correo_electronico]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $id_persona = $this->model->insert([
            'ci' => trim($this->request->getVar('ci')),
            'expedido' => trim($this->request->getVar('expedido')),
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'paterno' => mb_convert_case(trim($this->request->getVar('paterno')), MB_CASE_UPPER, "UTF-8"),
            'materno' => mb_convert_case(trim($this->request->getVar('materno')), MB_CASE_UPPER, "UTF-8"),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'celular' => trim($this->request->getVar('celular')),
            'correo_electronico' => trim($this->request->getVar('correo_electronico')),
            'direccion' => mb_convert_case(trim($this->request->getVar('direccion')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        if (is_numeric($id_persona)) {
            $usuarioModel = model('App\Models\UsuarioModel');
            $data_usuario = [
                'id_usuario' => $id_persona,
                'usuario' => trim($this->request->getVar('correo_electronico')),
                'clave' => password_hash(trim($this->request->getVar('ci')), PASSWORD_DEFAULT),
                'rol' => 'USUARIO',
                'estado' => 'ACTIVO'
            ];

            $respuesta = $usuarioModel->insert($data_usuario);
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente la persona']);
        } else {
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar la persona']);
        }
    }

    public function vistaAgregar(): ResponseInterfaceAlias
    {
        $vista = view('personas/agregar');
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function edit(): ResponseInterfaceAlias
    {
        $id_persona = $this->request->getVar('id');
        $persona = $this->model->find($id_persona);
        $vista = view('personas/editar', ['persona' => $persona]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    /**
     * @throws ReflectionException
     */
    public function update(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_persona' => 'required',
            'ci' => 'required|numeric|is_unique_ci_editar['.trim($this->request->getVar('ci')).']',
            'expedido' => 'required',
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'celular' => 'required|numeric|is_unique_celular_editar['.trim($this->request->getVar('celular')).']',
            'correo_electronico' => 'required|valid_email|is_unique_email_editar['.trim($this->request->getVar('ci')).']',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $respuesta = $this->model->update($this->request->getVar('id_persona'), [
            'ci' => trim($this->request->getVar('ci')),
            'expedido' => trim($this->request->getVar('expedido')),
            'nombre' => mb_convert_case(trim($this->request->getVar('nombre')), MB_CASE_UPPER, "UTF-8"),
            'paterno' => mb_convert_case(trim($this->request->getVar('paterno')), MB_CASE_UPPER, "UTF-8"),
            'materno' => mb_convert_case(trim($this->request->getVar('materno')), MB_CASE_UPPER, "UTF-8"),
            'fecha_nacimiento' => $this->request->getVar('fecha_nacimiento'),
            'celular' => trim($this->request->getVar('celular')),
            'correo_electronico' => trim($this->request->getVar('correo_electronico')),
            'direccion' => mb_convert_case(trim($this->request->getVar('direccion')), MB_CASE_UPPER, "UTF-8"),
            'estado' => 'REGISTRADO'
        ]);

        $usuarioModel = model('UsuarioModel');
        $usuarioModel->update(
            $this->request->getVar('id_persona'),
            ['usuario' => trim($this->request->getVar('correo_electronico'))]
        );

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro modificado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al modificar el registro']);

    }
}
