<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchivoAdjuntoEnviosModel extends Model
{
    protected $table            = 'archivos_adjuntos_envios';
    protected $primaryKey       = 'id_archivo_adjunto_envio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_envio_hoja_ruta',
        'id_usuario',
        'nota',
        'numero_hojas',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
}
