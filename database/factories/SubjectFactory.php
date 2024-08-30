<?php

namespace Database\Factories;

use App\Models\Subject;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
{

    protected $model = Subject::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'teacher_id' => $this->faker->randomElement(
                \App\Models\Teacher::pluck('id')->toArray()
            ),
            'class_room_id' => $this->faker->randomElement(
                \App\Models\ClassRoom::pluck('id')->toArray()
            ),
            'name' => function (array $attributes) {
                $classRoom = \App\Models\ClassRoom::find($attributes['class_room_id']);

                $subjectSoshum = [
                    'Sosiologi',
                    'Geografi ',
                    'Sejarah ',
                    'Ekonomi ',
                    'Matematika wajib',
                ];

                $subjectSaintek = [
                    'Fisika',
                    'Kimia',
                    'Biologi',
                    'Matematika wajib',
                    'Matematika minat',
                ];

                return $this->faker->randomElement($classRoom->name === 'Soshum' ? $subjectSoshum : $subjectSaintek);
            },
        ];
    }
}
