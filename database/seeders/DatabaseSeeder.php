<?php

namespace Database\Seeders;

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
        $this->call([
            SuperAdminSeeder::class,
            // User::factory()->create([  // ลบหรือคอมเมนต์บรรทัดนี้
            //     'name' => 'Test User',
            //     'email' => 'test@example.com',
            // ]),
        ]);
    }
}
