<?php
/** @var \App\Models\Usuario[]|\Illuminate\Database\Eloquent\Collection $usuario */
/** @var \App\Models\TipoUser[]|\Illuminate\Database\Eloquent\Collection $tipo_user */

if (!empty($usuario)):
    $title = "Modificar $usuario->user_name";
    $accion = "Modificar";
    $action = route('usuario.editar-modificar', ['id' => $usuario->usuario_id]);

    if(!empty($usuario->img))
        $img = "../../img/usuarios/$usuario->img";
    else
        $img = "../../img/usuarios/user.png";

else:
    $title = "Crear usuario";
    $accion = "Crear";
    $action = route('usuario.nuevo-alta');
    $usuario = [];
    $img = "../img/usuarios/user.png";

endif;



?>

@extends('layout.index')

@section('title', $title.' | Michi')

@section('main')
    <section id="usuario-editar" class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <a class="d-block col-12 mb-4 volver" href="{{route('panel')}}"><i
                    class="fas fa-long-arrow-alt-left"></i> Volver</a>

            <h2 class="text-center mb-5 col-12">{{$accion}}</h2>


            <form action="{{$action}}" method="post" class="col-12 col-lg-11 row" enctype="multipart/form-data">
                @csrf
                @if(!empty($usuario))
                    @method('PUT')
                @endif

                <div class="mb-5 text-center imagen col-12">
                    <label for="img" @error('img') aria-describedby='img_error'
                           @enderror class="position-relative">
                        <span class="sr-only">Cambiar foto</span>
                        <span class="position-absolute"></span>
                        <i class="fas fa-pen position-absolute"></i>
                        <img src="{{$img}}"
                             alt="{{$usuario->user_name ?? 'Imagen del usuario'}}"
                             class="img-fluid img_upload" width="300" height="300">
                    </label>
                    <input type="file" class="custom-file-input d-none" onchange="readURL(this)" id="img" name="img">
                </div>
                @error('img')
                <div class="alert alert-danger mt-3" id="img_error" role="alert">
                    {{$message}}
                </div>
                @enderror

                <div class="form-group col-12 col-md-6">
                    <label for="nombre" class="font-weight-bold">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                           value="{{old('nombre') ?? ($usuario->nombre ?? '')}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="apellido" class="font-weight-bold">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control"
                           value="{{old('apellido') ?? ($usuario->apellido ?? '')}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="email" class="font-weight-bold">Email</label>
                    <input type="text" name="email" id="email" class="form-control"
                           value="{{old('email') ?? ($usuario->email ?? '')}}"
                           @error('email') aria-describedby='email_error' @enderror>
                    @error('email')
                    <div class="alert alert-danger mt-3" id="email_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="user_name" class="font-weight-bold">Usuario</label>
                    <input type="text" name="user_name" id="user_name" class="form-control"
                           value="{{old('user_name') ?? ($usuario->user_name ?? '')}}"
                           @error('user_name') aria-describedby='user_name_error' @enderror>
                    @error('user_name')
                    <div class="alert alert-danger mt-3" id="user_name_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="tipo_id" class="font-weight-bold">Tipo de usuario</label>
                    <select class="custom-select" name="tipo_id" id="tipo_id"
                            @error('tipo_id') aria-describedby='tipo_id_error' @enderror>
                        <option value="">Seleccioná el usuario</option>
                        @foreach($tipo_user as $tipo)
                            <option value="{{$tipo->tipo_id}}"
                                    @if(!empty($usuario) && collect(old('tipo_id', $usuario->tipoUser->tipo_id))->contains($tipo->tipo_id))
                                    selected
                                    @elseif(collect(old('tipo_id'))->contains($tipo->tipo_id))
                                    selected
                                @endif
                            >{{$tipo->tipo}}</option>
                        @endforeach
                    </select>
                    @error('tipo_id')
                    <div class="alert alert-danger mt-3" id="tipo_id_error" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                @if(!empty($usuario))
                    <div class="dropdown-divider col-12 mt-5 mb-5"></div>

                    <div class="form-group col-12 col-md-6">
                        <label for="pass_actual" class="font-weight-bold">Contraseña actual</label>
                        <input type="password" name="password" id="pass_actual" class="form-control"
                               @if($usuario->usuario_id != Auth::id()) disabled @endif
                               @error('pass_actual') aria-describedby='pass_actual_error' @enderror>
                        @error('pass_actual')
                        <div class="alert alert-danger mt-3" id="pass_actual_error">{{ $message }}</div>
                        @enderror
                    </div>
                @endif
                <div class="form-group col-12 col-md-6">
                    <label for="password" class="font-weight-bold">{{!empty($usuario) ? "Contraseña nueva" : "Constraseña"}}</label>
                    <input type="password" name="password" id="password" class="form-control"
                           @if(!empty($usuario) && $usuario->usuario_id != Auth::id()) disabled @endif
                           @error('password') aria-describedby='password_error' @enderror>
                    @error('password')
                    <div class="alert alert-danger mt-3" id="password_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6 mb-5">
                    <label for="password_conf" class="font-weight-bold">Confirmar contraseña</label>
                    <input type="password" name="password_conf" id="password_conf" class="form-control"
                           @if(!empty($usuario) && $usuario->usuario_id != Auth::id()) disabled @endif
                           @error('password_conf') aria-describedby='password_conf_error' @enderror>
                    @error('password_conf')
                    <div class="alert alert-danger mt-3" id="password_conf_error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="w-100 d-none d-md-block"></div>
                <button type="submit" class=" michired btn michiyellow d-block m-auto">{{$accion}}</button>

            </form>
        </div>
    </section>
@endsection
