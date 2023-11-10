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
                $id_oficina_persona = model('AsignacionOficinaModel')->where(['id_persona' => $persona->id_persona, 'estado' => 'REGISTRADO'])->first();
                if ($id_oficina_persona)
                    $session->set('id_oficina', $id_oficina_persona->id_oficina);

                $session->set([
                    'id' => $persona->id_persona,
                    'nombre' => $persona->nombre,
                    'paterno' => $persona->paterno,
                    'materno' => $persona->materno,
                    'rol' => $usuario->rol,
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

    public function salir(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        return redirect()->to(base_url(route_to('login')));
    }

    public function vistaCambiarClave(): \CodeIgniter\HTTP\ResponseInterface
    {
        $vista = view('auth/cambiarClave');
        return $this->response->setJSON(['vista' => $vista]);
    }

    public function actualizarClaveUsuario(): \CodeIgniter\HTTP\ResponseInterface
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'clave_actual' => 'required|is_clave_actual_valido[usuarios.clave]',
            'clave_nueva' => 'required|min_length[6]',
            'clave_confirmar' => 'required|matches[clave_nueva]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return $this->response->setJSON(['validacion' => $validation->getErrors()]);
        }

        $usuarioModel = model('UsuarioModel');
        $respuesta = $usuarioModel->update(
            session()->get('id'),
            [
                'clave' => password_hash(trim($this->request->getVar('clave_nueva')), PASSWORD_DEFAULT),
            ]
        );

        if ($respuesta)
            return $this->response->setJSON(['exito' => true, 'msg' => 'Se actualizó correctamente la clave']);
        else
            return $this->response->setJSON(['exito' => false, 'msg' => 'No se pudo actualizar la clave']);

    }
}
