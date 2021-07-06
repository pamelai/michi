@extends('layout.index')

@section('title', 'Perfil | Michi')

@section('main')
    <section id="perfil">
        <div class="encabezado position-relative">
        <h2 class="michiyellow position-absolute">Perfil</h2>
        <div class="position-absolute onda"></div>
        </div>
        <div class="container mt-5 mb-4">
            <div id="datos" class="row justify-content-center text-center">
                <div class="col-12 col-md-6 col-lg-5">
                    <img src="img/usuarios/{{Auth::user()->img ?? "user.png"}}" alt="{{Auth::user()->user_name}}"
                         class="img-fluid">
                </div>
                <div class="col-12 col-md-6 col-lg-5 row">
                    <h3 class="col-12 mt-4">Datos personales</h3>
                    <ul class="col-12">
                        <li class="mb-3"><span class="font-weight-bold">Nombre:</span> {{Auth::user()->nombre ?? 'Sin especificar'}}
                        </li>
                        <li class="mb-3"><span
                                class="font-weight-bold">Apellido:</span> {{Auth::user()->apellido ?? 'Sin especificar'}}
                        </li>
                        <li class="mb-3"><span class="font-weight-bold">Email:</span> {{Auth::user()->email}}</li>
                        <li><span class="font-weight-bold">Usuario:</span> {{Auth::user()->user_name}}</li>
                    </ul>
                    <a href="{{route('perfil.editar')}}" class="michired btn michiyellow d-block ml-auto mr-auto mt-3">Editar datos <i class="fas fa-user-edit"></i></a>
                </div>

                <div class="dropdown-divider col-12 col-lg-10 mt-5 mb-5"></div>

                <div class="col-12">

                    <h3 class="col-12">Eliminar cuenta</h3>
                    <p class="col-12">Esta acción es irreversible</p>
                    <form action="{{route('perfil.eliminar', ['id' => Auth::id()])}}" method="post" class="col">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="michired btn michiyellow d-block ml-auto mr-auto mt-3">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
