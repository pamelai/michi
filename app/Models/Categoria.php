<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Categoria
 *
 * @property int $categoria_id
 * @property string $nombre
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $categoria
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Categoria whereCategoria($value)
 */
class Categoria extends Model
{
    protected $table = 'categorias';
    protected $primaryKey = 'categoria_id';
}
