<?php

namespace App\Http\Controllers\SuperUser;

use App\Exports\UserExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Item;
use App\Models\Resources\RolUser;
use App\Models\Security\User;
use App\Rol;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->is('superuser/client')) {
            //dd($roles);
            $roles = Rol::where('name', 'user')->get();

            $users = collect();
            foreach ($roles as $key => $rol) {
                if (($rol->users()->get())->isNotEmpty()) {
                    $users = $rol->users()->get();
                }
            }

            return view('superUser.clients.index', compact('users'));
        }

        if ($request->is('superuser/owner')) {
            $roles = Rol::where('name', 'admin')->get();

            $users = collect();
            foreach ($roles as $key => $rol) {
                if (($rol->users()->get())->isNotEmpty()) {
                    $users = $rol->users()->get();
                }
            }
            return view('superUser.clients.index', compact('users'));
        }

        if ($request->is('superuser/superuser')) {
            $roles = Rol::where('name', 'superAdmin')->get();

            $users = collect();
            foreach ($roles as $key => $rol) {
                if (($rol->users()->get())->isNotEmpty()) {
                    $users = $rol->users()->get();
                }
            }
            return view('superUser.superuser.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('superUser.superuser.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => ['required', 'string', 'max:50', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $user = new User();
        $user->user = $request->user;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->status = true;
        $user->save();

        $users = User::where('user', $user->user)->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $user_id = $user;
            }
            DB::table('rol_user')->insert([
                'rol_id' => 3,
                'user_id' => $user_id->id,
            ]);
        }
        return redirect()->route('superuser.index')->with('successMsg', 'Usuario creado Correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('superUser.superuser.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'user' => ['required', 'string', 'max:50', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
        ]);
        $user = User::find($id);
        $user->user = $request->user;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->save();
        return redirect()->route('superuser.index')->with('successMsg', 'Usuario Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('successMsg', 'Usuario Eliminado Correctamente');
    }

    public function status($id)
    {
        $user = User::find($id);
        if ($user->status == true) {
            $user->status = false;
            $user->save();
        } elseif ($user->status == false) {
            $user->status = true;
            $user->save();
        }
        return redirect()->back()->with('successMsg', 'Cambio de estado realizado correctamente');
    }
}
