<?php
/** @var \App\Models\Producto[]|\Illuminate\Database\Eloquent\Collection $productos */

?>


@extends('layout.index')

@section('title', "Productos más vendidos | Michi")

@section('main')
    <section class="container mt-4 mb-4 estaditicas">
        <div class="row justify-content-center">
            <a class="d-block col-12 mb-4 volver" href="{{route('panel')}}"><i
                    class="fas fa-long-arrow-alt-left"></i> Volver</a>

            <h2 class="text-center col-12">Productos más vendidos</h2>

            <p class="col-auto font-weight-bold mt-4">Mes</p>
            <div class="dropdown col-4 col-md-3 col-lg-2 p-0 mt-4">
                <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false" class="d-block text-center pb-2 font-weight-bold filtro">
                    {{empty($productos["fecha_consultada"]) ? "Todos" : $productos["fecha_consultada"]}}
                </a>
                <ul class="dropdown-menu">
                    @if(!empty($productos["fecha_consultada"]))
                        <li class="dropdown-item text-center">
                            <a class="text-dark d-block" href="{{route('panel.top-productos-todos')}}">Todos</a>
                        </li>
                    @endif
                    @foreach($productos["fechas_disponibles"] as $mes)
                        @if($mes != $productos["fecha_consultada"])
                            <li class="dropdown-item text-center">
                                <a class="text-dark d-block" href="{{route('panel.top-productos', ["anio"=>explode("/",$mes)[0], "mes"=>explode("/",$mes)[1]])}}">{{$mes}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div id="topProductos"></div>
        </div>
    </section>


@endsection
@section('charts')
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Nombre', 'Cantidad'],
                    @foreach($productos['pedidosItems'] as $prod)
                ['{{$prod->producto->nombre}}', {{$prod->cantidad_total}}],
                @endforeach
            ]);

            var options = {
                backgroundColor: {fill: 'transparent'},
                height: 450,
                tooltip:{
                    text: 'value',
                    textStyle:{
                        fontSize: 18
                    }
                }
            };

            var chart = new google.visualization.PieChart(document.getElementById('topProductos'));

            chart.draw(data, options);

            function resizeHandler() {
                chart.draw(data, options);
            }

            if (window.addEventListener) {
                window.addEventListener('resize', resizeHandler, false);
            } else if (window.attachEvent) {
                window.attachEvent('onresize', resizeHandler);
            }
        }


    </script>
@endsection
