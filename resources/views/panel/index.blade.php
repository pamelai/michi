<?php
/** @var \App\Models\Producto[]|\Illuminate\Database\Eloquent\Collection $productos */
/** @var \App\Models\Pedidos[]|\Illuminate\Database\Eloquent\Collection $pedidos */
/** @var \App\Models\EstadoPedido[]|\Illuminate\Database\Eloquent\Collection $estados_pedidos */
/** @var \App\Models\Usuario[]|\Illuminate\Database\Eloquent\Collection $usuarios */
/** @var \App\Models\TipoUser[]|\Illuminate\Database\Eloquent\Collection $tipo_user */
?>
@extends('layout.index')

@section('title', 'Panel de administración | Michi')

@section('main')
    <section class="container mt-4 mb-4" id="panel">
        <h2 class="text-center mb-4">Panel de administración</h2>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="productos-tab" data-toggle="tab" href="#productos" role="tab"
                   aria-controls="productos"
                   aria-selected="true">Productos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pedidos-tab" data-toggle="tab" href="#pedidos" role="tab"
                   aria-controls="pedidos"
                   aria-selected="true">Pedidos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="usuarios-tab" data-toggle="tab" href="#usuarios" role="tab"
                   aria-controls="usuarios"
                   aria-selected="true">Usuarios</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="productos" role="tabpanel" aria-labelledby="productos-tab">
                <a class="d-block btn michired michiyellow mt-4 mb-3 ml-auto mr-0" href="{{route('producto.nuevo')}}">Crear</a>

                <table class="table table-hover  table-responsive-md">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productos as $prod)
                        <tr>
                            <td>{{$prod->producto_id}}</td>
                            <td>{{$prod->nombre}}</td>
                            <td>{{$prod->precio}}</td>
                            <td>{{$prod->categoria->categoria}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn michired michiyellow dropdown-toggle" type="button"
                                            id="acciones{{$prod->producto_id}}"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="acciones{{$prod->producto_id}}">
                                        <li class="dropdown-item mb-2">
                                            <a href="{{ route('producto.ver', ['id' => $prod->producto_id]) }}"
                                               class="d-block">Ver</a>
                                        </li>
                                        <li class="dropdown-item mb-2">
                                            <a href="{{route('producto.editar', ['id' => $prod->producto_id])}}">Editar</a>
                                        </li>
                                        <li class="dropdown-divider mb-2"></li>
                                        <li class="dropdown-item">
                                            <form action="{{route('producto.eliminar', ['id' => $prod->producto_id])}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade mt-3" id="pedidos" role="tabpanel" aria-labelledby="pedidos-tab">

                <table class="table table-hover  table-responsive-md">
                    <thead>
                    <tr>
                        <th scope="col">Pedido #</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Piso</th>
                        <th scope="col">Depto</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($pedidos as $pedido)
                        <tr>
                            <td>{{$pedido->pedido_id}}</td>
                            <td>{{"$pedido->calle #$pedido->altura"}}</td>
                            <td>{{$prod->piso ?? 'N/A'}}</td>
                            <td>{{$prod->depto ?? 'N/A'}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn michired michiyellow dropdown-toggle" type="button"
                                            id="estado{{$pedido->pedido_id}}"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        {{$pedido->estado->estado}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="estado{{$pedido->pedido_id}}">

                                        @foreach($estados_pedidos as $estado)
                                            @if($estado->estado_id != $pedido->estado->estado_id)
                                                <li class="dropdown-item drop-hover">
                                                    <form
                                                        action="{{route('pedidos.actualizar', ['estado' => $estado->estado_id, 'pedido' => $pedido->pedido_id])}}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        <button type="submit" class="btn">{{$estado->estado}}</button>
                                                    </form>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn michired michiyellow dropdown-toggle" type="button"
                                            id="acciones_pedido_{{$pedido->pedido_id}}"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="acciones_pedido_{{$pedido->pedido_id}}">
                                        <li class="dropdown-item mb-2">
                                            <a href="{{route('pedidos.ver', ['id' => $pedido->pedido_id])}}"
                                               class="d-block">Ver</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="usuarios" role="tabpanel" aria-labelledby="usuarios-tab">
                <a class="d-block btn michired michiyellow mt-4 mb-3 ml-auto mr-0" href="{{route('usuario.nuevo')}}">Crear</a>

                <table class="table table-hover  table-responsive-md">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Email</th>
                        <th scope="col">Tipo de usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($usuarios as $user)
                        <tr>
                            <td>{{$user->usuario_id}}</td>
                            <td>{{$user->user_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn michired michiyellow dropdown-toggle" type="button"
                                            id="tipo{{$user->usuario_id}}"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        {{$user->tipoUser->tipo}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right"
                                         aria-labelledby="tipo{{$user->usuario_id}}">

                                        @foreach($tipo_user as $tipo)
                                            @if($tipo->tipo_id != $user->tipoUser->tipo_id)
                                                <div class="dropdown-item drop-hover">
                                                    <form
                                                        action="{{route('usuario.actualizar-tipo', ['tipo' => $tipo->tipo_id, 'user' => $user->usuario_id])}}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')

                                                        <button type="submit" class="btn">{{$tipo->tipo}}</button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button class="btn michired michiyellow dropdown-toggle" type="button"
                                            id="acciones_user_{{$user->usuario_id}}"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Acciones
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right"
                                        aria-labelledby="acciones_user_{{$user->usuario_id}}">
                                        <li class="dropdown-item mb-2 drop-hover">
                                            <a href="{{route('usuario.editar', ['id' => $user->usuario_id])}}"
                                               class="d-block">Ver/Editar</a>
                                        </li>
                                        <li class="dropdown-divider mb-2"></li>
                                        <li class="dropdown-item">
                                            <form action="{{route('usuarios.eliminar', ['id' => $user->usuario_id])}}"
                                                  method="post">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>




@endsection
