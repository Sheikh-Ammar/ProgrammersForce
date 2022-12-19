<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'cnic' => Str::random(13),
            'number' => fake()->phoneNumber(),
            'course_id' => rand(1, 5),
            'grades_id' => rand(1, 3),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
