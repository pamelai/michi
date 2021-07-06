<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\EstadoPedido
 *
 * @property int $estado_id
 * @property string $estado
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido whereEstadoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\EstadoPedido whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class EstadoPedido extends Model
{
    protected $table = "estadoPedido";
    protected $primaryKey = "estado_id";
}
