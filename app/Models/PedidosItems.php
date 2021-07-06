<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PedidosItems
 *
 * @property int $item_id
 * @property int $producto_id
 * @property int $cantidad
 * @property float $precio
 * @property int $pedido_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Pedidos $pedido
 * @property-read \App\Models\Producto $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems wherePedidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\PedidosItems whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PedidosItems extends Model
{
    protected $table = "pedidosItems";
    protected $primaryKey = "item_id";

    protected $fillable = ['producto_id', 'cantidad', 'precio', 'pedido_id'];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }

    public function pedido(){
        return $this->belongsTo(Pedidos::class, 'pedido_id', 'pedido_id');
    }

    public static function cantidadTopProductosPedidos($año = null, $mes = null){

        if ($año && $mes) {
            $fecha_consultada = "$año/$mes";
            $pedidosItems = PedidosItems::select('producto_id', PedidosItems::raw('SUM(cantidad) as cantidad_total'))
                ->join('pedidos', 'pedidosItems.pedido_id', '=', 'pedidos.pedido_id')
                ->where('estado_id', '!=', '3')
                ->whereYear('fecha', "$año")
                ->whereMonth('fecha', "$mes")
                ->groupBy('producto_id')
                ->orderByDesc('cantidad_total')
                ->with('producto')
                ->get();
        }else{
            $fecha_consultada='';
            $pedidosItems = PedidosItems::select('producto_id', PedidosItems::raw('SUM(cantidad) as cantidad_total'))
                ->join('pedidos', 'pedidosItems.pedido_id', '=', 'pedidos.pedido_id')
                ->where('estado_id', '!=', '3')
                ->groupBy('producto_id')
                ->orderByDesc('cantidad_total')
                ->with('producto')
                ->get();
        }

        $fechas = Pedidos::select(Pedidos::raw("DATE_FORMAT(fecha, '%Y/%m') meses"))
            ->groupBy('meses')
            ->orderByDesc('meses')
            ->where('estado_id', '!=', 3)
            ->pluck("meses");

        return ["pedidosItems" => $pedidosItems, "fecha_consultada" => $fecha_consultada, "fechas_disponibles" => $fechas];
    }
}
