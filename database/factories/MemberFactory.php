<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'phone_number' => $this->faker->e164PhoneNumber(),
            'id_number' => rand(10000000, 99999999),
            'entry_number' => rand(1000, 10000),
            'region_id' => $this->faker->randomElement(Region::all()->pluck('id')),
        ];
    }
}
