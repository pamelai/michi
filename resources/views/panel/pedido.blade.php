<?php
/** @var \App\Models\Pedidos[]|\Illuminate\Database\Eloquent\Collection $pedido */
/** @var \App\Models\EstadoPedido[]|\Illuminate\Database\Eloquent\Collection $estados_pedidos */
?>


@extends('layout.index')

@section('title', "Pedido #$pedido->pedido_id | Michi")

@section('main')

    <section class="pedidos container mt-4 mb-4 ">
        <div>
            <a class="d-inline-block mb-4 volver" href="{{route('panel')}}">
                <i class="fas fa-long-arrow-alt-left"></i> Volver</a>
            <h2 class="text-center mb-lg-5">Pedido #{{$pedido->pedido_id}}</h2>

            <ul class="row justify-content-md-between justify-content-lg-around w-auto">
                @foreach($pedido->pedidoItems as $item)
                    <li class="card m-0 col-12 col-lg-5 row">
                        <div class="col-10 row no-gutters">
                            <a class="col-4 d-block"
                               href="{{ route('producto.ver', ['id' => $item->producto->producto_id]) }}">
                                <img src="../img/productos/{{$item->producto->img}}"
                                     alt="{{$item->producto->nombre}}"
                                     class="card-img img-fluid">
                            </a>
                            <div class="col-8">
                                <ul class="card-body">
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
                <li class="dropdown-divider col-lg-10"></li>
                <li class="w-100 d-none d-md-block"></li>

                <li class="col-6 col-md-auto">
                    <h4 class="mt-4 mb-3 font-weight-bold">Pago</h4>
                    #{{$pedido->payment_id}}
                </li>

                <li class="col-6 col-md-auto">
                    <h3 class="mt-4 mb-3 font-weight-bold">Estado</h3>
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
                                    <li class="dropdown-item">
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
                </li>

                <li class="col-6 col-md-auto">
                    <h4 class="mt-4 mb-3 font-weight-bold">Fecha</h4>
                    <p>{{date("d-m-Y",strtotime($pedido->fecha))}}</p>
                </li>
            </ul>


        </div>
    </section>

@endsection
