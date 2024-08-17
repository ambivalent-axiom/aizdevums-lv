<?php

namespace Database\Factories;

use App\Models\CV;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        CV $cv = null,
        string $company = null,
        string $position = null,
        string $businessType = null,
        Carbon $startDate = null,
        Carbon $endDate = null
    ): array
    {
        return [
            'cv_id' => $cv->id ?? CV::factory()->create()->id,
            'company' => $company ?? $this->faker->company,
            'position' => $position ?? $this->faker->jobTitle,
            'business_type' => $businessType ?? $this->faker->randomElement(['IT', 'Construction', 'Retail', 'Fintech']),
            'start_date' => $startDate ?? $this->faker->date(),
            'end_date' => $endDate ?? $this->faker->date(),
        ];
    }
}
