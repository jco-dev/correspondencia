<?php

namespace App\Validation;

use App\Models\OficinaModel;

class VerificarUniqueNombreOficinaEditar
{
     public function is_unique_nombre_oficina_edit(string $str, string $fields, array $data): bool
     {
         $model = new OficinaModel();
         $row = $model->where([ 'nombre' =>  $data['nombre'], 'id_oficina !=' => $data['id_oficina']])->first();
         return $row == null;
     }
}
