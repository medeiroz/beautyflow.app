<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Ranium\SeedOnce\Traits\SeedOnce;

class UserSeeder extends Seeder
{
    use SeedOnce;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Flavio Medeiros',
            'email' => 'smedeiros.flavio@gmail.com',
        ]);

        User::factory(10)->create();
    }
}
