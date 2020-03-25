<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;

class MiddSuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($this->permiso()) {
            return $next($request);
        }

        return redirect('/superuser/client');
    }

    private function permiso()
    {
        return session()->get('rol_nombre') == 'superAdmin';
    }
}
