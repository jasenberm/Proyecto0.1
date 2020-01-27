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
            // dd('enrtra');
            return $next($request);
            dd('enrtra');
        }

        return redirect('/admin/dashboard');
    }

    private function permiso()
    {
        //dd(session()->all());
        //dd('permiso');
        return session()->get('rol_nombre') == 'superAdmin';
    }
}
