<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CarritoItemController extends Controller
{
    /**
     * Agrega los productos/items al carrito
     *
     * @param Request $request
     * @param $id
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    function agregar(Request $request, $id, $user_id)
    {
        $cant = 1;

        if (count($request->input()) > 1) {
            $request->validate(CarritoItem::$rules, CarritoItem::$errorMessages);
            $data = $request->input();

            if (!empty($data['cantidad']))
                $cant = $data['cantidad'];
        }

        $producto_precio = Producto::findOrFail($id)->precio;

        /*Comprobamos que no lo haya agregado antes*/
        $items_ids = Carrito::where('usuario_id', $user_id)->pluck('item_id');
        $item = CarritoItem::where('producto_id', $id)->whereIn('item_id', $items_ids)->first();

        if (empty($item->item_id)) {
            $item = [
                'producto_id' => $id,
                'cantidad' => $cant,
                'precio' => $producto_precio,
                'subtotal' => (double)($cant * $producto_precio)
            ];

            $carritoItem = CarritoItem::create($item);
            $carritoItem->carrito()->attach($user_id);
            $nombre = $carritoItem->producto->nombre;
            $data = $carritoItem;

        } else {
            $cantidad = [
                'cantidad' => $item->cantidad + $cant,
                'subtotal' => (double)(($item->cantidad + $cant) * $producto_precio)
            ];

            $item->update($cantidad);
            $nombre = $item->producto->nombre;
            $data = $item;
        }

        $items_ids = Carrito::where('usuario_id', $user_id)->pluck('item_id');
        $total = CarritoItem::whereIn('item_id', $items_ids)->sum('subtotal');

        return response()->json([
            'success' => 1,
            'msj' => "El producto $nombre se agregó a tu carrito",
            'item' => $data,
            'total' => $total
        ]);
    }

    /**
     * Modifica la cantidad total de un item del carrito
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function setCantidadTotal(Request $request, $id)
    {
        $request->validate(CarritoItem::$rules, CarritoItem::$errorMessages);

        $item = CarritoItem::findOrFail($id);
        $data = $request->input();
        $data['subtotal'] = $item->precio * $data['cantidad'];
        $item->update($data);

        $items_ids = Carrito::where('usuario_id', Auth::id())->pluck('item_id');
        $total = CarritoItem::whereIn('item_id', $items_ids)->sum('subtotal');

        return response()->json([
            'success' => 1,
            'msj' => "Se actualizó la cantidad del producto " . $item->producto->nombre,
            'item' => $item,
            'total' => $total
        ]);
    }

    /**
     * Elimina un item en específico
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    function eliminar($id)
    {
        $item = CarritoItem::findOrFail($id);

        if ($item->delete()){
            $items_ids = Carrito::where('usuario_id', Auth::id())->pluck('item_id');
            $total = CarritoItem::whereIn('item_id', $items_ids)->sum('subtotal');

            return response()->json([
                'success' => 1,
                'msj' => "Se el producto " . $item->producto->nombre . " se eliminó con éxito",
                'item' => $item,
                'total' => $total
            ]);
        }
        else{

            return response()->json([
                'error' => 1,
                'msj' => "Hubo un error al eliminar el producto " . $item->producto->nombre . " del carrito, inténtalo más tarde",
                'item' => $item
            ]);

        }
    }
}
