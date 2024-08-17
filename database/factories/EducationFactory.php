<?php

namespace Database\Factories;

use App\Models\CV;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Education>
 */
class EducationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        CV $cv = null,
        string $educationLevel = null,
        string $institutionName = null,
        Carbon $startDate = null,
        Carbon $endDate = null

    ): array
    {
        return [
            'cv_id' => $cv->id ?? CV::factory()->create()->id,
            'education_level' => $educationLevel ?? $this->faker->randomElement(['High School', 'Bachelor', 'Master', 'Doctorate']),
            'education_institution' => $institutionName ?? $this->faker->company,
            'education_start_date' => $startDate ?? $this->faker->date(),
            'education_end_date' => $endDate ?? $this->faker->date(),
        ];
    }
}
