<?php
/** @var \App\Models\Pedidos[]|\Illuminate\Database\Eloquent\Collection $pedidos */
?>

@extends('layout.index')

@section('title', 'Pedidos | Michi')

@section('main')

    <section>
        <div class="encabezado position-relative">
            <h2 class="michiyellow position-absolute">Pedidos</h2>
            <div class="position-absolute onda"></div>
        </div>

        <div class="pedidos usuario container mt-4 mb-4 ">
            <ul class="row">
                @foreach($pedidos as $pedido)
                    <li class="pt-4 pb-4 position-relative col-xl-6">
                        <h3 class="font-weight-bold">Pedido #{{$pedido->pedido_id}}</h3>

                        @if($pedido->estado_id == 1)
                            <div class="btn-group position-absolute">
                                <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <span class="sr-only">Opciones</span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="dropdown-item">
                                        <form action="{{route('pedidos.anular', ['id' => $pedido->pedido_id])}}"
                                              method="post">
                                            @csrf
                                            @method('PUT')

                                            <button type="submit" class="btn btn-danger">Cancelar pedido</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <ul class="row justify-content-md-between justify-content-lg-around">
                            @foreach($pedido->pedidoItems as $item)
                                <li class="card m-0 col-12 col-lg-5 row">
                                    <div class="col-10 row no-gutters col-lg-12">
                                        <a class="col-4 d-block"
                                           href="{{ route('producto.ver', ['id' => $item->producto->producto_id]) }}">
                                            <img src="img/productos/{{$item->producto->img}}"
                                                 alt="{{$item->producto->nombre}}"
                                                 class="card-img img-fluid">
                                        </a>
                                        <div class="col-8">
                                            <ul class="card-body p-0 pl-3">
                                                <li class="card-title"><a class="font-weight-bold d-block"
                                                                          href="{{ route('producto.ver', ['id' => $item->producto->producto_id]) }}">{{$item->producto->nombre}}</a>
                                                </li>
                                                <li class="card-text">${{$item->precio}}</li>
                                                <li class="card-text mt-2">Uds.: {{$item->cantidad}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                            <li class="dropdown-divider col-lg-11 mt-5 mb-5"></li>

                            <li class="col-6 col-md-auto">
                                <h4 class="mb-3 font-weight-bold">Pago</h4>
                                #{{$pedido->payment_id}}
                            </li>

                            <li class="col-6 col-md-auto">
                                <h4 class="mb-3 font-weight-bold">Estado</h4>
                                <p>{{$pedido->estado->estado}}</p>
                            </li>
                            <li class="col-6 col-md-auto">
                                <h4 class="mb-3 font-weight-bold">Fecha</h4>
                                <p>{{date("d-m-Y",strtotime($pedido->fecha))}}</p>
                            </li>
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>

@endsection
