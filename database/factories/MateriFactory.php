<?php

namespace Database\Factories;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Materi>
 */
class MateriFactory extends Factory
{

    protected $model = Materi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_id' => $this->faker->randomElement(
                \App\Models\Subject::pluck('id')->toArray()
            ),
            'name' => $this->faker->sentence(1),
            // random code
            'code' =>  $this->faker->unique()->randomNumber(5),
        ];
    }
}
