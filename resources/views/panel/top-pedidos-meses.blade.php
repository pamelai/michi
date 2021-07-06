<?php
/** @var \App\Models\Pedidos[]|\Illuminate\Database\Eloquent\Collection $pedidos */

$meses = [1 => "Ene", 2 => "Feb", 3 => "Mar", 4 => "Abr", 5 => "May", 6 => "Jun", 7 => "Jul", 8 => "Ago", 9 => "Sep", 10 => "Oct", 11 => "Nov", 12 => "Dic"];

?>
@extends('layout.index')

@section('title', "Pedidos entregados por mes | Michi")

@section('main')

    <section class="container mt-4 mb-4 estaditicas">
        <div class="row justify-content-center">
            <a class="d-block col-12 mb-4 volver" href="{{route('panel')}}"><i
                    class="fas fa-long-arrow-alt-left"></i> Volver</a>

            <h2 class="text-center col-12">Pedidos entregados por mes</h2>


            <p class="col-auto font-weight-bold mt-4">Año</p>
            <div class="dropdown col-4 col-md-3 col-lg-2 p-0 mt-4">
                <a data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                   aria-expanded="false" class="d-block text-center pb-2 font-weight-bold filtro">
                    {{$pedidos["año_consultado"]}}
                </a>
                <ul class="dropdown-menu">
                    @foreach($pedidos["años_disponibles"] as $año)
                        @if($año != $pedidos["año_consultado"])
                            <li class="dropdown-item text-center">
                                <a class="text-dark d-block" href="{{route('panel.top-pedidos-meses', ["anio"=>$año])}}">{{$año}}</a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>


            <div id="pedidos-fechas"></div>
        </div>
    </section>

@endsection
@section('charts')
    <script type="text/javascript">
        google.charts.load('current', {packages: ['corechart', 'bar']});
        google.charts.setOnLoadCallback(drawBasic);

        function drawBasic() {

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Meses');
            data.addColumn('number', 'Pedidos');
            data.addColumn({role: 'style'});

            data.addRows([
                    @foreach($meses as $nro => $nombre)
                    @foreach($pedidos["pedidos"] as $pedido)
                    @if($pedido->mes == $nro)
                    <?php $cantidad = $pedido->cantidad?>
                    @break
                    @else
                    <?php $cantidad = 0?>
                    @endif
                    @endforeach
                ["{{$nombre}}", {{$cantidad ?? 0}}, '#E02D3C'],
                @endforeach
            ]);

            var options = {
                vAxis: {
                    title: 'Cantidad de pedidos',
                },
                bar: {
                    groupWidth: '70%'
                },
                tooltip: {
                    text: 'value',
                    textStyle: {
                        fontSize: 18
                    }
                },
                height: 450,
                legend: {
                    position: 'none'
                }
            };

            var chart = new google.visualization.ColumnChart(
                document.getElementById('pedidos-fechas'));

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
