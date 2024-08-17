<?php

namespace Database\Factories;

use App\Models\CV;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        CV $cv = null,
        string $skillName = null,
        Integer $skillLevel = null
    ): array
    {
        return [
            'cv_id' => $cv->id ?? CV::factory()->create()->id,
            'skill_name' => $skillName ?? $this->faker->name(),
            'skill_level' => $skillLevel ?? $this->faker->numberBetween(1, 5),
        ];
    }
}
