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
        if ($this->permiso()) {
            return $next($request);
            dd('enrtra');
        }
        //dd('no enrtra');
        Toastr::success('Su Mensaje a Sido Exitosamente Enviado', 'Exito', ["positionClass" => "toast-top-right"]);
        return redirect('/')->with('alertMsg', 'No tiene permisos de acceso');
    }

    private function permiso()
    {
        //dd(session()->get('rol_nombre') == 'superAdmin');
        return session()->get('rol_nombre') == 'admin';
    }
}
