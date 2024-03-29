<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 100; $i++) {
            User::create([
                'firstname' => fake()->firstName(),
                'lastname' => fake()->lastName(),
                'phone' => fake()->unique()->numerify('+90##########'),
                'email' => 'example'.$i.'@test.com',
                'email_verified_at' => fake()->dateTime(),
                'password' => 123,
                'created_at' => fake()->dateTime(),
                'updated_at' => fake()->dateTime(),
            ]);
        }
    }
}
