<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Usuario;
use Illuminate\Http\Request;

/**
 * Class AuthController
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario para que se loguee
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Valida las credenciales del usuario y los loguea
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logearse(Request $request)
    {
        $request->validate(Usuario::$rulesLogin, Usuario::$errorMessages);

        $remember_token = false;
        if (isset($request->remember_token))
            $remember_token = true;

        $credenciales = [
            'user_name' => $request->input('user_name'),
            'password' => $request->input('password')
        ];

        if (Auth::attempt($credenciales, $remember_token) === false) {
            return redirect(url('/login'))
                ->withInput()
                ->with('error', 'Usuario o contraseña incorrecto');
        }

        if (Auth::user()->tipo_id == 1)
            return redirect(url('/panel'))
                ->with('success', "Bienvenida/o " . $request->input('user_name'));
        else
            return redirect(url('/'))
                ->with('success', "Bienvenida/o " . $request->input('user_name'));
    }

    /**
     * Desloguea al usuario
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout()
    {
        Auth::logout();

        return redirect(url('/'))
            ->with('success', 'Volvé pronto! Ya te extrañamos');
    }
}
