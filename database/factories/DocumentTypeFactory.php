<?php

namespace Database\Factories;

use App\Models\DocumentType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DocumentTypeFactory extends Factory
{
    protected $model = DocumentType::class;

    public function definition(): array
    {
    	return [
            'name' => $this->faker->word(),
    	    'abbreviation' => function(array $attributes){
                return Str::substr($attributes['name'], 0, 3);($attributes['name']);
            },
    	];
    }
}
