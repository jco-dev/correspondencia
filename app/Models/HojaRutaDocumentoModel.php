<?php

namespace App\Models;

use CodeIgniter\Model;

class HojaRutaDocumentoModel extends Model
{
    protected $table            = 'hoja_ruta_documento';
    protected $primaryKey       = 'id_hoja_ruta_documento';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_documento',
        'id_usuario',
        'numero_hoja_ruta',
        'numero_hojas',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

}
