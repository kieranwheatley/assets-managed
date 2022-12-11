<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class usersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'first_name' => $this->fake()->name(),
            'last_name' => $this->fake()->name(),
            'email' => $this->fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $this->fake()->password(),
            'remember_token' => $this->fake()->randomNumber(),
            'position' => $this->fake()->word(),
            'created_at' => $this->fake()->dateTime(),
            'updated_at' => $this->fake()->dateTime(),
        ];
    }
}
