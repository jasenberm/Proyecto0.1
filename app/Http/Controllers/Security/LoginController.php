<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin/dashboard';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('security.index');
    }

    protected function authenticated(Request $request, $user)
    {
        //dd($user->roles()->where('status', 1)->get());
        $roles = $user->roles()->where('status', 1)->get();
        //dd($roles);
        if ($roles->isNotEmpty()) {
            $user->setSession($roles->toArray());
            //dd('llega');
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
}