<?php

namespace App\Http\Middleware;

use App\Models\TipoUser;
use Closure;

class VerificarUser
{
    /**
     * Verifica el tipo de usuario si tiene permisos o no
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!isset($request->user()->tipo_id) || $request->user()->tipo_id != TipoUser::$TIPO_ADMIN) {
            return redirect(url('/'));
        }

        return $next($request);
    }
}
