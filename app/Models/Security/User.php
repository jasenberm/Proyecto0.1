<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $remember_token = false;
    protected $table = 'users';
    protected $fillable = [
        'name', 'user', 'email', 'password',
    ];
    protected $guarded = ['id'];

    // relacion con la tabla de roles
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    // Validacion de rol del usuario
    public function authorizeRoles($roles){
        if ($this->hasAnyRole($roles)) {
            return true;
        }
        abort(401, 'This action is unauthorized');
    }

    public function hasAnyRole($roles){
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($roles)) {
                    return true;
                }    
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role){
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        } else {
            return false;
        }
    }
}
