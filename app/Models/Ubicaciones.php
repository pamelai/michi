<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Ubicaciones
 *
 * @property int $ubicacion_id
 * @property string $provincia
 * @property string $partido
 * @property string $localidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones whereLocalidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones wherePartido($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones whereProvincia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones whereUbicacionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Ubicaciones whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Ubicaciones extends Model
{
    protected $table = 'ubicaciones';
    protected $primaryKey = 'ubicacion_id';
}
