<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TipoAlimento
 *
 * @property int $tipoAlimento_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $tipo
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoAlimento whereTipoAlimentoId($value)
 */
class TipoAlimento extends Model
{
    protected $table = 'tipoAlimentos';
    protected $primaryKey = 'tipoAlimento_id';
}
