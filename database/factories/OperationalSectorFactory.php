<?php

namespace Database\Factories;

use App\Models\OperationalSector;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationalSectorFactory extends Factory
{
    protected $model = OperationalSector::class;

    public function definition(): array
    {
        return [

            'name' => $this->faker->unique()->words(1, true),
            // 'code' => function(array $attributes){
            //     $name = trim(collect(explode(' ', "{$attributes['name']}"))->map(function ($segment) {
            //         return substr($segment, 0, 3);
            //     })->join(' '));
            //     return $name;
            // },
            'code' => generateCode(OperationalSector::class)
        ];
    }
}
