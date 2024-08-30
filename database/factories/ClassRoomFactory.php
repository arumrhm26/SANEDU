<?php

namespace Database\Factories;

use App\Models\Cabang;
use App\Models\ClassRoom;
use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ClassRoom>
 */
class ClassRoomFactory extends Factory
{

    protected $model = ClassRoom::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement([
                'Soshum',
                'Saintek',
            ]),
            'grade_id' => $this->faker->randomElement(
                Grade::pluck('id')->toArray()
            ),
            // set full_name from grade_id and name
            'full_name' => function (array $attributes) {
                $grade = Grade::find($attributes['grade_id']);

                return $grade->name . ' ' . $attributes['name'];
            },
            'limit_siswa' => $this->faker->randomElement([20, 25, 30, 35, 40]),
            'tahun_ajaran_id' => 1,
            'cabang_id' => $this->faker->randomElement(
                Cabang::pluck('id')->toArray()
            ),
        ];
    }
}
