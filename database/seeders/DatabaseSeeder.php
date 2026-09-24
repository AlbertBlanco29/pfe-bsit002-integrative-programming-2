<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Test user (was already here before)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 3 departments: IT (id 1), HR (id 2), Finance (id 3)
        $departments = collect(['IT', 'HR', 'Finance'])
            ->map(fn ($name) => Department::create(['name' => $name]));

        // One known employee so the search test (?search=juan) has a result
        Employee::create([
            'first_name' => 'Juan',
            'last_name' => 'Dela Cruz',
            'email' => 'juan@example.com',
            'position' => 'Developer',
            'department_id' => $departments[0]->id,
        ]);

        // 24 random employees, each placed in a random department
        for ($i = 1; $i <= 24; $i++) {
            Employee::create([
                'first_name' => fake()->firstName(),
                'last_name' => fake()->lastName(),
                'email' => fake()->unique()->safeEmail(),
                'position' => fake()->jobTitle(),
                'department_id' => $departments->random()->id,
            ]);
        }
    }
}