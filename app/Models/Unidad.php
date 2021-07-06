<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Unidad
 *
 * @property int $unidad_id
 * @property string $unidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad whereUnidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad whereUnidadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Unidad whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Unidad extends Model
{
    protected $table = 'unidades';
    protected $primaryKey = 'unidad_id';
}
