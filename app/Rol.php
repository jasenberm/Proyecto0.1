<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    protected $fillable = ['nombre'];
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany('App\Models\Security\User', 'rol_user');
    }
}
