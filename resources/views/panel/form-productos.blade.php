<?php
/** @var \App\Models\Marca[]|\Illuminate\Database\Eloquent\Collection $marcas */
/** @var \App\Models\Categoria[]|\Illuminate\Database\Eloquent\Collection $categorias */
/** @var \App\Models\Edad[]|\Illuminate\Database\Eloquent\Collection $edades */
/** @var \App\Models\TipoAlimento[]|\Illuminate\Database\Eloquent\Collection $tipoAlimentos */
/** @var \App\Models\Unidad[]|\Illuminate\Database\Eloquent\Collection $unidades */
/** @var \App\Models\Producto $producto */
/** @var \Illuminate\Support\ViewErrorBag $errors */

if (!empty($producto)):
    $title = "Modificar $producto->nombre";
    $accion = "Modificar";
    $action = route('producto.editar-modificar', ['id' => $producto->producto_id]);
    $img = "../../img/productos/$producto->img";

else:
    $title = "Crear producto";
    $accion = "Crear";
    $action = route('producto.nuevo-alta');
    $producto = [];
    $img = "../img/productos/producto.jpg";
endif;

?>
@extends('layout.index')

@section('title', $title . ' | Michi')

@section('main')
    <section id="form-prod" class="container mt-4 mb-4">
        <h2 class="text-center mb-4">{{$accion}} producto</h2>

        <a class="d-inline-block mb-4" href="{{route('panel')}}">
            <i class="fas fa-long-arrow-alt-left"></i> Volver</a>
        <form class="col-12 col-lg-9 row m-auto" action="{{$action}}" method="post" enctype="multipart/form-data">
            @csrf
            @if(!empty($producto))
                @method('PUT')
            @endif
            <div class="mb-5 text-center imagen col-12">
                <label for="img" @error('img') aria-describedby='img_error'
                       @enderror class="position-relative">
                    <span class="sr-only">Cambiar foto</span>
                    <span class="position-absolute"></span>
                    <i class="fas fa-pen position-absolute"></i>
                    <img src="{{$img}}"
                         alt="{{$usuario->user_name ?? 'Imagen del producto'}}"
                         class="img-fluid img_upload"  width="500" height="500">
                </label>
                <input type="file" class="custom-file-input d-none" onchange="readURL(this)" id="img" name="img">

                @error('img')
                <div class="alert alert-danger mt-3" id="img_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>


            <div class="form-group col-12">
                <label for="nombre" class="font-weight-bold">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control"
                       placeholder="Ingrese el nombre del producto" @error('nombre') aria-describedby='nombre_error'
                       @enderror
                       value="{{!empty($producto) ? old('nombre', $producto->nombre) : old('nombre')}}">
                @error('nombre')
                <div class="alert alert-danger" id="nombre_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-12 row pr-0">
                <div class="form-group col-12 pr-0 col-md-6 pr-lg-2">
                    <label for="precio" class="font-weight-bold">Precio</label>
                    <input type="number" name="precio" step="0.01" id="precio" class="form-control"
                           placeholder="Ingrese el precio del producto"
                           value="{{!empty($producto) ? old('precio', $producto->precio) : old('precio')}}"
                           @error('precio') aria-describedby='precio_error' @enderror>
                    @error('precio')
                    <div class="alert alert-danger" id="precio_error" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-12 pr-0 col-md-6 pl-lg-4">
                    <label for="promo" class="font-weight-bold">Promo</label>
                    <select class="custom-select" name="promo" id="promo"
                            @error('promo') aria-describedby='promo_error' @enderror>
                        <option value="0"
                                @if(!empty($producto) && collect(old('promo', $producto->promo))->contains(0))
                                selected
                                @elseif(collect(old('promo'))->contains(0))
                                selected
                            @endif
                        >No
                        </option>
                        <option value="1"
                                @if(!empty($producto) && collect(old('promo', $producto->promo))->contains(1))
                                selected
                                @elseif(collect(old('promo'))->contains(1))
                                selected
                            @endif
                        >Si
                        </option>
                    </select>
                    @error('promo')
                    <div class="alert alert-danger" id="promo_error" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group col-12">
                <label for="descripcion" class="font-weight-bold">Descripción</label>
                <textarea class="form-control" name="descripcion"
                          id="descripcion"
                          rows="7"
                          @error('descripcion') aria-describedby='descripcion_error' @enderror>{{!empty($producto) ? old('descripcion', $producto->descripcion) : old('descripcion')}}</textarea>
                @error('descripcion')
                <div class="alert alert-danger" id="descripcion_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="categoria_id" class="font-weight-bold">Categoría</label>
                <select class="custom-select" name="categoria_id" id="categoria_id" onchange="Habilitar(name, value)"
                        @error('categoria_id') aria-describedby='categoria_id_error' @enderror>
                    <option value="">Seleccioná la categoría</option>
                    @foreach($categorias as $cate)
                        <option value="{{$cate->categoria_id}}"
                                @if( !empty($producto) && collect(old('categoria_id', $producto->categoria->categoria_id))->contains($cate->categoria_id))
                                selected
                                @elseif(collect(old('categoria_id'))->contains($cate->categoria_id))
                                selected
                            @endif
                        >{{$cate->categoria}}</option>
                    @endforeach
                </select>
                @error('categoria_id')
                <div class="alert alert-danger" id="categoria_id_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="marca_id" class="font-weight-bold">Marca</label>
                <select class="custom-select" name="marca_id" id="marca_id"
                        @error('marca_id') aria-describedby='marca_id_error' @enderror>
                    <option value="">Seleccioná la marca</option>
                    @foreach($marcas as $marca)
                        <option value="{{$marca->marca_id}}"
                                @if(!empty($producto) && collect(old('marca_id', $producto->marca->marca_id))->contains($marca->marca_id))
                                selected
                                @elseif(collect(old('marca_id'))->contains($marca->marca_id))
                                selected
                            @endif
                        >{{$marca->marca}}</option>
                    @endforeach
                </select>
                @error('marca_id')
                <div class="alert alert-danger" id="marca_id_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-12 row pr-0">
                <div class="form-group col-12 pr-0 col-md-6 pr-lg-2">
                    <label for="peso" class="font-weight-bold">Peso</label>
                    <input @if((!empty($producto) &&($producto->categoria->categoria_id != 1 &&
                    $producto->categoria->categoria_id != 5 &&
                    $producto->categoria->categoria_id != 6)) || empty($producto))
                           disabled
                           @endif

                           type="number" name="peso" id="peso" class="form-control"
                           placeholder="Ingrese el peso del producto" @error('peso') aria-describedby='peso_error'
                           @enderror
                           value="{{!empty($producto) ? old('peso', $producto->peso) : old('peso')}}">
                    @error('peso')
                    <div class="alert alert-danger" id="peso_error" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="form-group col-12 pr-0 col-md-6 pl-lg-4">
                    <label for="unidad_id" class="font-weight-bold">Unidad de peso</label>
                    <select @if((!empty($producto) && !$producto->peso) || empty($producto))
                            disabled
                            @endif

                            class="custom-select" name="unidad_id" id="unidad_id"
                            @error('unidad_id') aria-describedby='unidad_id_error' @enderror>
                        <option value="">Seleccioná la unidad del peso</option>
                            @foreach($unidades as $unidad)
                                <option value="{{$unidad->unidad_id}}"
                                        @if(!empty($producto) && $producto->unidad && collect(old('unidad_id', $producto->unidad->unidad_id))->contains($unidad->unidad_id))
                                        selected
                                        @elseif(collect(old('unidad_id'))->contains($unidad->unidad_id))
                                        selected
                                    @endif
                                >{{$unidad->unidad}}</option>
                            @endforeach
                    </select>
                    @error('unidad_id')
                    <div class="alert alert-danger" id="unidad_id_error" role="alert">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="rango_peso" class="font-weight-bold">Rango de peso</label>
                <input @if((!empty($producto) &&
                        ($producto->categoria->categoria_id != 2 && $producto->categoria->categoria_id != 3)) || empty($producto))
                       disabled
                       @endif

                       type="text" name="rango_peso" id="rango_peso" class="form-control"
                       placeholder="Ingrese el rango de peso. Ej.: 0-4 "
                       @error('rango_peso') aria-describedby='rango_peso_error' @enderror
                       value="{{!empty($producto) ? old('rango_peso', $producto->rango_peso) : old('rango_peso')}}">
                @error('rango_peso')
                <div class="alert alert-danger" id="rango_peso_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="edad_id" class="font-weight-bold">Edad</label>
                <select @if((!empty($producto) && $producto->categoria->categoria_id != 1) || empty($producto))
                        disabled
                        @endif

                        class="custom-select" name="edad_id" id="edad_id"
                        @error('edad_id') aria-describedby='edad_id_error' @enderror>
                    <option value="">Seleccioná la edad</option>
                        @foreach($edades as $edad)
                            <option value="{{$edad->edad_id}}"
                                    @if(!empty($producto) && $producto->edad && collect(old('edad_id', $producto->edad->edad_id))->contains($edad->edad_id))
                                    selected
                                    @elseif(collect(old('edad_id'))->contains($edad->edad_id))
                                    selected
                                @endif
                            >{{$edad->edad}}</option>
                        @endforeach
                </select>
                @error('edad_id')
                <div class="alert alert-danger" id="edad_id_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="form-group col-12 col-lg-6">
                <label for="tipoAlimento_id" class="font-weight-bold">Tipo de alimento</label>
                <select
                    @if((!empty($producto) && $producto->categoria->categoria_id != 1) || empty($producto))
                    disabled
                    @endif
                    class="custom-select" name="tipoAlimento_id" id="tipoAlimento_id"
                    @error('tipoAlimento_id') aria-describedby='tipoAlimento_id_error' @enderror>
                    <option value="">Seleccioná la edad</option>
                        @foreach($tipoAlimentos as $tipo)
                            <option value="{{$tipo->tipoAlimento_id}}"
                                    @if(!empty($producto) && $producto->tipoAlimento && collect(old('tipoAlimento_id', $producto->tipoAlimento->tipoAlimento_id))->contains($tipo->tipoAlimento_id))
                                    selected
                                    @elseif(collect(old('tipoAlimento_id'))->contains($tipo->tipoAlimento_id))
                                    selected
                                @endif
                            >{{$tipo->tipo}}</option>
                        @endforeach
                </select>
                @error('tipoAlimento_id')
                <div class="alert alert-danger" id="tipoAlimento_id_error" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="w-100 d-none d-lg-block"></div>
            <button type="submit" class="d-block btn michired michiyellow mt-5  mr-auto ml-auto">{{$accion}}</button>
        </form>
    </section>

@endsection
