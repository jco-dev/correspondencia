<?php

namespace App\Validation;

use App\Models\PersonaModel;

class VerificarUniqueEmailEditar
{
    public function is_unique_email_editar(string $str, string $fields, array $data): bool
    {
        $model = new PersonaModel();
        $row = $model->where([ 'correo_electronico' =>  $data['correo_electronico'], 'id_persona !=' => $data['id_persona']])->first();
        return $row == null;
    }
}
