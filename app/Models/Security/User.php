<?php

namespace App\Models\Security;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $remember_token = false;
    protected $table = 'users';
    protected $fillable = [
        'name', 'last_name', 'user', 'email', 'password', 'status'
    ];
    protected $guarded = ['id'];

    // relacion con la tabla de roles
    public function rols()
    {
        return $this->belongsToMany('App\Rol', 'rol_user');
    }

    public function setSession($roles)
    {
        //   dd($roles);
        if (count($roles) == 1) {

            Session::put(
                [
                    'rol_id' => $roles[0]['id'],
                    'rol_nombre' => $roles[0]['name'],
                    'rol_descripcion' => $roles[0]['description'],
                    'usuario' => $this->user,
                    'usuario_id' => $this->id,
                    'usuario_nombre' => $this->name,
                    'usuario_status' => $this->status
                ]
            );
            //dd(session()->all());
        }
    }
}
