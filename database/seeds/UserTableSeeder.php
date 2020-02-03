<?php

use App\Models\Resources\RolUser;
use Illuminate\Database\Seeder;
use App\Role;
use App\Models\Security\User;
use App\Rol;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = Rol::where('name', 'user')->first();
        $role_admin = Rol::where('name', 'admin')->first();
        $role_superAdmin = Rol::where('name', 'superAdmin')->first();

        $user = new User();
        $user->name = "Usuario";
        $user->last_name = "Usuario";
        $user->user = "User";
        $user->email =  "user@mail.com";
        $user->password = bcrypt('usuario');
        $user->status = true;
        $user->save();
        $user->rols()->attach($role_user);


        $user = new User();
        $user->name = "Usuario2";
        $user->last_name = "Usuario";
        $user->user = "User2";
        $user->email =  "user2@mail.com";
        $user->password = bcrypt('usuario');
        $user->status = true;
        $user->save();
        $user->rols()->attach($role_user);


        $user = new User();
        $user->name = "Administrador";
        $user->last_name = "Usuario";
        $user->user = "Admin";
        $user->email =  "admin@mail.com";
        $user->password = bcrypt('administrador');
        $user->status = true;
        $user->save();
        $user->rols()->attach($role_admin);


        $user = new User();
        $user->name = "Super";
        $user->last_name = "Usuario";
        $user->user = "Super";
        $user->email =  "superu@mail.com";
        $user->password = bcrypt('superusuario');
        $user->status = true;
        $user->save();
        $user->rols()->attach($role_superAdmin);
    }
}
