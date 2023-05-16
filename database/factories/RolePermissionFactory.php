<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RolePermission>
 */
class RolePermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rolesIDs = DB::table('roles')->pluck('id');
        $permissionsIDs = DB::table('permissions')->pluck('id');

        return [
            'role_id' => fake()->randomElement($rolesIDs),
            'permission_id' => fake()->randomElement($permissionsIDs),
        ];
    }
}
