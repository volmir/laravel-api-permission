<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserRole>
 */
class UserRoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rolesIDs = DB::table('roles')->pluck('id');
        $usersIDs = DB::table('users')->pluck('id');

        return [
            'role_id' => fake()->randomElement($rolesIDs),
            'user_id' => fake()->randomElement($usersIDs),
        ];
    }
}
