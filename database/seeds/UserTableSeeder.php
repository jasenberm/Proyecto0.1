<?php

use App\Models\Resources\RolUser;
use Illuminate\Database\Seeder;
use App\Role;
use App\Models\Security\User;
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
        // $role_user = Role::where('name', 'user')->first();
        // $role_admin = Role::where('name', 'admin')->first();
        // $role_superAdmin = Role::where('name', 'superAdmin')->first();

        $user = new User();
        $user->name = "Usuario";
        $user->user = "User";
        $user->email =  "user@mail.com";
        $user->password = bcrypt('usuario');
        $user->save();
        // $user->roles()->attach($role_user);

        // $rol_user = new RolUser();
        // $rol_user->rol_id = 1;
        // $rol_user->user_id = 2;
        // $rol_user->status = 1;
        // $rol_user->save();

        DB::table('rol_user')->insert([
            'rol_id' => 2,
            'user_id' => 1,
            'status' => 1
        ]);

        $user = new User();
        $user->name = "Usuario2";
        $user->user = "User2";
        $user->email =  "user2@mail.com";
        $user->password = bcrypt('usuario');
        $user->save();
        // $user->roles()->attach($role_user);

        // $rol_user = new RolUser();
        // $rol_user->rol_id = 1;
        // $rol_user->user_id = 2;
        // $rol_user->status = 1;
        // $rol_user->save();

        DB::table('rol_user')->insert([
            'rol_id' => 2,
            'user_id' => 2,
            'status' => 1
        ]);

        $user = new User();
        $user->name = "Administrador";
        $user->user = "Admin";
        $user->email =  "admin@mail.com";
        $user->password = bcrypt('administrador');
        $user->save();
        // $user->roles()->attach($role_admin);

        // $rol_user = new RolUser();
        // $rol_user->rol_id = 2;
        // $rol_user->user_id = 1;
        // $rol_user->status = 1;
        // $rol_user->save();

        DB::table('rol_user')->insert([
            'rol_id' => 1,
            'user_id' => 3,
            'status' => 1
        ]);

        $user = new User();
        $user->name = "Super Usuario";
        $user->user = "Super";
        $user->email =  "superu@mail.com";
        $user->password = bcrypt('superusuario');
        $user->save();
        // $user->roles()->attach($role_superAdmin);

        // $rol_user = new RolUser();
        // $rol_user->rol_id = 3;
        // $rol_user->user_id = 3;
        // $rol_user->status = 1;
        // $rol_user->save();

        DB::table('rol_user')->insert([
            'rol_id' => 3,
            'user_id' => 4,
            'status' => 1
        ]);
    }
}
