<?php
/** @var \App\Models\Pedidos[]|\Illuminate\Database\Eloquent\Collection $pedidos */

?>


@extends('layout.index')

@section('title', "Pedidos por zona | Michi")

@section('main')
    <section class="container mt-4 mb-4 estaditicas">
        <div class="row justify-content-center">
            <a class="d-block col-12 mb-4 volver" href="{{route('panel')}}"><i
                    class="fas fa-long-arrow-alt-left"></i> Volver</a>

            <h2 class="text-center col-12">Pedidos por zona</h2>

            <p class="col-auto font-weight-bold mt-4">Mes</p>
            <div class="dropdown col-4 col-md-3 col-lg-2 p-0 mt-4">
                <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false" class="d-block text-center pb-2 font-weight-bold filtro">
                    {{empty($pedidos["mes_consultado"]) ? "Todos" : $pedidos["mes_consultado"]}}
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    @if(!empty($pedidos["mes_consultado"]))
                        <li class="dropdown-item text-center">
                            <a class="text-dark d-block" href="{{route('panel.pedidos-zona-todos')}}">Todos</a>
                        </li>
                    @endif
                    @foreach($pedidos["meses_disponibles"] as $mes)
                        @if($mes != $pedidos["mes_consultado"])
                            <li class="dropdown-item text-center">
                                <a class="text-dark d-block" href="{{route('panel.pedidos-zona', ["anio"=>explode("/",$mes)[0], "mes"=>explode("/",$mes)[1]])}}">{{$mes}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>

            <div id="pedidos-zona"></div>
        </div>
    </section>
@endsection

@section('charts')
    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {

            var data = google.visualization.arrayToDataTable([
                ['Ubicacion', 'Cantidad'],
                    @foreach($pedidos["pedidos"] as $ped)
                ['{{$ped->ubicacion->localidad}}', {{$ped->cantidad}}],
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

            var chart = new google.visualization.PieChart(document.getElementById('pedidos-zona'));

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
