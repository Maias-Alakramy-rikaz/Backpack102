<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Teacher;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Course::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3,true),
            'price' => $this->faker->numberBetween(0, 10000),
            'start_date' => $this->$faker->dateTimeBetween('now', '+ 1 year')->format('Y-m-d H:i:s'),
            'teacher_id' => Teacher::inRandomOrder()->first()
        ];
    }
}
