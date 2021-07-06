<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Peso
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Peso newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Peso newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Peso query()
 * @mixin \Eloquent
 */
class Peso extends Model
{
    protected $table = 'peso_producto';
    protected $primaryKey = 'peso_id';
}
