<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use App\Models\Edad;
use App\Models\Categoria;
use App\Models\TipoAlimento;
use App\Models\Unidad;
use Illuminate\Http\Request;
use File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\UploadedFile;
use function GuzzleHttp\uri_template;

/**
 * Class ProductosController
 * @package App\Http\Controllers
 */
class ProductosController extends Controller
{
    /**
     * Listado de todos los productos para la vista del usuario común
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function listado()
    {
        $productos = Producto::all();

        return view('section.productos', ['productos' => $productos]);
    }


    /**
     * Detalles de un producto en específico
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ver($id)
    {
        $producto = Producto::findOrFail($id);

        return view('section.detalles', ['producto' => $producto]);
    }

    /**
     * Muestra el formulario para crear un producto nuevo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function nuevo()
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $edades = Edad::all();
        $tipoAlimentos = TipoAlimento::all();
        $unidades = Unidad::all();

        return view('panel.form-productos', [
            'marcas' => $marcas,
            'categorias' => $categorias,
            'edades' => $edades,
            'tipoAlimentos' => $tipoAlimentos,
            'unidades' => $unidades
        ]);
    }

    /**
     * Crea un producto nuevo
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function alta(Request $request)
    {
        $request->validate(Producto::$rules, Producto::$errorMessages);

        $data = $request->input();

        $image = $request->img;
        $nombre = strtolower(str_replace([':', '.'], '', str_replace(' ', '_', $data['nombre']))) . '_' . date('Ymd') . '.' . $image->extension();
        $ruta = public_path('img/productos');

        $img = Image::make($image->path());
        $img->resize(500, 500, function ($constraint) {

            $constraint->aspectRatio();

        })->save("$ruta/$nombre");

        $data['img'] = $nombre;

        if ($data->categoria_id == 2 || $data->categoria_id == 3)
            $data->unidad_id = 1;

        $producto = Producto::create($data);

        if ($producto)
            return redirect(url('panel'))->with('success', "El producto $producto->nombre se creo correctamente");

        else
            return redirect(url('panel'))->with('error', "Hubo un error al crear el producto $producto->nombre");


    }

    /**
     * Muestra el formulario para editar un producto con sus datos pre cargados
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editar($id)
    {
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $edades = Edad::all();
        $tipoAlimentos = TipoAlimento::all();
        $unidades = Unidad::all();
        $producto = Producto::findOrFail($id);


        return view('panel.form-productos', [
            'marcas' => $marcas,
            'categorias' => $categorias,
            'edades' => $edades,
            'tipoAlimentos' => $tipoAlimentos,
            'unidades' => $unidades,
            'producto' => $producto
        ]);
    }

    /**
     * Modifica un producto en específico
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function modificar(Request $request, $id)
    {
        $rules = Producto::$rules;
        unset($rules['img']);//ya tiene imagen no es obligatoria
        $request->validate($rules, Producto::$errorMessages);

        $producto = Producto::findOrFail($id);
        $data = $request->all();

        if (!empty($request->img)) {
            $pathImg = "img/productos/$producto->img";
            if (File::exists($pathImg))
                File::delete($pathImg);

            $image = $request->img;
            $nombre = strtolower(str_replace([':', '.'], '', str_replace(' ', '_', $data['nombre']))) . '_' . date('Ymd') . '.' . $image->extension();
            $ruta = public_path('img/productos');

            $img = Image::make($image->path());
            $img->resize(500, 500, function ($constraint) {

                $constraint->aspectRatio();

            })->save("$ruta/$nombre");

            $data['img'] = $nombre;
        }

        if ($producto->update($data)) {
            return redirect(url('panel'))->with('success', "El producto $producto->nombre se actualizó correctamente");

        } else {
            return redirect(url('panel'))->with('error', "Hubo un error al actualizar el producto $producto->nombre");
        }
    }

    /**
     * Elimina un producto en específico
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function eliminar($id)
    {
        $producto = Producto::findOrFail($id);
        $pathImg = "img/productos/$producto->img";
        if ($producto->delete()) {
            if (File::exists($pathImg))
                File::delete($pathImg);

            return redirect(url('panel'))->with('success', "El producto $producto->nombre se eliminó con éxito");

        } else
            return redirect(url('panel'))->with('error', "Hubo un error al eliminar el producto $producto->nombre");

    }
}
