<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "admin";
        $role->description = "Administrador del Restaurante";
        $role->save();

        $role = new Role();
        $role->name = "user";
        $role->description = "Usuarios clientes";
        $role->save();

        $role = new Role();
        $role->name = "superAdmin";
        $role->description = "Administrador de la pagina";
        $role->save();
    }
}
