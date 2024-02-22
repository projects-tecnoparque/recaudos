<?php

namespace Database\Factories;

use App\Enums\BooleanStatus;
use App\Models\DocumentType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_type_id' => DocumentType::all()->random()->id,
            'document' => $this->faker->unique()->numerify('##########'),
            'names' => $this->faker->name,
            'surnames' => $this->faker->lastName(),
            'phone' =>  $this->faker->e164PhoneNumber(),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTimeBetween($startDate = '-3 years'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            'status' => $this->faker->randomElement(BooleanStatus::class),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
