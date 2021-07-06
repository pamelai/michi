
@extends('layout.index')

@section('title', 'Registrarse | Michi')

@section('main')
    <section id="login" class="container d-flex mt-4 mb-4">
        <div class="row justify-content-center align-self-center align-items-center">
            <h2 class="col-12 text-center mb-4 mb-md-5">Registrarse</h2>

            <form action="{{route('registro.alta')}}" method="post" class="col-12 row col-xl-10">
                @csrf
                <div class="form-group col-12 col-md-6">
                    <label for="nombre" class="font-weight-bold">Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control"
                           value="{{old('nombre')}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="apellido" class="font-weight-bold">Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control"
                           value="{{old('apellido')}}">
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="email" class="font-weight-bold">Email *</label>
                    <input type="text" name="email" id="email" class="form-control"
                           value="{{old('email')}}" @error('email') aria-describedby='email_error' @enderror>
                    @error('email')
                    <div class="alert alert-danger" id="email_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="user_name" class="font-weight-bold">Usuario *</label>
                    <input type="text" name="user_name" id="user_name" class="form-control"
                           value="{{old('user_name')}}" @error('user_name') aria-describedby='user_name_error' @enderror>
                    @error('user_name')
                    <div class="alert alert-danger" id="user_name_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="password" class="font-weight-bold">Contraseña *</label>
                    <input type="password" name="password" id="password" class="form-control" @error('password') aria-describedby='password_error' @enderror>
                    @error('password')
                    <div class="alert alert-danger" id="password_error">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-5 col-12 col-md-6">
                    <label for="password_conf" class="font-weight-bold">Confirmar contraseña *</label>
                    <input type="password" name="password_conf" id="password_conf" class="form-control" @error('password_conf') aria-describedby='password_conf_error' @enderror>
                    @error('password_conf')
                    <div class="alert alert-danger" id="password_conf_error">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="michired btn michiyellow d-block m-auto ">Registrarse</button>
            </form>
        </div>
    </section>

@endsection
