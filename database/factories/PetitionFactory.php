<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Petition>
 */
class PetitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('es_ES');
        return [
            'petition_number' => $faker->randomNumber($nbDigits = 6, $strict = false),
            'company_id' => $this->faker->numberBetween(1, 20),
            'petition_type_id' => $this->faker->numberBetween(1, 3),
            'user_id' => $this->faker->numberBetween(1, 3),
            'state_id' => $this->faker->numberBetween(1, 3),
            'datepicker' => $this->faker->dateTime($max = 'now'),
        ];
    }
}
