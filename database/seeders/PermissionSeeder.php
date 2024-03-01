<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roleAdmin         = Role::where('name', RoleEnum::ADMINISTRADOR)->first();
        $roleCobrador   = Role::where('name', RoleEnum::COBRADOR)->first();

        Permission::create(['name' => 'Dashboard'])->syncRoles([
            $roleAdmin,
            $roleCobrador
        ]);

        Permission::create(['name' => 'Leer Usuarios'])->syncRoles([
            $roleAdmin,
            $roleCobrador
        ]);

        Permission::create(['name' => 'Actualizar Usuarios'])->syncRoles([
            $roleAdmin,
            $roleCobrador
        ]);

        Permission::create(['name' => 'Cambiar Estado Usuario'])->syncRoles([
            $roleAdmin,
            $roleCobrador
        ]);

        Permission::create(['name' => 'Registrar recaudo'])->syncRoles([
            $roleAdmin,
            $roleCobrador
        ]);
    }
}
