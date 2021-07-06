<?php
/** @var \App\Models\Producto[]|\Illuminate\Database\Eloquent\Collection $promos */
?>

@extends('layout.index')

@section('title', 'Home | Michi')

@section('main')

    <div id="banner" class="position-relative">
        <p class="position-absolute">Lo mejor <span class="d-block">para nuestros <span
                    class="d-inline-block pr-2 pl-2 michired">michis</span></span></p>

        <div class="position-absolute onda"></div>
    </div>
    <div id="home" class="container text-center mt-4 mb-4 ">
        <section>
            <h2 class="mb-3 mt-4">Sobre nosotros</h2>

            <div class="row justify-content-center text-lg-left align-items-center">

                <div class="col-lg-5 mr-4 position-relative"><div class="position-absolute"></div></div>

                <div class=" col-12 col-lg-6">
                    <p>En Michi sabemos lo importante que es tu mascota para vos. Vive, duerme, juega y
                        camina a tu lado. Tu
                        mejor compañía te acepta tal cual sos y, a cambio, te ofrece todo su amor e incondicionalidad.
                        Tu
                        única
                        responsabilidad es cuidarla y quererla. Porque amamos a los animales tanto como vos, ponemos a
                        tu
                        alcance todo lo que tu amigo peludo necesita, haciéndote ahorrar tiempo para que compartas con
                        él lo
                        que
                        más le gusta: tu compañía.
                    </p>
                    <p>Desde michi.com entregamos cada semana cientos de productos a hogares. Llevamos
                        hasta tu puerta todo
                        para
                        tu mascota: alimentos balanceados, accesorios, golosinas, juguetes y mucho más, siendo el pet
                        shop
                        online más completo del país.
                    </p>
                </div>
            </div>
        </section>
        <section>
            <h2 class="mb-4 mt-4">Promos del mes</h2>
            <p>Aprovechá los precios increíbles, los combos y los regalos que tenemos este mes.</p>
            <p class="text-muted">Los precios promocionales de estos productos NO SON ACUMULABLES con otros
                beneficios.<br>
                Promociones válidas desde el 01/06/2020 al 30/06/2020 inclusive.
            </p>
            <ul class="row justify-content-between justify-content-xl-center promos">
                @foreach($promos as $promo)
                    <li class="col-lg-4 row justify-content-center">
                        <div
                            class="p-3 m-3 col-7 col-md-9 col-lg-11 col-xl-9 producto row justify-content-center mr-auto ml-auto">
                            <a href="{{ route('producto.ver', ['id' => $promo->producto_id]) }}"
                               class="position-relative mb-2">
                                <div class="position-absolute"></div>
                                <div class="position-relative col-12 p-2">
                                    <img src="img/productos/{{$promo->img}}" alt="{{$promo->nombre}}" class="img-fluid">
                                    <i class="fas fa-search-plus position-absolute"></i>

                                    <p class="mb-0 mt-2">{{$promo->nombre}}</p>
                                </div>
                            </a>

                            <p class=" col-12">$ {{$promo->precio}}</p>

                            @guest
                                <a class="btn michired michiyellow font-weight-bold align-self-end col-12 d-inline-block"
                                   href="{{route('registro')}}">Añadir <span class="sr-only">al carrito</span> <i
                                        class="fas fa-cart-plus"></i></a>

                            @else
                                <form
                                    action="{{route('item.agregar', ['id' => $promo->producto_id, 'user' => Auth::id()])}}"
                                    method="post" class="col-12 row align-items-center p-0 agregarProducto">
                                    @csrf

                                    <button type="submit"
                                            class="btn michired michiyellow font-weight-bold align-self-end col-12 mt-3">
                                        Añadir
                                        <span
                                            class="sr-only">al carrito</span> <i class="fas fa-cart-plus"></i>
                                    </button>
                                </form>
                            @endguest
                        </div>
                    </li>
                @endforeach
            </ul>

        </section>

        <section>
            <h2 class="mb-4 mt-4">Contacto</h2>

            <div class="row justify-content-center">
                <div class="col-12 pb-2 text-center">
                    <p>Nuestra prioridad es la satisfacción de nuestros clientes, por eso trabajamos a diario para
                        ofrecerte
                        la
                        mejor atención personalizada. Comprá fácil y al mejor precio. <br>
                        ¡Hacé tu pedido en Michi!
                    </p>
                    <ul class="mt-5 mb-5 row justify-content-center">
                        <li class="col col-lg-3">
                            <i class="fas fa-phone-alt d-block mb-4"></i>
                            <span class="sr-only">Teléfono</span>
                            0810-888-7387 (PETS)
                        </li>
                        <li class="col col-lg-3">
                            <i class="fas fa-mobile-alt d-block mb-4"></i>
                            <span class="sr-only">Celular</span>
                            11-5914-9784
                        </li>
                        <li class="col col-lg-3">
                            <i class="fas fa-envelope d-block mb-4"></i>
                            <span class="sr-only">Email</span>
                            ventas@michi.com
                        </li>
                    </ul>
                    <ul>
                        <li><span>Horario de atención:</span> Lunes a Sábados de 9 a 20 hs. y feriados de 9 a 18hs.</li>
                        <li><span>Horario de venta online:</span> Todos los días, 24hs. los 365 días del año.</li>
                    </ul>
                </div>

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3282.477779635007!2d-58.65863908519383!3d-34.642634967064495!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcbf4f685ebaf5%3A0x10e0b5b16f996ab4!2sAdipfa%20Sa!5e0!3m2!1ses-419!2sar!4v1589070281089!5m2!1ses-419!2sar"
                    width="1000" height="350" style="border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0" class="pr-3 pl-3"></iframe>
            </div>
        </section>
    </div>

@endsection
