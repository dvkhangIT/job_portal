<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
  /**
   * Define the model's default state.
   *
   * @return array<string, mixed>
   */
  public function definition(): array
  {
    return [
      'title' => fake()->name,
      'company_name' => fake()->company,
      'company_location' => fake()->city,
      // 'user_id' => rand(1, 3),
      'user_id' => 1,
      'salary' =>  '$' . rand(1000, 10000),
      'job_type_id' => rand(1, 5),
      'category_id' => rand(1, 5),
      'isFeatured' => rand(0, 1),
      'vacancy' => rand(1, 5),
      'location' => fake()->city,
      'description' => fake()->text,
      'benefits' => fake()->text,
      'responsibility' => fake()->text,
      'qualifications' => fake()->text,
      'experience' => rand(1, 10),
      'company_name' => fake()->name,
    ];
  }
}
