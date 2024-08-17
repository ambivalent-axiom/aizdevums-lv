<?php

namespace Database\Factories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CV>
 */
class CVFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(
        User $user = null,
        string $firstName = null,
        string $lastName = null,
        string $email = null,
        string $phone = null,
        Carbon $birthDate = null,
        string $country = null,
        string $city = null,
        string $picture = null,

    ): array
    {
        return [
            'user_id' => $user->id ?? User::factory()->create()->id,
            'first_name' => $firstName ?? $this->faker->firstName(),
            'last_name' => $lastName ?? $this->faker->lastName(),
            'email' => $email ?? $this->faker->unique()->safeEmail(),
            'phone' => $phone ?? $this->faker->numberBetween(10000000, 999999999),
            'birth_date' => $birthDate ?? $this->faker->date(),
            'country' => $country ?? $this->faker->country(),
            'city' => $city ?? $this->faker->city(),
            'picture' => $picture ?? $this->faker->imageUrl(),
        ];
    }
}
