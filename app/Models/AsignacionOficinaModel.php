<?php

namespace App\Models;

use CodeIgniter\Model;

class AsignacionOficinaModel extends Model
{
    protected $table            = 'asignacion_oficinas';
    protected $primaryKey       = 'id_asignacion_oficina';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_persona',
        'id_oficina',
        'grado_academico',
        'cargo',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'creado_el';
    protected $updatedField  = 'actualizado_el';
}
