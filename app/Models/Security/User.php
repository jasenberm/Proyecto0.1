<?php

namespace App\Models\Security;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    protected $remember_token = false;
    protected $table = 'users';
    protected $fillable = [
        'name', 'last_name', 'user', 'email', 'password',
    ];
    protected $guarded = ['id'];

    // relacion con la tabla de roles
    public function roles()
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
                    'usuario_nombre' => $this->name
                ]
            );
            //dd(session()->all());
        }
    }

    // // Validacion de rol del usuario
    // public function authorizeRoles($roles){
    //     if ($this->hasAnyRole($roles)) {
    //         return true;
    //     }
    //     abort(401, 'This action is unauthorized');
    // }

    // public function hasAnyRole($roles){
    //     if (is_array($roles)) {
    //         foreach ($roles as $role) {
    //             if ($this->hasRole($roles)) {
    //                 return true;
    //             }    
    //         }
    //     } else {
    //         if ($this->hasRole($roles)) {
    //             return true;
    //         }
    //     }
    //     return false;
    // }

    // public function hasRole($role){
    //     if ($this->roles()->where('name', $role)->first()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }
}
