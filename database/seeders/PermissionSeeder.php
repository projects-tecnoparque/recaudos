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
        $roleRecaudador   = Role::where('name', RoleEnum::RECAUDADOR)->first();

        Permission::create(['name' => 'Dashboard'])
        ->syncRoles([
            $roleAdmin,
            $roleRecaudador
        ]);

        Permission::create(['name' => 'leer tipos documentos'])
        ->syncRoles([
            $roleAdmin,
            // $roleRecaudador
        ]);

        Permission::create(['name' => 'Leer Usuarios'])
        ->syncRoles([
            $roleAdmin,
            $roleRecaudador
        ]);

        Permission::create(['name' => 'Actualizar Usuarios'])->syncRoles([
            $roleAdmin,
            $roleRecaudador
        ]);

        Permission::create(['name' => 'Cambiar Estado Usuario'])->syncRoles([
            $roleAdmin,
            $roleRecaudador
        ]);

        Permission::create(['name' => 'Registrar recaudo'])->syncRoles([
            $roleAdmin,
            $roleRecaudador
        ]);
    }
}
