<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Ssp;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;
use PhpParser\Node\Stmt\Return_;

class Documentos extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\DocumentosModel');
    }

    public function index(): string
    {
        return view('documentos/index');
    }


    public function listadoDocumentosAjax(): ResponseInterfaceAlias
    {
        $table = "vista_listado_documentos";
        $primaryKey = 'id_documento';
        $where = "id_oficina=" . session()->get('id_oficina');
        $columns = [
            ['db' => 'id_documento', 'dt' => 0],
            ['db' => 'tipo_documento', 'dt' => 1],
            ['db' => 'referencia', 'dt' => 2],
            ['db' => 'archivo', 'dt' => 3, 'formatter' => function ($d, $row) {
                if (!$d) {
                    return '';
                }
                return "<h5>
                    <small class='text-center d-block'>Archivo</small>
                    <span class='badge badge-secondary text-center d-block'>$d</span>
                </h5>
                <h6 class='d-flex justify-content-center'>
                    <button class='btn btn-danger btn-sm btn-block eliminar-archivo' data-id='" . $row['id_documento'] . "' style='padding: 0px 15px;'>borrar</button>
                </h6>";
            }],
            ['db' => 'creado_el', 'dt' => 4],
            ['db' => 'estado', 'dt' => 5, 'formatter' => function ($d, $row) {
                if ($d == 'REGISTRADO')
                    return '<span class="badge badge-success">REGISTRADO</span>';
                else
                    return '<span class="badge badge-danger">ELIMINADO</span>';
            }],
            [
                'db' => 'id_documento',
                'dt' => 6,
                'formatter' => function ($d, $row) {
                    $descarga = '';
                    if ($row['archivo']) {
                        $descarga = '<button class="btn btn-sm btn-primary btn-descargar text-center" data-id="' . $d . '">
                                <i class="material-icons small">download</i>
                            </button>';
                    }

                    return '<div class="d-flex justify-content-around">
                            <button class="btn btn-sm btn-warning btn-editar" data-id="' . $d . '"><i class="material-icons small">edit</i></button>&nbsp; 
                            ' . $descarga . '
                    </div>';
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
        $numero_correlativo = $this->model->selectMax('numero_correlativo')->where(['id_oficina' => session()->get('id_oficina'), 'estado' => 'REGISTRADO'])->first();
        $numero_correlativo = $numero_correlativo->numero_correlativo + 1;
        $vista = view('documentos/agregar', ['numero_correlativo' => $numero_correlativo]);
        return $this->response->setJSON(['vista' => $vista]);
    }


    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'tipo_documento' => 'required',
            'tipo_informe' => 'required',
            'numero_correlativo' => 'required',
            'referencia' => 'required',
            'archivo' => 'permit_empty|uploaded[archivo]|max_size[archivo,10420]|ext_in[archivo,pdf,doc,docx]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $archivo = $this->request->getFile('archivo');
        $nombre_archivo = null;

        if ($archivo->isValid()) {
            $nombre_archivo = $this->request->getVar('tipo_informe') . '_' . $this->request->getVar('numero_correlativo') . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '/uploads/documentos/', $nombre_archivo);
        }

        $respuesta = $this->model->insert([
            'id_oficina' => session()->get('id_oficina'),
            'id_usuario_creado' => session()->get('id'),
            'numero_correlativo' => $this->request->getVar('numero_correlativo'),
            'tipo_documento' => $this->request->getVar('tipo_documento'),
            'tipo_informe' => $this->request->getVar('tipo_informe'),
            'referencia' => mb_convert_case(trim($this->request->getVar('referencia')), MB_CASE_UPPER, "UTF-8"),
            'archivo' => $nombre_archivo,
        ]);

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente el documento']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar el documento']);

    }

    public function edit()
    {
        $id_documento = $this->request->getVar('id');
        $documento = $this->model->where(['id_documento' => $id_documento])->first();
        $vista = view('documentos/editar', ['documento' => $documento]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function update()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_documento' => 'required',
            'tipo_documento' => 'required',
            'tipo_informe' => 'required',
            'numero_correlativo' => 'required',
            'referencia' => 'required',
            'archivo' => 'permit_empty|uploaded[archivo]|max_size[archivo,10420]|ext_in[archivo,pdf,doc,docx]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $archivo = $this->request->getFile('archivo');
        $nombre_archivo = null;

        if ($archivo->isValid()) {
            $nombre_archivo = $this->request->getVar('tipo_informe') . '_' . $this->request->getVar('numero_correlativo') . '.' . $archivo->getExtension();
            $archivo->move(WRITEPATH . '/uploads/documentos/', $nombre_archivo);
        }

        $data = [
            'id_oficina' => session()->get('id_oficina'),
            'id_usuario_creado' => session()->get('id'),
            'numero_correlativo' => $this->request->getVar('numero_correlativo'),
            'tipo_documento' => $this->request->getVar('tipo_documento'),
            'tipo_informe' => $this->request->getVar('tipo_informe'),
            'referencia' => mb_convert_case(trim($this->request->getVar('referencia')), MB_CASE_UPPER, "UTF-8"),
        ];

        if ($nombre_archivo !== null) {
            $data['archivo'] = $nombre_archivo;
        }

        $respuesta = $this->model->update(
            $this->request->getVar('id_documento'),
            $data
        );



        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Registro editado correctamente']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al editar el registro']);

    }

    public function descargar($id_documento)
    {
        $documento = $this->model->where(['id_documento' => $id_documento])->first();
        $ruta = WRITEPATH . '/uploads/documentos/' . $documento->archivo;
        return $this->response->download($ruta, null);
    }

    public function eliminarArchivo()
    {
        $id_documento = $this->request->getVar('id');
        $documento = $this->model->where(['id_documento' => $id_documento])->first();

        if (!$documento) {
            return $this->response->setJSON(['exito' => false, 'msg' => 'El documento no existe']);
        }

        $ruta = WRITEPATH . 'uploads/documentos/' . $documento->archivo;

        if (file_exists($ruta) && unlink($ruta)) {
            $respuesta = $this->model->update(
                $id_documento,
                ['archivo' => null]
            );

            if ($respuesta) {
                return $this->response->setJSON(['exito' => true, 'msg' => 'Archivo eliminado correctamente']);
            } else {
                return $this->response->setJSON(['exito' => false, 'msg' => 'Error al actualizar la base de datos']);
            }
        } else {
            return $this->response->setJSON(['exito' => false, 'msg' => 'Error al eliminar el archivo o el archivo no existe']);
        }
    }

}
