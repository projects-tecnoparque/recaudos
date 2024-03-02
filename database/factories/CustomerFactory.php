<?php

namespace Database\Factories;

use App\Enums\RoleEnum;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition(): array
    {
    	return [
            'user_id' => User::all()->random()->id,
            'code' => $this->faker->unique()->numerify('##########'),
            'address' => $this->faker->address(),
            'neighborhood' => $this->faker->streetName(),
            'area' => $this->faker->state()
    	];
    }
}
