<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Job::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reference' => '7988e9d4-45e6-4d7d-ba30-9d6ea2859eb6',
            'name' => $this->faker->name,
            'description' => $this->faker->text,
            'schedule_at' => $this->faker->dateTime
        ];
    }
}
