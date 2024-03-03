<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DocumentTypeFactory extends Factory
{
    protected $model = DocumentType::class;

    public function definition(): array
    {
        return [
            'abbreviation' => $this->faker->bothify('???'),
            'name' => $this->faker->unique()->words(3, true),
        ];
    }
}
