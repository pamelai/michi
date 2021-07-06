<?php

namespace App\Http\Controllers;

use App\Models\TipoUser;
use App\Models\Usuario;
use Doctrine\DBAL\Platforms\Keywords\ReservedKeywordsValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;
use Auth;


class UsuariosController extends Controller
{
    /**
     * Muestra la pantalla de registro
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function registro()
    {
        return view('section.registro');
    }

    /**
     * Da de alta un nuevo usuario
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alta(Request $request)
    {
        if (strpos(request()->session()->previousUrl(), '/registro') !== false) {
            $urlErr = "/registro";
            $urlOk = "/login";
            $msjOk = "Registro exitoso! Ya podés iniciar sesión";
            $msjErr = "Hubo un error al crear tu cuenta, intentá más tarde";

            $request->validate(Usuario::$rules, Usuario::$errorMessages);
            $data = $request->input();
            $data['tipo_id'] = 2;

        } else {
            $rules = Usuario::$rules;
            $rules['tipo_id'] = 'required|integer|exists:tipoUsuarios';
            $request->validate($rules, Usuario::$errorMessages);
            $data = $request->input();

            $urlErr = "usuarios/nuevo";
            $urlOk = "/panel";
            $msjOk = "El usuario $request->user_name se creó con éxito";
            $msjErr = "Hubo un error al crear al usuario $request->user_name";
        }

        $data['password'] = Hash::make($data['password']);

        $usuario = Usuario::create($data);

        if ($usuario)
            return redirect(url($urlOk))->with('success', $msjOk);

        else
            return redirect(url($urlErr))->with('error', $msjErr);
    }

    /**
     * Perfil del usuario
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function perfil()
    {
        return view('user.perfil');
    }

    /**
     * Muestra el formulario para editar un usuario con sus datos pre cargados
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id = null)
    {
        if ($id) {
            $usuario = Usuario::findOrFail($id);
            $tipo_user = TipoUser::all();

            return view('panel.form-usuarios', [
                'usuario' => $usuario,
                'tipo_user' => $tipo_user
            ]);
        } else
            return view('user.editar-perfil');

    }

    /**
     * Muestra el formulario para crear un nuevo usuario
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nuevo()
    {
        $tipo_user = TipoUser::all();


        return view('panel.form-usuarios', ['tipo_user' => $tipo_user]);
    }


    /**
     * Modifica un usuario en específico
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function modificar(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        if (strpos(request()->session()->previousUrl(), '/perfil') !== false) {
            $url = "/perfil";
            $msjOk = "Tus datos fueron actualizados con éxito";
            $msjErr = "Hubo un error al actualizar tus datos, intentá más tarde";

        } else {
            $url = "usuarios/$usuario->usuario_id/editar";
            $msjOk = "El usuario $usuario->user_name se actualizó con éxito";
            $msjErr = "Hubo un error al alcualizar al usuario $usuario->user_name";
        }

        $rules = [
            'img' => 'mimes:jpeg,jpg,png',
            'password' => 'nullable|min:5',
            'password_conf' => 'required_with:password|same:password',
            'pass_actual' => 'required_with:password'
        ];
        if ($request->email != $usuario->email)
            $rules['email'] = 'required|email|unique:usuarios';

        if ($request->user_name != $usuario->user_name)
            $rules['user_name'] = 'required|unique:usuarios|min:3';


        $validate = Validator::make($request->all(), $rules, Usuario::$errorMessages);

        if (!empty($request->password)) {
            $credenciales = [
                'user_name' => $usuario->user_name,
                'password' => $request->input('password')
            ];

            $auth = Auth::attempt($credenciales);
            if (!$auth && $validate->fails()) {
                $validate->errors()->add('pass_actual', 'Contraseña incorrecta');
                return redirect($url)->withErrors($validate);
            }

        } elseif ($validate->fails())
            return redirect($url)->withErrors($validate);

        $data = $request->all();

        if (!empty($data['password']))
            $data['password'] = Hash::make($data['password']);
        else
            unset($data['password']);

        if (!empty($request->img)) {
            if ($usuario->img) {
                $pathImg = "img/usuarios/$usuario->img";
                if (File::exists($pathImg))
                    File::delete($pathImg);
            }

            $image = $request->img;
            $nombre = strtolower(str_replace([':', '.'], '', str_replace(' ', '_', $data['user_name']))) . '_' . date('Ymd') . '.' . $image->extension();
            $ruta = public_path('img/usuarios');

            $img = Image::make($image->path());

            $img->resize(300, 300, function ($constraint) {

                $constraint->aspectRatio();

            })->save("$ruta/$nombre");

            $data['img'] = $nombre;
        }

        if ($usuario->update($data))
            return redirect(url($url))->with('success', $msjOk);

        else
            return redirect(url($url))->with('error', $msjErr);
    }

    /**
     * @param $tipo
     * @param $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function cambiarTipo($tipo, $user)
    {
        $usuario = Usuario::findOrFail($user);

        $data = [
            'tipo_id' => $tipo
        ];
        $usuario->update($data);

        return redirect(url('/panel'))->with('success', "Se actualizó el tipo de usuario de $usuario->nombre");
    }


    /**
     * Elimina un producto en específico
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function eliminar($id)
    {
        $usuario = Usuario::findOrFail($id);

        if (strpos(request()->session()->previousUrl(), '/perfil') !== false) {
            $url = "/";
            $msjOk = "Lamentamos que tengas que irte. Hasta la próxima!";
            $msjErr = "No se pudo eliminar tu cuenta, intentá más tarde";

        } else {
            $url = "panel";
            $msjOk = "El usuario $usuario->nombre se eliminó con éxito";
            $msjErr = "Hubo un error al eliminar el usuario $usuario->nombre";
        }

        if ($usuario->delete())
            return redirect(url($url))->with('success', $msjOk);

        else
            return redirect(url($url))->with('error', $msjErr);

    }
}
