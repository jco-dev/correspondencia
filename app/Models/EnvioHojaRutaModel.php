<?php

namespace App\Models;

use CodeIgniter\Model;

class EnvioHojaRutaModel extends Model
{
    protected $table            = 'envio_hoja_ruta';
    protected $primaryKey       = 'id_envio_hoja_ruta';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_hoja_ruta_documento',
        'id_usuario',
        'id_oficina_envio',
        'id_oficina_destino',
        'fecha_envio',
        'fecha_recepcion',
        'prioridad',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

}
