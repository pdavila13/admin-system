<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserT3Factory extends Factory
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
            'name' => $faker->firstName,
            'nif' => $faker->dni,
            'first_name' => $faker->lastName,
            'last_name' => $faker->lastName,
            'phonenumber' => $faker->mobileNumber,
            'email' => $faker->safeEmail,
        ];
    }
}
