<?php

namespace App\Http\Middleware;

use Closure;

class VerificarCarrito
{
    /**
     * Verficia que se acceda al checkout desde el carrito y con items en él
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!count($request->user()->carrito))
            return redirect(url('/productos'));
        elseif (strpos($request->session()->previousUrl(), '/carrito') === false && strpos($request->session()->previousUrl(), '/pedidos/nuevo') === false)
            return redirect(url('/carrito'));

        return $next($request);
    }
}
