<?php

namespace Database\Seeders;

use App\Enums\RoleEnum;
use App\Models\User;
use App\Models\Customer;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //admin
        User::factory()->create([
            'names' => 'usertest',
            'email' => 'test@email.com',
        ])
        ->assignRole([RoleEnum::ADMINISTRADOR, RoleEnum::RECAUDADOR]);

        //customers ->clientes
        User::factory()
            ->count(50)
            ->create()
            ->each(function ($user) {
                Customer::factory()->create([
                    'user_id' => $user->id
                ]);
                $user->assignRole(RoleEnum::CLIENTE);
            });

        User::factory()
            ->count(50)
            ->create()
            ->each(function ($user) {
                $user->assignRole(RoleEnum::RECAUDADOR);
            });

    }
}
