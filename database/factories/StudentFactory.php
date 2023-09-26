<?php

namespace Database\Factories;

use App\Models\School;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $school = School::inRandomOrder()->first();

        $order = fake()->numberBetween(1, 9);

        return [
            'name' => fake()->name,
            'school_id' => $school->id,
            'order' => $order,
        ];
    }

}
