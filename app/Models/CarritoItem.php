<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\CarritoItem
 *
 * @property int $item_id
 * @property int $producto_id
 * @property int $cantidad
 * @property float $precio
 * @property float $subtotal
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Usuario[] $carrito
 * @property-read int|null $carrito_count
 * @property-read \App\Models\Producto $producto
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereCantidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereSubtotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\CarritoItem whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CarritoItem extends Model
{
    protected $table = "carritoItems";
    protected $primaryKey = "item_id";

    protected $fillable = ['producto_id', 'cantidad', 'precio', 'subtotal'];

    public static $rules = [
        'cantidad' => 'required|numeric|min:1'
    ];

    public static $errorMessages = [
        'cantidad.required' => 'La cantidad del producto no puede estar vacía',
        'cantidad.numeric' => 'La cantidad del producto debe de ser un número',
        'cantidad.min' => 'La cantidad del producto no puede ser menor a 1',

    ];

    public function producto(){
        return $this->belongsTo(Producto::class, 'producto_id', 'producto_id');
    }

    public function carrito()
    {
        return $this->belongsToMany(Usuario::class, 'carrito', 'item_id', 'usuario_id', 'item_id', 'usuario_id');
    }
}
