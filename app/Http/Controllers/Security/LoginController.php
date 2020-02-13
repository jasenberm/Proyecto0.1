<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    //protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('security.login');
    }

    protected function authenticated(Request $request, $user)
    {
        //dd($user->roles()->where('status', 1)->get());
        $roles = $user->rols()->get();
        if ($roles->isNotEmpty() && $user->status == true) {
            $user->setSession($roles->toArray());
        } else {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/login')->withErrors(['error' => 'este usuario no tiene un rol activo']);
        }
    }

    public function username()
    {
        return 'user';
    }

    public function redirectPath()
    {
        //dd(session());
        $rol = session()->get('rol_nombre');
        if ($rol == 'admin') {
            return '/admin/dashboard';
        }

        if ($rol == 'superAdmin') {
            // dd('llega');
            return '/superuser/request';
        }

        if ($rol == 'user') {
            return '/';
        }
    }
}
