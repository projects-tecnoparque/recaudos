<?php

namespace Database\Factories;

use App\Models\OperationalSector;
use App\Models\Sectional;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionalFactory extends Factory
{
    protected $model = Sectional::class;

    public function definition(): array
    {
        return [
            'operational_sector_id' => OperationalSector::all()->random()->id,
            'code' => generateCode(Sectional::class),
            'name' => $this->faker->unique()->words(1, true),
        ];
    }
}
