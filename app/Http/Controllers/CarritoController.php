<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    /**
     * Muestra el listado de los productos que están en el carrito
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function listado()
    {
        return view('user.carrito');
    }

    /**
     * Vacía el carrito de un usuario en específico
     *
     * @param $user_id
     * @return \Illuminate\Http\JsonResponse
     */
    function vaciar ($user_id){
        $items_ids = Carrito::where('usuario_id', $user_id)->pluck('item_id');
        CarritoItem::whereIn('item_id', $items_ids)->delete();

        return response()->json([
            'success' => 1,
            'msj' => "El carrito fue vaciado con éxito"
        ]);
    }
}
