<?php

namespace App\Models;

use App\Models\Ubicaciones;
use App\Models\TiposTarjetas;
use App\Models\EstadoPedido;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Pedidos
 *
 * @property int $pedido_id
 * @property float $precio
 * @property string $calle
 * @property int $altura
 * @property int|null $piso
 * @property string|null $depto
 * @property string $fecha
 * @property int $payment_id
 * @property int $ubicacion_id
 * @property int $usuario_id
 * @property int $estado_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\EstadoPedido $estado
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PedidosItems[] $pedidoItems
 * @property-read int|null $pedido_items_count
 * @property-read \App\Models\Ubicaciones $ubicacion
 * @property-read \App\Models\Usuario $usuario
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereAltura($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereCalle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereDepto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereFecha($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos wherePedidoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos wherePiso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereUbicacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Pedidos whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Pedidos extends Model
{
    protected $table = "pedidos";
    protected $primaryKey = "pedido_id";

    protected $fillable = ['precio', 'payment_id', 'calle', 'altura', 'piso', 'depto', 'ubicacion_id', 'usuario_id', 'estado_id', "fecha"];

    public static $rules = [
        'calle' => 'required|min:5',
        'altura' => 'required|numeric',
        'piso' => 'nullable|numeric',
        'depto' => 'required_with:piso|nullable|min:1',
        'ubicacion_id' => 'required|integer|exists:ubicaciones',
    ];

    public static $errorMessages = [
        'calle.required' => 'La calle no puede estar vacía',
        'calle.min' => 'La calle debe de tener al menos :min caracteres',
        'altura.required' => 'La altura no puede estar vacía',
        'altura.numeric' => 'La altura no puede contener letras',
        'piso.numeric' => 'El piso no puede contener letras',
        'depto.required_with' => 'El número de departamento no puede estar vacío',
        'depto.min' => 'El número de departamento debe de tener al menos :min caracteres',
        'ubicacion_id.integer' => 'La ubicación no existe',
        'ubicacion_id.exists' => 'La ubicación no existe',
        'ubicacion_id.required' => 'La ubicación no puede estar vacía',
    ];

    public function ubicacion()
    {
        return $this->belongsTo(Ubicaciones::class, 'ubicacion_id', 'ubicacion_id');
    }

    public function estado()
    {
        return $this->belongsTo(EstadoPedido::class, 'estado_id', 'estado_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'usuario_id');
    }

    public function pedidoItems()
    {
        return $this->hasMany(PedidosItems::class, 'pedido_id', 'pedido_id');
    }

    public static function cantidadPedidosPorMes($año)
    {
        $pedidos = Pedidos::select(Pedidos::raw('MONTH(fecha) as mes'), Pedidos::raw('COUNT(fecha) as cantidad'))
            ->groupBy('mes')
            ->orderByDesc('mes')
            ->where('estado_id', '!=', 3)
            ->where('fecha', "like", "$año%")
            ->get();

        $años = Pedidos::select(Pedidos::raw('YEAR(fecha) as año'))
            ->groupBy('año')
            ->orderByDesc('año')
            ->where('estado_id', '!=', 3)
            ->pluck("año");

        return ["pedidos" => $pedidos, "año_consultado" => $año, "años_disponibles" => $años];
    }

    public static function cantidadPedidosEntregadosYAnulados($año = null, $mes = null)
    {

        if ($año && $mes) {
            $mes_consultado = "$año/$mes";
            $pedidos = Pedidos::select('estado_id' , Pedidos::raw('COUNT(estado_id) as cantidad'))
                ->groupBy('estado_id')
                ->where(function($query) {
                    $query->where('estado_id', 5)
                        ->orWhere('estado_id', 3);
                })
                ->whereYear('fecha', "$año")
                ->whereMonth('fecha', "$mes")
                ->with('estado')
                ->get();
        } else {
            $mes_consultado = "";
            $pedidos = Pedidos::select('estado_id', Pedidos::raw('COUNT(estado_id) as cantidad'))
                ->groupBy('estado_id')
                ->where('estado_id', 5)
                ->orWhere('estado_id', 3)
                ->with('estado')
                ->get();
        }


        $meses = Pedidos::select(Pedidos::raw("DATE_FORMAT(fecha, '%Y/%m') meses"))
            ->groupBy('meses')
            ->orderByDesc('meses')
            ->where('estado_id', 5)
            ->orWhere('estado_id', 3)
            ->pluck("meses");

        return ["pedidos" => $pedidos, "mes_consultado" => $mes_consultado, "meses_disponibles" => $meses];
    }

    public static function cantidadPedidosPorZona($año = null, $mes = null)
    {

        if ($año && $mes) {
            $mes_consultado = "$año/$mes";
            $pedidos = Pedidos::select('ubicacion_id', Pedidos::raw('COUNT(ubicacion_id) as cantidad'))
                ->groupBy('ubicacion_id')
                ->orderByDesc('cantidad')
                ->where('estado_id', '!=', 3)
                ->whereYear('fecha', "$año")
                ->whereMonth('fecha', "$mes")
                ->with('ubicacion')
                ->get();
        } else {
            $mes_consultado = "";
            $pedidos = Pedidos::select('ubicacion_id', Pedidos::raw('COUNT(ubicacion_id) as cantidad'))
                ->groupBy('ubicacion_id')
                ->orderByDesc('cantidad')
                ->where('estado_id', '!=', 3)
                ->with('ubicacion')
                ->get();
        }


        $meses = Pedidos::select(Pedidos::raw("DATE_FORMAT(fecha, '%Y/%m') meses"))
            ->groupBy('meses')
            ->orderByDesc('meses')
            ->where('estado_id', '!=', 3)
            ->pluck("meses");

        return ["pedidos" => $pedidos, "mes_consultado" => $mes_consultado, "meses_disponibles" => $meses];
    }
}
