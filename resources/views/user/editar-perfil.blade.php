@extends('layout.index')

@section('title', 'Editar mi perfil | Michi')

@section('main')
    <section id="perfil-editar">
        <div class="container mt-4 mb-4">
            <div id="form_datos" class="row justify-content-center">
                <a class="d-block col-12 mb-4 volver" href="{{route('perfil')}}"><i
                        class="fas fa-long-arrow-alt-left"></i> Volver</a>

                <form action="{{route('perfil.modificar', ['id' => Auth::id()])}}" method="post" class="col-12 col-lg-10 row" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-5 text-center imagen col-12">
                        <label for="img" @error('img') aria-describedby='img_error' @enderror class="position-relative">
                            <span class="sr-only">Cambiar foto</span>
                            <span class="position-absolute"></span>
                            <i class="fas fa-pen position-absolute"></i>
                            <img src="../img/usuarios/{{Auth::user()->img ?? "user.png"}}" alt="{{Auth::user()->user_name}}"
                                 class="img-fluid img_upload" width="300">
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
                               value="{{old('nombre') ?? Auth::user()->nombre}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="apellido" class="font-weight-bold">Apellido</label>
                        <input type="text" name="apellido" id="apellido" class="form-control"
                               value="{{old('apellido') ?? Auth::user()->apellido}}">
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="email" class="font-weight-bold">Email</label>
                        <input type="text" name="email" id="email" class="form-control"
                               value="{{old('email') ?? Auth::user()->email}}"
                               @error('email') aria-describedby='email_error' @enderror>
                        @error('email')
                        <div class="alert alert-danger mt-3" id="email_error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="user_name" class="font-weight-bold">Usuario</label>
                        <input type="text" name="user_name" id="user_name" class="form-control"
                               value="{{old('user_name') ?? Auth::user()->user_name}}"
                               @error('user_name') aria-describedby='user_name_error' @enderror>
                        @error('user_name')
                        <div class="alert alert-danger mt-3" id="user_name_error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="dropdown-divider col-12 mt-5 mb-5"></div>

                    <div class="form-group col-12 col-md-6">
                        <label for="pass_actual" class="font-weight-bold">Contraseña actual</label>
                        <input type="password" name="password" id="pass_actual" class="form-control"
                               value=""
                               @error('pass_actual') aria-describedby='pass_actual_error' @enderror>
                        @error('pass_actual')
                        <div class="alert alert-danger mt-3" id="pass_actual_error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6">
                        <label for="password" class="font-weight-bold">Contraseña nueva</label>
                        <input type="password" name="password" id="password" class="form-control"
                               value=""
                               @error('password') aria-describedby='password_error' @enderror>
                        @error('password')
                        <div class="alert alert-danger mt-3" id="password_error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group col-12 col-md-6 mb-5">
                        <label for="password_conf" class="font-weight-bold">Confirmar contraseña</label>
                        <input type="password" name="password_conf" id="password_conf" class="form-control"
                               value=""
                               @error('password_conf') aria-describedby='password_conf_error' @enderror>
                        @error('password_conf')
                        <div class="alert alert-danger mt-3" id="password_conf_error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-100 d-none d-md-block"></div>
                    <button type="submit" class="michired btn michiyellow d-block m-auto ">Guardar cambios</button>

                </form>
            </div>
        </div>
    </section>
@endsection
