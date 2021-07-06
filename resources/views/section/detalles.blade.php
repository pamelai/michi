<?php
/** @var \App\Models\Producto $producto */

if (Auth::id())
    $user_id = Auth::id();
else
    $user_id = 0;
?>
@extends('layout.index')

@section('title', $producto->nombre . ' | Michi')

@section('main')

    <section>
        <div class="encabezado position-relative">
            <h2 class="michiyellow position-absolute">{{$producto->nombre}}</h2>
            <div class="position-absolute onda"></div>

        </div>
        <div id="detalle-prod" class="container mt-4 mb-4">
            <a class="d-block" href="@guest {{route('productos')}}  @else {{route('panel')}} @endguest"><i
                    class="fas fa-long-arrow-alt-left"></i> Volver</a>
            <div class="row justify-content-center">
                <div class="col-12 col-md-6 align-items-center d-flex">
                    <img src="../img/productos/{{$producto->img}}" alt="{{$producto->nombre}}" class="img-fluid">
                </div>
                <ul class="col-12 col-md-6 row text-center justify-content-center align-items-center">
                    <li class="col-12 mb-3">{{$producto->descripcion}}</li>
                    <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                        <span>Categoría:</span> {{$producto->categoria->categoria}}</li>
                    @if($producto->categoria->categoria == 'Alimentos')
                        <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                            <span>Edad:</span> {{$producto->edad->edad}}</li>
                        <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                            <span>Tipo de alimento:</span> {{$producto->tipoAlimento->tipo}}</li>
                    @endif
                    @if(!empty($producto->peso))
                        <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                            <span>Peso:</span> {{$producto->peso.' '.$producto->unidad->unidad}}</li>
                    @endif
                    @if(!empty($producto->rango_peso))
                        <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                            <span>Rango de peso:</span> {{$producto->rango_peso.' '.$producto->unidad->unidad}}</li>
                    @endif
                    <li class="col-5 col-md-12 m-3 m-md-2 m-lg-0 col-lg-5">
                        <span>Marca:</span> {{$producto->marca->marca}}</li>

                    <li class="col-12 mt-4 mb-3">$ {{$producto->precio}}</li>
                </ul>

                <form action="{{route('item.agregar', ['id' => $producto->producto_id, 'user' => $user_id])}}"
                      method="post" class="col-8 col-md-5 col-lg-4 mt-lg-4 row align-items-center agregarProducto">
                    @csrf

                    <label for="cantidad" class="font-weight-bold col-auto pl-0 m-0">Uds.</label>
                    <input type="number" name="cantidad" id="cantidad" class="form-control col p-2"
                           value="{{!empty(old('cantidad')) ? old('cantidad') : 1}}">
                    <div class="alert alert-danger mt-3 d-none" id="cantidad_error"></div>

                    <button class="btn michired michiyellow font-weight-bold align-self-end col-12 mt-3">Añadir <span
                            class="sr-only">al carrito</span> <i class="fas fa-cart-plus"></i>
                    </button>
                </form>
            </div>
        </div>

    </section>

@endsection
