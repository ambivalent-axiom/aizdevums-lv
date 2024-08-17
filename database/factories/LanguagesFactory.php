<?php

namespace Database\Factories;

use App\Models\CV;
use Illuminate\Database\Eloquent\Factories\Factory;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Language>
 */
class LanguagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        CV $cv = null,
        string $language = null,
        Integer $level = null,
    ): array
    {
        return [
            'cv_id' => $cv->id ?? CV::factory()->create()->id,
            'language' => $language ?? $this->faker->languageCode(),
            'level' => $level ?? $this->faker->numberBetween(1, 5),
        ];
    }
}
