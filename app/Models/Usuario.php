<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;


/**
 * App\Models\Usuario
 *
 * @property int $usuario_id
 * @property string|null $nombre
 * @property string|null $apellido
 * @property string $email
 * @property string $user_name
 * @property string $password
 * @property string|null $img
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereApellido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereUserName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereUsuarioId($value)
 * @mixin \Eloquent
 * @property int $tipo_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\CarritoItem[] $carrito
 * @property-read int|null $carrito_count
 * @property-read \App\Models\TipoUser $tipoUser
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Usuario whereTipoId($value)
 */
class Usuario extends User
{
    protected $table = "usuarios";
    protected $primaryKey = "usuario_id";

    protected $fillable = ['nombre', 'apellido', 'email', 'user_name', 'password', 'img', 'tipo_id', 'remember_token'];

    protected $hidden = ['password', 'remember_token'];

    public static $rulesLogin = [
        'user_name' => 'required|exists:usuarios',
        'password' => 'required'
    ];

    public static $rules = [
        'user_name' => 'required|unique:usuarios|min:3',
        'password' => 'required|min:5',
        'password_conf' => 'required|same:password',
        'email' => 'required|email|unique:usuarios',
        'img' => 'mimes:jpeg,jpg,png',
    ];

    public static $errorMessages = [
        'user_name.required' => 'El usuario no puede estar vacío',
        'user_name.exists' => 'El usuario no existe',
        'user_name.unique' => 'El usuario ya existe',
        'user_name.min' => 'El usuario debe de tener al menos :min caracteres',
        'password.required' => 'La contraseña no puede estar vacía',
        'password.min' => 'La contraseña debe de tener al menos :min caracteres',
        'password_conf.required' => 'La confirmación de contraseña no puede estar vacía',
        'password_conf.required_with' => 'La confirmación de contraseña no puede estar vacía',
        'password_conf.same' => 'Las contraseñas no coinciden',
        'pass_actual.required_with' => 'La contraseña actual no puede estar vacía',
        'email.required' => 'El email no puede estar vacío',
        'email.email' => 'El email debe de tener el formato correcto',
        'email.unique' => 'El email ya existe',
        'img.mimes' => 'La imagen debe de ser .jpeg o .png',
        'tipo_id.required' => 'El tipo de usuario no puede estar vacío',
        'tipo_id.integer' => 'El tipo de usuario no existe',
        'tipo_id.exists' => 'El tipo de usuario no existe'
    ];

    public function tipoUser(){
        return $this->belongsTo(TipoUser::class, 'tipo_id', 'tipo_id');
    }

    public function carrito()
    {
        return $this->belongsToMany(CarritoItem::class, 'carrito', 'usuario_id', 'item_id', 'usuario_id', 'item_id');
    }
}
