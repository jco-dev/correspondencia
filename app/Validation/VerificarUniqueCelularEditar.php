<?php

namespace App\Validation;

use App\Models\PersonaModel;

class VerificarUniqueCelularEditar
{
    public function is_unique_celular_editar(string $str, string $fields, array $data): bool
    {
        $model = new PersonaModel();
        $row = $model->where([ 'celular' =>  $data['celular'], 'id_persona !=' => $data['id_persona']])->first();
        return $row == null;
    }
}
