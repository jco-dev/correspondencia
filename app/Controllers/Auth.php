<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Auth extends BaseController
{
    public function index(): string
    {
        return view('auth/login');
    }

    public function autenticar(): \CodeIgniter\HTTP\RedirectResponse
    {
        $usuario = trim($this->request->getPost('usuario'));
        $clave = $this->request->getPost('clave');

        $usuarioModel = model('UsuarioModel');
        $usuario = $usuarioModel->where(['usuario' => $usuario, 'estado' => 'ACTIVO'])->first();

        $session = session();
        if ($usuario) {
            if (password_verify($clave, $usuario->clave)) {

                $persona = model('PersonaModel')->find($usuario->id_usuario);

                $session->set([
                    'id'        => $persona->id_persona,
                    'nombre'    => $persona->nombre,
                    'paterno'   => $persona->paterno,
                    'materno'   => $persona->materno,
                    'rol'       => $usuario->rol,
                    'logged_in' => true
                ]);

                return redirect()->to(base_url(route_to('inicio')))
                    ->with('success', 'Bienvenido ' . $persona->nombre . ' ' . $persona->paterno);
            } else {
                $session->setFlashdata('error', 'El nombre de usuario o la contraseña son incorrectos');
                return redirect()->to(base_url(route_to('login')));
            }
        } else {
            $session->setFlashdata('error', 'El nombre de usuario o la contraseña son incorrectos');
            return redirect()->to(base_url(route_to('login')));
        }

    }
}
