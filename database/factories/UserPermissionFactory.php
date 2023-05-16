<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserPermission>
 */
class UserPermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersIDs = DB::table('users')->pluck('id');
        $permissionsIDs = DB::table('permissions')->pluck('id');

        return [
            'user_id' => fake()->randomElement($usersIDs),
            'permission_id' => fake()->randomElement($permissionsIDs),
        ];
    }
}
