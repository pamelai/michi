<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\EstadoPedido;
use App\Models\Pedidos;
use App\Models\Ubicaciones;
use App\Models\TiposTarjetas;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\Preference;

class PedidosController extends Controller
{
    /**
     * Arma el listado de productos para MercadoPago y envía los datos a la pantalla de checkout
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function nuevo()
    {
        $items_ids = Carrito::where('usuario_id', \Auth::id())->pluck('item_id');
        $preference = new Preference();
        $itemsArray = [];

        foreach ($items_ids as $id) {
            $carritoItem = CarritoItem::findOrFail($id);

            $item = new Item();
            $item->title = $carritoItem->producto->nombre;
            $item->quantity = $carritoItem->cantidad;
            $item->unit_price = $carritoItem->producto->precio;

            $itemsArray[] = $item;
        }

        $preference->items = $itemsArray;
        $preference->save();

        $ubicaciones = Ubicaciones::orderBy('partido', 'asc')->orderBy('localidad', 'asc')->get();

        return view('user.checkout', [
            'ubicaciones' => $ubicaciones,
            'preferencia' => $preference
        ]);
    }


    /**
     * Trae el listado de pedidos del usuario logeado
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function listado()
    {
        $pedidos = Pedidos::with('ubicacion', 'estado', 'pedidoItems')->where('usuario_id', \Auth::id())->get();

        return view('user.pedidos', ['pedidos' => $pedidos]);
    }

    /**
     * Genera un nuevo pedido dependiendo de si se efectuó el pago
     *
     * @param Request $request
     * @param int $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function alta(Request $request, $user_id)
    {
        $request->validate(Pedidos::$rules, Pedidos::$errorMessages);
        $data = $request->input();

        if (!empty($data['payment_status'])) {

            if ($data['payment_status'] == 'approved' || $data['payment_status'] == 'pending') {

                $items_ids = Carrito::where('usuario_id', $user_id)->pluck('item_id');
                $total = CarritoItem::whereIn('item_id', $items_ids)->sum('subtotal');

                if ($data['payment_status'] == 'approved')
                    $data['estado_id'] = 2;
                else
                    $data['estado_id'] = 1;

                $data['usuario_id'] = $user_id;
                $data['precio'] = $total;
                $data['fecha'] = date("Y-m-d");
                $pedido = Pedidos::create($data);

                foreach ($items_ids as $id) {
                    $carritoItem = CarritoItem::findOrFail($id);

                    $pedidoItem = [
                        'producto_id' => $carritoItem->producto_id,
                        'cantidad' => $carritoItem->cantidad,
                        'precio' => $carritoItem->subtotal
                    ];

                    $pedido->pedidoItems()->create($pedidoItem);
                }
                CarritoItem::whereIn('item_id', $items_ids)->delete();

                return redirect(url('/pedidos'))->with('success', 'Tu pedido fue realizado con éxito');
            } else {
                if ($data['payment_status_detail'] == 'cc_rejected_other_reason')
                    $msj = 'Hubo un error al procesar tu pago, intentá más tarde';
                elseif ($data['payment_status_detail'] == 'cc_rejected_insufficient_amount')
                    $msj = 'No tenés saldo suficiente, intentá con otra tarjeta';
                elseif ($data['payment_status_detail'] == 'cc_rejected_bad_filled_security_code')
                    $msj = 'El código de seguridad es inválido, intentalo nuevamente';
                elseif ($data['payment_status_detail'] == 'cc_rejected_bad_filled_date')
                    $msj = 'La fecha de vencimiento es inválida, intentalo nuevamente';
                elseif ($data['payment_status_detail'] == 'cc_rejected_bad_filled_other')
                    $msj = 'Hubo un error con los datos ingresados, intentalo nuevamente';

                return redirect('/pedidos/nuevo')
                    ->with('error', $msj)
                    ->withInput();
            }
        } else {
            return response()->json([
                'validacion' => 1
            ]);
        }

    }

    /**
     * Anula un pedido en específico
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function anular($id)
    {
        $pedido = Pedidos::findOrFail($id);

        $estado = [
            'estado_id' => 2
        ];

        $pedido->update($estado);

        return redirect(url('/pedidos'))->with('success', 'Tu pedido se anuló con éxito');
    }

    /**
     * Cambia el estado del pedido. Solo disponible para el usuario admin
     *
     * @param int $estado_id
     * @param int $pedido_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function cambiarEstado($estado_id, $pedido_id)
    {

        $pedido = Pedidos::findOrFail($pedido_id);

        $estado = [
            'estado_id' => $estado_id
        ];

        $pedido->update($estado);

        if (strpos(request()->session()->previousUrl(), 'panel') !== false)
            $url = "/panel";

        elseif (strpos(request()->session()->previousUrl(), 'pedidos/') !== false)
            $url = "/pedidos/$pedido_id";


        return redirect(url($url))->with('success', "Se actualizó el estado del pedido #$pedido_id con éxito");
    }

    /**
     * Muestra el detalle de un pedido en específico
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function ver($id)
    {
        $pedido = Pedidos::with('ubicacion', 'estado', 'pedidoItems')->findOrFail($id);
        $estados_pedidos = EstadoPedido::all();

        return view('panel.pedido', [
            'pedido' => $pedido,
            'estados_pedidos' => $estados_pedidos
        ]);

    }
}
