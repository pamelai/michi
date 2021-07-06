<?php
$total = 0;
?>
@extends('layout.index')

@section('title', 'Carrito | Michi')

@section('main')
    <section>
        <div class="encabezado position-relative">
            <h2 class="michiyellow position-absolute">Carrito</h2>
            <div class="position-absolute onda"></div>
        </div>

        <div id="carrito"
             class="container {{!count(Auth::user()->carrito) ? 'd-flex justify-content-center' : ''}} mt-4 mb-4">
            @if(count(Auth::user()->carrito))
                <div id="listado-completo">
                    <ul class="row justify-content-center justify-content-md-around  justify-content-lg-center mr-3 ml-3">
                        @foreach(Auth::user()->carrito as $item)
                            <?php
                            $total += (double)($item->subtotal);
                            ?>
                            <li class="producto col-8 col-md-5 col-lg-4 col-xl-3 p-3 pt-5 m-3 row position-relative justify-content-center"
                                id="itemCarrrito-{{$item->item_id}}">
                                <form action="{{route('item.eliminar', ['id' => $item->item_id])}}"
                                      method="post" class="position-absolute elimiarItem">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"><i class="fas fa-times"></i><span
                                            class="sr-only">Eliminar</span>
                                    </button>
                                </form>
                                <a href="{{ route('producto.ver', ['id' => $item->producto->producto_id]) }}"
                                   class="position-relative mb-2">
                                    <div class="position-absolute"></div>
                                    <div class="position-relative col-12 p-2">
                                        <img src="img/productos/{{$item->producto->img}}"
                                             alt="{{$item->producto->nombre}}"
                                             class="img-fluid">
                                        <i class="fas fa-search-plus position-absolute"></i>

                                        <p class="mb-0 mt-2 text-center">{{$item->producto->nombre}}</p>
                                    </div>
                                </a>
                                <ul>
                                    <li class="mb-2"><span class="font-weight-bold">Precio por unidad:</span>
                                        ${{(double)$item->precio}}</li>
                                    <li class="mb-2">
                                        <form action="{{route('item.cantidad', ['id' => $item->item_id])}}"
                                              method="post" class="row align-items-center actualizarTotal">
                                            @csrf
                                            @method('PUT')

                                            <label for="cantidad{{$item->item_id}}" class="font-weight-bold col-3 m-0">Uds.:</label>
                                            <input type="number" name="cantidad" id="cantidad{{$item->item_id}}"
                                                   class="form-control col p-0 text-center"
                                                   value="{{!empty(old('cantidad')) ? old('cantidad') : $item->cantidad}}">
                                            <button class="btn col-3">
                                                <span class="sr-only">Actualizar</span>
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                            <div class="alert alert-danger mt-3 mr-3 ml-3 d-none cantidad_error"
                                                 id="cantidad_error{{$item->item_id}}"></div>
                                        </form>
                                    </li>
                                    <li class="mt-4 font-weight-bold text-center subtotal">Subtotal:
                                        ${{(double)($item->subtotal)}}</li>
                                </ul>
                            </li>
                        @endforeach

                    </ul>

                    <p class="text-center mt-2 mb-4 font-weight-bold p-4 total">Total: ${{$total}}</p>

                    <div class="row justify-content-center align-items-center">
                        <a class="btn michired michiyellow font-weight-bold col-auto"
                           href="{{route('pedidos.nuevo')}}">Finalizar
                            compra</a>

                        <form action="{{route('carrito.vaciar', ['user' => Auth::id()])}}"
                              method="post" class="col-auto" id="vaciarCarrito">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="text-danger">Vaciar carrito</button>
                        </form>
                    </div>
                </div>
            @else
                <p id="carrito-vacio"
                   class="mt-5 mb-5 font-weight-bold text-center {{!count(Auth::user()->carrito) ? 'align-self-center' : ''}} ">
                    No hay productos en el carrito</p>
            @endif
        </div>
    </section>
@endsection
