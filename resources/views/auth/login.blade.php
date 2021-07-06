
@extends('layout.index')

@section('title', 'Iniciar sesión | Michi')

@section('main')
    <section id="login" class="container d-flex mt-4 mb-4">
        <div class="row justify-content-center align-self-center w-100">
            <h2 class="col-12 text-center mb-5">Iniciar sesión</h2>

            <form action="{{route('auth.logearse')}}" method="post" class="col-8 col-lg-6">
                @csrf
                <div class="form-group">
                    <label for="user_name" class="font-weight-bold">Usuario</label>
                    <input type="text" name="user_name" id="user_name" class="form-control"
                           value="{{old('user_name')}}" @error('user_name') aria-describedby='user_name_error' @enderror>
                    @error('user_name')
                    <div class="alert alert-danger" id="user_name_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password" class="font-weight-bold">Contraseña</label>
                    <input type="password" name="password" id="password" class="form-control" @error('password') aria-describedby='password_error' @enderror>
                    @error('password')
                    <div class="alert alert-danger" id="password_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="custom-control custom-checkbox mb-5">
                    <input type="checkbox" class="custom-control-input" id="remember_token" name="remember_token">
                    <label class="custom-control-label" for="remember_token">Mantener la sesión iniciada</label>
                </div>

                <button type="submit" class="michired btn michiyellow d-block m-auto ">Acceder</button>
            </form>

            <small class="col-12 text-center mt-4">Sos nuevo? <a href="{{route('registro')}}" class="font-weight-bold d-inline-block">Registrate acá</a></small>
        </div>
    </section>

@endsection
