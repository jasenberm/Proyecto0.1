<?php

namespace App\Http\Controllers\Security;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/admin/dashboard';

    public function index(Request $request)
    {
        if ($request->is('register')) {
            return view('security.registro_client');
        } elseif ($request->is('registerOwner')) {
            return view('security.registro_admin');
        }
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user' => ['required', 'string', 'max:15', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'user' => $data['user'],
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    protected function registered(Request $request, $user)
    {
        //dd($user->id);

        if ($request->is('registerOwner')) {
            //dd('entra owner');
            DB::table('rol_user')->insert([
                'rol_id' => 2,
                'user_id' => $user->id,
                'status' => 0
            ]);
        } elseif ($request->is('register')) {
            // dd('entra register');
            DB::table('rol_user')->insert([
                'rol_id' => 1,
                'user_id' => $user->id,
                'status' => 0
            ]);
        }
    }
}
