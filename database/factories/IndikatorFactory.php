<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Indikator>
 */
class IndikatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'materi_id' => $this->faker->randomElement(
                \App\Models\Materi::pluck('id')->toArray()
            ),
            'name' => $this->faker->sentence(3),
            'code' => $this->faker->regexify('[A-Z]{3}[0-9]{3}'),
        ];
    }
}
