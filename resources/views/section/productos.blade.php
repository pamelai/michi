<?php
/** @var \App\Models\Producto[]|\Illuminate\Database\Eloquent\Collection $productos */
?>

@extends('layout.index')

@section('title', 'Productos | Michi')

@section('main')
    <section>
        <div class="encabezado position-relative">
            <h2 class="michiyellow position-absolute">Productos</h2>
            <div class="position-absolute onda"></div>
        </div>

        <div id="productos" class="container mt-4 mb-4">
            <ul class="row text-center justify-content-center justify-content-lg-around">
                @foreach($productos as $prod)
                    <li class="col-7 col-md-5 col-lg-3 m-3 p-3 row justify-content-center producto">
                        <a href="{{ route('producto.ver', ['id' => $prod->producto_id]) }}"
                           class="position-relative mb-2">
                            <div class="position-absolute"></div>
                            <div class="position-relative col-12 p-2">
                                <img src="img/productos/{{$prod->img}}" alt="{{$prod->nombre}}" class="img-fluid">
                                <i class="fas fa-search-plus position-absolute"></i>

                                <p class="mb-0 mt-2">{{$prod->nombre}}</p>
                            </div>
                        </a>

                        <p class=" col-12">$ {{$prod->precio}}</p>

                        @guest
                            <a class="btn michired michiyellow font-weight-bold align-self-end col-12 d-inline-block"
                               href="{{route('registro')}}">Añadir <span class="sr-only">al carrito</span> <i
                                    class="fas fa-cart-plus"></i></a>

                        @else
                            <form action="{{route('item.agregar', ['id' => $prod->producto_id, 'user' => Auth::id()])}}"
                                  method="post" class="col-12 row align-items-center p-0 agregarProducto" >
                                @csrf

                                <button type="submit"
                                        class="btn michired michiyellow font-weight-bold align-self-end col-12 mt-3">
                                    Añadir
                                    <span
                                        class="sr-only">al carrito</span> <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        @endguest
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection
