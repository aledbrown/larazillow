<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Aled Brown',
            'email' => 'aledb@mac.com',
            'is_admin' => true
        ]);

        User::factory()->create([
            'name' => 'Sam',
            'email' => 'sam@aled.com',
            'is_admin' => false
        ]);

        Listing::factory(20)->create([
            'by_user_id' => 1
        ]);
    }
}
