<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class HojaRutaDocumento extends BaseController
{
    public $model;

    public function __construct()
    {
        $this->model = model('App\Models\HojaRutaDocumentoModel');
    }

    public function index()
    {
        //
    }
}
