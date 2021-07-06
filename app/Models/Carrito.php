<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Carrito
 *
 * @property int $carrito_id
 * @property int $item_id
 * @property int $usuario_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito whereCarritoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito whereItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Carrito whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Carrito extends Model
{
    protected $table = "carrito";
    protected $primaryKey = "carrito_id";

    protected $fillable = ['item_id', 'usuario_id'];
}
