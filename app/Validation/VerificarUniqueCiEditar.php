<?php

namespace App\Validation;

use App\Models\PersonaModel;

class VerificarUniqueCiEditar
{
    public function is_unique_ci_editar(string $str, string $fields, array $data): bool
    {
        $model = new PersonaModel();
        $row = $model->where([ 'ci' =>  $data['ci'], 'id_persona !=' => $data['id_persona']])->first();
        return $row == null;
    }
}
