<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Vista Home con los productos en promo
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        $promos = Producto::where('promo', '=', 1)->get();

        return view('section.home', ['promos' => $promos]);
    }
}
