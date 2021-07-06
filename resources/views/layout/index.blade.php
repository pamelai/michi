<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{url('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('css/styles.css')}}">
    <link href="{{url('img/favicon.ico')}}" rel="icon" type="image/ico"/>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-michired">
    <h1 class="navbar-brand p-0 m-0" id="logo"><a href="@guest {{route('home')}}  @else {{route('panel')}} @endguest"
                                                  class="d-block">Michi</a></h1>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end mt-2 mt-lg-0" id="navbarNav">
        <ul class="navbar-nav text-center">
            <li class="nav-item {{ request()->getPathInfo() == '/' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item {{ request()->getPathInfo() == '/productos' ? 'active' : '' }}">
                <a class="nav-link" href="{{route('productos')}}">Productos</a>
            </li>
            @guest

                <li class="nav-item {{ request()->getPathInfo() == '/login' ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('auth.login')}}">Iniciar Sesión</a>
                </li>

                <li class="nav-item {{ request()->getPathInfo() == '/registro' ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('registro')}}">Registrarse</a>
                </li>

            @else
                @if(Auth::user()->tipo_id == 1)
                    <li class="nav-item {{ request()->getPathInfo() == '/panel' ? 'active' : '' }}">
                        <a class="nav-link" href="{{route('panel')}}">Panel</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            Estadísticas
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li class="dropdown-item text-center text-lg-left">
                                <a class="text-dark " href="{{route('panel.top-productos-todos')}}">Productos vendidos</a>
                            </li>
                            <li class="dropdown-item text-center text-lg-left">
                                <a class="text-dark " href="{{route('panel.pedidos-zona-todos')}}">Pedidos por zona</a>
                            </li>
                            <li class="dropdown-item text-center text-lg-left">
                                <a class="text-dark " href="{{route('panel.pedidos-entregados-anulados-todos')}}">Pedidos
                                    entregados y anulados</a>
                            </li>
                            <li class="dropdown-item text-center text-lg-left">
                                <a class="text-dark " href="{{route('panel.top-pedidos-meses', ["anio"=>date("Y")])}}">Pedidos entregados por mes</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button"
                       aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Carrito</span>
                        <i class="fas fa-shopping-cart"></i>
                        <span class="badge badge-light">{{count(Auth::user()->carrito)}}</span></a>
                    <ul class="dropdown-menu dropdown-menu-right" id="listado-header">
                        @if(count(Auth::user()->carrito))
                            <?php
                            $total = 0;
                            ?>
                            @foreach(Auth::user()->carrito as $items)
                                <?php
                                $total += (double)($items->subtotal);
                                ?>
                                <li class="dropdown-item text-center text-lg-left"
                                    id="item-{{$items->item_id}}">{{$items->producto->nombre}}
                                    <span class="font-weight-bold">${{$items->subtotal}}</span>
                                </li>
                            @endforeach
                            <li class="dropdown-item font-weight-bold mt-2 text-center text-lg-left total">Total:
                                ${{$total}}</li>
                            <li class="dropdown-divider"></li>
                            <li class="dropdown-item mt-2 text-center text-lg-left">
                                <a class="text-dark font-weight-bold" href="{{route('carrito')}}">Ver más</a>
                            </li>
                            <li class="dropdown-item mt-2 text-center text-lg-left">
                                <a class="text-dark font-weight-bold " href="{{route('pedidos.nuevo')}}">Finalizar
                                    compra</a>
                            </li>
                        @else
                            <li class="dropdown-item text-center text-lg-left">No hay productos en tu carrito</li>
                        @endif

                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                       aria-expanded="false">
                        <span class="sr-only">Menu usuario</span>
                        <i class="fas fa-user"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item text-center text-lg-left">
                            <a class="text-dark " href="{{route('perfil')}}">Perfil</a>
                        </li>
                        <li class="dropdown-item text-center text-lg-left">
                            <a class="text-dark " href="{{route('pedidos')}}">Pedidos</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item mt-2 text-center text-lg-left">
                            <a class="text-dark font-weight-bold" href="{{route('auth.logout')}}">Cerrar sesión
                                <i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </li>
            @endguest
        </ul>
    </div>
</nav>
<main>
    <?php
    if (Session::has('success')) {
        $display = 'alert-success d-block';
        $msj = Session::get('success');

    } elseif (Session::has('error')) {
        $display = 'alert-danger d-block';
        $msj = Session::get('error');
    } else {
        $display = 'd-none';
        $msj = '';
    }
    ?>
    <div class="alert alert-dismissible fade show position-fixed {{$display}}" role="alert" id="msj-gral">
        {{ $msj }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>


    @yield('main')
</main>
<footer class="bg-michired p-4">
    <ul class="row justify-content-center mb-4">
        <li class="col-auto "><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
        <li class="col-auto "><a href="https://twitter.com/" target="_blank">Twitter</a></li>
        <li class="col-auto "><a href="https://www.instagram.com/" target="_blank">Instagram</a></li>
    </ul>
    <ul class="row mb-0 text-center">
        <li class="mb-2 col-12">Copyright Pamela Iglesias</li>
        <li class="p-0 col-12">Diseño Web - TN - Aplicaciones Enriquecidas</li>
    </ul>
</footer>


<script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
<script src="{{url('js/bootstrap.bundle.min.js')}}"></script>
<script src="https://kit.fontawesome.com/751d438c2a.js" crossorigin="anonymous"></script>
<script src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{url('js/funciones.js')}}"></script>
<script src="https://www.gstatic.com/charts/loader.js"></script>
@yield('charts')
</body>
</html>
