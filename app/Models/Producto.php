<?php

namespace App\Models;

use App\Models\Edad;
use App\Models\Categoria;
use App\Models\TipoAlimento;
use App\Models\Marca;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Producto
 *
 * @property int $producto_id
 * @property string $nombre
 * @property float $precio
 * @property string $descripcion
 * @property string $img
 * @property int|null $edad_id
 * @property int|null $tipoAlimento_id
 * @property int $marca_id
 * @property int $categoria_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Categoria $categoria
 * @property-read \App\Models\Edad|null $edad
 * @property-read \App\Models\Marca $marca
 * @property-read \App\Models\TipoAlimento|null $tipoAlimento
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereCategoriaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereDescripcion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereEdadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereMarcaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereNombre($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto wherePrecio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereProductoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereTipoAlimentoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property float|null $peso
 * @property string|null $rango_peso
 * @property int|null $promo
 * @property int|null $unidad_id
 * @property-read \App\Models\Unidad|null $unidad
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto wherePeso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto wherePromo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereRangoPeso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Producto whereUnidadId($value)
 */
class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'producto_id';

    protected $fillable = ['nombre', 'precio', 'promo', 'descripcion', 'img', 'edad_id', 'tipoAlimento_id', 'marca_id', 'categoria_id', 'peso', 'rango_peso', 'unidad_id'];

    public static $rules = [
        'nombre' => 'required|min:5',
        'precio' => 'required|numeric',
        'promo' => 'required|integer|in:0,1',
        'descripcion' => 'required|min:15',
        'img' => 'required|mimes:jpeg,jpg,png',
        'categoria_id' => 'required|integer|exists:categorias',
        'edad_id' => 'nullable|integer|exists:edades|required_if:categoria_id,==,1',
        'tipoAlimento_id' => 'nullable|integer|exists:tipoAlimentos|required_if:categoria_id,==,1',
        'marca_id' => 'required|integer|exists:marcas',
        'peso' => 'required_if:categoria_id, 1, 5, 6|nullable|numeric',
        'rango_peso' => 'required_if:categoria_id, 2, 3|nullable|min:3',
        'unidad_id' => 'required_with:peso,rango_peso|nullable|integer|exists:unidades',
    ];

    public static $errorMessages = [
        'nombre.required' => 'El nombre no puede estar vac??o',
        'nombre.min' => 'El nombre debe de tener al menos :min caracteres',
        'precio.required' => 'El precio no puede estar vac??o',
        'precio.numeric' => 'El precio debe de ser un n??mero',
        'promo.required' => 'La promo no puede estar vac??a',
        'promo.integer' => 'La promo no es v??lida',
        'promo.in' => 'La promo no es v??lida',
        'descripcion.required' => 'La descripcion no puede estar vac??a',
        'descripcion.min' => 'La descripcion debe de tener al menos :min caracteres',
        'img.required' => 'La imagen no puede estar vac??a',
        'img.mimes' => 'La imagen debe de ser .jpeg o .png',
        'categoria_id.required' => 'La categor??a no puede estar vac??a',
        'categoria_id.integer' => 'La categor??a no ex??ste',
        'categoria_id.exists' => 'La categor??a no ex??ste',
        'edad_id.integer' => 'La edad no ex??ste',
        'edad_id.exists' => 'La edad no ex??ste',
        'edad_id.required_if' => 'La edad no puede estar vac??a si el producto es un alimento',
        'tipoAlimento_id.required_if' => 'El tipo de alimento no puede estar vac??o si el producto es un alimento',
        'tipoAlimento_id.exists' => 'El tipo de alimento no ex??ste',
        'marca_id.integer' => 'La marca no ex??ste',
        'marca_id.exists' => 'La marca no ex??ste',
        'marca_id.required' => 'La marca no puede estar vac??a',
        'peso.required_if' => 'El peso no puede estar vac??o en la categor??a seleccionada',
        'peso.numeric' => 'El peso debe de ser un n??mero',
        'rango_peso.required_if' => 'El rango no puede estar vac??o en la categor??a seleccionada',
        'rango_peso.min' => 'El rango debe de tener al menos :min caracteres',
        'unidad_id.required_with' => 'La unidad no puede estar vac??a si el producto tiene peso o un rango de peso',
        'unidad_id.integer' => 'La unidad no existe',
        'unidad_id.exists' => 'La unidad no existe',
    ];

    public function edad(){
        return $this->belongsTo(Edad::class, 'edad_id', 'edad_id');
    }

    public function tipoAlimento(){
        return $this->belongsTo(TipoAlimento::class, 'tipoAlimento_id', 'tipoAlimento_id');
    }

    public function marca(){
        return $this->belongsTo(Marca::class, 'marca_id', 'marca_id');
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class, 'categoria_id', 'categoria_id');
    }

    public function unidad(){
        return $this->belongsTo(Unidad::class, 'unidad_id', 'unidad_id');
    }
}
