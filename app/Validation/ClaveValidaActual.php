<?php

namespace App\Validation;

use App\Models\UsuarioModel;

class ClaveValidaActual
{
    public function is_clave_actual_valido(string $str, string $fields, array $data): bool
    {
        $model = new UsuarioModel();
        $row = $model->where([ 'id_usuario' =>  session()->get('id')])->first();
        if(password_verify($str, $row->clave))
            return true;
        else
            return false;
    }
}
