<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentosModel extends Model
{
    protected $table            = 'documentos';
    protected $primaryKey       = 'id_documento';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_oficina',
        'id_usuario_creado',
        'numero_correlativo',
        'tipo_informe',
        'tipo_documento',
        'referencia',
        'archivo',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';

}
