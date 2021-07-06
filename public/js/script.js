var d = document, c = console.log, inputPeso, inputRango, selectUnidad, selectEdad, selectTipoAlimento;

inputPeso = d.querySelector('input[name="peso"]');
inputRango = d.querySelector('input[name="rango_peso"]');
selectUnidad = d.querySelector('select[name="unidad_id"]');
selectEdad = d.querySelector('select[name="edad_id"]');
selectTipoAlimento = d.querySelector('select[name="tipoAlimento_id"]');


function Habilitar(name, value) {
    if (value == '1') {
        selectEdad.disabled = false;
        selectTipoAlimento.disabled = false;
    } else {
        selectEdad.disabled = true;
        selectTipoAlimento.disabled = true;
    }

    if (value == '1' || value == '5' || value == '6') {
        inputPeso.disabled = false;
        selectUnidad.disabled = false;
    } else {
        inputPeso.disabled = true;
        selectUnidad.disabled = true;
    }

    if (value == '2' || value == '3') {
        inputRango.disabled = false;
    } else {
        inputRango.disabled = true;
    }
}

$(document).ready(function () {
    $('.promos').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 4500,
        arrows: false,
        pauseOnHover: true,
        responsive: [
            {
                breakpoint: 768,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 2000,
                settings: "unslick"
            }
        ]
    });

});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.img_upload')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

$("#checkDatos").on("submit", function (ev) {
    ev.preventDefault();

    const ubicacion_id = $(this).find("[name=ubicacion_id]").val();
    const calle = $(this).find("[name=calle]").val();
    const altura = $(this).find("[name=altura]").val();
    const piso = $(this).find("[name=piso]").val();
    const depto = $(this).find("[name=depto]").val();
    const token = $(this).find("[name=_token]").val();
    const btn = $(this).find("button.btn");
    const divisor = $(this).find(".divisor");
    const mlbutton = $(this).find("[class=mercadopago-button]");

    const data = {
        "ubicacion_id": ubicacion_id,
        "calle": calle,
        "altura": altura,
        "piso": piso,
        "depto": depto,
        "_token": token
    }

    $.ajax({
        method: "post",
        url: $(this).attr('action'),
        "data": data,
        "success": function (data) {
            if (data.validacion) {
                btn.text('Modificar')
                divisor.removeClass('d-none');
                divisor.addClass('d-block');
                mlbutton.show();
                mlbutton.addClass(['ml-auto', 'mr-auto']);
                $("div[id*='_error']").removeClass('d-block');
                $("div[id*='_error']").addClass('d-none');
                $("input").removeAttr('aria-describedby')
            }
        },
        "statusCode": {
            422: function (data) {
                const errors = $.parseJSON(data.responseText);
                $.each(errors.errors, function (campo, error) {
                    $("[name=" + campo + "]").attr('aria-describedby', campo + "_error");
                    $("#" + campo + "_error").removeClass('d-none');
                    $("#" + campo + "_error").addClass('d-block');
                    $("#" + campo + "_error").text(error);
                });
            }
        }
    })
})

$(".agregarProducto").on("submit", function (ev) {
    ev.preventDefault();

    const msj_gral = $('#msj-gral');
    const token = $(this).find("[name=_token]").val();
    var urlBase = $(this).attr('action').split('carrito/')[0];
    var data = {
        "_token": token
    }

    if ($(this).find("[name=cantidad]").length) {
        const cantidad = $(this).find("[name=cantidad]").val();
        data = {
            "_token": token,
            "cantidad": cantidad
        }
    }

    console.log(urlBase);

    $.ajax({
        method: "post",
        url: $(this).attr('action'),
        "data": data,
        "success": function (data) {
            console.log(data);
            msj_gral.removeClass('d-none');
            msj_gral.addClass('d-block');
            msj_gral.addClass('alert-success');
            msj_gral.html(msj_gral.html() + data.msj);
            const item = data.item;

            if ($("#item-" + item.item_id).length) {
                $("#item-" + item.item_id).html(item.producto.nombre + " <span class='font-weight-bold'>$" + item.subtotal + "</span>");
            } else {
                if (parseInt($(".badge.badge-light").text()) == 0) {
                    $('#listado-header').children().remove()
                    $('#listado-header').append(`
                        <li class='dropdown-item text-center text-lg-left' id='item-` + item.item_id + `'>
                        ` + item.producto.nombre + ` <span class='font-weight-bold'>$` + item.subtotal + `</span>
                        </li>
                        <li class="dropdown-item font-weight-bold mt-2 text-center text-lg-left total">
                        Total: $` + data.total +
                        `</li>
                        <li class="dropdown-divider"></li>
                        <li class="dropdown-item mt-2 text-center text-lg-left">
                            <a class="text-dark font-weight-bold" href="` + urlBase + `carrito">Ver más</a>
                        </li>
                        <li class="dropdown-item mt-2 text-center text-lg-left">
                            <a class="text-dark font-weight-bold " href="` + urlBase + `pedidos/nuevo">Finalizar
                                compra</a>
                        </li>
                    `);
                    $(".badge.badge-light").text(1)
                } else {
                    $(".total").before("<li class='dropdown-item text-center text-lg-left' id='item-" + item.item_id + "'>" + item.producto.nombre + " <span class='font-weight-bold'>$" + item.subtotal + "</span></li>");
                    const cantidad_carrito = parseInt($(".badge.badge-light").text()) + 1;
                    $(".badge.badge-light").text(cantidad_carrito)
                }
            }
            $(".total").text("Total: $" + data.total)

            $("div[id*='_error']").removeClass('d-block');
            $("div[id*='_error']").addClass('d-none');
            $("[name='cantidad']").removeAttr('aria-describedby')
        },
        "statusCode": {
            422: function (data) {
                const errors = $.parseJSON(data.responseText);
                $.each(errors.errors, function (campo, error) {
                    $("[name=" + campo + "]").attr('aria-describedby', campo + "_error");
                    $("#" + campo + "_error").removeClass('d-none');
                    $("#" + campo + "_error").addClass('d-block');
                    $("#" + campo + "_error").text(error);
                });
            }
        }
    })
})

$(".actualizarTotal").on("submit", function (ev) {
    ev.preventDefault();

    const token = $(this).find("[name=_token]").val();
    const cantidad = $(this).find("[name=cantidad]").val();
    const inputCantidad = $(this).find("[name=cantidad]");
    const error = $(this).find(".cantidad_error");
    const idError = $(this).find(".cantidad_error").attr('id');
    const subtotal = $(this).parent().next(".subtotal");
    const msj_gral = $('#msj-gral');

    const data = {
        "_token": token,
        "cantidad": cantidad
    }

    $.ajax({
        method: "put",
        url: $(this).attr('action'),
        "data": data,
        "success": function (data) {
            console.log(data);
            msj_gral.removeClass('d-none');
            msj_gral.addClass('d-block');
            msj_gral.addClass('alert-success');
            msj_gral.html(msj_gral.html() + data.msj);
            const item = data.item;

            if ($("#item-" + item.item_id).length) {
                $("#item-" + item.item_id).html(item.producto.nombre + " <span class='font-weight-bold'>$" + item.subtotal + "</span>");
            } else {
                $(".total").before("<li class='dropdown-item text-center text-lg-left' id='item-" + item.item_id + "'>" + item.producto.nombre + " <span class='font-weight-bold'>$" + item.subtotal + "</span></li>");
                const cantidad_carrito = parseInt($(".badge.badge-light").text()) + 1;
                $(".badge.badge-light").text(cantidad_carrito)
            }
            $(".total").text("Total: $" + data.total)

            subtotal.text("Subtotal: $" + item.subtotal)

            error.removeClass('d-block');
            error.addClass('d-none');
            inputCantidad.removeAttr('aria-describedby')
        },
        "statusCode": {
            422: function (data) {
                const errors = $.parseJSON(data.responseText);
                $.each(errors.errors, function (campo, msj) {
                    inputCantidad.attr('aria-describedby', idError);
                    error.removeClass('d-none');
                    error.addClass('d-block');
                    error.text(msj);
                });
            }
        }
    })
})

$(".elimiarItem").on("submit", function (ev) {
    ev.preventDefault();

    const token = $(this).find("[name=_token]").val();
    const item = $(this).parent();
    const msj_gral = $('#msj-gral');

    const data = {
        "_token": token
    }

    $.ajax({
        method: "delete",
        url: $(this).attr('action'),
        "data": data,
        "success": function (data) {

            if (data.success) {
                msj_gral.removeClass('d-none');
                msj_gral.addClass('d-block');
                msj_gral.addClass('alert-success');
                msj_gral.html(msj_gral.html() + data.msj);
                const item = data.item;

                $("#item-" + item.item_id).remove();
                $("#itemCarrrito-" + item.item_id).remove();
                const cantidad_carrito = parseInt($(".badge.badge-light").text()) - 1;
                $(".badge.badge-light").text(cantidad_carrito);
                $(".total").text("Total: $" + data.total);

                if (data.total == 0) {
                    $('#listado-completo').remove();
                    $('#carrito').addClass('d-flex');
                    $('#carrito').addClass('justify-content-center');
                    $('#carrito').append('<p id="carrito-vacio" class="mt-5 mb-5 font-weight-bold text-center align-self-center">No hay productos en el carrito</p>');

                    $('#listado-header').children().remove()
                    $('#listado-header').append('<li class="dropdown-item text-center text-lg-left">No hay productos en tu carrito</li>')
                }

            } else {
                msj_gral.removeClass('d-none');
                msj_gral.addClass('d-block');
                msj_gral.addClass('alert-danger');
                msj_gral.html(msj_gral.html() + data.msj);
            }
        }
    })
})

$("#vaciarCarrito").on("submit", function (ev) {
    ev.preventDefault();

    const token = $(this).find("[name=_token]").val();
    const msj_gral = $('#msj-gral');

    const data = {
        "_token": token
    }

    $.ajax({
        method: "delete",
        url: $(this).attr('action'),
        "data": data,
        "success": function (data) {
            msj_gral.removeClass('d-none');
            msj_gral.addClass('d-block');
            msj_gral.addClass('alert-success');
            msj_gral.html(msj_gral.html() + data.msj);

            $('#listado-completo').remove();
            $('#carrito').addClass('d-flex');
            $('#carrito').addClass('justify-content-center');
            $('#carrito').append('<p id="carrito-vacio" class="mt-5 mb-5 font-weight-bold text-center align-self-center">No hay productos en el carrito</p>');

            $('#listado-header').children().remove()
            $('#listado-header').append('<li class="dropdown-item text-center text-lg-left">No hay productos en tu carrito</li>')
            $(".badge.badge-light").text(0);
        }
    })
})
