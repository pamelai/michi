<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TipoUser
 *
 * @property int $tipo_id
 * @property string $tipo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser whereTipoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TipoUser whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TipoUser extends Model
{
    protected $table = 'tipoUsuarios';
    protected $primaryKey = 'tipo_id';
    public static $TIPO_ADMIN = 1;
}
