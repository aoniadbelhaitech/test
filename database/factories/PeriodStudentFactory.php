<?php

namespace Database\Factories;

use App\Models\periodStudent;
use Illuminate\Database\Eloquent\Factories\Factory;

class PeriodStudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = periodStudent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1,20),
            'period_id' => $this->faker->numberBetween(1,50),

        ];
    }
}
