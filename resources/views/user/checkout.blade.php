<?php
/** @var \App\Models\Ubicaciones[]|\Illuminate\Database\Eloquent\Collection $ubicaciones */
/** @var \App\Models\TiposTarjetas[]|\Illuminate\Database\Eloquent\Collection $tiposTc */

?>
@extends('layout.index')

@section('title', 'Finalizar compra | Michi')

@section('main')
    <section id="checkout" class="container mt-4 mb-4 ">
        <div class="row justify-content-center">
            <h2 class="col-12 text-center mb-5 mt-3">Finalizar compra</h2>

            <form action="{{route('pedidos.nuevo-alta', ['user' => Auth::id()])}}" method="post"
                  class="col-12 row col-xl-10 " id="checkDatos">
                @csrf

                <div class="form-group col-12 col-md-6">
                    <label for="ubicacion_id" class="font-weight-bold">Ubicación</label>
                    <select class="custom-select" name="ubicacion_id" id="ubicacion_id">
                        <option value="">Seleccioná la ubicación</option>
                        @foreach($ubicaciones as $ubi)
                            <option value="{{$ubi->ubicacion_id}}"
                                    @error('ubicacion_id') aria-describedby='ubicacion_id_error' @enderror
                                    @if(collect(old('ubicacion_id'))->contains($ubi->ubicacion_id))
                                    selected
                                @endif
                            >{{$ubi->provincia . ", " . $ubi->partido . ", " . $ubi->localidad}}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-danger mt-3 d-none" id="ubicacion_id_error"></div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="calle" class="font-weight-bold">Calle</label>
                    <input type="text" name="calle" id="calle" class="form-control"
                           value="{{old('calle')}}" >
                    <div class="alert alert-danger mt-3 d-none" id="calle_error"></div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="altura" class="font-weight-bold">Altura</label>
                    <input type="number" name="altura" id="altura" class="form-control"
                           value="{{old('altura')}}">
                    <div class="alert alert-danger mt-3 d-none" id="altura_error"></div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="piso" class="font-weight-bold">Piso <span>(opcional)</span></label>
                    <input type="text" name="piso" id="piso" class="form-control"
                           value="{{old('piso')}}">
                    <div class="alert alert-danger mt-3 d-none" id="piso_error"></div>
                </div>
                <div class="form-group col-12 col-md-6">
                    <label for="depto" class="font-weight-bold">Depto. <span>(opcional)</span></label>
                    <input type="text" name="depto" id="depto" class="form-control"
                           value="{{old('depto')}}">
                    <div class="alert alert-danger mt-3 d-none" id="depto_error"></div>
                </div>

                <div class="w-100 d-none d-md-block"></div>
                <button type="submit" class="michired btn michiyellow d-block ml-auto mr-auto mt-5" formnovalidate>
                    Siguiente
                </button>

                <div class="dropdown-divider col-12 mt-5 mb-5 d-none divisor"></div>
                <script
                    src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
                    data-preference-id="{{$preferencia->id}}" data-elements-color="#E02D3C" data-header-color="#E02D3C">

                </script>
            </form>
        </div>
    </section>

@endsection
