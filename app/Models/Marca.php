<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Marca
 *
 * @property int $marca_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $marca
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Marca whereMarca($value)
 */
class Marca extends Model
{
    protected $table = 'marcas';
    protected $primaryKey = 'marca_id';
}
