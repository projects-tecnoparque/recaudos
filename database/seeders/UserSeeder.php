<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'names' => 'usertest',
            'email' => 'test@email.com',
        ])
        ->assignRole(RoleEnum::ADMINISTRADOR);

        User::factory(50)->create()->each(function ($user) {
            $user->assignRole(RoleEnum::COBRADOR);
        });
    }
}
