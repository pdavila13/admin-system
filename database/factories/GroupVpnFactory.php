<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class GroupVpnFactory extends Factory
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
            'name' => $faker->numerify('gvpneics##'),
            'network' => $this->faker->ipv4,
            'description' => $this->faker->catchPhrase,
            'company_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
