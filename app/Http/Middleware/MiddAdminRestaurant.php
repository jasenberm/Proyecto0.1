<?php

namespace App\Http\Middleware;

use Brian2694\Toastr\Facades\Toastr;
use Closure;

class MiddAdminRestaurant
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
        // dd('llega');
        if ($this->permiso()) {
            // dd('enrtra');
            return $next($request);
            dd('enrtra');
        }

        return redirect('/superuser/client');
    }

    private function permiso()
    {
        //dd(session()->all());
        return session()->get('rol_nombre') == 'admin';
    }
}
