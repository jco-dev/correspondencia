<?php

namespace App\Controllers;

use App\Libraries\Ssp;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface as ResponseInterfaceAlias;

class EnvioHojaRuta extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\EnvioHojaRutaModel');
    }

    public function index(): string
    {
        return view('envio_hoja_ruta/index');
    }

    public function listadoEnviadosAjax(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "vista_listado_envio_hoja_ruta";
        $primaryKey = 'id_envio_hoja_ruta';
        $where = "id_oficina_envio=" . session()->get('id_oficina') . " AND estado != 'ELIMINADO'";
        $columns = [
            ['db' => 'id_envio_hoja_ruta', 'dt' => 0],
            ['db' => 'id_oficina_envio', 'dt' => 1],
            ['db' => 'estado', 'dt' => 2],
            ['db' => 'numero_hoja_ruta', 'dt' => 3],
            ['db' => 'destinatario', 'dt' => 4],
            ['db' => 'documento_correlativo', 'dt' => 5],
            ['db' => 'fecha_registro', 'dt' => 6, 'formatter' => function ($d) {
                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1);
            }],
            ['db' => 'fecha_recepcion', 'dt' => 7, 'formatter' => function ($d) {
                if (!$d) {
                    return '<span class="badge badge-danger">No recibido</span>';
                }

                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return '<span class="badge badge-success">Recibido el</span>
                        <p>'. preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1).'</p>';
            }],
            [
                'db' => 'id_envio_hoja_ruta',
                'dt' => 8,
                'formatter' => function ($d, $row) {
                    $button = '';
                    if ($row['estado'] != 'RECIBIDO') {
                        $button = '
                            <button class="btn btn-sm btn-primary btn-remitir" data-id="' . $d . '">Remitir</button>
                        ';
                    }
                    return $button;
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

    private function diaLiteralInglesEspanol($dia): string
    {
        $spanishDays = array(
            'Monday' => 'Lunes',
            'Tuesday' => 'Martes',
            'Wednesday' => 'Miércoles',
            'Thursday' => 'Jueves',
            'Friday' => 'Viernes',
            'Saturday' => 'Sábado',
            'Sunday' => 'Domingo'
        );

        return str_replace(array_keys($spanishDays), array_values($spanishDays), $dia);
    }

    public function vistaAgregar(): ResponseInterfaceAlias
    {
        $documentos = model('App\Models\DocumentosModel')
            ->where(['estado' => 'REGISTRADO', 'id_oficina' => session()->get('id_oficina')])->findAll();

        $nombre_oficina = model('App\Models\OficinaModel')
            ->where(['id_oficina' => session()->get('id_oficina')])->first()->nombre;

        $asignacion = model('App\Models\AsignacionOficinaModel')
            ->where(['id_oficina' => session()->get('id_oficina'), 'cargo' => 'JEFE'])->first();

        $nombreJefe = model('App\Models\PersonaModel')
            ->where(['id_persona' => $asignacion->id_persona])->first();

        $oficinas = model('App\Models\OficinaModel')
            ->where(['id_oficina !=' => session()->get('id_oficina')])->findAll();

        $vista = view('envio_hoja_ruta/agregar', [
            'documentos' => $documentos,
            'oficina_remitente' => $nombre_oficina,
            'jefe_oficina' => $asignacion->grado_academico . ' ' . $nombreJefe->nombre . ' ' . $nombreJefe->paterno . ' ' . $nombreJefe->materno,
            'oficinas' => $oficinas
        ]);
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function referenciaDocumento(): ResponseInterfaceAlias
    {
        $id_documento = $this->request->getPost('id_documento');
        $referencia = model('App\Models\DocumentosModel')->where(['id_documento' => $id_documento])->first()->referencia;
        return $this->response->setJSON(['referencia' => $referencia]);
    }

    public function store(): ResponseInterfaceAlias
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'id_documento' => 'required',
            'numero_hojas' => 'required',
            'id_oficina_destino' => 'required',
            'prioridad' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $dataHojaRuta = [
            'id_documento' => $this->request->getPost('id_documento'),
            'id_usuario' => session()->get('id'),
            'numero_hoja_ruta' => $this->obtenerNumeroHojaRuta(),
            'numero_hojas' => $this->request->getPost('numero_hojas'),
            'estado' => 'REGISTRADO'
        ];

        $db = \Config\Database::connect();
        $db->transStart();

        $modelHojaRuta = model('App\Models\HojaRutaDocumentoModel');
        $id_hoja_ruta_documento = $modelHojaRuta->insert($dataHojaRuta);

        if (is_numeric($id_hoja_ruta_documento)) {
            $db->transCommit();
            $documentoModel = model('App\Models\DocumentosModel');
            $documentoModel->update($this->request->getPost('id_documento'), ['estado' => 'ENVIADO']);

            $dataEnvioHojaRuta = [
                'id_hoja_ruta_documento' => $id_hoja_ruta_documento,
                'id_usuario' => session()->get('id'),
                'id_oficina_envio' => session()->get('id_oficina'),
                'id_oficina_destino' => $this->request->getPost('id_oficina_destino'),
                'fecha_envio' => date('Y-m-d H:i:s'),
                'estado' => 'REGISTRADO'
            ];

            $id_envio_hoja_ruta = $this->model->insert($dataEnvioHojaRuta);

            if (is_numeric($id_envio_hoja_ruta))
                return $this->response->setJSON(['exito' => true, 'msg' => 'Se registró correctamente el envio']);
            else
                return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar el envio']);

        } else {
            $db->transRollback();
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo registrar el envio']);
        }
    }

    public function obtenerNumeroHojaRuta()
    {
        $model = model('App\Models\HojaRutaDocumentoModel');
        $numero_hoja_ruta = $model->selectMax('numero_hoja_ruta')->first()->numero_hoja_ruta;
        if ($numero_hoja_ruta == null)
            return 1;
        else
            return $numero_hoja_ruta + 1;
    }

    public function cancelarEnvio(): ResponseInterfaceAlias
    {
        $id_envio_hoja_ruta = $this->request->getPost('id');
        $db = \Config\Database::connect();
        $db->transStart();

        $modelEnvioHojaRuta = model('App\Models\EnvioHojaRutaModel');
        $modelEnvioHojaRuta->update($id_envio_hoja_ruta, ['estado' => 'ELIMINADO']);

        $modelHojaRutaDocumento = model('App\Models\HojaRutaDocumentoModel');
        $modelHojaRutaDocumento->update($modelEnvioHojaRuta->find($id_envio_hoja_ruta)->id_hoja_ruta_documento, ['estado' => 'ELIMINADO']);

        $modelDocumento = model('App\Models\DocumentosModel');
        $modelDocumento->update($modelHojaRutaDocumento->find($modelEnvioHojaRuta->find($id_envio_hoja_ruta)->id_hoja_ruta_documento)->id_documento, ['estado' => 'REGISTRADO']);

        $db->transCommit();
        return $this->response->setJSON(['exito' => true, 'msg' => 'Se canceló correctamente el envio']);
    }

    // ENTRANTES
    public function indexEntrantes(): string
    {
        return view('envio_hoja_ruta/entrantes');
    }

    public function listadoEntrantesAjax(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "vista_listado_envio_hoja_ruta_entrantes";
        $primaryKey = 'id_envio_hoja_ruta';
        $where = "id_oficina_destino=" . session()->get('id_oficina') . " AND estado = 'REGISTRADO'";
        $columns = [
            ['db' => 'id_envio_hoja_ruta', 'dt' => 0],
            ['db' => 'id_oficina_envio', 'dt' => 1],
            ['db' => 'id_oficina_destino', 'dt' => 2],
            ['db' => 'numero_hoja_ruta', 'dt' => 3],
            ['db' => 'destinatario', 'dt' => 4],
            ['db' => 'documento_correlativo', 'dt' => 5],
            ['db' => 'fecha_registro', 'dt' => 6, 'formatter' => function ($d) {
                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1);
            }],
            ['db' => 'fecha_recepcion', 'dt' => 7, 'formatter' => function ($d) {
                if (!$d) {
                    return '<span class="badge badge-danger">No recibido</span>';
                }
                return '<span class="badge badge-success">Recibido el</span>
                        <p>$d</p>';
            }],
            [
                'db' => 'id_envio_hoja_ruta',
                'dt' => 8,
                'formatter' => function ($d, $row) {
                    return '
                        <button class="btn btn-sm btn-success btn-recibir" data-id="' . $d . '">Recibir</button>
                    ';
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

    public function recibirEntrante(): ResponseInterfaceAlias
    {
        $id_envio_hoja_ruta = $this->request->getPost('id');
        $respuesta = $this->model->update($id_envio_hoja_ruta, [
            'estado' => 'RECIBIDO', 'fecha_recepcion' => date('Y-m-d H:i:s')
        ]);
        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se recibió correctamente el documento']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo recibir el documento']);

    }

    // PENDIENTES
    public function indexPendientes(): string
    {
        return view('envio_hoja_ruta/pendientes');
    }

    public function listadoPendientesAjax(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "vista_listado_envio_hoja_ruta_entrantes";
        $primaryKey = 'id_envio_hoja_ruta';
        $where = "id_oficina_destino=" . session()->get('id_oficina') . " AND estado = 'RECIBIDO'";
        $columns = [
            ['db' => 'id_envio_hoja_ruta', 'dt' => 0],
            ['db' => 'id_oficina_envio', 'dt' => 1],
            ['db' => 'estado', 'dt' => 2],
            ['db' => 'numero_hoja_ruta', 'dt' => 3],
            ['db' => 'destinatario', 'dt' => 4],
            ['db' => 'documento_correlativo', 'dt' => 5],
            ['db' => 'fecha_registro', 'dt' => 6, 'formatter' => function ($d) {
                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1);
            }],
            ['db' => 'fecha_recepcion', 'dt' => 7, 'formatter' => function ($d) {
                if (!$d) {
                    return '<span class="badge badge-danger">No recibido</span>';
                }

                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return '<span class="badge badge-success">Recibido el</span>
                        <p>'. preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1).'</p>';
            }],
            [
                'db' => 'id_envio_hoja_ruta',
                'dt' => 8,
                'formatter' => function ($d, $row) {
                    $button = '';
                    if ($row['estado'] == 'RECIBIDO') {
                        $button = '
                            <button class="btn btn-sm btn-primary btn-remitir" data-id="' . $d . '">Remitir</button>
                            <button class="btn btn-sm btn-warning btn-archivar" data-id="' . $d . '">Archivar</button>
                        ';
                    }
                    return $button;
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

    public function archivarPendiente(): ResponseInterfaceAlias
    {
        $id_envio_hoja_ruta = $this->request->getPost('id');
        $respuesta = $this->model->update($id_envio_hoja_ruta, [
            'estado' => 'ARCHIVADO', 'motivo_archivado' => mb_convert_case(trim($this->request->getVar('motivo_archivado')), MB_CASE_UPPER, "UTF-8")
        ]);

        if($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se archivó correctamente el documento']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo archivar el documento']);

    }

    // ARCHIVADOS
    public function indexArchivados(): string
    {
        return view('envio_hoja_ruta/archivados');
    }

    public function listadoArchivadosAjax(): \CodeIgniter\HTTP\ResponseInterface
    {
        $table = "vista_listado_envio_hoja_ruta_entrantes";
        $primaryKey = 'id_envio_hoja_ruta';
        $where = "id_oficina_destino=" . session()->get('id_oficina') . " AND estado = 'ARCHIVADO'";
        $columns = [
            ['db' => 'id_envio_hoja_ruta', 'dt' => 0],
            ['db' => 'id_oficina_envio', 'dt' => 1],
            ['db' => 'estado', 'dt' => 2],
            ['db' => 'numero_hoja_ruta', 'dt' => 3],
            ['db' => 'destinatario', 'dt' => 4],
            ['db' => 'documento_correlativo', 'dt' => 5],
            ['db' => 'fecha_registro', 'dt' => 6, 'formatter' => function ($d) {
                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1);
            }],
            ['db' => 'fecha_recepcion', 'dt' => 7, 'formatter' => function ($d) {
                if (!$d) {
                    return '<span class="badge badge-danger">No recibido</span>';
                }

                $dia = explode(' ', $d)[0];
                $diaEspanol = $this->diaLiteralInglesEspanol($dia);
                return '<span class="badge badge-success">Recibido el</span>
                        <p>'. preg_replace('/\b\w+\b/', '       <b class="text-center">        ' . $diaEspanol . '</b><br>', $d, 1).'</p>';
            }],
            [
                'db' => 'motivo_archivado',
                'dt' => 8,
                'formatter' => function ($d, $row) {
                    return '
                        <p>'.$d.'</p>
                        <button class="btn btn-sm btn-primary btn-desarchivar" data-id="' . $row['id_envio_hoja_ruta'] . '">Desarchivar</button>
                    ';
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

    public function desarchivarArchivado(): ResponseInterfaceAlias
    {
        $id_envio_hoja_ruta = $this->request->getPost('id');
        $respuesta = $this->model->update($id_envio_hoja_ruta, [
            'estado' => 'RECIBIDO', 'motivo_archivado' => null
        ]);

        if($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se desarchivó correctamente el documento']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo desarchivar el documento']);
    }

}
