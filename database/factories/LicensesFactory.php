<?php

namespace Database\Factories;

use App\Models\CV;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\License>
 */
class LicensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        CV $cv = null,
        string $licenseName = Null,
        string $institution = Null,
        string $licenseId = Null,
        Carbon $issueDate = Null,
    ): array
    {
        return [
            'cv_id' => $cv->id ?? CV::factory()->create()->id,
            'license_name' => $licenseName ?? $this->faker->text(20),
            'institution' => $institution ?? $this->faker->company(),
            'license_id' => $licenseId ?? $this->faker->uuid(),
            'issue_date' => $issueDate ?? $this->faker->date(),
        ];
    }
}
