<?php

use Illuminate\Database\Seeder;
use App\Rol;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Rol();
        $role->name = "admin";
        $role->description = "Administrador del Restaurante";
        $role->save();

        $role = new Rol();
        $role->name = "user";
        $role->description = "Usuarios clientes";
        $role->save();

        $role = new Rol();
        $role->name = "superAdmin";
        $role->description = "Administrador de la pagina";
        $role->save();
    }
}
