<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Edad
 *
 * @property int $edad_id
 * @property string $edad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad whereEdad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad whereEdadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Edad whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Edad extends Model
{
    protected $table = 'edades';
    protected $primaryKey = 'edad_id';
}
